<?php
namespace cms\modules\admin\controllers;

use cms\library\AdminController;
use fay\helpers\Request;
use fay\services\Category;
use fay\services\post\Prop;
use fay\models\tables\Posts;
use fay\models\tables\PostsCategories;
use fay\models\tables\PostsFiles;
use fay\models\tables\Actionlogs;
use fay\services\Setting;
use fay\core\Sql;
use fay\common\ListView;
use fay\services\Post;
use fay\core\Response;
use fay\helpers\Html;
use fay\core\HttpException;
use fay\services\Option;
use fay\services\Flash;
use fay\models\tables\PostMeta;
use fay\services\Post as PostService;
use fay\models\tables\PostExtra;

class PostController extends AdminController{
	/**
	 * 是否启用文章审核功能
	 */
	public $post_review = false;
	
	/**
	 * 是否启用分类权限（根据角色分配可编辑的分类）
	 */
	public $role_cats = false;
	
	/**
	 * box列表
	 */
	public $boxes = array(
		array('name'=>'alias', 'title'=>'别名'),
		array('name'=>'views', 'title'=>'阅读数'),
		array('name'=>'likes', 'title'=>'点赞数'),
		array('name'=>'publish_time', 'title'=>'发布时间'),
		array('name'=>'main_category', 'title'=>'主分类'),
		array('name'=>'category', 'title'=>'附加分类'),
		array('name'=>'thumbnail', 'title'=>'缩略图'),
		array('name'=>'seo', 'title'=>'SEO优化'),
		array('name'=>'abstract', 'title'=>'摘要'),
		array('name'=>'tags', 'title'=>'标签'),
		array('name'=>'files', 'title'=>'附件'),
		array('name'=>'props', 'title'=>'附加属性'),
		array('name'=>'gather', 'title'=>'采集器'),
	);
	
	/**
	 * 默认box排序
	 */
	public $default_box_sort = array(
		'side'=>array(
			'publish_time', 'thumbnail', 'main_category', 'views', 'likes', 'alias', 'props', 'gather',
		),
		'normal'=>array(
			'abstract', 'tags', 'files', 'seo'
		),
	);
	
	public function __construct(){
		parent::__construct();
		$this->layout->current_directory = 'post';
		$this->post_review = !!(Option::get('system:post_review'));
		$this->role_cats = !!(Option::get('system:post_role_cats'));
	}
	
