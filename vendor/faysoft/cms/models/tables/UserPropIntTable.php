<?php
namespace cms\models\tables;

use fay\core\db\Table;

/**
 * 角色自定义属性-int
 * 
 * @property int $id Id
 * @property int $relation_id 用户ID
 * @property int $prop_id 属性ID
 * @property int $content 属性值
 */
class UserPropIntTable extends Table{
    protected $_name = 'user_prop_int';
    
    /**
     * @param string $class_name
     * @return UserPropIntTable
     */
    public static function model($class_name = __CLASS__){
        return parent::model($class_name);
    }
    
    public function rules(){
        return array(
            array(array('id', 'relation_id', 'content'), 'int', array('min'=>0, 'max'=>4294967295)),
            array(array('prop_id'), 'int', array('min'=>0, 'max'=>16777215)),
        );
    }

    public function labels(){
        return array(
            'id'=>'Id',
            'relation_id'=>'用户ID',
            'prop_id'=>'属性ID',
            'content'=>'属性值',
        );
    }

    public function filters(){
        return array(
            'id'=>'intval',
            'relation_id'=>'intval',
            'prop_id'=>'intval',
            'content'=>'intval',
        );
    }
}