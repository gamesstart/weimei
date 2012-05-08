<?php
class like extends CI_Controller{
	function __construct(){
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
	}
	function index(){
		//判断登录
		$this->load->Model('User_m');
		$this->User_m->is_login();
		$userId= $this->session->userdata ( 'userId' );
		$id=$this->input->post('id');
		//action 判断有js实现，判断是否收藏的人中存在该用户
		$this->load->Model('Like_m');
		if($this->Like_m->is_like($id,$userId)){
			$this->Like_m->like($id,$userId);
			echo '1';
		}else{
			$this->Like_m->dislike($id,$userId);
			echo '-1';
		}
	}
}