<?php
$this->load->view('header');
?>
<div id="main">
	<div class="content">
		<form action="login?referer=<?=$referer?>" method="POST" name="loginForm" id="loginForm">
			<h1>用户登陆</h1>
			<div class="error">
					<label>&nbsp;</label>
					<span id="error"><?php echo isset($error)?$error:'';?></span>
			</div>
			<div class="item">
				<label>邮箱：</label>
				<input type="text" maxlength="50" class="input-r" value="" name="email" id="">
				<span id="uname_tip"></span>
			</div>
			<div class="item">
				<label>密码：</label>
				<input type="password" maxlength="20" class="input-r" name="password" id="password">
				<span id="pwd_tip"></span>
			</div>	
			<div class="item">
				<input type="submit" class="red-btn" value="登 录" id="loginBtn">
				<span><a href="/user/lost_pwd">忘记密码？</a></span>
			</div>				
	</form>
	</div>
</div>
<?php
$this->load->view('footer');
?>