<?php
class Album extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->library ( 'session' );
		$this->output->enable_profiler ( TRUE );
	}
	function index() {
		redirect ( 'album/page/0' );
	}
	function page() {
		$this->output->cache(3);
		$this->load->helper('self_define_helper');
		$page = $this->uri->segment ( 3, 0 );
		//每页10张图片
		$count = 10;
		$this->load->Model ( 'Album_m' );
		$d= $this->Album_m->album_list ( $page, $count );
		$data['imgs']=$d['imgs'];
		//$this->load->Model('Pic_m');
		//$pics=$this->Pic_m->page_list($page,$count);
		//分页
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'album/page' );
		$config ['total_rows'] =$d['count']/$count;
		$config ['per_page'] = '1';
		$config ['num_links'] = 5;
		$config ['cur_tag_open'] = '<span class=current>';
		$config ['cur_tag_close'] = '</span>';
		$this->pagination->initialize ( $config );
		$data ['page_list_link'] = $this->pagination->create_links ();
		$data['title']='专辑'.$page.'页';
		$data['imgs']['count']=$d['count'].'-'.$count;
		$this->load->view ( 'album_list', $data );
	}
	function detail() {
		$this->output->cache(30);
		$this->load->helper('self_define_helper');
		//
		$albumId = $this->uri->segment (3, 0 );
		$page = $this->uri->segment ( 4, 0 );
		//每页10张图片
		$count = 20;
		$this->load->Model ( 'Album_m' );
		$data['imgs']=$this->Album_m->detail ( $albumId, $page, $count );
		//$this->load->Model('Pic_m');
		//$pics=$this->Pic_m->page_list($page,$count);
		//分页
		$this->load->library ( 'pagination' );
		$config ['uri_segment'] = 4;
		$config ['base_url'] = site_url ( 'album/detail/' . $albumId );
		$config ['total_rows'] =$data['img']['count']/$count;
		$config ['per_page'] = '1';
		$config ['num_links'] = 5;
		$config ['cur_tag_open'] = '<span class=current>';
		$config ['cur_tag_close'] = '</span>';
		$this->pagination->initialize ( $config );
		$data ['page_list_link'] = $this->pagination->create_links ();
		$data['title']=$data['imgs'][0]->name.'专辑'.$page.'页';
		$data['imgs']['count']=$data['imgs']['count'].'-'.$count;
		$this->load->view ( 'album_detail', $data );
	}
}
	
