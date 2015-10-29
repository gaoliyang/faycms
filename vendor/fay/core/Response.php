<?php
namespace fay\core;

use fay\models\Flash;

class Response{
	/**
	 * HTTP状态码
	 */
	public static $httpStatuses = array(
		100 => 'Continue',
		101 => 'Switching Protocols',
		102 => 'Processing',
		118 => 'Connection timed out',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		207 => 'Multi-Status',
		208 => 'Already Reported',
		210 => 'Content Different',
		226 => 'IM Used',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		306 => 'Reserved',
		307 => 'Temporary Redirect',
		308 => 'Permanent Redirect',
		310 => 'Too many Redirect',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Time-out',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested range unsatisfiable',
		417 => 'Expectation failed',
		418 => 'I\'m a teapot',
		422 => 'Unprocessable entity',
		423 => 'Locked',
		424 => 'Method failure',
		425 => 'Unordered Collection',
		426 => 'Upgrade Required',
		428 => 'Precondition Required',
		429 => 'Too Many Requests',
		431 => 'Request Header Fields Too Large',
		449 => 'Retry With',
		450 => 'Blocked by Windows Parental Controls',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway ou Proxy Error',
		503 => 'Service Unavailable',
		504 => 'Gateway Time-out',
		505 => 'HTTP Version not supported',
		507 => 'Insufficient storage',
		508 => 'Loop Detected',
		509 => 'Bandwidth Limit Exceeded',
		510 => 'Not Extended',
		511 => 'Network Authentication Required',
	);

	/**
	 * 发送一个http头
	 * @param int $code
	 * @param string $text
	 */
	public static function setStatusHeader($code = 200, $text = ''){
		if ($code == '' OR ! is_numeric($code)){
			throw new HttpException('Status codes must be numeric', 500);
		}

		if (isset(self::$httpStatuses[$code]) AND $text == ''){
			$text = self::$httpStatuses[$code];
		}

		if ($text == ''){
			throw new HttpException('No status text available.  Please check your status code number or supply your own message text.', 500);
		}

		$server_protocol = (isset($_SERVER['SERVER_PROTOCOL'])) ? $_SERVER['SERVER_PROTOCOL'] : FALSE;

		if (substr(php_sapi_name(), 0, 3) == 'cgi'){
			header("Status: {$code} {$text}", TRUE);
		}elseif ($server_protocol == 'HTTP/1.1' OR $server_protocol == 'HTTP/1.0'){
			header($server_protocol." {$code} {$text}", TRUE, $code);
		}else{
			header("HTTP/1.1 {$code} {$text}", TRUE, $code);
		}
	}

	/**
	 * 页面跳转
	 * @param string $uri
	 * @param array $params
	 */
	public static function redirect($uri = null, $params = array(), $url_rewrite = true){
		if($uri === null){
			header('location:'.\F::app()->view->url(null));
		}else{
			header('location:'.\F::app()->view->url($uri, $params, $url_rewrite));
		}
		die;
	}

	/**
	 * 返回上一页
	 */
	public static function goback(){
		if(isset($_SERVER['HTTP_REFERER'])){
			header('location:'.$_SERVER['HTTP_REFERER']);
		}else{
			echo '<script>history.go(-1);</script>';
		}
		die;
	}

	/**
	 * 在非显示性页面调用此方法输出。
	 * 若为ajax访问，则返回json
	 * 若是浏览器访问，则设置flash后跳转
	 * @param string $status 状态success, error
	 * @param array|string $data
	 * @param bool|array $redirect 跳转地址，若为false且是浏览器访问，则返回上一页
	 */
	public static function output($status = 'error', $data = array(), $redirect = false){
		if(!is_array($data)){
			$data = array(
				'message'=>$data,
			);
		}
		if(\F::app()->input->isAjaxRequest()){
			Response::json(isset($data['data']) ? $data['data'] : '', $status == 'success' ? 1 : 0, isset($data['message']) ? $data['message'] : '', $data['code'] ? $data['code'] : '');
		}else{
			if(!empty($data['message'])){
				//若设置了空 的message，则不发flash
				Flash::set($data['message'], $status);
			}else if($status == 'success'){
				Flash::set('操作成功', $status);
			}else{
				Flash::set('操作失败', $status);
			}

			if($redirect === false){
				self::goback();
			}else{
				if(is_array($redirect)){
					$redirect = \F::app()->view->url($redirect[0],
						empty($redirect[1]) ? array() : $redirect[1],
						isset($redirect[2]) && $redirect[2] === false ? false : true);
				}
				header('location:'.$redirect);
				die;
			}
		}
	}

