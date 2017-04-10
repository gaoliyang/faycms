<?php 
use fay\helpers\HtmlHelper;
?>
<header class="g-hd" id="g-hd">
    <div class="w1190">
        <div class="m-logo">
            <a href="<?php echo $this->url()?>"><img src="<?php echo $this->appAssets('images/logo.png')?>" /></a>
        </div>
        <nav class="nav">
            <ul>
                <li><?php echo HtmlHelper::link('首页', array(null), array(
                    'class'=>(empty($current_header_menu) || $current_header_menu == 'index') ? 'crt' : false,
                ))?></li>
                <li><a href="">欣赏</a></li>
                <li><?php echo HtmlHelper::link('博客', array('blog'), array(
                    'class'=>(isset($current_header_menu) && $current_header_menu == 'blog') ? 'crt' : false,
                ))?></li>
                <li><?php echo HtmlHelper::link('素材', array('material'), array(
                    'class'=>(isset($current_header_menu) && $current_header_menu == 'material') ? 'crt' : false,
                ))?></li>
                <li><a href="">网站</a></li>
                <li><a href="">灵感</a></li>
                <li><a href="">创意</a></li>
                <li><a href="">关于</a></li>
            </ul>
        </nav>
        <div class="user-icon" id="g-hdu-links">
            <?php if(\F::session()->get('user.avatar')){
                echo HtmlHelper::img(\F::session()->get('user.avatar'), 2);
            }?>
            <em class="arrow"></em>
            <ul class="sub">
            <?php if($this->current_user){?>
                <li><?php echo HtmlHelper::link('发布作品', array('user/work/create'), array(
                    'class'=>'logout-link',
                    'title'=>false,
                ))?></li>
                <li><?php echo HtmlHelper::link('发布博文', array('user/post/create'), array(
                    'class'=>'logout-link',
                    'title'=>false,
                ))?></li>
                <li><?php echo HtmlHelper::link('上传素材', array('user/material/create'), array(
                    'class'=>'logout-link',
                    'title'=>false,
                ))?></li>
                <li><?php echo HtmlHelper::link('退出', array('user/logout'), array(
                    'class'=>'logout-link',
                    'title'=>false,
                ))?></li>
            <?php }else{?>
                <li><?php echo HtmlHelper::link('登陆', array('login-mini'), array(
                    'class'=>'login-link',
                    'title'=>false,
                ))?></li>
                <li><?php echo HtmlHelper::link('注册', array('register-mini'), array(
                    'class'=>'register-link',
                    'title'=>false,
                ))?></li>
            <?php }?>
            </ul>
        </div>
    </div>
</header>