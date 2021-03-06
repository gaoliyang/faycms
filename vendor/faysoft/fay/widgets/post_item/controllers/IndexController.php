<?php
namespace fay\widgets\post_item\controllers;

use fay\widget\Widget;
use fay\services\post\PostService;
use fay\core\HttpException;
use fay\core\db\Expr;
use fay\models\tables\PostMetaTable;

class IndexController extends Widget{
	private $fields = array(
		'post'=>array(
			'fields'=>array(
				'id', 'title', 'content', 'content_type', 'publish_time', 'thumbnail', 'abstract',
			)
		),
		'category'=>array(
			'fields'=>array(
				'id', 'title', 'alias',
			)
		),
		'categories'=>array(
			'fields'=>array(
				'id', 'title', 'alias',
			)
		),
		'user'=>array(
			'fields'=>array(
				'id', 'username', 'nickname', 'avatar',
			)
		),
		'nav'=>array(
			'fields'=>array(
				'id', 'title',
			)
		),
		'tags'=>array(
			'fields'=>array(
				'id', 'title',
			)
		),
		'files'=>array(
			'fields'=>array(
				'*',
			)
		),
		'props'=>array(
			'fields'=>array(
				'*',//这里指定的是属性别名，取值视后台设定而定
			)
		),
		'meta'=>array(
			'fields'=>array(
				'comments', 'views', 'likes',
			)
		),
		'extra'=>array(
			'fields'=>array(
				'seo_title', 'seo_keywords', 'seo_description',
			)
		)
	);
	
	public function initConfig($config){
		isset($config['id_key']) || $config['id_key'] = 'id';
		empty($config['default_post_id']) && $config['default_post_id'] = 0;
		$config['inc_views'] = empty($config['inc_views']) ? 0 : 1;
		empty($config['fields']) && $config['fields'] = array();
		
		return $this->config = $config;
	}
	
	public function getData(){
		$fields = array(
			'post'=>$this->fields['post'],
			'extra'=>$this->fields['extra'],
		);
		foreach($this->config['fields'] as $f){
			$fields[$f] = $this->fields[$f];
		}
		
		//文章缩略图
		if(!empty($this->config['post_thumbnail_width']) || !empty($this->config['post_thumbnail_height'])){
			$fields['post']['extra'] = array(
				'thumbnail'=>(empty($this->config['post_thumbnail_width']) ? 0 : $this->config['post_thumbnail_width']) .
					'x' .
					(empty($this->config['post_thumbnail_height']) ? 0 : $this->config['post_thumbnail_height']),
			);
		}
		
		//附件缩略图
		if(in_array('files', $this->config['fields']) &&
			(!empty($this->config['file_thumbnail_width']) || !empty($this->config['file_thumbnail_height']))){
			$fields['files']['extra'] = array(
				'thumbnail'=>(empty($this->config['file_thumbnail_width']) ? 0 : $this->config['file_thumbnail_width']) .
					'x' .
					(empty($this->config['file_thumbnail_height']) ? 0 : $this->config['file_thumbnail_height']),
			);
		}
		
		if(!empty($this->config['id_key']) && $this->input->get($this->config['id_key'])){
			//有设置ID字段名，且传入ID字段
			$post = PostService::service()->get(
				$this->input->get($this->config['id_key'], 'intval'),
				$fields,
				isset($this->config['under_cat_id']) ? $this->config['under_cat_id'] : null
			);
			
			if(!$post){
				throw new HttpException('您访问的页面不存在');
			}
		}else{
			//未传入ID字段或未设置ID字段名
			$post = PostService::service()->get($this->config['default_post_id'], $fields);
			if(!$post){
				throw new HttpException('您访问的页面不存在');
			}
		}
		
		if($this->config['inc_views']){
			PostMetaTable::model()->update(array(
				'last_view_time'=>$this->current_time,
				'views'=>new Expr('views + 1'),
				'real_views'=>new Expr('real_views + 1'),
			), $post['post']['id']);
		}
		
		return $post;
	}
	
	public function index(){
		$post = $this->getData();
		
		$this->renderTemplate(array(
			'post'=>$post,
		));
		
	}
}