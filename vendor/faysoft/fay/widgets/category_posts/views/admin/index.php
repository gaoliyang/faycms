<?php
use fay\helpers\HtmlHelper;
use fay\models\tables\RolesTable;
use fay\services\user\UserRoleService;
?>
<div class="box">
	<div class="box-title">
		<h4>配置参数</h4>
	</div>
	<div class="box-content">
		<div class="form-field">
			<label class="title bold">标题</label>
			<?php echo F::form('widget')->inputText('title', array(
				'class'=>'form-control mw400',
			))?>
			<p class="fc-grey">若为空，则显示顶级分类的标题</p>
		</div>
		<div class="form-field">
			<label class="title bold">分类</label>
			<?php echo F::form('widget')->select('cat_id', HtmlHelper::getSelectOptions($cats), array(
				'class'=>'form-control mw400',
			))?>
		</div>
		<div class="form-field">
			<label class="title bold">是否包含子分类下的文章</label>
			<?php echo F::form('widget')->inputRadio('subclassification', 1, array(
				'label'=>'是',
			), true)?>
			<?php echo F::form('widget')->inputRadio('subclassification', 0, array(
				'label'=>'否',
			))?>
		</div>
		<div class="form-field">
			<label class="title bold">显示文章数</label>
			<?php echo F::form('widget')->inputText('number', array(
				'class'=>'form-control mw150',
			), 5)?>
		</div>
		<div class="form-field">
			<label class="title bold">无文章时是否显示小工具</label>
			<?php echo F::form('widget')->inputRadio('show_empty', 1, array(
				'label'=>'是',
			))?>
			<?php echo F::form('widget')->inputRadio('show_empty', 0, array(
				'label'=>'否',
			), true)?>
		</div>
		<div class="form-field">
			<label class="title bold">仅显示有缩略图的文章</label>
			<?php echo F::form('widget')->inputRadio('thumbnail', 1, array(
				'label'=>'是',
			))?>
			<?php echo F::form('widget')->inputRadio('thumbnail', 0, array(
				'label'=>'否',
			), true)?>
			<p class="fc-grey">若该实例被用于画廊展示，请选择<span class="fc-orange">“是”</span></p>
		</div>
		<div class="form-field">
			<label class="title bold">排序规则</label>
			<?php
				echo F::form('widget')->inputRadio('order', 'hand', array(
					'wrapper'=>array(
						'tag'=>'label',
						'wrapper'=>'p',
					),
					'after'=>'置顶+排序值+发布时间倒序（手工排序）',
				), true);
				echo F::form('widget')->inputRadio('order', 'publish_time', array(
					'wrapper'=>array(
						'tag'=>'label',
						'wrapper'=>'p',
					),
					'after'=>'仅发布时间倒序（最新发布）',
				));
				echo F::form('widget')->inputRadio('order', 'views', array(
					'wrapper'=>array(
						'tag'=>'label',
						'wrapper'=>'p',
					),
					'after'=>'阅读数倒序+发布时间倒序（热门文章）',
				));
				echo F::form('widget')->inputRadio('order', 'rand', array(
					'wrapper'=>array(
						'tag'=>'label',
						'wrapper'=>'p',
					),
					'after'=>'随机排序（效率较低）',
				));
			?>
		</div>
		<div class="form-field">
			<a href="javascript:;" class="toggle-advance" style="text-decoration:underline;">高级设置</a>
		</div>
		<div class="advance <?php if(!UserRoleService::service()->is(RolesTable::ITEM_SUPER_ADMIN))echo 'hide';?>">
			<div class="form-field">
				<label class="title bold">分类字段</label>
				<?php echo F::form('widget')->inputText('cat_key', array(
					'class'=>'form-control mw150',
				), 'cat')?>
				<p class="fc-grey">若url中指定分类，则优先级高于后台指定的分类</p>
			</div>
			<div class="form-field">
				<label class="title bold">最近访问</label>
				<p><?php echo F::form('widget')->inputText('last_view_time', array(
					'class'=>'form-control mw150',
				), 0);?>
				<span class="fc-grey">（单位：天。若为<em class="fc-orange">0</em>，则不限制</span>）</p>
				<p class="fc-grey">
					例如：30天则只有30天内被访问过的文章才会显示，防止过时文章被显示。<br>
					该数值视网站访问量而定，设置过小可能导致无文章可显示。
				</p>
			</div>
			<div class="form-field">
				<label class="title bold">发布时间格式</label>
				<?php echo F::form('widget')->inputText('date_format', array(
					'class'=>'form-control mw150',
				), 'pretty')?>
				<p class="fc-grey">若为空，则不显示时间；若为pretty，则会显示“1天前”这样的时间格式；<br>
					其他格式视为PHP date函数的第一个参数</p>
			</div>
			<div class="form-field">
				<label class="title bold">链接格式<span class="fc-red">（若非开发人员，请不要修改此配置）</span></label>
				<?php
					echo HtmlHelper::inputRadio('uri', 'post/{$id}', !isset($config['uri']) || $config['uri'] == 'post/{$id}', array(
						'label'=>'post/{$id}',
					));
					echo HtmlHelper::inputRadio('uri', 'post-{$id}', isset($config['uri']) && $config['uri'] == 'post-{$id}', array(
						'label'=>'post-{$id}',
					));
					echo HtmlHelper::inputRadio('uri', '', isset($config['uri']) && !in_array($config['uri'], array(
						'post/{$id}', 'post-{$id}',
					)), array(
						'label'=>'其它',
					));
					echo HtmlHelper::inputText('other_uri', isset($config['uri']) && !in_array($config['uri'], array(
						'post/{$id}', 'post-{$id}',
					)) ? $config['uri'] : '', array(
						'class'=>'form-control mw150 ib',
					));
				?>
				<p class="fc-grey">
					<code>{$id}</code>代表“文章ID”。
					不要包含base_url部分
				</p>
			</div>
			<div class="form-field">
				<label class="title bold">文章缩略图尺寸</label>
				<?php
				echo F::form('widget')->inputText('post_thumbnail_width', array(
					'placeholder'=>'宽度',
					'class'=>'form-control w100 ib',
				)),
				' x ',
				F::form('widget')->inputText('post_thumbnail_height', array(
					'placeholder'=>'高度',
					'class'=>'form-control w100 ib',
				));
				?>
				<p class="fc-grey">若留空，则返回默认尺寸缩略图。</p>
			</div>
			<div class="form-field">
				<label class="title bold">附加字段</label>
				<?php
				echo F::form('widget')->inputCheckbox('fields[]', 'category', array(
					'label'=>'分类详情',
				), true);
				echo F::form('widget')->inputCheckbox('fields[]', 'user', array(
					'label'=>'作者信息',
				));
				echo F::form('widget')->inputCheckbox('fields[]', 'files', array(
					'label'=>'附件',
				));
				echo F::form('widget')->inputCheckbox('fields[]', 'meta', array(
					'label'=>'计数（评论数/阅读数/点赞数）',
				));
				echo F::form('widget')->inputCheckbox('fields[]', 'tags', array(
					'label'=>'标签',
				));
				echo F::form('widget')->inputCheckbox('fields[]', 'props', array(
					'label'=>'附加属性',
				));
				?>
				<p class="fc-grey">仅勾选模版中用到的字段，可以加快程序效率。</p>
			</div>
			<div class="form-field">
				<label class="title bold">渲染模版<span class="fc-red">（若非开发人员，请不要修改此配置）</span></label>
				<?php echo F::form('widget')->textarea('template', array(
					'class'=>'form-control h90 autosize',
					'id'=>'code-editor',
				))?>
				<p class="fc-grey mt5">
					若模版内容符合正则<code>/^[\w_-]+(\/[\w_-]+)+$/</code>，
					即类似<code>frontend/widget/template</code><br />
					则会调用当前application下符合该相对路径的view文件。<br />
					否则视为php代码<code>eval</code>执行。若留空，会调用默认模版。
				</p>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$('.toggle-advance').on('click', function(){
		$(".advance").toggle();
	});
});
</script>