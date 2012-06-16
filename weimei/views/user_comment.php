<?php $this->load->view ( 'header' ); ?>
<div id="main">
<div id="left">
<div id="class-bar">
<span>Ta的分类 · · · · · ·</span>
<ul class='u-class'>
<li><a href='<?=site_url("/u/".$userId."/pic")?>/'>美图</a></li>
<li><a href='<?=site_url("/u/".$userId."/tag")?>/'>标签</a></li>
<li><a href='<?=site_url("/u/".$userId."/comment")?>/'>留言</a></li>
<li><a href='<?=site_url("/user/i/".$userId)?>/'>个人档</a></li>
<!--<li><a>收录的专辑</a></li>
<li><a>收录的美图</a></li>
  -->
<li><a href='#'>专辑</a></li>
</ul>
 </div>
<h2 class='h2-t'>MESSAGE······</h2>
<?php $this->load->view ( 'showComment' ); ?>
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