var shadow = {

	/* hideMain */
	hideMain: function() {
		var dy = $(document).scrollTop().toString();
		$('#container-outer').addClass('crop');
		$('#container-inner').data('scroll', dy).css('margin-top', '-' + dy + 'px');
	},

	/* showMain */
	showMain: function() {
		var dy = parseInt($('#container-inner').data('scroll'));
		$('#container-inner').removeAttr('style').removeAttr('class');
		$('#container-outer').removeAttr('class');
		$(document).scrollTop(dy);
	}

};


var menu = {

	items: {},

	/* code */
	code: function(e) {
		var parent = e.closest('ul');
		var i1 = 'i' + e.index().toString();
		var i2 = 'i';
		if(!parent.hasClass('menu')) {
			i2 = 'i' + parent.closest('li').index().toString();
		}
		return [i2, i1];
	},

	/* openMenu */
	openMenu: function(e) {
		var list = e.children('ul').first();
		var code = menu.code(e);

		if(typeof menu.items[code[0]] === 'undefined') {
			menu.items[code[0]] = {};
		}
		if(typeof menu.items[code[0]][code[1]] === 'undefined') {
			menu.items[code[0]][code[1]] = [];
			menu.items[code[0]][code[1]][1] = list.height();
		}

		if(!e.hasClass('open')) {
			e.addClass('open');

			var parent = e.closest('ul');
			if(parent.hasClass('menu')) {
				parent = undefined;
			} else {
				parent = parent.closest('li');
			}
			e.closest('ul.menu').find('li.open').each(function() {
				if((!$(this).is(e)) && ((typeof parent === 'undefined') || (!$(this).is(parent)))) {
					menu.closeMenu($(this));
				}
			});

			list.css('height', '0').css('display', 'block');
			var arrow = list.prev('.up');
			if(code[0] == 'i') {
				var ml = Math.floor((e.width() - list.outerWidth()) / 2);
				list.css('margin-left', ml.toString() + 'px');
				if(arrow.length !== 0) {
					ml = Math.floor((e.width() - 17) / 2);
					arrow.css({'height': '0px', 'margin-top': '9px', 'margin-left': ml.toString() + 'px'}).css('display', 'block');
				}
			} else {
				var mt = -1 * e.height();
				list.css('margin-top', mt.toString() + 'px');
			}
			list.animate(
				{
					'height': menu.items[code[0]][code[1]][1].toString() + 'px'
				},
				400,
				'easeOutCubic'
			);
			if(arrow.length !== 0) {
				arrow.animate(
					{
						'height': '9px',
						'margin-top': '0px'
					},
					400,
					'easeOutCubic'
				);
			}
		}
	},
	
	/* closeMenu */
	closeMenu: function(e) {
		var list = e.children('ul').first();
		list.stop();
		list.css('display', 'none');
		list.prev('.up').css('display', 'none');
		e.removeClass('open');
	},

	/* startTimer */
	startTimer: function(e) {
		var code = menu.code(e);
		menu.items[code[0]][code[1]][0] = setTimeout(function() {
			menu.closeMenu(e);
		}, 500);
	},

	/* stopTimer */
	stopTimer: function(e) {
		var code = menu.code(e);
		if((typeof menu.items[code[0]] !== 'undefined') && (typeof menu.items[code[0]][code[1]] !== 'undefined') && (typeof menu.items[code[0]][code[1]][0] !== 'undefined')) {
			clearTimeout(menu.items[code[0]][code[1]][0]);
		}
	},

	/* resetMenu */
	resetMenu: function(m) {
		m.find('ul').removeAttr('style');
		m.find('.up').removeAttr('style');
		m.find('li.open').removeClass('open');
	},

	/* resetCompact */
	resetCompact: function(m) {
		m.find('ul').removeAttr('style');
		m.find('span.open').removeClass('open');
	}

};


