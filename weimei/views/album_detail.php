<?php $this->load->view ( 'header' ); ?>
<div id="main">
<div id="inner-main">
<div id="left">
<div id="class-bar"><span>专辑：</span><a href="<?$imgs[0]->id?>"><?=$imgs[0]->name?></a></div>
<div id="pic">
<?php foreach ( $imgs as $img ) { ?>
<div class="picbox">
<div class="imgInnerBox">
<div class="img"><a href="/pic/one/<?=$img->id?>"><img src="<?=getMiniPic($img->src)?>"></a></div>

<div class="imgDesc">
<a class='album-name' href="../detail/<?=$img->id?>"><?=$img->name?></a></br>
<span><a href="<?=$img->userId?>"><?=$img->userName?></a>于<?=$img->date?></span>
</div>
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
<div id="right"></div>
</div>
</div>
<?php $this->load->view ( 'footer' ); ?>