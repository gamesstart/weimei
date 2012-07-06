<?php $this->load->view ( 'header' ); ?>
<div id="main" data-count='<?=$imgs['count']?>'>

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
			<div id="pic">
<?php if(count($imgs)<3){?>
				<?php foreach($imgs as $img){ ?>
					<div class="pic-list" >
					<div class="pic-item">
						<div class="pic-desc">
							<h2><?=$img->name?></h2>
							<span>加入于<?=getTime(strtotime($img->date))?></span><a href="/user/i/<?=$img->userId?>"><?=$img->username?></a>
						</div>
						<a href="/album/detail/<?=$img->id?>"><img src="<?=getMiniPic($img->src)?>"></a>
					</div>
				</div>
				<?php } ?>
<?php }else{ $imgss=sort2Array($imgs); foreach ( $imgss[0] as $key=>$imgs ) { ?>
				<div class="pic-list" data-h='<?php echo $imgss[0][$key][0]->height-$imgss[1][$key][0]; ?>' >
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
<?php }} ?>
					
				<div class="fn-clear"></div>
			</div>
			<!--pic-->
			<div class="fn-clear"></div>
						</div>
<!---left end--->
<div id="right">
	<div id="r-u-v" class="right-box">
	<h2 class='h2-t'><?=$username?>:</h2><a href="#" id="like-u" likeUserId=<?=$userId?>>+喜欢</a>
	<img src="<?=$icon?>"><span><?=$about?></span>
	<div id="list-like-u">
	<h2 class="h2-t">这些人也喜欢Ta······</h2>
		<?php foreach ($liked as $l){?>
		<a href="/user/i/<?=$l->userId?>" title="<?=$l->username?>"><img src="<?=getMiniPic($l->icon)?>" /></a>
		<?php }?>
	</div>
	<div id="list-u-like">
	<h2 class="h2-t">Ta也喜欢这些人······</h2>
		<?php foreach ($like as $l){?>
		<a href="/user/i/<?=$l->userId?>" title="<?=$l->username?>"><img src="<?=getMiniPic($l->icon)?>" /></a>
		<?php }?>
	</div>
	</div>
		<!-- right user msg end-->
</div>
<!---left end--->
<div class="fn-clear"></div>
</div>
<div id="pagelist"><?=$page_list_link?></div>
<?php
$this->load->view ( 'footer' );
?>