	public function create(){
		$cat_id = $this->input->get('cat_id', 'intval');
		$cat_id || $cat_id = Category::service()->getIdByAlias('_system_post');
		$cat = Category::service()->get($cat_id, 'title,left_value,right_value');
		
		if(!$cat){
			throw new HttpException('所选分类不存在');
		}
		
		//hook
		\F::event()->trigger('admin_before_post_create', array(
			'cat_id'=>$cat_id,
		));
		
		//先把可用boxes获取出来，post逻辑中要用到
		$_setting_key = 'admin_post_boxes';
		$enabled_boxes = $this->getEnabledBoxes($_setting_key);
		
		$this->form()->setModel(Posts::model())
			->setModel(PostsFiles::model())
			->setModel(PostMeta::model());
		if($this->input->post() && $this->form()->check()){
			//添加posts表
			$data = Posts::model()->fillData($this->input->post());
			isset($data['cat_id']) || $data['cat_id'] = $cat_id;
			
			//发布时间特殊处理
			if(in_array('publish_time', $enabled_boxes)){
				if(empty($data['publish_time'])){
					$data['publish_time'] = $this->current_time;
					$data['publish_date'] = date('Y-m-d', $data['publish_time']);
				}else{
					$data['publish_time'] = strtotime($data['publish_time']);
					$data['publish_date'] = date('Y-m-d', $data['publish_time']);
				}
			}
			
			$extra = array(
				'extra'=>array(
					'ip_int'=>Request::ip2int($this->ip),
				)
			);
			
			//Markdown语法特殊处理
			if($data['content_type'] == Posts::CONTENT_TYPE_MARKDOWN){
				$extra['extra']['markdown'] = $data['content'];
				$data['content'] = $this->input->post('markdown-container-html-code');
			}
			
			//Meta信息
			if($post_meta = PostMeta::model()->fillData($this->input->post())){
				$extra['meta'] = $post_meta;
			}
			
			//扩展信息
			if($post_extra = PostExtra::model()->fillData($this->input->post())){
				$extra['extra'] = array_merge($post_extra, $extra['extra']);
			}
			
			//附加分类
			if($post_category = $this->form()->getData('post_category')){
				$extra['categories'] = $post_category;
			}
			
			//标签
			if($tags = $this->input->post('tags')){
				$extra['tags'] = $tags;
			}
			
			//附件
			$description = $this->input->post('description');
			$files = $this->input->post('files', 'intval', array());
			$extra['files'] = array();
			foreach($files as $f){
				$extra['files'][$f] = isset($description[$f]) ? $description[$f] : '';
			}
			
			//附加属性
			$extra['props'] = $this->input->post('props', '', array());
			
			$post_id = PostService::service()->create($data, $extra, $this->current_user);
			
			$this->actionlog(Actionlogs::TYPE_POST, '添加文章', $post_id);
			Response::notify('success', '文章发布成功', array('admin/post/edit', array(
				'id'=>$post_id,
			)));
		}
		
		//设置附加属性
		$this->view->prop_set = Prop::service()->getPropsByCat($cat_id);
		
		$this->form()->setData(array(
			'cat_id'=>$cat_id,
		));
		
		//box排序
		$_box_sort_settings = Setting::service()->get('admin_post_box_sort');
		$_box_sort_settings || $_box_sort_settings = $this->default_box_sort;
		$this->view->_box_sort_settings = $_box_sort_settings;
		
		//页面设置
		$enabled_boxes = $this->getEnabledBoxes($_setting_key);
		$this->settingForm($_setting_key, '_setting_edit', array(), array(
			'enabled_boxes'=>$enabled_boxes,
		));
		
		//所有文章分类
		$this->view->cats = Category::service()->getTree('_system_post');
		
		//标题
		if(in_array('main_category', $enabled_boxes)){
			$this->layout->subtitle = '撰写文章';
		}else{
			//若没有给出主分类选择框，则在标题中显示分类名
			$this->layout->subtitle = '撰写文章 - 所属分类：'.$cat['title'];
		}
		
		if($this->checkPermission('admin/post/index')){
			$this->layout->sublink = array(
				'uri'=>array('admin/post/index'),
				'text'=>'所有文章',
			);
		}
		
		$this->layout->_help_panel = '_help';
		
		$this->view->render();
	}
	
