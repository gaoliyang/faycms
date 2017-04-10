<?php
namespace glhs\library;

use fay\core\Controller;
use fay\helpers\RequestHelper;
use cms\models\tables\SpiderLogsTable;
use cms\services\CategoryService;

class FrontController extends Controller{
    public $layout_template = 'frontend';
    public $current_user = 0;
    
    public function __construct(){
        parent::__construct();
        
        //设置当前用户id
        $this->current_user = \F::session()->get('user.id', 0);
        
        if($spider = RequestHelper::isSpider()){//如果是蜘蛛，记录蜘蛛日志
            SpiderLogsTable::model()->insert(array(
                'spider'=>$spider,
                'url'=>'http://'.(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']).$_SERVER['REQUEST_URI'],
                'user_agent'=>isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
                'ip_int'=>RequestHelper::ip2int($this->ip),
                'create_time'=>$this->current_time,
            ));
        }
        
        //顶级分类
        $this->layout->cats = CategoryService::service()->getNextLevel('_system_post');
    }
}