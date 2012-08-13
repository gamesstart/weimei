<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
	<HEAD>
		<META content="text/html; charset=utf-8" http-equiv=Content-Type>
		<title><?=$title?></title>
		<meta property="qc:admins" content="1667770721551645" />
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
		<script src='/style/js/simpleStyle.js'></script>
		<script src='/style/js/main.js'></script>
		<script src='/style/js/jquery.fancybox-1.3.4.js'></script>
		<?php
		echo $css.$js;
		 ?>
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
		<div id="inner-header">
			<a href="/" id="logo"><img id="logo" src="/style/images/logo.png" /></a>
			<div id="menu">
				<a href="/pic"><img src="/style/images/img.png" alt="" /></a>
				<a href="/article"><img src="/style/images/text.png" alt="" /></a>
			</div>
			<div id="user-msg"></div>
			<div class="fn-clear"></div>
		</div>
		</div>
		<!--header-->
		<div id="slogan">
			<div id="latest-user">
			<h3 class="h2-t">最近加入...</h3>
			<div id="latest-user-avatar">
			<?php foreach ($users as $user){?>
			<a href="/user/i/<?=$user['id']?>"><img src="<?=getMiniPic($user['icon'])?>" alt="" /></a>
			<?php }?>
			</div>
			</div>
		</div>
		<!-- latest-user -->
		<div id="nav-bar"> 
		<div id="qq-share"><a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=http%3A%2F%2Fweimei.de%2F"><img src="/style/images/qq-share.png" /></a></div>
</div>
		<div id="main">
			<div id="pic" >
<?php $imgss=sort3Array($imgs); foreach ( $imgss[0] as $key=>$imgs ) { ?>
				<div class="pic-list" data-h='<?php echo $imgss[0][$key][0]['height']-$imgss[1][$key][0]; ?>' >
				<?php foreach($imgs as $img){ ?>
					<div class="pic-item">
						<div class="pic-desc">
							<h2><?=$img['name']?></h2>
							<span>加入于<?=getTime(strtotime($img['date']))?></span><a href="/user/i/<?=$img['userId']?>"><?=$img->username?></a>
						</div>
						<a href="/pic/<?=$img['id']?>"><img src="<?=getMiniPic($img['src'])?>"></a>
					</div>
				<?php } ?>
				</div>
<?php } ?>
					
				<div class="fn-clear"></div>
			</div>
			<!--pic-->
		</div>
			<div id="pagelist"><?=$page_list_link?></div>
		<!--main-->
		<div id="link">
			<h2 class="h2-t">酷站推荐······</h2>
			<li><a target="_blank" href="http://www.2weimei.com">爱唯美小站</a></li>
		</div>
<?php $this->load->view('footer'); ?>
