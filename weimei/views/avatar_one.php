<?php $this->load->view ( 'header' ); ?>
<div id="main">
<div id="left">
<h1 id="title"> <?=$imgs[0]->name?> </h1>
<div class="height1"></div>
<div id="avatarShowAll">
<?php foreach ($imgs as $img){?>
<li><img src="<?=$img['src']?>" alt="<?=$img['name']?>" /></li>
<?php }?>	
<div class="fn-clear"></div>
</div>
<div id="likes"><a href="#" id="like"></a><a href="#" class="like-tip">喜欢</a><a href="#" class="like-count"><?=$imgs[0]['likeCount']?></a><div class="fn-clear"></div></div>
<h2 class='h2-t'>这些人也喜欢······</h2>
<div id="like-user">
<?php foreach ($likeUser as $l){?>
<a href=/user/i/<?=$l['id']?> title="<?=$l['name']?>"><img src="<?=$l['icon']?>"></a>
<?php }?>
</div>
<h2 class='h2-t'>回应······</h2>
<?php $this->load->view ( 'showComment' ); ?>
<!---left end--->
<div id="right">
	<div id="r-u-a" class="right-box">
	<h2 class='h2-t'>WHO...?</h2>
	<a href='/user/i/<?=$imgs[0]['userId']?>'><img src="<?=getMiniPic($imgs[0]['icon'])?>"></a><span><a href='/user/i/<?=$imgs[0]['userId']?>'><?=$imgs[0]['username']?></a><?=$imgs[0]['date']?></span>
	</div>
		<!-- right user msg end-->
	<div id="labels" class="right-box">
		<h2 class='h2-t'>标签...</h2>
	<div id="labels-list">
		<?php foreach ( $tag as $tag) { ?>
			<a href="/tag/<?=$tag['name']?>"><?=$tag['name']?></a>
		<?php } ?>
		</div>
		<div class='fn-clear'></div>
		<div class="labels-add"><span>添加标签有助于整理你的分享，多个标签请用逗号分隔</span>
<br>
<form method="post"><input type="text" name="tags" id="tags" placeholder="标签1,标签2,标签3"><input type="button" id="tag-btn" class="red-btn" value="添加"> 
<input type="hidden" id="tid" name="tid" value="a<?=$id?>"></form>
</div>
	</div>
	<!--tags end -->
</div>
<div class="fn-clear"></div>
</div>
<?php
$this->load->view ( 'footer' );
?>