<?php
	class Get_log extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('get_log_m');
		}
		public function index()
		{
			$this->load->view('log');
		}
		public function check()
		{
			if($_POST)
			{
				$hasil=$this->get_log_m->get($_POST);
				if(!empty($hasil))
				{
					$this->load->view('success');
				}
			}
		}
	}