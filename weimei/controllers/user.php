<?php
class User extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->model ( 'User_m' );
		$this->load->library ( 'session' );
		$this->load->helper ( 'html' );
		//$this->output->enable_profiler(TRUE);
	}
	function index() {
		$this->is_login();
	}
	function i(){
		$this->output->cache(60);
		$id=$this->uri->segment(3,1);
		$data=$this->User_m->get_user_msg($id);
		$data['userId']=$id;
		$data['name']=$data['username'];
		$data['title']=$data['username'];
		$this->load->helper('self_define_helper');
		$this->load->view('user_i',$data);
	}

	function reg() {
		$data ['title'] = '注册新用户';
		if ($_POST['username']&&$_POST['password']&&$_POST['email']) {
			$data = array (
			'id' => '', 'username' =>$this->input->post ('username'),
			'password' => md5($this->input->post('password')),
			'email' => $this->input->post ('email' ),
			'ip' => $this->input->ip_address (),
			'regTime'=>date("Y-m-d H:i:s"),
			'lastLogin'=>date("Y-m-d H:i:s")
			);
			if ($this->User_m->reg ( $data )) {
				//显示成功信息并跳转
				$data=array('msg'=>'注册成功,跳转登录页面中...',
						'url'=>site_url ( 'user/login' ));
				$this->load->view('redirect',$data);
			}
			else{
				//显示成功信息并跳转
				$data=array('msg'=>'注册失败，请重新输入信息！',
						'url'=>site_url ( 'user/reg' ));
				$this->load->view('redirect',$data);
			}
		}else{
			$this->load->view('user_reg',$data);
		}
	}
	function login() {
		$data ['title'] = '登录';
		$data['referer']=$this->input->get('referer');
		$data['referer']=$data['referer']?$data['referer']:$_SERVER['HTTP_REFERER'];
		if ($_POST) {
			$email = $this->input->post ( 'email' );
			$password = $this->input->post ( 'password' );
			$user = $this->User_m->check_login ( $email, $password );
			if (count ( $user )) {
				$this->session->set_userdata ( array ('userId' => $user['id'], 'username' => $user['username'], 'password' =>$user['password']) );
				//设置cookie
				$cookie = array(
                   'name'   => 'userId',
                   'value'  => $user['id'],
                   'expire' => '86400',
                   'domain' => getDomain(),
                   'path'   => '/'
               );
             $this->input->set_cookie($cookie); 
             $cookie = array(
                   'name'   => 'username',
                   'value'  => $user['username'],
                   'expire' => '86400',
                   'domain' => getDomain(),
                   'path'   => '/'
               );
               $this->input->set_cookie($cookie); 
               $cookie = array(
               		'name'   => 'icon',
               		'value'  => $user['icon'],
               		'expire' => '86400',
               		'domain' => getDomain(),
               		'path'   => '/'
               );
               $this->input->set_cookie($cookie);
				Header ( "Location:" .$data['referer']);
			} else {
				$data ['error'] = '错误：用户名或密码不正确。';
				$this->load->view ( 'user_login', $data );
			}
		} else {
			$this->load->view ( 'user_login', $data );
		}
	}
	function login_out() {
		$this->session->sess_destroy ();
		$this->load->helper('cookie');
		delete_cookie('userId',getDomain(),'/');
		delete_cookie('username',getDomain(),'/');
		//显示成功信息并跳转
		$data=array('msg'=>'退出成功！',
				'url'=>site_url ( 'user/login' ));
		$this->load->view('redirect',$data);
	}
	function lost_pwd() {
		$this->load->view ( 'user_lost_pwd' );
	}
	function set() {
		$data ['title'] = '帐号设置';
		if($this->User_m->is_login ()){
		$this->load->helper ( 'html' );
		if ($_POST) {
			$userid = $this->session->userdata ( 'userId' );
			$data = array (
			'id' => $userid,
			'city' =>$this->input->post ( 'city' ),
			'birthday' =>$this->input->post ( 'birthday' ),
			'qq' =>$this->input->post ( 'qq' ),
			'city' =>$this->input->post ( 'city' ),
			'sex' =>$this->input->post ( 'sex' ),
			'about' =>$this->input->post ( 'about' )
			 );
			$this->User_m->update_user_msg ( $data );
			$data = $this->User_m->get_user_msg ( $userid );
			$data['title']= '帐号设置';
			$this->load->view ( 'user_setting', $data );
		} else {
			$data = $this->User_m->get_user_msg ( $this->session->userdata ( 'userId' ) );
			$data['title']= '帐号设置';
			$this->load->view ( 'user_setting', $data );
		}
	}
	}
	function set_pwd() {
		if($this->User_m->is_login ()){
		$data ['name'] = '帐号设置';
		$this->User_m->is_login ( $this->session->userdata ( 'userid' ), $this->session->userdata ( 'password' ) );
		if ($_POST) {
			$password = $this->input->post ( 'password' );
			$newpassword = $this->input->post ( 'newpassword' );
			$data = array ('id' => $this->session->userdata ( 'userid' ), 'password' => md5 ( $password ), 'newpassword' => md5 ( $newpassword ) );
			if ($this->User_m->update_pwd ( $data )) {
				$data ['msg'] = '更新成功';
				$this->session->set_userdata ( 'password', $data ['newpassword'] );
			} else {
				$data ['msg'] = '修改失败';
			}
			$this->load->view ( 'user_setting_pwd', $data );
		} else {
			$this->load->view ( 'user_setting_pwd', $data );
		}
	}
	}
	function set_icon() {
		if($this->User_m->is_login ()){
			$userId = $this->session->userdata ( 'userId' );
			$data=$this->User_m->get_user_msg($userId);
			$data ['title'] = '头像设置';
			$this->load->helper('self_define_helper');
			$data['js']= js ( array ('jquery.Jcrop.min','jquery.uploadify.min','upload') );
			$data['css']= css ( array ('jquery.Jcrop.min' ) );
			$this->load->view ( 'user_setting_icon', $data );
				
		}
	}
	function upload_icon(){
		$userId=$this->input->post('userId');
		$folder = $this->config->item ( 'upload_folder' );
		$path=$folder . '/icon/'.$userId.'.jpg.org.jpg';
		if (! is_dir ( dirname($path) )) {
			mkdir ( dirname($path), 0755 ,true);
		}
		move_uploaded_file($_FILES["userfile"]["tmp_name"],$path);
		//缩放图片
		$img=getimagesize($path);
		$width=$img[0];
		$height=$img[1];
		if($width>500||$height>500){
			if($width>$height){
				$targ_w =500;
				$targ_h =$height*500/$width;
				$jpeg_quality = 90;
				$img_r = imagecreatefromjpeg($path);
				$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
				imagecopyresampled($dst_r,$img_r,0,0,0,0,$targ_w,$targ_h,$width,$height);
				imagejpeg($dst_r,$path);
			}else{
				$targ_h =500;
				$targ_w =$width*500/$height;
				$jpeg_quality = 90;
				$img_r = imagecreatefromjpeg($path);
				$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
				imagecopyresampled($dst_r,$img_r,0,0,0,0,$targ_w,$targ_h,$width,$height);
				imagejpeg($dst_r,$path);
			}
		}
	}
	function cut_icon(){
		$userId = $this->session->userdata ( 'userId' );
		$folder = $this->config->item ( 'upload_folder' );
		$path=$folder . '/icon/'.$userId.'.jpg.org.jpg';
		/*裁剪*/
		//200*200
		$targ_w = $targ_h =200;
		$jpeg_quality = 90;
		$img_r = imagecreatefromjpeg($path);
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
		imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
		imagejpeg($dst_r,$folder . '/icon/'.$userId.'.jpg');
		imagedestroy($dst_r);
		//150*150
		$targ_w = $targ_h =48;
		$jpeg_quality = 90;
		$img_r = imagecreatefromjpeg($path);
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
		imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
		imagejpeg($dst_r,$folder . '/icon/'.$userId.'.jpg.min.jpg');
		imagedestroy($dst_r);
		
	}
	
	/*like user*/
	function like(){
		$uid=$this->input->post('uid');
		$likeUserId=$this->input->post('likeUserId');
		$this->User_m->like($likeUserId,$uid);
	}
}






