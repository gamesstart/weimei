<?php
$this->load->view('header');
?>
<div id="main">
<div id="class-bar">
<span>帐号设置 · · · · · ·</span>
<ul class='u-class'>
		<li><a href="/user/set">个人资料</a></li>
		<li class="current">修改头像</li>
		<li><a href="/user/set_pwd">修改密码</a></li>
</ul>
 </div>
 <!-- class bar -->
 <div id="left">
<div style="margin-bottom: 5px;">
<h2 class="h2-t">设置新头像</h2>
<strong>上传你的个性头像！</strong>
<span>图像最大500px*500px,JPG格式.</span>
<input type="hidden" id="x" name="x" />
<input type="hidden" id="y" name="y" />
<input type="hidden" id="w" name="w" />
<input type="hidden" id="h" name="h" />
</div>
<input type="button" value="上传" class="red-btn" id="avatar_upload" />
<input type="button" style="float: left; margin-left: 70px; margin-top: -22px;" value="裁剪" class="red-btn" id="crop">
<div style="margin-top: 20px; width: 500px; height: 500px;">
<img src="<?=$icon?>.org.jpg" id="cropbox"/>
</div>
 </div>
 <div id="right">
<h2 class="h2-t">头像预览....</h2>
<!-- - -->
		<div style="height: 200px; overflow: hidden; width: 200px;margin: 15px 0;border: 6px solid #CCCCCC;">
			<img name="" id="user-avatar1" src="<?=$icon?>.org.jpg" alt="" />
		</div>
		<h2 class="h2-t">(200px*200px 预览)</h2>
		<div style="height: 100px; overflow: hidden; width: 100px;margin: 15px 0;border: 6px solid #CCCCCC;">
			<img name="" id="user-avatar2" src="<?=$icon?>.org.jpg" alt="" />
		</div>
		<h2 class="h2-t">(100px*100px 预览)</h2>
		<div style="height: 48px; overflow: hidden; width: 48px;margin: 15px 0;border: 6px solid #CCCCCC;">
			<img name="" id="user-avatar3" src="<?=$icon?>.org.jpg" alt="" />
		</div>	
		<h2 class="h2-t">(48px*48px 预览)</h2>
<!-- - -->
 </div>
				

</div>
<?php
$this->load->view('footer');
?>