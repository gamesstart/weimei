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
		<link rel="stylesheet/less" href="/style/css/style.less">
		<link rel=stylesheet type=text/css href='/style/css/base.css'>
		<link rel=stylesheet type=text/css href='/style/css/fancybox/jquery.fancybox-1.3.4.css'>
		<script src='/style/js/jquery-1.7.2.min.js'></script>
		<script src='/style/js/less-1.3.0.min.js'></script>
		<script src='/style/js/main.js'></script>
		<script src='/style/js/jquery.fancybox-1.3.4.js'></script>
		<?php
		echo $css.$js;
		 ?>
		<script src='/style/js/simpleStyle.js'></script>
		<script type="text/javascript">
		var baseurl='<?=base_url()?>';
		var siteurl='<?=site_url()?>';
		var album_id='<?=$albumId?>';
		var target='<?=$target?>';
		</script>
	</head>
<body>
	<div id="container">
		<div id="header">
			<a href="#"> <img id="logo" src="/style/images/logo.png" />
			</a>
			<div id="menu">
				<a href="">首页</a>| <a href="" id="m-popular">热门</a>| <a href=""
					class="m-popular">今日</a><a href="" class="m-popular">本周</a><a
					href="" class="m-popular">本月</a><a href="" class="m-popular">今年</a><a
					href="" class="m-popular">全部</a><a href="" id="m-tag">Tag</a>| <a
					href="">用户</a>| <a href="">关于</a>
			</div>
			<div id="user-msg"></div>
		</div>
		<!--header-->

		<div id="main">
			<div id="pic">
				
<?php $imgss=array_chunk($imgs,7); foreach ( $imgss as $imgs ) { ?>
				<div class="pic-list">
				<?php foreach($imgs as $img){ ?>
					<div class="pic-item">
						<div class="pic-desc">
							<h2><?=$img->name?></h2>
							<span>加入于<?=getTime(strtotime($img->date))?></span><a href="<?=$img->username?>"><?=$img->username?></a>
						</div>
						<a href="/pic/<?=$img->id?>"><img src="<?=getMiniPic($img->src)?>"></a>
					</div>
				<?php } ?>
				</div>
<?php } ?>
					
				<div class="fn-clear"></div>
			</div>
			<!--pic-->
			<div id="pagelist">
									<?=$page_list_link?>
			</div>
			<div class="fn-clear"></div>
		</div>
		<!--main-->
		<div id="link">
			<h2 class="h2-t">酷站推荐······</h2>
			<li><a target="_blank" href="http://www.2weimei.com">爱唯美小站</a></li>
			<li><a target="_blank" href="http://www.newborner.com">明星宝贝网</a></li>
		</div>
<?php $this->load->view('footer'); ?>
