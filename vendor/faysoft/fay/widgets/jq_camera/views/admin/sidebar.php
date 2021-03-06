<div class="box">
	<div class="box-title">
		<h4>Camera参数</h4>
	</div>
	<div class="box-content">
		<div class="form-field pb0 pt0">
			<label class="title pb0">外层元素ID（id）</label>
			<?php echo F::form('widget')->inputText('element_id', array(
				'class'=>'form-control',
			))?>
			<span class="fc-grey">用于定制式样等</span>
		</div>
		<div class="form-field pb0">
			<label class="title pb0">高度（height）</label>
			<?php echo F::form('widget')->inputText('height', array(
				'class'=>'form-control',
			), 450)?>
			<p class="fc-grey">若不写单位，默认为像素（px）</p>
		</div>
		<div class="form-field pb0">
			<label class="title pb0">过渡动画时长（transPeriod）</label>
			<?php echo F::form('widget')->inputText('transPeriod', array(
				'class'=>'form-control',
			), 800)?>
			<span class="fc-grey">（单位：毫秒）</span>
		</div>
		<div class="form-field pb0">
			<label class="title pb0">播放间隔时长（time）</label>
			<?php echo F::form('widget')->inputText('time', array(
				'class'=>'form-control',
			), 5000)?>
			<span class="fc-grey">（单位：毫秒）</span>
		</div>
		<div class="form-field pb0">
			<label class="title pb0">切换效果（fx）</label>
			<?php echo F::form('widget')->select('fx', array(
				'random'=>'random(随机)',
				'simpleFade'=>'simpleFade',
				'curtainTopLeft'=>'curtainTopLeft',
				'curtainTopRight'=>'curtainTopRight',
				'curtainBottomLeft'=>'curtainBottomLeft',
				'curtainBottomRight'=>'curtainBottomRight',
				'curtainSliceLeft'=>'curtainSliceLeft',
				'curtainSliceRight'=>'curtainSliceRight',
				'blindCurtainTopLeft'=>'blindCurtainTopLeft',
				'blindCurtainTopRight'=>'blindCurtainTopRight',
				'blindCurtainBottomLeft'=>'blindCurtainBottomLeft',
				'blindCurtainBottomRight'=>'blindCurtainBottomRight',
				'blindCurtainSliceBottom'=>'blindCurtainSliceBottom',
				'blindCurtainSliceTop'=>'blindCurtainSliceTop',
				'stampede'=>'stampede',
				'mosaic'=>'mosaic',
				'mosaicReverse'=>'mosaicReverse',
				'mosaicRandom'=>'mosaicRandom',
				'mosaicSpiral'=>'mosaicSpiral',
				'mosaicSpiralReverse'=>'mosaicSpiralReverse',
				'topLeftBottomRight'=>'topLeftBottomRight',
				'bottomRightTopLeft'=>'bottomRightTopLeft',
				'bottomLeftTopRight'=>'bottomLeftTopRight',
			), array(
				'class'=>'form-control'
			), 'random')?>
		</div>
	</div>
</div>