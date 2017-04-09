<?php
namespace doc\modules\frontend\controllers;

use doc\library\FrontController;
use fay\core\Sql;
use fay\services\post\PostService;
use fay\services\OptionService;

class IndexController extends FrontController{
    public function index(){
        $this->layout->title = OptionService::get('site:sitename');
        $this->layout->page_title = OptionService::get('site:sitename');
        
        $sql = new Sql();
        $sql->from(array('p'=>'posts'), 'cat_id')
            ->joinLeft(array('c'=>'categories'), 'p.cat_id = c.id', 'alias,title,description')
            ->order('update_time DESC')
            ->limit(20)
            ->group('p.cat_id')
        ;
        $this->view->last_modified_cats = $sql->fetchAll();
        
        $this->view->assign(array(
            'posts'=>\fay\services\post\CategoryService::service()->getPosts('fayfox', 0, 'id,title,content,content_type', false, 'is_top DESC, sort, publish_time ASC'),
        ))->render();
    }
    
}