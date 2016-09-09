<?php
use fay\helpers\Html;
use fay\services\File;
use fay\helpers\Date;

\F::app()->layout->assign(array(
	'page_title'=>$post['post']['title']
));
?>
<div class="post-item">
	<article>
		<div class="post-meta">
			<time class="post-meta-item post-meta-time"><?php
				echo Date::niceShort($post['post']['publish_time'])
				?></time>
			<a href="" class="post-meta-item post-meta-category">分类1</a>
					<span class="post-meta-item post-meta-views">
						<span>阅读数</span>
						<a><?php
							echo $post['meta']['views']
							?></a>
					</span>
		</div>
		<?php if($post['files']){?>
			<div class="post-featured">
				<div class="swiper-container post-files">
					<div class="swiper-wrapper">
						<?php foreach($post['files'] as $file){?>
							<div class="swiper-slide">
								<?php echo Html::img($file['thumbnail'], File::PIC_ORIGINAL, array(
									'alt'=>$file['description'],
								))?>
							</div>
						<?php }?>
					</div>
					<div class="swiper-pagination"></div>
					<div class="swiper-control-container">
						<a class="swiper-btn-prev"></a>
						<a class="swiper-btn-next"></a>
					</div>
				</div>
			</div>
		<?php }?>
		<?php if(!$post['files'] && $post['post']['thumbnail']){?>
			<div class="post-featured">
				<div class="post-thumb">
					<a href="<?php echo $post['post']['link']?>"><?php
						echo Html::img($post['post']['thumbnail'], File::PIC_RESIZE, array(
							'dw'=>770,
							'dh'=>448,
						));
						?></a>
				</div>
			</div>
		<?php }?>
		<div class="post-container">
			<div class="post-content">
				<p><?php echo $post['post']['content']?></p>
			</div>
		</div>
	</article>
</div>