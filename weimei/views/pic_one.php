<?php $this->load->view ( 'header' ); ?>

<div id="main">
<?php $this->load->view('sidebar'); ?>			
<div id="inner-main">
<div id="left">
<h1 pid='<?=$id?>'><?=$name?></h1>
<a id='like'></a>
</br>
<div class="height1"></div>
<p id="picOne">
<a  href="<?=$src?>"><img src="<?=$src?>" /></a>
</p>
<div class="br"></div>
<div id="commets">
<?php foreach ($comment as $c){?>
<div class="commentsItem">
<div class="commentsAvatar"><a href="/user/i/<?=$c->userId?>"><img src="<?=getMiniPic($c->icon)?>"></a>
</div>
<div class="reply-doc">
<div class="commentsMsg"><a href="/user/i/<?=$c->userId?>"><?=$c->username?></a>-----<?=$c->date?></div>
<p class="commentsContent"><?=$c->content?></p>
</div>
</div>
 <?php }?> 
</div>
<a name='reply'></a>
<h2 class='h2-t'>回应······</h2>

<div id="liftComment"><textarea id="comment-area" name="comment"
	class="textarea" ></textarea> <input type="button"
	class="red-btn" id="comment-submit" value="评论"></div>
</div>
<!---left end--->
<div id="right">
	<div id="r-u-a" class="right-box">
	<h2 class='h2-t'>WHO...?</h2>
	<a href="<?=site_url("/user/i/".$userId)?>"><img src="<?=getMiniPic($icon)?>"></a><span><a href="<?=site_url("./user/i/".$userId)?>"><?=$username?></a><br>加入于<?=$date?></span>
	</div>
		<!-- right user msg end-->
	<div id="labels" class="right-box">
		<h2 class='h2-t'>标签...</h2>
			<div id="labels-list">
			<?php
			foreach ( $tag as $tag) {
				echo "<a href='".site_url('/tag/'.$tag->name)."'>" . $tag->name. '</a>';
			}
			?>
			</div>
		<div class='br'></div>
		<div class="labels-add"><span>添加标签有助于整理你的分享，多个标签请用逗号分隔</span>
<br>
<form method="post"><input type="text" name="tags" id="tags" ><input type="button" id="tag-btn" class="red-btn" value="添加"> 
<input type="hidden" id="tid" name="tid" value="p<?=$id?>"></form>
</div>
	</div>
	<!--tags end -->
		<div  class="right-box" id="relate-pic">
	<h2 class='h2-t'>相关图片...</h2>
	<?php 
	
		foreach ($userPic as $pic){
			echo "<a href='/pic/$pic->id-".url_replace($pic->name)."'><img src='".miniPic($pic->src)."'/></a>";
		}
	?>
	</div>
	<!-- relate pic -->
</div>
<!---left end---></div>
<div class="br"></div>
</div>

<?php $this->load->view ( 'footer' ); ?>