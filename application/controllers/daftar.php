<?php
	class Daftar extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('daftar_model');
			$this->load->model('user');
			$this->load->helper('url');
		}
		public function index()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('nim','Nim','required');
			$this->form_validation->set_rules('nama','Nama','required');
			$this->form_validation->set_rules('uid','Uid','required');
			$this->form_validation->set_rules('angkatan','Angkatan','required');
			
			if($this->form_validation->run()===false)
			{
				$this->load->view('daftar');
			}
			else
			{
				$this->daftar_model->input();
				$this->user->hapuslog();
				redirect('absensi');
			}
		}
		
	}