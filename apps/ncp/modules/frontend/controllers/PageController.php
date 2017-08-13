<?php
namespace ncp\modules\frontend\controllers;

use fay\core\exceptions\NotFoundHttpException;
use ncp\library\FrontController;
use cms\models\tables\PagesTable;

class PageController extends FrontController{
    public function __construct(){
        parent::__construct();
    }
    
    public function item(){
        if($this->input->get('alias')){
            $page = PagesTable::model()->fetchRow(array('alias = ?'=>$this->input->get('alias')));
        }else if($this->input->get('id')){
            $page = PagesTable::model()->fetchRow(array('id = ?'=>$this->input->get('id', 'intval')));
        }
        
        if(isset($page) && $page){
            PagesTable::model()->incr($page['id'], 'views', 1);
            $this->view->page = $page;
        }else{
            throw new NotFoundHttpException('您请求的页面不存在');
        }

        return $this->view->render();
    }
}