<?php
$this->load->view ( 'header' );
?>
<div id="main">
<div id="class-bar"><span>分类 · · · · · ·</span>
<span id="create"><a href="/avatar/upload">发布照片</a></span></div>

<div id="avatar">
<?php foreach ($imgs as $img) { ?>
<div class="avatarBox">
<div class="avatarInnerBox">
<a href="/avatar/<?=$img->albumId?>"><img src="<?=$img->src;?>"></a>
</div>
<div class="avatarDesc">
<a href="/avatar/<?=$img->albumId?>"><?=$img->name;?></a>
<span>作者:<a href="/user/i/<?=$img->userId?>"><?=$img->username?></a></span>
<span><?=$img->date?>创建</span></div>
</div>
<?php } ?>
<div class="fn-clear"></div>
</div>
</div>
<div id="pagelist"><?=$page_list_link?></div>

<?php $this->load->view ( 'footer' );
?>