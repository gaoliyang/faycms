<?php
namespace fay\widgets\contact\controllers;

use fay\widget\Widget;
use fay\services\Flash;

class AdminController extends Widget{
	public function index($config){
		//获取默认模版
		if(empty($config['template'])){
			$config['template'] = file_get_contents(__DIR__.'/../views/index/template.php');
			$this->form->setData(array(
				'template'=>$config['template'],
			), true);
		}
		
		//默认表单元素
		isset($config['elements']) || $config['elements'] = array(
			'name', 'content', 'mobile',
		);
		
		//默认必选项
		isset($config['required']) || $config['required'] = array(
			'name', 'content', 'mobile',
		);
		
		//默认标签
		isset($config['label']) || $config['label'] = array(
			'name' => '称呼',
			'email' => '邮箱',
			'content' => '内容',
			'mobile' => '电话',
			'title' => '标题',
			'country' => '国家',
		);
		
		//默认占位符
		isset($config['placeholder']) || $config['placeholder'] = $config['label'];
		
		$this->view->assign(array(
			'config'=>$config
		))->render();
	}
	
	public function onPost(){
		$data = $this->form->getFilteredData();
		//格式化必选元素
		$data['required'] = isset($data['required']) ? array_keys($data['required']) : array();
		
		if(isset($data['elements'])){
			//对表单元素进行排序
			$temp_elements = $data['elements'];
			$data['elements'] = array();
			foreach($data['label'] as $element => $label){
				if(in_array($element, $temp_elements)){
					$data['elements'][] = $element;
				}
			}
		}else{
			$data['elements'] = array();
		}
		$this->setConfig($data);
		Flash::set('编辑成功', 'success');
	}
	
	public function rules(){
		return array(
			
		);
	}
	
	public function labels(){
		return array(
			'title'=>'标题',
			'required'=>'必选标识',
			'label'=>'标签',
			'placeholder'=>'占位符',
			'elements'=>'表单元素',
			'require_message'=>'非空报错语',
			'format_message'=>'格式报错语',
		);
	}
	
	public function filters(){
		return array(
			'title'=>'trim',
			'required'=>'intval',
			'label'=>'trim',
			'placeholder'=>'trim',
			'elements'=>'trim',
			'require_message'=>'trim',
			'format_message'=>'trim',
		);
	}
}