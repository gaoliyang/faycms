<?php
use fay\helpers\HtmlHelper;
use cms\services\file\FileService;
?>
<div class="page-title">
    <h1><?php echo HtmlHelper::encode($post['post']['title'])?></h1>
</div>
<div class="meta">
    <?php echo date('d M Y', $post['post']['publish_time'])?>
    /
    <span class="fc-red"><?php echo $post['meta']['views']?> Views</span>
    /
    <?php echo HtmlHelper::link($post['category']['title'], array('product/' . $post['category']['alias']))?>
</div>
<div class="page-content cf"><?php echo $post['post']['content']?></div>
<?php if($post['files']){?>
    <h6>PHOTO GALLERY</h6>
    <ul class="post-gallery">
    <?php foreach($post['files'] as $f){?>
        <?php if(!$f['is_image'])continue;//不是图片无法显示，直接跳过?>
        <li>
            <a href="<?php echo $f['url']?>" data-lightbox="products" title="<?php echo HtmlHelper::encode($f['description'])?>">
                <span class="item-on-hover"><span class="hover-image"></span></span>
                <?php echo HtmlHelper::img($f['id'], FileService::PIC_RESIZE, array(
                    'dw'=>200,
                    'dh'=>200,
                    'alt'=>HtmlHelper::encode($f['description']),
                ))?>
            </a>
        </li>
    <?php }?>
    </ul>
<?php }?>