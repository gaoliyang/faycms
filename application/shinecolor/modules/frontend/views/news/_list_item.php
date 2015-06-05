<?php
use fay\helpers\Html;
use fay\models\Post;
?>
<li class="disc">
	<a href="<?php echo Post::model()->getLink($data, 'news')?>">
		<time class="fr"><?php echo date('Y-m-d', $data['publish_time'])?></time>
		<span><?php echo Html::encode($data['title'])?></span>
	</a>
</li>