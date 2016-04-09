<?php
namespace apidoc\models\tables;

use fay\core\db\Table;

/**
 * Apidoc Apis Objects model
 * 
 * @property int $api_id API ID
 * @property int $object_id 输出参数ID
 * @property string $name 参数名称
 * @property int $sort 排序值
 * @property string $since 自从
 * @property int $create_time 创建时间
 * @property int $last_modified_time 最后修改时间
 */
class Outputs extends Table{
	protected $_name = 'apidoc_apis_objects';
	protected $_primary = array('api_id', 'object_id');
	
	/**
	 * @return ApisObjects
	 */
	public static function model($class_name = __CLASS__){
		return parent::model($class_name);
	}
	
	public function rules(){
		return array(
			array(array('object_id'), 'int', array('min'=>0, 'max'=>16777215)),
			array(array('api_id'), 'int', array('min'=>0, 'max'=>65535)),
			array(array('sort'), 'int', array('min'=>0, 'max'=>255)),
			array(array('name'), 'string', array('max'=>50)),
			array(array('since'), 'string', array('max'=>30)),
		);
	}

	public function labels(){
		return array(
			'api_id'=>'API ID',
			'object_id'=>'输出参数ID',
			'name'=>'参数名称',
			'sort'=>'排序值',
			'since'=>'自从',
			'create_time'=>'创建时间',
			'last_modified_time'=>'最后修改时间',
		);
	}

	public function filters(){
		return array(
			'api_id'=>'intval',
			'object_id'=>'intval',
			'name'=>'trim',
			'sort'=>'intval',
			'since'=>'trim',
		);
	}
}