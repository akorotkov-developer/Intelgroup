/*
	Custom Form Elements
	v.0.01

	cfe-text cfe-password
	cfe-textarea
	cfe-checkbox
	cfe-radio
	cfe-select cfe-multiple
	cfe-button cfe-submit cfe-reset
	cfe-file
	cfe-hidden

	enable(element?)
	disable(element?)
	setSelectSize(size, element?)
	updateSelect(data, element)
	chooseSelectValue(data, element)
	setInputFilter(element, filter, length?)
	removeInputFilter(element)
	setInputBuffer(element, value)
*/

function CFE(area) {
	/*
		self.area
		self.elements => { name => { type, field, element, items?select, size?select, step?select, temporaryStep?select, flag?select, mousePosition?select, scrollbar?select, arrow-up?select, arrow-down?select, filter?input(.cfe-filter)} }
		self.code
		self.fileField
		self.scrollField
		self.focusElement
		self.focusFlag
		self.scrollTimeout
		self.scrollTimeoutCount
	*/
	var self = this;
	if(typeof area === 'undefined') {
		self.area = $(document.body);
	}
	else {
		self.area = area;
	}
	self.elements = {};
	self.code = {
		checkbox: '<span class="fa fa-check"></span>',
		radio: '<div class="cfe-bullet"></div>',
		selectOpen: '<span class="fa fa-caret-down"></span>',
		selectUp: '<span class="fa fa-caret-up"></span>',
		selectDown: '<span class="fa fa-caret-down"></span>',
		textareaUp: '<span class="fa fa-caret-up"></span>',
		textareaDown: '<span class="fa fa-caret-down"></span>',
		file: '<span class="fa fa-file"></span>'
	};
	self.fileField = undefined;
	self.scrollField = undefined;
	self.focusElement = undefined;
	self.focusFlag = 0;
	self.scrollTimeout = undefined;
	self.scrollTimeoutCount = 0;

	$(document)
		.on({
			'mousedown': function(event) {
				self.area.find('.cfe-select.cfe-open').not('.cfe-multiple').each(function() {
					if ($(this).has(event.target).length == 0) {
						$(this).removeClass('cfe-open');
					}
				});
			},
			'mouseup': function() {
				if(typeof self.scrollField === 'object') {
					self.elements[self.scrollField.name].element.removeClass('cfe-bar').trigger('barstop');
				}
				if(self.focusFlag == 0) {
					$(self.focusElement).removeClass('cfe-focus');
					self.focusElement = undefined;
				}
				else {
					self.focusFlag = 0;
				}
				if(typeof self.scrollTimeout !== 'undefined') {
					clearTimeout(self.scrollTimeout);
				}
			},
			'mousemove': function(event) {
				if(typeof self.scrollField === 'object') {
					self.elements[self.scrollField.name].element.trigger('barmove', ['mouse', event.pageY]);
				}
				else if(typeof self.fileField === 'object') {
					var offset = $(self.fileField).closest('.cfe-window').offset();
					$(self.fileField).css({left: (event.pageX - offset.left - $(self.fileField).width() + 4).toString() + 'px', top: (event.pageY - offset.top - 4).toString() + 'px'});
				}
			}
		});

	self.area
		.on('mouseenter', '.custom-form-element', function(event) {
			if(this.className.indexOf('cfe-off') == -1) {
				$(this).addClass('cfe-hover');
				if(this.className.indexOf('cfe-file') > -1) self.fileField = $(this).find('input').first().get(0);
			}
		})
		.on('mouseleave', '.custom-form-element', function() {
			if(this.className.indexOf('cfe-off') == -1) {
				$(this).removeClass('cfe-hover');
				if(this.className.indexOf('cfe-file') > -1) self.fileField = undefined;
			}
		})
		.on('click', 'label', function(event) {
			var flag = 0;
			$(this).find('.cfe-checkbox.cfe-off, .cfe-radio.cfe-off').each(function() {
				flag = 1;
			});
			if(flag == 1) {
				event.stopPropagation();
				event.preventDefault();
			}
		})
		.on('mousedown', '.custom-form-element', function(event) {
			if(this.className.indexOf('cfe-off') == -1) {
				if((typeof self.focusElement !== 'undefined') && (self.focusElement != this)) {
					$(self.focusElement).removeClass('cfe-focus');
					self.focusElement = undefined;
				}
				$(this).addClass('cfe-focus');
				self.focusElement = this;
				self.focusFlag = 1;
				/* checkbox */
				if(this.className.indexOf('cfe-checkbox') > -1) {
					if($(this).closest('label').length === 0) {
						var field = $(this).find('input').first().get(0);
						if(event.target.nodeName.toLowerCase() != 'input') {
							if(field.checked) {
								field.checked = false;
							}
							else {
								field.checked = true;
							}
						}
						$(field).trigger('change');
						event.stopPropagation();
					}
				}
				/* radio */
				else if(this.className.indexOf('cfe-radio') > -1) {
					if($(this).closest('label').length === 0) {
						var field = $(this).find('input').first().get(0);
						if(event.target.nodeName.toLowerCase() != 'input') field.checked = true;
						$(field).trigger('change');
						event.stopPropagation();
					}
				}
				/* select */
				else if(this.className.indexOf('cfe-select') > -1) {
					var name = $(this).find('select').first().get(0).name;
					/* select - scrollbar */
					if(event.target.className.indexOf('cfe-scrollbar') > -1) {
						self.scrollField = $(this).find('select').first().get(0);
						self.elements[self.scrollField.name]['mousePosition'] = event.pageY;
						$(this).addClass('cfe-bar');
					}
					/* select - item */
					else if(event.target.className.indexOf('cfe-item') > -1) {
						var i = $(event.target).index();
						if(self.elements[name].field.multiple) {
							if(event.ctrlKey) {
								if(event.target.className.indexOf('cfe-active') > -1) {
									self.elements[name].field.options[i].selected = false;
									$(event.target).removeClass('cfe-active');
								}
								else {
									self.elements[name].field.options[i].selected = true;
									$(event.target).addClass('cfe-active');
								}
							}
							else if(event.shiftKey) {
								if(self.elements[name]['last'] < 0) {
									self.elements[name]['last'] = 0;
								}
								for(var j = 0; j < self.elements[name].field.length; j++) {
									if(((self.elements[name]['last'] < i) && (j >= self.elements[name]['last']) && (j <= i)) || ((self.elements[name]['last'] >= i) && (j <= self.elements[name]['last']) && (j >= i))) {
										self.elements[name].field.options[j].selected = true;
										$(this).find('.cfe-item:nth-child(' + (j + 1).toString() + ')').addClass('cfe-active');
									}
									else {
										self.elements[name].field.options[j].selected = false;
										$(this).find('.cfe-item:nth-child(' + (j + 1).toString() + ')').removeClass('cfe-active');
									}
								}
							}
							else {
								for(var j = 0; j < self.elements[name].field.length; j++) {
									self.elements[name].field.options[j].selected = false;
								}
								self.elements[name].field.options[i].selected = true;
								$(this).find('.cfe-item.cfe-active').removeClass('cfe-active');
								$(event.target).addClass('cfe-active');
							}
							self.elements[name]['last'] = i;
							$(this).find('.cfe-item:nth-child(' + (i + 1).toString() + ')').addClass('cfe-focus');
							$(self.elements[name].field).trigger('change');
						}
						else {
							var change = 0;
							if(self.elements[name].field.selectedIndex != i) {
								change = 1;
							}
							self.elements[name].field.options[i].selected = true;
							$(this).find('.cfe-item.cfe-active').removeClass('cfe-active');
							$(event.target).addClass('cfe-active');
							$(this).find('.cfe-name').first().text(self.elements[name].field.options[i].text);
							if(change == 1) {
								$(self.elements[name].field).trigger('change');
							}
							$(this).trigger('close');
						}
					}
					/* select - arrow-up */
					else if((event.target.className.indexOf('cfe-arrow-up') > -1) || (self.elements[name]['arrow-up'].has(event.target).length > 0)) {
						if(self.elements[name]['arrow-up'].get(0).className.indexOf('cfe-active') > -1) {
							self.scrollTimeoutCount = 0;
							self.triggerScrollMove($(this), -1);
						}
					}
					/* select - arrow-down */
					else if((event.target.className.indexOf('cfe-arrow-down') > -1) || (self.elements[name]['arrow-down'].has(event.target).length > 0)) {
						if(self.elements[name]['arrow-down'].get(0).className.indexOf('cfe-active') > -1) {
							self.scrollTimeoutCount = 0;
							self.triggerScrollMove($(this), 1);
						}
					}
					/* select - box */
					else if((event.target.className.indexOf('cfe-box') > -1) || ($(this).find('.cfe-box').first().has(event.target).length > 0)) {
						if(this.className.indexOf('cfe-open') == -1) {
							$(this).trigger('open');
						}
						else {
							$(this).trigger('close');
						}
					}
				}
				/* textarea */
				else if(this.className.indexOf('cfe-textarea') > -1) {
					var name = $(this).find('textarea').first().get(0).name;
					/* textarea - scrollbar */
					if(event.target.className.indexOf('cfe-scrollbar') > -1) {
						self.scrollField = $(this).find('textarea').first().get(0);
						self.elements[self.scrollField.name]['mousePosition'] = event.pageY;
						$(this).addClass('cfe-bar');
					}
					/* textarea - arrow-up */
					else if((event.target.className.indexOf('cfe-arrow-up') > -1) || (self.elements[name]['arrow-up'].has(event.target).length > 0)) {
						if(self.elements[name]['arrow-up'].get(0).className.indexOf('cfe-active') > -1) {
							self.scrollTimeoutCount = 0;
							self.triggerScrollMove($(this), -1);
						}
					}
					/* textarea - arrow-down */
					else if((event.target.className.indexOf('cfe-arrow-down') > -1) || (self.elements[name]['arrow-down'].has(event.target).length > 0)) {
						if(self.elements[name]['arrow-down'].get(0).className.indexOf('cfe-active') > -1) {
							self.scrollTimeoutCount = 0;
							self.triggerScrollMove($(this), 1);
						}
					}
				}
			} else {
				event.stopPropagation();
			}
		})
		.on('focus', '.custom-form-element :input', function() {
			var e;
			if(self.elements[this.name].type == 'radio') {
				for(var i = 0; i < self.elements[this.name].field.length; i++) {
					if(this == self.elements[this.name].field[i]) {
						e = self.elements[this.name].element[i];
					}
				}
			}
			else {
				e = self.elements[this.name].element;
			}
			if(e.get(0).className.indexOf('cfe-off') == -1) {
				if(self.focusFlag == 0) {
					e.addClass('cfe-focus')
					self.focusElement = e.get(0);
				}
			}
			else {
				this.blur();
			}
		})
		.on('change', '.cfe-file input', function() {
			self.elements[this.name].element.find('.cfe-fname').first().text(this.value);
		})
		.on('change', '.cfe-checkbox input', function() {
			$(this).closest('.cfe-checkbox').toggleClass('cfe-active');
		})
		.on('change', '.cfe-radio input', function() {
			area.find('input[name="' + this.name + '"]').closest('.cfe-radio').removeClass('cfe-active');
			$(this).closest('.cfe-radio').addClass('cfe-active');
		})
		.on('mousewheel', '.cfe-select, .cfe-textarea', function(event) {
				if((this.className.indexOf('cfe-off') == -1) && (this.className.indexOf('cfe-focus') > -1)) {
					$(this).trigger('barmove', ['step', -1 * (event.deltaY / Math.abs(event.deltaY))]);
					event.preventDefault();
				}
		})
		.on('keyup', '.cfe-text input', function(event) {
			var e = self.elements[this.name].element;
			if(e.get(0).className.indexOf('cfe-off') == -1) {
				if(e.get(0).className.indexOf('cfe-filter') > -1) {
					this.value = this.value.replace(self.elements[this.name].filter, '').substr(0, self.elements[this.name].maxlength);
				}
				if(this.value != self.elements[this.name].buffer) {
					e.addClass('cfe-change');
				}
				else {
					e.removeClass('cfe-change');
				}
				if (event.which == 13) {
					this.trigger('enter');
				}
			}
		})
		.on('paste', '.cfe-text input', function() {
			var e = self.elements[this.name].element;
			if(e.get(0).className.indexOf('cfe-off') == -1) {
				setTimeout(function() {
					if(e.get(0).className.indexOf('cfe-filter') > -1) {
						this.value = this.value.replace(self.elements[this.name].filter, '').substr(0, self.elements[this.name].maxlength);
					}
					if(this.value != self.elements[this.name].buffer) {
						e.addClass('cfe-change');
					}
					else {
						e.removeClass('cfe-change');
					}
				}, 40);
			}
		})
		.on('blur', '.cfe-text input', function() {
			var e = self.elements[this.name].element;
			if(e.get(0).className.indexOf('cfe-off') == -1) {
				if(this.value != self.elements[this.name].buffer) {
					e.addClass('cfe-change');
				}
				else {
					e.removeClass('cfe-change');
				}
			}
		})
		.on('keyup', '.cfe-textarea textarea', function() {
			self.elements[this.name].element.trigger('barset');
		})
		.on('paste', '.cfe-textarea textarea', function() {
			self.elements[this.name].element.trigger('barset');
		})
		.on('selectstart', '.cfe-checkbox, .cfe-radio, .cfe-select, .cfe-button, .cfe-file', function(event) {
			event.preventDefault();
			event.stopPropagation();
		});

	self.area
		.on('open', '.cfe-text', function() {
			var name = $(this).find('input').first().get(0).name;
			$(self.elements[name].field).css('width', ($(this).width() + $(self.elements[name].field).width() - $(self.elements[name].field).outerWidth()).toString() + 'px');
		})
		.on('open', '.cfe-select', function() {
			var list = $(this).find('.cfe-list').first();
			var name = $(this).find('select').first().get(0).name;
			if(self.elements[name]['flag'] == 0) {
				list.css('width', '0px');
				var size = (self.elements[name]['size'] > self.elements[name]['items']) ? self.elements[name]['items'] : self.elements[name]['size'];
				var w = $(this).width() - list.outerWidth();
				var h = size * list.find('.cfe-item').first().outerHeight();
				list.css({width: w.toString() + 'px', height: h.toString() + 'px'});
				if(size == self.elements[name]['items']) {
					list.find('.cfe-scroller').css('display', 'none');
					list.find('.cfe-area').css({height: h.toString() + 'px', marginTop: '0px', marginRight: '0px'});
					list.find('.cfe-scrollfield').css('height', h.toString() + 'px');
				}
				else {
					list.find('.cfe-area, .cfe-scroller').css({height: h.toString() + 'px', marginTop: '0px'});
					h = h - self.elements[name]['arrow-up'].outerHeight() - self.elements[name]['arrow-down'].outerHeight();
					list.find('.cfe-scrollfield').css('height', h.toString() + 'px');
					self.elements[name]['arrow-down'].addClass('cfe-active');
				}
				var bar = Math.floor(h * size / self.elements[name]['items']);
				if(bar < 8) bar = 8;
				self.elements[name]['scrollbar'].css('height', bar + 'px');
				self.elements[name]['flag'] = 1;
			}
			$(this).addClass('cfe-open');
		})
		.on('close', '.cfe-select', function() {
			$(this).removeClass('cfe-open');
		})
		.on('barmove', '.cfe-select', function(event, type, d) {
			var list = $(this).find('.cfe-list').first();
			var name = $(this).find('select').first().get(0).name;
			var dsize = (self.elements[name]['size'] > self.elements[name]['items']) ? 0 : self.elements[name]['items'] - self.elements[name]['size'];
			if(dsize > 0) {
				var dstep = (self.elements[name]['scrollbar'].closest('.cfe-scrollfield').height() - self.elements[name]['scrollbar'].outerHeight()) / dsize;
				if(type == 'mouse') d = Math.round((d - self.elements[name]['mousePosition']) / dstep);
				var newstep = self.elements[name]['step'] + d;
				if(newstep < 0) newstep = 0;
				if(newstep > dsize) newstep = dsize;
				var dy = 0;
				if(newstep == 0) {
					self.elements[name]['arrow-up'].removeClass('cfe-active');
					self.elements[name]['arrow-down'].addClass('cfe-active');
				}
				else if(newstep == dsize) {
					dy = self.elements[name]['scrollbar'].closest('.cfe-scrollfield').height() - self.elements[name]['scrollbar'].outerHeight();
					self.elements[name]['arrow-down'].removeClass('cfe-active');
					self.elements[name]['arrow-up'].addClass('cfe-active');
				}
				else {
					dy = Math.floor(newstep * dstep);
					self.elements[name]['arrow-up'].addClass('cfe-active');
					self.elements[name]['arrow-down'].addClass('cfe-active');
				}
				self.elements[name]['scrollbar'].css('margin-top', dy.toString() + 'px');
				list.find('.cfe-area').first().css('margin-top', '-' + (list.find('.cfe-item').first().outerHeight() * newstep).toString() + 'px');
				if(type == 'step') {
					self.elements[name]['step'] = newstep;
				}
				else {
					self.elements[name]['temporaryStep'] = newstep;
				}
			}
			else {
				
			}
		})
		.on('barstop', '.cfe-select', function() {
			var name = $(this).find('select').first().get(0).name;
			self.elements[name]['step'] = self.elements[name]['temporaryStep'];
			self.scrollField = undefined;
		})
		.on('open', '.cfe-textarea', function() {
			var name = $(this).find('textarea').first().get(0).name;
			var area = $(this).find('.cfe-area').first();
			self.elements[name]['lheight'] = parseInt($(self.elements[name].field).css('line-height').replace(/[^0-9]/, ''));
			$(self.elements[name].field).css({width: (area.width() - $(self.elements[name].field).outerWidth()).toString() + 'px', height: (self.elements[name]['lheight'] * self.elements[name].size).toString() + 'px'});
			var h = $(self.elements[name].field).outerHeight();
			if((h > 300) || (h < 20)) {
				h = 177;
			}
			area.css('height', h.toString() + 'px');
			var backup = self.elements[name].field.value;
			var scroll = $(self.elements[name].field).scrollTop();
			self.elements[name].field.value = '1';
			$(self.elements[name].field).scrollTop(0);
			var sh = self.elements[name].field.scrollHeight;
			if(sh < $(self.elements[name].field).height()) {
				self.elements[name]['scrollMargin'] = sh - self.elements[name]['lheight'];
			}
			else {
				self.elements[name]['scrollMargin'] = sh - $(self.elements[name].field).height();
			}
			self.elements[name].field.value = backup;
			$(self.elements[name].field).scrollTop(scroll);
			$(this).find('.cfe-scroller').css('height', h.toString() + 'px');
			h = h - self.elements[name]['arrow-up'].outerHeight() - self.elements[name]['arrow-down'].outerHeight();
			$(this).find('.cfe-scrollfield').css('height', h.toString() + 'px');
			$(self.elements[name].field).trigger('barset');
		})
		.on('barset', '.cfe-textarea', function() {
			var name = $(this).find('textarea').first().get(0).name;
			self.elements[name]['items'] = Math.round((self.elements[name].field.scrollHeight - self.elements[name]['scrollMargin']) / self.elements[name]['lheight']);
			if(self.elements[name]['items'] < self.elements[name]['size']) self.elements[name]['items'] = self.elements[name]['size'];
			var bar = Math.floor($(this).find('.cfe-scrollfield').height() * self.elements[name]['size'] / self.elements[name]['items']);
			if(bar < 8) bar = 8;
			self.elements[name]['scrollbar'].css('height', bar + 'px');
			self.elements[name]['step'] = Math.round($(self.elements[name].field).scrollTop() / self.elements[name]['lheight']);
			$(self.elements[name].field).trigger('barmove', ['step', 0]);
		})
		.on('barmove', '.cfe-textarea', function(event, type, d) {
			var name = $(this).find('textarea').first().get(0).name;
			var dsize = (self.elements[name]['size'] > self.elements[name]['items']) ? 0 : self.elements[name]['items'] - self.elements[name]['size'];
			if(dsize > 0) {
				if(self.elements[name]['flag'] == 0) {
					$(this).removeClass('cfe-noscroll');
					$(self.elements[name].field).css('width', ($(this).find('.cfe-area').first().width() + $(self.elements[name].field).width() - $(self.elements[name].field).outerWidth()).toString() + 'px');
					self.elements[name]['flag'] = 1;
				}
				var dstep = (self.elements[name]['scrollbar'].closest('.cfe-scrollfield').height() - self.elements[name]['scrollbar'].outerHeight()) / dsize;
				if(type == 'mouse') d = Math.round((d - self.elements[name]['mousePosition']) / dstep);
				var newstep = self.elements[name]['step'] + d;
				if(newstep < 0) newstep = 0;
				if(newstep > dsize) newstep = dsize;
				var dy = 0;
				if(newstep == 0) {
					self.elements[name]['arrow-up'].removeClass('cfe-active');
					self.elements[name]['arrow-down'].addClass('cfe-active');
				}
				else if(newstep == dsize) {
					dy = self.elements[name]['scrollbar'].closest('.cfe-scrollfield').height() - self.elements[name]['scrollbar'].outerHeight();
					self.elements[name]['arrow-down'].removeClass('cfe-active');
					self.elements[name]['arrow-up'].addClass('cfe-active');
				}
				else {
					dy = Math.floor(newstep * dstep);
					self.elements[name]['arrow-up'].addClass('cfe-active');
					self.elements[name]['arrow-down'].addClass('cfe-active');
				}
				self.elements[name]['scrollbar'].css('margin-top', dy.toString() + 'px');
				$(self.elements[name].field).scrollTop(self.elements[name]['lheight'] * newstep);
				if(type == 'step') {
					self.elements[name]['step'] = newstep;
				}
				else {
					self.elements[name]['temporaryStep'] = newstep;
				}
			}
			else {
				if(self.elements[name]['flag'] == 1) {
					$(this).addClass('cfe-noscroll');
					$(self.elements[name].field).css('width', ($(this).find('.cfe-area').first().width() + $(self.elements[name].field).width() - $(self.elements[name].field).outerWidth()).toString() + 'px');
					self.elements[name]['flag'] = 0;
				}
			}
		})
		.on('barstop', '.cfe-textarea', function() {
			var name = $(this).find('textarea').first().get(0).name;
			self.elements[name]['step'] = self.elements[name]['temporaryStep'];
			self.scrollField = undefined;
		});

	/* rendering */
	self.render();
}


