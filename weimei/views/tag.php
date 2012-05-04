<?php $this->load->view ( 'header' ); ?>
<div id="main">
<div id="inner-main">
<div id="left">
<div id="class-bar"><span><?=$title?></span></div>
<div id="article">
<?php 
if($result->a)
foreach ($result->a as $r){
	echo "<li><a href='/avatar/one/$r->id' class='e-t'>$r->name</a><span>$r->username|$r->date◆头</span></li>";
}
if($result->p)
foreach ($result->p as $r){
	echo "<li><a href='/pic/one/$r->id' class='e-t'>$r->name</a><span>$r->username|$r->date◆图</span></li>";
}
if($result->e)
foreach ($result->e as $r){
	echo "<li><a href='/article/view/$r->id' class='e-t'>$r->name</a><span>$r->username|$r->date◆文</span></li>";
}
?>
</div>
<div class="br"></div>
<ul id="pagelist"> </ul>
<!---pic end---></div>
<!---left end--->
<div id="right"></div>
<!---left end---></div>
</div>
<?php $this->load->view ( 'footer' ); ?>