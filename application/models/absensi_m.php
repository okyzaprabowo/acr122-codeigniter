<?php
	class Absensi_m extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		public function get()
		{
			$query=$this->db->get('tbl_mahasiswa');
			return $query->result_array();
		}
	}