CFE.prototype.disable = function(element) {
	if(typeof element === 'object') {
		element.addClass('cfe-off');
	}
	else if(typeof element === 'string') {
		if(this.elements[element].type == 'radio') {
			for(var i = 0; i < this.elements[element].element.length; i++) {
				this.elements[element].element[i].addClass('cfe-off');
			}
		}
		else {
			this.elements[element].element.addClass('cfe-off');
		}
	}
	else {
		for(var key in this.elements) {
			if(this.elements[key].type == 'radio') {
				for(var i = 0; i < this.elements[key].element.length; i++) {
					this.elements[key].element[i].addClass('cfe-off');
				}
			}
			else {
				this.elements[key].element.addClass('cfe-off');
			}
		}
	}
}


CFE.prototype.enable = function(element) {
	if(typeof element === 'object') {
		element.removeClass('cfe-off');
	}
	else if(typeof element === 'string') {
		if(this.elements[element].type == 'radio') {
			for(var i = 0; i < this.elements[element].element.length; i++) {
				this.elements[element].element[i].removeClass('cfe-off');
			}
		}
		else {
			this.elements[element].element.removeClass('cfe-off');
		}
	}
	else {
		for(var key in this.elements) {
			if(this.elements[key].type == 'radio') {
				for(var i = 0; i < this.elements[key].element.length; i++) {
					this.elements[key].element[i].removeClass('cfe-off');
				}
			}
			else {
				this.elements[key].element.removeClass('cfe-off');
			}
		}
	}
}


