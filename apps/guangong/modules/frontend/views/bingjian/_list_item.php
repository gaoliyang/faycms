<?php
/**
 * @var $data array
 */
?>
<a href="<?php echo $this->url('bingjian/item', array(
    'id'=>$data['id']
))?>" class="message-item cf">
    <div class="author">
        <span class="daihao"><?php echo \guangong\helpers\UserHelper::getCode($data['user_id'])?></span>
        <span class="time"><?php echo date('Y年m月d日 H:i', $data['create_time'])?></span>
    </div>
    <div class="content">
        <?php echo \fay\helpers\HtmlHelper::encode($data['title'])?>
    </div>
    <?php if($data['reply']){?>
        <div class="reply">
            关羽军团回复
        </div>
        <div class="reply-content">
            <?php echo \fay\helpers\HtmlHelper::encode($data['reply'])?>
        </div>
    <?php }?>
</a>