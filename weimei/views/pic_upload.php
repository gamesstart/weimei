<?php
$this->load->view('header');
?>

		<div id="main">
			<div id="inner-main">
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
				<div id="right"></div>
				<!---left end--->
			</div>
		</div>
	
<?php
$this->load->view('footer');
?>