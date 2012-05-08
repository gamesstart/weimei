<?php $this->load->view ( 'header' ); ?>
<div id="main">
<?php $this->load->view ( 'sidebar' ); ?>
<div id="inner-main">
<div id="class-bar"><span><?=$title?></span></div>
<div id="tag">
<?php 
if($result->a)
foreach ($result->a as $r){
	echo "<li><a href='/avatar/one/$r->id.url_replace($r->name)' class='e-t'>$r->name</a><a class='date-author' href='/avatar/one/$r->id.url_replace($r->name)'>$r->username|$r->date ◆头</a></li>";
}
if($result->p)
foreach ($result->p as $r){
	echo "<li><a href='/pic/one/$r->id.url_replace($r->name)' class='e-t'>$r->name</a><a class='date-author' href='/avatar/one/$r->id.url_replace($r->name)'>$r->username|$r->date ◆图</a></li>";
}
if($result->e)
foreach ($result->e as $r){
	echo "<li><a href='/article/view/$r->id.url_replace($r->name)' class='e-t'>$r->name</a><a class='date-author' href='/avatar/one/$r->id.url_replace($r->name)'>$r->username|$r->date ◆文</a></li>";
}
?>
</div>
<div class="br"></div>
<ul id="pagelist"> </ul>
<!---left end---></div>
</div>
<?php $this->load->view ( 'footer' ); ?>