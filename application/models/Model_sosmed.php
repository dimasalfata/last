<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_sosmed extends CI_Model {

	/**
	 * Get DataTable Sosmed
	 * 
	 * @param string $type
	 * 
	 * @return mixed
	 * */
	public function table_sosmed($type)
	{
		$sort = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'created_at';

		$order = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';

		if(($type == "table") || ($type == "filter")) {
			$awal 	= $this->input->get('length');
			$akhir 	= $this->input->get('start');
			$sv 	= strtolower($_GET['search']['value']);

			if($sv) {

				$search = $sv;
				$cari = 
				'
					sosmed.kode LIKE ' . "'%" . $search . "%'" . '
					OR
					sosmed.nama LIKE ' . "'%" . $search . "%'" . '
				';
				$k_search = $this->db->where("($cari)");

			} else {
				$k_search = "";
			}
		}
			
		$this->db->select('sosmed.id, sosmed.kode, sosmed.nama');

		$this->db->from('tbl_master_sosmed as sosmed');

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

}

/* End of file Model_sosmed.php */
/* Location: ./application/models/Model_sosmed.php */
