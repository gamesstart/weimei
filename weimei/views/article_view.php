<?php $this->load->view ( 'header' ); ?>
<div id="main">
<div id="left">
<h1 id="title"><?=$title?></h1>
<pre>
<?=$content?>
</pre>
<div class="fn-clear"></div>
<div id="likes"><a href="#" id="like"></a><a href="#" class="like-tip">喜欢</a><a href="#" class="like-count"><?=$likeCount?></a><div class="fn-clear"></div></div>
<h2 class='h2-t'>这些人也喜欢······</h2>
<div id="like-user">
<?php foreach ($likeUser as $l){?>
<a href=/user/i/<?=$l->id?> title="<?=$l->name?>"><img src="<?=$l->icon?>"></a>
<?php }?>
</div>
<h2 class='h2-t'>回应······</h2>
<div id="commets">
<?php foreach ($comment as $key=>$c){?>

<div class="commentsItem<?if($key%2){echo '-r';}?>">
<?php if($key%2==0){ ?>
<a class="commentsAvatar" href="/user/i/<?=$c->userId?>"><img src="<?=getMiniPic($c->icon)?>"></a>
<?php }?>
<div class="reply-doc">
<div class="commentsMsg"><a href="/user/i/<?=$c->userId?>"><?=$c->username?></a>于<?=getTime(strtotime($c->date));?>说|<a class="reply" href="#reply" >回复</a></div>
<div class="cc-top"></div>
<div class="commentsContent"><p><?=$c->content?></p></div>
<div class="cc-bottom"></div>
</div>
<?php if($key%2){ ?>
<a class="commentsAvatar" href="/user/i/<?=$c->userId?>"><img src="<?=getMiniPic($c->icon)?>"></a>
<?php }?>
</div>
 <?php }?> 
</div>
<a name='reply'></a>
<div id="liftComment"><textarea id="comment-area" name="comment"
	class="textarea" ></textarea> <input type="button"
	class="red-btn" id="comment-submit" value="评论"></div>
	</div>
<!---left end--->
<div id="right">
	<div id="r-u-a" class="right-box">
	<h2 class='h2-t'>WHO...?</h2>
	<a href="/user/i/<?=$userId?>"><img src="<?=getMiniPic($icon)?>"></a><span><a href="/user/i/<?=$userId?>"><?=$username?></a><fn-clear>加入于<?=$date?></span>
	</div>
		<!-- right user msg end-->
	<div id="labels" class="right-box">
		<h2 class='h2-t'>标签...</h2>
			<div id="labels-list">
			<?php
			foreach ( $tag as $tag) {
				echo "<a href='/tag/$tag->name'>" . $tag->name. '</a>';
			}
			?>
			</div>
		<div class='fn-clear'></div>
		<div class="labels-add"><span>添加标签有助于整理你的分享，多个标签请用逗号分隔</span>
<fn-clear>
<form method="post"><input type="text" name="tags" id="tags" ><input type="button" id="tag-btn" class="red-btn" value="添加"> 
<input type="hidden" id="tid" name="tid" value="e<?=$id?>"></form>
</div>
	</div>
	<!--tags end -->

</div>
<div class="fn-clear"></div>
</div>
<?php
$this->load->view ( 'footer' );
?>