	public function index(){
		//搜索条件验证，异常数据直接返回404
		$this->form()->setScene('final')->setRules(array(
			array('status', 'range', array(
				'range'=>array(
					Posts::STATUS_PUBLISHED, Posts::STATUS_DRAFT,
					Posts::STATUS_REVIEWED, Posts::STATUS_PENDING
				),
			)),
			array('deleted', 'range', array(
				'range'=>array(0, 1),
			)),
			array('time_field', 'range', array(
				'range'=>array('publish_time', 'create_time', 'last_modified_time')
			)),
			array(array('start_time', 'end_time'), 'datetime'),
			array('orderby', 'range', array(
				'range'=>Posts::model()->getFields(),
			)),
			array('order', 'range', array(
				'range'=>array('asc', 'desc'),
			)),
			array('keywords_field', 'range', array(
				'range'=>Posts::model()->getFields(),
			)),
			array('cat_id', 'int', array('min'=>1))
		))->check();
		
		$this->layout->subtitle = '所有文章';
		
		$cat_id = $this->input->get('cat_id', 'intval', 0);
		
		//权限检查
		if($this->checkPermission('admin/post/create')){
			$this->layout->sublink = array(
				'uri'=>array('admin/post/create', array(
					'cat_id'=>$cat_id
				)),
				'text'=>'撰写文章',
			);
		}
		
		//页面设置
		$_settings = $this->settingForm('admin_post_index', '_setting_index', array(
			'cols'=>array('main_category', 'status', 'publish_time', 'last_modified_time', 'create_time', 'sort'),
			'display_name'=>'username',
			'display_time'=>'short',
			'page_size'=>10,
		));
		
		//列表页会根据enabled_boxes决定是否显示某些列
		$this->view->enabled_boxes = $this->getEnabledBoxes('admin_post_boxes');
		//查找文章分类
		$this->view->cats = Category::service()->getTree('_system_post');
		
		$sql = new Sql();
		$count_sql = new Sql();//逻辑太复杂，靠通用逻辑从完整sql中替换出来的话，效率太低
		$sql->from(array('p'=>'posts'), Posts::model()->formatFields('!content'))
			->joinLeft(array('pm'=>'post_meta'), 'p.id = pm.post_id', PostMeta::model()->formatFields('!post_id'));
		$count_sql->from(array('p'=>'posts'), 'COUNT(*)');
		
		if(in_array('main_category', $_settings['cols'])){
			$sql->joinLeft(array('c'=>'categories'), 'p.cat_id = c.id', 'title AS cat_title');
		}
		
		if(in_array('user', $_settings['cols'])){
			$sql->joinLeft(array('u'=>'users'), 'p.user_id = u.id', 'username,nickname,realname');
		}
		
		//根据分类搜索
		if($cat_id){
			if($this->input->get('with_child')){
				//包含子分类搜索
				$cats = Category::service()->getChildIds($cat_id);
				if($this->input->get('with_slave')){
					$orWhere = array(
						"p.cat_id = {$cat_id}",
						"pc.cat_id = {$cat_id}",
					);
					foreach($cats as $c){
						$orWhere[] = "p.cat_id = {$c}";
						$orWhere[] = "pc.cat_id = {$c}";
					}
					//包含文章从分类搜索
					$sql->joinLeft(array('pc'=>'posts_categories'), 'p.id = pc.post_id')
						->orWhere($orWhere)
						->distinct(true);
					$count_sql->joinLeft(array('pc'=>'posts_categories'), 'p.id = pc.post_id')
						->orWhere($orWhere)
						->countBy('DISTINCT p.id')
					;
				}else{
					//仅根据文章主分类搜索
					$orWhere = array(
						"p.cat_id = {$cat_id}",
					);
					foreach($cats as $c){
						$orWhere[] = "p.cat_id = {$c}";
					}
					$sql->orWhere($orWhere);
					$count_sql->orWhere($orWhere);
				}
			}else{
				if($this->input->get('with_slave')){
					//包含文章从分类搜索
					$sql->where(array('p.cat_id = ?'=>$cat_id));
					$count_sql->where(array('p.cat_id = ?'=>$cat_id));
				}else{
					//仅根据文章主分类搜索
					$sql->where(array('p.cat_id = ?'=>$cat_id));
					$count_sql->where(array('p.cat_id = ?'=>$cat_id));
				}
			}
		}
		
		//文章状态
		if($this->input->get('deleted', 'intval') == 1){
			$sql->where('p.deleted = 1');
			$count_sql->where('p.deleted = 1');
		}else if($this->input->get('status') !== null && $this->input->get('deleted', 'intval') != 1){
			$sql->where(array(
				'p.deleted != 1',
				'p.status = ?'=>$this->input->get('status', 'intval'),
			));
			$count_sql->where(array(
				'p.deleted != 1',
				'p.status = ?'=>$this->input->get('status', 'intval'),
			));
		}else{
			$sql->where('p.deleted = 0');
			$count_sql->where('p.deleted = 0');
		}
		
		//时间段
		if($this->input->get('start_time')){
			$sql->where(array("p.{$this->input->get('time_field')} > ?"=>$this->input->get('start_time', 'strtotime')));
			$count_sql->where(array("p.{$this->input->get('time_field')} > ?"=>$this->input->get('start_time', 'strtotime')));
		}
		if($this->input->get('end_time')){
			$sql->where(array("p.{$this->input->get('time_field')} < ?"=>$this->input->get('end_time', 'strtotime')));
			$count_sql->where(array("p.{$this->input->get('time_field')} < ?"=>$this->input->get('end_time', 'strtotime')));
		}
		
		if($tag_id = $this->input->get('tag_id', 'intval')){
			$sql->joinLeft(array('pt'=>'posts_tags'), 'p.id = pt.post_id')
				->where(array(
					'pt.tag_id = ?'=>$tag_id,
				))
				->distinct(true);
			$count_sql->joinLeft(array('pt'=>'posts_tags'), 'p.id = pt.post_id')
				->where(array(
					'pt.tag_id = ?'=>$tag_id,
				))
				->countBy('DISTINCT p.id');
		}
		
		//关键词搜索
		if($this->input->get('keywords')){
			if(in_array($this->input->get('keywords_field'), array('title'))){
				$sql->where(array("p.{$this->input->get('keywords_field')} LIKE ?"=>'%'.$this->input->get('keywords').'%'));
				$count_sql->where(array("p.{$this->input->get('keywords_field')} LIKE ?"=>'%'.$this->input->get('keywords').'%'));
			}else if(in_array($this->input->get('keywords_field'), array('id', 'user_id'))){
				$sql->where(array("p.{$this->input->get('keywords_field')} = ?"=>$this->input->get('keywords', 'intval')));
				$count_sql->where(array("p.{$this->input->get('keywords_field')} = ?"=>$this->input->get('keywords', 'intval')));
			}else{
				$sql->where(array('p.title LIKE ?'=>'%'.$this->input->get('keywords', 'trim').'%'));
				$count_sql->where(array('p.title LIKE ?'=>'%'.$this->input->get('keywords', 'trim').'%'));
			}
		}
		
		//排序
		if($this->input->get('orderby')){
			$this->view->orderby = $this->input->get('orderby');
			$this->view->order = $this->input->get('order') == 'asc' ? 'ASC' : 'DESC';
			$sql->order("P.{$this->view->orderby} {$this->view->order}");
		}else{
			$sql->order('p.id DESC');
		}
		
		$this->view->listview = new ListView($sql, array(
			'page_size'=>$this->form('setting')->getData('page_size', 20),
			'empty_text'=>'<tr><td colspan="'.(count($this->form('setting')->getData('cols')) + 2).'" align="center">无相关记录！</td></tr>',
		));
		$this->view->render();
	}
	
