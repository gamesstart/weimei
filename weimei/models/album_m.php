<?php
class Album_m extends CI_Model {
	function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	//list是关键字so album_list
	function album_list($page, $count) {
		//->limit($count)
		$this->db->select ( 'pic_album.name,pic_album.id,pic.src,user.username userName,pic_album.date' );
		$this->db->from ( 'pic_album' );
		$this->db->order_by ( "pic_album.id", "desc" )->limit ( $count, $count * $page );
		$this->db->join ( 'user', 'user.id=pic_album.userId' )->join ( 'pic', 'pic_album.firstId=pic.id' );
		$query = $this->db->get ();
		$result['imgs']=$query->result ();
		$result['count']=count($this->db->from('pic_album')->join('pic','pic_album.firstId=pic.id')->get()->result());
		return  $result;
	}
	function detail($albumId, $page, $count) {
		//->limit($count)
		//$query = $this->db->order_by( "id", "desc" )->where('albumId',$albumId)->get ( 'pic', $count, $count * $page );
		$album=$this->db->get('pic_album')->result();
		$picId=explode(',',$album['0']->picId);
		$pic=$this->db->select('user.id userId,user.username userName,pic.id,pic.name,pic.date,pic.src')->where_in('pic.id',$picId)->from('pic')->join('user','user.id=pic.userId')->get()->result();
		$pic->name=$album['0']->name;
		return $pic;
		//$this->db->select ( 'pic_album.name,pic.id,pic.src src,user.username userName,pic_album.date date' );
		//$query = $this->db->from ( 'pic_album' )->join ( 'pic', 'pic_album.id=pic.albumId' )->join ( 'user', 'pic_album.userId=user.id' )->where ( 'pic_album.id', $albumId )->get ();
		//return $query->result ();
	}

}