var portfolio = {

	/* init */
	init: function(area) {
		var data = area.find('.vars').first().text().split(':');
		var buttons = '';
		var media = area.find('.media').first();
		media.scrollTop(0);
		media.scroll(function() {
			portfolio.check(area);
		});
		media.find('.item').each(function() {
			var item = $(this);
			imagesLoaded(item, function() {
				item.removeClass('loading');
			});
			if(buttons == '') {
				buttons += '<div class="button active" style="background-color: #' + data[0] + '"></div>';
			} else {
				buttons += '<div class="button"></div>';
			}
		});
		area.find('.navigation').first().append(buttons);
		if(data[1] != '0') {
			area.find('.prev').first().css('display', 'block');
		}
		if(data[4] != '0') {
			area.find('.next').first().css('display', 'block');
		}
	},

	/* setup */
	setup: function(area) {
		var data = area.find('.vars').first().text().split(':');
		var buttons = '';
		var media = area.find('.media').first();
		media.scrollTop(0);
		media.scroll(function() {
			portfolio.check(area);
		});
		media.find('.item').each(function() {
			var item = $(this);
			imagesLoaded(item, function() {
				item.removeClass('loading');
			});
			if(buttons == '') {
				buttons += '<div class="button active" style="background-color: #' + data[0] + '"></div>';
			} else {
				buttons += '<div class="button"></div>';
			}
		});
		area.find('.navigation').first().append(buttons);
	},

	/* check */
	check: function(area) {
		var media = area.find('.media').first();
		var dy = media.scrollTop();
		var real = 0;
		var i = 0;
		var t = 0;
		var current = area.find('.navigation .button').index('.active');
		media.find('.item').each(function() {
			if(dy >= (t - 128)) {
				real = i;
			}
			t += $(this).outerHeight();
			i++;
		});
		if(current != real) {
			portfolio.button(area, real);
		}
	},

	/* button */
	button: function(area, i) {
		var data = area.find('.vars').first().text().split(':');
		area.find('.navigation .button.active').removeAttr('style').removeClass('active');
		area.find('.navigation .button:eq(' + i.toString() + ')').addClass('active').css('background-color', '#' + data[0]);
	},

	/* show */
	show: function(block1, anim1, block2, anim2) {
		if(typeof block2 != 'undefined') {
			block2.animate(
				anim2,
				500,
				function() {
					block2.remove();
				}
			);
		}
		block1.animate(
			anim1,
			500,
			function() {
				block1.removeClass('prev next');
				var data = block1.find('.vars').first().text().split(':');
				if(data[1] != '0') {
					block1.find('.prev').first().css('display', 'block');
				}
				if(data[4] != '0') {
					block1.find('.next').first().css('display', 'block');
				}
				var media = block1.find('.media').first();
				media[0].scrollIntoView();
			}
		);
	}

};


var slider = {

	timer: undefined,

	/* start */
	start: function() {
		if(typeof slider.timer != 'undefined') {
			clearTimeout(slider.timer)
		}
		slider.timer = setTimeout(slider.next, 4000);
	},

	/* next */
	next: function() {
		var icons = $('.slider ul.icons li');
		var icon_old = icons.filter('.active').first();
		var o = icons.index(icon_old);
		var amount = icons.length;
		var n = o + 1;
		if(amount > 1) {
			if(amount == n) { n = 0; }
			slider.open(icons.eq(n));
		}
		slider.start();
	},

	/* open */
	open: function(icon_new) {
		var icons = icon_new.closest('ul').find('li');
		var pics = icon_new.closest('ul').prev('ul').find('li');

		var icon_old = icons.filter('.active').first();

		var o = icons.index(icon_old);
		var n = icons.index(icon_new);

		var pic_old = pics.eq(o);
		var pic_new = pics.eq(n);

		icon_old.removeClass('active').addClass('off');
		icon_new.addClass('active').removeClass('off');
	
		pic_old.css({opacity: 1}).animate({opacity: 0}, 200, function() {
			pic_old.removeClass('active').addClass('off').removeAttr('style');
			pic_new.css({opacity: 0}).addClass('active').removeClass('off').animate({opacity: 1}, 200, function() {
				pic_new.removeAttr('style');
			});
		});
	}

};


