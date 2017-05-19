<?php
namespace cms\models\tables;

use fay\core\db\Table;

/**
 * 角色自定义属性-text
 * 
 * @property int $id Id
 * @property int $user_id 用户ID
 * @property int $prop_id 属性ID
 * @property string $content 属性值
 */
class UserPropTextTable extends Table{
    protected $_name = 'user_prop_text';
    
    /**
     * @param string $class_name
     * @return UserPropTextTable
     */
    public static function model($class_name = __CLASS__){
        return parent::model($class_name);
    }
    
    public function rules(){
        return array(
            array(array('id', 'user_id'), 'int', array('min'=>0, 'max'=>4294967295)),
            array(array('prop_id'), 'int', array('min'=>0, 'max'=>16777215)),
        );
    }

    public function labels(){
        return array(
            'id'=>'Id',
            'user_id'=>'用户ID',
            'prop_id'=>'属性ID',
            'content'=>'属性值',
        );
    }

    public function filters(){
        return array(
            'id'=>'intval',
            'user_id'=>'intval',
            'prop_id'=>'intval',
            'content'=>'',
        );
    }
}