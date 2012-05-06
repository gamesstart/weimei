<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
	<HEAD>
		<META content="text/html; charset=utf-8" http-equiv=Content-Type>
		<title><?=$title?></title>
		<meta name="author" content="h2ero" />
		<meta name="keywords" content="<?=$keywords?>" />
		<meta name="description" content="<?=isset($description)?$description:''?>" />
		<link rel="shortcut icon" href="favicon.ico"/>
		<!-- Date: 2011-10-23 -->
		<link href="/style/css/style.css" rel="stylesheet" />
		<link rel=stylesheet type=text/css href='/style/css/fancybox/jquery.fancybox-1.3.4.css'>
		<script src='/style/js/jquery.min.js'></script>
		<script src='/style/js/jquery.fancybox-1.3.4.js'></script>
		<script src='/style/js/jquery.masonry.min.js'></script>
		<?php
		echo $css.$js;
		 ?>
		<script src='/style/js/main.js'></script>
		<script type="text/javascript">
		var baseurl='<?=base_url()?>';
		var siteurl='<?=site_url()?>';
		var album_id='<?=$albumId?>';
		var target='<?=$target?>';
		</script>
	</head>
	<body>
		<div id="header">
			<div id="inner-header">
				<div id="logo">
					<a href="<?=base_url()?>"><img src="/style/images/logo.png"/></a>
				</div>
				<div id="user-msg">
					<a class="login" href="/user/login/"><span>登录</span></a>
					<a class="join" href="/user/reg/"><span>加入</span></a>
				</div>
				<div class="search">
			      <img src="/style/images/icon-search.gif">	
				    <input type="text" title="Search" value="Search" id="search" name="q">
				</div><!--END SEARCH-->
			</div>
		</div>
		<!---header end--->

		<div class="br"></div>