	public function edit(){
		$_setting_key = 'admin_post_boxes';
		//这里获取enabled_boxes是为了更新文章的时候用
		//由于box可能被hook改掉，后面还会再获取一次enabled_boxes
		$enabled_boxes = $this->getEnabledBoxes($_setting_key);
		
		$post_id = $this->input->get('id', 'intval');
		if(empty($post_id)){
			throw new HttpException('参数不完整', 500);
		}
		
		//原文章部分信息
		$post = Posts::model()->find($post_id, 'cat_id,status');
		if(!$post){
			throw new HttpException('无效的文章ID');
		}
		
		//编辑权限检查
		if(!Post::checkEditPermission($post_id, $this->input->post('status', 'intval'), $this->input->post('cat_id'))){
			throw new HttpException('您无权限编辑该文章', 403, 'permission-denied');
		}
		
		$cat = Category::service()->get($post['cat_id'], 'title,left_value,right_value');
		
		//若分类已被删除，将文章归为根分类
		if(!$cat){
			$cat = Category::service()->getByAlias('_system_post', 'id,title,left_value,right_value');
			Posts::model()->update(array(
				'cat_id'=>$cat['id'],
			), $post_id);
			Flash::set('文章所属分类不存在，请重新设置文章分类', 'info');
		}
		
		$this->form()->setModel(Posts::model())
			->setModel(PostMeta::model())
			->setModel(PostsFiles::model());
		
		if($this->input->post() && $this->form()->check()){
			$status = $this->form()->getData('status');
			
			//未开启审核，文章却被设置为审核状态，强制修改为草稿（一般是之前开启了审核，后来关掉了）
			if(!$this->post_review && ($status == Posts::STATUS_REVIEWED || $status == Posts::STATUS_PENDING)){
				$this->form()->setData(array(
					'status'=>Posts::STATUS_DRAFT,
				), true);
				Flash::set('文章状态异常，被强制修改为“草稿”', 'info');
			}
			
			//筛选出文章相关字段
			$data = Posts::model()->fillData($this->input->post());
			//发布时间特殊处理
			if(in_array('publish_time', $enabled_boxes)){
				if(empty($data['publish_time'])){
					$data['publish_time'] = $this->current_time;
					$data['publish_date'] = date('Y-m-d', $data['publish_time']);
				}else{
					$data['publish_time'] = strtotime($data['publish_time']);
					$data['publish_date'] = date('Y-m-d', $data['publish_time']);
				}
			}
			
			$extra = array();
			
			//Markdown语法特殊处理
			if($data['content_type'] == Posts::CONTENT_TYPE_MARKDOWN){
				$extra['extra']['markdown'] = $data['content'];
				$data['content'] = $this->input->post('markdown-container-html-code');
			}
			
			//计数表
			if($post_meta = PostMeta::model()->fillData($this->input->post())){
				$extra['meta'] = $post_meta;
			}
			
			//扩展信息
			if($post_extra = PostExtra::model()->fillData($this->input->post())){
				if(!empty($extra['extra'])){
					$extra['extra'] = array_merge($post_extra, $extra['extra']);
				}else{
					$extra['extra'] = $post_extra;
				}
			}
			
			//附件分类
			if(in_array('category', $enabled_boxes)){
				$extra['categories'] = $this->form()->getData('post_category', array(), 'intval');
			}
			
			//标签
			if(in_array('tags', $enabled_boxes)){
				$extra['tags'] = $this->input->post('tags', 'trim', array());
			}
			
			//附件
			if(in_array('files', $enabled_boxes)){
				$description = $this->input->post('description');
				$files = $this->input->post('files', 'intval', array());
				$extra['files'] = array();
				foreach($files as $f){
					$extra['files'][$f] = isset($description[$f]) ? $description[$f] : '';
				}
			}
			
			//附加属性
			if(in_array('props', $enabled_boxes)){
				$extra['props'] = $this->input->post('props');
			}
			
			PostService::service()->update($post_id, $data, $extra);
			
			$this->actionlog(Actionlogs::TYPE_POST, '编辑文章', $post_id);
			Response::notify('success', '一篇文章被编辑', false);
		}
		
		$sql = new Sql();
		$post = $sql->from(array('p'=>'posts'), Posts::model()->getFields())
			->joinLeft(array('pm'=>'post_meta'), 'p.id = pm.post_id', PostMeta::model()->formatFields('!post_id'))
			->joinLeft(array('pe'=>'post_extra'), 'p.id = pe.post_id', PostExtra::model()->formatFields('!post_id'))
			->where('p.id = ?', $post_id)
			->fetchRow()
		;
		
		//hook
		\F::event()->trigger('admin_before_post_update', array(
			'cat_id'=>$post['cat_id'],
			'post_id'=>$post_id,
		));
		
		$post['post_category'] = PostsCategories::model()->fetchCol('cat_id', array('post_id = ?'=>$post_id));
		$post['publish_time'] = date('Y-m-d H:i:s', $post['publish_time']);
		
		//文章对应标签
		$tags = $sql->from(array('pt'=>'posts_tags'), '')
			->joinLeft(array('t'=>'tags'), 'pt.tag_id = t.id', 'title')
			->where('pt.post_id = '.$post_id)
			->fetchAll();
		$tags_arr = array();
		foreach($tags as $t){
			$tags_arr[] = $t['title'];
		}
		$this->form()->setData(array('tags'=>implode(',', $tags_arr)));
		
		//分类树
		$this->view->cats = Category::service()->getTree('_system_post');
		
		//post files
		$this->view->files = PostsFiles::model()->fetchAll(array(
			'post_id = ?'=>$post_id,
		), 'file_id,description,is_image', 'sort');

		$this->form()->setData($post, true);
		$this->view->post = $post;
		
		//附加属性
		$this->view->prop_set = Prop::service()->getPropertySet($post['id']);
		
		$cat = Category::service()->get($post['cat_id'], 'title');
		$this->layout->subtitle = '编辑文章- 所属分类：'.$cat['title'];
		if($this->checkPermission('admin/post/create')){
			$this->layout->sublink = array(
				'uri'=>array('admin/post/create', array(
					'cat_id'=>$post['cat_id'],
				)),
				'text'=>'在此分类下发布文章',
			);
		}
		
		//box排序
		$_box_sort_settings = Setting::service()->get('admin_post_box_sort');
		$_box_sort_settings || $_box_sort_settings = $this->default_box_sort;
		$this->view->_box_sort_settings = $_box_sort_settings;
		
		//页面设置
		$enabled_boxes = $this->getEnabledBoxes($_setting_key);
		$this->settingForm($_setting_key, '_setting_edit', array(), array(
			'enabled_boxes'=>$enabled_boxes,
		));
		
		$this->view->render();
	}
	
