<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabang extends CI_Controller {
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

	public function detail_cabang()
	{
		$this->db->where('id_cabang',$this->input->get('id_cabang'));
		$data = $this->db->get('tbl_master_cabang')->result();
		echo json_encode($data);
	}

	public function tabel_cabang(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'id_cabang';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'ASC';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('cabang',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_cabang" data="'.$l->id_cabang.'"><i class="fa fa-edit"></i></a>';


			if ($l->status_cabang == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_cabang" data="'.$l->id_cabang.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_cabang" data="'.$l->id_cabang.'"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .='</div>';

			$l->opsi = $opsi;

			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('cabang',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('cabang',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}




	public function index()
	{

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('cabang/tampilan_cabang');
		$this->load->view('templates/footer');
	}

	

	public function aktivasi_cabang()
	{

		$this->db->set('status_cabang',$this->input->post('isi'));
		$this->db->where('id_cabang',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_cabang');
		echo json_encode($data);

	}


	public function simpan()
	{


		
		$data_cabang = array(
			'nama_cabang' => $this->input->post('nama_cabang'),
			'telp_cabang' => $this->input->post('telp_cabang'),
			'alamat_cabang' => $this->input->post('alamat_cabang'),

			'status_cabang' =>1,
		);
		$result= $this->db->insert('tbl_master_cabang', $data_cabang);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Cabang Baru dengan nama ".$this->input->post('nama_cabang'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Cabang Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Cabang Gagal Ditambahkan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('cabang','refresh');

	}

	public function ubah()
	{
		$data_cabang = array(
			'nama_cabang' => $this->input->post('nama_cabang'),
			'telp_cabang' => $this->input->post('telp_cabang'),
			'alamat_cabang' => $this->input->post('alamat_cabang'),
			
		);
		$this->db->where('id_cabang',$this->input->post('id_cabang'));
		$result= $this->db->update('tbl_master_cabang', $data_cabang);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Cabang dengan ID ".$this->input->post('id_cabang'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Cabang Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Cabang Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('cabang','refresh');

	}


	
	
}