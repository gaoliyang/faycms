<?php
use fay\helpers\HtmlHelper;
use fay\helpers\DateHelper;
?>
<tr valign="top">
	<td>
		<strong><?php echo HtmlHelper::encode($data['name'])?></strong>
		<div class="row-actions">
			<?php 
				echo HtmlHelper::link('编辑', array('admin/model/edit', array(
					'id'=>$data['id'],
				)), array(), true);
				echo HtmlHelper::link('删除', array('admin/model/remove', array(
					'id'=>$data['id'],
				)), array(
					'class'=>'fc-red remove-link',
				), true);
			?>
		</div>
	</td>
	<td><?php echo HtmlHelper::encode($data['description']);?></td>
	<td><?php echo HtmlHelper::encode($data['since']);?></td>
	<td><abbr class="time" title="<?php echo DateHelper::format($data['create_time'])?>">
		<?php echo DateHelper::niceShort($data['create_time'])?>
	</abbr></td>
	<td><abbr class="time" title="<?php echo DateHelper::format($data['last_modified_time'])?>">
		<?php echo DateHelper::niceShort($data['last_modified_time'])?>
	</abbr></td>
</tr>