var recommendations = {

	/* show */
	show: function(block1, anim1, block2, anim2) {
		if(typeof block2 != 'undefined') {
			block2.animate(
				anim2,
				500,
				function() {
					block2.remove();
				}
			);
		}
		block1.animate(
			anim1,
			500,
			function() {
				block1.removeClass('prev next');
				var data = block1.find('.vars').first().text().split(':');
				if(data[0] != '0') {
					block1.find('.prev').first().css('display', 'inline-block');
				}
				if(data[1] != '0') {
					block1.find('.next').first().css('display', 'inline-block');
				}
			}
		);
	}

};


var request = {

	timer: undefined,

	/* hide */
	hide: function() {
		$('#shadow').fadeTo(200, 0, function() {
			$('#popup').html('');
			$('#shadow').removeClass().removeAttr('style');
			shadow.showMain();
			request.start();
		});
	},

	/* sendus */
	sendus: function() {
		var h = $(window).height() + 10;
		var s = $('#sendus');
		s.animate(
			{
				'top': h.toString() + 'px'
			},
			1000,
			'easeInBack',
			function() {
				s.css('top', '-60px').toggleClass('red');
				s.animate(
					{
						'top': '136px'
					},
					2000,
					'easeOutElastic'
				);
			}
		);
	},
	
	/* stop */
	stop: function() {
		clearInterval(request.timer);
		request.timer = undefined;
	},

	/* start */
	start: function() {
		if(typeof request.timer == 'undefined') {
			request.timer = setInterval(request.sendus, 14000);
		}
	}

};


