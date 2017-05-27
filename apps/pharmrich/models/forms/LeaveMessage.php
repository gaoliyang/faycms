<?php
namespace pharmrich\models\forms;

use fay\core\Loader;
use fay\core\Model;

class LeaveMessage extends Model{
    /**
     * @return LeaveMessage
     */
    public static function model(){
        return Loader::singleton(__CLASS__);
    }
    
    public function rules(){
        return array(
            array(array('name', 'email', 'subject', 'message'), 'required', array(
                'message'=>'{$attribute} can not be empty!'
            )),
            array('email', 'email', array(
                'message'=>'{$attribute} is not a valid email!'
            )),
        );
    }

    public function labels(){
        return array(
            'name'=>'Name',
            'email'=>'Email',
            'subject'=>'Subject',
            'message'=>'Message',
        );
    }

    public function filters(){
        return array(
            'name'=>'trim',
            'email'=>'trim',
            'subject'=>'trim',
            'message'=>'trim',
        );
    }
}