<?php
$this->load->view('header');
?>
<div id="main">
	<div id="inner-main">
	<h1>帐号设置</h1>
	<div class="content">
		<ul class="ihome-nav">
		<li><a href="/user/set">个人资料</a></li>
		<li class="current">修改头像</a></li>
		<li><a href="/user/set_pwd">修改密码</a></li>
		</ul>
		<table>
			<tbody>
			<tr><span id="error" style="color:red"><?php echo isset($error)?$error:'';?></span></tr>
			<tr>
			<td width="50%"><div class="line">预览</div></td>
			<td><div class="line">设置新头像</div></td>
			</tr>
			<tr>
			<td width="50%" valign="top" rowspan="3">
			<div style="border:0px solid #D6D7D6;width:260px;height:310px;text-align:center;display: table-cell; vertical-align:middle;overflow:hidden;">
							<?php echo img($icon);?>
			</div>
			</td>
			<td>
			<form action="/user/set_icon" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				你可以上传JPG文件
			<input type="file" name="userfile" size="20" />
<br /><br />
<input type="submit" class="red-btn" value="上传">
				</form>
			</td>
			</tr>
			<tr>
			<td>
				<table width="100%">
					<tbody><tr>
					<td width="50%">
						<div class="fl"> <br>
						<div id="preimg" class="ihome-head">
						</div>
						</div>
					</td>
					<td>
						<div class="fl"> 当前小头像<br>
						<div id="preimg1" class="ihome-head">
							<?php echo img(getMiniPic($icon));?>
						</div>
						</div>
					</td>
					</tr>
				</tbody></table>
				
			</td>
			</tr>
				<tr>
				<td style="line-height:30px;"> 
			</td>
			</tr>
			</tbody></table>
</div>
</div>
</div>
<?php
$this->load->view('footer');
?>