<?php
	class Login_model extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		public function validate($data)
		{
			$this->db->where('username',$data['username']);
			$this->db->where('password',md5($data['password']));
			return $this->db->get('tbl_login')->row();
		}
	}