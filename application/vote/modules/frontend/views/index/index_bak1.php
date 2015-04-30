<?php 
use fay\helpers\Html;
use fay\models\File;
use fay\helpers\String;
use fay\helpers\Date;

// dump($lists);
$redis = new Redis();
$redis->connect('redis', 6379, 300);

?> 


<div class="container">
    <div class="row">
        <div class="col-md-3 mt-20">
            <img src="<?php echo $this->staticFile('/img/logo.gif') ?>" width="215" height="37" alt=""/>
        </div>
        <div class="col-md-9">
            <h2 class="text-left"><?php F::widget()->load('index-title') ?></h2>
        </div>
    </div>

    <div class="clear-30"></div>
<p class="fs-16 produce"><?php echo Html::encode($introduce['abstract'])?><a href="<?php echo $this->url('page/'.$introduce['id'])?>" class="btn btn-xs btn-primary">查看详细</a></p>

</div>

<hr width="100%" class="full-left" />

<div class="row">
<div class="row">
    <div class="col-md-8 col-sm-6 col-xs-5 col-xs-offset-1 text-center"></div>
    <div class="col-md-3 col-sm-5 col-xs-5 text-right">
        <h5>
            <?php if (F::app()->session->get('id')){ ?>
                <a href="">用户: <span class="label label-default" data-toggle="tooltip" data-placement="top" title="最后登录时间:<?php echo Date::niceShort(F::app()->session->get('last_login_time')) ?>" >
                <?php echo F::app()->session->get('nickname')?:F::app()->session->get('username'); ?></span> </a>
                <a href="login/logout">退出登录</a>
           <?php }else{ ?>
            <button class="btn btn-sm btn-danger pull-right" data-toggle="modal" data-target="#login-window" >登录进行投票</button>
            <?php } ?>
        </h5>
    </div>
</div>
<div class="clear-10"></div>
<?php

 foreach ($lists as $list ){?>
<div class="col-md-3 col-sm-6 teach-list">
<div class="panel panel-default panel-until">
    
<div class="panel-body">
    <div class="caption">
        <h5><?php echo $list['title']?></h5>
        <p><?php echo $list['abstract']?></p>
       
        <div class="checkbox">
            <label for="data-id-<?php echo $list['id']?>">
                <input type="radio" name="checkout" class="checked" id="data-id-<?php echo $list['id'] ?>" data-id="<?php echo $list['id']?>" />
                <span data-toggle="tooltip" data-placement="top" title="点击选择<?php echo $list['title'] ?>">选择</span>
            </label>
        </div>   
        </p>
    </div>
 </div>   
</div>
</div>

<?php }?>


    <?php if (F::app()->session->get('id')){ ?>
<div class="container">

<!--     <div class="checkbox"> -->
<!--         <label> -->
<!--           <input type="checkbox" id="checkAll"> 全选 -->
<!--         </label> -->
<!--     </div> -->
    <?php
        if ($user_id = F::session()->get('id'))
        {
            if ($redis->exists(getStudentKey($user_id)))
            {
               ?>
               <div class="btn btn-danger form-control" disabled>您已经投过了，只有一次机会的哦</div>
        <?php }else { ?>
            <div class="btn btn-primary form-control" id="vote_submit">完成选择</div>
        <?php } } ?>
   
</div>
    <?php } ?>

</div>

<div class="modal fade" id="login-window" tabindex="-1" role="dialog" aria-labelledby="login-title" aria-hidden="true" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="login-title">登录</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="username">用户名:</label>
                    <input type="text" class="form-control" id="username" name="username" />
                    <p class="help-block">学生为学号，老师为工号</p>
                </div>
                <div class="form-group">
                    <label for="password">密码:</label>
                    <input type="password" name="password" id="password" class="form-control" />
                    <p class="help-block">密码为身份证后6位，或者为12345</p>
                </div>
                <div class="form-group">
                    <label for="vcode">验证码</label>
                    <?php echo F::form()->inputText('vcode', array(
									'class'=>'form-control',
                                    'id' => 'vcode',
                                    'placeholder' => '请输入验证码'
								));
								echo Html::img($this->url('file/vcode', array(
									'w'=>128,
									'h'=>30
								)).'?', 1, array(
									'onClick'=>'this.src=this.src+Math.random()',
									'class'=>'vam mt-10',
								));?>
								<p class="help-block">点击更换验证码</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="login_in">登录</button>
            </div>
        </div>
    </div>
</div>
<hr />

<script src="<?php echo $this->staticFile('js/jquery-check-all.min.js')?>"></script>