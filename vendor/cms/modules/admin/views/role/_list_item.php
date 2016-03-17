<?php
use fay\helpers\Html;
use fay\models\tables\Users;
?>
<tr valign="top" id="role-<?php echo $data['id']?>">
	<td>
		<strong>
			<?php echo $data['title']?>
		</strong>
		<div class="row-actions">
		<?php 
			//非管理员用户没有权限
			echo Html::link('编辑', array('admin/role/edit', array(
				'id'=>$data['id'],
			)), array(), true);
			echo Html::link('附加属性', array('admin/role-prop/index', array(
				'role_id'=>$data['id'],
			)), array(), true);
			//普通用户不能删除
			echo Html::link('删除', array('admin/role/delete', array(
				'id'=>$data['id'],
			)), array(
				'class'=>'fc-red remove-link',
			), true);
		?>
		</div>
	</td>
	<td><?php if($data['admin']){
		echo '管理员';
	}else{
		echo '<span class="fc-green">用户</span>';
	}?></td>
	<td><?php echo Html::encode($data['description'])?></td>
</tr>