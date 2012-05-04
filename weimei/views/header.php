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
				 <?php
				 //改用cookie判断
				 /*
			 $this->load->library('session');
          if($this->session->userdata('userId'))
          echo "你好,".$this->session->userdata('username')."&nbsp;&nbsp;<a class='link1' href=".site_url('user/set').">设置</a> <a class='link1' href=".site_url('user/login_out').">退出</a>";
          	else
			 		echo "你好，请 <A class=link1 href=".site_url('user/login').">登录</A> 或者 <A class=link1 href=".site_url('user/reg').">注册</A>，<A class=link3 href=".site_url('user/lost_pwd').">忘记密码？</A>";
           	*/	?>
				</div>
			</div>
		</div>
		<!---header end--->
		<div id="menu">
			<ul id="inner-menu">
				<li> <A class="selected" href="/">首页</A> </li>
 				<li> <A  href="/pic/">美图</A> </li>
				<li> <A  href="/avatar/">头像</A> </li>
				<li> <A  href="/article/">文字</A> </li>
				<!--
				<li> <A  href="/music')?>">一日一♫</A> </li>
				<li> <A  href="album')?>">专辑</A> </li>	
				<li> <A class="selected" href="/">标签</A> </li>
				<li> <A class="selected" href="/">活跃用户</A> </li>
				  -->
			</ul>
		</div>
		<!---menu end--->
		<div class="br"></div>