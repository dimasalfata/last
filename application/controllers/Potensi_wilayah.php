<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Potensi_wilayah extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->login==FALSE) {

			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">Anda Belum Login!!! <button type="button" class="close" data-dismiss="alert" arial-label="close"><span arial-hidden="true">&times;</span></button></div>');

			redirect('dashboard','refresh');
		}
		date_default_timezone_set('Asia/Jakarta');	
	}

	public function detail_potensi_wilayah()
	{
		$this->db->where('id_nasabah',$this->input->get('id_nasabah'));
		$data = $this->db->get('tbl_nasabah')->result();
		echo json_encode($data);
	}

	public function detail_potensi_wilayah_full()
	{	$this->db->select('a.*,b.nama_wilayah as prov,c.nama_wilayah as kab,d.nama_wilayah as kec,e.nama_wilayah as kel');
	$this->db->where('a.id_nasabah',$this->input->get('id_nasabah'));
	$this->db->join('tbl_master_wilayah b','b.kode_wilayah=a.provinsi_nasabah');
	$this->db->join('tbl_master_wilayah c','c.kode_wilayah=a.kabupaten_nasabah');
	$this->db->join('tbl_master_wilayah d','d.kode_wilayah=a.kecamatan_nasabah');
	$this->db->join('tbl_master_wilayah e','e.id_wilayah=a.kelurahan_nasabah');
	$data['nasabah'] = $this->db->get('tbl_nasabah a')->result();

	$this->db->select('a.*,b.nama, user_approval.nama as approval_by');
	$this->db->where('a.id_nasabah',$this->input->get('id_nasabah'));
	//$this->db->where_in('a.approval', ['disetujui', 'pending']);
	$this->db->join('tbl_master_user b','b.id_user=a.id_user');
	$this->db->join('tbl_master_user as user_approval','user_approval.id_user=a.approval_user', 'left');
	$data['follow_up'] = $this->db->get('tbl_follow_up a')->result();

	echo json_encode($data);
}

public function cek_telepon()
{
	$this->db->where('telp_nasabah',$this->input->get('telp_nasabah'));
	$data = $this->db->get('tbl_nasabah')->num_rows();
	echo json_encode($data);
}
public function tabel_potensi_wilayah(){
	$data   = array();
	$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'id_nasabah';
	$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';
	$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
	$no = $this->input->get('start');

	$list = $this->model_tabel->get_datatables('potensi_wilayah',$sort,$order,$search);

	foreach ($list as $l) {
		$no++;
		$l->no = $no;
		$l->tanggal = $l->tanggal_fu ?? $l->tanggal_input;
		$l->tanggal = date_format(date_create($l->tanggal),'d-m-Y H:i:s');
		$l->marketing = !empty($l->marketing_fu) ? $l->marketing_fu : $l->marketing;
		$opsi ='
		<div class="btn-group">
		<a href="javascript:;" class="btn btn-sm btn-circle  btn-success  item_detail_potensi_wilayah" data="'.$l->id_nasabah.'"><i class="fa fa-eye"></i></a>';
		if ($l->id_user==$this->session->id_user) {
			if ($l->status_nasabah!='Realisasi') {
				$opsi.='<a href="javascript:;" class="btn btn-sm btn-circle  btn-primary  item_edit_potensi_wilayah" data="'.$l->id_nasabah.'"><i class="fa fa-edit"></i></a>';
			}
			
		}
		if ($this->session->level=="Marketing" || $this->session->level=="Supervisor") {
			if ($l->status_nasabah!='Realisasi') {
				
				$opsi.='<a href="javascript:;" class="btn btn-sm btn-circle  btn-info  item_follow_up" data="'.$l->id_nasabah.'"><i class="fa fa-bullhorn" aria-hidden="true"></i>
				</a>';

			}
			if ($l->status_nasabah=="Follow UP") {
				$opsi.='<a href="javascript:;" class="btn btn-sm btn-circle  btn-warning  item_realisasi_nasabah" data="'.$l->id_nasabah.'"><i class="fa fa-trophy" aria-hidden="true"></i>
				</i>
				</a>';
			}
		}


		$opsi .='</div>';
		$l->opsi = $opsi;

		$l->tanggal_input = date_format(date_create($l->tanggal_input),'d-m-Y H:i:s');

		$l->omset_nasabah = number_format($l->omset_nasabah,0,",","."); 
		$data[] = $l;

	}
	$output = array(
		"draw"              => $_GET['draw'],
		"recordsTotal"      => $this->model_tabel->count_all('potensi_wilayah',$sort,$order,$search),
		"recordsFiltered"   => $this->model_tabel->count_filtered('potensi_wilayah',$sort,$order,$search),
		"data"              => $data,
	);  
	echo json_encode($output); 
}


