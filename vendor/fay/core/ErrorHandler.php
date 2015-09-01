<?php
namespace fay\core;

class ErrorHandler{
	public $app;
	
	public function __construct(){
		$this->app = \F::app();
		$this->app || $this->app = new Controller();
	}
	
	/**
	 * 接管PHP自带报错
	 */
	public function register(){
		ini_set('display_errors', false);
		set_exception_handler(array($this, 'handleException'));
		set_error_handler(array($this, 'handleError'));
		register_shutdown_function(array($this, 'handleFatalError'));
	}
	
	/**
	 * 处理未捕获的异常
	 * @param ErrorException|Exception|HttpException $exception
	 */
	public function handleException($exception){
		if($exception instanceof HttpException){
			//Http异常
			Response::setStatusHeader($exception->statusCode);
			//404, 500等http错误
			if(\F::config()->get('environment') == 'production'){
				if($exception->statusCode == 404){
					$this->render404();
				}else{
					$this->render500($exception->getMessage());
				}
			}else{
				//环境非production，显示debug页面
				$this->renderDebug($exception);
			}
		}else{
			if(\F::config()->get('environment') == 'production'){
				$this->render500($exception->getMessage());
			}else{
				$this->renderDebug($exception);
			}
		}
	}
	
	/**
	 * 处理php报错
	 */
	public function handleError($code, $message, $file, $line){
		if(error_reporting() == 0){
			//例如@屏蔽报错的时候，error_reporting()会返回0
			return;
		}
		$exception = new ErrorException($message, '', $code, $file, $line, $code);
		$this->renderPHPError($exception);
	}
	
	/**
	 * 处理致命错误
	 */
	public function handleFatalError(){
		$error = error_get_last();
		
		if(ErrorException::isFatalError($error)){
			Response::setStatusHeader(500);
			
			if(\F::config()->get('environment') == 'production'){
				$this->render500();
			}else{
				$exception = new ErrorException($error['message'], '', $error['type'], $error['file'], $error['line'], $error['type']);
				$this->renderDebug($exception);
			}
			die;
		}
	}
	
	/**
	 * @param ErrorException $exception
	 */
	protected function renderDebug($exception){
		//清空缓冲区
		$this->clearOutput();
		
		$this->app->view->renderPartial('errors/debug', array(
			'exception'=>$exception,
		));
		die;
	}

	/**
	 * @param ErrorException $exception
	 */
	protected function renderPHPError($exception){
		$this->app->view->renderPartial('errors/php', array(
			'level'=>$exception->getLevel(),
			'message'=>$exception->getMessage(),
			'file'=>$exception->getFile(),
			'line'=>$exception->getLine(),
		));
	}
	
	/**
	 * 显示404页面（不包含错误信息）
	 */
	protected function render404(){
		$this->clearOutput();
		$this->app->view->renderPartial('errors/404');
		die;
	}
	
	/**
	 * 显示500页面（不包含错误信息）
	 */
	protected function render500($message = '服务器内部错误'){
		$this->clearOutput();
		$this->app->view->renderPartial('errors/500', array(
			'message'=>$message,
		));
		die;
	}
	
	/**
	 * 清楚所有未输出的缓冲区
	 */
	public function clearOutput()
	{
		for ($level = ob_get_level(); $level > 0; --$level) {
			if (!@ob_end_clean()) {
				ob_clean();
			}
		}
	}
}