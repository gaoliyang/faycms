<?php
use fay\helpers\Html;
use ncp\helpers\FriendlyLink;
use fay\models\File;
use fay\helpers\String;

$this->appendCss($this->staticFile('css/food.css'));
?>
<div class="container containerbg">
	<div class="curnav">
		<strong>当前位置：</strong>
		<?php echo Html::link('首页', $this->url())?>
		&gt;
		<?php echo Html::link('农美食', array('food'))?>
		&gt;
		<span><?php echo Html::encode($post['title'])?></span>
	</div>
	<div id="J-detail">
		<div class="tm-clear">
			<div class="tm-warp">
				<div class="tb-property">
					<div class="tb-warp">
						<div class="tb-hd">
							<h1><?php echo Html::encode($post['title'])?></h1>
						</div>
						<div class="tb-info">
							<p><?php echo Html::encode($post['abstract'])?></p>
						</div>
						<ul class="tb-s">
							<li><label>地点：</label> <span><?php echo $area['title']?></span></li>
						</ul>
						<div class="go-bth">
							<?php echo Html::outsideLink('立即购买', $buy_link, array(
								'rel'=>'nofollow',
								'target'=>'_blank',
							))?>
						</div>
					</div>
				</div>
			</div>
			<div class="tm-ser">
				<?php echo Html::img($post['thumbnail'], File::PIC_RESIZE, array(
					'dw'=>400,
					'dh'=>300,
				))?>
			</div>
			<div class="tm-tuijian">
				<h3>农产品推荐</h3>
				<ul>
				<?php foreach($right_top_posts as $p){?>
					<li><?php echo Html::link(Html::img($p['thumbnail'], File::PIC_RESIZE, array(
						'dw'=>180,
						'dh'=>135,
					)), FriendlyLink::getProductLink(array(
						'id'=>$p['id'],
					)), array(
						'encode'=>false,
						'title'=>Html::encode($p['title']),
					))?></li>
				<?php }?>
				</ul>
			</div>
		</div>
	</div>
	<div class="in_adv">
		<?php echo F::app()->widget->load('food-item-ad')?>
	</div>
	<div class="detail-info mt10">
		<div class="d-fl">
			<div class="detail-hd">
				<h3 class="cur"><?php echo Html::encode($post['title'])?>介绍</h3>
				<h3><?php echo $area['title']?>农产品</h3>
				<h3><?php echo $area['title']?>旅游</h3>
			</div>
			<div class="detail-p">
				<div class="s_in">
					<?php echo $post['content']?>
				</div>
				<div class="s_product">
					<ul class="product">
					<?php foreach($product_posts as $p){?>
						<li>
							<div class="p-img">
								<?php echo Html::link(Html::img($p['thumbnail'], File::PIC_RESIZE, array(
									'dw'=>280,
									'dh'=>210,
								)), FriendlyLink::getProductLink(array(
									'id'=>$p['id'],
								)), array(
									'encode'=>false,
									'title'=>Html::encode($p['title']),
									'target'=>'_blank',
								))?>
							</div>
							<div class="p-name">
								<?php echo Html::link($p['title'], FriendlyLink::getProductLink(array(
									'id'=>$p['id'],
								)), array(
									'target'=>'_blank',
								))?>
							</div>
							<div class="p-st">
								<span class="fl"><?php echo Html::encode($p['views'])?></span>
								<span class="fr"><b>分类：</b><?php echo Html::encode($p['cat_title'])?></span>
							</div>
						</li>
					<?php }?>
					</ul>
				</div>
				<div class="s_meishi">
					<ul class="product">
					<?php foreach($travel_posts as $p){?>
						<li>
							<div class="p-img">
								<?php echo Html::link(Html::img($p['thumbnail'], File::PIC_RESIZE, array(
									'dw'=>280,
									'dh'=>210,
									'alt'=>Html::encode($p['title']),
								)), FriendlyLink::getTravelLink(array(
									'id'=>$p['id'],
								)), array(
									'encode'=>false,
									'title'=>Html::encode($p['title']),
									'target'=>'_blank',
								))?>
							</div>
							<div class="p-name">
								<?php echo Html::link($p['title'], FriendlyLink::getTravelLink(array(
									'id'=>$p['id'],
								)), array(
									'target'=>'_blank',
								))?>
							</div>
							<div class="p-maoshu"><?php echo Html::encode($p['abstract'])?></div>
							<div class="p-st">
								<span class="fl"><?php echo $p['views']?></span>
								<span class="fr"><?php echo Html::link('去这里', FriendlyLink::getTravelLink(array(
									'id'=>$p['id']
								)), array(
									'class'=>'gowhere',
									'target'=>'_blank',
								))?></span>
							</div>
						</li>
					<?php }?>
					</ul>
				</div>
			</div>
		</div>
		<div class="d-fr">
			<h3>农美食</h3>
			<ul>
			<?php foreach($right_posts as $p){?>
				<li>
					<p class="p-img">
						<?php echo Html::link(Html::img($p['thumbnail'], File::PIC_RESIZE, array(
							'dw'=>180,
							'dh'=>135,
						)), FriendlyLink::getFoodLink(array(
							'id'=>$p['id'],
						)), array(
							'encode'=>false,
							'title'=>Html::encode($p['title']),
						))?>
					</p>
					<p class="p-name">
						<?php echo Html::link($p['title'], FriendlyLink::getFoodLink(array(
							'id'=>$p['id'],
						)))?>
					</p>
				</li>
			<?php }?>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(".detail-hd h3").bind("click", function (){
		var index = $(this).index(index);
		var divs = $(".detail-p > div");
		$(this).parent().children("h3").attr("class", "no");//将所有选项置为未选中
		$(this).attr("class", "cur");	 //设置当前选中项为选中样式
		divs.hide(); 
		divs.eq(index).show();
	});
	$(".detail-p > div").css({"display":"none"});
	$(".detail-p > div:first").css({"display":"block"})
  </script>