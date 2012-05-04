<?php
$this->load->view('header');
?>
<div id="main">
	<div id="inner-main">
	<h1>帐号设置</h1>
	<div class="content">
<ul class="ihome-nav">
		<li><a href="/user/set">个人资料</a></li>
		<li><a href="/user/set_icon">修改头像</a></li>
		<li class="current">修改密码</li>
		</ul>
		<div class="clear1"></div>
		<form action="/user/set_pwd" id="frm_sub" method="post">
			<table border="0" class="frm-tbl">
				<tbody><tr>
					<td>&nbsp;</td>
					<td><span style="color:red" id="error"><?php echo isset($msg)?$msg:''; ?></span></td>
				</tr>
				<tr>
					<td>原密码：</td>
					<td><input type="password" size="25" maxlength="20" id="pwd" name="password" class="input-r" ></td>
				</tr>
				<tr>
					<td>新密码：</td>
					<td><input type="password" size="25" maxlength="20" id="newpwd" name="newpassword" class="input-r" ></td>
				</tr>
				<tr>
					<td>重新输入：</td>
					<td><input type="password" size="25" maxlength="20" id="newpwd2" name="newpassword2" class="input-r" ></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="保存修改" id="btn_sub" class="red-btn"></td>
				</tr>
				
				</tbody></table>
			</form>
</div>
	<div class="sidebar">
		<h2></h2>
	</div>
	</div>
</div>
<?php
$this->load->view('footer');
?>