<div class="row">
	<div class="col-5">
		<?php echo F::form()->open()?>
			<?php $this->renderPartial('_edit_panel')?>
			<div class="form-field">
				<?php echo F::form()->submitLink('提交', array(
					'class'=>'btn',
				))?>
			</div>
		<?php echo F::form()->close()?>
	</div>
	<div class="col-7">
		<?php $this->renderPartial('_right')?>
	</div>
</div>