	/**
	 * 删除
	 */
	public function delete(){
		$post_id = $this->input->get('id', 'intval');
		
		PostService::service()->delete($post_id);
		
		$this->actionlog(Actionlogs::TYPE_POST, '将文章移入回收站', $post_id);
		
		Response::notify('success', array(
			'message'=>'一篇文章被移入回收站 - '.Html::link('撤销', array('admin/post/undelete', array(
				'id'=>$post_id,
			))),
			'id'=>$post_id,
		));
	}
	
	/**
	 * 还原
	 */
	public function undelete(){
		$post_id = $this->input->get('id', 'intval');
		
		if(!Post::checkUndeletePermission($post_id)){
			throw new HttpException('您无权限编辑该文章', 403, 'permission-denied');
		}
		PostService::service()->undelete($post_id);
		
		$this->actionlog(Actionlogs::TYPE_POST, '将文章移出回收站', $post_id);
		
		Response::notify('success', array(
			'message'=>'一篇文章被还原',
			'id'=>$post_id,
		));
	}
	
	public function remove(){
		$post_id = $this->input->get('id', 'intval');
		
		PostService::service()->remove($post_id);
		
		$this->actionlog(Actionlogs::TYPE_POST, '将文章永久删除', $post_id);
		
		Response::notify('success', array(
			'message'=>'一篇文章被永久删除',
			'id'=>$post_id,
		));
	}
	
