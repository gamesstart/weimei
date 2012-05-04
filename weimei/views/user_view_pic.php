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
<?php foreach ( $imgs as $img ) { ?>
<div class="picbox">
<div class="imgInnerBox">
<div class="img"><a href="<?=site_url ( '/pic/one/' . $img->id )?>"><img src="<?=getMiniPic($img->src)?>"></a></div>
<div class="imgDesc"><a  class='album-name' href="<?=site_url ( '/pic/one/' . $img->id )?>"><?=$img->name?></a></br>
<span>发表于<?=getTime(strtotime($img->date))?></span></div>
</div>
</div>
<?php } ?>
</div>
<div class="br"></div>
<ul id="pagelist">
					<?=$page_list_link?>
						</ul>
<!---pic end---></div>
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
</div>
<?php
$this->load->view ( 'footer' );
?>