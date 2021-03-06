<?php
namespace fay\services\user;

use fay\models\PropModel;
use fay\models\tables\PropsTable;
use fay\core\Loader;

class UserPropService extends PropModel{
	/**
	 * @param string $class_name
	 * @return UserPropService
	 */
	public static function service($class_name = __CLASS__){
		return Loader::singleton($class_name);
	}
	
	/**
	 * @see \fay\models\PropModel::$models
	 * @var array
	 */
	protected $models = array(
		'varchar'=>'fay\models\tables\UserPropVarcharTable',
		'int'=>'fay\models\tables\UserPropIntTable',
		'text'=>'fay\models\tables\UserPropTextTable',
	);
	
	/**
	 * @see Prop::$foreign_key
	 * @var string
	 */
	protected $foreign_key = 'user_id';
	
	/**
	 * @see Prop::$type
	 * @var string
	 */
	protected $type = PropsTable::TYPE_ROLE;
	
	/**
	 * @see \fay\models\PropModel::setValue()
	 * @param string $alias
	 * @param mixed $value
	 * @param null|int $user_id 若为null，则默认为当前登录用户
	 * @return bool
	 */
	public function setValue($alias, $value, $user_id = null)
	{
		$user_id || $user_id = \F::app()->current_user;
		return parent::setValue($alias, $value, $user_id);
	}
	
	/**
	 * @see \fay\models\PropModel::getValue()
	 * @param string $alias
	 * @param null|int $user_id 若为null，则默认为当前登录用户
	 * @return mixed
	 */
	public function getValue($alias, $user_id = null)
	{
		$user_id || $user_id = \F::app()->current_user;
		return parent::getValue($alias, $user_id);
	}
	
	/**
	 * 根据用户ID，获取用户对应属性（不带属性值）
	 * @param int $user_id
	 * @return array
	 */
	public function getProps($user_id){
		$role_ids = UserRoleService::service()->getIds($user_id);
		return $this->getByRefer($role_ids);
	}
	
	/**
	 * 新增一个用户属性集
	 * @param int $user_id 用户ID
	 * @param array $data 以属性ID为键的属性键值数组
	 * @param null|array $props 属性。若为null，则根据用户ID获取属性
	 */
	public function createPropertySet($user_id, $data, $props = null){
		if($props === null){
			$props = $this->getProps($user_id);
		}
		parent::createPropertySet($user_id, $props, $data);
	}
	
	/**
	 * 更新一个用户属性集
	 * @param int $user_id 用户ID
	 * @param array $data 以属性ID为键的属性键值数组
	 * @param null|array $props 属性。若为null，则根据用户ID获取属性
	 */
	public function updatePropertySet($user_id, $data, $props = null){
		if($props === null){
			$props = $this->getProps($user_id);
		}
		parent::updatePropertySet($user_id, $props, $data);
	}
	
	/**
	 * @see \fay\models\PropModel::getPropertySet()
	 * @param int $user_id 文章ID
	 * @param null|array $props 属性列表
	 * @return array
	 */
	public function getPropertySet($user_id, $props = null){
		if($props === null){
			$props = $this->getProps($user_id);
		}
		
		return parent::getPropertySet($user_id, $props);
	}
}