	/**
	 * 用一个单页来做信息提示，并在$delay时间后跳转
	 * @param unknown $message 信息
	 * @param number $delay 停留时间
	 * @param string $redirect 跳转的url，默认为回到上一页
	 */
	public static function jump($message, $status = 'success', $redirect = false, $delay = 3){
		if(!$redirect && !empty($_SERVER['HTTP_REFERER'])){
			$redirect = $_SERVER['HTTP_REFERER'];
		}
		\F::app()->view->renderPartial('common/jump', array(
			'redirect'=>$redirect,
			'status'=>$status,
			'message'=>$message,
			'delay'=>$delay,
		));
		die;
	}

	/**
	 * 带layout显示一个404页面
	 */
	public static function show404(){
		self::setStatusHeader(404);
		\F::app()->view->render('common/404');
		die;
	}
	
	/**
	 * 返回json
	 * @param mix $content 内容部分
	 * @param int $status 1代表成功，0代表失败。（无其它状态，错误描述放$error_code）
	 * @param string $message 错误描述。人类可读的描述，一般用于弹窗报错，例如：用户名不能为空！
	 * @param string $code 错误码。用有意义的英文描述组成，但不是给人看的，是给程序确定错误用的。例如：username:can-not-be-empty
	 */
	public static function json($data = '', $status = 1, $message = '', $code = ''){
		header('Content-Type:application/json; charset=utf-8');
		$content = json_encode(array(
			'status'=>$status == 0 ? 0 : 1,
			'data'=>$data,
			'code'=>$code,
			'message'=>$message
		));
		self::send($content);
		die;
	}

	/**
	 * 返回jsonp
	 * @param string $func jsonp请求的回调函数名，在调用的地方，从请求中获取，例如jquery发送的请求：$func = $this->input->get('callback');！
	 * @param mix $content 内容部分
	 * @param int $status 1代表成功，0代表失败。（无其它状态，错误描述放$error_code）
	 * @param string $message 错误描述。人类可读的描述，一般用于弹窗报错，例如：用户名不能为空！
	 * @param string $code 错误码。用有意义的英文描述组成，但不是给人看的，是给程序确定错误用的。例如：username:can-not-be-empty
	 */
	public static function jsonp($func, $content, $status = 1, $message = '', $code = ''){
		// 返回JSON数据格式到客户端 包含状态信息
		header('Content-Type:application/json; charset=utf-8');
		$content = $func.'('.json_encode(array(
			'status'=>$status == 0 ? 0 : 1,
			'content'=>$content,
			'code'=>$code,
			'message'=>$message
		)).');';
		self::send($content);
		die;
	}
	
	/**
	 * 向浏览器输出
	 * @param string $content
	 */
	public static function send($content){
		$uri = Uri::getInstance();
		
		//根据router设置缓存
		$cache_routers = \F::config()->get('*', 'pagecache');
		$cache_routers_keys = array_keys($cache_routers);
		if(in_array($uri->router, $cache_routers_keys)){
			$filename = md5(json_encode(\F::input()->get(isset($cache_routers[$uri->router]['params']) ? $cache_routers[$uri->router]['params'] : array())));
			$cache_key = 'pages/' . $uri->router . '/' . $filename;
			if(\F::input()->post()){
				//有post数据的时候，是否更新页面
				if(isset($cache_routers[$uri->router]['on_post'])){
					if($cache_routers[$uri->router]['on_post'] == 'rebuild'){//刷新缓存
						\F::cache()->set($cache_key, $content, $cache_routers[$uri->router]['ttl']);
					}else if($cache_routers[$uri->router]['on_post'] == 'remove'){//删除缓存
						\F::cache()->delete($cache_key);
					}
				}
			}else{
				//没post数据的时候，直接重新生成页面缓存
				\F::cache()->set($cache_key, $content, $cache_routers[$uri->router]['ttl']);
			}
		}
		
		echo $content;
	}
}