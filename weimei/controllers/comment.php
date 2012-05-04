<?php
class Comment extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function add_comment(){
		$this->load->Model('User_m');
		$this->User_m->is_login();
		$this->load->library('session');
		$data=array(
				'content'=>$this->input->post('comment'),
				'targetId'=>$this->input->post('id'),
				'userId'=>$this->session->userdata('userId'),
				'id'=>'',
				'date'=>date('Y-m-d H:i:s')
				);
		$this->load->helper('self_define_helper');
		$this->load->Model('Comment_m');
		$this->Comment_m->add_comment($data);
	}











}