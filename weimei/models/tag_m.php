<?php
class Tag_m extends CI_Model {
	function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	function add_tag($id, $tag,$userId) {
		$count = count ( $tag );
		//纠结了下最后没有写到Controller里面
		for($i = 0; $i < $count; $i ++) {
			//先行判断tag存在不，取id，并将sum加一
			$query = $this->db->get_where ( 'tag', array ('name' => $tag [$i] ) );
			if ($result = $query->row ()) {
				if(!in_array($id,explode(',',$result->targetId))){
				$targetId = $result->targetId . $id;
				$tagId=$result->id;
				$this->db->where ( 'id',$tagId)->update ( 'tag', array ('targetId' => $targetId . ',', 'sum' => $result->sum + 1 ) );
				$this->db->query("UPDATE `user` SET tagId = concat( tagId,'$tagId,') WHERE id =$userId");
				}
			} else {
				$this->db->insert ( 'tag', array ('name' => $tag [$i], 'targetId' => $id . ',' ) );
				$this->db->select ( 'LAST_INSERT_ID() AS id' );
				$query = $this->db->get ();
				$tagId=$query->row ()->id;
				$this->db->query('UPDATE `user` SET tagId = concat( tagId, "'.$tagId.',") WHERE id ='.$userId);
			}
		}
	}
	//获取id或者tag的相关文档
 	function get_tag($id, $tag,$userId) {
		if ($tag) {
			$targetId=$this->db->where ( 'name', $tag )->select ( 'targetId' )->get ( 'tag' )->result ();
			$targetId=explode(',',$targetId[0]->targetId);
			//pop ‘’
			array_pop($targetId);
			//a1,e2,p3 
			$aId=$eId=$pId=array();
			foreach ($targetId as $t){
				switch ($t[0]){
					case 'a':
						$t=explode('a', $t);
						array_push($aId, $t[1]);
						break;
					case 'e':
						$t=explode('e', $t);
						array_push($eId, $t[1]);
						break;
					case 'p':
						$t=explode('p', $t);
						array_push($pId, $t[1]);
						break;
				}
			}
			$tags=new stdClass();
			$tags->a=$tags->p=$tags->e='';
			if ($aId){
				$query = $this->db->where_in('avatar_album.id',$aId)->select('avatar_album.id,name,date,username')->join('user','avatar_album.userId=user.id')->get ('avatar_album');
				$result=$query->result();
				$tags->a=$result;
				//$tags->
			}
			if ($pId){
				$query = $this->db->where_in('pic.id',$pId)->select('pic.id,name,pic.date,username')->join('user','pic.userId=user.id')->get ('pic');
				$result=$query->result();
				$tags->p=$result;
				//$tags->
			}
			if ($eId){
				$query = $this->db->where_in('article.id',$eId)->select('article.id,name,username,date')->join('user','article.userId=user.id')->get ('article');
				$result=$query->result();
				$tags->e=$result;
				//$tags->
			}
			return $tags;
			//$aId=
		} else if($id){
			return $this->db->like ( 'targetId', $id . ',' )->select ( 'id,name' )->get ( 'tag' )->result ();
		}else{
			$res=$this->db->select('tagId')->where('id',$userId)->get('user')->row();
			$tagId=split(',', $res->tagId);
			$tags=$this->db->where_in('id',$tagId)->get('tag');
			return  $tags->result();
		}
	
	}
	

}