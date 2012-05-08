/*Saturday, October 22 2011 02:33*/
/*Cookie*/
	var Cookie = {
			get : function(name) {
				var cookieName = encodeURIComponent(name) + "=", cookieStart = document.cookie.indexOf(cookieName), cookieValue = null;
				if(cookieStart > -1) {
					var cookieEnd = document.cookie.indexOf(";", cookieStart);
					if(cookieEnd == -1) {
						cookieEnd = document.cookie.length;
					}
					cookieValue = decodeURIComponent(document.cookie.substring(cookieStart + cookieName.length, cookieEnd));
				}
				return cookieValue;
			},
			set : function(name, value, expires, path, domain, secure) {
				var cookieText = encodeURIComponent(name) + "=" + encodeURIComponent(value);
				if( expires instanceof Date) {
				cookieText += ";expires=" + expires.toGMTString();
				}
				if(path) {
					cookieText += ";path=" + path;
				}
				if(domain) {
					cookieText += ";domain=" + domain;
				}
				if(secure) {
					cookieText += ";secure";
				}
				document.cookie = cookieText;
			},
			unset : function(name, path, domain, secure) {
				this.set(name, "", new Date(0), path, domain, secure);
			}
		}
	
	/*登录信息*/
	var userId=Cookie.get('userId');
	var username=Cookie.get('username');
	var icon=decodeURI(Cookie.get('icon'));
	var session=Cookie.get('weimei');
	if(!session){
		Cookie.unset('userId','/','.'+getDomain());
		Cookie.unset('username','/','.'+getDomain());
	}
