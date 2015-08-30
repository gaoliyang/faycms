<?php
use fay\helpers\Html;
?>
<div class="inner cf">
	<div class="breadcrumbs">
		<?php
		echo Html::link('网站首页', array('')),
			' &gt; ',
			Html::encode($cat['title']);
		?>
	</div>
	<div class="g-sd">
		<div class="cat-list">
			<?php if($left_cats['alias'] != '__root__'){?>
				<h3><?php echo Html::encode($left_cats['title'])?></h3>
			<?php }?>
			<ul>
			<?php foreach($left_cats['children'] as $c){
				echo Html::link($c['title'], array('cat/'.$c['id']), array(
					'wrapper'=>'li',
					'class'=>$c['id'] == $cat['id'] ? 'crt' : false,
				));
			}?>
			</ul>
		</div>
	</div>
	<div class="g-mn">
		<h1 class="sub-title"><?php echo Html::encode($cat['title'])?></h1>
		<ul class="inner-post-list"><?php $listview->showData()?></ul>
		<?php $listview->showPager()?>
	</div>
</div>