CFE.prototype.setSelectSize = function(size, element) {
	if(typeof element === 'object') {
		var name = $(this).find('select').first().get(0).name;
		this._setSelectSize(size, name);
	}
	else if(typeof element === 'string') {
		this._setSelectSize(size, element);
	}
	else {
		for(var key in this.elements) {
			if((this.elements[key].type == 'select-one') || (this.elements[key].type == 'select-multiple')) {
				this._setSelectSize(size, key);
			}
		}
	}
}


CFE.prototype._setSelectSize = function(size, element) {
	this.elements[element].element.trigger('close');
	this.elements[element].size = (size < 3) ? 3 : size;
	this.elements[element]['step'] = 0;
	this.elements[element]['temporaryStep'] = 0;
	this.elements[element]['flag'] = 0;
	if(this.elements[element].type == 'select-multiple') {
		this.elements[element].element.trigger('open');
	}
}


CFE.prototype.updateSelect = function(data, element) {
	var self = this;
	var name = '';
	if(typeof element === 'object') {
		name = element.find('select').first().get(0).name;
	}
	else if(typeof element === 'string') {
		name = element;
	}
	if((name != '') && (typeof this.elements[name] !== 'undefined') && ((this.elements[name].type == 'select-one') || (this.elements[name].type == 'select-multiple'))) {
		this.elements[name].element.trigger('close');
		var j = undefined;
		if(typeof data === 'string') {
			j = $.parseHTML(data);
		}
		else if(typeof data === 'object') {
			j = data;
		}
		if(typeof j !== 'undefined') {
			var options_cfe = '';
			var text = '';
			var value = '';
			var selected = '';
			this.elements[name].field.length = 0;
			$.each(j, function(i, el) {
				text = (typeof this.text === 'undefined') ? '' : this.text;
				value = (typeof this.value === 'undefined') ? text : this.value;
				if(this.selected) {
					self.elements[name].field.options[i] = new Option(text, value, true, true);
					options_cfe += '<div class="cfe-item cfe-active">' + text + '</div>';
					selected = text;
				}
				else {
					self.elements[name].field.options[i] = new Option(text, value, false, false);
					options_cfe += '<div class="cfe-item">' + text + '</div>';
				}
			});
		}
		this.elements[name].items = j.length;
		this.elements[name]['step'] = 0;
		this.elements[name]['temporaryStep'] = 0;
		this.elements[name]['flag'] = 0;
		this.elements[name].element.find('.cfe-area').first().html(options_cfe);
		if(this.elements[name].type == 'select-one') {
			this.elements[name].element.find('.cfe-name').first().text(selected);
		}
		else {
			this.elements[name].element.trigger('open');
		}
	}
}


