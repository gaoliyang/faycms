<?php
namespace fay\models\tables;

use fay\core\db\Table;

/**
 * Users Roles model
 * 
 * @property int $user_id
 * @property int $role_id
 */
class UsersRolesTable extends Table{
	protected $_name = 'users_roles';
	protected $_primary = array('user_id', 'role_id');
	
	/**
	 * @param string $class_name
	 * @return UsersRolesTable
	 */
	public static function model($class_name = __CLASS__){
		return parent::model($class_name);
	}
	
	public function rules(){
		return array(
			array(array('user_id'), 'int', array('min'=>0, 'max'=>4294967295)),
			array(array('role_id'), 'int', array('min'=>0, 'max'=>65535)),
			
			array(array('user_id'), 'exist', array('table'=>'users', 'field'=>'id')),
			array(array('role_id'), 'exist', array('table'=>'users', 'field'=>'id')),
		);
	}

	public function labels(){
		return array(
			'user_id'=>'用户ID',
			'role_id'=>'角色ID',
		);
	}

	public function filters(){
		return array(
			'user_id'=>'intval',
			'role_id'=>'intval',
		);
	}
}