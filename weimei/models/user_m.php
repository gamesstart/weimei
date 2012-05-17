<?php
class  User_m extends CI_Model{
		function  __construct(){
			parent::__construct();
			$this->load->database ();
		}
		function  reg($data){
			return $this->db->insert('user',$data);
		}
		function check_reg($email){
		   $query = $this->db->get_where('user',array('email'=>$email));
         return $query->row();
		}
		function check_login($email,$password){
		   $query=$this->db->get_where('user',array('email'=>$email,'password'=>md5($password)));
		   return $query->row();
		}
		function update_user_msg($data){
		$this->db->where('id',$data['id']);
      $this->db->update('user', $data); 
		}
		function update_pwd($data){
			$this->db->where('id',$data['id']);
			$this->db->where('password',$data['password']);
      	$this->db->update('user', array('password'=>$data['newpassword']));
      	return $this->db->affected_rows();
		}
		function get_user_msg($id){
		   $query = $this->db->get_where('user',array('id'=>$id));
		   return $query->row();
		}
		function get_user_pic($page,$count,$userId){
			$this->db->select ('name,src,height,id,date' );
			$query=$this->db->order_by ( "id", "desc" )->where('userId',$userId)->get ( 'pic', $count, $count * $page );
			$result['imgs']=$query->result ();
			$result['count']=$this->db->where('userId',$userId)->count_all_results('pic');
			return $result;
		}
		function set_icon($userId,$icon){
			$this->db->where('id',$userId);
			$this->db->update('user', array('icon'=>$icon));
			return $this->db->affected_rows();
		}
		//CI不能在不同的控制器之间调用只能将这种公共函数写到模型中了，－ －
		function is_login($is_redirect=1){
			$this->load->library('session');
			$id=$this->session->userdata('userId');
			$password=$this->session->userdata('password');
			 $query=$this->db->get_where('user',array('id'=>$id,'password'=>$password));
		    if(!count($query->row())){
		    		//redirect('user/login','refresh');
		    	//显示成功信息并跳转
		    	if($is_redirect){
			    	$data=array('msg'=>'请先登录再进行相应的操作！',
			    			'url'=>site_url ( 'user/login' ));
			    	$this->load->view('redirect',$data);
		    	}
		    	return false;
		    }else{
		    	return true;
		    }
		}

}