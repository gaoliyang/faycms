<?php
use fay\helpers\Html;
?>
<div class="box" id="widget-<?php echo Html::encode($alias)?>">
	<header class="box-title">
		<?php echo Html::link('More..', array('cat-'.$config['top']), array(
			'class'=>'more',
		))?>
		<h3><span><?php echo Html::encode($config['title'])?></span><em></em></h3>
	</header>
	<div class="box-content">
		<ul class="post-list">
		<?php foreach($posts as $p){?>
			<li><?php
				if(!empty($config['date_format'])){
					echo '<time class="time">', date($config['date_format'], $p['publish_time']), '</time>';
				}
				echo Html::link($p['title'], array(str_replace('{$id}', $p['id'], $config['uri'])));
			?></li>
		<?php }?>
		</ul>
	</div>
</div>