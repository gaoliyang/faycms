<?php
return array(
	'after_controller_constructor'=>array(
		//Controller实例化后执行
		array(
			'router'=>'/^(admin)\/.*$/i',
			'function'=>function(){
				if(method_exists(\F::app(), 'removeMenuTeam')){
					\F::app()->removeMenuTeam('goods');
					\F::app()->removeMenuTeam('voucher');
					\F::app()->removeMenuTeam('notification');
					\F::app()->removeMenuTeam('message');
					\F::app()->removeMenuTeam('template');
					\F::app()->removeMenuTeam('exam-question');
					\F::app()->removeMenuTeam('exam-paper');
				}
			},
		),
		array(
			'router'=>'/^admin\/post\/(create|edit|index).*$/i',
			'function'=>function(){
				\F::app()->removeBox('alias');
				\F::app()->removeBox('tags');
				\F::app()->removeBox('files');
				\F::app()->removeBox('keywords');
				\F::app()->removeBox('category');
				\F::app()->removeBox('likes');
				\F::app()->removeBox('gather');
			},
		),
	),
);