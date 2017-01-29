<?php
namespace fay\services\oauth;

abstract class AccessTokenAbstract{
	/**
	 * 应用ID
	 */
	protected $app_id;
	
	/**
	 * 其他参数
	 */
	protected $params;
	
	/**
	 * @param string $app_id 应用ID
	 * @param array $params 其他参数
	 */
	public function __construct($app_id, $params){
		$this->app_id = $app_id;
		
		$this->params = empty($params) ? array() : $params;
	}
	
	/**
	 * 获取应用ID
	 * @return string
	 */
	public function getAppId(){
		return $this->app_id;
	}
	
	/**
	 * 获取openId
	 * QQ、微信、微博字段名都叫openid，如果某些奇怪的第三方取了别的名字，可在子类中重写此方法。
	 * @return array
	 */
	public function getOpenId(){
		return $this->params['openid'];
	}
	
	/**
	 * 拉取用户信息
	 * @return array
	 */
	abstract public function getUser();
	
	/**
	 * 刷新access_token
	 * @return $this
	 */
	abstract public function refresh();
	
	/**
	 * 检验授权凭证（access_token）是否有效
	 * @return bool
	 */
	abstract public function check();
}