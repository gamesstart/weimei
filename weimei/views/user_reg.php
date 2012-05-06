<?php
$this->load->view('header');
?>
<div id="main">
		<div id="inner-main">
	<h1>新用户注册</h1>
	<div class="content">
	<div style="border: 0px solid black;" class="article">
		<form action="reg" method="POST" name="regForm" id="regForm">
			<div class="error">
				<label>	&nbsp;</label>
				<span id="error"></span>
			</div>
			<div class="item">
				<label>	邮　箱：</label>
				<input type="text" value="" maxlength="50" class="input-r" name="email" id="email">
				<span class="error"></span>
			</div>
			<div class="tips"> </div>
	        <div class="item">
				<label>	昵　称：</label>
				<input type="text" value="" maxlength="10" class="input-r" name="username" id="username">
				<span class="error"></span>
			</div>
			<div class="tips">确定后不可修改,最多10个字符</div>
			<div class="item">
				<label>密　码：</label>
				<input type="password" maxlength="20" class="input-r" name="password" id="password">
				<span class="error"></span>
			</div>
			<div class="tips">密码为6-16位英文或数字</div>
			
			<div class="item"></div>
			<div class="item">
				<label>&nbsp;</label>
				&nbsp;<input type="submit" value="注册" class="red-btn" name="regBtn" id="regBtn">
			</div>
		</form>
	</div>
</div>

</div></div>
<?php
$this->load->view('footer');
?>