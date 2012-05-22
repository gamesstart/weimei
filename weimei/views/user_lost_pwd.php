<?php
$this->load->view('header');
?><div id="main">
	<div class="content">
		<form method="POST" name="loginForm" id="loginForm">
			<h1>找回密码</h1>
			<div class="item">
					<label>&nbsp;</label>
					<span id="error"></span>
			</div>
			<div class="item">
				<label>邮箱：</label><input type="text" maxlength="50" style="border:1px solid #ccc;" class="input-r" name="email" id="email">
			</div>
			<div class="item">
				<input type="button" class="red-btn" value="找回密码" id="loginBtn">
			</div>				
	</form>
</div>
</div>
<?php
$this->load->view('footer');
?>