<?php
class Like_m extends CI_Model {
	function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	function is_like($id,$userId){
		$result=$this->db->get_where ( 'user', array ('id' => $userId) )->row();
		if(!$result->likeItem||strpos($result->likeItem,"$id,")===false){
			return true;
		}else{
			return false;
		}
	}
	function like($id,$userId){
			if($id[0]=='p'){
				$this->db->query("UPDATE `pic` SET likeCount=likeCount+1 WHERE id =".substr($id,1));
			}elseif($id[0]=='e'){
				$this->db->query("UPDATE `article` SET likeCount=likeCount+1 WHERE id =".substr($id,1));
			}else{
				$this->db->query("UPDATE `avatar_album` SET likeCount=likeCount+1 WHERE id =".substr($id,1));
			}
			$this->db->query("UPDATE `user` SET likeItem = concat(likeItem,'$id,') WHERE id =$userId");
	}
	function dislike($id,$userId){
		if($id[0]=='p'){
			$this->db->query("UPDATE `pic` SET likeCount=likeCount-1 WHERE id =".substr($id,1));
		}else if($id[0]=='e'){
			$this->db->query("UPDATE `article` SET likeCount=likeCount-1 WHERE id =".substr($id,1));
		}else{
			$this->db->query("UPDATE `avatar_album` SET likeCount=likeCount-1 WHERE id =".substr($id,1));
		}
		$this->db->query("UPDATE `user` SET likeItem = replace(likeItem,'$id,','') WHERE id =$userId");
	}
	function like_user($id){
		return $this->db->like ( 'likeItem', "$id," )->select ( 'id,username name,icon' )->get ( 'user' )->result ();
	}
}