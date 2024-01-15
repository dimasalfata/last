<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('model_approval', 'approval');
	}

	public function index()
	{
		$data['title'] = "Approval";

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('approval/index', $data, FALSE);
		$this->load->view('templates/footer');
	}

	public function table_fu()
	{
		$request = new stdClass();
		$request->user = (object) $this->session->userdata();

		$table = $this->approval->table_fu('table', $request);
		$filter = $this->approval->table_fu('filter', $request);
		$total = $this->approval->table_fu('total', $request);

		$no = $this->input->get('start');
		$data = [];
		foreach($table as $tables) {
			$no++;
			$td = [];

			$td[] = $no;
			$td[] = date('d/m/Y H:i:s', strtotime($tables->tanggal_fu));
			$td[] = $tables->marketing;
			$td[] = $tables->hasil_fu;
			$td[] = $tables->approval;
			$td[] = $tables->status;

			if(!empty($tables->lampiran_fu)) {

				$btnFile = "
					<div class='p-1'>
						<a
							class='btn btn-sm btn-success'
							target='_blank'
							href='".base_url($tables->lampiran_fu)."'
						>
							<i class='fa fa-paperclip'></i>
						</a>
					</div>
				";

			} else {

				$btnFile = "
					<div class='p-1'>
						<button
							type='button'
							class='btn btn-sm btn-danger'
							onclick='Swal.fire(`File Tidak Ada`, `Tidak ada file yang diupload`, `error`)'
						>
							<i class='fa fa-paperclip'></i>
						</button>
					</div>
				";

			}
			
			$btnProses = "
				<div class='p-1'>
					<button
						type='button'
						class='btn btn-sm btn-warning'
						onclick='prosesApproval(`fu`, {$tables->id_fu})'
					>
						<i class='fa fa-check-circle'></i>
					</button>
				</div>
			";

				
			$btn = "
				<div class='d-flex justify-content-center'>
					{$btnFile} {$btnProses}
				</div>
			";
			$td[] = $btn;

			$data[] = $td;
		}

		$output = [
			'draw' => $this->input->get('draw'),
			'recordsTotal' => $total,
			'recordsFiltered' => $filter,
			'data' => $data
		];

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function table_fu_kunjungan()
	{
		$request = new stdClass();
		$request->user = (object) $this->session->userdata();

		$table = $this->approval->table_fu_kunjungan('table', $request);
		$filter = $this->approval->table_fu_kunjungan('filter', $request);
		$total = $this->approval->table_fu_kunjungan('total', $request);

		$no = $this->input->get('start');
		$data = [];
		foreach($table as $tables) {
			$no++;
			$td = [];

			$td[] = $no;
			$td[] = date('d/m/Y H:i:s', strtotime($tables->tanggal_kunjungan));
			$td[] = $tables->marketing;
			$td[] = $tables->hasil_kunjungan;
			$td[] = $tables->status_fu;
			$td[] = $tables->approval;

			if(!empty($tables->lampiran_kunjungan)) {

				$btnFile = "
					<div class='p-1'>
						<a
							class='btn btn-sm btn-success'
							target='_blank'
							href='".base_url($tables->lampiran_kunjungan)."'
						>
							<i class='fa fa-paperclip'></i>
						</a>
					</div>
				";

			} else {

				$btnFile = "
					<div class='p-1'>
						<button
							type='button'
							class='btn btn-sm btn-danger'
							onclick='Swal.fire(`File Tidak Ada`, `Tidak ada file yang diupload`, `error`)'
						>
							<i class='fa fa-paperclip'></i>
						</button>
					</div>
				";

			}
			
			if(!empty($tables->latitude_kunjungan) && !empty($tables->longitude_kunjungan)) {

				$btnMap = "
					<div class='p-1'>
						<a
							class='btn btn-sm btn-primary'
							target='_blank'
							href='http://maps.google.com/maps?q={$tables->latitude_kunjungan}, {$tables->longitude_kunjungan}'
						>
							<i class='fa fa-map'></i>
						</a>
					</div>
				";

			} else {

				$btnMap = "
					<div class='p-1'>
						<button
							type='button'
							class='btn btn-sm btn-danger'
							onclick='Swal.fire(`Lokasi Tidak Ada`, `Tidak ada Lokasi yang terdeteksi`, `error`)'
						>
							<i class='fa fa-map'></i>
						</button>
					</div>
				";
			}
			

				$btnProses = "
					<div class='p-1'>
						<button
							type='button'
							class='btn btn-sm btn-warning'
							onclick='prosesApproval(`fu-kunjungan`, {$tables->id_follow_up_kunjungan})'
						>
							<i class='fa fa-check-circle'></i>
						</button>
					</div>
				";
			
				
			$btn = "
				<div class='d-flex justify-content-center'>
					{$btnFile} {$btnMap} {$btnProses}
				</div>
			";
			$td[] = $btn;

			$data[] = $td;
		}

		$output = [
			'draw' => $this->input->get('draw'),
			'recordsTotal' => $total,
			'recordsFiltered' => $filter,
			'data' => $data
		];

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function table_posting()
	{
		$request = new stdClass();
		$request->user = (object) $this->session->userdata();

		$table = $this->approval->table_posting('table', $request);
		$filter = $this->approval->table_posting('filter', $request);
		$total = $this->approval->table_posting('total', $request);

		$data = [];
		$no = $this->input->get('start');
		foreach($table as $tables) {
			$no++;
			$td = [];

			$td[] = $no;
			$td[] = $tables->user;
			$td[] = $tables->cabang;
			$td[] = date('d/m/Y', strtotime($tables->tgl_posting));
			$td[] = $tables->sosmed;
			
			$td[] = "
				<a href='{$tables->link}' target='_blank' class='text-decoration-none'>Kunjungi Link</a>
			";

			$td[] = $tables->approval;

			if($request->user->level === "Marketing") {
				$btnProses = "";

			} else {

				$btnProses = "
					<div class='p-1'>
						<button
							type='button'
							class='btn btn-sm btn-warning'
							onclick='prosesApproval(`posting`, {$tables->id})'
						>
							<i class='fa fa-check-circle'></i>
						</button>
					</div>
				";
			}

			$btn = "
				<div class='d-flex justify-content-center'>
					{$btnProses}
				</div>
			";
			$td[] = $btn;

			$data[] = $td;
		}

		$output = [
			'draw' => $this->input->get('draw'),
			'recordsTotal' => $total,
			'recordsFiltered' => $filter,
			'data' => $data
		];

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function process()
	{
		$type = $this->input->get('type');
		$data['type'] = $type;

		$id = $this->input->get('id');
		$data['id'] = $id;

		$data['title'] = "Proses Approval";

		if($type === "fu") {

			$fu_type = $this->check_fu_type($id);
			$data['fu_type'] = $fu_type;

			$fu = $this->approval->fu($id, $fu_type)->row();
			if(!$fu) {
				return show_404();
			}

			$data['fu'] = $fu;


		} elseif($type === "fu-kunjungan") {

			$fu = $this->approval->fu_kunjungan($id)->row();
			if(!$fu) {
				return show_404();
			}

			$data['fu'] = $fu;

		} elseif($type === "posting") {

			$fu = $this->approval->posting($id)->row();
			if(!$fu) {
				return show_404();
			}

			$data['fu'] = $fu;

		} else {
			return show_404();
		}

		return $this->load->view('approval/process', $data, FALSE);
	}

	public function update()
	{
		$type = $this->input->post('type');
		$id = $this->input->post('id');
		$approval = $this->input->post('approval');

		$user = (object) $this->session->userdata();

		$data['approval'] = $approval;
		$data['approval_user'] = $user->id_user;

		if($type === "fu") {

			$fu_update = $this->db->update('tbl_follow_up', $data, ['id_fu' => $id]);
			$fu = $this->db->get_where('tbl_follow_up', ['id_fu' => $id])->row();

			if($approval == "disetujui") {
				if($fu->status == 'Follow UP') {

					$id_nasabah = $this->db->select('id_nasabah')->get_where('tbl_follow_up', ['id_fu' => $id])->row()->id_nasabah;
					$this->db->where('id_nasabah', $id_nasabah);
					$this->db->update('tbl_nasabah', array('status_nasabah' =>'Follow UP'));
				}

				if($fu->status == 'Realisasi') {

					$dataNasabah = [
						'id_user_deal' => $fu->id_user,
						'no_referensi' => $fu->hasil_fu,
						'tgl_realisasi' => date('Y-m-d H:i:s'),
						'status_nasabah' => $fu->status,
					];

					$updateNasabah = $this->db->update('tbl_nasabah', $dataNasabah, ['id_nasabah' => $fu->id_nasabah]);

					$dataHistory = [
						'id_user' => $user->id_user, 
						'ip_address'=> $this->input->ip_address(),
						'aktivitas' => "Realisasi Nasabah {$fu->id_nasabah}",
					];
					$insertHistory = $this->db->insert('tbl_history', $dataHistory);
				}
			}
				
		} elseif($type === "fu-kunjungan") {
			
			$fu_update = $this->db->update('tbl_follow_up_kunjungan', $data, ['id_follow_up_kunjungan' => $id]);

			if($approval == "disetujui") {
				$kunjungan = $this->db->select('id_kunjungan, status_fu')->get_where('tbl_follow_up_kunjungan', ['id_follow_up_kunjungan' => $id])->row();

				$this->db->where('id_kunjungan', $kunjungan->id_kunjungan);
				$this->db->update('tbl_kunjungan_nasabah', array('status_kolektibilitas' => $kunjungan->status_fu));
			}

		} elseif($type === "posting") {
			
			$fu_update = $this->db->update('tbl_posting', $data, ['id' => $id]);

		} else {
			return show_404();
		}

		if($fu_update) {
			$status = TRUE;
			$icon = "success";
			$title = "Berhasil";
			$text = "Status Approval menjadi {$approval}!";
		
		} else {
			$status = FALSE;
			$icon = "error";
			$title = "Gagal";
			$text = "Status Approval gagal diperbarui!";
		}

		$output['status'] = $status;
		$output['icon'] = $icon;
		$output['title'] = $title;
		$output['text'] = $text;

		return $this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	private function check_fu_type($id_fu)
	{
		$fu = $this->db->select('fu.id_nasabah')
						->from('tbl_follow_up fu')
						->where('fu.id_fu', $id_fu)
						->get()->row();

		$type = $this->db->select('id_pengajuan')
						->from('tbl_pengajuan')
						->where('kode_pengajuan', $fu->id_nasabah)
						->get()->num_rows();
		if($type > 0) {
			return "pengajuan";
		}

		$type = $this->db->select('id_nasabah')
						->from('tbl_nasabah')
						->where('id_nasabah', $fu->id_nasabah)
						->get()->num_rows();
		if($type > 0) {
			return "nasabah";
		}
	}
}
