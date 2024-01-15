<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_export extends CI_Model {

	public function potensi_wilayah(array $data)
	{
		// Nasabah
		$this->db->select('
			
		    nasabah.id_user, nasabah.id_nasabah, nasabah.nama_nasabah, nasabah.telp_nasabah, nasabah.alamat_nasabah, nasabah.tanggal_input,
			nasabah.usaha_nasabah, nasabah.omset_nasabah, nasabah.status_nasabah, nasabah.no_referensi, nasabah.foto_usaha
		');

		// User
		$this->db->select('user.nama as nama_marketing');

		// Jabatan
		$this->db->select('jabatan.nama_jabatan');

		// Cabang
		$this->db->select('cabang.id_cabang, cabang.nama_cabang');

		// Kabupaten
		$this->db->select('kabupaten.nama_wilayah as kabupaten');

		// Kecamatan
		$this->db->select('kecamatan.nama_wilayah as kecamatan');

		// Kelurahan
		$this->db->select('kelurahan.nama_wilayah as kelurahan');

		$this->db->from('tbl_nasabah as nasabah');
		$this->db->join(
			'tbl_master_user as user',
			'user.id_user = nasabah.id_user',
			'left'
		);

		$this->db->join(
			'tbl_master_jabatan as jabatan',
			'jabatan.id_jabatan = user.id_jabatan',
			'left'
		);

		$this->db->join(
			'tbl_master_cabang as cabang',
			'cabang.id_cabang = nasabah.id_cabang',
			'left'
		);
		$this->db->join(
			'tbl_master_wilayah as kabupaten',
			'kabupaten.kode_wilayah = nasabah.kabupaten_nasabah',
			'left'
		);
		$this->db->join(
			'tbl_master_wilayah as kecamatan',
			'
				kecamatan.sub_wilayah = nasabah.kabupaten_nasabah
				AND
				kecamatan.kode_wilayah = nasabah.kecamatan_nasabah
			',
			'left'
		);
		$this->db->join(
			'tbl_master_wilayah as kelurahan',
			'kelurahan.id_wilayah = nasabah.kelurahan_nasabah',
			'left'
		);

		$this->db->where("
			DATE(nasabah.tanggal_input)
			BETWEEN
			'{$data['tanggal_awal']}'
			AND
			'{$data['tanggal_akhir']}'
		");

		if($data['jenis'] == "Marketing") {

			if($data['marketing'] != "All") {
				$this->db->where('nasabah.id_user', $data['marketing']);
			}

			if(($data['level'] == "Marketing") || ($data['level'] == "Supervisor")) {
				$this->db->where('nasabah.id_cabang', $data['cabang']);
			}

		} elseif($data['jenis'] == "Cabang") {

			if($data['cabang'] != "All") {
				$this->db->where('nasabah.id_cabang', $data['cabang']);
			}

		} elseif($data['jenis'] == "Nasabah") {

			$this->db->where('nasabah.id_nasabah', $data['nasabah']);


		} elseif($data['jenis'] == "Periode") {

			if(($data['level'] == "Marketing") || ($data['level'] == "Supervisor")) {
				$this->db->where('nasabah.id_cabang', $data['cabang']);
			}
		}

		$this->db->order_by('nasabah.id_nasabah ASC, nasabah.tanggal_input ASC');

		return $this->db->get();
	}

	public function pengajuan_online(array $data)
	{
		// Pengajuan
		$this->db->select('
		
			pengajuan.id_user, pengajuan.kode_pengajuan, pengajuan.tanggal_input, pengajuan.tgl_realisasi, pengajuan.nama, 
			pengajuan.nik, pengajuan.alamat_rumah, pengajuan.no_hp, pengajuan.besar_plafon, pengajuan.status,
			pengajuan.no_referensi, pengajuan.foto_selfie, pengajuan.foto_usaha, pengajuan.nama_usaha_pekerjaan

		');

		// User
		$this->db->select('user.nama as nama_marketing');

		// Jabatan
		$this->db->select('jabatan.nama_jabatan');

		// Cabang
		$this->db->select('cabang.id_cabang, cabang.nama_cabang');

		$this->db->from('tbl_pengajuan as pengajuan');
		$this->db->join(
			'tbl_master_user as user',
			'user.id_user = pengajuan.id_user',
			'left'
		);

		$this->db->join(
			'tbl_master_jabatan as jabatan',
			'jabatan.id_jabatan = user.id_jabatan',
			'left'
		);

		$this->db->join(
			'tbl_master_cabang as cabang',
			'cabang.id_cabang = pengajuan.id_cabang',
			'left'
		);

		$this->db->where("
			DATE(pengajuan.tanggal_input)
			BETWEEN
			'{$data['tanggal_awal']}'
			AND
			'{$data['tanggal_akhir']}'
		");

		if($data['jenis'] == "Marketing") {

			if($data['marketing'] != "All") {
				$this->db->where('pengajuan.id_user', $data['marketing']);
			}

			if(($data['level'] == "Marketing") || ($data['level'] == "Supervisor")) {
				$this->db->where('pengajuan.id_cabang', $data['cabang']);
			}

		} elseif($data['jenis'] == "Nasabah") {

			$this->db->where('pengajuan.id_pengajuan', $data['nasabah']);

		} elseif($data['jenis'] == "Cabang") {

			if($data['cabang'] != "All") {
				$this->db->where('pengajuan.id_cabang', $data['cabang']);
			}

		} elseif($data['jenis'] == "Periode") {

			if(($data['level'] == "Marketing") || ($data['level'] == "Supervisor")) {
				$this->db->where('pengajuan.id_cabang', $data['cabang']);
			}
		}

		$this->db->order_by('pengajuan.id_pengajuan ASC, pengajuan.tanggal_input ASC');

		return $this->db->get();
	}

	public function kunjungan_nasabah(array $data)
	{
		if($data['jenis'] == "Marketing") {

			// follow up kunjungan
			$this->db->select('
				followup.tanggal_kunjungan, followup.hasil_kunjungan, followup.status_fu,
				followup.lampiran_kunjungan, followup.approval
			');

			// kunjungan nasabah
			$this->db->select('
				kunjungan.no_rekening, kunjungan.nama_nasabah, kunjungan.plafon,
				kunjungan.tgl_realisasi, kunjungan.alamat_nasabah
			');

			// User Approval
			$this->db->select('user_approval.nama as approver');

			// Marketing
			$this->db->select('marketing.nama as marketing');
			$this->db->from('tbl_follow_up_kunjungan as followup');
			$this->db->join(
				'tbl_kunjungan_nasabah as kunjungan',
				'kunjungan.id_kunjungan = followup.id_kunjungan',
				'left'
			);
			$this->db->join('tbl_master_user as user_approval', 'user_approval.id_user = followup.approval_user', 'left');
			$this->db->join('tbl_master_user as marketing', 'marketing.id_user = followup.id_user', 'left');
			$this->db->where("
				DATE(followup.tanggal_kunjungan)
				BETWEEN
				'{$data['tanggal_awal']}'
				AND
				'{$data['tanggal_akhir']}'
			");

			if($data['marketing'] != "All") {
				$this->db->where('followup.id_user', $data['marketing']);
			}

			$this->db->order_by('followup.id_follow_up_kunjungan ASC, followup.tanggal_kunjungan ASC');

		} elseif($data['jenis'] == "Nasabah") {

			// follow up kunjungan
			$this->db->select('
				followup.tanggal_kunjungan, followup.hasil_kunjungan, followup.status_fu,
				followup.lampiran_kunjungan, followup.approval
			');

			// User
			$this->db->select('user.nama as nama_marketing, user.id_cabang');
			
			// User Approval
			$this->db->select('user_approval.nama as approver');

			$this->db->from('tbl_follow_up_kunjungan as followup');
			$this->db->join(
				'tbl_master_user as user',
				'user.id_user = followup.id_user',
				'left'
			);
			$this->db->join('tbl_master_user as user_approval', 'user_approval.id_user = followup.approval_user', 'left');
			$this->db->where("
				DATE(followup.tanggal_kunjungan)
				BETWEEN
				'{$data['tanggal_awal']}'
				AND
				'{$data['tanggal_akhir']}'
			");

			$this->db->where('followup.id_kunjungan', $data['nasabah_id']);

			$this->db->order_by('followup.id_follow_up_kunjungan ASC, followup.tanggal_kunjungan ASC');

		} elseif($data['jenis'] == "Cabang") {

			// User
			$this->db->select('user.nama as nama_marketing');

			// Cabang
			$this->db->select('cabang.id_cabang, cabang.nama_cabang');

			$this->db->select('count(if(followup.status_fu="L",1,null)) as L');
			$this->db->select('count(if(followup.status_fu="DP",1,null)) as DP');
			$this->db->select('count(if(followup.status_fu="KL",1,null)) as KL');
			$this->db->select('count(if(followup.status_fu="D",1,null)) as D');
			$this->db->select('count(if(followup.status_fu="M",1,null)) as M');
			$this->db->select('count(if(followup.status_fu="PH",1,null)) as PH');

			$this->db->from('tbl_kunjungan_nasabah as kunjungan');
			$this->db->join(
				'tbl_follow_up_kunjungan as followup',
				'followup.id_kunjungan = kunjungan.id_kunjungan',
				'left'
			);
			$this->db->join(
				'tbl_master_user as user',
				'user.id_user = followup.id_user',
				'left'
			);
			$this->db->join(
				'tbl_master_cabang as cabang',
				'cabang.id_cabang = kunjungan.id_cabang',
				'left'
			);

			$this->db->where("
				DATE(followup.tanggal_kunjungan)
				BETWEEN
				'{$data['tanggal_awal']}'
				AND
				'{$data['tanggal_akhir']}'
			");

			if($data['cabang'] != "All") {
				$this->db->where('kunjungan.id_cabang', $data['cabang']);
			}

			$this->db->group_by('user.nama');

			$this->db->order_by('cabang.nama_cabang ASC');
		}


		return $this->db->get();
	}
	public function sosmed(array $data)
	{
		// Posting
		$this->db->select('posting.link, posting.tgl_posting, posting.created_at, posting.updated_at, posting.approval');

		// User
		$this->db->select('user.nama as user');

		// Cabang
		$this->db->select('cabang.id_cabang, cabang.nama_cabang as cabang');

		// Sosmed
		$this->db->select('sosmed.nama as sosmed');

		// User Approval
		$this->db->select('user_approval.nama as approval_user');

		$this->db->from('tbl_posting as posting');
		$this->db->join('tbl_master_user as user', 'user.id_user = posting.id_user', 'left');
		$this->db->join('tbl_master_cabang as cabang', 'cabang.id_cabang = user.id_cabang', 'left');
		$this->db->join('tbl_master_sosmed as sosmed', 'sosmed.kode = posting.kode_sosmed', 'left');
		$this->db->join('tbl_master_user as user_approval', 'user_approval.id_user = posting.approval_user', 'left');

		$this->db->where("
			DATE(posting.tgl_posting)
			BETWEEN
			'{$data['tanggal_awal']}'
			AND
			'{$data['tanggal_akhir']}'
		");

		if($data['jenis'] == "sosmed_user") {

			if($data['session']['level'] == "Marketing") {
				$this->db->where('user.id_user', $data['session']['id_user']);
			}

			if(!empty($data['user'])) {
				if($data['user'] !== "All") {
					$this->db->where('user.id_user', $data['user']);
				}
			}

		} elseif($data['jenis'] == "sosmed_cabang") {

			if(($data['session']['level'] == "Marketing") || ($data['session']['level'] == "Supervisor")) {
				$this->db->where('cabang.id_cabang', $data['session']['cabang']);
			}

			if(!empty($data['cabang'])) {
				if($data['cabang'] !== "All") {
					$this->db->where('cabang.id_cabang', $data['cabang']);
				}
			}

		} elseif($data['jenis'] == "sosmed_sosmed") {

			if($data['session']['level'] == "Marketing") {
				$this->db->where('user.id_user', $data['session']['id_user']);
			}

			if(($data['session']['level'] == "Marketing") || ($data['session']['level'] == "Supervisor")) {
				$this->db->where('cabang.id_cabang', $data['session']['cabang']);
			}

			if(!empty($data['sosmed'])) {
				if($data['sosmed'] !== "All") {
					$this->db->where('sosmed.kode', $data['sosmed']);
				}
			}
			
		}

		return $this->db->get();
	}

	public function get_list_fu(array $id)
	{
		// FU
		$this->db->select('fu.id_fu, fu.id_user, fu.id_nasabah, fu.approval, fu.tanggal_fu, fu.lampiran_fu, fu.status, fu.hasil_fu');

		// User FU
		$this->db->select('user_fu.nama as user_fu');

		// User Approval
		$this->db->select('user_approval.nama as approver');

		// Jabatan
		$this->db->select('jabatan_fu.nama_jabatan');

		$this->db->from('tbl_follow_up as fu');

		$this->db->join(
			'tbl_master_user as user_fu',
			'user_fu.id_user = fu.id_user',
			'left'
		);

		$this->db->join(
			'tbl_master_jabatan as jabatan_fu',
			'jabatan_fu.id_jabatan = user_fu.id_jabatan',
			'left'
		);

		$this->db->join(
			'tbl_master_user as user_approval',
			'user_approval.id_user = fu.approval_user',
			'left'
		);
		
		$this->db->where_in('fu.id_nasabah', $id);

		$this->db->order_by('fu.id_fu');

		return $this->db->get();
	}


}

/* End of file Model_export.php */
/* Location: ./application/models/Model_export.php */ ?>