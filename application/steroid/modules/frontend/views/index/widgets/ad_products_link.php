<section class="section" id="section-product-link">
	<div class="bg" style="background-image:url(<?php echo \fay\services\File::getUrl($widget->config['file_id'])?>)">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<div class="title-group">
						<h2 class="title">Full Prices of Steroid Oils</h2>
						<div class="description">
							<?php $post = \fay\models\tables\Posts::model()->fetchRow(
								\fay\models\tables\Posts::getPublishedConditions(),
								'publish_time',
								'publish_time DESC'
							)?>
							<p>Last update <?php echo date('F j, Y', $post['publish_time'])?></p>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="product-link-container">
						<a href="<?php echo $this->url('post')?>" class="btn btn-transparent">PRODUCT LIST</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>