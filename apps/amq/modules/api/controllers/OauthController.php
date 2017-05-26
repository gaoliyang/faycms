<?php
namespace amq\modules\api\controllers;

use cms\library\ApiController;
use fayoauth\services\OauthAppService;

class OauthController extends ApiController{
    public function am(){
        $oauth = OauthAppService::service()->getOauthService('amq');

        $oauth_user = $oauth->getUser();
        dd($oauth_user);
    }
    
    public function test(){
        $oauth = OauthAppService::service()->getOauthService('amq');

        dd($oauth->getUser()->getParams());
    }
}