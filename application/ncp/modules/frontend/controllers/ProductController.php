<?php
namespace ncp\modules\frontend\controllers;

use ncp\library\FrontController;
use fay\services\Category;
use fay\core\Sql;
use fay\models\tables\Posts;
use fay\common\ListView;
use fay\services\Post;
use fay\core\HttpException;
use fay\models\Prop;
use fay\helpers\ArrayHelper;
use fay\models\tables\PropValues;
use fay\core\db\Expr;
use ncp\models\Recommend;
use fay\services\Option;

class ProductController extends FrontController{
	public function __construct(){
		parent::__construct();
	
		$this->layout->current_header_menu = 'product';
	}
	
	public function index(){
		//全部地区
		$areas = Prop::service()->getPropOptionsByAlias('area');
		//全部月份
		$monthes = Prop::service()->getPropOptionsByAlias('month');
		
		if($this->form()->setRules(array(
			array(array('area_id', 'month', 'cat_id', 'page'), 'int'),
			array('area_id', 'range', array('range'=>array_merge(array(0), ArrayHelper::column($areas, 'id')))),
			array('month', 'range', array('range'=>array_merge(array(0), ArrayHelper::column($monthes, 'id')))),
			array('cat_id', 'exist', array('table'=>'categories', 'field'=>'id'))
		))->setFilters(array(
			'area_id'=>'intval',
			'month'=>'intval',
			'cat_id'=>'intval',
		))->check()){
			if($cat_id = $this->form()->getData('cat_id', 0)){
				$cat = Category::service()->get($cat_id);
			}else{
				$cat = Category::service()->getByAlias('product');
			}
			$this->layout->title = $cat['title'];
			$this->layout->keywords = $cat['seo_keywords'];
			$this->layout->description = $cat['seo_description'];
			
			$area_id = $this->form()->getData('area_id', 0);
			$month_id = $this->form()->getData('month', 0);
			
			$prop_area_id = Prop::service()->getIdByAlias('area');
			
			$sql = new Sql();
			$sql->from(array('p'=>'posts'), 'id,title,thumbnail')
				->joinLeft(array('c'=>'categories'), 'p.cat_id = c.id', 'title AS cat_title')
				->where(array(
					'c.left_value >= '.$cat['left_value'],
					'c.right_value <= '.$cat['right_value'],
					'p.status = '.Posts::STATUS_PUBLISHED,
					'p.deleted = 0',
					'p.publish_time < '.$this->current_time,
				))
				->joinLeft(array('pia'=>'post_prop_int'), array(
					'pia.prop_id = '.$prop_area_id,
					'pia.post_id = p.id',
				))
				->joinLeft(array('pva'=>'prop_values'), 'pia.content = pva.id', 'title AS area')
				->order('p.is_top DESC, p.sort, p.publish_time DESC')
				->group('p.id')
			;
			
			if($area_id){
				$sql->where(array(
					'pia.content = ?'=>$area_id,
				));
				$area = PropValues::model()->find($area_id);
				$this->layout->title .= '-'.$area['title'];
			}
			if($month_id){
				$prop_month_id = Prop::service()->getIdByAlias('month');
				$sql->joinLeft(array('pim'=>'post_prop_int'), array(
					'pim.prop_id = '.$prop_month_id,
					'pim.post_id = p.id',
				))->where(array(
					'pim.content = ?'=>$month_id,
				));
				$month = PropValues::model()->find($month_id);
				$this->layout->title .= '-'.$month['title'];
			}
			
			$this->view->assign(array(
				'areas'=>$areas,
				'monthes'=>$monthes,
				'cats'=>Category::service()->getChildren('product'),
				'area_id'=>$area_id,
				'month_id'=>$month_id,
				'cat_id'=>$cat_id,
				'cat'=>$cat,
				'listview'=>new ListView($sql, array(
					'page_size'=>16,
				))
			))->render();
			
		}else{
			throw new HttpException('页面不存在');
		}
	}
	
	public function item(){
		$id = $this->input->get('id', 'intval');
		
		if(!$id || !$post = Post::service()->get($id, '', 'product', true)){
			throw new HttpException('页面不存在');
		}
		Posts::model()->update(array(
			'last_view_time'=>$this->current_time,
			'views'=>new Expr('views + 1'),
		), $id);
		
		$this->layout->title = $post['seo_title'];
		$this->layout->keywords = $post['seo_keywords'];
		$this->layout->description = $post['seo_description'];
		
		$area = Post::service()->getPropValueByAlias('area', $id);

		$food_cat = Category::service()->getByAlias('food', 'id,left_value,right_value');//食品分类根目录
		$travel_cat = Category::service()->getByAlias('travel', 'id,left_value,right_value');//旅游分类根目录
		$product_cat = Category::service()->getByAlias('product', 'id,left_value,right_value');//产品分类根目录
		
		$this->view->assign(array(
			'post'=>$post,
			'area'=>$area,
			'buy_link'=>Post::service()->getPropValueByAlias('product_buy_link', $id),
			'food_posts'=>Recommend::model()->getByCatAndArea($food_cat, 9, Option::get('site:content_recommend_days'), $area['id']),
			'travel_posts'=>Recommend::model()->getByCatAndArea($travel_cat, 9, Option::get('site:content_recommend_days'), $area['id']),
			'right_posts'=>Recommend::model()->getByCatAndArea($food_cat, 6, Option::get('site:right_recommend_days')),
			'right_top_posts'=>Recommend::model()->getByCatAndArea($product_cat, 2, Option::get('site:right_top_recommend_days'), 0, $id),
		))->render();
	}
}