	/**
	 * 文章排序
	 */
	public function sort(){
		$post_id = $this->input->get('id', 'intval');
		Posts::model()->update(array(
			'sort'=>$this->input->get('sort', 'intval'),
		), array(
			'id = ?'=>$post_id,
		));
		$this->actionlog(Actionlogs::TYPE_POST, '改变了文章排序', $post_id);
		
		$post = Posts::model()->find($post_id, 'sort');
		Response::notify('success', array(
			'message'=>'一篇文章的排序值被编辑',
			'data'=>array(
				'sort'=>$post['sort'],
			),
		));
	}
	
	/**
	 * 单独渲染一个prop box
	 */
	public function getPropBox(){
		$cat_id = $this->input->get('cat_id', 'intval');
		$post_id = $this->input->get('post_id', 'intval');
		
		//文章对应附加属性值
		$props = Prop::service()->getPropsByCat($cat_id);
		if($post_id){
			$this->view->prop_set = Prop::service()->getPropertySet($post_id, $props);
		}else{
			$this->view->prop_set = $props;
		}
		
		$this->view->renderPartial('_box_props');
	}
	
	/**
	 * 分类管理
	 */
	public function cat(){
		$this->layout->current_directory = 'post';
		$this->layout->_setting_panel = '_setting_cat';
		
		//页面设置
		$this->settingForm('admin_post_cat', '_setting_cat', array(
			'default_dep'=>2,
		));
		
		$this->layout->subtitle = '文章分类';
		$this->view->cats = Category::service()->getTree('_system_post');
		$root_node = Category::service()->getByAlias('_system_post', 'id');
		$this->view->root = $root_node['id'];
		
		if($this->checkPermission('admin/post/cat-create')){
			$this->layout->sublink = array(
				'uri'=>'#create-cat-dialog',
				'text'=>'添加文章分类',
				'html_options'=>array(
					'class'=>'create-cat-link',
					'data-title'=>'文章',
					'data-id'=>$root_node['id'],
				),
			);
		}
		
		$this->view->render();
	}
	
