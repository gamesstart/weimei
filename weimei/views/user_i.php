<?php
$this->load->view ( 'header' );
?>
<div id="main">

<div id="class-bar">
<span>Ta的分类 · · · · · ·</span>
<ul class='u-class'>
<li><a href='/u/<?=$userId?>/pic/'>美图</a></li>
<li><a href='/u/<?=$userId?>/tag/'>标签</a></li>
<li><a href='/u/<?=$userId?>/comment/'>留言</a></li>
<li><a href='/user/i/<?=$userId?>/'>个人档</a></li>
<!--<li><a>收录的专辑</a></li>
<li><a>收录的美图</a></li>
  -->
<li><a href='#'>专辑</a></li>
</ul>
 </div>
<div id="idcard">
<img src="<?=getMiniPic($icon)?>">
<table>
</td></tr>
	<tr>
		<td>昵称：</td>
		<td><?php echo $username;?></td>
	</tr>
	<tr>
		<td>性别：</td>
		<td><?php echo $sex;?></td>
	</tr>

	<tr>
		<td>电子邮件：</td>
		<td><?=$email?></td>
	</tr>
	<tr>
		<td>QQ：</td>
		<td><?php echo $qq;?></td>
	</tr>
	<tr>
		<td width='65px'>出生年月：</td>
		<td><?php echo $birthday;?></td>
	</tr>
	<tr>
		<td>所在地区：</td>
		<td><?php echo $city;?></td>
	</tr>
	<tr>
		<td>个人说明：</td>
		<td><?php echo $about;?></td>
	</tr>
	<tr>
		<td>注册日期：</td>
		<td><?php echo $regTime;?></td>
	</tr>
	<tr>
		<td>最后登陆：</td>
		<td><?php echo $lastLogin;?></td>
	</tr>
</table>
</div>

</div>
<?php
$this->load->view ( 'footer' );
?>