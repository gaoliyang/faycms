<?php
namespace fay\services;

use fay\core\Service;
use fay\models\tables\TemplatesTable;

class TemplateService extends Service{
	/**
	 * 算是缓存吧
	 * @var array
	 */
	public $templates = array();
	
	/**
	 * @param string $class_name
	 * @return TemplateService
	 */
	public static function service($class_name = __CLASS__){
		return parent::service($class_name);
	}
	
	public function render($alias, $options = array()){
		if(isset($this->templates[$alias])){
			$msg = $this->templates[$alias];
		}else{
			$msg = TemplatesTable::model()->fetchRow(array(
				'alias = ?'=>$alias,
			));
			$this->templates[$alias] = $msg;
		}
		
		if($msg && $msg['enable']){
			if(!empty($options)){
				foreach ( $options as $key => $value ) {
					$msg['content'] = str_replace ( '{$' . $key . '}', $value, $msg['content'] );
				}
			}
			return $msg;
		}else{
			return false;
		}
	}
	
	public static function getType($type){
		switch($type){
			case TemplatesTable::TYPE_EMAIL:
				return '邮件';
			break;
			case TemplatesTable::TYPE_NOTIFICATION:
				return '站内信';
			break;
			case TemplatesTable::TYPE_SMS:
				return '短信';
			break;
			default:
				return '未知';
			break;
		}
	}
}