	public function batch(){
		$ids = $this->input->post('ids', 'intval');
		$action = $this->input->post('batch_action');
		
		switch($action){
			case 'set-published':
				foreach($ids as $id){
					if(!Post::checkEditPermission($id, Posts::STATUS_PUBLISHED)){
						throw new HttpException('您无权限编辑该文章', 403, 'permission-denied');
					}
				}
				
				$affected_rows = Post::service()->batchPublish($ids);
				
				$this->actionlog(Actionlogs::TYPE_POST, '批处理：文章' . json_encode($affected_rows) . '被发布');
				Response::notify('success', count($affected_rows) . '篇文章被发布');
			break;
			case 'set-draft':
				foreach($ids as $id){
					if(!Post::checkEditPermission($id, Posts::STATUS_PUBLISHED)){
						throw new HttpException('您无权限编辑该文章', 403, 'permission-denied');
					}
				}
				
				$affected_rows = Post::service()->batchDraft($ids);
				
				$this->actionlog(Actionlogs::TYPE_POST, '批处理：文章' . json_encode($affected_rows) . '被标记为“草稿”');
				Response::notify('success', count($affected_rows) . '篇文章被标记为“草稿”');
			break;
			case 'set-pending':
				foreach($ids as $id){
					if(!Post::checkEditPermission($id, Posts::STATUS_PUBLISHED)){
						throw new HttpException('您无权限编辑该文章', 403, 'permission-denied');
					}
				}
				
				$affected_rows = Post::service()->batchPending($ids);
				
				$this->actionlog(Actionlogs::TYPE_POST, '批处理：文章' . json_encode($affected_rows) . '被标记为“待审核”');
				Response::notify('success', count($affected_rows) . '篇文章被标记为“待审核”');
			break;
			case 'set-reviewed':
				foreach($ids as $id){
					if(!Post::checkEditPermission($id, Posts::STATUS_PUBLISHED)){
						throw new HttpException('您无权限编辑该文章', 403, 'permission-denied');
					}
				}
				
				$affected_rows = Post::service()->batchReviewed($ids);
				
				$this->actionlog(Actionlogs::TYPE_POST, '批处理：文章' . json_encode($affected_rows) . '被标记为“通过审核”');
				Response::notify('success', count($affected_rows) . '篇文章被标记为“通过审核”');
			break;
			case 'delete':
				foreach($ids as $id){
					if(!Post::checkDeletePermission($id)){
						throw new HttpException('您无权限编辑该文章', 403, 'permission-denied');
					}
				}
				
				$affected_rows = Post::service()->batchDelete($ids);
				
				$this->actionlog(Actionlogs::TYPE_POST, '批处理：文章' . json_encode($affected_rows) . '被移入回收站');
				Response::notify('success', count($affected_rows) . '篇文章被移入回收站');
			break;
			case 'undelete':
				foreach($ids as $id){
					if(!Post::checkUndeletePermission($id)){
						throw new HttpException('您无权限编辑该文章', 403, 'permission-denied');
					}
				}
				
				$affected_rows = Post::service()->batchUndelete($ids);
				
				$this->actionlog(Actionlogs::TYPE_POST, '批处理：文章' . json_encode($affected_rows) . '被还原');
				Response::notify('success', count($affected_rows) . '篇文章被还原');
			break;
			case 'remove':
				foreach($ids as $id){
					if(!Post::checkRemovePermission($id)){
						throw new HttpException('您无权限编辑该文章', 403, 'permission-denied');
					}
				}
				
				$affected_rows = array();
				foreach($ids as $id){
					if(PostService::service()->remove($id)){
						$affected_rows[] = $id;
					}
				}

				$this->actionlog(Actionlogs::TYPE_POST, '批处理：文章' . json_encode($affected_rows) . '被永久删除');
				Response::notify('success', count($affected_rows) . '篇文章被永久删除');
			break;
			default:
				Response::notify('error', array(
					'message'=>'操作选项不能为空',
					'error_code'=>'action-can-not-be-empty',
				));
			break;
		}
	}
	
	/**
	 * 验证文章别名是否存在（不排除已删除和未发布的文章）
	 */
	public function isAliasNotExist(){
		if(Posts::model()->fetchRow(array(
			'alias = ?'=>$this->input->request('alias', 'trim'),
			'id != ?'=>$this->input->request('id', 'intval', false),
		))){
			Response::json('', 0, '别名已存在');
		}else{
			Response::json();
		}
	}
	
	/**
	 * 搜索
	 */
	public function search(){
		if($cat_id = $this->input->request('cat_id', 'intval')){
			$cats = Category::service()->getChildIds($cat_id);
			$cats[] = $cat_id;
		}
		$posts = Posts::model()->fetchAll(array(
			'title LIKE ?'=>'%'.$this->input->request('key', false).'%',
			'cat_id IN (?)'=>isset($cats) ? $cats : false,
		), 'id,title', 'id DESC', 20);
		Response::json($posts);
	}
	
	/**
	 * 返回各状态下的文章数
	 */
	public function getCounts(){
		$data = array(
			'all'=>\cms\models\Post::model()->getCount(),
			'published'=>\cms\models\Post::model()->getCount(Posts::STATUS_PUBLISHED),
			'draft'=>\cms\models\Post::model()->getCount(Posts::STATUS_DRAFT),
			'deleted'=>\cms\models\Post::model()->getDeletedCount(),
		);
		
		if($this->post_review){
			$data['pending'] = \cms\models\Post::model()->getCount(Posts::STATUS_PENDING);
			$data['reviewed'] = \cms\models\Post::model()->getCount(Posts::STATUS_REVIEWED);
		}
		
		Response::json($data);
	}
}