CFE.prototype.chooseSelectValue = function(data, element) {
	var name = '';
	if(typeof element === 'object') {
		name = element.find('select').first().get(0).name;
	}
	else if(typeof element === 'string') {
		name = element;
	}
	if((typeof data === 'string') || (typeof data === 'number')) data = [data];
	if((name != '') && (typeof this.elements[name] !== 'undefined') && ((this.elements[name].type == 'select-one') || (this.elements[name].type == 'select-multiple'))) {
		this.elements[name].element.find('.cfe-item.cfe-active').removeClass('cfe-active');
		for(var i = 0; i < this.elements[name].field.length; i++) {
			if(this.elements[name].type == 'select-one') {
				if(this.elements[name].field.options[i].value == data[0]) {
					this.elements[name].field.options[i].selected = true;
					this.elements[name].element.find('.cfe-item:nth-child(' + (i + 1).toString() + ')').addClass('cfe-active');
					this.elements[name].element.find('.cfe-name').first().text(this.elements[name].field.options[i].text);
				}
			}
			else {
				this.elements[name].field.options[i].selected = false;
				for(var j = 0; j < data.length; j++) {
					if(this.elements[name].field.options[i].value == data[j]) {
						this.elements[name].field.options[i].selected = true;
						this.elements[name].element.find('.cfe-item:nth-child(' + (i + 1).toString() + ')').addClass('cfe-active');
					}
				}
			}
		}
	}
}


