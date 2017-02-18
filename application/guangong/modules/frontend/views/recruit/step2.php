<?php
/**
 * @var $this \fay\core\View
 */
$this->appendCss($this->appAssets('css/recruit.css'));
?>
<div class="swiper-container groups">
	<div class="swiper-wrapper">
		<?php $this->renderPartial('_steps')?>
		<div class="swiper-slide" id="recruit-7">
			<div class="layer brand"><img src="<?php echo $this->appAssets('images/recruit/brand.png')?>"></div>
			<div class="layer dadao"><img src="<?php echo $this->appAssets('images/recruit/dadao.png')?>"></div>
			<div class="layer title"><img src="<?php echo $this->appAssets('images/recruit/t2.png')?>"></div>
			<div class="layer description">
				<p>拜祭规则：</p>
				<p>崇信关公忠义精神之三国迷、军事迷、谋略迷及正直青年，诚心加入关羽军团者，请拜关将军。无心者，请止步。</p>
			</div>
		</div>
		<div class="swiper-slide" id="recruit-8">
			<div class="layer brand"><img src="<?php echo $this->appAssets('images/recruit/brand.png')?>"></div>
			<div class="layer guangong"><img src="<?php echo $this->appAssets('images/group/guangong.png')?>"></div>
			<div class="layer steps">
				<a href="javascript:;"><img src="<?php echo $this->appAssets('images/recruit/2-3.png')?>"></a>
				<a href="javascript:;"><img src="<?php echo $this->appAssets('images/recruit/2-2.png')?>"></a>
				<a href="javascript:;"><img src="<?php echo $this->appAssets('images/recruit/2-1.png')?>"></a>
			</div>
			<div class="layer jiangjunshengping">
				<a href="#shengping-dialog" id="shengping-link"><img src="<?php echo $this->appAssets('images/recruit/jiangjunshengping.png')?>"></a>
			</div>
		</div>
		<?php $this->renderPartial('_steps')?>
	</div>
</div>
<script>
$(function(){
	var audio = new Audio("<?php echo $this->appAssets('music/dbe5bd2e67f9a27e623c1e8ed0f5549b.mp3')?>");
	audio.play();
});
</script>
<div class="hide">
	<div id="shengping-dialog" class="dialog">
		<div class="dialog-content">
			<img src="<?php echo $this->appAssets('images/recruit/shengping.png')?>">
		</div>
	</div>
</div>
<?php $this->renderPartial('_js')?>
<link type="text/css" rel="stylesheet" href="<?php echo $this->assets('css/jquery.fancybox-1.3.4.css')?>">
<script type="text/javascript" src="<?php echo $this->assets('js/jquery.fancybox-1.3.4.pack.js')?>"></script>
<script>
	$('#shengping-link').fancybox({
		'type': 'inline',
		'centerOnScroll': true,
		'padding': 0,
		'showCloseButton': false,
		'width': '80%'
	});
</script>