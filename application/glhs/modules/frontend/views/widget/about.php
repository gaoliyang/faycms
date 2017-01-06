<?php
use fay\helpers\HtmlHelper;
use fay\helpers\StringHelper;
?>
<h2 class="sub-title">ABOUT US</h2>
<div class="box">
	<h3 class="box-title">
		<span><?php echo HtmlHelper::encode($page['title'])?></span>
	</h3>
	<div class="box-content">
		<?php echo StringHelper::nl2p(HtmlHelper::encode($page['abstract']))?>
		<?php echo HtmlHelper::link('+MORE', array($page['alias']), array(
			'class'=>'more-link',
		))?>
	</div>
</div>