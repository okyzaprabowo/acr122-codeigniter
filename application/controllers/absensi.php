<?php
	class Absensi extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('absensi_m');
		}
		public function index()
		{
			$data['mhs']=$this->absensi_m->get();
			$this->load->view('absensi',$data);
		}
	}