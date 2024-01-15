<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data_visitor = array(
			'visitor_ip'=>get_ip(),
			'visitor_date'=>date('Y-m-d H:i:s'),
		);
		$this->db->insert('tbl_visitor', $data_visitor);

		$data['landing']=$this->data_landing();
		$this->load->view('landing/tampilan_landing',$data);
	}


	public function detail_produk()
	{
		$this->db->where('id_produk',$this->input->get('id_produk'));
		$data = $this->db->get('tbl_master_produk')->result();
		echo json_encode($data);
	}

	
	public function simulasi_kredit()
	{
		$data['profil']=$this->db->get('tbl_profile')->result();
		$this->load->view('landing/simulasi_kredit',$data);
	}

	public function data_landing()
	{
		$data['profil'] =$this->db->get('tbl_profile')->result();


		$this->db->where('a.status_user',1);
		$this->db->where('a.terbaik',1);
		$this->db->where('a.level',"Marketing");
		$this->db->or_where('a.level',"Supervisor");
		$this->db->where('a.status_user',1);
		$this->db->where('a.terbaik',1);
		$this->db->join('tbl_master_jabatan b','b.id_jabatan=a.id_jabatan','left');
		$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang','left');
		$this->db->join('tbl_portofolio d','d.id_user=a.id_user','left');
		$data['marketing'] =$this->db->get('tbl_master_user a')->result();


		$data['galeri'] =$this->db->get('tbl_galeri_foto')->result();

		$this->db->where('a.status_kategori',1);
		$data['kategori'] =$this->db->get('tbl_kategori_produk a')->result();

		$this->db->where('a.status_cabang',1);
		$this->db->where_not_in('a.id_cabang',99);
		$data['cabang'] =$this->db->get('tbl_master_cabang a')->result();

		$this->db->where('a.status_produk',1);
		$data['produk'] =$this->db->get('tbl_master_produk a')->result();
		$this->db->limit(6);
		$data['clients'] =$this->db->get('tbl_clients a')->result();
		$this->db->limit(6);
		$this->db->order_by('rand()');
		$data['testimoni'] =$this->db->get('tbl_testimoni a')->result();

		$this->db->order_by('rand()');
		$data['pengawas'] =$this->db->get('tbl_pengawas a')->result();
		$data['about_us'] =$this->db->get('tbl_about_us a')->result();
		$data['feature'] =$this->db->get('tbl_feature a')->result();


		$this->db->where('status','Realisasi');
		$data['happy_client'] = $this->db->get('tbl_pengajuan')->num_rows();
		$data['projects'] = $this->db->get('tbl_nasabah')->num_rows();
		$data['subscriber'] = $this->db->get('tbl_subscribe')->num_rows();
		$data['visitor'] = $this->db->get('tbl_visitor')->num_rows();

		return $data;
	}

	public function simpan()
	{
		$data_subscribe = array(
			'email_subscribe' => $this->input->post('email_langganan'),
			'tgl_subscribe' => date('Y-m-d'),
			'status_subscribe' =>1,
		);
		$result= $this->db->insert('tbl_subscribe', $data_subscribe);

		if ($result) {
			echo json_encode(1);
		}else{
			echo json_encode(0);
		}	
	}

	public function testimoni()
	{
		$data_subscribe = array(
			'email_subscribe' => $this->input->post('email_langganan'),
			'tgl_subscribe' => date('Y-m-d'),
			'status_subscribe' =>1,
		);
		$result= $this->db->insert('tbl_subscribe', $data_subscribe);

		if ($result) {
			echo json_encode(1);
		}else{
			echo json_encode(0);
		}	
	}


	public function get_marketing()
	{
		$id_cabang = $this->input->get('id_cabang');

		if ($id_cabang > 0) {
			$this->db->where('a.status_user',1);
			$this->db->where('a.id_cabang',$id_cabang);
			$this->db->where('a.level',"Marketing");
			$this->db->or_where('a.level',"Supervisor");
			$this->db->where('a.status_user',1);
			$this->db->where('a.id_cabang',$id_cabang);
			$this->db->join('tbl_master_jabatan b','b.id_jabatan=a.id_jabatan','left');
			$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang','left');
			$this->db->join('tbl_portofolio d','d.id_user=a.id_user','left');
			$data  =$this->db->get('tbl_master_user a')->result();
		}else{

			$this->db->where('a.status_user',1);
			$this->db->where('a.terbaik',1);
			$this->db->where('a.level',"Marketing");
			$this->db->or_where('a.level',"Supervisor");
			$this->db->where('a.status_user',1);
			$this->db->join('tbl_master_jabatan b','b.id_jabatan=a.id_jabatan','left');
			$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang','left');
			$this->db->join('tbl_portofolio d','d.id_user=a.id_user','left');
			$data  =$this->db->get('tbl_master_user a')->result();
			
		}
		echo json_encode($data);
	}
	public function track()
	{
		$request = (object) $this->input->post();

		$pengajuan = $this->db->get_where('tbl_pengajuan', ['kode_pengajuan' => $request->kode])->row();
		$data['pengajuan'] = $pengajuan;

		if(!$pengajuan) {
			return $this->output->set_content_type('application/json')->set_output(json_encode(['status' => false]));
		}

		$fu = $this->db->order_by('tanggal_fu', 'desc')->get_where('tbl_follow_up', [
			'id_nasabah' => $pengajuan->kode_pengajuan,
			'approval' => 'disetujui',
		])->result();
		$data['fu'] = $fu;
		$this->load->view('landing/track', $data, FALSE);
	}
}
