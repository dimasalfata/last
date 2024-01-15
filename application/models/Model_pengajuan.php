<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pengajuan extends CI_Model {
	
	public function buat_kode()
	{
		$this->db->select('RIGHT(kode_pengajuan,5) as kode', FALSE);
		$this->db->where('MONTH(tanggal_input)',date('m'));
		$this->db->where('YEAR(tanggal_input)',date('Y'));
		$this->db->order_by('id_pengajuan', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('tbl_pengajuan');   
		   //cek dulu apakah ada sudah ada kode di tabel.    
		if ($query->num_rows() <> 0) {
			//jika kode ternyata sudah ada.      
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			//jika kode belum ada      
			$kode = 1;
		}
		$kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT); // angka 5 menunjukkan jumlah digit angka 0
		$kodejadi = "NSB-".date('ym') .'-'. $kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;
	}


}
