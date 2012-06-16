<?php 

class Index extends CI_Controller{
	function  __construct(){
				parent::__construct();
				$this->load->helper('url');
				$this->load->library('session');
				//$this->output->enable_profiler ( TRUE );
	}
	function Index(){
		$this->output->cache(1);
		$data=array(
		'title'=>'唯美小站-分享唯美图片的小清新网站(weimei.de)',
		'description'=>'如果一切美好分为美好和不美好的话，那我希望美好停止于不美好，不美好也停止于美好。',
		'keywords'=>'唯美的图片,好看的图片,唯美小站,唯美意境,唯美意境网,唯美图片,小清新图片,唯美的图片,美图,美图网站,每日唯美图片,最新唯美图片,唯美写真,清新美图,唯美图片网,美的网站,欧美唯美图片,唯美头像,唯美壁纸,非主流唯美图片'
		);
		$this->load->Model('Index_m');
		$data['users']=$this->Index_m->get_latest_user(16);
		$data['comments']=$this->Index_m->get_latest_comment(21);
		$data['avatars']=$this->Index_m->avatar();
		$data['articles']=$this->Index_m->article();
		$data['tags']=$this->Index_m->tag();
		$this->load->helper('self_define_helper');
		//获取url第三个参数值，默认为0
		$page = $this->uri->segment ( 3, 0 );
		//每页10张图片
		$count = 21;
		$this->load->Model ( 'Pic_m' );
		$d= $this->Pic_m->page_list ( $page, $count );
		$data ['imgs']=$d['imgs'];
		//$this->load->Model('Pic_m');
		//$pics=$this->Pic_m->page_list($page,$count);
		//分页
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'pic/page' );
		$config ['total_rows'] = $d['count']/$count;
		$config ['per_page'] = '1';
		$config ['num_links'] = 5;
		$config ['cur_tag_open'] = '<strong class=current>';
		$config ['cur_tag_close'] = '</strong>';
		//初始化分页
		$this->pagination->initialize ( $config );
		$data['page_list_link']=str_replace('page/', 'page-',$this->pagination->create_links ());
		$this->load->view ( 'index', $data );
	}
	
}






?>
