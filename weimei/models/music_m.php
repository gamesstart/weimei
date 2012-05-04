<?php
class Pic_m extends CI_Model {
	
	function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	function page_list($page, $count) {
		//->limit($count)
		$this->db->select ('music.id,music.src,username,userId,date' );
		$query=$this->db->order_by ( "id", "desc" )->join('user','user.id=music.userId')->get ( 'music', $count, $count * $page );
		$result['imgs']=$query->result ();
		$result['count']=$this->db->count_all_results('pic');
		return $result;
	}
}