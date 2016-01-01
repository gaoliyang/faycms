<?php echo F::form('setting')->open(array('admin/system/setting'))?>
	<?php echo F::form('setting')->inputHidden('_key')?>
	<div class="form-field">
		<label class="title bold">显示下列项目</label>
		<?php
		echo F::form('setting')->inputCheckbox('cols[]', 'id', array(
			'label'=>'评论ID',
		));
		echo F::form('setting')->inputCheckbox('cols[]', 'user', array(
			'label'=>'评论人',
		));
		echo F::form('setting')->inputCheckbox('cols[]', 'post', array(
			'label'=>'评论给',
		));
		echo F::form('setting')->inputCheckbox('cols[]', 'status', array(
			'label'=>'状态',
		));
		echo F::form('setting')->inputCheckbox('cols[]', 'create_time', array(
			'label'=>'评论时间',
		));
		?>
	</div>
	<div class="form-field">
		<label class="title bold">显示用户方式</label>
		<?php
		echo F::form('setting')->inputRadio('display_name', 'username', array(
			'label'=>'用户名',
		), true);
		echo F::form('setting')->inputRadio('display_name', 'nickname', array(
			'label'=>'昵称',
		));
		echo F::form('setting')->inputRadio('display_name', 'realname', array(
			'label'=>'真名',
		));
		?>
	</div>
	<div class="form-field">
		<label class="title bold">分页大小</label>
		<?php echo F::form('setting')->inputNumber('page_size', array(
			'class'=>'form-control w50',
			'min'=>1,
			'max'=>999,
		))?>
	</div>
	<div class="form-field">
		<?php echo F::form('setting')->submitLink('提交', array(
			'class'=>'btn btn-sm',
		))?>
	</div>
<?php echo F::form('setting')->close()?>