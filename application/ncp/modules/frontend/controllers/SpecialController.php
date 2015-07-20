<?php
namespace ncp\modules\frontend\controllers;

use ncp\library\FrontController;
use fay\core\HttpException;
use fay\models\tables\Posts;
use fay\core\Sql;
use fay\models\Category;
use fay\common\ListView;
use ncp\models\Recommend;
use fay\models\Option;
use fay\models\Post;
use fay\core\db\Intact;

class SpecialController extends FrontController{
	public function __construct(){
		parent::__construct();
	
		$this->layout->current_header_menu = 'special';
	}
	
	public function index(){
		if($this->form()->setRules(array(
			array(array('page'), 'int'),
		))->setFilters(array(
			'page'=>'intval',
			'keywords'=>'trim',
		))->check()){
			$cat = Category::model()->getByAlias('special');

			$this->layout->title = $cat['title'];
			$this->layout->keywords = $cat['seo_keywords'];
			$this->layout->description = $cat['seo_description'];
			
			$sql = new Sql();
			$sql->from('posts', 'p', 'id,title,thumbnail,abstract')
				->joinLeft('categories', 'c', 'p.cat_id = c.id', 'title AS cat_title')
				->where(array(
					'p.deleted = 0',
					'p.publish_time < '.$this->current_time,
					'p.status = '.Posts::STATUS_PUBLISHED,
					'c.left_value >= '.$cat['left_value'],
					'c.right_value <= '.$cat['right_value'],
				))
				->order('p.is_top DESC, p.sort, p.publish_time DESC')
			;
			
			if($keywords = $this->form()->getData('keywords')){
				$sql->where(array(
					'title LIKE ?'=>'%'.$keywords.'%',
				));
			}
			
			$this->view->listview = new ListView($sql, array(
				'page_size'=>10,
			));
		}else{
			throw new HttpException('页面不存在');
		}
		
		$product_cat = Category::model()->getByAlias('product', 'id,left_value,right_value');//产品分类根目录
		$this->view->right_posts = Recommend::model()->getByCatAndArea($product_cat, 6, Option::get('site:right_recommend_days'));
		
		$this->view->render();
	}
	
	public function item(){
		$id = $this->input->get('id', 'intval');
		
		if(!$id || !$post = Post::model()->get($id, '', 'special', true)){
			throw new HttpException('页面不存在');
		}
		Posts::model()->update(array(
			'last_view_time'=>$this->current_time,
			'views'=>new Intact('views + 1'),
		), $id);
		
		$this->layout->title = $post['seo_title'];
		$this->layout->keywords = $post['seo_keywords'];
		$this->layout->description = $post['seo_description'];
		
		$this->view->assign(array(
			'post'=>$post,
		))->render();
	}
}