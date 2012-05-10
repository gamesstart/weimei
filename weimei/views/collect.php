<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
	<HEAD>
		<META content="text/html; charset=utf-8" http-equiv=Content-Type>
		<title>收录到唯美小站</title>
		<meta name="author" content="h2ero" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link rel="shortcut icon" href="favicon.ico"/>
		<!-- Date: 2011-10-23 -->
		<link href="/style/css/bookmarklet.css" rel="stylesheet" />
	</head>
	<body>
	<div id="main">
	<div id="left">
		<img width="200px" src="<?=$src?>">
	</div>
	<div id="right">
		<form action="/pic/collect_do" method="post">
		<label for="name">图片标题:</label><br/>
		<input class='i-t' type="text" name="name" id="" value="<?=$name?>"/><br/>
		<label for="src">来自:</label><br/>
		<input class='i-t' type="text" name="location" value="<?=$location?>"/><br/>
		<input type="hidden" name="src" value="<?=$src?>" />
		<input id="submit" type="submit" value="收藏" />
		</form>
	</div>
	</div>
</body>
</html>
