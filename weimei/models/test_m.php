<?php
class Test_m extends CI_Model {
	function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	
	function get_list() {
		$this->get_child ( '0', 0 );
	
	}
	function get_child($id, $level) {
		$this->db->where ( 'fid', $id );
		$query = $this->db->get ( 'test' );
		$row = $query->result ();
		if ($row) {
			$level ++;
			$count=count($row);
			for($i = 0; $i <$count; $i ++) {

				echo '<option value=' . $row->id . '>' . $this->listtag ( $level) . $row [$i]->name . '</option>';
				
				$this->get_child ( $row [$i]->id, $level );
				
				
				
				
				
				
			}
		}
	}
	function listtag($n) {
		$str = '';
			for($i = 1; $i < $n; $i ++) {
				$str.='-';
			}
		
		
		return $str;
	}

}