<?php $this->load->view('header'); ?>
		<div id="main">
				<div id="left">	
				<form action="add" method="post">
				<label>标题：</label><input type="text" name="title" class="input-r" id="add-essay-title"/>
				</br>
				<textarea name="content" id="add-essay"></textarea>
				<input type="submit" value="提交" class="red-btn" id="add-essay-btn"/>
				</form>
				</div>
				<!---left end--->
				<div id="right"></div>
				<!---right end--->
				<div class='fn-clear'></div>
		</div>
<?php $this->load->view('footer'); ?>