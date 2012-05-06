
<?php
class Tag extends CI_Controller {
	function __construct(){
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
 		
	}
	function _remap($method)
	{
		if($method&&$method!='add_tag'){
			$this->search_tag($method);
		}elseif($method=='get_tag'){
			$this->get_tag();
		}elseif($method=='add_tag'){
			$this->add_tag();
		}else{
			$this->tag_list();
		}
		
	}
	function search_tag($tag){
			if(strpos($tag,'%')!==false)
			$tag=urldecode($tag);
			//url 传递tag在windows上面为gb2312时候
			elseif($tag[0]<=127)
				$tag=iconv('gb2312','utf-8', $tag);
			$data->title='和'.$tag.'相关的文章，头像，图片';
			$this->load->Model('Tag_m');
			$data->result=$this->Tag_m->get_tag('',$tag);
			$this->load->helper('url');
			$this->load->view('tag',$data);
	}
	function get_tag(){
		$id=$this->input->get('pid');
		$tag=$this->input->get('tag');
		$this->load->Model('Tag_m');
		$result=$this->Tag_m->get_tag($id,$tag);
	}
	//添加tag,转化为数组,js替换全角，为半角
	function add_tag(){
		//判断登录
		$this->load->Model('User_m');
		$this->User_m->is_login();
		$userId= $this->session->userdata ( 'userId' );
		$id=$this->input->post('id');
		$tags=$this->input->post('tags');
		//$tags=str_replace('，',',', $tags);
		$tag=explode(',',$tags);
		$this->load->Model('Tag_m');
		$this->Tag_m->add_tag($id,$tag,$userId);
		
	}
	function tag_list(){
		
		
	}

}