public function tabel_potensi_wilayah_realisasi(){
	$data   = array();
	$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'id_nasabah';
	$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';
	$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
	$no = $this->input->get('start');

	$list = $this->model_tabel->get_datatables('potensi_wilayah_realisasi',$sort,$order,$search);

	foreach ($list as $l) {
		$no++;
		$l->no = $no;

		$l->tanggal = $l->tanggal_fu ?? $l->tanggal_input;
		$l->tanggal = date_format(date_create($l->tanggal),'d-m-Y H:i:s');

		$l->marketing = !empty($l->marketing_fu) ? $l->marketing_fu : $l->marketing;

		$opsi ='
		<div class="btn-group">
		<a href="javascript:;" class="btn btn-sm btn-circle  btn-success  item_detail_potensi_wilayah" data="'.$l->id_nasabah.'"><i class="fa fa-eye"></i></a>';

		$opsi .='</div>';
		$l->opsi = $opsi;

		$l->tanggal_input = date_format(date_create($l->tanggal_input),'d-m-Y H:i:s');

		$l->omset_nasabah = number_format($l->omset_nasabah,0,",","."); 
		$data[] = $l;

	}
	$output = array(
		"draw"              => $_GET['draw'],
		"recordsTotal"      => $this->model_tabel->count_all('potensi_wilayah_realisasi',$sort,$order,$search),
		"recordsFiltered"   => $this->model_tabel->count_filtered('potensi_wilayah_realisasi',$sort,$order,$search),
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
	$this->load->view('potensi_wilayah/tampilan_potensi_wilayah',$data);
	$this->load->view('templates/footer');
}



public function realisasi()
{
	$checkStatusRealisasi = $this->db->get_where('tbl_follow_up', [
		'id_nasabah' => $this->input->post('id_nasabah_realisasi'),
		'approval' => 'pending',
		'status' => 'Realisasi',
	])->row();

	if(!$checkStatusRealisasi) {

		$data_fu = array(
			'id_user' =>$this->session->id_user,
			'id_nasabah' =>$this->input->post('id_nasabah_realisasi'), 
			'hasil_fu' =>$this->input->post('no_ref'), 
			//'tanggal_fu' =>date('Y-m-d H:i:s'),
			'tanggal_fu' =>date('Y-m-d H:i:s'),
			'approval' => 'pending',
			'status' => 'Realisasi', 
		);

		$result= $this->db->insert('tbl_follow_up', $data_fu);

		
		$data_history = array(
			'id_user' => $this->session->id_user, 
			'ip_address'=>$this->input->ip_address(),
			'aktivitas' => "Menunggu Approval Realisasi Nasabah ".$this->input->post('id_nasabah_realisasi'),
		);
		$this->db->insert('tbl_history', $data_history);
		$data['title'] = 'Data Realisasi Berhasil Disimpan!';
		$data['text'] = 'Data Realisasi menunggu approval oleh PIC / Admin';
		$data['icon'] = 'success';
	} else {

		$data['title'] = 'Data Realisasi sudah pernah diajukan!';
		$data['text'] = 'Harap tunggu approval dari PIC / Admin';
		$data['icon'] = 'warning';
	}

	$this->session->set_flashdata($data);
	redirect('potensi_wilayah','refresh');
	
}


public function simpan_fu()
{
	if (!is_dir('assets/img/foto_fu_potensi/')) {
		mkdir('assets/img/foto_fu_potensi/');
	}

	$foto = '';

	if($_FILES['lampiran_follow_up']['name'] != '')
	{
		$filename = trim($_FILES['lampiran_follow_up']['name']);
		$location ='assets/img/foto_fu_potensi/fu_'.time().$filename;
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
		'id_nasabah' =>$this->input->post('id_nasabah_follow_up'), 
		'hasil_fu' =>$this->input->post('hasil_follow_up'), 
		'tanggal_fu' =>date('Y-m-d H:i:s'), 
		'lampiran_fu' =>$foto,
		'approval' => $approval,
		'approval_user' => $approval_user,
 
	);

	$result= $this->db->insert('tbl_follow_up', $data_fu);
	if ($result) {
		if($this->session->level !== "Marketing") {
			$this->db->where('id_nasabah',$this->input->post('id_nasabah_follow_up'));
			$this->db->update('tbl_nasabah', array('status_nasabah' =>'Follow UP'));
		}

		$data_history = array(
			'id_user' => $this->session->id_user, 
			'ip_address'=>$this->input->ip_address(),
			'aktivitas' => "Menambah Data Follow UP Potensi Wilayah Baru dengan ID Nasabah ".$this->input->post('id_nasabah_follow_up'),
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
	redirect('potensi_wilayah','refresh');

}


public function aktivasi_cabang()
{

	$this->db->set('status_cabang',$this->input->post('isi'));
	$this->db->where('id_cabang',$this->input->post('kode'));
	$data = $this->db->update('tbl_master_cabang');
	echo json_encode($data);

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

	if (!is_dir('assets/img/foto_potensi/')) {
		mkdir('assets/img/foto_potensi/');
	}

	$foto = '';

	if($_FILES['lampiran_usaha']['name'] != '')
	{
		$filename = trim($_FILES['lampiran_usaha']['name']);
		$location ='assets/img/foto_potensi/usaha_'.time().$filename;
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);
		$file_extension = strtolower($file_extension);
		$image_ext = array("jpg", "png", "jpeg", "gif");
		if (in_array($file_extension, $image_ext)) {
			$lampiran = $_FILES['lampiran_usaha']['tmp_name'];
				$kompres_gambar = mulai_kompress($lampiran,$location);
				if ($kompres_gambar) {
					$foto = $location;
				}

		}
	}


	$data_nasabah = array(
		'id_cabang' => $this->session->cabang,
		'id_user' => $this->session->id_user,
		'nama_nasabah' => $this->input->post('nama_nasabah'),
		'telp_nasabah' => $this->input->post('telp_nasabah'),
		'provinsi_nasabah' => $this->input->post('prov_nasabah'),
		'kabupaten_nasabah' => $this->input->post('kab_nasabah'),
		'kecamatan_nasabah' => $this->input->post('kec_nasabah'),
		'kelurahan_nasabah' => $this->input->post('kel_nasabah'),
		'usaha_nasabah' => $this->input->post('usaha_nasabah'),
		'omset_nasabah' => str_replace('.','',$this->input->post('omset_nasabah')),
		'alamat_nasabah' => $this->input->post('alamat_nasabah'),
		'latitude' => $this->input->post('latitude_gps'),
		'longitude' => $this->input->post('longitude_gps'),
		'tanggal_input' => date('Y-m-d H:i:s'),
		'foto_usaha' => $foto,
		'status_nasabah' =>'Nasabah Baru',
	);
	$result= $this->db->insert('tbl_nasabah', $data_nasabah);
	if ($result) {
		$data_history = array(
			'id_user' => $this->session->id_user, 
			'ip_address'=>$this->input->ip_address(),
			'aktivitas' => "Menambah Data Potensi Wilayah Baru dengan nama ".$this->input->post('nama_nasabah'),
		);
		$this->db->insert('tbl_history', $data_history);
		$data['title'] = 'Berhasil';
		$data['text'] = 'Data Potensi Wilayah Berhasil Ditambahkan!';
		$data['icon'] = 'success';
	}else{
		$data['title'] = 'Gagal';
		$data['text'] = 'Data Potensi Wilayah Gagal Ditambahkan!';
		$data['icon'] = 'error';
	}	
	$this->session->set_flashdata($data);
	redirect('potensi_wilayah','refresh');

}

public function ubah()
{

	if (!is_dir('assets/img/foto_potensi/')) {
		mkdir('assets/img/foto_potensi/');
	}

	$foto = $this->input->post('lampiran_usaha_lama');

	if($_FILES['lampiran_usaha']['name'] != '')
	{
		$filename = trim($_FILES['lampiran_usaha']['name']);
		$location ='assets/img/foto_potensi/usaha_'.time().$filename;
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);
		$file_extension = strtolower($file_extension);
		$image_ext = array("jpg", "png", "jpeg", "gif");
		if (in_array($file_extension, $image_ext)) {
			
			$lampiran = $_FILES['lampiran_usaha']['tmp_name'];
				$kompres_gambar = mulai_kompress($lampiran,$location);
				if ($kompres_gambar) {
					$foto = $location;
				}

		}
	}

	$data_nasabah = array(
		'nama_nasabah' => $this->input->post('nama_nasabah'),
		'telp_nasabah' => $this->input->post('telp_nasabah'),
		'provinsi_nasabah' => $this->input->post('prov_nasabah'),
		'kabupaten_nasabah' => $this->input->post('kab_nasabah'),
		'kecamatan_nasabah' => $this->input->post('kec_nasabah'),
		'kelurahan_nasabah' => $this->input->post('kel_nasabah'),
		'usaha_nasabah' => $this->input->post('usaha_nasabah'),
		'omset_nasabah' => str_replace('.','',$this->input->post('omset_nasabah')),
		'alamat_nasabah' => $this->input->post('alamat_nasabah'),
		'foto_usaha' => $foto,
	);
	$this->db->where('id_nasabah',$this->input->post('id_nasabah'));
	$result= $this->db->update('tbl_nasabah', $data_nasabah);
	if ($result) {
		$data_history = array(
			'id_user' => $this->session->id_user, 
			'ip_address'=>$this->input->ip_address(),
			'aktivitas' => "Mengubah Data Potensi Wilayah Baru dengan nama ".$this->input->post('id_nasabah'),
		);
		$this->db->insert('tbl_history', $data_history);
		$data['title'] = 'Berhasil';
		$data['text'] = 'Data Potensi Wilayah Berhasil Diubah!';
		$data['icon'] = 'success';
	}else{
		$data['title'] = 'Gagal';
		$data['text'] = 'Data Potensi Wilayah Gagal Diubah!';
		$data['icon'] = 'error';
	}	
	$this->session->set_flashdata($data);
	redirect('potensi_wilayah','refresh');

}



}