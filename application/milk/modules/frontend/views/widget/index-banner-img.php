<?php 
use fay\helpers\Html;
use fay\models\File;

?>
  
  <div class="banner-box">
	<div class="bd">
        <ul>        
        <?php foreach ($files as $f){?>  	    
            <li>
                <div class="m-width">
                <a href="javascript:void(0);"><?php echo Html::img($f['file_id'], File::PIC_ORIGINAL, array('width'=>'100%'))?></a>
                </div>
            </li>
            <?php }?>
       
         
        </ul>
    </div>
    <div class="banner-btn">
        <a class="prev" href="javascript:void(0);"></a>
        <a class="next" href="javascript:void(0);"></a>
        <div class="hd"><ul></ul></div>
    </div>
</div><!-- #slider_body -->
  