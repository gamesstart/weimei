<?php
class  Comment_m extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function add_comment($data){
		$this->db->insert('comment',$data);
	}
	function get_comment($id){
		$this->db->select('user.id userId,comment.date date,content,username,icon');
		$query=$this->db->from('comment')->where('targetId',$id)->join ( 'user', "user.id=comment.userId" )->order_by('comment.id')->get();
		return $query->result();
	}

}