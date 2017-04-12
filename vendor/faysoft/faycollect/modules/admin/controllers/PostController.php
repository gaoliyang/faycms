<?php
namespace faycollect\modules\admin\controllers;

use cms\library\AdminController;
use cms\models\tables\PostsTable;
use cms\services\CategoryService;
use cms\services\file\RemoteFileService;
use cms\services\post\PostService;
use fay\helpers\RequestHelper;
use fay\helpers\StringHelper;
use fay\validators\UrlValidator;

class PostController extends AdminController{
    /**
     * 简化表单报错处理
     * @param \fay\core\Form $form
     */
    public function onFormError($form){
        $errors = $form->getErrors();
        
        echo $errors[0]['message'];die;
    }
    
    /**
     * 创建文章
     * 专门给采集软件用的文章入库，没有后台编辑那个控制器那么复杂，字段格式检查容错也高一些。
     */
    public function create(){
        if($this->form()->setRules(array(
            array(array('title'), 'required'),
            array(array('status'), 'range', array('range'=>array(
                PostsTable::STATUS_PUBLISHED, PostsTable::STATUS_DRAFT, PostsTable::STATUS_PENDING, PostsTable::STATUS_REVIEWED
            ))),
            array(array('cat_id'), 'exist', array(
                'table'=>'categories',
                'field'=>'id',
            )),
        ))->setLabels(array(
            'title'=>'标题',
            'cat_id'=>'分类',
        ))->setFilters(array(
            'title'=>'trim',
            'content'=>'',
            'thumbnail'=>'trim',
            'publish_time'=>'trim',
            'cat_id'=>'intval', 
            'status'=>'intval',
            'auto_thumbnail'=>'intval',
            'remote'=>'intval',
        ))->check(true)){//这里特殊，先过滤后验证
            $post_id = \faycollect\services\PostService::service()->create(
                array(
                    'title'=>$this->form()->getData('title'),
                    'content'=>$this->form()->getData('content'),
                    'publish_time'=>$this->form()->getData('publish_time'),
                    'cat_id'=>$this->form()->getData('cat_id'),
                    'status'=>$this->form()->getData('status', PostsTable::STATUS_PUBLISHED),
                    'thumbnail'=>$this->form()->getData('thumbnail'),
                ),
                !!$this->form()->getData('auto_thumbnail', 1),
                !!$this->form()->getData('remote', 1)
            );
            echo $post_id ? '发布成功' : '发布失败';
            die;
        }
    }
    
    /**
     * 可用分类列表
     */
    public function cats(){
        $format = $this->input->request('format', 'intval', 'html');
        
        $cats = CategoryService::service()->getTree('_system_post');
        if($format == 'html'){
            //以html select标签的形式输出可用分类
            $this->view->renderPartial('cats', array(
                'cats'=>$cats,
            ));
        }
    }
}