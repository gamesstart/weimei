<?php
class Comment extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function add_comment(){
		$this->load->Model('User_m');
		$this->User_m->is_login();
		$this->load->library('session');
		$comment=$this->input->post('comment');
		$pattern = "/@([^@^\\s^:]{1,})([\\s\\:\\,\\;]{0,1})/";
		preg_match_all ( $pattern, $comment, $matches );
		foreach ( $matches [1] as $u ) {
			if ($u) {
				var_dump($u);
				$res =$this->User_m->get_user_msg('',$u) ;
				if ($res['id']) {
					$search [] = '@' . $u;
					$replace [] = '<a target="_blank" href="/user/i/' . $res['id'] . '" >@' . $u . '</a>';
				}
			}
		}
		$comment=str_replace ( $search, $replace, $comment); 
		$data=array(
				'content'=>$comment,
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