<?php $this->load->view ( 'header' ); ?>
<div id="main">
<div id="left">
<div id="class-bar"><span>分类 · · · · · ·</span> <span id="create"><a href="<?=site_url('article/add')?>">发布文章</a></span></div>
<div id="article">
<?php for($i=0;$i<10;$i++){?>

<li><embed src="http://www.xiami.com/widget/0_1963661/singlePlayer.swf" type="application/x-shockwave-flash" width="257" height="33" wmode="transparent"></embed><br /><a target=_blank rel="external nofollow" href="http://www.xiami.com/song/1963661">[link]</a><!-- <span><?=$a->username?>|<?=$a->date?></span>- --></li>
<?php }?>
</div>
<div class="br"></div>
<ul id="pagelist"> <?=$page_list_link?> </ul>
</div>
<!---left end--->
<div id="right"></div>
<!---left end--->
</div>
<?php $this->load->view ( 'footer' ); ?>