<?php $this->load->view ( 'header' ); ?>
<div id="main">
<div id="left">
<div id="class-bar">
<span>Ta的分类 · · · · · ·</span>
<ul class='u-class'>
<li><a href='/u/<?=$userId?>/pic/'>美图</a></li>
<li><a href='/u/<?=$userId?>/tag/'>标签</a></li>
<li><a href='/u/<?=$userId?>/comment/'>留言</a></li>
<li><a href='/user/i/<?=$userId?>/'>个人档</a></li>
<!--<li><a>收录的专辑</a></li>
<li><a>收录的美图</a></li>
  -->
<li><a href='#'>专辑</a></li>
</ul>
 </div>
<h2 class='h2-t'>TAGS······</h2>
	<div id="labels-list">
		<?php
		foreach ( $tag as $tag) {
			echo "<a href='".site_url('/tag/'.$tag['name'])."'>" . $tag['name']. '</a>';
		}
		?>
		</div>
</div>
<!---left end--->
<div id="right">
	<div id="r-u-v" class="right-box">
	<h2 class='h2-t'><?=$username?>:</h2><a href="#" id="like-u" likeUserId=<?=$userId?>>+喜欢</a>
	<img src="<?=$icon?>"><span><?=$about?></span>
			<div id="list-like-u">
	<h2 class="h2-t">这些人也喜欢Ta······</h2>
		<?php foreach ($liked as $l){?>
		<a href="/user/i/<?=$l['userId']?>" title="<?=$l['username']?>"><img src="<?=getMiniPic($l['icon'])?>" /></a>
		<?php }?>
	</div>
	<div id="list-u-like">
	<h2 class="h2-t">Ta也喜欢这些人······</h2>
		<?php foreach ($like as $l){?>
		<a href="/user/i/<?=$l['userId']?>" title="<?=$l['username']?>"><img src="<?=getMiniPic($l['icon'])?>" /></a>
		<?php }?>
	</div>
	</div>
		<!-- right user msg end-->
</div>
<!---left end--->
</div>
<?php
$this->load->view ( 'footer' );
?>