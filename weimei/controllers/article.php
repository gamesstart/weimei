<?php
class article extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->library ( 'session' );
		$this->load->helper ( 'self_define_helper' );
		//$this->output->enable_profiler ( TRUE );
	}
	function index() {
		$this->page(0);
	}
	function add() {
		$this->load->Model ( 'User_m' );
		if($this->User_m->is_login ())
		if($_POST) {
			$data = array ('userId' => $this->session->userdata ( 'userId' ), 'name' => $this->input->post ( 'title' ), 'content' => toText ( $this->input->post ( 'content' ) ), 'date' => date ( 'Y-m-d H:i:s' ) );
			$pattern = '/\[img\](\d+)\[\/img\]/is';
			$data['description']=preg_replace($pattern,'',$data['content']);
			//提取nail图
			$pattern = '/\[img\](\d+)\[\/img\]/i';
			preg_match($pattern, $data['content'],$res);
			$this->load->Model ( 'Article_m' );
			$res=$this->Article_m->get_pic($res[1]);
			if($res->src)
			$data['nail']=$res->src;
			if($this->Article_m->add($data)){
				//显示成功信息并跳转
				$data=array('msg'=>'提交成功',
						'url'=>site_url ( 'article/page/0' ));
				$this->load->view('redirect',$data);
			}
		} else {
			$this->load->view ( 'article_add' );
		}
	}
	function edit(){
		$this->load->Model ( 'User_m' );
		if($this->User_m->is_login ()){
			if(!$_POST){
				$data['id']=$this->input->get('id');
				$this->load->Model('Article_m');
				$data['e']=$this->Article_m->edit($data['id']);
				$this->load->view ( 'article_edit',$data);
			}
			else{
			
				$data=array(
						'id'=>$this->input->post('id'),
						'name' => $this->input->post ( 'title' ),
						'content' => toText ( $this->input->post ( 'content' ))
						);
				$pattern = '/\[img\](\d+)\[\/img\]/is';
				$data['description']=preg_replace($pattern,'',$data['content']);
				//提取nail图
				preg_match($pattern, $data['content'],$res);
				$this->load->Model ( 'Article_m' );
				$res=$this->Article_m->get_pic($res[1]);
				if($res->src)
					$data['nail']=$res->src;
				$this->Article_m->edit_done($data);
				//显示成功信息并跳转
				$data=array('msg'=>'修改成功',
						'url'=>site_url ( 'article/view/'.$data['id']));
				$this->load->view('redirect',$data);
			}
		}
	}
	function page($page) {
		$this->load->helper ( 'self_define_helper' );
		$this->output->cache(3);
		//$page = $this->uri->segment ( 3, 0 );
		//每页10
		$count = 7;
		$this->load->Model ( 'Article_m' );
		$d=$this->Article_m->article_list ( $page, $count );
		$data ['articles'] =$d['articles'];
		//分页
		$this->load->library ( 'pagination' );
		$config ['base_url'] ='/article/page';
		$config['cur_page']=$page;
		$config ['total_rows'] =$d['count']/$count;
		$config ['per_page'] = '1';
		$config ['num_links'] = 5;
		$config ['cur_tag_open'] = '<span class=current>';
		$config ['cur_tag_close'] = '</span>';	
		$this->pagination->initialize ( $config );
		$data['page_list_link']=str_replace('page/', 'page-',$this->pagination->create_links ());
		$data ['title'] = '文字' . $page . '页';
		$this->load->view ( 'article_list', $data );
	}
	function view($id){
		$this->load->helper ( 'self_define_helper' );
		$this->output->cache(3);
		//$id= $this->uri->segment ( 3, 0 );
		$this->load->Model('Article_m');
		$data=$this->Article_m->view($id);
		//获取图片
		$pattern = '/\[img\](\d+?)\[\/img\]/i';
		$data->content=preg_replace_callback($pattern,array($this,'get_pic'),$data->content);
		//获取tags
		$this->load->Model ( 'Tag_m' );
		$data->tag = $this->Tag_m->get_tag ( 'e' . $id, '' );
		//keywords
		$data->keywords=$data->title;
		foreach ($data->tag as $tag){
			$data->keywords.=','.$tag->name;
		}
		//获取喜欢用户
		$this->load->Model ( 'Like_m' );
		$data->likeUser=$this->Like_m->like_user("e$id");
		//获取评论
		$this->load->Model ( 'Comment_m' );
		$data->comment = $this->Comment_m->get_comment ( 'e' . $id );
		$this->load->view('article_view',$data);
	}
	function get_pic($pid){
		$d=$this->Article_m->get_pic($pid[1]);
		return "<img src=$d->src>";
	}
}