$(document).ready(function() {

	/* menu :: begin */
	$(document)
		.on('mouseenter', '.header ul.menu li', function() {
			if($(this).children('ul').length !== 0) {
				menu.stopTimer($(this));
				menu.openMenu($(this));
			}
		})
		.on('mouseleave', '.header ul.menu li', function() {
			if($(this).children('ul').length !== 0) {
				menu.startTimer($(this));
			}
		})
		.on('mouseenter', '.header .button', function() {
			$(this).addClass('hv');
		})
		.on('mouseleave', '.header .button', function() {
			$(this).removeClass('hv');
		})
		.on('click', '.header .button', function() {
			var m = $('.header ul.menu').first();
			menu.resetMenu(m);
			shadow.hideMain();
			$('#shadow').fadeTo(200, 1).addClass('menu');
			m.removeClass('menu').addClass('compact');
			m.animate({'margin-left': '0px'}, 300);
		})
		.on('click', '#shadow.menu .close', function() {
			var m = $('.header ul.compact').first();
			$('#shadow').fadeTo(200, 0, function() {
				$('#shadow').removeClass().removeAttr('style');
				shadow.showMain();
			});
			m.animate({'margin-left': '-240px'}, 150, function() {
				menu.resetCompact(m);
				m.removeClass('compact').addClass('menu').removeAttr('style');
			});
		})
		.on('click', '.header ul.compact li span.icon', function() {
			var m = $(this).nextAll('ul').first();
			if($(this).hasClass('open')) {
				$(this).removeClass('open');
				m.animate({
						'height': '0px'
					},
					150,
					'easeOutCubic',
					function() {
						m.removeAttr('style');
						m.find('span.icon.open').removeClass('open');
						m.find('ul').removeAttr('style');
					}
				);
			} else {
				m.css({'display': 'block', 'position': 'absolute', 'visibility': 'hidden'});
				var h = m.height();
				m.removeAttr('style').css({'display': 'block', 'position': 'static', 'height': '0px'});
				menu.resetCompact(m);
				$(this).addClass('open');
				m.animate({
						'height': h.toString() + 'px'
					},
					300,
					'easeOutCubic',
					function() {
						m.css('height', 'auto');
					}
				);
			}
		});
	/* menu :: end */

	/* protfolio :: begin */
	if($('#shadow.portfolio #popup .area').length !== 0) {
		shadow.hideMain();
		portfolio.init($('#shadow.portfolio #popup .area').first());
	}
	$(document)
		.on('mouseenter', '.content ul.portfolio a', function() {
			$(this).animate({'background-color': '#ff2100', 'color': '#ffffff'}, 300);
			$(this).find('.description').first().stop().animate({'color': '#ffffff'}, 300);
		})
		.on('mouseleave', '.content ul.portfolio a', function() {
			$(this).stop().animate({'background-color': '#ffffff', 'color': '#000000'}, 150);
			$(this).find('.description').first().stop().animate({'color': '#2f2f2f'}, 300);
		})
		.on('click', '.content ul.portfolio a', function(event) {
			shadow.hideMain();
			var link = '/portfolio/element.php';
			var query = 'ELEMENT=' + $(this).data('element');
			$('#shadow').fadeTo(200, 1).addClass('portfolio');
			$('#loading').css('display', 'block');
			$.ajax({
				type: "GET",
				url: link,
				data: query,
				success: function(response) {
					$('#loading').css('display', 'none');
					$('#popup').append('<div class="area next">' + response + '</div>');
					var next = $('#popup').find('.area.next').first();
					portfolio.setup(next);
					portfolio.show(next, {'left': '0px'});
				}
			});
			event.preventDefault();
		})
		.on('click', '#shadow.portfolio .close', function() {
			$('#shadow').fadeTo(200, 0, function() {
				$('#popup').html('');
				$('#shadow').removeClass('portfolio').removeAttr('style');
				shadow.showMain();
			});
		})
		.on('click', '#shadow.portfolio #popup .area', function(event) {
			if(event.target == this) {
				$('#shadow').fadeTo(200, 0, function() {
					$('#popup').html('');
					$('#shadow').removeClass('portfolio').removeAttr('style');
					shadow.showMain();
				});
			}
		})
		.on('click', '#shadow.portfolio #popup .area:not(.lock) .navigation .button:not(.active)', function() {
			var area = $(this).closest('.area');
			area.addClass('lock');
			var n = area.find('.navigation .button').index(this);
			var media = area.find('.media').first();
			var i = 0;
			var dy = 0;
			media.find('.item').each(function() {
				if(i < n) {
					dy += $(this).outerHeight();
				}
				i++;
			});
			if(n > 0) {
				dy += 1;
			}
			media.animate({scrollTop: Math.round(dy)}, 500, 'swing', function() {
				portfolio.button(area, n);
				area.removeClass('lock');
			});
		})
		.on('mouseenter', '#shadow.portfolio #popup .area .prev, #popup .area .next', function() {
			$(this).addClass('hv');
		})
		.on('mouseleave', '#shadow.portfolio #popup .area .prev, #popup .area .next', function() {
			$(this).removeClass('hv');
		})
		.on('click', '#shadow.portfolio #popup .area .prev', function() {
			var area = $(this).closest('.area');
			var data = area.find('.vars').first().text().split(':');
			var link = '/portfolio/element.php';
			var query = 'ELEMENT=' + data[1];
			area.find('.prev, .next').removeAttr('style');
			area.fadeTo(200, 0.5);
			$('#loading').css('display', 'block');
			$.ajax({
				type: "GET",
				url: link,
				data: query,
				success: function(response) {
					$('#loading').css('display', 'none');
					$('#popup').append('<div class="area prev">' + response + '</div>');
					var prev = $('#popup').find('.area.prev').first();
					portfolio.setup(prev);
					portfolio.show(prev, {'left': '0px'}, area, {'left': '110%'});
				}
			});
		})
		.on('click', '#shadow.portfolio #popup .area .next', function() {
			var area = $(this).closest('.area');
			var data = area.find('.vars').first().text().split(':');
			var link = '/portfolio/element.php';
			var query = 'ELEMENT=' + data[4];
			area.find('.prev, .next').removeAttr('style');
			area.fadeTo(200, 0.5);
			$('#loading').css('display', 'block');
			$.ajax({
				type: "GET",
				url: link,
				data: query,
				success: function(response) {
					$('#loading').css('display', 'none');
					$('#popup').append('<div class="area next">' + response + '</div>');
					var next = $('#popup').find('.area.next').first();
					portfolio.setup(next);
					portfolio.show(next, {'left': '0px'}, area, {'left': '-110%'});
				}
			});
		});
	/* protfolio :: end */

	/* slider :: begin */
	slider.start();
	$(document)
		.on('mouseenter', '.slider ul.icons li', function() {
			$(this).removeClass('off');
		})
		.on('mouseleave', '.slider ul.icons li', function() {
			if(!$(this).hasClass('active')) {
				$(this).addClass('off');
			}
		})
		.on('click', '.slider ul.icons li', function() {
			if(!$(this).hasClass('active')) {
				slider.open($(this));
				slider.start();
			}
		});
	/* slider :: end */

	/* actions :: begin */
	$(document)
		.on('mouseenter', '.actions .item, .actionslist .item', function() {
			$(this).closest('.item').addClass('hv');
		})
		.on('mouseleave', '.actions .item, .actionslist .item', function() {
			$(this).closest('.item').removeClass('hv');
		});
	/* actions :: end */

	/* projects :: begin */
	$(document)
		.on('mouseenter', '.projectslist .item', function() {
			$(this).closest('.item').addClass('hv');
		})
		.on('mouseleave', '.projectslist .item', function() {
			$(this).closest('.item').removeClass('hv');
		});
	/* projects :: end */

	/* recommendations :: begin */
	$(document)
		.on('mouseenter', '.recommendationslist .item img', function() {
			$(this).addClass('hv');
		})
		.on('mouseleave', '.recommendationslist .item img', function() {
			$(this).removeClass('hv');
		})
		.on('click', '.recommendationslist .item img', function() {
			shadow.hideMain();
			var link = '/about/reccomend/element.php';
			var query = 'ELEMENT=' + $(this).closest('.item').data('element');
			$('#shadow').fadeTo(200, 1).addClass('recommendations');
			$('#loading').css('display', 'block');
			$.ajax({
				type: "GET",
				url: link,
				data: query,
				success: function(response) {
					$('#popup').append('<div class="area next">' + response + '</div>');
					var next = $('#popup').find('.area.next').first();
					imagesLoaded(next, function() {
						$('#loading').css('display', 'none');
						recommendations.show(next, {'left': '0px'});
					});
				}
			});
		})
		.on('click', '#shadow.recommendations .close', function() {
			$('#shadow').fadeTo(200, 0, function() {
				$('#popup').html('');
				$('#shadow').removeClass().removeAttr('style');
				shadow.showMain();
			});
		})
		.on('click', '#shadow.recommendations #popup .area .main, #shadow.recommendations #popup .area .aleft, #shadow.recommendations #popup .area .aright', function(event) {
			if(event.target == this) {
				$('#shadow').fadeTo(200, 0, function() {
					$('#popup').html('');
					$('#shadow').removeClass().removeAttr('style');
					shadow.showMain();
				});
			}
		})
		.on('mouseenter', '#shadow.recommendations #popup .area .prev, #popup .area .next', function() {
			$(this).addClass('hv');
		})
		.on('mouseleave', '#shadow.recommendations #popup .area .prev, #popup .area .next', function() {
			$(this).removeClass('hv');
		})
		.on('click', '#shadow.recommendations #popup .area .prev', function() {
			var area = $(this).closest('.area');
			var data = area.find('.vars').first().text().split(':');
			var link = '/about/reccomend/element.php';
			var query = 'ELEMENT=' + data[0];
			area.find('.prev, .next').removeAttr('style');
			area.fadeTo(200, 0.5);
			$('#loading').css('display', 'block');
			$.ajax({
				type: "GET",
				url: link,
				data: query,
				success: function(response) {
					$('#popup').append('<div class="area prev">' + response + '</div>');
					var prev = $('#popup').find('.area.prev').first();
					imagesLoaded(prev, function() {
						$('#loading').css('display', 'none');
						recommendations.show(prev, {'left': '0px'}, area, {'left': '110%'});
					});
				}
			});
		})
		.on('click', '#shadow.recommendations #popup .area .next', function() {
			var area = $(this).closest('.area');
			var data = area.find('.vars').first().text().split(':');
			var link = '/about/reccomend/element.php';
			var query = 'ELEMENT=' + data[1];
			area.find('.prev, .next').removeAttr('style');
			area.fadeTo(200, 0.5);
			$('#loading').css('display', 'block');
			$.ajax({
				type: "GET",
				url: link,
				data: query,
				success: function(response) {
					$('#popup').append('<div class="area next">' + response + '</div>');
					var next = $('#popup').find('.area.next').first();
					imagesLoaded(next, function() {
						$('#loading').css('display', 'none');
						recommendations.show(next, {'left': '0px'}, area, {'left': '-110%'});
					});
				}
			});
		});
	/* recommendations :: end */

	/* request :: begin */
	$(window).resize(function() {
//		if($('#shadow.request').length !== 0) {
//			request.hide();
//		}
	});
	$('#sendus').animate(
		{
			'top': '136px'
		},
		2000,
		'easeOutElastic',
		function() {
			request.start();
		}
	);
	$(document)
		.on('click', 'a.request, #sendus', function(event) {
			shadow.hideMain();
			request.stop();
			var link = '/request/form.php';
			$('#shadow').fadeTo(200, 1).addClass('request');
			$('#loading').css('display', 'block');
			$.ajax({
				type: "GET",
				url: link,
				success: function(response) {
					$('#loading').css('display', 'none');
					$('#popup').append('<div class="area">' + response + '</div>');
					var form = new CFE($('#popup').find('form'));
					form.setSelectSize(10, 'subject');
				}
			});
			event.preventDefault();
		})
		.on('click', '#shadow.request .close', function() {
			$('#shadow').fadeTo(200, 0, function() {
				$('#popup').html('');
				$('#shadow').removeClass().removeAttr('style');
				shadow.showMain();
				request.start();
			});
		})
		.on('click', '#shadow.request #popup', function(event) {
			if(event.target == this) {
				$('#shadow').fadeTo(200, 0, function() {
					$('#popup').html('');
					$('#shadow').removeClass().removeAttr('style');
					shadow.showMain();
					request.start();
				});
			}
		})
		.on('click', '#feedbackcaptchaimagerefresh', function() {
			var im = $(this);
			if(!im.hasClass('wait')) {
				im.addClass('wait');
				$('#shadow.request .data.captcha').addClass('loading');
				$('#feedbackcaptchaimage').attr('src', '/request/empty.png');
				$.getJSON('/request/reload.php', function(data) {
					$('#feedbackcaptchaimage').attr('src', data.img);
					$('#feedbackcaptchasid').val(data.sid);
					$('#feedbackcaptcha').val('');
					$('#shadow.request .data.captcha.loading').removeClass('loading');
					im.removeClass('wait');
				});
			}
		})
		.on('click', '#shadow.request .cfe-button', function() {
			var button = $(this);
			button.hide();
			$('#submitwait').show();
			var query = $(this).closest('form').serialize();
			$('#feedbackstatus').text('').fadeTo(0, 0);
			$('#feedbackcaptchaimagerefresh').addClass('wait');
			$('#shadow.request .data.captcha').addClass('loading');
			$('#feedbackcaptchaimage').attr('src', '/request/empty.png');
			$.ajax({
				type: "POST",
				url: '/request/submit.php',
				data: query,
				dataType: "json",
				success: function(response) {
					if(response.status == '1') {
						$('#shadow.request #feedbackstatus').addClass('green');
						$('#shadow.request .data.captcha.loading').removeClass('loading');
						$('#feedbackcaptchaimagerefresh').hide();
						$('#feedbackcaptcha').val('');
						setTimeout(request.hide, 3000);
					} else {
						$.getJSON('/request/reload.php', function(data) {
							$('#feedbackcaptchaimage').attr('src', data.img);
							$('#feedbackcaptchasid').val(data.sid);
							$('#feedbackcaptcha').val('');
							$('#shadow.request .data.captcha.loading').removeClass('loading');
							$('#feedbackcaptchaimagerefresh').removeClass('wait');
							$('#submitwait').hide();
							button.show();
						});
					}
					$('#feedbackstatus').text(response.msg).fadeTo(100, 1);
				}
			})
		})
		.on('click', '#shadow.request .custom-form-element', function() {
			$('#feedbackstatus').fadeTo(100, 0).removeClass('green').text('');
		});
	/* request :: end */

});
