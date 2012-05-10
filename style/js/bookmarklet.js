var script=document.createElement('script');
script.type='text/javascript';
script.src='http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.min.js';  //这里的file.js改成你需要读取的文件。
document.getElementsByTagName('head')[0].appendChild(script);
function urlencode(str) {
	str = (str+'').toString();
	return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').
		replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
}
script.onload=function(){
				$(function(){
					$('img').each(function(){
						var img=$(this);
						var src=urlencode(img[0].src)+'&location='+urlencode(window.location);
						var name=urlencode(document.title);
						if(img[0].width>240){
							img.css({"border":"1px red solid","display":"inline"});
							if(img.parent()[0].nodeName=='A'){
							}else{
								img.wrap("a");
							}
								img.after('<a class="C-a-wm" style="margin-left:-125px;position:absolute;z-index:222222;" href="http://weimei.com/pic/collect/?src='+src+'&name='+name+'"><img style="border:none;" src="http://localhost/demo/collect.png"/></a>');}
					});
					$('.C-a-wm').hover(function(){
						this.style.cursor = 'pointer';
					});
					$('.C-a-wm').click(function(){
						window.open(this.href, false, 'menubar=0,location=0,width=530,height=330');	
						return false;
					});
				});
			}