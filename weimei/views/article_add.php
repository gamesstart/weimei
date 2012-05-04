<?php $this->load->view('header'); ?>

		<div id="main">
			<div id="inner-main">
				<div id="left">	
				<form action="add" method="post">
				标题：<input type="text" name="title" />
				</br>
				内容：
				<textarea name="content" id="e-add-content"></textarea>
				<input type="submit" value="提交" />
				</form>
				</div>
				<!---left end--->
				<div id="right"></div>
				<!---left end--->
			</div>
		</div>
	
<?php $this->load->view('footer'); ?>