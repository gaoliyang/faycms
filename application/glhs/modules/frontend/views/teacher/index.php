<?php
use fay\services\Option;
use fay\helpers\Html;
use fay\services\File;
use fay\services\Post;
use fay\helpers\StringHelper;
?>
<div class="page-title">
	<div class="container">
		<h1>师资力量</h1>
		<div class="breadcrumbs">
			<ol>
				<li><?php echo Html::link(Option::get('site:sitename'))?></li>
				<li>师资力量</li>
			</ol>
		</div>
	</div>
</div>
<div class="container">
	<div class="page-content">
		<div class="teacher-description"><?php echo StringHelper::nl2p(Html::encode($cat_teacher['description']))?></div>
		<div class="teacher-list">
			<ul class="cf"><?php foreach($teachers as $t){
				echo Html::link(Html::img($t['thumbnail'], File::PIC_RESIZE, array(
					'dw'=>180,
					'dh'=>228,
					'alt'=>Html::encode($t['title']),
					'after'=>array(
						'tag'=>'span',
						'text'=>Html::encode($t['title']),
						'class'=>'name',
					),
				)), 'javascript:;', array(
					'encode'=>false,
					'title'=>Html::encode($t['title']),
					'wrapper'=>array(
						'tag'=>'li',
						'append'=>array(
							'tag'=>'span',
							'text'=>Post::service()->getPropValueByAlias('teacher_job', $t['id']),
							'class'=>'job',
						),
					),
				));
			}?></ul>
		</div>
	</div>
</div>