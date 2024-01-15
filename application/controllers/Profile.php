<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
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
	public function detail_profile()
	{
		$this->db->where('id_profile',$this->input->get('id_profile'));
		$data = $this->db->get('tbl_profile')->result();
		echo json_encode($data);
	}

	public function testimoni()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('profile/tampilan_testimoni');
		$this->load->view('templates/footer');
	}

	public function detail_syarat()
	{
		$this->db->where('id_syarat',$this->input->get('id_syarat'));
		$data = $this->db->get('syarat_ketentuan')->result();
		echo json_encode($data);
	}

	public function detail_about()
	{
		$this->db->where('about_id',$this->input->get('about_id'));
		$data = $this->db->get('tbl_about_us')->result();
		echo json_encode($data);
	}

	public function detail_feature()
	{
		$this->db->where('feature_id',$this->input->get('feature_id'));
		$data = $this->db->get('tbl_feature')->result();
		echo json_encode($data);
	}

	public function detail_clients()
	{
		$this->db->where('clients_id',$this->input->get('clients_id'));
		$data = $this->db->get('tbl_clients')->result();
		echo json_encode($data);
	}

	public function detail_pengawas()
	{
		$this->db->where('pengawas_id',$this->input->get('pengawas_id'));
		$data = $this->db->get('tbl_pengawas')->result();
		echo json_encode($data);
	}

	public function detail_testimoni()
	{
		$this->db->where('testimoni_id',$this->input->get('testimoni_id'));
		$data = $this->db->get('tbl_testimoni')->result();
		echo json_encode($data);
	}

	public function tabel_profile(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('profile',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-primary   item_edit_profile" data="'.$l->id_profile.'"><i class="fa fa-edit"></i></a>';
			$opsi .='</div>';

			$l->opsi = $opsi;
			if ($l->logo_profile!='') {
				$l->logo_profile ='<img src="'.$l->logo_profile.'" width="50px">';
			}
			$data[] = $l;
		}
		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('profile',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('profile',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}
	public function tabel_about(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'about_id';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');
		$list = $this->model_tabel->get_datatables('about',$sort,$order,$search);
		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-primary   item_edit_about" data="'.$l->about_id.'"><i class="fa fa-edit"></i></a>';
			$opsi .='</div>';
			if ($l->about_foto!='') {
				$l->about_foto='<img src="'.base_url().$l->about_foto.'" width="150px">';
			}

			$l->opsi = $opsi;
			$data[] = $l;
		}
		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('about',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('about',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}
	public function tabel_feature(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'about_id';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');
		$list = $this->model_tabel->get_datatables('feature',$sort,$order,$search);
		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-primary   item_edit_feature" data="'.$l->feature_id.'"><i class="fa fa-edit"></i></a><a href="javascript:;" class="btn btn-sm btn-circle  btn-danger   item_hapus_feature" data="'.$l->feature_id.'"><i class="fa fa-trash"></i></a>';
			$opsi .='</div>';
			$l->opsi = $opsi;
			$data[] = $l;
		}
		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('feature',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('feature',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}
	public function tabel_syarat(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'id_syarat';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('syarat',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-primary   item_edit_syarat" data="'.$l->id_syarat.'"><i class="fa fa-edit"></i></a>';
			$opsi .='</div>';

			$l->opsi = $opsi;
			$data[] = $l;
		}
		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('syarat',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('syarat',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}

	public function tabel_clients(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'clients_id';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('clients',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-primary   item_edit_clients" data="'.$l->clients_id.'"><i class="fa fa-edit"></i><a href="javascript:;" class="btn btn-sm btn-circle  btn-danger   item_hapus_clients" data="'.$l->clients_id.'"><i class="fa fa-trash"></i></a>';
			$opsi .='</div>';

			$l->opsi = $opsi;
			if ($l->clients_logo!='') {
				$l->clients_logo='<img src="'.base_url().$l->clients_logo.'" style="width:50px">';
			}
			$data[] = $l;
		}
		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('clients',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('clients',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}



	public function tabel_pengawas(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'clients_id';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('pengawas',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-primary   item_edit_pengawas" data="'.$l->pengawas_id.'"><i class="fa fa-edit"></i><a href="javascript:;" class="btn btn-sm btn-circle  btn-danger   item_hapus_pengawas" data="'.$l->pengawas_id.'"><i class="fa fa-trash"></i></a>';
			$opsi .='</div>';

			$l->opsi = $opsi;
			if ($l->pengawas_logo!='') {
				$l->pengawas_logo='<img src="'.base_url().$l->pengawas_logo.'" style="width:50px">';
			}
			$data[] = $l;
		}
		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('pengawas',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('pengawas',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}


	public function tabel_testimoni(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'testimoni_id';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('testimoni',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-primary   item_edit_testimoni" data="'.$l->testimoni_id.'"><i class="fa fa-edit"></i><a href="javascript:;" class="btn btn-sm btn-circle  btn-danger   item_hapus_testimoni" data="'.$l->testimoni_id.'"><i class="fa fa-trash"></i></a>';
			$opsi .='</div>';

			$l->opsi = $opsi;
			if ($l->testimoni_foto!='') {
				$l->testimoni_foto='<img src="'.base_url().$l->testimoni_foto.'" style="width:50px">';
			}
			$data[] = $l;
		}
		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('testimoni',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('testimoni',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}

	public function hapus_testimoni()
	{
		$this->db->where('testimoni_id',$this->input->post('kode_hapus_testimoni'));
		$data_testimoni = $this->db->get('tbl_testimoni')->result();

		foreach ($data_testimoni as $key) {
			if ($key->testimoni_foto!='') {
				$path = './'.$key->testimoni_foto;
				if(file_exists($path)){
					unlink($path);
				}

			}
		}

		$this->db->where('testimoni_id',$this->input->post('kode_hapus_testimoni'));
		$result = $this->db->delete('tbl_testimoni');

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menghapus Data Testimoni",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Testimoni Berhasil Dihapus!';
			$data['icon'] = 'success';

		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Testimoni Gagal Dihapus!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/client','refresh');



	}

	public function hapus_pengawas()
	{
		$this->db->where('pengawas_id',$this->input->post('kode_hapus_pengawas'));
		$data_pengawas = $this->db->get('tbl_pengawas')->result();

		foreach ($data_pengawas as $key) {
			if ($key->pengawas_logo!='') {
				$path = './'.$key->pengawas_logo;
				if(file_exists($path)){
					unlink($path);
				}

			}
		}

		$this->db->where('pengawas_id',$this->input->post('kode_hapus_pengawas'));
		$result = $this->db->delete('tbl_pengawas');

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menghapus Data pengawas",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Pengawas Berhasil Dihapus!';
			$data['icon'] = 'success';

		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Pengawas Gagal Dihapus!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/pengawas','refresh');



	}




	public function hapus_feature()
	{
		$this->db->where('feature_id',$this->input->post('kode_hapus_feature'));
		$result = $this->db->delete('tbl_feature');

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menghapus Data Feature",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Feature Berhasil Dihapus!';
			$data['icon'] = 'success';

		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Feature Gagal Dihapus!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/feature','refresh');



	}



	public function hapus_clients()
	{
		$this->db->where('clients_id',$this->input->post('kode_hapus_clients'));
		$data_clients = $this->db->get('tbl_clients')->result();

		foreach ($data_clients as $key) {
			if ($key->clients_logo!='') {
				$path = './'.$key->clients_logo;
				if(file_exists($path)){
					unlink($path);
				}

			}
		}

		$this->db->where('clients_id',$this->input->post('kode_hapus_clients'));
		$result = $this->db->delete('tbl_clients');

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menghapus Data Clients",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Clients Berhasil Dihapus!';
			$data['icon'] = 'success';

		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Clients Gagal Dihapus!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/client','refresh');



	}
	public function index()
	{
		$data['profil'] = $this->db->get('tbl_profile')->num_rows();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('profile/tampilan_profile',$data);
		$this->load->view('templates/footer');
	}

	public function syarat()
	{
		$data['syarat'] = $this->db->get('syarat_ketentuan')->num_rows();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('profile/tampilan_syarat',$data);
		$this->load->view('templates/footer');
	}

	public function about_us()
	{
		$data['about_us'] = $this->db->get('tbl_about_us')->num_rows();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('profile/tampilan_about_us',$data);
		$this->load->view('templates/footer');
	}



	public function feature()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('profile/tampilan_fitur');
		$this->load->view('templates/footer');
	}


	public function client()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('profile/tampilan_client');
		$this->load->view('templates/footer');
	}

	public function pengawas()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('profile/tampilan_pengawas');
		$this->load->view('templates/footer');
	}


	public function simpan_syarat()
	{


		$data_syarat = array(
			'syarat' => $this->input->post('nama_syarat'),
		);

		$result= $this->db->insert('syarat_ketentuan', $data_syarat);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Syarat dan Ketentuan",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Syarat dan Ketentuan Berhasil Disimpan!';
			$data['icon'] = 'success';

		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Syarat dan Ketentuan Gagal Disimpan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/syarat','refresh');
	}

	public function ubah_feature()
	{


		$data_feature = array(
			'feature_judul' => $this->input->post('feature_judul'),
			'feature_icon' => $this->input->post('feature_icon'),
			'feature_isi' => $this->input->post('feature_isi'),
		);
		$this->db->where('feature_id',$this->input->post('feature_id'));
		$result= $this->db->update('tbl_feature', $data_feature);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Fitur",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Fitur Berhasil Diubah!';
			$data['icon'] = 'success';

		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Fitur Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/feature','refresh');
	}



	public function simpan_feature()
	{


		$data_feature = array(
			'feature_judul' => $this->input->post('feature_judul'),
			'feature_icon' => $this->input->post('feature_icon'),
			'feature_isi' => $this->input->post('feature_isi'),
		);

		$result= $this->db->insert('tbl_feature', $data_feature);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Fitur",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Fitur Berhasil Disimpan!';
			$data['icon'] = 'success';

		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Fitur Gagal Disimpan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/feature','refresh');
	}


	public function simpan_clients()
	{


		if (!is_dir('assets/img/foto_clients/')) {
			mkdir('assets/img/foto_clients/');
		}


		$logo = '';

		if($_FILES['lampiran_logo']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_logo']['name']);
			$location ='assets/img/foto_clients/galeri'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_logo']['tmp_name'], $location)) {
					$logo = $location;
				}
			}
		}
		
		$data_clients = array(
			'clients_nama' => $this->input->post('nama_clients'),
			'clients_logo' => $logo,
			'clients_status' => 1,
		);
		$result= $this->db->insert('tbl_clients', $data_clients);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Clients Baru",
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Clients Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Clients Gagal Ditambahkan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/client','refresh');

	}

	public function simpan_pengawas()
	{


		if (!is_dir('assets/img/foto_pengawas/')) {
			mkdir('assets/img/foto_pengawas/');
		}


		$logo = '';

		if($_FILES['lampiran_logo']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_logo']['name']);
			$location ='assets/img/foto_pengawas/galeri'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_logo']['tmp_name'], $location)) {
					$logo = $location;
				}
			}
		}
		
		$data_pengawas = array(
			'pengawas_nama' => $this->input->post('nama_pengawas'),
			'pengawas_logo' => $logo,
			'pengawas_status' => 1,
		);
		$result= $this->db->insert('tbl_pengawas', $data_pengawas);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data pengawas Baru",
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Pengawas Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Pengawas Gagal Ditambahkan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/pengawas','refresh');

	}





	public function ubah_clients()
	{


		if (!is_dir('assets/img/foto_clients/')) {
			mkdir('assets/img/foto_clients/');
		}


		$logo = $this->input->post('lampiran_logo_lama');

		if($_FILES['lampiran_logo']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_logo']['name']);
			$location ='assets/img/foto_clients/galeri'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_logo']['tmp_name'], $location)) {
					$logo = $location;
				}
			}
		}
		
		$data_clients = array(
			'clients_nama' => $this->input->post('nama_clients'),
			'clients_logo' => $logo,
		);
		$this->db->where('clients_id',$this->input->post('clients_id'));
		$result= $this->db->update('tbl_clients', $data_clients);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Clients",
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Clients Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Clients Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/client','refresh');

	}



	public function ubah_pengawas()
	{


		if (!is_dir('assets/img/foto_pengawas/')) {
			mkdir('assets/img/foto_pengawas/');
		}


		$logo = $this->input->post('lampiran_logo_lama');

		if($_FILES['lampiran_logo']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_logo']['name']);
			$location ='assets/img/foto_pengawas/galeri'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_logo']['tmp_name'], $location)) {
					$logo = $location;
				}
			}
		}
		
		$data_pengawas = array(
			'pengawas_nama' => $this->input->post('nama_pengawas'),
			'pengawas_logo' => $logo,
		);
		$this->db->where('pengawas_id',$this->input->post('pengawas_id'));
		$result= $this->db->update('tbl_pengawas', $data_pengawas);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data pengawas",
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'pengawas Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'pengawas Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/pengawas','refresh');

	}


	public function ubah_testimoni()
	{


		if (!is_dir('assets/img/foto_testimoni/')) {
			mkdir('assets/img/foto_testimoni/');
		}


		$foto = $this->input->post('lampiran_testimoni_lama');

		if($_FILES['lampiran_testimoni']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_testimoni']['name']);
			$location ='assets/img/foto_testimoni/galeri'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_testimoni']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}
		
		$data_testimoni = array(
			'testimoni_nama' => $this->input->post('testimoni_nama'),
			'testimoni_jabatan' => $this->input->post('testimoni_jabatan'),
			'testimoni_isi' => $this->input->post('testimoni_isi'),
			'testimoni_foto' => $foto,
		);
		$this->db->where('testimoni_id',$this->input->post('testimoni_id'));
		$result= $this->db->update('tbl_testimoni', $data_testimoni);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Testimoni",
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Testimoni Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Testimoni Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/testimoni','refresh');

	}

	public function ubah_syarat()
	{


		$data_syarat = array(
			'syarat' => $this->input->post('nama_syarat'),
		);
		$this->db->where('id_syarat',$this->input->post('id_syarat'));
		$result= $this->db->update('syarat_ketentuan', $data_syarat);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Syarat dan Ketentuan",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Syarat dan Ketentuan Berhasil Diubah!';
			$data['icon'] = 'success';

		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Syarat dan Ketentuan Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/syarat','refresh');
	}




	public function simpan()
	{

		if (!is_dir('assets/img/perusahaan/')) {
			mkdir('assets/img/perusahaan/');
		}

		$logo = '';

		if($_FILES['lampiran_logo']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_logo']['name']);
			$location ='assets/img/perusahaan/logo'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_logo']['tmp_name'], $location)) {
					$logo = $location;
				}
			}
		}
		$data_profile = array(
			'nama_website' => $this->input->post('nama_website'),
			'pemilik' => $this->input->post('pemilik'),
			'telp_profile' => $this->input->post('telp_profile'),
			'email_profile' => $this->input->post('email_profile'),
			'website' => $this->input->post('website_profile'),
			'facebook' => $this->input->post('facebook_profile'),
			'instagram' => $this->input->post('instagram_profile'),
			'youtube' => $this->input->post('youtube_profile'),
			'skype' => $this->input->post('skype_profile'),
			'twitter' => $this->input->post('twitter_profile'),
			'lat' => $this->input->post('latitude_profile'),
			'long' => $this->input->post('longitude_profile'),
			'map_profile' => $this->input->post('map_profile'),
			'sambutan' => $this->input->post('sambutan'),

			'alamat_profile' => $this->input->post('alamat_profile'),
			'logo_profile' => $logo,
		);
		$result= $this->db->insert('tbl_profile', $data_profile);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Profil Perusahaan",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Profil Perusahaan Berhasil Disimpan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Profil Perusahaan Gagal Disimpan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile','refresh');
	}



	public function simpan_about()
	{

		if (!is_dir('assets/img/about/')) {
			mkdir('assets/img/about/');
		}

		$foto = '';

		if($_FILES['lampiran_foto']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_foto']['name']);
			$location ='assets/img/about/foto_about'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_foto']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}

		$data_about = array(
			'about_isi' => $this->input->post('about_us_isi'),
			'about_foto' => $foto,
		);
		$result= $this->db->insert('tbl_about_us', $data_about);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data About Us",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data About Us Berhasil Disimpan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data About Us Gagal Disimpan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile/about_us','refresh');
	}

	public function ubah_about()
	{

		if (!is_dir('assets/img/about/')) {
			mkdir('assets/img/about/');
		}
		$foto =$this->input->post('lampiran_foto_lama');
		if($_FILES['lampiran_foto']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_foto']['name']);
			$location ='assets/img/about/foto_about'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_foto']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}
		$data_about = array(
			'about_isi' =>  $this->input->post('about_us_isi'),
			'about_foto' => $foto,
		);


		$this->db->where('about_id',$this->input->post('about_id'));
		$result= $this->db->update('tbl_about_us', $data_about);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data About Us",
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data About Us Berhasil Diubah!';
			$data['icon'] = 'success';
		}else{
			$data['title'] = 'Gagal';
			$data['text'] = 'Data About Us Gagal Diubah!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('profile/about_us','refresh');
	}

	public function ubah()
	{
		if (!is_dir('assets/img/perusahaan/')) {
			mkdir('assets/img/perusahaan/');
		}

		$logo = $this->input->post('lampiran_logo_lama');

		if($_FILES['lampiran_logo']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_logo']['name']);
			$location ='assets/img/perusahaan/logo'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_logo']['tmp_name'], $location)) {
					$logo = $location;
				}
			}
		}
		$data_profile = array(
			'nama_website' => $this->input->post('nama_website'),
			'pemilik' => $this->input->post('pemilik'),
			'telp_profile' => $this->input->post('telp_profile'),
			'email_profile' => $this->input->post('email_profile'),
			'website' => $this->input->post('website_profile'),
			'facebook' => $this->input->post('facebook_profile'),
			'instagram' => $this->input->post('instagram_profile'),
			'youtube' => $this->input->post('youtube_profile'),
			'skype' => $this->input->post('skype_profile'),
			'twitter' => $this->input->post('twitter_profile'),
			'lat' => $this->input->post('latitude_profile'),
			'long' => $this->input->post('longitude_profile'),
			'map_profile' => $this->input->post('map_profile'),
			'sambutan' => $this->input->post('sambutan'),
			'alamat_profile' => $this->input->post('alamat_profile'),
			'logo_profile' => $logo,
		);
		$this->db->where('id_profile',$this->input->post('id_profile'));
		$result= $this->db->update('tbl_profile', $data_profile);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Profil Perusahaan",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Profil Perusahaan Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Profil Perusahaan Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('profile','refresh');

	}


	function upload_image(){
		if(isset($_FILES["image"]["name"])){
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('image')){
				$this->upload->display_errors();
				return FALSE;
			}else{
				$data = $this->upload->data();
            //Compress Image
				$config['image_library']='gd2';
				$config['source_image']='./assets/img/'.$data['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= TRUE;
				$config['quality']= '60%';
				$config['width']= 800;
				$config['height']= 800;
				$config['new_image']= './assets/img/'.$data['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				echo base_url().'assets/img/'.$data['file_name'];
			}
		}
	}

	function delete_image(){
		$src = $this->input->post('src');
		$file_name = str_replace(base_url(), '', $src);
		if(unlink($file_name)){
			echo 'File Delete Successfully';
		}
	}


	
	
}