<?php
	class Login extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('login_model');
			$this->load->library('session');
			
		}
		public function index()
		{
			if($_POST)
			{
				$result=$this->login_model->validate($_POST);
				if(!empty($result))
				{
					$data=[
										'id_admin'=>$result->id_admin,
										'username'=>$result->username,
									];
					$this->session->set_userdata($data);
					redirect('landing');
				}
				else
				{
					$this->session->set_flashdata('flash_data','Username or Password Incorrect');
					redirect('login');
				}
			}
			$this->load->view('login');
		}
	}