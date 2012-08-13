$(function(){
	/*图片描述信息*/
	var location=$('#location');
	var href=location.attr('href');
	if(href=="来自上传")
		location.attr('href','#');
	/*图片对齐*/
	//$('.pic-desc').hide();
	//pageCount count-prePageCount
	var pageCount=$('#main').attr('data-count');
	var countArr=pageCount.split('-');
	if(parseInt(countArr[0])>parseInt(countArr[1])){
	$('.pic-list').each(function(){
		$('.pic-item:first',$(this)).css('height',$(this).attr('data-h'));
	});
	}
	/*图片信息提示*/
	$('.pic-item').hover(function(){
		$('.pic-desc',this).css({"opacity":"0.8"}).stop().animate({top:'0'},300);//show();
	},function(){
		$('.pic-desc',this).css({"opacity":"1"}).stop().animate({top:'-55'},300);//.hide();
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
