<?php
class Avatar extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->library ( 'session' );
		//$this->output->enable_profiler ( TRUE ); //调试信息
	}
	function index() {
		$this->page(0);
	}
	function page($page) {
		$this->load->helper('self_define_helper');
		$this->output->cache(3);
		//page为页，class为分类
		//$page = $this->uri->segment( 4, 0 );
		//$class = $this->uri->segment( 3, 0 );
		//每页10张图片
		$count = 10;
		$this->load->Model ( 'Avatar_m' );
		$d=$this->Avatar_m->page_list ( $page, $count );
		$data ['imgs']=$d['imgs'];
		//$this->load->Model('Pic_m');
		//$pics=$this->Pic_m->page_list($page,$count);
		//分页
		$this->load->library ( 'pagination' );
		$config ['base_url'] ='/avatar/page/'. $class;
		$config['cur_page']=$page;
		$config ['uri_segment'] = 4;
		$config ['total_rows'] = $d['count']/10;
		$config ['per_page'] = 1;
		$config ['num_links'] = 5;
		$config ['cur_tag_open'] = '<span class=current>';
		$config ['cur_tag_close'] = '</span>';
		$this->pagination->initialize ( $config );
		$data['page_list_link']=str_replace('page/', 'page-',$this->pagination->create_links ());
		$data['title']='头像'.$page.'页';
		$this->load->view ( 'avatar_list', $data );
	}
	function one($id) {
		$this->load->helper('self_define_helper');
		//$data ['id'] = $this->uri->segment ( 3, 0 );
		$data ['id'] =$id;// $this->uri->segment ( 3, 0 );
		$this->load->Model ( 'Avatar_m' );
		$data ['imgs'] = $this->Avatar_m->pic_one ( $data ['id'] );
		$this->load->Model ( 'Tag_m' );
		$data['tag'] = $this->Tag_m->get_tag ( 'a' . $data ['id'], '' );
		$this->load->Model ( 'Comment_m' );
		$data['comment']= $this->Comment_m->get_comment ( 'a' .$data ['id']);
		$data ['title'] = $data ['imgs'] [0]->name.'头像';
		$data['keywords']=$data['title'];
		//获取喜欢用户
		$this->load->Model ( 'Like_m' );
		$data['likeUser']=$this->Like_m->like_user("a$id");
		foreach ($data['tag'] as $tag){
			$data['keywords'].=','.$tag->name;
		}
		$this->load->view ( 'avatar_one', $data );
	}
	function upload() {
		$this->load->helper('cookie');
		$this->load->Model ( 'User_m' );
		if($this->User_m->is_login ()){
		$this->load->helper ( 'self_define_helper' );
		//load js
		$data ['js'] = js ( array ('upload', 'swfobject', 'jquery.uploadify.min' ) );
		$data ['css'] = css ( array ('uploadify' ) );
		$data['title']='上传头像';
		$data ['target'] = 'avatar';
		//插入一个album，提交的时候直接更新
		$data ['albumId'] =get_cookie( 'avatarAlbumId' );
		if ($data['albumId'] == NULL) {
			$this->load->Model ( 'Avatar_m' );
			$data ['albumId'] = $this->Avatar_m->init ();
				$cookie = array(
					'name'   => 'avatarAlbumId',
					'value'  => $data ['albumId'],
					'expire' => '122286400',
					'domain' => getDomain(),
					'path'   => '/'
			);
			set_cookie($cookie);
		} 
		$this->load->view ( 'avatar_upload', $data );
		}
	}
	function upload_submit() {
		$this->load->helper('cookie');
		$data ['name'] = $this->input->post ( 'album_name' );
		$data ['firstId'] = $this->input->post ( 'firstId' );
		$data ['userId'] = $this->session->userdata ( 'userId' );
		$data ['id'] =get_cookie ( 'avatarAlbumId' );
		$this->load->Model('Tag_m');
		$this->Tag_m->add_tag('a'.$data['id'],array($this->input->post ( 'class' )),$data['userId']);
		$this->load->Model ( 'Avatar_m' );
		$this->Avatar_m->upload_submit ( $data );
		$data ['albumId'] = $this->Avatar_m->init ();
		delete_cookie('avatarAlbumId',getDomain(),'/');
		//显示成功信息并跳转
		$data=array('msg'=>'提交成功',
				 		'url'=>site_url('avatar/page'));
		$this->load->view('redirect',$data);
	}
	function do_upload() {
		$folder = $this->config->item ( 'upload_folder' );
		$foldername = $this->config->item ( 'upload_folder_name' );
		$uploadpath = $folder . '/' . $foldername;
		//new folder
		if (! is_dir ( $uploadpath ))
			mkdir ( $uploadpath, 0755 );
		$config ['upload_path'] = $uploadpath;
		$config ['allowed_types'] = 'gif|jpg|png|jpeg';
		$config ['max_size'] = '1000';
		$config ['max_width'] = '350';
		$config ['max_height'] = '350';
		$config ['overwrite'] = TRUE;
		$config ['file_name'] = time () . '_' . rand ( 0, 1000 );
		$this->load->library ( 'upload', $config );
		
		if (! $this->upload->do_upload ()) {
			echo $this->upload->display_errors ();
		
		} else {
			$data = $this->upload->data ();
			$src = '/'.$uploadpath . '/' . $data ['file_name'];
			$albumId = $this->input->post ( 'albumId' );
			$this->load->Model ( 'Avatar_m' );
			$avatarId = $this->Avatar_m->upload ( $src, $albumId );
			echo $data['client_name'].'@../' . $src . '@' . $avatarId;
		}
	
	}

}
	



