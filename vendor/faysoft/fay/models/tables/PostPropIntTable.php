<?php
namespace fay\models\tables;

use fay\core\db\Table;

class PostPropIntTable extends Table{
	protected $_name = 'post_prop_int';
	protected $_primary = array('post_id', 'prop_id', 'content');
	
	/**
	 * @param string $class_name
	 * @return PostPropIntTable
	 */
	public static function model($class_name = __CLASS__){
		return parent::model($class_name);
	}
	
	public function rules(){
		return array(
			array(array('post_id', 'prop_id', 'content'), 'int', array('min'=>0, 'max'=>4294967295)),
		);
	}

	public function labels(){
		return array(
			'post_id'=>'Post Id',
			'prop_id'=>'Prop Id',
			'content'=>'Content',
		);
	}

	public function filters(){
		return array(
			'post_id'=>'intval',
			'prop_id'=>'intval',
			'content'=>'intval',
		);
	}
}