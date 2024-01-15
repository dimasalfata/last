<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_posting extends CI_Model {

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
					user.nama LIKE ' . "'%" . $search . "%'" . '
					OR
					user_approval.nama LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->select('
			posting.id, posting.link, posting.tgl_posting, posting.created_at, posting.updated_at,
			posting.approval
		');

		// User
		$this->db->select('user.nama as user, user.id_user');

		// User Approval
		$this->db->select('user_approval.nama as approval_user');

		// Cabang
		$this->db->select('cabang.id_cabang, cabang.nama_cabang as cabang');

		// Sosmed
		$this->db->select('sosmed.nama as sosmed');

		$this->db->from('tbl_posting as posting');
		$this->db->join('tbl_master_user as user', 'user.id_user = posting.id_user', 'left');
		$this->db->join('tbl_master_cabang as cabang', 'cabang.id_cabang = user.id_cabang', 'left');
		$this->db->join('tbl_master_sosmed as sosmed', 'sosmed.kode = posting.kode_sosmed', 'left');
		$this->db->join('tbl_master_user as user_approval', 'user_approval.id_user = posting.approval_user', 'left');

		$this->db->where_in('posting.approval', ['disetujui', 'ditolak']);

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

	/**
	 * Get Detail Posting
	 * 
	 * @param int $id
	 * 
	 * @return mixed
	 * */
	public function detail(int $id)
	{
		// Posting
		$this->db->select('
			posting.link, posting.tgl_posting,
			posting.approval, posting.created_at, posting.updated_at
		');

		// User
		$this->db->select('user.nama as user');

		// User Approval
		$this->db->select('user_approval.nama as approval_user');

		// Cabang
		$this->db->select('cabang.nama_cabang as cabang');

		// Sosmed
		$this->db->select('sosmed.nama as sosmed');

		$this->db->from('tbl_posting as posting');
		$this->db->join('tbl_master_user as user', 'user.id_user = posting.id_user', 'left');
		$this->db->join('tbl_master_cabang as cabang', 'cabang.id_cabang = user.id_cabang', 'left');
		$this->db->join('tbl_master_sosmed as sosmed', 'sosmed.kode = posting.kode_sosmed', 'left');
		$this->db->join('tbl_master_user as user_approval', 'user_approval.id_user = posting.approval_user', 'left');

		$this->db->where('posting.id', $id);

		return $this->db->get();
	}

	/**
	 * Query for Search data
	 * 
	 * @param string $type
	 * @param object $request
	 * 
	 * @return mixed
	 * */
	public function search(string $type, object $request)
	{
		if($type === "user") {

			$this->db->select('id_user as id, nama as text');
			$this->db->from('tbl_master_user');

			if($request->user->level === "Marketing") {
				$this->db->where('id_user', $request->user->id_user);
			
			} elseif($request->user->level === "Supervisor") {
				$this->db->where('id_cabang', $request->user->cabang);
			}

			$this->db->like('nama', $request->search, 'BOTH');
			$this->db->limit(10);
			$this->db->order_by('nama', 'asc');

		} elseif($type === "cabang") {

			$this->db->select('id_cabang as id, nama_cabang as text');
			$this->db->from('tbl_master_cabang');

			if($request->user->level === "Supervisor") {
				$this->db->where('id_cabang', $request->user->cabang);
			}

			$this->db->like('nama_cabang', $request->search, 'BOTH');
			$this->db->limit(10);
			$this->db->order_by('nama_cabang', 'asc');

		} elseif($type === "sosmed") {

			$this->db->select('kode as id, nama as text');
			$this->db->from('tbl_master_sosmed');
			$this->db->like('nama', $request->search, 'BOTH');
			$this->db->limit(10);
			$this->db->order_by('nama', 'asc');

		} else {
			return FALSE;
		}

		return $this->db->get();
	}

}
