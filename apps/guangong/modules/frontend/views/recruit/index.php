<?php
/**
 * @var $this \fay\core\View
 * @var $user_extra array
 * @var $states array
 * @var $arm array
 * @var $access_token string
 * @var $js_sdk_config array
 */
$this->appendCss($this->appAssets('css/recruit.css'));
$this->appendCss($this->assets('css/font-awesome.css'));
?>
<div class="layer u-arrow-right"><img src="<?php echo $this->appAssets('images/btn01_arrow_right.png')?>"></div>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide" id="recruit-1"></div>
        <div class="swiper-slide" id="recruit-2">
            <div class="layer text"><img src="<?php echo $this->appAssets('images/recruit/2.png')?>"></div>
        </div>
        <?php echo $this->renderPartial('_steps')?>
        <?php echo $this->renderPartial('_step1')?>
        <?php echo $this->renderPartial('_step2')?>
        <?php echo $this->renderPartial('_step3', array(
            'user'=>$user,
            'user_extra'=>$user_extra,
            'states'=>$states,
            'js_sdk_config'=>$js_sdk_config,
            'access_token'=>$access_token,
        ))?>
        <?php echo $this->renderPartial('_step4', array(
            'user'=>$user,
            'arm'=>$arm,
            'user_extra'=>$user_extra,
        ))?>
    </div>
</div>
<?php echo $this->renderPartial('_js')?>