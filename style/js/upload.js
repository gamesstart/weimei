$(function() {
	var isupload=0;
	$('#file_upload').uploadify({
		'uploader' : baseurl+'style/js/uploadify.swf',
		'script' : siteurl+'/'+target+'/do_upload',
		'cancelImg' : baseurl+'style/images/uploadify-cancel.png',
		'buttonImg' : baseurl+'style/images/add_uploads.png',
		'width':83,
		'height':25,
		'auto' : true,
		'multi'       : true,
		'scriptData' :{'albumId':album_id,'userId':userId},
		'fileDataName' : 'userfile',
		'onComplete' : function(e, queueId, fileObj, response) {
			msg=response.split('@');
			$('#showUploadPic').append("<a>"+msg[0]+"上传成功!</a>");
			$("input[name='allPicId']").val($("input[name='allPicId']").val()+','+msg[2]);
			if(isupload==0){
				//设置封面
				$('#showUploadPic img').addClass('first');
				isupload=1;
				if($("input[name='firstId']").length)
				$("input[name='firstId']").val(msg[2]);
			}
		}
	});
	});