CFE.prototype.setInputFilter = function(element, filter, len) {
	var name = '';
	if(typeof element === 'object') {
		name = element.find('input').first().get(0).name;
	}
	else if(typeof element === 'string') {
		name = element;
	}
	this.elements[name].element.addClass('cfe-filter');
	this.elements[name].filter = new RegExp(filter, 'g');
	this.elements[name].maxlength = (typeof len === 'undefined') ? 255 : len;
}


CFE.prototype.removeInputFilter = function(element) {
	var name = '';
	if(typeof element === 'object') {
		name = element.find('input').first().get(0).name;
	}
	else if(typeof element === 'string') {
		name = element;
	}
	this.elements[name].element.removeClass('cfe-filter');
	delete this.elements[name].filter;
	delete this.elements[name].maxlength;
}


CFE.prototype.setInputBuffer = function(element, value) {
	var name = '';
	if(typeof element === 'object') {
		name = element.find('input').first().get(0).name;
	}
	else if(typeof element === 'string') {
		name = element;
	}
	this.elements[name].buffer = value;
}


CFE.prototype.triggerScrollMove = function(element, direction) {
	var i = 400;
	var o = this;
	element.trigger('barmove', ['step', direction]);
	this.scrollTimeoutCount++;
	if(this.scrollTimeoutCount > 3) {
		i = 40;
	}
	else {
		i = i - (this.scrollTimeoutCount - 1) * 100;
	}
	this.scrollTimeout = setTimeout(function() { o.triggerScrollMove(element, direction); }, i);
}


