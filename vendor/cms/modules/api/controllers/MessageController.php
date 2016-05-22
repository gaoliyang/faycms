<?php
namespace cms\modules\api\controllers;

use cms\library\ApiController;
use fay\services\Message as MessageService;
use fay\models\Message as MessageModel;
use fay\core\Response;
use fay\models\tables\Posts;
use fay\helpers\FieldHelper;
use fay\core\HttpException;
use fay\models\User;

/**
 * 用户留言
 */
class MessageController extends ApiController{
	/**
	 * 默认返回字段
	 */
	private $default_fields = array(
		'message'=>array(
			'id', 'content', 'parent', 'create_time',
		),
		'user'=>array(
			'id', 'nickname', 'avatar',
		),
		'parent'=>array(
			'message'=>array(
				'id', 'content', 'parent', 'create_time',
			),
			'user'=>array(
				'id', 'nickname', 'avatar',
			),
		),
	);
	
	/**
	 * 可选字段
	 */
	private $allowed_fields = array(
		'message'=>array(
			'id', 'content', 'parent', 'create_time',
		),
		'user'=>array(
			'id', 'username', 'nickname', 'avatar', 'roles'=>array(
				'id', 'title',
			),
		),
		'parent'=>array(
			'message'=>array(
				'id', 'content', 'parent', 'create_time',
			),
			'user'=>array(
				'id', 'username', 'nickname', 'avatar', 'roles'=>array(
					'id', 'title',
				),
			),
		),
	);
	/**
	 * 发表留言
	 * @param int $to_user_id 指定用户
	 * @param string $content 留言内容
	 * @param int $parent 父留言ID
	 */
	public function create(){
		//登录检查
		$this->checkLogin();
		
		//表单验证
		$this->form()->setRules(array(
			array(array('to_user_id', 'content'), 'required'),
			array(array('to_user_id'), 'int', array('min'=>1)),
			array(array('parent'), 'int', array('min'=>0)),
			array(array('parent'), 'exist', array(
				'table'=>'messages',
				'field'=>'id',
				'conditions'=>array('deleted = 0')
			)),
		))->setFilters(array(
			'to_user_id'=>'intval',
			'content'=>'trim',
		))->setLabels(array(
			'to_user_id'=>'指定用户',
			'content'=>'留言内容',
		))->check();
		
		$to_user_id = $this->form()->getData('to_user_id');
		
		if(!User::isUserIdExist($to_user_id)){
			Response::notify('error', array(
				'message'=>'指定用户不存在',
				'code'=>'invalid-parameter:to_user_id-is-not-exist',
			));
		}
		
		$message_id = MessageService::model()->create(
			$to_user_id,
			$this->form()->getData('content'),
			$this->form()->getData('parent', 0)
		);
		
		$message = MessageModel::model()->get($message_id, array(
			'message'=>array(
				'id', 'content', 'parent', 'create_time',
			),
			'user'=>array(
				'id', 'nickname', 'avatar',
			),
			'parent'=>array(
				'message'=>array(
					'id', 'content', 'parent', 'create_time',
				),
				'user'=>array(
					'id', 'nickname', 'avatar',
				),
			),
		));
		
		//格式化一下空数组的问题，保证返回给客户端的数据类型一致
		if(isset($message['parent']['message']) && empty($message['parent']['message'])){
			$message['parent']['message'] = new \stdClass();
		}
		if(isset($message['parent']['user']) && empty($message['parent']['user'])){
			$message['parent']['user'] = new \stdClass();
		}
		
		Response::notify('success', array(
			'message'=>'留言成功',
			'data'=>$message,
		));
	}
	
	/**
	 * 删除留言
	 * @param int $message_id 留言ID
	 */
	public function delete(){
		//登录检查
		$this->checkLogin();
		
		//表单验证
		$this->form()->setRules(array(
			array(array('message_id'), 'required'),
			array(array('message_id'), 'int', array('min'=>1)),
			array(array('message_id'), 'exist', array(
				'table'=>'messages',
				'field'=>'id',
				'conditions'=>array('deleted = 0')
			)),
		))->setFilters(array(
			'message_id'=>'intval',
		))->setLabels(array(
			'message_id'=>'留言ID',
		))->check();
		
		$message_id = $this->form()->getData('message_id');
		
		if(MessageModel::model()->checkPermission($message_id, 'delete')){
			MessageService::model()->delete($message_id);
			Response::notify('success', '留言删除成功');
		}else{
			Response::notify('error', array(
				'message'=>'您无权操作该留言',
				'code'=>'permission-denied',
			));
		}
	}
	
	/**
	 * 从回收站还原留言
	 * @param int $message_id 留言ID
	 */
	public function undelete(){
		//登录检查
		$this->checkLogin();
		
		//表单验证
		$this->form()->setRules(array(
			array(array('message_id'), 'required'),
			array(array('message_id'), 'int', array('min'=>1)),
			array(array('message_id'), 'exist', array(
				'table'=>'messages',
				'field'=>'id',
				'conditions'=>array('deleted != 0')
			)),
		))->setFilters(array(
			'message_id'=>'intval',
		))->setLabels(array(
			'message_id'=>'留言ID',
		))->check();
		
		$message_id = $this->form()->getData('message_id');
		
		if(MessageModel::model()->checkPermission($message_id, 'undelete')){
			MessageService::model()->undelete($message_id);
			Response::notify('success', '留言还原成功');
		}else{
			Response::notify('error', array(
				'message'=>'您无权操作该留言',
				'code'=>'permission-denied',
			));
		}
	}
	
