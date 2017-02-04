<?php
namespace guangong\modules\api\controllers;

use cms\library\ApiController;
use fay\core\Response;
use guangong\services\TaskService;

class TaskController extends ApiController{
	/**
	 * 做任务（不做验证，只要用户提交过来，就当成功了）
	 * @parameter int $task_id
	 */
	public function doAction(){
		$this->checkLogin();
		//表单验证
		$this->form()->setRules(array(
			array(array('task_id'), 'required'),
			array(array('task_id'), 'int', array('min'=>1)),
			array(array('task_id'), 'exist', array(
				'table'=>'guangong_tasks',
				'field'=>'id',
			)),
		))->setFilters(array(
			'id'=>'intval',
		))->setLabels(array(
			'id'=>'任务ID',
		))->check();
		
		$result = TaskService::service()->done($this->form()->getData('task_id'));
		if($result){
			Response::notify('success', '任务完成');
		}else{
			//任务失败可能是重复调用什么的，不重要，不返回错误描述
			Response::notify('error', '');
		}
	}
}