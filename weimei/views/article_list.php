<?php $this->load->view ( 'header' ); ?>
<div id="main">
<div id="left">
<div id="class-bar"><span>分类 · · · · · ·</span> <span id="create"><a href="<?=site_url('article/add')?>">发布文章</a></span></div>
<div id="article">
<?php foreach ($articles as $a){?>
<li><img src="<?=miniPic($a->nail)?>" style="width: 110px; height: 82px;">
<a class="e-t" href="/article/<?=$a->id?>"><?=$a->name?></a>
<span><?=$a->username?>|<?=$a->date?></span>
<p><?=$a->description?>...</p>
</li>
<?php }?>
<div class="fn-clear"></div>
</div>
<ul id="pagelist"> <?=$page_list_link?> </ul>
<!---pic end--->
</div>
<div id="right"></div>
<div class="fn-clear"></div>
</div>
<?php $this->load->view ( 'footer' ); ?>