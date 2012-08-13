<?php
class Index_m extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function get_latest_user($count=12){
		$query = $this->db->order_by('id','desc')->get('user',$count);
		return $query->result_array();
	}
	function get_latest_comment($count){
		$this->db->select('icon,user.id userId,comment.date date,content,username');
		$query=$this->db->from('comment')->order_by('comment.id','desc')->join ( 'user', "user.id=comment.userId" )->limit($count,0)->get();
		return $query->result_array();
	}
	function avatar() {
		$this->db->select ( 'albumId,src');
		$this->db->order_by ( "albumId",'desc');
		$this->db->from ( 'avatar_album' );
		$this->db->join ( 'avatar', 'avatar_album.firstId= avatar.id' );
		$query = $this->db->get ();
		return $query->result_array();
	}
	function article() {
		$query = $this->db->order_by('id','desc')->get('article',10);
		return $query->result_array();
	}
	function tag(){
		$query=$this->db->limit('30')->get('tag');
		return $query->result_array();
	}
}