CFE.prototype.render = function() {
	self = this;
	var j = 0;
	self.area.find(':input').each(function() {
		if($(this).closest('.custom-form-element').length !== 0) {
			j++;
		}
	});
	self.area.find(':input').each(function() {
		if($(this).closest('.custom-form-element').length === 0) {
			var type = this.type.toLowerCase();
			var id_attr = ((typeof this.id === 'undefined') || (this.id == '')) ? '' : ' id="' + this.id + '"';
			var cls_attr = ((typeof this.className === 'undefined') || (this.className == '')) ? '' : ' class="' + this.className + '"';
			if((typeof this.name === 'undefined') || (this.name == '')) {
				j++;
				this.name = '_CFE' + j.toString();
			}
			var name_attr = ' name="' + this.name + '"';
			if(type == 'radio') {
				if(typeof self.elements[this.name] === 'undefined') {
					self.elements[this.name] = {
						type: type,
						field: [],
						element: []
					};
				}
			}
			else {
				self.elements[this.name] = {
					type: type
				};
			}
			/* radio */
			if(type == 'radio') {
				var value_attr = (typeof this.value === 'undefined') ? '' : ' value="' + this.value + '"';
				var cls = '';
				var checked = '';
				if(this.checked) {
					cls = ' cfe-active ';
					checked = ' checked="checked"';
				}
				self.elements[this.name].field.push(this);
				self.elements[this.name].element.push($(this).CFEReplaceWithReturn('<div class="custom-form-element cfe-radio' + cls + '"><div class="cfe-value"><input type="radio"' + id_attr + cls_attr + name_attr + value_attr + checked + ' /></div><div class="cfe-icon">' + self.code['radio'] + '</div></div>'));
			}
			/* checkbox */
			if(type == 'checkbox') {
				var value_attr = (typeof this.value === 'undefined') ? '' : ' value="' + this.value + '"';
				var cls = '';
				var checked = '';
				if(this.checked) {
					cls = ' cfe-active ';
					checked = ' checked="checked"';
				};
				self.elements[this.name]['element'] = $(this).CFEReplaceWithReturn('<div class="custom-form-element cfe-checkbox' + cls + '"><div class="cfe-value"><input type="checkbox"' + id_attr + cls_attr + name_attr + value_attr + checked + ' /></div><div class="cfe-icon">' + self.code['checkbox'] + '</div></div>');
				self.elements[this.name].field = self.elements[this.name]['element'].find(':input').first().get(0);
			}
			/* text, password */
			else if((type == 'text') || (type == 'password')) {
				var value_attr = (typeof this.value === 'undefined') ? '' : ' value="' + this.value + '"';
				var maxlength_attr = ((typeof this.maxLength === 'undefined') || (this.maxLength.toString() == '') || (this.maxLength < 1)) ? '' : ' maxLength="' + this.maxLength + '"';
				var pswd = '';
				if(type == 'password') {
					pswd = ' cfe-password';
				}
				self.elements[this.name]['element'] = $(this).CFEReplaceWithReturn('<div class="custom-form-element cfe-text' + pswd + '"><input type="' + type + '"' + id_attr + cls_attr + name_attr + value_attr + maxlength_attr + ' /></div>');
				self.elements[this.name].field = self.elements[this.name]['element'].find(':input').first().get(0);
				self.elements[this.name].buffer = (typeof this.value === 'undefined') ? '' : this.value;
				self.elements[this.name]['element'].trigger('open');
			}
			/* hidden */
			 else if(type == 'hidden') {
				var value_attr = (typeof this.value === 'undefined') ? '' : ' value="' + this.value + '"';
				self.elements[this.name]['element'] = $(this).CFEReplaceWithReturn('<div class="custom-form-element cfe-hidden"><input type="hidden"' + id_attr + cls_attr + name_attr + value_attr + ' /></div>');
				self.elements[this.name].field = self.elements[this.name]['element'].find(':input').first().get(0);
			}
			/* textarea */
			else if(type == 'textarea') {
				var value = (typeof this.value === 'undefined') ? '' : this.value;
				var rows_attr = ((typeof this.rows === 'undefined') || (this.rows.toString() == '') || (this.rows < 5)) ? '' : ' rows="' + this.rows + '"';
				var cols_attr = ((typeof this.cols === 'undefined') || (this.cols.toString() == '') || (this.cols < 8)) ? '' : ' cols="' + this.cols + '"';
				self.elements[this.name]['items'] = 0;
				self.elements[this.name]['size'] = (rows_attr == '') ? 5 : this.rows;
				self.elements[this.name]['step'] = 0;
				self.elements[this.name]['lheight'] = 0;
				self.elements[this.name]['scrollMargin'] = 0;
				self.elements[this.name]['temporaryStep'] = 0;
				self.elements[this.name]['mousePosition'] = 0;
				self.elements[this.name]['flag'] = 1;
				self.elements[this.name]['element'] = $(this).CFEReplaceWithReturn('<div class="custom-form-element cfe-textarea"><div class="cfe-scroller"><div class="cfe-arrow cfe-arrow-up">' + self.code.textareaUp + '</div><div class="cfe-scrollfield"><div class="cfe-scrollbar"></div></div><div class="cfe-arrow cfe-arrow-down">' + self.code.textareaDown + '</div></div><div class="cfe-area"><textarea' + id_attr + cls_attr + name_attr + '>' + value + '</textarea></div>');
				self.elements[this.name].field = self.elements[this.name]['element'].find(':input').first().get(0);
				self.elements[this.name]['scrollbar'] = self.elements[this.name]['element'].find('.cfe-scrollbar').first();
				self.elements[this.name]['arrow-up'] = self.elements[this.name]['element'].find('.cfe-arrow-up').first();
				self.elements[this.name]['arrow-down'] = self.elements[this.name]['element'].find('.cfe-arrow-down').first();
				self.elements[this.name]['element'].trigger('open');
			}
			/* select, select-multiple */
			else if((type == 'select-one') || (type == 'select-multiple')) {
				self.elements[this.name]['items'] = this.length;
				self.elements[this.name]['size'] = ((typeof this.size === 'undefined') || (this.size.toString() == '') || (this.size < 3)) ? 3 : this.size;
				self.elements[this.name]['step'] = 0;
				self.elements[this.name]['temporaryStep'] = 0;
				self.elements[this.name]['flag'] = 0;
				self.elements[this.name]['mousePosition'] = 0;
				var options_select = '';
				var options_cfe = '';
				var value = '';
				var text = '';
				var selected = '';
				for(var i = 0; i < this.length; i++) {
					text = (typeof this.options[i].text === 'undefined') ? '' : this.options[i].text;
					value = (typeof this.options[i].value === 'undefined') ? text : this.options[i].value;
					if(this.options[i].selected) {
						options_select += '<option value="' + value + '" selected="selected">' + text + '</option>';
						options_cfe += '<div class="cfe-item cfe-active">' + text + '</div>';
						selected = text;
					}
					else {
						options_select += '<option value="' + value + '">' + text + '</option>';
						options_cfe += '<div class="cfe-item">' + text + '</div>';
					}
				}
				if(this.multiple) {
					self.elements[this.name]['last'] = -1;
					self.elements[this.name]['element'] = $(this).CFEReplaceWithReturn('<div class="custom-form-element cfe-select cfe-multiple"><div class="cfe-value"><select multiple="multiple"' + id_attr + cls_attr + name_attr + '>' + options_select + '</select></div><div class="cfe-list"><div class="cfe-scroller"><div class="cfe-arrow cfe-arrow-up">' + self.code.selectUp + '</div><div class="cfe-scrollfield"><div class="cfe-scrollbar"></div></div><div class="cfe-arrow cfe-arrow-down">' + self.code.selectDown + '</div></div><div class="cfe-area">' + options_cfe + '</div></div></div>');
				}
				else {
					self.elements[this.name]['element'] = $(this).CFEReplaceWithReturn('<div class="custom-form-element cfe-select"><div class="cfe-value"><select' + id_attr + cls_attr + name_attr + '>' + options_select + '</select></div><div class="cfe-box"><div class="cfe-icon">' + self.code.selectOpen + '</div><div class="cfe-name">' + selected + '</div></div><div class="cfe-list"><div class="cfe-scroller"><div class="cfe-arrow cfe-arrow-up">' + self.code.selectUp + '</div><div class="cfe-scrollfield"><div class="cfe-scrollbar"></div></div><div class="cfe-arrow cfe-arrow-down">' + self.code.selectDown + '</div></div><div class="cfe-area">' + options_cfe + '</div></div></div>');
				}
				self.elements[this.name].field = self.elements[this.name]['element'].find(':input').first().get(0);
				self.elements[this.name]['scrollbar'] = self.elements[this.name]['element'].find('.cfe-scrollbar').first();
				self.elements[this.name]['arrow-up'] = self.elements[this.name]['element'].find('.cfe-arrow-up').first();
				self.elements[this.name]['arrow-down'] = self.elements[this.name]['element'].find('.cfe-arrow-down').first();
				if(this.multiple) self.elements[this.name]['element'].trigger('open');
			}
			/* button, submit, reset */
			else if((type == 'button') || (type == 'submit') || (type == 'reset')) {
				if(typeof this.value === 'undefined') {
					value_attr = '';
					value = '';
				}
				else {
					if((this.value == '') && ($(this).text() != '')) {
						this.value = $(this).text();
					}
					value_attr = ' value="' + this.value + '"';
					value = this.value;
				}
				var tp = '';
				if(type != 'button') {
					tp = ' cfe-' + type;
				}
				self.elements[this.name]['element'] = $(this).CFEReplaceWithReturn('<div class="custom-form-element cfe-button' + tp + '"><div class="cfe-value"><button type="' + type + '"' + id_attr + cls_attr + name_attr + '>' + value + '</button></div><div class="cfe-name">' + value + '</div></div>');
				self.elements[this.name].field = self.elements[this.name]['element'].find(':input').first().get(0);
			}
			/* file */
			else if(type == 'file') {
				self.elements[this.name]['element'] = $(this).CFEReplaceWithReturn('<div class="custom-form-element cfe-file"><div class="cfe-block"><div class="cfe-name">' + self.code.file + '</div><div class="cfe-fname"></div></div><div class="cfe-window"><input type="file"' + id_attr + cls_attr + name_attr + ' /></div></div>');
				self.elements[this.name].field = self.elements[this.name]['element'].find(':input').first().get(0);
			}
		}
	});
}


$.fn.CFEReplaceWithReturn = function(html) {
	var element = $(html);
	this.replaceWith(element);
	return element;
}


/*
. события для file
*/
