<html>
<head>
<title>唯美小站WeiMei.de提示信息</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
*{
	margin:0px;
	padding:0px;
}
body{
	background:#EAEAEA;
}
div{
	background:#F8F8F8;
}
div h2{
	background: rgb(167,199,220); /* Old browsers */
background: -moz-linear-gradient(top, rgba(167,199,220,1) 0%, rgba(133,178,211,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(167,199,220,1)), color-stop(100%,rgba(133,178,211,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(167,199,220,1) 0%,rgba(133,178,211,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(167,199,220,1) 0%,rgba(133,178,211,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(167,199,220,1) 0%,rgba(133,178,211,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(167,199,220,1) 0%,rgba(133,178,211,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a7c7dc', endColorstr='#85b2d3',GradientType=0 ); /* IE6-9 */
color: #FFFFFF;
text-align: center;
}
</style>
<script type="text/javascript">
function JumpUrl(){
location='<?=$url?>?referer=<?=$_SERVER['HTTP_REFERER']?>';
}
setTimeout('JumpUrl()',1000);
</script>
</head>
<body>
<div style='border-radius: 2px 2px 0 0;text-align:center;color:#000; box-shadow: 1px 1px 7px #000000; height: 180px; margin: 60px auto; width: 300px;'><h2 style=''>消息提示</h2><div style="font-size: 10pt;margin-top: 30px;"><br><?=$msg?>！<br><a href="<?=$url?>">如果你的浏览器没反应，请点击这里...</a><br></div></div>
</body>
</html>
