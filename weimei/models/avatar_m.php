<?php
class Avatar_m extends CI_Model {
	
	function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	function init() {
		$this->db->insert ( 'avatar_album', array ('name' => '','date'=>date('Y-m-d H:i:s')) );
		$this->db->select ( 'LAST_INSERT_ID() AS id' );
		$query = $this->db->get ();
		return $query->row ()->id;
	}
	function upload($src, $albumId) {
		$this->db->insert ( 'avatar', array ('src' => $src, 'albumId' => $albumId ) );
		$this->db->select ( 'LAST_INSERT_ID() AS id' );
		$query = $this->db->get ();
		return $query->row ()->id;
	
	}
	function page_list($page, $count) {
		$this->db->select ( 'name,albumId,src,username,user.id userId,date' );
		$this->db->order_by ( "albumId",'desc');
		$this->db->limit($count, $count * $page  );
		$this->db->from ( 'avatar_album' );
		$this->db->join ( 'avatar', 'avatar_album.firstId= avatar.id' )->join('user','user.id=avatar_album.userId');
		$query = $this->db->get ();
		$result['imgs']= $query->result();
		$result['count']=$this->db->count_all_results('avatar_album');
		return $result;
	}
	function pic_one($albumId) {
		$this->db->select ( 'name,albumId,src,username,user.id userId,date,icon' );
		$this->db->from ( 'avatar' );
		$this->db->where('albumId',$albumId)->join ( 'avatar_album', "avatar_album.id = avatar.albumId" )->join('user','user.id=avatar_album.userId');
		$query = $this->db->get ();
		return $query->result();
	}
	function upload_submit($data){
		$this->db->where ( 'id', $data['id'])->update ( 'avatar_album',$data);
	}

}