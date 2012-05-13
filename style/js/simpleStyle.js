$(function(){
	var pHeight=0;
	$('.pic-list').each(function(){
		if(!pHeight)
			pHeight=$(this)[0].clientHeight;
		if(pHeight>$(this)[0].clientHeight)
			pHeight=$(this)[0].clientHeight;
	});
	//
	//底部图片对齐
	$('.pic-list').css('height',pHeight-40+'px');
	//图片信息提示
	$('.pic-item').hover(function(){
		$('.pic-desc',this).show();
	},function(){
		$('.pic-desc',this).hide();
	}).click(function(){
		//div实现a
		location.href=$('a:first',this).attr('href');
	});
	/*热门菜单*/
	var is_befored=0;
	$('#m-popular').click(function(){
		if(is_befored==0){
			$('#m-tag').before('|');
			is_befored=1;
		}
		$(this).show('fast',function(){
			  $(this).next(".m-popular").show("fast", arguments.callee)
		})
		return false;
	});
});
