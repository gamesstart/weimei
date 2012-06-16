<?php
class Pic extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->library ( 'session' );
		//$this->output->enable_profiler ( TRUE );
	}
	function index() {
		//重定向到第一页
		$this->page(0);
	}
	function page($page=0){
		$uri = $this->config->item('base_url').
		$this->config->item('index_page').
		$this->uri->uri_string();
		//echo $uri;
		$order=$this->input->get('order');
		$this->output->cache(3);
		$this->load->helper ( 'self_define_helper' );
		//获取url第三个参数值，默认为0
		//$page = $this->uri->segment ( 3, 0 );
		//每页20张图片
		$count = 21;
		$this->load->Model ( 'Pic_m' );
		$d= $this->Pic_m->page_list ( $page, $count,$order);
		$data ['imgs']=$d['imgs'];
		//$this->load->Model('Pic_m');
		//$pics=$this->Pic_m->page_list($page,$count);
		//分页
		$this->load->library ( 'pagination' );
		$config['cur_page']=$page;
		$config[' first_url']='0';
		$config ['base_url'] = '/pic/page';
		$config ['total_rows'] = $d['count']/$count;
		$config ['per_page'] = 1;
		$config ['num_links'] = 5;
		$config ['cur_tag_open'] = '<span class=current>';
		$config ['cur_tag_close'] = '</span>';
		//初始化分页
		$this->pagination->initialize ( $config );
		$data['page_list_link']=str_replace('page/', 'page-',$this->pagination->create_links ());
		if($order)
		$data['page_list_link']=preg_replace('/href="(.*?)"/',"href='$1?order=$order'", $data['page_list_link']);
		$data['title']='美图'.$page.'页';
		$this->load->view ( 'pic_list', $data );
	}
	//显示单张图片
	function one($id) {
		$this->output->cache(10);
		//$picid = $this->uri->segment ( 3, 0 );
		$this->load->Model ( 'Pic_m' );
		$data = $this->Pic_m->pic_one ( $id );
		$data->userPic=$this->Pic_m->user_pic($data->userId);
		//获取tags
		$this->load->Model ( 'Tag_m' );
		$data->tag = $this->Tag_m->get_tag ( 'p' . $id, '' );
		//keywords
		$data->keywords=$data->title;
		foreach ($data->tag as $tag){
			$data->keywords.=','.$tag->name;
		}
		$data->name=$data->title;
		$data->title=$data->title?$data->title:$data->id;
		$data->title.='图片';
		//获取喜欢用户
		$this->load->Model ( 'Like_m' );
		$data->likeUser=$this->Like_m->like_user("p$id");
		//获取评论
		$this->load->Model ( 'Comment_m' );
		$data->comment = $this->Comment_m->get_comment ( 'p' . $id );
		//load js
		$this->load->helper ( 'self_define_helper' );
		$data->js = js ( array ('jquery.fancybox-1.3.4' ) );
		$data->css = css ( array ('fancybox/jquery.fancybox-1.3.4' ) );
		$this->load->view ( 'pic_one', $data );
	}
	function rename(){
		//重要操作检测登录
		$this->load->Model ( 'User_m' );
		$this->User_m->is_login ();
		$this->load->Model ( 'Pic_m' );
		$this->Pic_m->rename($this->input->post('id'),$this->input->post('name'));
	}
	function upload() {
		$this->load->helper('cookie');
		//重要操作检测登录
		$this->load->Model ( 'User_m' );
		if($this->User_m->is_login ()){
		$this->load->helper ( 'self_define_helper' );
		//在view中不输出<input name=firstId>
		$data['is_album']=$this->input->get('isalbum', TRUE);
		//load js
		
		$data ['js'] = js ( array ('upload', 'swfobject', 'jquery.uploadify.min' ) );
		$data ['css'] = css ( array ('uploadify' ) );
		$data ['target'] = 'pic';
		$data['title']='上传图片';
		//设置picAlbumId，通过cookie存储，提交的时候直接更新
		 if ($data['is_album']) {
		   $data['albumId']=get_cookie('picAlbumId');
		 	if($data['albumId']==NULL){
			$this->load->Model ( 'Pic_m' );
			$data ['albumId'] = $this->Pic_m->init ();
			//$this->session->set_userdata ( '',  );
			$cookie = array(
					'name'   => 'picAlbumId',
					'value'  => $data ['albumId'],
					'expire' => '122286400',
					'domain' => getDomain(),
					'path'   => '/'
			);
			$this->input->set_cookie($cookie);
		}
		}
		$this->load->view ( 'pic_upload', $data );
	}
	}
	//上传提交更新相关信息
	function upload_submit() {
		$this->load->helper('cookie');
		$data ['id'] = get_cookie( 'picAlbumId' );
		$data ['name'] = $this->input->post ( 'album_name' );
		$data ['firstId'] = $this->input->post ( 'firstId' );
		$data ['picId'] = $this->input->post( 'allPicId' );
		$data ['userId'] = $this->session->userdata ( 'userId' );
		$this->load->Model ( 'Pic_m' );
		$this->Pic_m->upload_submit ( $data );
		if($data['firstId'])
			delete_cookie('picAlbumId',getDomain(),'/');
		//显示成功信息并跳转
		 $data=array('msg'=>'提交成功',
				'url'=>site_url ( 'pic/page' ));
		$this->load->view('redirect',$data); 
		
	}
	//处理上传图片
	function do_upload() {
		$folder = $this->config->item ( 'upload_folder' );
		$foldername = $this->config->item ( 'upload_folder_name' );
		$uploadpath = $folder . '/' . $foldername;
		//new folder
		if (! is_dir ( $uploadpath )) {
			mkdir ( $uploadpath, 0755 );
		
		}
		
		$config ['upload_path'] = $uploadpath;
		$config ['allowed_types'] = 'gif|jpg|png|jpeg';
		//$config ['max_size'] = '100';
		$config ['max_width'] = '960';
		//$config ['max_height'] = '800';
		$config ['overwrite'] = TRUE;
		$config ['file_name'] = time () . '_' . rand ( 0, 1000 );
		$this->load->library ( 'upload', $config );
		if (! $this->upload->do_upload ()) {
			echo $this->upload->display_errors ();
		
		} else {
			$data = $this->upload->data ();
			//生成缩略图,想resize再crop，
			unset ( $config );
			$config ['image_library'] = 'gd2';
			$config ['source_image'] = $data ['full_path'];
			$newimg=$config ['new_image'] = $data ['full_path'] . '.min' . $data ['file_ext'];
			$config ['master_dim'] = 'width';
			//$config ['maintain_ratio'] = 'false';
			$config ['width'] = 270;
			$config ['height'] = 200;
			$this->load->library ( 'image_lib', $config );
			if (! $this->image_lib->resize()) {
				echo $this->image_lib->display_errors ();
			}
			unset ( $config );
			$config ['image_library'] = 'gd2';
			$config ['source_image'] = $data ['full_path'];
			$config ['new_image'] = $data ['full_path'] . '.mini' . $data ['file_ext'];
			$config ['master_dim'] = 'auto';
			$config ['width'] = 270;
			$config ['height'] = 200;
			$this->image_lib->initialize ( $config );
			if (! $this->image_lib->resize()) {
				echo $this->image_lib->display_errors ();
			}
			$this->image_lib->clear ();
			$config ['width'] = 270;
			$config ['height'] = 200;
			$config ['master_dim'] = 'width';
			$config ['overwrite'] = TRUE;
			$config ['maintain_ratio'] = FALSE;
			$config ['image_library'] = 'gd2';
			$config ['source_image'] = $data ['full_path'] . '.mini' . $data ['file_ext'];
			$config ['new_image'] = $data ['full_path'] . '.mini' . $data ['file_ext'];
			$this->image_lib->initialize ( $config );
			if (! $this->image_lib->crop ()) {
				echo $this->image_lib->display_errors ();
			}
			//生成缩略图,想resize再crop，
			unset ( $config );
			$this->image_lib->clear (); 
			$config ['image_library'] = 'gd2';
			$config ['source_image'] = $data ['full_path'].'.mini' . $data ['file_ext'];
			$config ['new_image'] = $data ['full_path'] . '.mini' . $data ['file_ext'];
			$config ['master_dim'] = 'auto';
			$config ['width'] = 120;
			$config ['height'] = 89;
			$this->image_lib->initialize ( $config );
			$this->image_lib->resize (); 
			$src = '/'.$uploadpath . '/' . $data ['raw_name'] . $data ['file_ext'];
			$miniSrc = $src . '.min' . $data ['file_ext'];
			$albumId = $this->input->post ( 'albumId' );
			$this->load->Model ( 'Pic_m' );
			//留作以后添加单独标题用
			$userId=$this->input->post('userId');
			//获取新图片高度
			$res=getimagesize($newimg);
			$height=$res[1];
			$avatarId = $this->Pic_m->upload($src,$albumId,$userId,$height);
			//返回相关信息
			echo $data['client_name']."-$height".'@../' . $miniSrc . '@' . $avatarId;
		}
	}
	//js bookmarket上传
	function collect(){
		$this->load->Model ( 'User_m' );
		if($this->User_m->is_login (0)){
			$data['src']=$this->input->get('src');
			$data['location']=$this->input->get('location');
			$data['name']=$this->input->get('name');
			$this->load->view('collect',$data);
		}else{
			$this->load->view('collect_login',$data);
		}
	}
	function collect_do(){
		$src=$this->input->post('src');
		$location=$this->input->post('location');
		$name=$this->input->post('name');
		$this->load->helper ('self_define_helper' );
		//文件地址
		$folder = $this->config->item ( 'upload_folder' );
		$foldername = $this->config->item ( 'upload_folder_name' );
		$uploadpath = $folder . '/' . $foldername;
		$fileext='.'.getExt($src);
		$filename=$uploadpath.'/'.time () . '_' . rand ( 0, 1000 ).$fileext;
		//new folder
		if (! is_dir ( $uploadpath )) {
			mkdir ( $uploadpath, 0755 );
		}
		//下载文件
		if(download_file($src, $filename)){
			//生成缩略图
			$data['full_path']=$filename;
			$data['file_ext']=$fileext;
			$config ['image_library'] = 'gd2';
			$config ['source_image'] = $data ['full_path'];
			$newimg=$config ['new_image'] = $data ['full_path'] . '.min' . $data ['file_ext'];
			$config ['master_dim'] = 'width';
			//$config ['maintain_ratio'] = 'false';
			$config ['width'] = 270;
			$config ['height'] = 200;
			$this->load->library ( 'image_lib', $config );
			if (! $this->image_lib->resize()) {
				echo $this->image_lib->display_errors ();
			}
			unset ( $config );
			$config ['image_library'] = 'gd2';
			$config ['source_image'] = $data ['full_path'];
			$config ['new_image'] = $data ['full_path'] . '.mini' . $data ['file_ext'];
			$config ['master_dim'] = 'auto';
			$config ['width'] = 270;
			$config ['height'] = 200;
			$this->image_lib->initialize ( $config );
			if (! $this->image_lib->resize()) {
				echo $this->image_lib->display_errors ();
			}
			$this->image_lib->clear ();
			$config ['width'] = 270;
			$config ['height'] = 200;
			$config ['master_dim'] = 'width';
			$config ['overwrite'] = TRUE;
			$config ['maintain_ratio'] = FALSE;
			$config ['image_library'] = 'gd2';
			$config ['source_image'] = $data ['full_path'] . '.mini' . $data ['file_ext'];
			$config ['new_image'] = $data ['full_path'] . '.mini' . $data ['file_ext'];
			$this->image_lib->initialize ( $config );
			if (! $this->image_lib->crop ()) {
				echo $this->image_lib->display_errors ();
			}
			//生成缩略图,想resize再crop，
			unset ( $config );
			$this->image_lib->clear ();
			$config ['image_library'] = 'gd2';
			$config ['source_image'] = $data ['full_path'].'.mini' . $data ['file_ext'];
			$config ['new_image'] = $data ['full_path'] . '.mini' . $data ['file_ext'];
			$config ['master_dim'] = 'auto';
			$config ['width'] = 120;
			$config ['height'] = 89;
			$this->image_lib->initialize ( $config );
			$this->image_lib->resize ();
			$this->load->Model ( 'Pic_m' );
			//留作以后添加单独标题用
			$this->load->library('session');
			$userId=$this->session->userdata('userId');
			//获取新图片高度
			$root=$this->config->item('root');
			$res=getimagesize($root.'/'.$newimg);
			$height=$res[1];
			$this->Pic_m->collect('/'.$filename,$name,$userId,$height,$location);
		}
		$data['msg']='收藏成功，窗口正在关闭。';
		$this->load->view('close',$data);
	}
	/*重新获取图片高度*/
	function check_pic(){
		$start=$this->input->get('start');
		$end=$this->input->get('end');
		$this->load->Model ( 'Pic_m' );
		$d= $this->Pic_m->get_pic_src($start,$end);
		$root=$this->config->item('root');
		$this->load->helper('self_define_helper');
		foreach($d as $key=>$value){
			$res=getimagesize($root.getMiniPic($value->src));
			$this->Pic_m->update_height($value->id,$res[1]);
		}
	}
}
