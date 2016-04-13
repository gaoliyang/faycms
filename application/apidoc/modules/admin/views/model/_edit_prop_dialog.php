<?php
use fay\helpers\Html;
use apidoc\models\tables\Inputs;
?>
<div class="hide">
	<div id="edit-prop-dialog" class="dialog">
		<div class="dialog-content w600">
			<h4>编辑模型 - <span class="fc-orange" id="editing-prop-name"></span></h4>
			<form class="prop-form" id="edit-prop-form">
				<input type="hidden" name="selector" />
				<table class="form-table">
					<tr>
						<th class="adaption">名称<em class="required">*</em></th>
						<td><?php echo F::form('prop')->inputText('name', array(
							'class'=>'form-control',
						))?></td>
					</tr>
					<tr>
						<th class="adaption">类型<em class="required">*</em></th>
						<td><?php echo F::form('prop')->select('type', Inputs::getTypes(), array(
							'class'=>'form-control w150 ib',
						), Inputs::TYPE_STRING)?></td>
					</tr>
					<tr>
						<th class="adaption">是否数组<em class="required">*</em></th>
						<td><?php
							echo F::form('prop')->inputRadio('is_array', 1, array(
								'label'=>'是',
							));
							echo F::form('prop')->inputRadio('is_array', 0, array(
								'label'=>'否',
							), true);
						?></td>
					</tr>
					<tr>
						<th class="adaption">描述</th>
						<td><?php echo F::form('prop')->textarea('description', array(
							'class'=>'form-control h60 autosize',
						))?></td>
					</tr>
					<tr>
						<th class="adaption">示例值</th>
						<td><?php echo F::form('prop')->textarea('sample', array(
							'class'=>'form-control h60 autosize',
						))?></td>
					</tr>
					<tr>
						<th class="adaption">自从</th>
						<td><?php echo F::form('prop')->inputText('since', array(
							'class'=>'form-control w150 ib',
						))?></td>
					</tr>
					<tr>
						<th class="adaption"></th>
						<td><?php
							echo Html::link('编辑', 'javascript:;', array(
								'class'=>'btn mr10',
								'id'=>'edit-prop-form-submit',
							));
							echo Html::link('取消', 'javascript:;', array(
								'class'=>'btn btn-grey fancybox-close',
							));
						?></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>