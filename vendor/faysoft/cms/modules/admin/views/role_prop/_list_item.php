<?php
use fay\helpers\HtmlHelper;
use cms\helpers\PropHelper;

/**
 * @var $data array
 */
?>
<tr valign="top">
	<td>
		<strong><?php echo HtmlHelper::encode($data['title'])?></strong>
		<?php if($data['alias']){
			echo "<em> - {$data['alias']}</em>";
		}?>
		<div class="row-actions">
			<?php echo HtmlHelper::link('编辑', array('admin/role-prop/edit', array(
				'id'=>$data['id'],
			) + F::input()->get()))?>
			<?php echo HtmlHelper::link('删除', array('admin/role-prop/delete', array(
				'id'=>$data['id'],
			) + F::input()->get()), array(
				'class'=>'remove-link fc-red',
			))?>
		</div>
	</td>
	<td><?php PropHelper::getElement($data['element'])?></td>
	<td><?php echo $data['required'] ? '是' : '否';?></td>
	<td><?php echo $data['is_show'] ? '<span class="fc-green">是</span>' : '否';?></td>
	<td class="w90"><?php echo HtmlHelper::inputText("sort[{$data['id']}]", $data['sort'], array(
		'size'=>3,
		'maxlength'=>3,
		'data-id'=>$data['id'],
		'class'=>'form-control w50 ib edit-sort w30',
	))?></td>
</tr>