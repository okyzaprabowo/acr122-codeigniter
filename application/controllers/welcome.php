<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
    {
      parent::__construct();
	  $this->load->model('user');
      $this->load->model('absensi_m');
    }

	public function index()
	{
		$this->load->view('welcome_message');
	}

	function tambahdata(){
 
        if($this->input->post('submit')){
            #$this->load->model('mentrybukukas');
            #$this->mentrybukukas->tambah();
            #redirect('centrybukukas/index');
        }
        $this->load->view('welcome_message');
    }

    function getuid()
    {
    	$data = $this->user->getUID();
    	//$tojson = array(
    	//	'uid' => $data[0]->uid
    	//);
    	echo $data;
    	
    	//if($data !== false)
    	//{
    	//	$this->user->hapuslog();
    	//}

    	//echo json_encode($tojson);
    }

    public function uidgetter()
    {
        $uiddata = $this->input->post('uid');
        $this->user->uidlog();

        $data = array(
            'uid' => $uiddata
            );
        echo json_encode($data);
    }

    function postuid()
    {
        $data = $this->input->post('uid');
        
        echo 'Hallo'.$data;
        /*
        $hasil = $this->user->get_from_mahasiswa($data);
        if($hasil === null)
        {
            //echo '0 '.$hasil;
            echo '0';
        }
        else
        {
            if($hasil === $data)
            {
                //echo '1 '.$hasil;
                echo '1';
            }
            if($hasil !== $data)
            {
                //echo '2 '.$hasil;
                echo '2';
            }
        }
        
        $this->user->hapuslog();
        */
    }


    function contoh_toll()
    {
        header("Access-Control-Allow-Origin: *");

        $data = file_get_contents("php://input");

        echo $data;
    }

    function test()
    {
        echo 1;
    }

    function get_mahasiswa()
    {
        $data = $this->input->post('uid');
        $hasil = $this->user->get_from_mahasiswa($data);

        if($hasil === null)
        {
            //echo '0 '.$hasil;
            echo "GAGAL";
        }
        else
        {
            if($hasil === $data)
            {
                //echo '1 '.$hasil;
                echo "SUKSES";
            }
            if($hasil !== $data)
            {
                //echo '2 '.$hasil;
                echo "2";
            }
        }
        
        $this->user->hapuslog();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */