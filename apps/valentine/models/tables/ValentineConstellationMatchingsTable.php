<?php
namespace valentine\models\tables;

use fay\core\db\Table;

/**
 * 星座配对系数表
 * 
 * @property int $id Id
 * @property int $constellation_id 星座ID
 * @property int $match_constellation_id 匹配星座ID
 * @property int $score 得分
 */
class ValentineConstellationMatchingsTable extends Table{
    protected $_name = 'valentine_constellation_matchings';
    
    /**
     * @param string $class_name
     * @return ValentineConstellationMatchingsTable
     */
    public static function model($class_name = __CLASS__){
        return parent::model($class_name);
    }
    
    public function rules(){
        return array(
            array(array('id'), 'int', array('min'=>0, 'max'=>65535)),
            array(array('constellation_id', 'match_constellation_id', 'score'), 'int', array('min'=>0, 'max'=>255)),
        );
    }

    public function labels(){
        return array(
            'id'=>'Id',
            'constellation_id'=>'星座ID',
            'match_constellation_id'=>'匹配星座ID',
            'score'=>'得分',
        );
    }

    public function filters(){
        return array(
            'id'=>'intval',
            'constellation_id'=>'intval',
            'match_constellation_id'=>'intval',
            'score'=>'intval',
        );
    }
}