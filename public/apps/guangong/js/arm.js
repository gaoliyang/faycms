var arm = {
	/**
	 * 正在发送ajax时，不再发起其他ajax，防止摇一摇功能重复发送ajax
	 */
	'ajaxing': false,

	/**
	 * 摇一摇音效实例
	 */
	'shakeAudio': null,
	
	/**
	 * 动画效果
	 */
	'animate': function(){
		var $swiper = $('.swiper-wrapper .swiper-slide:eq('+common.swiper.activeIndex+')');

		//履军职标题
		if($swiper.find('.job-title').length){
			$swiper.find('.job-title').show().addClass('rubberBand animated');
		}else{
			$('.job-title').hide().removeClass('rubberBand animated');
		}

		//兵种说明顶部文字
		if($swiper.find('.arm-text').length){
			$swiper.find('.arm-text').show().addClass('fadeInDown animated');
		}else{
			$('.arm-text').hide().removeClass('fadeInDown animated');
		}

		//防区说明顶部文字
		if($swiper.find('.defence-text').length){
			$swiper.find('.defence-text').show().addClass('fadeInDown animated');
		}else{
			$('.defence-text').hide().removeClass('fadeInDown animated');
		}

		//录军籍卷轴
		if($swiper.find('.juanzhou-he').length){
			$swiper.find('.juanzhou-he').show().addClass('rollIn animated');
		}else{
			$('.juanzhou-he').hide().removeClass('fadeInDown animated');
		}

		//履军职任务列表
		if($swiper.find('.jobs').length){
			setTimeout(function(){
				$swiper.find('.jobs li:eq(0)').css({'visibility': 'visible'}).addClass('fadeIn animated');
			}, 300);
			setTimeout(function(){
				$swiper.find('.jobs li:eq(1)').css({'visibility': 'visible'}).addClass('fadeIn animated');
			}, 600);
			setTimeout(function(){
				$swiper.find('.jobs li:eq(2)').css({'visibility': 'visible'}).addClass('fadeIn animated');
			}, 900);
			setTimeout(function(){
				$swiper.find('.jobs li:eq(3)').css({'visibility': 'visible'}).addClass('fadeIn animated');
			}, 1200);
		}else{
			$('.jobs li').css({'visibility': 'hidden'}).removeClass('fadeIn animated');
		}
	},
	/**
	 * 循环动画，执行一次就好了，不用重复执行
	 */
	'interval': function(){
		//兵种文字
		if($('.arm-names').length){
			setInterval(function(){
				var $armNames = $('.arm-names');
				$armNames.find('.layer').removeClass('tada animated');
				//随机出一个0-5的整数
				var num = Math.floor(Math.random()*6);
				$armNames.find('.layer:eq('+num+')').addClass('tada animated');
			}, 1000);
		}

		//摇一摇标识
		if($('.shake').length){
			setInterval(function(){
				var $shake = $('.shake');
				if($shake.hasClass('animated')){
					$shake.removeClass('tada animated');
				}else{
					$shake.addClass('tada animated')
				}
			}, 1000);
		}
	},
	/**
	 * 摇一摇
	 */
	'shake': function(){
		$.shake(function(){
			var $activeSlide = $('.swiper-wrapper').find('.swiper-slide:eq('+common.swiper.activeIndex+')');
			$activeSlide.find('.shake').click();
		});
	},
	/**
	 * 点击摇一摇按钮（效果等同于手机摇一摇）
	 */
	'clickShake': function(){
		$(document).on('click', '.shake', function(){
			var $activeSlide = $(this).parent();
			if($activeSlide.hasClass('set-arm-slide')){
				arm.setArm();
			}else if($activeSlide.hasClass('set-defence-slide')){
				arm.setDefenceArea();
			}else if($activeSlide.hasClass('set-hour-slide')){
				arm.setHour();
			}
		});
	},
	/**
	 * 播放摇一摇音效
	 */
	'shakeMusic': function(){
		arm.shakeAudio.play();
	},
	/**
	 * 初始化摇一摇音效
	 */
	'initShakeMusic': function(){
		this.shakeAudio = new Audio(system.url('apps/guangong/music/5018.wav'));
		common.swiper.on('SlideChangeStart', function(){
			arm.shakeAudio.play();
			arm.shakeAudio.pause();
		});
	},
	'setArm': function(){
		if(this.ajaxing){
			return false;
		}
		this.ajaxing = true;
		this.shakeMusic();
		$.ajax({
			'type': 'GET',
			'url': system.url('api/arm/set'),
			'dataType': 'json',
			'cache': false,
			'success': function(resp){
				arm.ajaxing = false;
				if(resp.status){
					var $setArmSlide = $('.set-arm-slide');
					$setArmSlide.find('.arms,.shake,.arm-names').remove();
					$setArmSlide.append('<div class="layer result flip animated"><img src="'+resp.data.picture.url+'"></div>');
					$setArmSlide.append('<div class="layer next-link"><a href="'+system.url('arm/set-hour#1')+'" class="btn-1">排勤务</a></div>');
					//移除class。摇一摇就失效了
					$setArmSlide.removeClass('set-arm-slide');
					common.toast(resp.message, 'success');
				}else{
					common.toast(resp.message, 'error');
				}
			}
		});
	},
	'setHour': function(){
		if(this.ajaxing){
			return false;
		}
		this.ajaxing = true;
		this.shakeMusic();
		$.ajax({
			'type': 'GET',
			'url': system.url('api/hour/set'),
			'dataType': 'json',
			'cache': false,
			'success': function(resp){
				arm.ajaxing = false;
				if(resp.status){
					var $arm8 = $('#arm-8');
					$arm8.find('.qiantong').remove();
					$arm8.append('<div class="layer result flip animated"><span class="hour">'+resp.data.name+'</span></div>');
					$arm8.append('<div class="layer next-link"><a href="'+system.url('arm/info#1')+'" class="btn-1">录军籍</a></div>');
					common.toast(resp.message, 'success');
					//移除class。摇一摇就失效了
					$('.set-hour-slide').removeClass('set-hour-slide');
				}else{
					common.toast(resp.message, 'error');
				}
			}
		});
	},
	'setDefenceArea': function(){
		if(this.ajaxing){
			return false;
		}
		this.ajaxing = true;
		this.shakeMusic();
		$.ajax({
			'type': 'GET',
			'url': system.url('api/defence-area/set'),
			'dataType': 'json',
			'cache': false,
			'success': function(resp){
				arm.ajaxing = false;
				if(resp.status){
					var $arm4 = $('#arm-4');
					$arm4.find('.shake').remove();
					$arm4.append('<div class="layer next-link"><a href="'+system.url('arm/set-arm#1')+'" class="btn-1">选兵种</a></div>');
					common.toast(resp.message, 'success');
					//移除class。摇一摇就失效了
					$('.set-defence-slide').removeClass('set-defence-slide');
				}else{
					common.toast(resp.message, 'error');
				}
			}
		});
	},
	/**
	 * 显示军籍
	 */
	'showInfo': function(){
		var $arm10 = $('#arm-10');
		$arm10.find('.juanzhou-he').addClass('rotateOut animated');
		$arm10.find('.juanzhou-he').removeClass('rollIn');
		$arm10.find('.shake').remove();
		setTimeout(function(){
			$arm10.find('.juanzhou-kai').show().addClass('zoomInUp animated');
			$arm10.find('.juanzhou-he').remove();
		}, 600);
	},
	'init': function(){
		this.animate();
		this.interval();
		this.initShakeMusic();
		common.swiper.on('SlideChangeStart', this.animate)
	}
};