<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
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

	public function detail_user()
	{
		$this->db->where('id_user',$this->input->get('id_user'));
		$data = $this->db->get('tbl_master_user')->result();
		echo json_encode($data);
	}

	public function tabel_user(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('user',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_user" data="'.$l->id_user.'"><i class="fa fa-edit"></i></a>
			<a href="javascript:;" class="btn btn-sm btn-circle btn-primary  item_edit_password" data="'.$l->id_user.'"><i class="fa fa-key"></i></a>';


			if ($l->status_user == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_user" data="'.$l->id_user.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_user" data="'.$l->id_user.'"><i class="fa fa-check-circle"></i></a>';
			}

			if ($l->level == "Marketing") {
				if ($l->terbaik == 1) {
					$opsi .='<a href="javascript:;" class="btn btn-warning btn-sm btn-circle  item_terbaik_user" data="'.$l->id_user.'"><i class="fa fa-trophy"></i></a>';
				}else{
					$opsi .='<a href="javascript:;" class="btn btn-secondary btn-sm btn-circle  item_terbaik_user" data="'.$l->id_user.'"><i class="fa fa-trophy"></i></a>';
				}
			}



			$opsi .='</div>';

			$l->opsi = $opsi;


			if ($l->status_user==1) {
				$l->status_user = "Aktif";
			}else{
				$l->status_user = "Non Aktif";
			}

			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('user',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('user',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}




	public function index()
	{
		$data['cabang'] = $this->db->get('tbl_master_cabang')->result();
		$data['jabatan'] = $this->db->get('tbl_master_jabatan')->result();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('user/tampilan_user',$data);
		$this->load->view('templates/footer');
	}

	

	public function aktivasi_user()
	{

		$this->db->set('status_user',$this->input->post('isi'));
		$this->db->where('id_user',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_user');
		echo json_encode($data);

	}

	public function terbaik()
	{

		$this->db->set('terbaik',$this->input->post('isi_terbaik'));
		$this->db->where('id_user',$this->input->post('kode_user_terbaik'));
		$result = $this->db->update('tbl_master_user');
		
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Status Terbaik ".$this->input->post('kode_user_terbaik'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Status Terbaik Berhasil di Ubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Status Terbaik Gagal di Ubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('user','refresh');
	}


	public function simpan()
	{


		if (!is_dir('assets/img/foto_user/')) {
			mkdir('assets/img/foto_user/');
		}




		$foto = 'assets/img/foto_user/user.png';

		if($_FILES['lampiran_user']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_user']['name']);
			$location ='assets/img/foto_user/logo'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_user']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}

		$data_user = array(
			'nama' => $this->input->post('nama_lengkap'),
			'level' => $this->input->post('level'),
			'email' => $this->input->post('email'),
			'id_cabang' => $this->input->post('cabang'),
			'id_jabatan' => $this->input->post('jabatan'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'foto' => $foto,
			'status_user' =>1,
			'date_created'=> date('Y-m-d H:i:s'),
		);
		$result= $this->db->insert('tbl_master_user', $data_user);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data user Baru atas nama ".$this->input->post('nama_lengkap'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'User Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'User Gagal Ditambahkan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('user','refresh');

	}


	public function cek_username()
	{
		$this->db->where('username',$this->input->get('username'));
		$data = $this->db->get('tbl_master_user')->num_rows();
		echo json_encode($data);
	}

	
	public function ubah()
	{


		if (!is_dir('assets/img/foto_user/')) {
			mkdir('assets/img/foto_user/');
		}


		$foto = $this->input->post('lampiran_user_lama');

		if($_FILES['lampiran_user']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_user']['name']);
			$location ='assets/img/foto_user/logo'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_user']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}

		$data_user = array(
			'nama' => $this->input->post('nama_lengkap'),
			'level' => $this->input->post('level'),
			'email' => $this->input->post('email'),
			'id_cabang' => $this->input->post('cabang'),
			'id_jabatan' => $this->input->post('jabatan'),
			'username' => $this->input->post('username'),
			'foto' => $foto,
			'status_user' =>1,
		);
		$this->db->where('id_user',$this->input->post('id_user'));
		$result= $this->db->update('tbl_master_user', $data_user);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data user dengan id_user".$this->input->post('id_user'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'User Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'User Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('user','refresh');

	}


	public function cek_email()
	{
		$this->db->where('email',$this->input->get('email'));
		$data = $this->db->get('user')->num_rows();
		echo json_encode($data);
	}



	public function reset_password()
	{
		$data_user = array(
			'password' 			=> md5('12345678'),

		);

		$this->db->where('id_user',$this->input->post('id_user_password'));
		$result= $this->db->update('tbl_master_user', $data_user);
		if ($result) {

			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mereset Password user dengan id_user".$this->input->post('id_user_password'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Password Berhasil Diubah';
			$data['icon'] = 'success';
			
		}	else{
			$data['title'] = 'Error';
			$data['text'] = 'Password Gagal Diubah';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data); 
		redirect('user','refresh');
	}

	
}