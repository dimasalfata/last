<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjungan extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->login==FALSE) {

			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">Anda Belum Login!!! <button type="button" class="close" data-dismiss="alert" arial-label="close"><span arial-hidden="true">&times;</span></button></div>');

			redirect('dashboard','refresh');
		}
		date_default_timezone_set('Asia/Jakarta');	
	}

	public function detail_kunjungan()
	{
		$this->db->where('id_kunjungan',$this->input->get('id_kunjungan'));
		$data = $this->db->get('tbl_kunjungan_nasabah')->result();
		echo json_encode($data);
	}

	public function detail_kunjungan_full()
	{
		$this->db->select('a.*,b.nama_wilayah as prov,c.nama_wilayah as kab,d.nama_wilayah as kec,e.nama_wilayah as kel');
		$this->db->where('a.id_kunjungan',$this->input->get('id_kunjungan'));
		$this->db->join('tbl_master_wilayah b','b.kode_wilayah=a.provinsi_kunjungan');
		$this->db->join('tbl_master_wilayah c','c.kode_wilayah=a.kabupaten_kunjungan');
		$this->db->join('tbl_master_wilayah d','d.kode_wilayah=a.kecamatan_kunjungan');
		$this->db->join('tbl_master_wilayah e','e.id_wilayah=a.kelurahan_kunjungan');
		$data['nasabah'] = $this->db->get('tbl_kunjungan_nasabah a')->result();


		$this->db->select('a.*,b.nama, user_approval.nama as approval_by');
		$this->db->where('a.id_kunjungan',$this->input->get('id_kunjungan'));
		$this->db->where_in('a.approval', ['disetujui', 'pending']);


		$this->db->join('tbl_master_user b','b.id_user=a.id_user');
		$this->db->join('tbl_master_user as user_approval','user_approval.id_user=a.approval_user', 'left');
		$data['follow_up'] = $this->db->get('tbl_follow_up_kunjungan a')->result();

		echo json_encode($data);
	}
	public function cek_rekening()
	{
		$this->db->where('no_rekening',$this->input->get('no_rekening'));
		$data = $this->db->get('tbl_kunjungan_nasabah')->num_rows();
		echo json_encode($data);
	}
	public function tabel_kunjungan_nasabah(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'id_kunjungan';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

	$list = $this->model_tabel->get_datatables('kunjungan_nasabah',$sort,$order,$search);

	foreach ($list as $l) {
		$no++;
		$l->no = $no;

		$l->tanggal = $l->tanggal_kunjungan ?? $l->tgl_input;

		$l->tanggal = date_format(date_create($l->tanggal),'d-m-Y H:i:s');
		
		$l->marketing = $l->marketing_fu ?? $l->marketing;

		$opsi ='
		<div class="btn-group">
		<a href="javascript:;" class="btn btn-sm btn-circle  btn-success  item_detail_kunjungan" data="'.$l->id_kunjungan.'"><i class="fa fa-eye"></i></a>';
		if ($l->id_cabang==$this->session->cabang) {
			$opsi.='<a href="javascript:;" class="btn btn-sm btn-circle  btn-primary  item_edit_kunjungan" data="'.$l->id_kunjungan.'"><i class="fa fa-edit"></i></a>';
		}

		if ($this->session->level=="Marketing" || $this->session->level=="Supervisor" || $this->session->level=="PIC") {
			$opsi.='<a href="javascript:;" class="btn btn-sm btn-circle  btn-info  item_follow_up" data="'.$l->id_kunjungan.'"><i class="fa fa-bullhorn" aria-hidden="true"></i>
			</a>';
		}

		$opsi .='</div>';
		$l->opsi = $opsi;
		$l->tgl_input = date_format(date_create($l->tgl_input),'d-m-Y H:i:s');
		$l->tgl_realisasi = date_format(date_create($l->tgl_realisasi),'d-m-Y');
		$l->plafon = $l->plafon;
		$data[] = $l;

	}
	$output = array(
		"draw"              => $_GET['draw'],
		"recordsTotal"      => $this->model_tabel->count_all('kunjungan_nasabah',$sort,$order,$search),
		"recordsFiltered"   => $this->model_tabel->count_filtered('kunjungan_nasabah',$sort,$order,$search),
		"data"              => $data,
	);  
	echo json_encode($output); 	
	}
		
		public function index()
		{
			$this->db->where('level',1);
			$data['provinsi'] = $this->db->get('tbl_master_wilayah')->result();
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('kunjungan_nasabah/tampilan_kunjungan_nasabah',$data);
			$this->load->view('templates/footer');
		}
	
	
	
		public function simpan_fu()
		{
			if (!is_dir('assets/img/foto_fu_kunjungan/')) {
				mkdir('assets/img/foto_fu_kunjungan/');
			}
	
			$foto = '';
	
			if($_FILES['lampiran_follow_up']['name'] != '')
			{
				$filename = trim($_FILES['lampiran_follow_up']['name']);
				$location ='assets/img/foto_fu_kunjungan/fu_'.time().$filename;
				$file_extension = pathinfo($location, PATHINFO_EXTENSION);
				$file_extension = strtolower($file_extension);
				$image_ext = array("jpg", "png", "jpeg", "gif");
				if (in_array($file_extension, $image_ext)) {
					$lampiran = $_FILES['lampiran_follow_up']['tmp_name'];
						$kompres_gambar = mulai_kompress($lampiran,$location);
						if ($kompres_gambar) {
							$foto = $location;
						}
				}
			}
	
			$approval = "disetujui";
			$approval_user = $this->session->id_user;
			if($this->session->level === "Marketing") {
				$approval = "pending";
				$approval_user = null;
			}
	
			$data_fu = array(
				'id_user' =>$this->session->id_user,
				'id_kunjungan' =>$this->input->post('id_kunjungan_follow_up'), 
				'hasil_kunjungan' =>$this->input->post('hasil_follow_up'), 
				'status_fu' =>$this->input->post('status_kolektibilitas_fu'), 
				'tanggal_kunjungan' =>date('Y-m-d H:i:s'), 
				'lampiran_kunjungan' =>$foto, 
				'latitude_kunjungan' =>$this->input->post('latitude_gps'), 
				'longitude_kunjungan' =>$this->input->post('longitude_gps'),
				'approval' => $approval,
				'approval_user' => $approval_user,
		);
		$result= $this->db->insert('tbl_follow_up_kunjungan', $data_fu);
		if ($result) {

			if($this->session->level !== "Marketing") {
				$this->db->where('id_kunjungan',$this->input->post('id_kunjungan_follow_up'));
				$this->db->update('tbl_kunjungan_nasabah', array('status_kolektibilitas' =>$this->input->post('status_kolektibilitas_fu')));
			}

			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>$this->input->ip_address(),
				'aktivitas' => "Menambah Data Follow UP Kunjungan Nasabah Baru dengan ID Kunjungan ".$this->input->post('id_kunjungan_follow_up'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Follow UP Berhasil Ditambahkan!';
			$data['icon'] = 'success';
		}else{
			$data['title'] = 'Gagal';
			$data['text'] = 'Data Follow UP Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('kunjungan','refresh');



	}


	public function get_kab()
	{
		$kode_wilayah = $this->input->get('kode_wilayah');
		$this->db->where('level',2);
		$this->db->where('sub_wilayah',$kode_wilayah);
		$data = $this->db->get('tbl_master_wilayah')->result();
		echo json_encode($data);
	}
	public function get_kec()
	{
		$kode_wilayah = $this->input->get('kode_wilayah');
		$this->db->where('level',3);
		$this->db->where('sub_wilayah',$kode_wilayah);
		$data = $this->db->get('tbl_master_wilayah')->result();
		echo json_encode($data);
	}
	public function get_kel()
	{
		$kode_wilayah = $this->input->get('kode_wilayah');
		$this->db->where('level',4);
		$this->db->where('sub_wilayah',$kode_wilayah);
		$data = $this->db->get('tbl_master_wilayah')->result();
		echo json_encode($data);
	}

	public function simpan()
	{
		$data_nasabah = array(
			'id_cabang' => $this->session->cabang,
			'id_user' => $this->session->id_user,
			'nama_nasabah' => $this->input->post('nama_nasabah'),
			'no_rekening' => $this->input->post('no_rekening'),
			'provinsi_kunjungan' => $this->input->post('prov_nasabah'),
			'kabupaten_kunjungan' => $this->input->post('kab_nasabah'),
			'kecamatan_kunjungan' => $this->input->post('kec_nasabah'),
			'kelurahan_kunjungan' => $this->input->post('kel_nasabah'),
			'alamat_nasabah' => $this->input->post('alamat_nasabah'),
			'plafon' => str_replace('.', '',$this->input->post('plafon')),
			'tgl_realisasi' => $this->input->post('tgl_realisasi'),
			'tgl_input' => date('Y-m-d H:i:s'),
			'status_kolektibilitas' => $this->input->post('status_kolektibilitas'),
		);
		$result= $this->db->insert('tbl_kunjungan_nasabah', $data_nasabah);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>$this->input->ip_address(),
				'aktivitas' => "Menambah Data Kunjungan Baru dengan nama ".$this->input->post('nama_nasabah'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Kunjungan Berhasil Ditambahkan!';
			$data['icon'] = 'success';
		}else{
			$data['title'] = 'Gagal';
			$data['text'] = 'Data Kunjungan Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('kunjungan','refresh');
	}

	public function ubah()
	{
		$data_nasabah = array(
			'id_cabang' => $this->session->cabang,
			'id_user' => $this->session->id_user,
			'nama_nasabah' => $this->input->post('nama_nasabah'),
			'no_rekening' => $this->input->post('no_rekening'),
			'provinsi_kunjungan' => $this->input->post('prov_nasabah'),
			'kabupaten_kunjungan' => $this->input->post('kab_nasabah'),
			'kecamatan_kunjungan' => $this->input->post('kec_nasabah'),
			'kelurahan_kunjungan' => $this->input->post('kel_nasabah'),
			'alamat_nasabah' => $this->input->post('alamat_nasabah'),
			'plafon' => str_replace('.', '',$this->input->post('plafon')),
			'tgl_realisasi' => $this->input->post('tgl_realisasi'),
			'tgl_input' => date('Y-m-d H:i:s'),
			'status_kolektibilitas' => $this->input->post('status_kolektibilitas'),
		);
		$this->db->where('id_kunjungan',$this->input->post('id_kunjungan'));
		$result= $this->db->update('tbl_kunjungan_nasabah', $data_nasabah);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>$this->input->ip_address(),
				'aktivitas' => "Mengubah Data Kunjungan dengan nama ".$this->input->post('nama_nasabah'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Kunjungan Berhasil Diubah!';
			$data['icon'] = 'success';
		}else{
			$data['title'] = 'Gagal';
			$data['text'] = 'Data Kunjungan Gagal Diubah!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('kunjungan','refresh');
	}
}
//ok ini mas