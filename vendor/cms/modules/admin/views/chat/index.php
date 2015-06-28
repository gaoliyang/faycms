<?php
use fay\models\tables\Messages;

$settings = F::form('setting')->getAllData();
?>
<div class="row">
	<div class="col-12">
		<ul class="chats-list">
			<?php $listview->showData(array(
				'setting'=>$settings,
			));?>
		</ul>
		<?php $listview->showPager();?>
	</div>
</div>
<div class="hide">
	<div id="chat-dialog" class="dialog w650">
		<div class="">
			<div class="cf cd-header">
				<img src="<?php echo $this->url()?>images/avatar.png" class="circle cd-avatar" />
				<div class="cd-meta">
					<span class="cd-user"></span>
					<i class="fa fa-share"></i>
					<span class="cd-to"></span>
					<div>
						<span class="cd-time"></span>
						<a href="javascript:;" class="reply-link reply-root" data-id="0" data-username="">回复楼主</a>
					</div>
				</div>
				<div class="cd-content"></div>
			</div>
			<div class="cd-reply-list">
				<ul class="cd-timeline"></ul>
			</div>
			<div class="reply-container <?php if(!F::app()->checkPermission('admin/chat/reply'))echo 'hide'?>">
				<form id="reply-form">
					<input type="hidden" name="parent" />
					<input type="hidden" name="target" />
					<textarea name="content" class="p5"></textarea>
					<a href="javascript:;" id="reply-form-submit" class="btn fr mt5 mr10">回复</a>
					<a href="javascript:;" class="btn btn-grey fr fancybox-close mt5 mr10">取消</a>
				</form>
				<br class="clear" />
			</div>
		</div>
	</div>
</div>
<script src="<?php echo $this->url()?>faycms/js/admin/chat.js"></script>
<script>
chat.status = {
	'<?php echo Messages::STATUS_APPROVED?>':'<span class="fc-green">已通过</span>',
	'<?php echo Messages::STATUS_UNAPPROVED?>':'<span class="fc-red">已驳回</span>',
	'<?php echo Messages::STATUS_PENDING?>':'<span class="fc-orange">待审</span>',
	'approved':'<?php echo Messages::STATUS_APPROVED?>',
	'unapproved':'<?php echo Messages::STATUS_UNAPPROVED?>',
	'pending':'<?php echo Messages::STATUS_PENDING?>'
};
chat.display_name = '<?php echo $settings['display_name']?>';
chat.permissions = {
	'approve':<?php echo F::app()->checkPermission('admin/chat/approve') ? 'true' : 'false'?>,
	'unapprove':<?php echo F::app()->checkPermission('admin/chat/unapprove') ? 'true' : 'false'?>,
	'delete':<?php echo F::app()->checkPermission('admin/chat/delete') ? 'true' : 'false'?>,
	'remove':<?php echo F::app()->checkPermission('admin/chat/remove') ? 'true' : 'false'?>,
	'reply':<?php echo F::app()->checkPermission('admin/chat/reply') ? 'true' : 'false'?>
};
chat.init();
</script>