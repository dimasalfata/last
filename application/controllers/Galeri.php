<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller {
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

	public function detail_galeri()
	{
		$this->db->where('id_galeri',$this->input->get('id_galeri'));
		$data = $this->db->get('tbl_galeri_foto')->result();
		echo json_encode($data);
	}

	public function tabel_galeri(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'id_galeri';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('galeri',$sort,$order,$search);
		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_galeri" data="'.$l->id_galeri.'"><i class="fa fa-edit"></i></a>';
			$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_hapus_galeri" data="'.$l->id_galeri.'"><i class="fa fa-trash"></i></a>';
			$opsi .='</div>';
			$l->opsi = $opsi;

			if ($l->gambar_foto!='') {
				$l->gambar_foto ='<img src="'.base_url().$l->gambar_foto.'" style="max-width:150px">';
			}
			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('galeri',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('galeri',$sort,$order,$search),
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
		$this->load->view('galeri/tampilan_galeri',$data);
		$this->load->view('templates/footer');
	}

	public function slider()
	{
		$this->db->where('status_kategori',1);
		$data['kategori'] = $this->db->get('tbl_kategori_produk')->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('galeri/tampilan_galeri',$data);
		$this->load->view('templates/footer');
	}


	public function hapus()
	{

		$this->db->where('id_galeri',$this->input->post('kode_galeri_hapus'));
		$data_galeri = $this->db->get('tbl_galeri_foto')->result();
		foreach ($data_galeri as $key) {
			if ($key->gambar_foto!='') {
				$path = './'.$key->gambar_foto;
				if(file_exists($path)){
					unlink($path);
				}

			}
		}

		$this->db->where('id_galeri',$this->input->post('kode_galeri_hapus'));
		$result = $this->db->delete('tbl_galeri_foto');
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menghapus Data Galeri Baru dengan id ".$this->input->post('kode_galeri_hapus'),
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Galeri Berhasil Dihapus!';
			$data['icon'] = 'success';
		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Galeri Gagal Dihapus!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('galeri','refresh');

	}


	public function simpan()
	{


		if (!is_dir('assets/img/foto_galeri/')) {
			mkdir('assets/img/foto_galeri/');
		}




		$foto = '';

		if($_FILES['lampiran_foto']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_foto']['name']);
			$location ='assets/img/foto_galeri/galeri'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_foto']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}
		
		$data_galeri = array(
			'judul_foto' => $this->input->post('judul_foto'),
			'deskripsi_foto' => $this->input->post('deskripsi_foto'),
			'id_kategori' => $this->input->post('kategori_foto'),
			'gambar_foto' => $foto,

		);
		$result= $this->db->insert('tbl_galeri_foto', $data_galeri);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Galeri Baru dengan nama ".$this->input->post('judul_foto'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Galeri Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Galeri Gagal Ditambahkan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('galeri','refresh');

	}

	public function ubah()
	{


		if (!is_dir('assets/img/foto_galeri/')) {
			mkdir('assets/img/foto_galeri/');
		}


		$foto = $this->input->post('lampiran_foto_lama');

		if($_FILES['lampiran_foto']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_foto']['name']);
			$location ='assets/img/foto_galeri/galeri'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_foto']['tmp_name'], $location)) {
					$foto = $location;
					$path = './'.$this->input->post('lampiran_foto_lama');
					if(file_exists($path)){
						unlink($path);
					}
				}
			}
		}
		
		$data_galeri = array(
			'judul_foto' => $this->input->post('judul_foto'),
			'deskripsi_foto' => $this->input->post('deskripsi_foto'),
			'id_kategori' => $this->input->post('kategori_foto'),
			'gambar_foto' => $foto,

		);
		$this->db->where('id_galeri',$this->input->post('id_galeri'));
		$result= $this->db->update('tbl_galeri_foto', $data_galeri);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Galeri dengan id ".$this->input->post('id_galeri'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Galeri Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Galeri Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('galeri','refresh');

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