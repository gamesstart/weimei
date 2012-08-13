<?php
class Urlfun extends CI_Controller {
	/**
	 * 更新头像，不用缓存图片
	 */
	function nocache(){
		$this->load->library ( 'session' );
		$userId = $this->session->userdata ( 'userId' );
		$folder = $this->config->item ( 'upload_folder' );
		$url='/'.$folder . '/icon/'.$userId.'.jpg.org.jpg';
		header('Location:'.$url);
	}
}