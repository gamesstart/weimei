<?php $this->load->view ( 'header' ); ?>
<div id="main">

<div id="left">
<div id="class-bar">
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
				
<?php $imgss=sort2Array($imgs); foreach ( $imgss[0] as $key=>$imgs ) { ?>
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
<?php } ?>
					
				<div class="fn-clear"></div>
			</div>
			<!--pic-->
<div id="pagelist">
									<?=$page_list_link?>
			</div>
			<div class="fn-clear"></div>
						</div>
<!---left end--->
<div id="right">
	<div id="r-u-a" class="right-box">
	<h2 class='h2-t'><?=$username?>:</h2>
	<img src="<?=$icon?>"><span><?=$date?></span>
	<dd><?=$about?></dd>
	</div>
		<!-- right user msg end-->
</div>
<!---left end--->
<div class="fn-clear"></div>
</div>
<?php
$this->load->view ( 'footer' );
?>