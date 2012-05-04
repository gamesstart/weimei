<?php $this->load->view ( 'header' ); ?>
<div id="main">
<div id="inner-main">
<div id="left">
<div id="class-bar"><span>分类 · · · · · ·</span> <span id="create"><a href="<?=site_url('pic/upload?isalbum=1')?>">发布照片</a></span></div>
<div id="pic">
<?php foreach ( $imgs as $img) { ?>
<div class="picbox">
<div class="imgInnerBox">
<a href="../detail/<?=$img->id?>"><img src="<?=getMiniPic($img->src)?>"></a>
</div>
<div class="imgDesc">
<a class='album-name' href="../detail/<?=$img->id?>"><?=$img->name?></a></br>
<span><a href="<?=$img->userid?>"><?=$img->userName?></a>于<?=getTime(strtotime($img->date))?></span>
</div>
</div>
<?php } ?>
</div>
<div class="br"></div>
<ul id="pagelist"> <?=$page_list_link?> </ul>
<!---pic end---></div>
<!---left end--->
<div id="right"></div>
<!---left end---></div>
</div>
<?php $this->load->view ( 'footer' ); ?>