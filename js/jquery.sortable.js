/*
 * The MIT License
 * 
 * Copyright (c) 2008-2009 Olle Törnström studiomediatech.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author  Olle Törnström olle[at]studiomediatech[dot]com
 * @since   2009-09-24
 */
(function ($) {
	$.fn.sortable = function (options) {
		$(this).get(0).settings = $.extend({}, {
				handler : 'php/jquery.sortable.php',
				upClass : 'up',
				downClass : 'down',
				sorterClass : 'sorting'
		}, options);
		return this.each(function () {
			$.fn.sortable.init(this);
		});
	};
	$.fn.sortable.init = function (list) {
		$(list).find('li').each(function () {
			$(this).append('<span class="' + list.settings.sorterClass + '"><button class="' + list.settings.upClass + '" /><button class="' + list.settings.downClass + '" /></span>');
			$.fn.sortable.bind(this, list);
		});
	};
	$.fn.sortable.bind = function (listItem, list) {
		$(listItem)
				.find('button.up')
				.click(function (ev) {
					$.fn.sortable.sort(ev, listItem, 'up', list);					
				})
				.parent()
				.find('button.down')
				.click(function (ev) {
					$.fn.sortable.sort(ev, listItem, 'down', list);	
				})
				.parent()
				.parent()
				.hover(
						function () { $('button', this).css({opacity : 1}); },
						function () { $('button', this).css({opacity : 0}); }
				)
				.find('button')
				.css({opacity : 0});	
	};
	$.fn.sortable.sort = function (ev, el, direction, list) {
		ev.stopPropagation();
		$.ajax({
			type : 'POST',
			url : list.settings.handler,
			data : {id : $(el).attr('id'), direction : direction},
			success : function () {
				if (direction === 'up') {
					$(el).prev('li').before(el);					
				} else {
					$(el).next('li').after(el);
				}
				$(el).find('button').css({opacity : 0});
			}
		});
	};
})(jQuery);