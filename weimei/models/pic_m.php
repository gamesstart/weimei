<?php
class Pic_m extends CI_Model {
	
	function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	function init() {
		$this->db->insert ( 'pic_album', array ('name' => '','date'=>date('Y-m-d H:i:s')));
		$this->db->select ( 'LAST_INSERT_ID() AS id' );
		$query = $this->db->get ();
		return $query->row ()->id;
	}
	function upload($src,$albumId,$userId,$height) {
		$this->db->insert ( 'pic', array ('src' => $src,'userId'=>$userId,'height'=>$height,'date'=>date('Y-m-d H:i:s')));
		 $this->db->select ( 'LAST_INSERT_ID() AS id' );
		$query = $this->db->get ();
		$picId=$query->row ()->id;
		/* if($albumId){
			$this->db->query('UPDATE `pic_album` SET picId= concat(picId,'."$picId,".') WHERE id ='.$albumId);
			//$this->db->query('UPDATE `pic_album` SET picId= concat(picId,'."$picId,".') WHERE id ='.$albumId);
		} */
		return $picId; 
	}
	function collect($src,$name,$userId,$height){
		$this->db->insert ( 'pic', array ('src' => $src,'name'=>$name,'userId'=>$userId,'height'=>$height,'date'=>date('Y-m-d H:i:s')));
	}
	function page_list($page, $count,$order){
		//->limit($count)
		$this->db->select ('pic.name,src,height,pic.id id,username,userId,date' );
		if(!$order){
		$query=$this->db->order_by ( "id", "desc" )->join('user','user.id=pic.userId')->get ( 'pic', $count, $count * $page );
		$result['count']=$this->db->count_all_results('pic');
		$result['imgs']=$query->result ();
		}elseif($order=='all'){
			$query=$this->db->order_by ( "likeCount", "desc" )->join('user','user.id=pic.userId')->get ( 'pic', $count, $count * $page );
			$result['imgs']=$query->result ();
			$result['count']=$this->db->count_all_results('pic');
		}else{
			$orderDay=array('today'=>1,'weekend'=>7,'month'=>30,'year'=>356);
			$query=$this->db->order_by ( "likeCount", "desc" )->where('pic.date>curdate( )-'.$orderDay["$order"])->join('user','user.id=pic.userId')->get ( 'pic', $count, $count * $page );
			$result['imgs']=$query->result ();
			$result['count']=$this->db->query('SELECT COUNT(*) AS `count`  FROM `pic` WHERE pic.date>curdate( )-'.$orderDay["$order"])->row()->count;
		}
		return $result;
	}
	function pic_one($id) {
		$this->db->select ( 'pic.name title,src,pic.id id,likeCount,username,user.id userId,date,icon' );
		$this->db->from ( 'pic' );
		$this->db->where('pic.id',$id)->join('user','user.id=userId');
		$query = $this->db->get ();
		return $query->row ();
	}
	function user_pic($userId){
		$this->db->select ( 'src,pic.id id,pic.name name' );
		$this->db->from ( 'pic' );
		$query=$this->db->where('pic.userId',$userId)->limit(6,0)->order_by('RAND()')->get();
		return $query->result(); 
	}
	function upload_submit($data){
		if($data['firstId']){
			$this->db->where ( 'id', $data['id'])->update ( 'pic_album',$data);
		}
			$picId=explode(',', $data['picId']);
			$this->db->where_in( 'id', $picId)->update ( 'pic',array(name=>$data['name']));
	}
	function rename($pid,$name){
		//检验该文档是否属于该用户
		$this->db->where ( 'id', $pid)->update ( 'pic',array('name'=>$name));
	}
	function get_pic_src($start,$end){
		return $this->db->query("select src,id from pic where $start<=id and id<=$end")->result();
	}
	function update_height($id,$height){
		$this->db->query("update pic set height=$height where id=$id");
	}
}