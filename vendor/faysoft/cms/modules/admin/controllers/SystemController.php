<?php
namespace cms\modules\admin\controllers;

use cms\library\AdminController;
use fay\models\tables\Users;
use fay\models\Setting as SettingModel;
use fay\services\SettingService;
use fay\core\Response;

class SystemController extends AdminController{
	public function isMoboleExist(){
		if(Users::model()->fetchRow(array(
			'mobile = ?'=>$this->input->post('value', 'trim'),
			'id != ?'=>$this->input->request('id', 'intval')
		))){
			Response::json('', 0, '该手机号码已被注册');
		}else{
			Response::json();
		}
	}
	
	public function isEmailExist(){
		if(Users::model()->fetchRow(array(
			'email = ?'=>$this->input->post('value', 'trim'),
			'id != ?'=>$this->input->request('id', 'intval')
		))){
			Response::json('', 0, '该邮箱已被注册');
		}else{
			Response::json();
		}
	}
	
	public function isUsernameExist(){
		if(Users::model()->fetchRow(array(
			'username = ?'=>$this->input->post('value', 'trim'),
			'id != ?'=>$this->input->request('id', 'intval')
		))){
			Response::json('', 0, '该用户名已被注册');
		}else{
			Response::json();
		}
	}
	
	public function setting(){
		if($this->input->post()){
			if($this->form('setting')
				->setModel(SettingModel::model())
				->check()){
				$data = $this->form('setting')->getAllData();
				$key = $data['_key'];
				unset($data['_key'], $data['_submit']);
				SettingService::service()->set($key, $data);
				Response::notify('success', '设置保存成功');
			}else{
				Response::notify('error', '异常的数据格式');
			}
		}else{
			Response::notify('error', '无数据被提交');
		}
	}
}