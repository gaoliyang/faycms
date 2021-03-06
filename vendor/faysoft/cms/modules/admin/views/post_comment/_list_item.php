<?php
use fay\helpers\HtmlHelper;
use fay\helpers\DateHelper;
use fay\models\tables\PostCommentsTable;
use cms\helpers\PostCommentHelper;
use fay\helpers\StringHelper;
?>
<tr valign="top" id="message-<?php echo $data['id']?>">
	<td><?php echo HtmlHelper::inputCheckbox('ids[]', $data['id'], false, array(
		'class'=>'batch-ids',
	));?></td>
	<?php if(in_array('id', $cols)){?>
		<td><?php echo $data['id']?></td>
	<?php }?>
	<td>
		<?php echo HtmlHelper::encode($data['content'])?>
		<div class="row-actions">
			<?php if(!$data['deleted']){
				if($data['status'] == PostCommentsTable::STATUS_PENDING){
					echo HtmlHelper::link('批准', array('admin/post-comment/approve', array(
						'id'=>$data['id'],
					)), array(
						'class'=>'fc-green',
					));
					echo HtmlHelper::link('驳回', array('admin/post-comment/disapprove', array(
						'id'=>$data['id'],
					)), array(
						'class'=>'fc-orange',
					));
				}else if($data['status'] == PostCommentsTable::STATUS_APPROVED){
					echo HtmlHelper::link('驳回', array('admin/post-comment/disapprove', array(
							'id'=>$data['id'],
					)), array(
							'class'=>'fc-orange',
					));
				}else if($data['status'] == PostCommentsTable::STATUS_UNAPPROVED){
					echo HtmlHelper::link('批准', array('admin/post-comment/approve', array(
						'id'=>$data['id'],
					)), array(
						'class'=>'fc-green',
					));
				}
			}
			
			if($data['deleted']){
				echo HtmlHelper::link('还原', array('admin/post-comment/undelete', array(
					'id'=>$data['id'],
				)), array(
					'class'=>'fc-green',
				));
				echo HtmlHelper::link('永久删除', array('admin/post-comment/remove', array(
					'id'=>$data['id'],
				)), array(
					'class'=>'remove-link fc-red',
				));
			}else{
				echo HtmlHelper::link('回收站', array('admin/post-comment/delete', array(
					'id'=>$data['id'],
				)), array(
					'class'=>'fc-red',
				));
			}?>
		</div>	
	</td>
	<?php if(in_array('user', $cols)){?>
	<td>
		<?php echo empty($data[$settings['display_name']]) ? '匿名' : HtmlHelper::encode($data[$settings['display_name']]);?>
	</td>
	<?php }?>
	<?php if(in_array('post', $cols)){?>
	<td>
		<?php echo HtmlHelper::link(StringHelper::niceShort($data['post_title'], 40), array('admin/post/edit', array(
			'id'=>$data['post_id'],
		)), array(
			'target'=>'_blank',
			'title'=>HtmlHelper::encode($data['post_title']),
		))?>
	</td>
	<?php }?>
	<?php if(in_array('status', $cols)){?>
	<td><?php echo PostCommentHelper::getStatus($data['status'], $data['deleted']);?></td>
	<?php }?>
	<?php if(in_array('create_time', $cols)){?>
	<td>
		<abbr title="<?php echo DateHelper::format($data['create_time'])?>">
			<?php echo DateHelper::niceShort($data['create_time'])?>
		</abbr>
	</td>
	<?php }?>
</tr>