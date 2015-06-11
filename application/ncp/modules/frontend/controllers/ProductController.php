<?php
namespace ncp\modules\frontend\controllers;

use ncp\library\FrontController;
use fay\models\Category;
use fay\core\Sql;
use fay\models\tables\Posts;
use fay\common\ListView;
use fay\models\Post;
use fay\core\HttpException;
use fay\models\Prop;
use fay\helpers\ArrayHelper;
use fay\models\tables\PropValues;
use fay\core\db\Intact;
use ncp\models\Recommend;
use fay\models\Option;

class ProductController extends FrontController{
	public function __construct(){
		parent::__construct();
	
		$this->layout->current_header_menu = 'product';
	}
	
	public function index(){
		//全部地区
		$areas = Prop::model()->getPropOptionsByAlias('area');
		//全部月份
		$monthes = Prop::model()->getPropOptionsByAlias('month');
		
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
				$cat = Category::model()->get($cat_id);
			}else{
				$cat = Category::model()->getByAlias('product');
			}
			$this->layout->title = $cat['title'];
			$this->layout->keywords = $cat['seo_keywords'];
			$this->layout->description = $cat['seo_description'];
			
			$area_id = $this->form()->getData('area_id', 0);
			$month_id = $this->form()->getData('month', 0);
			
			$prop_area_id = Prop::model()->getIdByAlias('area');
			
			$sql = new Sql();
			$sql->from('posts', 'p', 'id,title,thumbnail')
				->joinLeft('categories', 'c', 'p.cat_id = c.id', 'title AS cat_title')
				->where(array(
					'p.deleted = 0',
					'p.publish_time < '.$this->current_time,
					'p.status = '.Posts::STATUS_PUBLISHED,
					'c.left_value >= '.$cat['left_value'],
					'c.right_value <= '.$cat['right_value'],
				))
				->joinLeft('post_prop_int', 'pia', array(
					'pia.prop_id = '.$prop_area_id,
					'pia.post_id = p.id',
				))
				->joinLeft('prop_values', 'pva', 'pia.content = pva.id', 'title AS area')
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
				$prop_month_id = Prop::model()->getIdByAlias('month');
				$sql->joinLeft('post_prop_int', 'pim', array(
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
				'cats'=>Category::model()->getAll('product'),
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
		
		if(!$id || !$post = Post::model()->get($id, '', 'product', true)){
			throw new HttpException('页面不存在');
		}
		Posts::model()->update(array(
			'last_view_time'=>$this->current_time,
			'views'=>new Intact('views + 1'),
		), $id);
		
		$this->layout->title = $post['seo_title'];
		$this->layout->keywords = $post['seo_keywords'];
		$this->layout->description = $post['seo_description'];
		
		$area = Post::model()->getPropValueByAlias('area', $id);

		$food_cat = Category::model()->getByAlias('food', 'id,left_value,right_value');//食品分类根目录
		$travel_cat = Category::model()->getByAlias('travel', 'id,left_value,right_value');//旅游分类根目录
		$product_cat = Category::model()->getByAlias('product', 'id,left_value,right_value');//产品分类根目录
		
		$this->view->assign(array(
			'post'=>$post,
			'area'=>$area,
			'buy_link'=>Post::model()->getPropValueByAlias('product_buy_link', $id),
			'food_posts'=>Recommend::model()->getByCatAndArea($food_cat, 9, Option::get('site.content_recommend_days'), $area['id']),
			'travel_posts'=>Recommend::model()->getByCatAndArea($travel_cat, 9, Option::get('site.content_recommend_days'), $area['id']),
			'right_posts'=>Recommend::model()->getByCatAndArea($food_cat, 6, Option::get('site.right_recommend_days')),
			'right_top_posts'=>Recommend::model()->getByCatAndArea($product_cat, 2, Option::get('site.right_top_recommend_days'), 0, $id),
		))->render();
	}
}