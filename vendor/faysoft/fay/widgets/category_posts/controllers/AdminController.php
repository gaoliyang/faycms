<?php
namespace fay\widgets\category_posts\controllers;

use fay\widget\Widget;
use fay\services\CategoryService;
use fay\services\FlashService;

class AdminController extends Widget{
	public function initConfig($config){
		//设置模版
		empty($config['template']) && $config['template'] = $this->getDefaultTemplate();
		
		return $this->config = $config;
	}
	
	public function index(){
		$root_node = CategoryService::service()->getByAlias('_system_post', 'id');
		$this->view->cats = array(
			array(
				'id'=>$root_node['id'],
				'title'=>'顶级',
				'children'=>CategoryService::service()->getTreeByParentId($root_node['id']),
			),
		);
		
		$this->view->render();
	}
	
	/**
	 * 当有post提交的时候，会自动调用此方法
	 */
	public function onPost(){
		$data = $this->form->getFilteredData();
		$data['uri'] || $data['uri'] = empty($data['other_uri']) ? 'post/{$id}' : $data['other_uri'];
		
		//若模版与默认模版一致，不保存
		if($this->isDefaultTemplate($data['template'])){
			$data['template'] = '';
		}
		if(empty($data['fields'])){
			$data['fields'] = array();
		}
		$this->saveConfig($data);
		
		FlashService::set('编辑成功', 'success');
	}
	
	public function rules(){
		return array(
			array('number', 'int', array('min'=>1)),
			array(array('last_view_time', 'post_thumbnail_width', 'post_thumbnail_height'), 'int', array('min'=>0)),
		);
	}
	
	public function labels(){
		return array(
			'cat_id'=>'分类',
			'number'=>'显示文章数',
			'last_view_time'=>'最近访问',
			'post_thumbnail_width'=>'文章缩略图宽度',
			'post_thumbnail_height'=>'文章缩略图高度',
			'cat_key'=>'分类字段',
		);
	}
	
	public function filters(){
		return array(
			'subclassification'=>'intval',
			'cat_id'=>'intval',
			'title'=>'trim',
			'show_empty'=>'intval',
			'number'=>'intval',
			'uri'=>'trim',
			'other_uri'=>'trim',
			'template'=>'trim',
			'date_format'=>'trim',
			'thumbnail'=>'intval',
			'last_view_time'=>'intval',
			'order'=>'trim',
			'fields'=>'trim',
			'post_thumbnail_width'=>'intval',
			'post_thumbnail_height'=>'intval',
			'cat_key'=>'trim',
		);
	}
}