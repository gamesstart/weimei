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
         	return $query->row_array();
		}
		function check_login($email,$password){
		   $query=$this->db->get_where('user',array('email'=>$email,'password'=>md5($password)));
		   $result=$query->row_array();
		   if($result['id']){
      			$this->db->where('id',$result['id'])->update('user',array('lastLogin'=>date("Y-m-d H:i:s"))); 
		   }
		   return $result;
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
		   return $query->row_array();
		}
		function get_user_pic($page,$count,$userId){
			$this->db->select ('name,src,height,id,date' );
			$query=$this->db->order_by ( "id", "desc" )->where('userId',$userId)->get ( 'pic', $count, $count * $page );
			$like=$this->db->query("select likeItem from user where id=$userId")->row()->likeItem;
			$likePic=array();
			//有like
			if($like){
				/*处理去掉aid，eid,以及最后的，等*/
				$patterns = array ('/p(\d+?),/','/([e|a]\d+?,)/','/,$/');
				$replace = array ('${1},','','');
				$likePicId=preg_replace($patterns, $replace,$like);
				//有like且有picId
				if($likePicId)
					$likePic=$this->db->query("select name,src,height,id,date from pic where id in ($likePicId) and userId<>$userId")->result_array();
			}
			$result['imgs']=array_merge($query->result_array(),$likePic);
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
		//喜欢用户
		function like($likeUserId,$uid){
			$like=$this->db->query("select likeUser from `user` WHERE id =$uid")->row();
			preg_match("/$likeUserId,/",$like->likeUser,$is_like);
			if($is_like){
				$likeUserId=preg_replace("/$likeUserId,/",'', $like->likeUser);
				$this->db->query("UPDATE `user` SET likeUser='$likeUserId' WHERE id =$uid");
			}else{
				$this->db->query("UPDATE `user` SET likeUser= concat(likeUser,'$likeUserId,') WHERE id =$uid");
			}
		}
		//获取喜欢用户$is_liked获取被喜欢用户
		function list_like_user($uid,$is_liked=0){
			//喜欢
			if(!$is_liked){
				$like=$this->db->query("select likeUser from `user` WHERE id =$uid")->row_array();
				if($like->likeUser){
				$like->likeUser=preg_replace('/,$/','',$like->likeUser);
				return $this->db->query("select username,id userId,icon from `user` where id in ($like->likeUser)")->result_array();
				}
			}else{
				//被喜欢
				return $this->db->query("select username,id userId,icon from `user` where likeUser like '%$uid,%'")->result_array();
			}
		}
		

}