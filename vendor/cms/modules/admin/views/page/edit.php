<?php
use fay\models\tables\Pages;

$enabled_boxes = F::form('setting')->getData('enabled_boxes');
$boxes_cp = $enabled_boxes;//复制一份出来，因为后面会不停的被unset
?>
<?php echo F::form()->open()?>
<div class="poststuff">
	<div class="post-body">
		<div class="post-body-content">
			<div class="post-title-env">
				<?php echo F::form()->inputText('title', array(
					'id'=>'title',
					'class'=>'form-control bigtxt',
					'placeholder'=>'在此键入标题',
				))?>
			</div>
			<div class="postarea">
				<?php echo F::form()->textarea('content', array(
					'id'=>'visual-editor',
					'class'=>'h350',
				))?>
			</div>
		</div>
		<div class="postbox-container-1 dragsort" id="side">
			<div class="box" id="box-operation">
				<div class="box-title">
					<a class="tools toggle" title="点击以切换"></a>
					<h3>操作</h3>
				</div>
				<div class="box-content">
					<div>
						<?php echo F::form()->submitLink('更新', array(
							'class'=>'btn',
						))?>
					</div>
					<div class="misc-pub-section">
						<strong>状态</strong>
						<?php echo F::form()->inputRadio('status', Pages::STATUS_PUBLISHED, array('label'=>'已发布'))?>
						<?php echo F::form()->inputRadio('status', Pages::STATUS_DRAFT, array('label'=>'草稿'))?>
					</div>
				</div>
			</div>
			<?php if(isset($_settings['side'])){
				foreach($_settings['side'] as $box){
					$k = array_search($box, $boxes_cp);
					if($k !== false){
						if(isset(F::app()->boxes[$k]['view'])){
							$this->renderPartial(F::app()->boxes[$k]['view']);
						}else{
							$this->renderPartial('_box_'.str_replace('-', '_', $box));
						}
						unset($boxes_cp[$k]);
					}
				}
			}?>
		</div>
		<div class="postbox-container-2 dragsort"><?php
			if(isset($_settings['normal'])){
				foreach($_settings['normal'] as $box){
					$k = array_search($box, $boxes_cp);
					if($k !== false){
						if(isset(F::app()->boxes[$k]['view'])){
							$this->renderPartial(F::app()->boxes[$k]['view']);
						}else{
							$this->renderPartial('_box_'.str_replace('-', '_', $box));
						}
						unset($boxes_cp[$k]);
					}
				}
			}
				
			//最后多出来的都放最后面
			foreach($boxes_cp as $box){
				if(isset(F::app()->boxes[$k]['view'])){
					$this->renderPartial(F::app()->boxes[$k]['view']);
				}else{
					$this->renderPartial('_box_'.str_replace('-', '_', $box));
				}
			}
		?></div>
	</div>
</div>
<?php echo F::form()->close()?>
<script>
$(function(){
	common.dragsortKey = 'admin_page_box_sort';
	common.filebrowserImageUploadUrl = system.url('admin/file/img-upload', {'t':'pages'});
	common.filebrowserFlashUploadUrl = system.url("admin/file/upload", {'t':'pages'});
	
});
</script>