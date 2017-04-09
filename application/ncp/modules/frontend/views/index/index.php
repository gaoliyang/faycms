<?php
use fay\helpers\HtmlHelper;
use ncp\helpers\FriendlyLink;
use cms\services\file\FileService;
$this->appendCss($this->appAssets('css/index.css'));
?>

<div class="container">
    <div class="m mt10">
        <?php F::widget()->load('index-top-slides')?>
        <div class="adv_r fr">
            <?php F::widget()->load('index-top-ad-1')?>
            <?php F::widget()->load('index-top-ad-2')?>
            <?php F::widget()->load('index-top-ad-3')?>
        </div>
    </div>
    <div class="m mt10">
        <div class="J_meishi">
            <ul class="region">
            <?php foreach($products as $k => $v){
                $top_post = array_shift($v);
                ?>
                <li class="s">
                    <?php echo HtmlHelper::link(HtmlHelper::img($top_post['thumbnail'], FileService::PIC_RESIZE, array(
                        'dw'=>386,
                        'dh'=>272,
                        'alt'=>HtmlHelper::encode($top_post['title']),
                    )), FriendlyLink::getProductLink(array(
                        'id'=>$top_post['id'],
                    )), array(
                        'title'=>HtmlHelper::encode($top_post['title']),
                        'encode'=>false,
                    ))?>
                    <div class="con-box">
                        <a class="desc" href="<?php echo FriendlyLink::getProductLink(array(
                            'id'=>$top_post['id'],
                        ))?>">
                            <p class="title"><?php echo HtmlHelper::encode($top_post['title'])?></p>
                            <p class="sub-title"><?php echo HtmlHelper::encode($top_post['abstract'])?></p>
                        </a>
                        <div class="foods">
                            <ul class="clearfix">
                            <?php foreach($v as $p){?>
                                <li class="f-item fl"><?php echo HtmlHelper::link("<span>{$p['title']}</span>", FriendlyLink::getProductLink(array(
                                    'id'=>$p['id'],
                                )), array(
                                    'target'=>'_blank',
                                    'encode'=>false,
                                    'title'=>HtmlHelper::encode($p['title']),
                                ))?></li>
                            <?php }?>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php }?>
            </ul>
        </div>
    </div>
    <div class="m m_3 mt10">
        <div class="topic tabs">
            <div class="topic_hd">
                <h2>
                    <?php echo HtmlHelper::link('农旅游', array('product'), array(
                        'target'=>'_blank',
                    ))?>
                </h2>
                <h3 class="J_tabs">
                    <?php foreach($areas as $k => $a){
                        echo HtmlHelper::link($a['title'], '#', array(
                            'class'=>!$k ? 'cur' : false,
                        ));
                    }?>
                </h3>
            </div>
            <div class="topic_info J_tab_infos">
            <?php foreach($travels as $t){?>
                <div>
                    <ul>
                    <?php foreach($t['top'] as $p){?>
                        <li>
                            <div class="j_img">
                                <?php echo HtmlHelper::link(HtmlHelper::img($p['thumbnail'], FileService::PIC_RESIZE, array(
                                    'dw'=>239,
                                    'dh'=>140,
                                    'alt'=>HtmlHelper::encode($p['title']),
                                )), FriendlyLink::getTravelLink(array(
                                    'id'=>$p['id'],
                                )), array(
                                    'title'=>HtmlHelper::encode($p['title']),
                                    'encode'=>false,
                                ))?>
                            </div>
                            <div class="j_name">
                                <?php echo HtmlHelper::link($p['title'], FriendlyLink::getTravelLink(array(
                                    'id'=>$p['id'],
                                )), array(
                                    'target'=>'_blank',
                                ))?>
                            </div>
                            <div class="j_info">
                                <?php echo $p['abstract'], HtmlHelper::link('详细', FriendlyLink::getTravelLink(array(
                                    'id'=>$p['id'],
                                )), array(
                                    'target'=>'_blank',
                                ))?>
                            </div>
                        </li>
                    <?php }?>
                    </ul>
                    <div class="side">
                        <h3>旅游推荐</h3>
                        <ul>
                        <?php foreach($t['recommend'] as $p){
                            echo HtmlHelper::link($p['title'], FriendlyLink::getTravelLink(array(
                                'id'=>$p['id'],
                            )), array(
                                'target'=>'_blank',
                                'wrapper'=>'li',
                            ));
                        }?>
                        </ul>
                    </div>
                </div>
            <?php }?>
            </div>
        </div>
    </div>
    <div class="m m_3 mt10">
        <div class="topic meishi">
            <div class="topic_hd">
                <h2>
                    <?php echo HtmlHelper::link('地方美食', array('food'), array(
                        'target'=>'_blank',
                    ))?>
                </h2>
                <h3 class="city-box m_tabs">
                    <?php foreach($areas as $k => $a){
                        echo HtmlHelper::link($a['title'], '#', array(
                            'class'=>!$k ? 'cur' : false,
                        ));
                    }?>
                </h3>
            </div>
            <div class="topic_info m_tabs_info">
            <?php foreach($foods as $f){?>
                <div>
                    <ul>
                    <?php foreach($f as $p){?>
                        <li>
                            <div class="j_img">
                                <?php echo HtmlHelper::link(HtmlHelper::img($p['thumbnail'], FileService::PIC_RESIZE, array(
                                    'dw'=>239,
                                    'dh'=>140,
                                    'alt'=>HtmlHelper::encode($p['title']),
                                )), FriendlyLink::getFoodLink(array(
                                    'id'=>$p['id'],
                                )), array(
                                    'title'=>HtmlHelper::encode($p['title']),
                                    'encode'=>false,
                                ))?>
                            </div>
                            <div class="j_name">
                                <?php echo HtmlHelper::link($p['title'], FriendlyLink::getFoodLink(array(
                                    'id'=>$p['id'],
                                )))?>
                            </div>
                        </li>
                    <?php }?>
                    </ul>
                </div>
            <?php }?>
            </div>
        </div>
        <div class="k_adv">
            <?php F::widget()->load('index-bottom-ad-1')?>
            <?php F::widget()->load('index-bottom-ad-2')?>
        </div>
        <div class="f_special">
            <?php F::widget()->load('index-bottom-special')?>
        </div>
    </div>
</div>

<?php F::widget()->load('index-friendlinks')?>