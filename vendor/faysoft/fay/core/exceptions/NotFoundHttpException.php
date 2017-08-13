<?php
namespace fay\core\exceptions;

/**
 * 404异常
 */
class NotFoundHttpException extends HttpException{
    public function __construct($message = '', \Exception $previous = null, $code = E_USER_ERROR){
        parent::__construct($message, 404, $code, $previous);
    }
}