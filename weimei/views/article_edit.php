<?php $this->load->view('header'); ?>

		<div id="main">
			<div id="inner-main">
				<div id="left">	
				<form action="edit" method="post">
				标题：<input type="text" name="title" value="<?=$e->name?>"/>
				<input type="text" name="id" value="<?=$id?>" style="display:none;"/>
				</br>
				内容：<textarea name="content" id="e-add-content"><?=$e->content?></textarea>
				<input type="submit" value="提交" />
				</form>
				</div>
				<!---left end--->
				<div id="right"></div>
				<!---left end--->
			</div>
		</div>
	
<?php $this->load->view('footer'); ?>