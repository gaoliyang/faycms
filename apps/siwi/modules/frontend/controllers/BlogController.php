<?php
namespace siwi\modules\frontend\controllers;

use fay\core\exceptions\NotFoundHttpException;
use siwi\library\FrontController;
use cms\services\CategoryService;
use fay\core\Sql;
use cms\models\tables\PostsTable;
use fay\common\ListView;
use cms\services\post\PostService;
use cms\models\tables\MessagesTable;
use siwi\helpers\FriendlyLink;

class BlogController extends FrontController{
    public function __construct(){
        parent::__construct();
    
        $this->layout->title = '';
        $this->layout->keywords = '';
        $this->layout->description = '';
    
        $this->layout->current_header_menu = 'blog';
    }
    
    public function index(){
        $params = FriendlyLink::getParams();
        $this->view->params = $params;
        if($params['cat_2']){
            $cat = CategoryService::service()->get($params['cat_2']);
        }else if($params['cat_1']){
            $cat = CategoryService::service()->get($params['cat_1']);
        }else{
            $cat = CategoryService::service()->get('_blog', '*');
        }
        $this->view->cat = $cat;
        $this->layout->title = $cat['seo_title'];
        $this->layout->keywords = $cat['seo_keywords'];
        $this->layout->description = $cat['seo_description'];
        
        $sql = new Sql();
        $sql->from(array('p'=>'posts'), 'id,title,abstract,publish_time,thumbnail,comments,user_id')
            ->joinLeft(array('u'=>'users'), 'p.user_id = u.id', 'nickname')
            ->joinLeft(array('c'=>'categories'), 'p.cat_id = c.id')
            ->order('is_top DESC, p.sort, p.publish_time DESC')
            ->where(array(
                'c.left_value >= '.$cat['left_value'],
                'c.right_value <= '.$cat['right_value'],
                'p.delete_time = 0',
                'p.status = '.PostsTable::STATUS_PUBLISHED,
                'p.publish_time < '.$this->current_time,
            ))
        ;
        
        if($params['time']){
            $sql->where('p.publish_time > ' . ($this->current_time - 86400*$params['time']));
        }
        switch($params['time']){
            case 0:
                $this->view->time = '最新发表';
                break;
            case 3:
                $this->view->time = '三天内';
                break;
            case 7:
                $this->view->time = '一周内';
                break;
            case 30:
                $this->view->time = '一个月内';
                break;
            case 365:
                $this->view->time = '一年内';
                break;
        }

        
        $this->view->listview = new ListView($sql, array(
            'reload'=>$this->view->url('blog'),
        ));
        
        $this->view->cat_tree = CategoryService::service()->getTree('_blog');
    
        return $this->view->render();
    }
    
    public function item(){
        $id = $this->input->get('id', 'intval');
        
        $post = PostService::service()->get($id, 'nav,user,files');
        
        if(!$post){
            throw new NotFoundHttpException('页面不存在');
        }
        PostsTable::model()->incr($post['id'], 'views', 1);//阅读数
        $this->view->post = $post;
        
        $this->layout->title = $post['seo_title'];
        $this->layout->keywords = $post['seo_keywords'];
        $this->layout->description = $post['seo_description'];
        
        $sql = new Sql();
        $sql->from(array('m'=>'messages'))
            ->joinLeft(array('u'=>'users'), 'm.user_id = u.id', 'username,nickname,avatar')
            ->joinLeft(array('m2'=>'messages'), 'm.parent = m2.id', 'content AS parent_content,user_id AS parent_user_id,status AS parent_status,delete_time AS parent_delete_time')
            ->joinLeft(array('u2'=>'users'), 'm2.user_id = u2.id', 'nickname AS parent_nickname')
            ->where(array(
                "m.target = {$id}",
                'm.type = '.MessagesTable::TYPE_POST_COMMENT,
                'm.delete_time = 0',
                'm.status = '.MessagesTable::STATUS_APPROVED,
            ))
            ->order('create_time DESC');
        
        if(PostService::service()->isLiked($id)){
            $this->view->liked = true;
        }else{
            $this->view->liked = false;
        }
        
        if(PostService::service()->isFavored($id)){
            $this->view->favored = true;
        }else{
            $this->view->favored = false;
        }
        
        $this->view->listview = new ListView($sql, array(
            'reload'=>$this->view->url('blog/'.$id),
            'item_view'=>'_comment_list_item',
            'page_size'=>10,
        ));
        
        $this->layout->canonical = $this->view->url('blog/'.$post['id']);
        return $this->view->render();
    }
}