$(function() {
	//常用变量
	var tid=$('#tid').val();
    /*slider*/
	if($('#slider').length){
	$('#slider').nivoSlider();
	}
	/*fancybox*/
	$("#picOne a").fancybox();
	/*getDomain 获取顶级域名*/
	function getDomain(){
		var url=document.domain;
		if(48<=url[url.length-1].charCodeAt()<=57)
		return url;
		else{
		var domain='';
		url=url.split('.');
		if(url.length>2){
		domain+=url.pop();
		domain=url.pop()+'.'+domain;
		return domain;
		}else{
		return url;
		}
		}
	}
	
	if(userId){
		$('#user-msg').hide();
		$('#sidebar-widget-profile').html('<img src="'+icon+'"><ul class="main"><li class="profile-info"><a href="/user/i/'+userId+'">h2ero</a></li><li class="profile-info"> <a href="/user/set/">设置</a> </li><li class="profile-info"> <a href="/user/login_out">退出</a></li></ul><div class="br"></div>');
	}else{
	}
	/*退出清除cookie*/
	$('#loginout').live('click',function(){
		Cookie.unset('userId','/','.'+getDomain());
		Cookie.unset('username','/','.'+getDomain());
		Cookie.unset('weimei','/','.'+getDomain());
		/*常用变量置空*/
		userId='';
	});
	
	/* 添加tag */
	$('#tag-btn').click(function(){
    if(!userId){
    	alert('只有登录用户才能添加标签');
    }else{
    	tags=$('#tags').val().trim();
    	if(!tags){
    	alert('tag为空，请输入要添加的Tag!');
    	}else{
		//替换掉全角的，
		var re=/，/g;
		tags=tags.replace(re,',');
		tag=tags.split(',');
		var id=tid;
		$.ajax({
			type:'post',
			url:'../../tag/add_tag',
			data:'tags='+tags+'&id='+id,
			success:function(msg){
				for(var i=tag.length-1;i>=0;i--){
					$('#labels-list').append('<a href="'+siteurl+'/tag/'+tag[i]+'">'+tag[i]+'</a>');
				}
				$('#tags').val('')
			}
		});	
    	}
    }
	});
	/*添加评论*/
	$('#comment-submit').click(function(){
		var comment=$('#comment-area').val();
		if(userId&&comment){
			var id=(tid?tid:tid)?tid:tid;
			$('#commets').append('<div class="commentsItem"><div class="commentsAvatar"><a><img style="width:45px;" src="'+icon+'"></a></div><div class="reply-doc"> <div class="commentsMsg">'+username+'</div> <p class="commentsContent">'+comment+'</p></div></div>');
			$.ajax({
				type:'post',
				url:siteurl+'/comment/add_comment',
				data:'comment='+comment+'&id='+id,
				success:function(msg){
					$('#comment-area').val('');
				}
			});
		}else if(userId){
			alert("评论不能为空");
		}else{
			alert("请登录后再进行评论");
		}
		
		});
	
	/*添加回复*/
	$(".commentsItem").hover(function(){
		//$('.commentsContent',$(this))
		$(this).append('<a class="reply" href="#reply" style="float:right;margin-top:8px;">回复</a>');
	},
	function(){
		$('.reply',$(this)).remove();
	}
	);
	$(".reply").live('click',function(){
		var name=$('.commentsMsg a',$(this).parent()).text();
		$('#comment-area').val('@'+name+' ').focus();
		return false;
	});

	/*头像预览*/
	if($("#avatarShowAll img").length){
	$('body').prepend('<div id="show"><img src=""></div>');
	$("#avatarShowAll img").mousemove(function(event){
		$('#show img').attr('src',$(this).attr('src'));
		var top = document.body.scrollTop || document.documentElement.scrollTop;
		$('#show').show().css('left',20+event.clientX+'px').css('top',20+event.clientY+top+'px');
	}).mouseout(function(){
		$('#show').hide();
	});
	}
	/*修改标题*/
	if($('#r-u-a span').length&&$('#left h1').length&&tid[0]=='p'){
		var title=$('#left h1');
     	//没有标题的文档插入未命名
		var t=title.text();
		if(t==''){
			title.text('未命名');
			t=title.text();
		}
		if($('#r-u-a span a').text()==$('#sidebar-widget-profile a:first').text()&&userId)
			$('#r-u-a').append("<div class='edit'><a href='#' class='red-btn'>修改标题</a></div>");
		$('#r-u-a .edit').click(function(){
			title.html("<input type='text' id='change-title' name='title'/><input class='red-btn'  type='button' id='rename-btn'  value='确认修改'/><input id='cancel-change' class='red-btn'  type='button' value='取消'/>");
		});
		//提交修改后的标题
		$('#rename-btn').live('click',function(){
			if($('#change-title').val()=='')
				alert('标题不能为空!');
			else{
			   //ajax
			   $.ajax({
				   type : 'POST',
				   url : siteurl+'/pic/rename',
				   data : 'id='+$('h1').attr('pid')+'&name='+$('#change-title').val(),
				   success : function(msg) {
					   title.text($('#change-title').val());
				   }
			   });
		   
			}
		});
		//取消恢复原来标题
		$('#cancel-change').live('click',function(){
		   title.text(t);
		});
	}
	/*修改文章*/
	if($('#r-u-a span').length&&$('#left h1').length&&tid[0]=='e'){
		if($('#r-u-a span a').text()==$('#sidebar-widget-profile a:first').text()&&userId)
		$('#r-u-a').append("<div class='edit'><a href='"+siteurl+'/article/edit?id='+tid.replace(tid[0],'')+"' class='red-btn'>编辑文章</a></div>");
	}
	/*前期tag没有标题补全*/
	$('.e-t').each(function(){
		if($(this).text()=='')
			$(this).text('未命名');
	});
	/*提交数据后禁用submit*/
	//$("input['submit']").live('click',function(){
		//$(this).attr('disable','disabled');
	//});
	/*like*/
	$('#like').click(function(){
		console.log(userId);
		if(userId){
		   $.ajax({
			   type : 'POST',
			   url : '/like',
			   data :'id='+tid,
			   success : function(msg) {
				   var likeCount=$(".like-count");
				   likeCount.text(parseInt(likeCount.text())+parseInt(msg));
			   }
		   });
		}else{
			alert('对不起，只有登录才能点击喜欢 : )');
		}
		return false;
	});
	
	
		
	/*
	* 数据验证
	*/
	//reg
	$("#regForm input[type=text],#regForm input[type=password]").focusout(function(){
		if(!$(this).val()){
			$(this).parent().find('.error').text('对不起！该选项不能为空.');
			$('#regBtn').attr('disabled','true');
		}
		else{
			$(this).parent().find('.error').text('');
			$('#regBtn').removeAttr('disabled');
		}
		
	});
	/*pic list wallfall*/
	var $container = $('#index-pic,#pic');

	$container.imagesLoaded( function(){
	  $container.masonry({
	    itemSelector : '.picbox',
	    isFitWidth: true 
	  });
	});



	
	
	
	
});
