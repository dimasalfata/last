<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sosmed extends CI_Controller {

	/**
	 * Define Constructor
	 * */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Model_sosmed', 'sosmed');
	}

	/**
	 * Show Index Page
	 * 
	 * @return view
	 * */
	public function index()
	{
		$data['title'] = "Master Sosmed";

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('sosmed/index', $data, FALSE);
		$this->load->view('templates/footer');
	}

	/**
	 * Show Datatable Sosmed
	 * 
	 * @return JSON
	 * */
	public function table_sosmed()
	{
		$table = $this->sosmed->table_sosmed('table');
		$filter = $this->sosmed->table_sosmed('filter');
		$total = $this->sosmed->table_sosmed('total');

		$data = [];
		$no = $this->input->get('start');
		foreach($table as $tables) {
			$no++;
			$td = [];

			$td[] = $no;
			$td[] = $tables->nama;
			$td[] = $tables->kode;

			$btnEdit = "
				<button
					type='button'
					class='btn btn-sm btn-warning'
					title='Edit Sosmed'
					onclick='editSosmed({$tables->id})'
				>
					<i class='fa fa-edit'></i>
				</button>
			";
			$btnDelete = "
				<button
					type='button'
					class='btn btn-sm btn-danger'
					title='Delete Sosmed'
					onclick='deleteSosmed({$tables->id})'
				>
					<i class='fa fa-trash'></i>
				</button>
			";
			$btn = "
				<div class='d-flex justify-content-center'>
					<div class='p-1'>{$btnEdit}</div>
					<div class='p-1'>{$btnDelete}</div>
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

	/**
	 * Show Page base on Request
	 * 
	 * @param string $page
	 * 
	 * @return mixed
	 * */
	public function page($page)
	{
		if(empty($page)) {
			return false;
		}

		if($page === "add") {

			$data['title'] = "Tambah SOSMED";
			$data['type'] = "add";
			return $this->load->view('sosmed/add', $data, FALSE);

		} elseif($page === "edit") {

			$id = $this->input->post('id');

			$sosmed = $this->db->get_where('tbl_master_sosmed', ['id' => $id])->row();
			if(!$sosmed) {
				return false;
			}

			$data['sosmed'] = $sosmed;

			$data['title'] = "Edit SOSMED";
			$data['type'] = "edit";
			return $this->load->view('sosmed/edit', $data, FALSE);
		} else {
			return false;
		}
	}

	/**
	 * Process data based on method
	 * 
	 * @param string $method
	 * 
	 * @return JSON
	 * */
	public function process($method)
	{
		if(empty($method)) {
			return false;
		}

		if($method === "save") {

			// Set Up Validation
			$this->_rules_validation($method);

			if ($this->form_validation->run() === TRUE) {

				$request = (object) $this->input->post();

				$data['kode'] = $request->kode;
				$data['nama'] = $request->nama;

				$sosmed = $this->db->insert('tbl_master_sosmed', $data);
				if($sosmed) {
					$status = TRUE;
					$icon = "success";
					$title = "Berhasil";
					$text = "Data SOSMED berhasil disimpan!";
				
				} else {
					$status = FALSE;
					$icon = "error";
					$title = "Gagal";
					$text = "Data SOSMED gagal disimpan!";
				}

			} else {
				
				$status = FALSE;
				$icon = "error";
				$title = "Gagal";
				$text = $this->form_validation->error_string();
			}

		} elseif($method === "update") {

			$request = (object) $this->input->post();
			
			$sosmed = $this->db->get_where('tbl_master_sosmed', ['id' => $request->id])->row();

			// Set Up Validation
			$this->_rules_validation($method, $sosmed, $request);

			if ($this->form_validation->run() === TRUE) {

				$data['kode'] = $request->kode;
				$data['nama'] = $request->nama;
				$data['updated_at'] = date('Y-m-d H:i:s');

				$sosmed = $this->db->update('tbl_master_sosmed', $data, ['id' => $request->id]);
				if($sosmed) {
					$status = TRUE;
					$icon = "success";
					$title = "Berhasil";
					$text = "Data SOSMED berhasil diperbarui!";
				
				} else {
					$status = FALSE;
					$icon = "error";
					$title = "Gagal";
					$text = "Data SOSMED gagal diperbarui!";
				}

			} else {
				
				$status = FALSE;
				$icon = "error";
				$title = "Gagal";
				$text = $this->form_validation->error_string();
			}

		} elseif($method === "delete") {

			$id = $this->input->post('id');

			$sosmed = $this->db->delete('tbl_master_sosmed', ['id' => $id]);
			if($sosmed) {
				$status = TRUE;
				$icon = "success";
				$title = "Berhasil";
				$text = "Data SOSMED berhasil dihapus!";
			
			} else {
				$status = FALSE;
				$icon = "error";
				$title = "Gagal";
				$text = "Data SOSMED gagal dihapus!";
			}

		} else {
			return false;
		}

		$output['status'] = $status;
		$output['icon'] = $icon;
		$output['title'] = $title;
		$output['text'] = $text;

		return $this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Set Up the validation rules
	 * 
	 * @param string $method
	 * @param object $sosmed
	 * @param object $request
	 * 
	 * @return void
	 * */
	private function _rules_validation($method = "save", $sosmed = null, $request = null)
	{
		$this->form_validation->set_rules('nama', 'nama Sosmed', 'trim|required|min_length[2]|max_length[255]');

		if($method === "save") {
			$this->form_validation->set_rules('kode', 'Kode Sosmed', 'trim|required|is_unique[tbl_master_sosmed.kode]|min_length[2]|max_length[30]');

		} elseif($method === "update") {
			$this->form_validation->set_rules('id', 'ID Sosmed', 'required');

			if($sosmed->kode !== $request->kode) {
				$this->form_validation->set_rules('kode', 'Kode Sosmed', 'trim|required|is_unique[tbl_master_sosmed.kode]|min_length[2]|max_length[30]');
			}

		}
	}

}

/* End of file Sosmed.php */
/* Location: ./application/controllers/Sosmed.php */
