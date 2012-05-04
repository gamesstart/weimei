<?php
$this->load->view('header');
?>

		<div id="main">
			<div id="upload-main">
				<div id="left">	
					<div id="upload">
						<h2>发布图片</h2>
				
				<div class="item">
					<label>&nbsp;</label>
					<span style="color:red" id="error">&nbsp;
					
					</span>
				</div>
				<div class="item">
				<form action="upload_submit" method="post">
					<label>图片组标题：</label>
					<span>
					<input type="text" value="" maxlength="20" size="21" name="album_name" id="title">&nbsp;<input type="submit" class="red-btn" value="保存上传图片">
					<input type="hidden" name="allPicId">
					<?php 
					if($is_album)
						echo "<input type='hidden' name='firstId' >";
					?>
						<div class="clear:right;"></div>
					<input id="file_upload" type="file" name="userfile" />
					</span>
				</form>
				</div>
				<div class="item">
				
						<div id="showUploadPic"></div>
	</div>			</div>
				</div>
				<!---left end--->
				<div id="right">
				<p class="upload-notice">
				请勿上传违规图片，参见<a href="http://www.cnnic.net.cn/html/Dir/2000/09/25/0652.htm" target="_blank">相关法规</a>。<br><br>上传图片必须宽度小于960px,高度大于50px。一次上传可选择不超过100个文件，上传完成后可选择文件继续上传。未出现“选择文件”按钮？请安装 <a target="_blank" href="http://get.adobe.com/cn/flashplayer/">Flash Player</a><br><br><br>您所上传的图片将位于公共领域且用户不能彻底删除图片，如不确定，请勿上传私人照片。
				</p>
				</div>
			</div>
				<!---right end--->
			</div>
		</div>
	
<?php
$this->load->view('footer');
?>