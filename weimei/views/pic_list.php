<?php $this->load->view ( 'header' ); ?>
<div id="main" data-count='<?=$imgs['count']?>'>
			<div id="pic">
<?php if(count($imgs)<4){?>
				<?php foreach($imgs as $img){ ?>
					<div class="pic-list" >
					<div class="pic-item">
						<div class="pic-desc">
							<h2><?=$img['name']?></h2>
							<span>加入于<?=getTime(strtotime($img['date']))?></span><a href="/user/i/<?=$img['userId']?>"><?=$img['username']?></a>
						</div>
						<a href="/album/detail/<?=$img['id']?>"><img src="<?=getMiniPic($img['src'])?>"></a>
					</div>
				</div>
				<?php } ?>
<?php }else{ $imgss=sort3Array($imgs); foreach ( $imgss[0] as $key=>$imgs ) { ?>
				<div class="pic-list" data-h='<?php echo $imgss[0][$key][0]['height']-$imgss[1][$key][0]; ?>' >
				<?php foreach($imgs as $img){ ?>
					<div class="pic-item">
						<div class="pic-desc">
							<h2><?=$img['name']?></h2>
							<span>加入于<?=getTime(strtotime($img['date']))?></span><a href="/user/i/<?=$img['userId']?>"><?=$img['username']?></a>
						</div>
						<a href="/pic/<?=$img['id']?>"><img src="<?=getMiniPic($img['src'])?>"></a>
					</div>
				<?php } ?>
				</div>
<?php }} ?>
					
				<div class="fn-clear"></div>
			</div>
			<!--pic-->
		</div>
		<!--main-->
			<div id="pagelist"><?=$page_list_link?></div>
<?php $this->load->view ( 'footer' ); ?>