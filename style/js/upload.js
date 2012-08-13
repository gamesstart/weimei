$(function(){		
	var isupload=0;
	$('#file_upload').uploadify({
				'fileTypeDesc' : 'Image Files',
		        'fileTypeExts' : '*.gif; *.jpg; *.png;*.jpeg', 
				'swf' : '/style/js/uploadify.swf',
				'uploader' :'/'+target+'/do_upload',
				'buttonImage':'/style/images/add_uploads.png',
				// 'buttonText' : '添加图片',
				'buttonClass' : 'button_upload',
				'width' : 83,
				'height' : 25,
				'uploadLimit':20,
				'method'   : 'post',
				// 'fileSizeLimit' : '100KB',
				'auto' : true,
				'multi' : true,
				'formData' : {'albumId':album_id,'userId':userId},
				'fileObjName' : 'userfile',
				'onInit'   : function(instance) {
					// setTimeout("$('#divAddFiles').show()",500);
					
		        }, 
				'onDialogClose'  : function(queueData) {
		        },
				'onUploadSuccess' : function(file, response, r) {
					msg=response.split('@');
					$('#showUploadPic').append("<a>"+msg[0]+"上传成功!</a>");
					$("input[name='allPicId']").val($("input[name='allPicId']").val()+','+msg[2]);
					if(isupload==0){
						// 设置封面
						$('#showUploadPic img').addClass('first');
						isupload=1;
						if($("input[name='firstId']").length)
						$("input[name='firstId']").val(msg[2]);
				}
				}
});});