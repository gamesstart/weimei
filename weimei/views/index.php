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
<!-- header -->
		<div id="main">
			<?php $this->load->view('sidebar'); ?>			
			<div id="inner-main">
				<div id="left">
					<div class="height1"></div>
					<div id="class-bar">
						<span>公告:唯美小站~刚刚上线，大家多多支持哦哦，争做最好的图片分享网站，完善中:)</span>
					</div>
					<div class="br"></div>
					<div id="index-pic">
<?php foreach ( $imgs as $img ) { ?>
<div class="picbox">
<div class="imgInnerBox">
<div class="img"><a href="/pic/<?=$img->id?>"><img src="<?=getMiniPic($img->src)?>"></a></div>
<div class="imgDesc"><a  class='album-name' href="/pic/<?=$img->id?>"><?=$img->name?></a></br>
<span><a href="<?=$img->username?>"><?=$img->username?></a>于<?=getTime(strtotime($img->date))?></span></div>
</div>
</div>
<?php } ?>
</div>
<div class="br"></div>
<ul id="pagelist">
					<?=$page_list_link?>
						</ul>
				</div>
				<!---left end--->
				<div id="right">
				<div id="weimei-say">
				<h3>唯美小站(WeiMei.de)</h3>
				<p>
				如果一切美好分为美好和不美好的话，那我希望美好停止于不美好，不美好也停止于美好。
				</p>
				</div>
				<div id='i-tag'>
				<h3>热门Tag....</h3>
				<p>
					<?php
					foreach ( $tags as $tag) {
						echo "<a href='/tag/$tag->name'>" . $tag->name. '</a>';
					}
					?>
				</p>
				</div>
				<div class='br'><</div>
				<div id="latest-user">
					<h3>最近加入...</h3>
					<div id="latest-user-avatar">
					<?php foreach ($users as $user){?>
					<a href="/user/i/<?=$user->id?>"><img src="<?=getMiniPic($user->icon)?>" alt="" /></a>
					<?php }?>
					</div>
				<div id="latest-comments">
				<h3>最新评论...</h3>
				<?php foreach ($comments as $comment){?>
				<div class="l-c-item"><a href="/u/<?=$comment->userId?>/pic/" class="l-c-i-avatar"><img alt="" src="<?=getMiniPic($comment->icon)?>" style="width: 48px; height: 48px;"></a> <span><a href="#"><?=$comment->username?></a>在<?=getTime(strtotime($comment->date))?>说:</span> <p><?=$comment->content?></p> </div>
				<?php }?>
				</div>
				</div>
				</div>
				<!---right end--->
			</div>
			<div class="br"></div>
			<div id="link">
			<h2 class="h2-t">酷站推荐······</h2>
			<li><a target="_blank" href="http://www.2weimei.com">爱唯美小站</a></li> 
			<li><a target="_blank" href="http://www.newborner.com">明星宝贝网</a></li> 
			</div>
			<div class="br"></div>
		</div>
<?php $this->load->view('footer'); ?>
