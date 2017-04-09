<?php
namespace church\library;

use fay\core\Controller;
use fay\helpers\RequestHelper;
use fay\models\tables\SpiderLogsTable;

class FrontController extends Controller{
    public $layout_template = 'frontend';
    
    public function __construct(){
        parent::__construct();
        
        $this->layout->assign(array(
            'show_banner'=>true,
            'page_title'=>'',
        ));
        
        if($spider = RequestHelper::isSpider()){//如果是蜘蛛，记录蜘蛛日志
            SpiderLogsTable::model()->insert(array(
                'spider'=>$spider,
                'url'=>'http://'.(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']).$_SERVER['REQUEST_URI'],
                'user_agent'=>isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
                'ip_int'=>RequestHelper::ip2int($this->ip),
                'create_time'=>$this->current_time,
            ));
        }
    }
}