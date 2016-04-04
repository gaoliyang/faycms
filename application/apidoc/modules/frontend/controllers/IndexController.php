<?php
namespace apidoc\modules\frontend\controllers;

use apidoc\library\FrontController;
use fay\models\Option;

class IndexController extends FrontController{
	public function __construct(){
		parent::__construct();
		
		$this->layout->title = Option::get('site:seo_index_title');
		$this->layout->keywords = Option::get('site:seo_index_keywords');
		$this->layout->description = Option::get('site:seo_index_description');
		
		$this->layout->current_directory = 'home';
	}
	
	public function index(){
		$this->view->render();
	}
	
}