<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userModel
 *
 * @author Okyza Maherdy Prabowo
 */
class User extends CI_Model{
    //put your code here
    function uidlog()
    {
      $data=array(
                    'uid'=>$this->input->post('uid')
                  );
        return $this->db->insert('tbl_log',$data);
    }


    function login($username, $password)
    {
      $this -> db -> select('id, username, password');
      $this -> db -> from('users');
      $this -> db -> where('username', $username);
      $this -> db -> where('password', MD5($password));
      $this -> db -> limit(1);

      $query = $this -> db -> get();

      if($query -> num_rows() == 1)
      {
        return $query->result();
      }
      else
      {
        return false;
      }
    }

    function getUID()
    {
      $this -> db -> select('uid');
      $this -> db -> from('tbl_log');
      $this->db->order_by("date_time", "desc");
      $this -> db -> limit(1);
      $query = $this -> db -> get();
      if($query -> num_rows() == 1)
      {
        $hasil = $query->result();
        return $hasil[0]->uid;
      }
      else
      {
        return false;
      }
    }

    function get_from_mahasiswa($uid)
    {
      $this -> db -> select('uid');
      $this -> db -> from('tbl_mahasiswa');
      $this -> db -> where('uid', $uid);
      $query = $this -> db -> get();
      if($query -> num_rows() == 1)
      {
        $hasil = $query->result();
        return $hasil[0]->uid;
      }
      else
      {
        return null;
      }
    }

    function hapuslog()
    {
      $query=$this->db->query("DELETE FROM tbl_log");
    }
}
