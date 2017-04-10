<?php
/**
 * @var $this \fay\core\View
 * @var $group array
 */
$this->appendCss($this->appAssets('css/group.css'));
?>
<div class="layer u-arrow-right"><img src="<?php echo $this->appAssets('images/btn01_arrow_right.png')?>"></div>
<div class="swiper-container groups">
    <div class="swiper-wrapper">
        <div class="swiper-slide" id="group-21">
            <div class="layer brand"><img src="<?php echo $this->appAssets('images/group/brand.png')?>"></div>
            <div class="layer" id="step">
                <span class="number">第二式</span>
                <span class="title">拜帖</span>
            </div>
            <div class="layer guangong"><img src="<?php echo $this->appAssets('images/group/guangong.png')?>"></div>
            <div class="layer explain">
                <p>使用说明：</p>
                <p>发起者输入姓名在本系统关公点兵网络军籍档案获取个人信息，其他结义者依次进行，按提交结义人数完成拜帖信息获取，由发起者履行排序程序。</p>
            </div>
        </div>
        <div class="swiper-slide" id="group-22">
            <div class="layer brand"><img src="<?php echo $this->appAssets('images/group/brand.png')?>"></div>
            <div class="layer subtitle">
                <span class="title">拜帖</span>
                <span>第二式</span>
            </div>
            <div class="layer left-bottom"><img src="<?php echo $this->appAssets('images/group/lb.png')?>"></div>
            <div class="layer group-name"><h1><?php echo $group['name']?></h1></div>
            <div class="layer user-list users<?php echo $group['count'] - 1?>">
                <?php echo F::form()->open('api/group/add-user')?>
                <?php echo \fay\helpers\HtmlHelper::inputHidden('group_id', $group['id'])?>
                <?php for($i = 1; $i < $group['count']; $i++){?>
                    <fieldset>
                        <div class="avatar"><img src="<?php echo $this->appAssets('images/group/avatar.png')?>"></div>
                        <div class="mobile">
                            <?php echo F::form()->inputText('mobiles[]', array(
                                'class'=>'form-control small',
                                'placeholder'=>'对方手机号',
                            ))?>
                        </div>
                    </fieldset>
                <?php }?>
                <?php echo F::form()->close()?>
            </div>
            <div class="layer actions"><?php echo F::form()->submitLink('拜帖排序', array(
                    'class'=>'btn btn-1',
                ))?></div>
        </div>
    </div>
</div>
<script>
    common.form.afterAjaxSubmit = function(resp){
        if(resp.status){
            window.location.href = '<?php echo $this->url('group/step3', array(
                'group_id'=>$group['id'],
            ))?>';
        }else{
            common.toast(resp.message, 'error');
        }
    }
</script>