<?php
use fay\helpers\Html;
use fay\models\File;
?>
<section class="box" id="<?php echo $alias?>">
	<div class="box-title">
		<h2><?php echo $config['title']?></h2>
		<?php echo Html::link('More', array('news'), array(
			'class'=>'more-link',
		))?>
	</div>
	<div class="box-content">
		<?php foreach($posts as $p){
			if($p['post']['thumbnail']){
				echo Html::link(Html::img($p['post']['thumbnail'], File::PIC_RESIZE, array(
					'dw'=>234,
					'dh'=>165,
					'alt'=>Html::encode($p['post']['title']),
				)), $p['post']['link'], array(
					'encode'=>false,
					'title'=>Html::encode($p['post']['title']),
				));
				break;
			}
		}?>
		<ul>
		<?php foreach($posts as $p){
			echo Html::link($p['post']['title'], $p['post']['link'], array(
				'wrapper'=>'li',
			));
		}?>
		</ul>
	</div>
</section>