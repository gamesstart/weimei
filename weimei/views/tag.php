<?php $this->load->view ( 'header' ); ?>
<div id="main">
<div id="left">
<div id="class-bar"><span><?=$title?></span></div>
<div id="tag">
<?php 
if($result->a)
foreach ($result->a as $r){
	echo "<div class='tag-item'><a href='/avatar/one/$r->id' class='e-t'>$r->name</a>$r->username|$r->date ◆头</div>";
}
if($result->p)
foreach ($result->p as $r){
	echo "<div class='tag-item'><a href='/pic/one/$r->id' class='e-t'>$r->name</a>$r->username|$r->date ◆图</div>";
}
if($result->e)
foreach ($result->e as $r){
	echo "<div class='tag-item'><a href='/article/view/$r->id' class='e-t'>$r->name</a>$r->username|$r->date ◆文</div>";
}
?>
</div>
<div class="fn-clear"></div>
<ul id="pagelist"> </ul>
</div>
<div id="right"></div>
</div>
<?php $this->load->view ( 'footer' ); ?>