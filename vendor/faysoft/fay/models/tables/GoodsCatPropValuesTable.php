<?php
namespace fay\models\tables;

use fay\core\db\Table;

/**
 * Goods Cat Prop Values model
 * 
 * @property int $id
 * @property int $cat_id
 * @property int $prop_id
 * @property string $title
 * @property int $deleted
 * @property int $sort
 */
class GoodsCatPropValuesTable extends Table{
	protected $_name = 'goods_cat_prop_values';
	
	/**
	 * @param string $class_name
	 * @return GoodsCatPropValuesTable
	 */
	public static function model($class_name = __CLASS__){
		return parent::model($class_name);
	}
	
	public function rules(){
		return array(
			array(array('id'), 'int', array('min'=>0, 'max'=>4294967295)),
			array(array('cat_id', 'prop_id'), 'int', array('min'=>0, 'max'=>16777215)),
			array(array('sort'), 'int', array('min'=>0, 'max'=>255)),
			array(array('title'), 'string', array('max'=>255)),
			array(array('deleted'), 'range', array('range'=>array(0, 1))),
		);
	}

	public function labels(){
		return array(
			'id'=>'Id',
			'cat_id'=>'分类ID',
			'prop_id'=>'属性ID',
			'title'=>'标题',
			'deleted'=>'删除标记',
			'sort'=>'排序值i',
		);
	}

	public function filters(){
		return array(
			'id'=>'intval',
			'cat_id'=>'intval',
			'prop_id'=>'intval',
			'title'=>'trim',
			'deleted'=>'intval',
			'sort'=>'intval',
		);
	}
}