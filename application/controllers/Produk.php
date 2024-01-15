<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
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

	public function detail_kategori_produk()
	{
		$this->db->where('id_kategori',$this->input->get('id_kategori'));
		$data = $this->db->get('tbl_kategori_produk')->result();
		echo json_encode($data);
	}


	public function detail_produk()
	{
		$this->db->where('id_produk',$this->input->get('id_produk'));
		$data = $this->db->get('tbl_master_produk')->result();
		echo json_encode($data);
	}

		public function detail_informasi()
	{
		$this->db->where('id_informasi',$this->input->get('id_informasi'));
		$data = $this->db->get('tbl_informasi_produk')->result();
		echo json_encode($data);
	}

	public function informasi()
	{

		$this->db->select('a.*,b.informasi_produk');
		$this->db->where('a.status_produk',1);
		$this->db->where('b.informasi_produk',null);
		$this->db->join('tbl_informasi_produk b','b.id_produk=a.id_produk','left');
		$data['produk'] = $this->db->get('tbl_master_produk a')->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('produk/informasi_produk',$data);
		$this->load->view('templates/footer');
	}

	public function tabel_informasi(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'nama_produk';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('informasi',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;
			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-primary   item_edit_informasi" data="'.$l->id_informasi.'"><i class="fa fa-edit"></i></a>';
			$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_hapus_informasi" data="'.$l->id_informasi.'"><i class="fa fa-trash"></i></a>';
			$opsi .='</div>';

			if ($l->informasi_produk!='') {
				$l->informasi_produk = substr($l->informasi_produk,0,500);
			}

			$l->opsi = $opsi;
			if ($l->informasi_foto!='') {
				$l->informasi_foto = '<img src="'.base_url().$l->informasi_foto.'" width="35px">';
			}
			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('informasi',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('informasi',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}


	public function tabel_produk(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'nama_produk';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('produk',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;


			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_produk" data="'.$l->id_produk.'"><i class="fa fa-edit"></i></a>';


			if ($l->status_produk == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_produk" data="'.$l->id_produk.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_produk" data="'.$l->id_produk.'"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .='</div>';

			$l->opsi = $opsi;
			if ($l->keterangan_produk!='') {
				$l->keterangan_produk = substr($l->keterangan_produk,0,500);
				
			}
			if ($l->foto_produk!='') {
				$l->foto_produk = '<img src="'.base_url().$l->foto_produk.'" width="35px">';
			}
			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('produk',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('produk',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}

	public function tabel_kategori_produk(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'nama_kategori';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('kategori_produk',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_produk" data="'.$l->id_kategori.'"><i class="fa fa-edit"></i></a>';


			if ($l->status_kategori == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_kategori" data="'.$l->id_kategori.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_kategori" data="'.$l->id_kategori.'"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .='</div>';

			$l->opsi = $opsi;

			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('kategori_produk',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('kategori_produk',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}


	public function index()
	{
		$this->db->where('status_kategori',1);
		$data['kategori'] = $this->db->get('tbl_kategori_produk')->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('produk/tampilan_produk',$data);
		$this->load->view('templates/footer');
	}

	public function kategori()
	{

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('produk/tampilan_kategori_produk');
		$this->load->view('templates/footer');
	}


	public function aktivasi_produk()
	{

		$this->db->set('status_produk',$this->input->post('isi'));
		$this->db->where('id_produk',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_produk');
		echo json_encode($data);

	}


	public function aktivasi_kategori()
	{

		$this->db->set('status_kategori',$this->input->post('isi'));
		$this->db->where('id_kategori',$this->input->post('kode'));
		$data = $this->db->update('tbl_kategori_produk');
		echo json_encode($data);

	}
	public function simpan_informasi()
	{


		if (!is_dir('assets/img/foto_informasi/')) {
			mkdir('assets/img/foto_informasi/');
		}

		$foto = '';

		if($_FILES['lampiran_informasi']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_informasi']['name']);
			$location ='assets/img/foto_informasi/produk_'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_informasi']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}
		
		$data_produk = array(
			'id_produk' => $this->input->post('id_produk'),
			'informasi_produk' => $this->input->post('informasi_produk'),
			'informasi_foto' => $foto,
		);
		$result= $this->db->insert('tbl_informasi_produk', $data_produk);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Informasi Produk Baru dengan nama ".$this->input->post('id_produk'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Informasi Produk Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Informasi Produk Gagal Ditambahkan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('produk/informasi','refresh');

	}




	public function ubah_informasi()
	{


		if (!is_dir('assets/img/foto_informasi/')) {
			mkdir('assets/img/foto_informasi/');
		}

		$foto = $this->input->post('lampiran_informasi_lama');

		if($_FILES['lampiran_informasi']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_informasi']['name']);
			$location ='assets/img/foto_informasi/produk_'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_informasi']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}
		
		$data_produk = array(
			'informasi_produk' => $this->input->post('informasi_produk'),
			'informasi_foto' => $foto,
		);
		$this->db->where('id_informasi',$this->input->post('id_informasi'));
		$result= $this->db->update('tbl_informasi_produk', $data_produk);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Informasi Produk dengan ID ".$this->input->post('id_produk'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Informasi Produk Berhasil Diubah!';
			$data['icon'] = 'success';

		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Informasi Produk Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('produk/informasi','refresh');

	}

	public function hapus_informasi()
	{
		$this->db->where('id_informasi',$this->input->post('id_informasi_hapus'));
		$delete  = $this->db->delete('tbl_informasi_produk');
		if ($delete) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menghapus Data Informasi Produk dengan ID ".$this->input->post('id_informasi_hapus'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Informasi Produk Berhasil Dihapus!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Informasi Produk Gagal Dihapus!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('produk/informasi','refresh');
	}



	public function simpan()
	{


		if (!is_dir('assets/img/foto_produk/')) {
			mkdir('assets/img/foto_produk/');
		}

		$foto = '';

		if($_FILES['lampiran_produk']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_produk']['name']);
			$location ='assets/img/foto_produk/produk_'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_produk']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}
		
		$data_produk = array(
			'nama_produk' => $this->input->post('nama_produk'),
			'id_kategori' => $this->input->post('kategori'),
			'keterangan_produk' => $this->input->post('keterangan_produk'),
			'foto_produk' => $foto,
			'status_produk' =>1,
		);
		$result= $this->db->insert('tbl_master_produk', $data_produk);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Produk Baru dengan nama ".$this->input->post('nama_produk'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Produk Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Produk Gagal Ditambahkan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('produk','refresh');

	}


	public function ubah()
	{


		if (!is_dir('assets/img/foto_produk/')) {
			mkdir('assets/img/foto_produk/');
		}

		$foto = $this->input->post('lampiran_produk_lama');

		if($_FILES['lampiran_produk']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_produk']['name']);
			$location ='assets/img/foto_produk/produk_'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_produk']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}
		
		$data_produk = array(
			'nama_produk' => $this->input->post('nama_produk'),
			'id_kategori' => $this->input->post('kategori'),
			'keterangan_produk' => $this->input->post('keterangan_produk'),
			'foto_produk' => $foto,
		);
		$this->db->where('id_produk',$this->input->post('id_produk'));
		$result= $this->db->update('tbl_master_produk', $data_produk);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Produk Baru dengan ID ".$this->input->post('id_produk'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Produk Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Produk Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('produk','refresh');

	}


	public function simpan_kategori()
	{


		
		$data_kategori = array(
			'nama_kategori' => $this->input->post('nama_kategori'),
			'status_kategori' =>1,
		);
		$result= $this->db->insert('tbl_kategori_produk', $data_kategori);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data kategori Produk Baru dengan nama ".$this->input->post('nama_kategori'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Kategori Produk Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Kategori Produk Gagal Ditambahkan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('produk/kategori','refresh');

	}

	public function ubah_kategori()
	{
		$data_kategori = array(
			'nama_kategori' => $this->input->post('nama_kategori'),
		);
		$this->db->where('id_kategori',$this->input->post('id_kategori'));
		$result= $this->db->update('tbl_kategori_produk', $data_kategori);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Kategori Produk dengan ID ".$this->input->post('id_kategori'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Kategori Produk Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Kategori Produk Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('produk/kategori','refresh');

	}
	
	
}