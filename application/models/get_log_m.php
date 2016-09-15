<?php
	class Get_log_m extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		public function get($data)
		{
			$query=$this->db->get_where('tbl_log',array('uid'=>$data['uid']));
			return $query->row_array();
		}
	}