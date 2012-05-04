<?php
$this->load->view('header');
?><div id="main">
	<div id="inner-main">
	<h1>找回密码</h1>
	<div class="content">
	<div style="border: 0px solid black;" class="article">
		<form method="POST" name="loginForm" id="loginForm">
			<div class="item">
					<label>&nbsp;</label>
					<span id="error"></span>
			</div>
			<div class="item">
				<label>邮　箱：</label><input type="text" maxlength="50" style="border:1px solid #ccc;" class="input-r" name="email" id="email">
			</div>
			<div class="item">
				<label></label>
				<input type="button" class="red-btn" value="找回密码" id="loginBtn">
			</div>				
	</form>
	</div>
</div>
	</div>
</div>
<?php
$this->load->view('footer');
?>