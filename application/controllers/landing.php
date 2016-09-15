<?php
	class Landing extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
			if(empty($this->session->userdata('id_admin')))
			{
				$this->session->set_flashdata('flash_data','Please Login');
				redirect('login');
			}
		}
		public function index()
		{
			$this->load->view('landing');
			$this->load->view('footer');
		}
		public function logout()
		{
			$data=[
							'id_admin',
							'username'
							];
			$this->session->unset_userdata($data);
			redirect('login');
		}
	}