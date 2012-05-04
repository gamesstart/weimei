<?php $this->load->view ( 'header' ); ?>
<div id="main">
<div id="class-bar">分类 · · · · · ·</span> <span id="create"><a href="<?=site_url ( 'pic/upload' )?>">发布照片</a></span></div>
<div id="pic">
<?php foreach ( $imgs as $img ) { ?>
<div class="picbox">
<div class="imgInnerBox">
<div class="img"><a href="/pic/<?=$img->id.'-'.url_replace($img->name)?>"><img src="<?=getMiniPic($img->src)?>"></a></div>
<div class="imgDesc"><a  class='album-name' href="/pic/one/<?=$img->id?>"><?=$img->name?></a></br>
<span><a href="<?=$img->username?>"><?=$img->username?></a>于<?=getTime(strtotime($img->date))?></span></div>
</div>
</div>
<?php } ?>
</div>
<div class="br"></div>
<ul id="pagelist">
					<?=$page_list_link?>
						</ul>
<!---pic end--->
</div>
<?php $this->load->view ( 'footer' ); ?>