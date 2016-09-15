<?php 
	class Daftar_model extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		public function input()
		{
			$data=array(
										'nim'=>$this->input->post('nim'),
										'nama'=>$this->input->post('nama'),
										'uid'=>$this->input->post('uid'),
										'angkatan'=>$this->input->post('angkatan')
									);
				return $this->db->insert('tbl_mahasiswa',$data);
		}
	}