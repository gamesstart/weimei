<?php
class Article_m extends CI_Model {
	function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	function add($data) {
		return $this->db->insert ( 'article', $data );
	}
	//编辑load文章
	function edit($id) {
		$query=$this->db->where('id',$id)->get('article');
		return $query->row();
	}
	//编辑完成
	function edit_done($data){
		$this->db->where ( 'id', $data['id'])->update ( 'article',$data);
	}
	function article_list($page, $count) {
		$this->db->select ( 'name,article.id id,article.content,description,nail,user.id userId,user.username,date' );
		$this->db->from ( 'article' );
		$this->db->order_by ( "article.id", "desc" )->limit ( $count, $count * $page );
		$this->db->join ( 'user', 'user.id=article.userId' );
		$query = $this->db->get ();
		$result['articles']=$query->result ();
		$result['count']=$this->db->count_all_results('article');
		return $result;
	}
	function view($id){
		$this->db->select ( 'name title,article.id,content,user.id userId,icon,user.username,date,likeCount' );
		$this->db->from ( 'article' )->where('article.id',$id);
		$this->db->join ( 'user', 'user.id=article.userId' );
		$query = $this->db->get ();
		return $query->row();
	}
	function get_pic($id) {
		$this->db->select ( 'pic.name picname,src,pic.id picid' );
		$this->db->from ( 'pic' );
		$this->db->where('pic.id',$id);
		$query = $this->db->get ();
		return $query->row ();
	}
}