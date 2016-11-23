<?php
namespace cms\modules\admin\controllers;

use cms\library\AdminController;
use fay\models\tables\Users;
use fay\models\tables\Actionlogs;
use fay\services\user\Prop;
use fay\services\User;
use fay\models\tables\Roles;
use fay\services\user\Role;
use fay\core\Response;

class ProfileController extends AdminController{
	public function __construct(){
		parent::__construct();
		$this->layout->current_directory = 'profile';
	}
	
	public function index(){
		$this->layout->subtitle = '编辑我的信息';
		$user_id = $this->current_user;
		$this->form()->setModel(Users::model());
		if($this->input->post() && $this->form()->check()){
			//两次密码输入一致
			$data = Users::model()->fillData($this->input->post());
			
			$extra = array(
				'props'=>$this->input->post('props', '', array()),
			);
			
			User::service()->update($user_id, $data, $extra);
			
			$this->actionlog(Actionlogs::TYPE_PROFILE, '编辑了自己的信息', $user_id);
			Response::notify('success', '修改成功', false);
			
			//置空密码字段
			$this->form()->setData(array('password'=>''), true);
		}
		
		$user = User::service()->get($user_id, 'user.*,profile.*');
		$user_role_ids = Role::service()->getIds($user_id);
		$this->view->user = $user;
		$this->form()->setData($user['user'])
			->setData(array('roles'=>$user_role_ids));
		
		$this->view->roles = Roles::model()->fetchAll(array(
			'admin = 1',
			'deleted = 0',
		), 'id,title');
		
		$this->view->prop_set = Prop::service()->getPropertySet($user_id);
		$this->view->render();
	}
}