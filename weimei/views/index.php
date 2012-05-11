<?php $this->load->view('header'); ?>
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
