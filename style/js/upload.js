$(function(){		
	if($('#file_upload').length){
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
});}else{
/**
 * 上传裁剪头像
 */

	function updateCoords(c)
	{
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
		
		if (parseInt(c.w) > 0)
        {
          var rx = 200 / c.w;
          var ry = 200 / c.h;
          //alert($('#cropbox')[0].width);
          //w=$('#cropbox').css('width').replace(/px/,'');
          //h=$('#cropbox').css('height').replace(/px/,'');
          
          w=$('.jcrop-holder').css('width').replace(/px/,'');
          h=$('.jcrop-holder').css('height').replace(/px/,'');
          $('#user-avatar1').css({
            width: Math.round(rx * w )+ 'px',
            height: Math.round(ry * h)+ 'px',
            marginLeft: '-' + Math.round(rx * c.x) + 'px',
            marginTop: '-' + Math.round(ry * c.y) + 'px'
          });
          var rx = 100 / c.w;
          var ry = 100 / c.h;
          $('#user-avatar2').css({
            width: Math.round(rx * w )+ 'px',
            height: Math.round(ry * h)+ 'px',
            marginLeft: '-' + Math.round(rx * c.x) + 'px',
            marginTop: '-' + Math.round(ry * c.y) + 'px'
          });
          var rx = 48 / c.w;
          var ry = 48 / c.h;
          $('#user-avatar3').css({
            width: Math.round(rx * w )+ 'px',
            height: Math.round(ry * h)+ 'px',
            marginLeft: '-' + Math.round(rx * c.x) + 'px',
            marginTop: '-' + Math.round(ry * c.y) + 'px'
          });
        }
	  
	};
	var jcrop_api;
	$('#cropbox').Jcrop({
		aspectRatio: 1,
		setSelect:   [ 0, 0, 200,200],
		 onChange: updateCoords,
		onSelect: updateCoords
	},function(){
	  jcrop_api = this;
	  var bounds = this.getBounds();
	  boundx = bounds[0];
	  boundy = bounds[1];
	});

	
	
	$('#avatar_upload').uploadify({
		'fileTypeDesc' : 'Image Files',
        'fileTypeExts' : '**.jpg;*.jpeg', 
		'swf' : '/style/js/uploadify.swf',
		'uploader' :'/user/upload_icon',
		//'buttonImage':'/style/images/add_uploads.png',
		'buttonText' : '添加图片',
		'buttonClass' : 'red-btn',
		'width' : 50,
		'height' : 22,
		'uploadLimit':10,
		'method'   : 'post',
		// 'fileSizeLimit' : '100KB',
		'auto' : true,
		'multi' : true,
		'formData' : {'userId':userId},
		'fileObjName' : 'userfile',
		'onInit'   : function(instance) {
			// setTimeout("$('#divAddFiles').show()",500);
			
        }, 
		'onDialogClose'  : function(queueData) {
        },
		'onUploadSuccess' : function(file, response, r) {
			rand=Math.floor(Math.random()*1000);
			$('#cropbox,#user-avatar1,#user-avatar2,#user-avatar3').attr('src','/urlfun/nocache/'+rand);
			jcrop_api.setImage('/urlfun/nocache/'+rand);
			var v=[ 0, 0, 200,200];
			jcrop_api.animateTo(v);
		}
});
	
	$('#crop').click(function(){
		$.ajax({
			type:'post',
			url:'/user/cut_icon',
			data:'x='+$('#x').val()+'&y='+$('#y').val()+'&h='+$('#h').val()+'&w='+$('#w').val(),
			success:function(msg){
				alert('设置成功！');
			}
		});	
	});
}
});