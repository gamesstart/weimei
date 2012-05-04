<?php
class music extends  CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}
	function index(){
		$this->page();
	}
	function page(){
		$this->load->view ( 'music_list', $data );
	}
	function pages(){
		$this->output->cache(3);
		$this->load->helper ( 'self_define_helper' );
		//获取url第三个参数值，默认为0
		$page = $this->uri->segment ( 3, 0 );
		//每页10张图片
		$count = 10;
		$this->load->Model ( 'Music_m' );
		$d= $this->Pic_m->page_list( $page, $count );
		$data ['imgs']=$d['imgs'];
		//$this->load->Model('Pic_m');
		//$pics=$this->Pic_m->page_list($page,$count);
		//分页
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'pic/page' );
		$config ['total_rows'] = $d['count']/10;
		$config ['per_page'] = '1';
		$config ['num_links'] = 5;
		$config ['cur_tag_open'] = '<span class=current>';
		$config ['cur_tag_close'] = '</span>';
		//初始化分页
		$this->pagination->initialize ( $config );
		$data ['page_list_link'] = $this->pagination->create_links ();
		$data['title']='美图'.$page.'页';
		$this->load->view ( 'music_list', $data );
	}






}