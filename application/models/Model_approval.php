<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_approval extends CI_Model {


	/**
	 * Get Datatable
	 * tbl_follow_up
	 * 
	 * @param string $type
	 * @param object $request
	 * 
	 * @return mixed
	 * */
	public function table_fu(string $type, object $request)
	{
		$sort = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'tanggal_fu';

		$order = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';

		if(($type == "table") || ($type == "filter")) {
			$awal 	= $this->input->get('length');
			$akhir 	= $this->input->get('start');
			$sv 	= strtolower($_GET['search']['value']);

			if($sv) {

				$search = $sv;
				$cari = 
				'
					user.nama LIKE ' . "'%" . $search . "%'" . '
					OR
					fu.tanggal_fu LIKE ' . "'%" . $search . "%'" . '
					OR
					fu.hasil_fu LIKE ' . "'%" . $search . "%'" . '
					OR
					fu.approval LIKE ' . "'%" . $search . "%'" . '
					OR
					fu.status LIKE ' . "'%" . $search . "%'" . '
				';
				$k_search = $this->db->where("($cari)");

			} else {
				$k_search = "";
			}
		}

		$this->db->select('
		fu.id_fu, fu.tanggal_fu, fu.hasil_fu, fu.approval, fu.lampiran_fu, fu.status
		');

		$this->db->select('user.nama as marketing');

		$this->db->from('tbl_follow_up as fu');

		$this->db->join('tbl_master_user as user', 'user.id_user = fu.id_user', 'left');
		$this->db->join('tbl_master_cabang as cabang', 'cabang.id_cabang = user.id_cabang', 'left');

		$this->db->where_not_in('fu.approval', ['disetujui']);

		if($request->user->level === "Marketing") {
			$this->db->where('fu.id_user', $request->user->id_user);

		} elseif($request->user->level === "Supervisor") {
			$this->db->where('cabang.id_cabang', $request->user->cabang);
		}

		if($type == "table") {

			if($awal == -1){
				$batas = "";
			}else{
				$batas = $this->db->limit($awal, $akhir);
			}

			if($_GET['order'][0]['column'] == 0)
            {
				$this->db->order_by('fu.tanggal_fu', $order);
            }else{
                $this->db->order_by($sort,$order);
            }

			return $this->db->get()->result();

		} elseif($type == "filter") {

			return $this->db->get()->num_rows();

		} else if($type == "total") {

			return $this->db->get()->num_rows();

		} else {
			return false;
		}
	}

	/**
	 * Get Datatable
	 * tbl_follow_up_kunjungan
	 * 
	 * @param string $type
	 * @param object $request
	 * 
	 * @return mixed
	 * */
	public function table_fu_kunjungan(string $type, object $request)
	{
		$sort = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'tanggal_kunjungan';

		$order = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';

		if(($type == "table") || ($type == "filter")) {
			$awal 	= $this->input->get('length');
			$akhir 	= $this->input->get('start');
			$sv 	= strtolower($_GET['search']['value']);

			if($sv) {

				$search = $sv;
				$cari = 
				'
					user.nama LIKE ' . "'%" . $search . "%'" . '
					OR
					fu_kunjungan.tanggal_kunjungan LIKE ' . "'%" . $search . "%'" . '
					OR
					fu_kunjungan.hasil_kunjungan LIKE ' . "'%" . $search . "%'" . '
					OR
					fu_kunjungan.status_fu LIKE ' . "'%" . $search . "%'" . '
					OR
					fu_kunjungan.approval LIKE ' . "'%" . $search . "%'" . '
				';
				$k_search = $this->db->where("($cari)");

			} else {
				$k_search = "";
			}
		}

		$this->db->select('
			fu_kunjungan.id_follow_up_kunjungan, fu_kunjungan.tanggal_kunjungan, fu_kunjungan.hasil_kunjungan,
			fu_kunjungan.status_fu, fu_kunjungan.approval, fu_kunjungan.lampiran_kunjungan,
			fu_kunjungan.latitude_kunjungan, fu_kunjungan.longitude_kunjungan
		');

		$this->db->select('user.nama as marketing');

		$this->db->from('tbl_follow_up_kunjungan as fu_kunjungan');

		$this->db->join('tbl_master_user as user', 'user.id_user = fu_kunjungan.id_user', 'left');
		$this->db->join('tbl_master_cabang as cabang', 'cabang.id_cabang = user.id_cabang', 'left');

		$this->db->where_not_in('fu_kunjungan.approval', ['disetujui']);

		if($request->user->level === "Marketing") {
			$this->db->where('fu_kunjungan.id_user', $request->user->id_user);

		} elseif($request->user->level === "Supervisor") {
			$this->db->where('cabang.id_cabang', $request->user->cabang);
		}

		if($type == "table") {

			if($awal == -1){
				$batas = "";
			}else{
				$batas = $this->db->limit($awal, $akhir);
			}

			if($_GET['order'][0]['column'] == 0)
            {
				$this->db->order_by('fu_kunjungan.tanggal_kunjungan', $order);
            }else{
                $this->db->order_by($sort,$order);
            }

			return $this->db->get()->result();

		} elseif($type == "filter") {

			return $this->db->get()->num_rows();

		} else if($type == "total") {

			return $this->db->get()->num_rows();

		} else {
			return false;
		}
	}

	/**
	 * Get DataTable Posting
	 * 
	 * @param string $type
	 * @param object $request
	 * 
	 * @return mixed
	 * */
	public function table_posting(string $type, object $request)
	{
		$sort = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'posting.created_at';

		$order = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';

		if(($type == "table") || ($type == "filter")) {
			$awal 	= $this->input->get('length');
			$akhir 	= $this->input->get('start');
			$sv 	= strtolower($_GET['search']['value']);

			if($sv) {

				$search = $sv;
				$cari = 
				'
					posting.link LIKE ' . "'%" . $search . "%'" . '
					OR
					posting.created_at LIKE ' . "'%" . $search . "%'" . '
					OR
					posting.updated_at LIKE ' . "'%" . $search . "%'" . '
					OR
					posting.approval LIKE ' . "'%" . $search . "%'" . '
					OR
					user.nama LIKE ' . "'%" . $search . "%'" . '
					OR
					cabang.nama_cabang LIKE ' . "'%" . $search . "%'" . '
					OR
					sosmed.nama LIKE ' . "'%" . $search . "%'" . '
				';
				$k_search = $this->db->where("($cari)");

			} else {
				$k_search = "";
			}
		}
			
		// Posting
		$this->db->select('posting.id, posting.link, posting.tgl_posting, posting.approval, posting.created_at, posting.updated_at');

		// User
		$this->db->select('user.nama as user, user.id_user');

		// Cabang
		$this->db->select('cabang.nama_cabang as cabang');

		// Sosmed
		$this->db->select('sosmed.nama as sosmed');

		$this->db->from('tbl_posting as posting');
		$this->db->join('tbl_master_user as user', 'user.id_user = posting.id_user', 'left');
		$this->db->join('tbl_master_cabang as cabang', 'cabang.id_cabang = user.id_cabang', 'left');
		$this->db->join('tbl_master_sosmed as sosmed', 'sosmed.kode = posting.kode_sosmed', 'left');

		$this->db->where_not_in('posting.approval', ['disetujui']);

		if($request->user->level === "Marketing") {
			$this->db->where('user.id_user', $request->user->id_user);

		} elseif($request->user->level === "Supervisor") {
			$this->db->where('cabang.id_cabang', $request->user->cabang);

		}

		if($type == "table") {

			if($awal == -1){
				$batas = "";
			}else{
				$batas = $this->db->limit($awal, $akhir);
			}

			if($_GET['order'][0]['column'] == 0)
            {
				$this->db->order_by('sosmed.created_at', $order);
            }else{
                $this->db->order_by($sort,$order);
            }

			return $this->db->get()->result();

		} elseif($type == "filter") {

			return $this->db->get()->num_rows();

		} else if($type == "total") {

			return $this->db->get()->num_rows();

		} else {
			return false;
		}
	}

	public function fu($id, $fu_type)
	{
		// Follow Up
		$this->db->select('
			fu.id_fu as id, fu.tanggal_fu, fu.hasil_fu,
			fu.approval, fu.lampiran_fu, fu.status
		');

		// User
		$this->db->select('user.nama as marketing');

		if($fu_type === "pengajuan") {

			$this->db->select('
				pengajuan.nik, pengajuan.nama, pengajuan.nama_suami_istri, pengajuan.nama_ibu_kandung,
				pengajuan.alamat_rumah, pengajuan.foto_ktp, pengajuan.nama_usaha_pekerjaan,
				pengajuan.alamat_usaha_pekerjaan, pengajuan.omset_usaha, pengajuan.besar_plafon,
				pengajuan.foto_usaha, pengajuan.no_hp, pengajuan.foto_ktp_pasangan, pengajuan.foto_selfie
			');

			$this->db->select('
				produk.nama_produk
			');

		} elseif($fu_type === "nasabah") {

			// Nasabah
			$this->db->select('
				nasabah.nama_nasabah, nasabah.telp_nasabah, nasabah.alamat_nasabah,
				nasabah.usaha_nasabah, nasabah.foto_usaha, nasabah.omset_nasabah,
				nasabah.latitude, nasabah.longitude
			');

			// Wilayah
			$this->db->select('
				provinsi.nama_wilayah as provinsi,
				kabupaten.nama_wilayah as kabupaten,
				kecamatan.nama_wilayah as kecamatan,
				kelurahan.nama_wilayah as kelurahan
			');

		}

		$this->db->from('tbl_follow_up as fu');

		$this->db->join('tbl_master_user as user', 'user.id_user = fu.id_user', 'left');

		if($fu_type === "pengajuan") {

			$this->db->join('tbl_pengajuan as pengajuan', 'pengajuan.kode_pengajuan = fu.id_nasabah', 'left');
			$this->db->join('tbl_master_produk as produk', 'produk.id_produk = pengajuan.id_produk', 'left');

		} elseif($fu_type === "nasabah") {

			$this->db->join('tbl_nasabah as nasabah', 'nasabah.id_nasabah = fu.id_nasabah', 'left');
			$this->db->join('tbl_master_wilayah as provinsi', 'provinsi.kode_wilayah = nasabah.provinsi_nasabah', 'left');
			$this->db->join('tbl_master_wilayah as kabupaten', 'kabupaten.kode_wilayah = nasabah.kabupaten_nasabah', 'left');
			$this->db->join('tbl_master_wilayah as kecamatan', 'kecamatan.kode_wilayah = nasabah.kecamatan_nasabah', 'left');
			$this->db->join('tbl_master_wilayah as kelurahan', 'kelurahan.id_wilayah = nasabah.kelurahan_nasabah', 'left');
		}

		$this->db->where('fu.id_fu', $id);

		return $this->db->get();
	}

	public function fu_kunjungan($id)
	{
		// Follow Up Kunjungan
		$this->db->select('
			fu_kunjungan.id_follow_up_kunjungan as id, fu_kunjungan.tanggal_kunjungan, fu_kunjungan.hasil_kunjungan,
			fu_kunjungan.status_fu, fu_kunjungan.approval, fu_kunjungan.lampiran_kunjungan,
			fu_kunjungan.latitude_kunjungan, fu_kunjungan.longitude_kunjungan
		');

		// User
		$this->db->select('user.nama as marketing');

		// Kunjungan
		$this->db->select('
			kunjungan.no_rekening, kunjungan.nama_nasabah, kunjungan.alamat_nasabah,
			kunjungan.plafon, kunjungan.tgl_realisasi
		');

		// Wilayah
		$this->db->select('
			provinsi.nama_wilayah as provinsi,
			kabupaten.nama_wilayah as kabupaten,
			kecamatan.nama_wilayah as kecamatan,
			kelurahan.nama_wilayah as kelurahan
		');

		$this->db->from('tbl_follow_up_kunjungan as fu_kunjungan');

		$this->db->join('tbl_master_user as user', 'user.id_user = fu_kunjungan.id_user', 'left');

		$this->db->join('tbl_kunjungan_nasabah as kunjungan', 'kunjungan.id_kunjungan = fu_kunjungan.id_kunjungan', 'left');

		$this->db->join('tbl_master_wilayah as provinsi', 'provinsi.kode_wilayah = kunjungan.provinsi_kunjungan', 'left');
		$this->db->join('tbl_master_wilayah as kabupaten', 'kabupaten.kode_wilayah = kunjungan.kabupaten_kunjungan', 'left');
		$this->db->join('tbl_master_wilayah as kecamatan', 'kecamatan.kode_wilayah = kunjungan.kecamatan_kunjungan', 'left');
		$this->db->join('tbl_master_wilayah as kelurahan', 'kelurahan.id_wilayah = kunjungan.kelurahan_kunjungan', 'left');

		$this->db->where('fu_kunjungan.id_follow_up_kunjungan', $id);

		return $this->db->get();
	}

	/**
	 * Get Detail Posting
	 * 
	 * @param int $id
	 * 
	 * @return mixed
	 * */
	public function posting(int $id)
	{
		// Posting
		$this->db->select('posting.id, posting.link, posting.tgl_posting, posting.created_at, posting.updated_at');

		// User
		$this->db->select('user.nama as user');

		// Cabang
		$this->db->select('cabang.nama_cabang as cabang');

		// Sosmed
		$this->db->select('sosmed.nama as sosmed');

		$this->db->from('tbl_posting as posting');
		$this->db->join('tbl_master_user as user', 'user.id_user = posting.id_user', 'left');
		$this->db->join('tbl_master_cabang as cabang', 'cabang.id_cabang = user.id_cabang', 'left');
		$this->db->join('tbl_master_sosmed as sosmed', 'sosmed.kode = posting.kode_sosmed', 'left');

		$this->db->where('posting.id', $id);

		return $this->db->get();
	}
}

/* End of file Model_approval.php */
/* Location: ./application/models/Model_approval.php */