<?php
namespace uuice\modules\doc\controllers;

use uuice\library\DocController;
use fay\services\Category;
use fay\core\HttpException;
use fay\services\Post;
use fay\services\Option;

class GuideController extends DocController{
	public function index(){
		$cat = $this->input->get('cat', 'trim');
		$cat = Category::service()->get($cat, '*', 'fayfox');
		
		if(empty($cat)){
			throw new HttpException('页面不存在');
		}
		
		$this->layout->page_title = $cat['description'] ? "{$cat['title']}（{$cat['description']}）" : $cat['title'];
		$this->layout->title = $cat['title'].' - '.Option::get('site:sitename');

		$breadcrumb = array();
		$parent_path = Category::service()->getParentPath($cat, 'fayfox');
		if($parent_path){
			foreach($parent_path as $p){
				$breadcrumb[] = array(
					'text'=>$p['title'],
					'href'=>$this->view->url($p['alias']),
				);
			}
		}
		$this->layout->breadcrumb = $breadcrumb;
		
		if($cat['right_value'] - $cat['left_value'] == 1){
			//叶子节点
			$this->view->assign(array(
				'cat'=>$cat,
				'posts'=>Post::service()->getByCat($cat, 0, 'id,title,content,content_type', false, 'is_top DESC, sort, publish_time ASC'),
			))->render('posts');
		}else{
			//非叶子
			$this->view->assign(array(
				'cat'=>$cat,
				'cats'=>Category::service()->getNextLevelByParentId($cat['id']),
				'posts'=>Post::service()->getByCat($cat, 0, 'id,title,content,content_type', false, 'is_top DESC, sort, publish_time ASC'),
			))->render('cats');
		}
	}
}