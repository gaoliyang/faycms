<?php
use fay\helpers\HtmlHelper;
use fay\services\file\FileService;

/**
 * @var $widget
 * @var $posts array
 */
?>
<div class="widget posts">
    <h3><?php echo $widget->config['title']?></h3>
    <ul><?php foreach($posts as $p){?>
        <li>
            <?php if($p['post']['thumbnail']['id']){
                echo HtmlHelper::link(HtmlHelper::img($p['post']['thumbnail']['id'], FileService::PIC_RESIZE, array(
                    'dw'=>150,
                    'dh'=>115,
                    'alt'=>HtmlHelper::encode($p['post']['title']),
                )), $p['post']['link'], array(
                    'encode'=>false,
                    'title'=>HtmlHelper::encode($p['post']['title']),
                ));
            }?>
            <h5><?php echo HtmlHelper::link($p['post']['title'], $p['post']['link'])?></h5>
            <span><?php echo $p['post']['format_publish_time']?> / <span class="fc-red"><?php echo $p['meta']['views']?> Views</span></span>
        </li>
    <?php }?></ul>
</div>