	/**
	 * 编辑留言
	 * @param int $message_id 留言ID
	 * @param string $content 留言内容
	 */
	public function edit(){
		//登录检查
		$this->checkLogin();
		
		//表单验证
		$this->form()->setRules(array(
			array(array('message_id', 'content'), 'required'),
			array(array('message_id'), 'int', array('min'=>1)),
			array(array('message_id'), 'exist', array(
				'table'=>'messages',
				'field'=>'id',
				'conditions'=>array('deleted = 0')
			)),
		))->setFilters(array(
			'to_user_id'=>'intval',
			'content'=>'trim',
		))->setLabels(array(
			'to_user_id'=>'指定用户',
			'content'=>'留言内容',
		))->check();
		
		$message_id = $this->form()->getData('message_id');
		
		if(MessageModel::model()->checkPermission($message_id, 'edit')){
			MessageService::model()->update(
				$message_id,
				$this->form()->getData('content')
			);
			Response::notify('success', '留言修改成功');
		}else{
			Response::notify('error', array(
				'message'=>'您无权操作该留言',
				'code'=>'permission-denied',
			));
		}
	}
	
	/**
	 * 留言列表
	 * @param int $to_user_id 指定用户
	 * @param string $mode 模式
	 * @param string $fields 制定字段
	 * @param int $page 页码
	 * @param int $page_size 分页大小
	 */
	public function listAction(){
		//表单验证
		$this->form()->setRules(array(
			array(array('to_user_id'), 'required'),
			array(array('to_user_id', 'page', 'page_size'), 'int', array('min'=>1)),
			array(array('to_user_id'), 'exist', array(
				'table'=>'posts',
				'field'=>'id',
				'conditions'=>array(
					'deleted = 0',
					'status = '.Posts::STATUS_PUBLISHED,
					'publish_time < '.\F::app()->current_time,
				)
			)),
		))->setFilters(array(
			'to_user_id'=>'intval',
			'page'=>'intval',
			'page_size'=>'intval',
			'mode'=>'trim',
			'fields'=>'trim',
		))->setLabels(array(
			'to_user_id'=>'指定用户',
			'page'=>'页码',
			'page_size'=>'分页大小',
		))->check();
		
		$fields = $this->form()->getData('fields');
		if($fields){
			//过滤字段，移除那些不允许的字段
			$fields = FieldHelper::process($fields, 'message', $this->allowed_fields);
		}else{
			$fields = $this->default_fields;
		}
		
		switch($this->form()->getData('mode')){
			case 'tree':
				Response::json(MessageModel::model()->getTree(
					$this->form()->getData('to_user_id'),
					$this->form()->getData('page_size', 20),
					$this->form()->getData('page', 1),
					$fields
				));
				break;
			case 'chat':
				Response::json(MessageModel::model()->getChats(
					$this->form()->getData('to_user_id'),
					$this->form()->getData('page_size', 20),
					$this->form()->getData('page', 1),
					$fields
				));
				break;
			case 'list':
				$result = MessageModel::model()->getList(
					$this->form()->getData('to_user_id'),
					$this->form()->getData('page_size', 20),
					$this->form()->getData('page', 1),
					$fields
				);
				//将空数组转为空对象，保证给客户端的类型一致
				foreach($result['messages'] as &$r){
					if(isset($r['parent']['message']) && !$r['parent']['message']){
						$r['parent']['message'] = new \stdClass();
					}
					if(isset($r['parent']['user']) && !$r['parent']['user']){
						$r['parent']['user'] = new \stdClass();
					}
				}
				
				Response::json($result);
				break;
		}
	}
	
	public function get(){
		//表单验证
		$this->form()->setRules(array(
			array(array('id'), 'required'),
			array(array('id'), 'int', array('min'=>1)),
		))->setFilters(array(
			'id'=>'intval',
			'fields'=>'trim',
			'cat'=>'trim',
		))->setLabels(array(
			'id'=>'留言ID',
		))->check();
		
		$id = $this->form()->getData('id');
		$fields = $this->form()->getData('fields');
			
		if($fields){
			//过滤字段，移除那些不允许的字段
			$fields = FieldHelper::process($fields, 'post', $this->allowed_fields);
		}else{
			//若未指定$fields，取默认值
			$fields = $this->default_fields;
		}
			
		$message = MessageModel::model()->get($id, $fields);
		
		//处理下空数组问题
		if(isset($message['parent']['message']) && empty($message['parent']['message'])){
			$message['parent']['message'] = new \stdClass();
		}
		if(isset($message['parent']['user']) && empty($message['parent']['user'])){
			$message['parent']['user'] = new \stdClass();
		}
		
		if($message){
			Response::json($message);
		}else{
			throw new HttpException('留言ID不存在');
		}
	}
}