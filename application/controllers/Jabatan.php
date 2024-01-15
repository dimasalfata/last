<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->login==FALSE) {

			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">Anda Belum Login!!! <button type="button" class="close" data-dismiss="alert" arial-label="close"><span arial-hidden="true">&times;</span></button></div>');

			redirect('dashboard','refresh');
		}elseif($this->session->level!='Admin')  {
			echo "<script> alert('Tidak Ada Akses Untuk Menu ini');
			history.back();
			</script>";

		} 
		date_default_timezone_set('Asia/Jakarta');	
	}

	public function detail_jabatan()
	{
		$this->db->where('id_jabatan',$this->input->get('id_jabatan'));
		$data = $this->db->get('tbl_master_jabatan')->result();
		echo json_encode($data);
	}

	public function tabel_jabatan(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('jabatan',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_jabatan" data="'.$l->id_jabatan.'"><i class="fa fa-edit"></i></a>';


			if ($l->status_jabatan == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_jabatan" data="'.$l->id_jabatan.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_jabatan" data="'.$l->id_jabatan.'"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .='</div>';

			$l->opsi = $opsi;

			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('jabatan',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('jabatan',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}




	public function index()
	{

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('jabatan/tampilan_jabatan');
		$this->load->view('templates/footer');
	}

	

	public function aktivasi_jabatan()
	{

		$this->db->set('status_jabatan',$this->input->post('isi'));
		$this->db->where('id_jabatan',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_jabatan');
		echo json_encode($data);

	}


	public function simpan()
	{


		
		$data_jabatan = array(
			'nama_jabatan' => $this->input->post('nama_jabatan'),
			'status_jabatan' =>1,
		);
		$result= $this->db->insert('tbl_master_jabatan', $data_jabatan);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Jabatan Baru dengan nama ".$this->input->post('nama_jabatan'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Jabatan Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Jabatan Gagal Ditambahkan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('jabatan','refresh');

	}

	public function ubah()
	{
		$data_jabatan = array(
			'nama_jabatan' => $this->input->post('nama_jabatan'),
		);
		$this->db->where('id_jabatan',$this->input->post('id_jabatan'));
		$result= $this->db->update('tbl_master_jabatan', $data_jabatan);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Jabatan dengan ID ".$this->input->post('id_jabatan'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Jabatan Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Jabatan Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('jabatan','refresh');

	}


	
	
}