<div id="commets">
<?php foreach ($comment as $key=>$c){?>

<div class="commentsItem<?if($key%2){echo '-r';}?>">
<?php if($key%2==0){ ?>
<a class="commentsAvatar" href="/user/i/<?=$c['userId']?>"><img src="<?=getMiniPic($c['icon'])?>"></a>
<?php }?>
<div class="reply-doc">
<div class="commentsMsg"><a href="/user/i/<?=$c['userId']?>"><?=$c['username']?></a>于<?=getTime(strtotime($c['date']));?>说|<a class="reply" href="#reply" >回复</a></div>
<div class="cc-top"></div>
<div class="commentsContent"><p><?=$c['content']?></p></div>
<div class="cc-bottom"></div>
</div>
<?php if($key%2){ ?>
<a class="commentsAvatar" href="/user/i/<?=$c['userId']?>"><img src="<?=getMiniPic($c['icon'])?>"></a>
<?php }?>
</div>
 <?php }?> 
</div>
<a name='reply'></a>
<div id="liftComment"><textarea id="comment-area" name="comment"
	class="textarea" placeholder="心里话啦？别带走."></textarea> <input type="button" class="red-btn" id="comment-submit" value="评论"></div>
</div>