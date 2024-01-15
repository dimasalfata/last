<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {
	public function cek($username,$password)
	{

		$this->db->where('username',$username);
		$this->db->where('password',$password);
		return $this->db->get('tbl_master_user');

	}
	
	public function tampil_data()
	{
		return $this->db->get('tbl_warga')->result();
	} 


	public function ambil_data_rt()
	{
		return $this->db->get('tbl_profil_rt')->result();
	}


	
	public function hapus_session($id_user)
	{
		$hasil = $this->db->query("UPDATE tbl_master_user SET status_login ='0' WHERE id_user='$id_user'");
		return $hasil;
	}




}
