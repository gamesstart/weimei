<?php $this->load->view ( 'header' ); ?>
<div id="main">
<?php $this->load->view ( 'sidebar' ); ?>
<div id="inner-main">
<div id="class-bar"><span><?=$title?></span></div>
<div id="tag">
<?php 
if($result->a)
foreach ($result->a as $r){
	$url=$r->id.url_replace($r->name);
	echo "<li><a href='/avatar/one/$url' class='e-t'>$r->name</a><a class='date-author' href='/avatar/one/$url'>$r->username|$r->date ◆头</a></li>";
}
if($result->p)
foreach ($result->p as $r){
	$url=$r->id.url_replace($r->name);
	echo "<li><a href='/pic/one/$url' class='e-t'>$r->name</a><a class='date-author' href='/pic/one/$url'>$r->username|$r->date ◆图</a></li>";
}
if($result->e)
foreach ($result->e as $r){
	$url=$r->id.url_replace($r->name);
	echo "<li><a href='/article/view/$url' class='e-t'>$r->name</a><a class='date-author' href='/article/view/$url'>$r->username|$r->date ◆文</a></li>";
}
?>
</div>
<div class="br"></div>
<ul id="pagelist"> </ul>
<!---left end---></div>
</div>
<?php $this->load->view ( 'footer' ); ?>