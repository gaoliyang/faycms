<?php
namespace shinecolor\modules\frontend\controllers;

use shinecolor\library\FrontController;
use fay\core\Sql;
use fay\models\Category;
use fay\models\tables\Posts;
use fay\common\ListView;
use fay\models\Post;
use fay\helpers\Html;
use fay\core\HttpException;

class ProductController extends FrontController{
	public function __construct(){
		parent::__construct();
		
		$this->layout->title = '';
		$this->layout->keywords = '';
		$this->layout->description = '';
	
		$this->layout->current_header_menu = 'service';

		$sql = new Sql();
		$this->view->pages = $sql->from('pages_categories', 'pc', '')
			->joinLeft('pages', 'p', 'pc.page_id = p.id', 'alias,title')
			->joinLeft('categories', 'c', 'pc.cat_id = c.id')
			->where(array(
				"c.alias = 'service'",
				'p.deleted = 0',
			))
			->order('p.sort')
			->fetchAll();
	}
	
	public function index(){
		$cat_product = Category::model()->getByAlias('product');

		$this->layout->title = $cat_product['seo_title'];
		$this->layout->keywords = $cat_product['seo_keywords'];
		$this->layout->description = $cat_product['seo_description'];
		
		$this->layout->breadcrumbs = array(
			array(
				'label'=>'首页',
				'link'=>$this->view->url(),
			),
			array(
				'label'=>'产品展示',
			),
		);
		
		$sql = new Sql();
		$sql->from('posts', 'p', 'id,title,thumbnail')
			->joinLeft('categories', 'c', 'p.cat_id = c.id')
			->where(array(
				'p.deleted = 0',
				'p.publish_time < '.\F::app()->current_time,
				'p.status = '.Posts::STATUS_PUBLISHED,
				'c.left_value >= '.$cat_product['left_value'],
				'c.right_value <= '.$cat_product['right_value'],
			))
			->order('p.is_top DESC, p.sort, p.publish_time DESC')
		;
		
		$this->view->listview = new ListView($sql, array(
			'page_size'=>9,
			'reload'=>$this->view->url('product'),
		));
		$this->view->render();
	}
	
	public function item(){
		$id = $this->input->get('id', 'intval');
		$post = Post::model()->get($id);
		
		if(!$post){
			throw new HttpException('文章不存在');
		}
		
		$this->layout->breadcrumbs = array(
			array(
				'label'=>'首页',
				'link'=>$this->view->url(),
			),
			array(
				'label'=>'产品展示',
				'link'=>$this->view->url('product'),
			),
			array(
				'label'=>Html::encode($post['title']),
			),
		);

		$this->layout->title = $post['seo_title'];
		$this->layout->keywords = Html::encode($post['seo_keywords']);
		$this->layout->description = $post['seo_description'];
		
		$this->view->post = $post;
		
		$this->view->render();
	}
}