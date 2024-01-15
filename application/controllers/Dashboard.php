<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')==FALSE) {
			redirect('login','refresh');
		}
		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('model_export', 'export');
	}

	public function detail_produk()
	{
		$this->db->where('id_produk',$this->input->get('id_produk'));
		$data = $this->db->get('tbl_informasi_produk')->result();
		echo  json_encode($data);
	}


	public function get_option_laporan()
	{
		$this->db->select('id_user,nama');
		if ($this->session->level=="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
			$this->db->where_in('level', ['Marketing', 'Supervisor']);

		}

		if ($this->session->level=="Admin" || $this->session->level=="PIC") {
		
			$this->db->where('level!=','Admin');
			$this->db->where('level!=','PIC');
		}

		$this->db->where('status_user',1);
		$data['marketing'] = $this->db->get('tbl_master_user')->result();

		$this->db->select('id_cabang,nama_cabang');
		$this->db->where('status_cabang',1);
		$data['cabang'] = $this->db->get('tbl_master_cabang')->result();
		echo json_encode($data);
	}

	public function get_nasabah_kunjungan()
	{
		$this->db->select('id_kunjungan,no_rekening,nama_nasabah');
		if ($this->session->level=="Marketing" || $this->session->level=="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
		}
		$data['nasabah'] = $this->db->get('tbl_kunjungan_nasabah')->result();
		echo json_encode($data);
	}

	public function get_nasabah()
	{
		$this->db->select('id_nasabah,telp_nasabah,nama_nasabah');
		if ($this->session->level=="Marketing" || $this->session->level=="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
		}
		$data['nasabah'] = $this->db->get('tbl_nasabah')->result();
		echo json_encode($data);
	}

	public function get_nasabah_pengajuan()
	{
		$this->db->select('id_pengajuan,nik,nama');
		if ($this->session->level=="Marketing" || $this->session->level=="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
		}
		$data['nasabah'] = $this->db->get('tbl_pengajuan')->result();
		echo json_encode($data);
	}


	public function index()
	{
		$this->db->select('sum(besar_plafon) as jumlah');
		$this->db->where('YEAR(tanggal_input)',date('Y'));
		if ($this->session->level!="Admin" && $this->session->level!="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
		}
		$data['pengajuan_total'] = $this->db->get('tbl_pengajuan')->result();

		$this->db->where('status','Realisasi');
		if ($this->session->level!="Admin" && $this->session->level!="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
		}
		$data['total_progress'] = $this->db->get('tbl_pengajuan')->num_rows();


		if ($this->session->level!="Admin" && $this->session->level!="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
		}

		$data['jumlah_pengajuan'] = $this->db->get('tbl_pengajuan')->num_rows();


		$this->db->where('status!=','Realisasi');
		$this->db->where('status!=','Tolak');
		if ($this->session->level!="Admin" && $this->session->level!="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
		}
		$data['nasabah_baru'] = $this->db->get('tbl_pengajuan')->num_rows();
		$this->db->select('count(nama_nasabah) as jumlah');
		$this->db->where('YEAR(tanggal_input)',date('Y'));
		if ($this->session->level!="Admin" && $this->session->level!="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
		}

		$data['potensi_total'] = $this->db->get('tbl_nasabah')->result();

		$this->db->where('a.status_kategori',1);
		$data['kategori_produk'] = $this->db->get('tbl_kategori_produk a')->result();
		$this->db->where('a.status_produk',1);
		$this->db->join('tbl_informasi_produk b','b.id_produk=a.id_produk','left');
		$data['produk'] = $this->db->get('tbl_master_produk a')->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dashboard/tampilan_dashboard',$data);  
		$this->load->view('templates/footer');
	}


	public function ubah_password()
	{
		$data_password = array(
			'password' => md5($this->input->post('password_baru_user')),
		);
		$this->db->where('id_user', $this->session->id_user);
		$result = $this->db->update('tbl_master_user', $data_password);
		if ($result) {
			$data['title'] = 'Berhasil';
			$data['text'] = 'Password Berhasil Diubah!';
			$data['icon'] = 'success';
			$data['logout'] = 'Y';
		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Password Gagal Diubah!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('dashboard', 'refresh');
	}

	public function ubah_profil()
	{
		if (!is_dir('assets/img/foto_user/')) {
			mkdir('assets/img/foto_user/');
		}
		$foto = $this->input->post('lampiran_avatar_lama');

		if($_FILES['lampiran_avatar']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_avatar']['name']);
			$location ='assets/img/foto_user/logo'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_avatar']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}

		$data_profil = array(
			'nama' => $this->input->post('nama_lengkap_user'),
			'email' => $this->input->post('email_user'),
			'foto' => $foto, 

		);
		$this->db->where('id_user',$this->session->id_user);
		$result = $this->db->update('tbl_master_user',$data_profil);
		if ($result) {
			$data['title'] = 'Berhasil';
			$data['text'] = 'Profil Berhasil Diubah!';
			$data['icon'] = 'success';
			$this->session->set_userdata('nama',$this->input->post('nama_lengkap_user'));
			$this->session->set_userdata('email',$this->input->post('email_user'));
			$this->session->set_userdata('foto',$foto);

		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Profil Gagal Diubah!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('dashboard', 'refresh');
	}


	public function tarik_laporan()
	{
		$jenis = $this->input->post('jenis_laporan');
		$data['jenis'] = $jenis;
		
		$kategori = $this->input->post('kategori_laporan');
		$data['kategori'] = $kategori;

		$marketing = $this->input->post('nama_marketing_laporan');
		$cabang = $this->input->post('cabang_laporan');
		if ($this->session->level=="Marketing") {
			$cabang = $this->session->cabang;
			$marketing = $this->session->id_user;
		}

		if ($this->session->level=="Supervisor") {
			$cabang = $this->session->cabang;
		}
		$data['cabang'] = $cabang;
		$data['marketing'] = $marketing;

		$tanggal_awal = $this->input->post('tanggal_awal_laporan');
		$tanggal_akhir = $this->input->post('tanggal_akhir_laporan');
		$data['tanggal_awal'] = $tanggal_awal;
		$data['tanggal_akhir'] = $tanggal_akhir;

		if ($kategori=="Potensi Wilayah") {
			if ($jenis=="Marketing") {
				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang,d.nama_wilayah as kabupaten,e.nama_wilayah as kecamatan, f.nama_wilayah as kelurahan');
				$this->db->select('jabatan.nama_jabatan');
				if ($marketing!='All') {
					$this->db->where('a.id_user',$marketing);
				}
				if ($this->session->level=="Marketing" || $this->session->level=="Supervisor") {
					$this->db->where('a.id_cabang',$cabang);
				}
				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$this->db->join('tbl_master_wilayah d','d.kode_wilayah=a.kabupaten_nasabah');
				$this->db->join('tbl_master_wilayah e','e.sub_wilayah=a.kabupaten_nasabah AND e.kode_wilayah=a.kecamatan_nasabah');
				$this->db->join('tbl_master_wilayah f','f.id_wilayah=a.kelurahan_nasabah');
				$this->db->join(
					'tbl_master_jabatan as jabatan',
					'jabatan.id_jabatan = b.id_jabatan',
					'left'
				);
				$data['laporan'] = $this->db->get('tbl_nasabah a')->result();
				if(!empty($data['laporan'])) {
					$data['laporan_fu'] = $this->export->get_list_fu(array_column($data['laporan'], 'id_nasabah'))->result();
				}
				if($marketing != "All") {
					$jabatan = "Marketing";
					$pejabat = $data['laporan'][0]->nama_marketing ?? '';
				} else {
					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";
				}
			}

			if ($jenis=="Nasabah") {

				$nasabah = $this->input->post('nasabah_kunjungan');

				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang,d.nama_wilayah as kabupaten,e.nama_wilayah as kecamatan, f.nama_wilayah as kelurahan');
				$this->db->select('jabatan.nama_jabatan');

				if ($this->session->level=="Marketing" || $this->session->level=="Supervisor") {
					$this->db->where('a.id_cabang',$cabang);
				}
				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$this->db->join('tbl_master_wilayah d','d.kode_wilayah=a.kabupaten_nasabah');
				$this->db->join('tbl_master_wilayah e','e.sub_wilayah=a.kabupaten_nasabah AND e.kode_wilayah=a.kecamatan_nasabah');
				$this->db->join('tbl_master_wilayah f','f.id_wilayah=a.kelurahan_nasabah');

				$this->db->join(
					'tbl_master_jabatan as jabatan',
					'jabatan.id_jabatan = b.id_jabatan',
					'left'
				);

				$this->db->where('a.id_nasabah', $nasabah);

				$data['laporan'] = $this->db->get('tbl_nasabah a')->result();

				if(!empty($data['laporan'])) {
					$data['laporan_fu'] = $this->export->get_list_fu(array_column($data['laporan'], 'id_nasabah'))->result();
				}

				if($marketing != "All") {
					$jabatan = "Marketing";
					$pejabat = $data['laporan'][0]->nama_marketing ?? '';
				} else {
					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";
				}
			}

			if ($jenis=="Cabang") {
				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang,d.nama_wilayah as kabupaten,e.nama_wilayah as kecamatan, f.nama_wilayah as kelurahan');
				$this->db->select('jabatan.nama_jabatan');
				if ($cabang!='All') {
					$this->db->where('a.id_cabang',$cabang);
				}
				
				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$this->db->join('tbl_master_wilayah d','d.kode_wilayah=a.kabupaten_nasabah');
				$this->db->join('tbl_master_wilayah e','e.sub_wilayah=a.kabupaten_nasabah AND e.kode_wilayah=a.kecamatan_nasabah');
				$this->db->join('tbl_master_wilayah f','f.id_wilayah=a.kelurahan_nasabah');
				$this->db->join(
					'tbl_master_jabatan as jabatan',
					'jabatan.id_jabatan = b.id_jabatan',
					'left'
				);
				$data['laporan'] = $this->db->get('tbl_nasabah a')->result();
				if(!empty($data['laporan'])) {
					$data['laporan_fu'] = $this->export->get_list_fu(array_column($data['laporan'], 'id_nasabah'))->result();
				}
				if(($cabang == "All") || ($cabang == 99)) {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";

				} else {

					$id_jabatan = $cabang == 1 ? 8 : 4;
					$id_cabang = $data['laporan'][0]->id_cabang ?? '';

					$pemimpin_cabang = $this->db->select('nama')
											->from('tbl_master_user')
											->group_start()
												->where('id_cabang', $id_cabang)
												->where('id_jabatan', $id_jabatan)
											->group_end()
											->get()->row();

					$jabatan = "Pemimpin Cabang";
					$pejabat = $pemimpin_cabang->nama ?? '';
				}
			}

			if ($jenis=="Periode") {
				if ($this->session->level=="Marketing"  || $this->session->level=="Supervisor") {
					$this->db->where('a.id_cabang',$cabang);
				}
				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang,d.nama_wilayah as kabupaten,e.nama_wilayah as kecamatan, f.nama_wilayah as kelurahan');
				$this->db->select('jabatan.nama_jabatan');
				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$this->db->join('tbl_master_wilayah d','d.kode_wilayah=a.kabupaten_nasabah');
				$this->db->join('tbl_master_wilayah e','e.sub_wilayah=a.kabupaten_nasabah AND e.kode_wilayah=a.kecamatan_nasabah');
				$this->db->join('tbl_master_wilayah f','f.id_wilayah=a.kelurahan_nasabah');
				$this->db->join(
					'tbl_master_jabatan as jabatan',
					'jabatan.id_jabatan = b.id_jabatan',
					'left'
				);
				$data['laporan'] = $this->db->get('tbl_nasabah a')->result();
				if(!empty($data['laporan'])) {
					$data['laporan_fu'] = $this->export->get_list_fu(array_column($data['laporan'], 'id_nasabah'))->result();
				}
				$jabatan = "Direktur Utama";
				$pejabat = "H. Raji, S.E., M.M";
			}

			$data['jabatan'] = $jabatan ?? '';
			$data['pejabat'] = $pejabat ?? '';
			$data['nasabah'] = $nasabah ?? '';

			$this->load->view('laporan/draft_laporan_potensi',$data);


		}elseif($kategori=="Pengajuan Online"){

			if ($jenis=="Marketing") {
				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang');
				$this->db->select('jabatan.nama_jabatan');
				if ($marketing!='All') {
					$this->db->where('a.id_user',$marketing);
				}

				if ($this->session->level=="Marketing"  || $this->session->level=="Supervisor") {
					$this->db->where('a.id_cabang',$cabang);
				}
				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$this->db->join(
					'tbl_master_jabatan as jabatan',
					'jabatan.id_jabatan = b.id_jabatan',
					'left'
				);
				$data['laporan'] = $this->db->get('tbl_pengajuan a')->result();
				if(!empty($data['laporan'])) {
					$data['laporan_fu'] = $this->export->get_list_fu(array_column($data['laporan'], 'kode_pengajuan'))->result();
				}
				if($marketing == "All") {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";
					
				} else {
					$jabatan = "Marketing";
					$pejabat = $data['laporan'][0]->nama_marketing ?? '';
				}
				
				$data['jabatan'] = $jabatan ?? '';
				$data['pejabat'] = $pejabat ?? '';

				$this->load->view('laporan/draft_laporan_pengajuan',$data);
			}
			
			if ($jenis=="Nasabah") {
				$nasabah = $this->input->post('nasabah_kunjungan');

				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang');
				$this->db->select('jabatan.nama_jabatan');

				if ($this->session->level=="Marketing"  || $this->session->level=="Supervisor") {
					$this->db->where('a.id_cabang',$cabang);
				}

				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');

				$this->db->join(
					'tbl_master_jabatan as jabatan',
					'jabatan.id_jabatan = b.id_jabatan',
					'left'
				);
				$this->db->where('a.id_pengajuan', $nasabah);
				$data['laporan'] = $this->db->get('tbl_pengajuan a')->result();
				if(!empty($data['laporan'])) {
					$data['laporan_fu'] = $this->export->get_list_fu(array_column($data['laporan'], 'kode_pengajuan'))->result();
				}

				if($marketing == "All") {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";

				} else {
					$jabatan = "Marketing";
					$pejabat = $data['laporan'][0]->nama_marketing ?? '';
				}

				$data['jabatan'] = $jabatan ?? '';
				$data['pejabat'] = $pejabat ?? '';
				$data['nasabah'] = $nasabah ?? '';

				$this->load->view('laporan/draft_laporan_pengajuan',$data);
			}

			if ($jenis=="Cabang") {
				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang');
				$this->db->select('jabatan.nama_jabatan');
				if ($cabang!='All') {
					$this->db->where('a.id_cabang',$cabang);
				}

				// if ($this->session->level=="Marketing") {
				// 	$this->db->where('a.id_user',$marketing);
				// }
				
				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$this->db->join(
					'tbl_master_jabatan as jabatan',
					'jabatan.id_jabatan = b.id_jabatan',
					'left'
				);
				$data['laporan'] = $this->db->get('tbl_pengajuan a')->result();
				if(!empty($data['laporan'])) {
					$data['laporan_fu'] = $this->export->get_list_fu(array_column($data['laporan'], 'kode_pengajuan'))->result();
				}
				if(($cabang == "All") || ($cabang == 99)) {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";

				} else {

					if($cabang == 1) {
						$id_jabatan = 8;
					} else {
						$id_jabatan = 4;
					}

					$id_cabang = $data['laporan'][0]->id_cabang ?? '';

					$pemimpin_cabang = $this->db->select('nama')
											->from('tbl_master_user')
											->group_start()
												->where('id_cabang', $id_cabang)
												->where('id_jabatan', $id_jabatan)
											->group_end()
											->get()->row();

					$jabatan = "Pemimpin Cabang";
					$pejabat = $pemimpin_cabang->nama ?? '';

				}

				$data['jabatan'] = $jabatan ?? '';
				$data['pejabat'] = $pejabat ?? '';

				$this->load->view('laporan/draft_laporan_pengajuan',$data);
			}

			if ($jenis=="Periode") {
				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang');
				$this->db->select('jabatan.nama_jabatan');

				if ($this->session->level=="Marketing"  || $this->session->level=="Supervisor") {
					$this->db->where('a.id_cabang',$cabang);
				}
				
				//$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang');
				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$this->db->join(
					'tbl_master_jabatan as jabatan',
					'jabatan.id_jabatan = b.id_jabatan',
					'left'
				);
				$data['laporan'] = $this->db->get('tbl_pengajuan a')->result();
				if(!empty($data['laporan'])) {
					$data['laporan_fu'] = $this->export->get_list_fu(array_column($data['laporan'], 'kode_pengajuan'))->result();
				}

				$jabatan = "Direktur Utama";
				$pejabat = "H. Raji, S.E., M.M";

				$data['jabatan'] = $jabatan ?? '';
				$data['pejabat'] = $pejabat ?? '';

				$this->load->view('laporan/draft_laporan_pengajuan_periode',$data);
			}

		} elseif($kategori == "sosmed") {

			if($jenis == "sosmed_user") {
				
				$id_user = $this->input->post('sosmed_users');

				if ($this->session->level=="Marketing") {
					$id_user = $this->session->id_user;
				}

				$data['user'] = $id_user;

				if($id_user == "All") {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";
					
				} else {

					$user = $this->db->select('nama')
											->from('tbl_master_user')
											->where('id_user', $id_user)
											->get()->row()->nama ?? '';

					$jabatan = "Marketing";
					$pejabat = $user;
				}

			} elseif($jenis == "sosmed_cabang") {
				$id_cabang = $this->input->post('sosmed_cabangs');

				if (($this->session->level == "Supervisor") || ($this->session->level == "Marketing")) {
					$id_cabang = $this->session->cabang;
				}

				$data['cabang'] = $id_cabang;

				if(($id_cabang == "All") || ($id_cabang == 99)) {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";

				} else {

					if($id_cabang == 1) {
						$id_jabatan = 8;
					} else {
						$id_jabatan = 4;
					}

					$id_cabang = $id_cabang ?? '';

					$pemimpin_cabang = $this->db->select('nama')
											->from('tbl_master_user')
											->group_start()
												->where('id_cabang', $id_cabang)
												->where('id_jabatan', $id_jabatan)
											->group_end()
											->get()->row();

					$jabatan = "Pemimpin Cabang";
					$pejabat = $pemimpin_cabang->nama ?? '';

				}


			} elseif($jenis == "sosmed_sosmed") {
				$data['sosmed'] = $this->input->post('sosmed_sosmeds');

				$jabatan = "Direktur Utama";
				$pejabat = "H. Raji, S.E., M.M";
				
			} else {
				$jabatan = "Direktur Utama";
				$pejabat = "H. Raji, S.E., M.M";
			}

			$data['session'] = $this->session->userdata();

			$laporan = $this->export->sosmed($data)->result();
			$data['laporan'] = $laporan;
			$data['jabatan'] = $jabatan ?? '';
			$data['pejabat'] = $pejabat ?? '';
			$this->load->view('laporan/draft_sosmed', $data, FALSE);

		} else{

			if ($jenis=="Marketing") {

				if ($marketing!='All') {
					$this->db->where('a.id_user',$marketing);
				}

				$this->db->select('a.*,b.*,user_approval.nama as approver, marketing.nama as marketing');
				$this->db->where('date(a.tanggal_kunjungan) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_kunjungan) <=',$tanggal_akhir);
				$this->db->join('tbl_kunjungan_nasabah b','b.id_kunjungan=a.id_kunjungan');
				$this->db->join('tbl_master_user as user_approval', 'user_approval.id_user = a.approval_user', 'left');
				$this->db->join('tbl_master_user as marketing', 'marketing.id_user = a.id_user', 'left');
				$data['laporan'] = $this->db->get('tbl_follow_up_kunjungan a')->result();

				if($marketing != "All") {

					$this->db->select('nama, id_user');
					$this->db->where('id_user',$marketing);
					$data['marketing'] = $this->db->get('tbl_master_user')->result();

					$jabatan = "Marketing";
					$pejabat = $data['marketing'][0]->nama;
				} else {
					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";
				}
				
				$data['jabatan'] = $jabatan ?? '';
				$data['pejabat'] = $pejabat ?? '';

				$this->load->view('laporan/draft_laporan_kunjungan_permarketing',$data);

			}

			if ($jenis=="Nasabah") {
				$nasabah = $this->input->post('nasabah_kunjungan');
				$this->db->where('id_kunjungan',$nasabah);
				$data['nasabah'] = $this->db->get('tbl_kunjungan_nasabah')->result();
				$data['nasabah_id'] = $nasabah;

				$this->db->select('a.*,b.nama as nama_marketing, b.id_cabang, user_approval.nama as approver');
				$this->db->where('date(a.tanggal_kunjungan) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_kunjungan) <=',$tanggal_akhir);
				$this->db->where('a.id_kunjungan',$nasabah);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_user as user_approval', 'user_approval.id_user = a.approval_user', 'left');
				$data['laporan'] = $this->db->get('tbl_follow_up_kunjungan a')->result();

				$id_cabang = $data['laporan'][0]->id_cabang ?? '';

				$pemimpin_cabang = $this->db->select('nama')
										->from('tbl_master_user')
										->group_start()
											->where('id_cabang', $id_cabang)
											->where('id_jabatan', 4)
										->group_end()
										->get()->row();

				$jabatan = "Pemimpin Cabang";
				$pejabat = $pemimpin_cabang->nama ?? '';
				
				$data['jabatan'] = $jabatan ?? '';
				$data['pejabat'] = $pejabat ?? '';

				$this->load->view('laporan/draft_laporan_kunjungan_pernasabah',$data);

			}

			if ($jenis=="Cabang") {
				if ($cabang!='All') {
					$this->db->where('a.id_cabang',$cabang);
				}
				$this->db->select('b.nama as nama_marketing, c.id_cabang, c.nama_cabang');
				$this->db->select('count(if(d.status_fu="L",1,null)) as L');
				$this->db->select('count(if(d.status_fu="DP",1,null)) as DP');
				$this->db->select('count(if(d.status_fu="KL",1,null)) as KL');
				$this->db->select('count(if(d.status_fu="D",1,null)) as D');
				$this->db->select('count(if(d.status_fu="M",1,null)) as M');
				$this->db->select('count(if(d.status_fu="PH",1,null)) as PH');

				$this->db->where('date(d.tanggal_kunjungan) >=',$tanggal_awal);
				$this->db->where('date(d.tanggal_kunjungan) <=',$tanggal_akhir);
				$this->db->join('tbl_follow_up_kunjungan d','d.id_kunjungan=a.id_kunjungan');
				$this->db->join('tbl_master_user b','b.id_user=d.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$this->db->group_by('nama_marketing');

				$data['laporan'] = $this->db->get('tbl_kunjungan_nasabah a')->result();


				if(($cabang == 99) || ($cabang == "All")) {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";

				} else {

					if($cabang == 1) {
						$id_jabatan = 8;
					} else {
						$id_jabatan = 4;
					}

					$id_cabang = $data['laporan'][0]->id_cabang ?? '';

					$pemimpin_cabang = $this->db->select('nama')
												->from('tbl_master_user')
												->group_start()
													->where('id_cabang', $id_cabang)
													->where('id_jabatan', $id_jabatan)
												->group_end()
												->get()->row();

					$jabatan = "Pemimpin Cabang";
					$pejabat = $pemimpin_cabang->nama ?? '';

				}
				
				$data['jabatan'] = $jabatan ?? '';
				$data['pejabat'] = $pejabat ?? '';
				
				$this->load->view('laporan/draft_kunjungan_percabang',$data);
			}


		}
	}

	public function export_pdf()
	{
		ini_set('memory_limit', '1500000M');
 		ini_set("pcre.backtrack_limit", "3000000");

		$jenis = $this->input->post('jenis_laporan');
		$data['jenis'] = $jenis;
		
		$kategori = $this->input->post('kategori_laporan');
		$data['kategori'] = $kategori;

		$nasabah = $this->input->post('nasabah');
		$data['nasabah'] = $nasabah;

		$marketing = $this->input->post('nama_marketing_laporan');
		$cabang = $this->input->post('cabang_laporan');
		if ($this->session->level=="Marketing") {
			$cabang = $this->session->cabang;
			$marketing = $this->session->id_user;
		}
		if ($this->session->level=="Supervisor") {
			$cabang = $this->session->cabang;
		}
		$data['marketing'] = $marketing;
		$data['cabang'] = $cabang;

		$tanggal_awal = $this->input->post('tanggal_awal_laporan');
		$tanggal_akhir = $this->input->post('tanggal_akhir_laporan');
		$data['tanggal_awal'] = $tanggal_awal;
		$data['tanggal_akhir'] = $tanggal_akhir;

		$level = $this->session->level;
		$data['level'] = $level;

		$jabatan = "";
		$pejabat = "";

		if($kategori == "Potensi Wilayah") {
			$laporan = $this->export->potensi_wilayah($data)->result();
			$data['laporan'] = $laporan;
			if(!empty($laporan)) {
				$laporan_fu = $this->export->get_list_fu(array_column($laporan, 'id_nasabah'))->result();
				$data['laporan_fu'] = $laporan_fu;
			}

			if($jenis == "Marketing") {

				if($marketing == "All") {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";

				} else {

					$jabatan = "Marketing";
					$pejabat = $laporan[0]->nama_marketing ?? '';
				}
				
			} elseif($jenis == "Cabang") {

				if(($cabang == "All") || ($cabang == 99)) {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";

				} else {

					$id_jabatan = $cabang == 1 ? 8 : 4;

					$id_cabang = $laporan[0]->id_cabang ?? '';

					$pemimpin_cabang = $this->db->select('nama')
											->from('tbl_master_user')
											->group_start()
												->where('id_cabang', $id_cabang)
												->where('id_jabatan', $id_jabatan)
											->group_end()
											->get()->row();

					$jabatan = "Pemimpin Cabang";
					$pejabat = $pemimpin_cabang->nama ?? '';
				}

			} elseif($jenis == "Periode") {

				$jabatan = "Direktur Utama";
				$pejabat = "H. Raji, S.E., M.M";
			}

			$data['jabatan'] = $jabatan;
			$data['pejabat'] = $pejabat;
			$title = "Laporan {$kategori} {$jenis} {$pejabat} {$tanggal_awal} {$tanggal_akhir}";
			$data['title'] = $title;

			$html = $this->load->view('laporan/pdf_potensi_wilayah', $data, TRUE);

		} elseif($kategori == "Pengajuan Online") {
			$laporan = $this->export->pengajuan_online($data)->result();
			$data['laporan'] = $laporan;
			if(!empty($laporan)) {
				$laporan_fu = $this->export->get_list_fu(array_column($laporan, 'kode_pengajuan'))->result();
				$data['laporan_fu'] = $laporan_fu;
			}
			if($jenis == "Marketing") {

				if($marketing == "All") {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";

				} else {

					$jabatan = "Marketing";
					$pejabat = $laporan[0]->nama_marketing;
				}
				
			} elseif($jenis == "Cabang") {

				if(($cabang == "All") || ($cabang == 99)) {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";

				} else {

					$id_jabatan = $cabang == 1 ? 8 : 4;

					$id_cabang = $laporan[0]->id_cabang ?? '';

					$pemimpin_cabang = $this->db->select('nama')
											->from('tbl_master_user')
											->group_start()
												->where('id_cabang', $id_cabang)
												->where('id_jabatan', $id_jabatan)
											->group_end()
											->get()->row();

					$jabatan = "Pemimpin Cabang";
					$pejabat = $pemimpin_cabang->nama ?? '';
				}

			} elseif($jenis == "Periode") {

				$jabatan = "Direktur Utama";
				$pejabat = "H. Raji, S.E., M.M";
			}

			$data['jabatan'] = $jabatan;
			$data['pejabat'] = $pejabat;
			$title = "Laporan {$kategori} {$jenis} {$pejabat} {$tanggal_awal} {$tanggal_akhir}";
			$data['title'] = $title;

			if(($jenis == "Marketing") || ($jenis == "Cabang")) {
				$html = $this->load->view('laporan/pdf_pengajuan_online', $data, TRUE);
			} else {
				$html = $this->load->view('laporan/pdf_pengajuan_online_periode', $data, TRUE);
			}
		} elseif($kategori == "sosmed") {

			$user = $this->input->post('user_laporan') ?? '';
			$cabang = $this->input->post('cabang_laporan') ?? '';
			$sosmed = $this->input->post('sosmed_laporan') ?? '';

			if($jenis == "sosmed_user") {
				$data['user'] = $user;

				if($user == "All") {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";

				} else {

					$user = $this->db->select('nama')
											->from('tbl_master_user')
											->where('id_user', $user)
											->get()->row()->nama ?? '';

					$jabatan = "Marketing";
					$pejabat = $user;
				}

			} elseif($jenis == "sosmed_cabang") {
				$data['cabang'] = $cabang;

				if(($cabang == "All") || ($cabang == 99)) {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";

				} else {

					$id_jabatan = $cabang == 1 ? 8 : 4;

					$id_cabang = $cabang ?? '';

					$pemimpin_cabang = $this->db->select('nama')
											->from('tbl_master_user')
											->group_start()
												->where('id_cabang', $id_cabang)
												->where('id_jabatan', $id_jabatan)
											->group_end()
											->get()->row();

					$jabatan = "Pemimpin Cabang";
					$pejabat = $pemimpin_cabang->nama ?? '';
				}

			} elseif($jenis == "sosmed_sosmed") {
				$data['sosmed'] = $sosmed;

				$jabatan = "Direktur Utama";
				$pejabat = "H. Raji, S.E., M.M";
				
			} else {
				$jabatan = "Direktur Utama";
				$pejabat = "H. Raji, S.E., M.M";
			}

			$data['session'] = $this->session->userdata();
			
			$laporan = $this->export->sosmed($data)->result();
			$data['laporan'] = $laporan;

			$title = "Laporan {$kategori} {$jenis} {$user} {$cabang} {$sosmed} {$tanggal_awal} {$tanggal_akhir}";
			$data['title'] = $title;
			$data['jabatan'] = $jabatan ?? '';
			$data['pejabat'] = $pejabat ?? '';
			$html = $this->load->view('laporan/sosmed', $data, TRUE);

		} else {
			
			$nasabah = $this->input->post('nasabah_kunjungan');
			$data['nasabah_id'] = $nasabah;

			$laporan = $this->export->kunjungan_nasabah($data)->result();
			$data['laporan'] = $laporan;

			if($jenis == "Marketing") {

				if($marketing == "All") {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";

				} else {

					$marketing = $this->db->select('nama')
											->from('tbl_master_user')
											->where('id_user', $marketing)
											->get()->row()->nama ?? '';

					$jabatan = "Marketing";
					$pejabat = $marketing;
				}
				
				$title = "Laporan {$kategori} {$jenis} {$pejabat} {$tanggal_awal} {$tanggal_akhir}";
				$data['jabatan'] = $jabatan;
				$data['pejabat'] = $pejabat;
				$data['title'] = $title;
				$html = $this->load->view('laporan/pdf_kunjungan_marketing', $data, TRUE);

			} elseif($jenis == "Cabang") {

				if(($cabang == "All") || ($cabang == 99)) {

					$jabatan = "Direktur Utama";
					$pejabat = "H. Raji, S.E., M.M";

				} else {

					$id_jabatan = $cabang == 1 ? 8 : 4;

					$id_cabang = $laporan[0]->id_cabang ?? '';

					$pemimpin_cabang = $this->db->select('nama')
											->from('tbl_master_user')
											->group_start()
												->where('id_cabang', $id_cabang)
												->where('id_jabatan', $id_jabatan)
											->group_end()
											->get()->row();

					$jabatan = "Pemimpin Cabang";
					$pejabat = $pemimpin_cabang->nama ?? '';
				}

				$title = "Laporan {$kategori} {$jenis} {$pejabat} {$tanggal_awal} {$tanggal_akhir}";

				$data['jabatan'] = $jabatan;
				$data['pejabat'] = $pejabat;
				$data['title'] = $title;

				$html = $this->load->view('laporan/pdf_kunjungan_cabang', $data, TRUE);

			} elseif($jenis == "Nasabah") {

				$nasabah = $this->input->post('nasabah_kunjungan');
				$this->db->where('id_kunjungan',$nasabah);
				$data['nasabah'] = $this->db->get('tbl_kunjungan_nasabah')->row();

				$id_cabang = $laporan[0]->id_cabang ?? '';

				$pemimpin_cabang = $this->db->select('nama')
										->from('tbl_master_user')
										->group_start()
											->where('id_cabang', $id_cabang)
											->where('id_jabatan', 4)
										->group_end()
										->get()->row();

				$jabatan = "Pemimpin Cabang";
				$pejabat = $pemimpin_cabang->nama ?? '';
				$title = "Laporan {$kategori} {$jenis} {$data['nasabah']->nama_nasabah} {$tanggal_awal} {$tanggal_akhir}";
				$data['jabatan'] = $jabatan;
				$data['pejabat'] = $pejabat;
				$data['title'] = $title;
				$html = $this->load->view('laporan/pdf_kunjungan_nasabah', $data, TRUE);
			}
		}
		
		$config_pdf['orientation'] = "L";
		$mpdf = new \Mpdf\Mpdf($config_pdf);

		$mpdf->SetTitle($title);
		$mpdf->WriteHTML($html);
		$mpdf->Output("{$title}.pdf", "I");
	}

}
