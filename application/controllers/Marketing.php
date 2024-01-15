<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends CI_Controller {

	public function bpr($id_user='')
	{
		$this->db->where('a.id_user',$id_user);
		$this->db->join('tbl_master_jabatan b','b.id_jabatan=a.id_jabatan','left');
		$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang','left');
		$this->db->join('tbl_portofolio d','d.id_user=a.id_user','left');
		$data['marketing'] = $this->db->get('tbl_master_user a')->result();
		if ($id_user=='' || count($data['marketing'])==0) {
			redirect('landing','refresh');
		}else{
			$this->db->where('a.status_kategori',1);
			$data['kategori_produk'] = $this->db->get('tbl_kategori_produk a')->result();
			$this->db->where('a.status_produk',1);
			$data['produk'] = $this->db->get('tbl_master_produk a')->result();
			$data['profile'] = $this->db->get('tbl_profile')->result();
			$this->load->view('template_marketing/portofolio',$data);
		}
	}

	public function index()
	{
		$this->db->select('id_user,nama');
		$this->db->where('level','Marketing');

		

		$this->db->where('status_user',1);
		$data['marketing'] = $this->db->get('tbl_master_user')->result();

		if ($this->session->level=="Marketing") {
			$this->db->where('id_user',$this->session->id_user);
			$data['portofolio'] = $this->db->get('tbl_portofolio')->num_rows();
		}

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('portofolio/tampilan_portofolio',$data);
		$this->load->view('templates/footer');
	}

	public function detail_produk()
	{
		$this->db->where('id_produk',$this->input->get('id_produk'));
		$data = $this->db->get('tbl_master_produk')->result();
		echo  json_encode($data);
	}
public function detail_portofolio()
{
	$this->db->where('id_portofolio',$this->input->get('id_portofolio'));
	$data = $this->db->get('tbl_portofolio')->result();
	echo json_encode($data);
}
	public function tabel_portofolio(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'id_portofolio';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('portofolio',$sort,$order,$search);
		if (count($list) > 0) {

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="'.base_url().'marketing/bpr/'.$l->id_user.'" class="btn btn-sm btn-circle  btn-success" target="_blank"><i class="fa fa-eye"></i></a>';

			if ($this->session->level=="Marketing" || $this->session->level=="Admin") {

				$opsi .='<a href="javascript:;" class="btn btn-sm btn-circle  btn-primary   item_edit_portofolio" data="'.$l->id_portofolio.'"><i class="fa fa-edit"></i></a>';
			}

			if ($this->session->level=="Supervisor" &&  $this->session->id_user==$l->id_user) {

				$opsi .='<a href="javascript:;" class="btn btn-sm btn-circle  btn-primary   item_edit_portofolio" data="'.$l->id_portofolio.'"><i class="fa fa-edit"></i></a>';
			}


			$opsi .='</div>';
			$l->opsi = $opsi;
		if ($l->twitter_portofolio!='') {
			
			$l->twitter_portofolio = '<a href="'.$l->twitter_portofolio.'" class="btn btn-sm btn-success" target="_blank" ><i class="fa fa-check"></i></a>';
		}

		if ($l->facebook_portofolio!='') {
			
			$l->facebook_portofolio = '<a href="'.$l->facebook_portofolio.'" class="btn btn-sm btn-success" target="_blank" ><i class="fa fa-check"></i></a>';
		}

		if ($l->instagram_portofolio!='') {
			
			$l->instagram_portofolio = '<a href="'.$l->instagram_portofolio.'" class="btn btn-sm btn-success" target="_blank" ><i class="fa fa-check"></i></a>';
		}


		if ($l->linkedin_portofolio!='') {
			
			$l->linkedin_portofolio = '<a href="'.$l->linkedin_portofolio.'" class="btn btn-sm btn-success" target="_blank" ><i class="fa fa-check"></i></a>';
		}

		if ($l->foto_portofolio!='') {
			
			$l->foto_portofolio = '<img src="'.base_url().$l->foto_portofolio.'" width="35px">';
		}
			$data[] = $l;


		}

		}

		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('portofolio',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('portofolio',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}

	public function ubah()
	{


		if (!is_dir('assets/img/foto_portofolio/')) {
			mkdir('assets/img/foto_portofolio/');
		}

		$foto = $this->input->post('lampiran_portofolio_lama');

		if($_FILES['lampiran_portofolio']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_portofolio']['name']);
			$location ='assets/img/foto_portofolio/pp_'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_portofolio']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}
		
		$data_portofolio = array(
			//'id_user' => $this->session->id_user,
			'sambutan_portofolio' => $this->input->post('sambutan_portofolio'),
			'alamat_portofolio' => $this->input->post('alamat_portofolio'),
			'telepon_portofolio' => $this->input->post('telepon_portofolio'),
			'twitter_portofolio' => $this->input->post('twitter_portofolio'),
			'facebook_portofolio' => $this->input->post('facebook_portofolio'),
			'instagram_portofolio' => $this->input->post('instagram_portofolio'),
			'linkedin_portofolio' => $this->input->post('linkedin_portofolio'),
			'foto_portofolio' => $foto,
		);
		$this->db->where('id_portofolio',$this->input->post('id_portofolio'));
		$result= $this->db->update('tbl_portofolio', $data_portofolio);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Portofolio",
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Portofolio Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Portofolio Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('marketing','refresh');

	}


		public function simpan()
	{


		if (!is_dir('assets/img/foto_portofolio/')) {
			mkdir('assets/img/foto_portofolio/');
		}

		$foto = '';

		if($_FILES['lampiran_portofolio']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_portofolio']['name']);
			$location ='assets/img/foto_portofolio/pp_'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_portofolio']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}
		
		$data_portofolio = array(
			'id_user' => $this->session->id_user,
			'sambutan_portofolio' => $this->input->post('sambutan_portofolio'),
			'alamat_portofolio' => $this->input->post('alamat_portofolio'),
			'telepon_portofolio' => $this->input->post('telepon_portofolio'),
			'twitter_portofolio' => $this->input->post('twitter_portofolio'),
			'facebook_portofolio' => $this->input->post('facebook_portofolio'),
			'instagram_portofolio' => $this->input->post('instagram_portofolio'),
			'linkedin_portofolio' => $this->input->post('linkedin_portofolio'),
			'foto_portofolio' => $foto,
		);
		$result= $this->db->insert('tbl_portofolio', $data_portofolio);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Portofolio Baru",
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Portofolio Berhasil Disimpan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Portofolio Gagal Disimpan!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('marketing','refresh');

	}
}
