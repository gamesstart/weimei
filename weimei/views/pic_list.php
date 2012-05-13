<?php $this->load->view ( 'header' ); ?>
		<div id="main">
			<div id="pic">
				
<?php $imgss=array_chunk($imgs,7); foreach ( $imgss as $imgs ) { ?>
				<div class="pic-list">
				<?php foreach($imgs as $img){ ?>
					<div class="pic-item">
						<div class="pic-desc">
							<h2><?=$img->name?></h2>
							<span>加入于<?=getTime(strtotime($img->date))?></span><a href="<?=$img->username?>"><?=$img->username?></a>
						</div>
						<a href="/pic/<?=$img->id?>"><img src="<?=getMiniPic($img->src)?>"></a>
					</div>
				<?php } ?>
				</div>
<?php } ?>
					
				<div class="fn-clear"></div>
			</div>
			<!--pic-->
			<div id="pagelist">
									<?=$page_list_link?>
			</div>
				<div class="fn-clear"></div>
		</div>
		<!--main-->
<?php $this->load->view ( 'footer' ); ?>