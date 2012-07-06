<?php
class U extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper ( 'url' );
		$this->load->model ( 'User_m' );
		$this->load->library ( 'session' );
		$this->load->helper ( 'html' );
		//$this->output->enable_profiler(TRUE);
 		
	}
	function _remap($method)
	{
		$userId=$this->uri->segment(2,1);
		$class=$this->uri->segment(3,'pic');
		$page=$this->uri->segment(4,0);
		//echo $userId.'.'.$class.'.'.$page;
		switch ($class){
		   case 'pic':$this->pic($userId,$page);break;
		   case 'tag':$this->tag($userId);break;
		   case 'article':$this->article($userId,$page,$class);break;
		   case 'comment':$this->comment($userId,$page);break;
		}
	}
	function tag($userId){
		$this->load->Model('Tag_m');
		$data->tag=$this->Tag_m->get_tag('','',$userId);
		//用户基本信息
		$d=$this->User_m->get_user_msg($userId);
		$data->userId=$d->id;
		$data->username=$d->username;
		$data->icon=$d->icon;
		$data->about=$d->about;
		//获取喜欢用户
		$this->load->helper('self_define_helper');
		$data->like=$this->User_m->list_like_user($userId);
		$data->liked=$this->User_m->list_like_user($userId,1);
		$this->load->view('user_tag',$data);
	}
	function pic($userId,$page){
		//$this->output->cache(60);

		//图片，专辑，文字，留言
			$this->load->helper('self_define_helper');
			//每页10张图片
			$count = 14;
			$d=$this->User_m->get_user_pic($page,$count,$userId);
			$data ['imgs']=$d['imgs'];
			//$this->load->Model('Pic_m');
			//$pics=$this->Pic_m->page_list($page,$count);
			//分页
			$this->load->library ( 'pagination' );
			$config ['base_url'] ='./';
			$config ['total_rows'] = $d['count']/$count;
			$config ['per_page'] = '1';
			$config ['num_links'] = 5;
			$config ['cur_tag_open'] = '<span class=current>';
			$config ['cur_tag_close'] = '</span>';
			//初始化分页
			$this->pagination->initialize ( $config );
			$data ['page_list_link'] = $this->pagination->create_links ();
			$data['title']='美图'.$page.'页';
			//用户基本信息
			$u=$this->User_m->get_user_msg($userId);
			$data['userId']=$u->id;
			$data['username']=$u->username;
			$data['icon']=$u->icon;
			$data['about']=$u->about;
			$data['title']=$u->username.'发布的'.$data[title];
			//获取喜欢用户
			$data['like']=$this->User_m->list_like_user($userId);
			$data['liked']=$this->User_m->list_like_user($userId,1);
			$data['imgs']['count']=$d['count'].'-'.$count;
			$this->load->view('user_view_pic',$data);
		}
		function comment($userId){
			$this->load->helper('self_define_helper');
			$this->load->Model ( 'Comment_m' );
			$data->comment = $this->Comment_m->get_comment ( 'u' . $userId);
			$data->title='h2ero';
			$data->userId=$userId;
			//用户基本信息
			$d=$this->User_m->get_user_msg($userId);
			$data->userId=$d->id;
			$data->username=$d->username;
			$data->icon=$d->icon;
			$data->about=$d->about;
			//获取喜欢用户
			$data->like=$this->User_m->list_like_user($userId);
			$data->liked=$this->User_m->list_like_user($userId,1);
			$this->load->view('user_comment',$data);
		}
}