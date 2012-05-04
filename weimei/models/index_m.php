<?php
class Index_m extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function get_latest_user(){
		$query = $this->db->order_by('id','desc')->get('user',10);
		return $query->result();
	}
	function get_latest_comment(){
		$this->db->select('icon,user.id userId,comment.date date,content,username');
		$query=$this->db->from('comment')->order_by('comment.id','desc')->join ( 'user', "user.id=comment.userId" )->limit(5,0)->get();
		return $query->result();
	}
	function avatar() {
		$this->db->select ( 'albumId,src');
		$this->db->order_by ( "albumId",'desc');
		$this->db->from ( 'avatar_album' );
		$this->db->join ( 'avatar', 'avatar_album.firstId= avatar.id' );
		$query = $this->db->get ();
		return $query->result();
	}
	function article() {
		$query = $this->db->order_by('id','desc')->get('article',10);
		return $query->result();
	}
	function tag(){
		$query=$this->db->limit('30')->get('tag');
		return $query->result();
	}
}