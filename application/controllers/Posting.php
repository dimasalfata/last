<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posting extends CI_Controller {

	/**
	 * Define Constructor
	 * */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('model_posting', 'posting');
	}

	/**
	 * Show Index Page
	 * 
	 * @return view
	 * */
	public function index()
	{
		$data['title'] = "Posting Posting";

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('posting/index', $data, FALSE);
		$this->load->view('templates/footer');
	}

	/**
	 * Show Datatable Posting
	 * 
	 * @return JSON
	 * */
	public function table_posting()
	{
		$request = new stdClass();
		$request->user = (object) $this->session->userdata();

		$table = $this->posting->table_posting('table', $request);
		$filter = $this->posting->table_posting('filter', $request);
		$total = $this->posting->table_posting('total', $request);

		$data = [];
		$no = $this->input->get('start');
		foreach($table as $tables) {
			$no++;
			$td = [];

			$td[] = $no;
			$td[] = $tables->user;
			$td[] = "[{$tables->id_cabang}] {$tables->cabang}";
			$td[] = date('d/m/Y', strtotime($tables->tgl_posting));
			$td[] = $tables->sosmed;
			
			$td[] = "
				<a href='{$tables->link}' target='_blank' class='text-decoration-none'>Kunjungi Link</a>
			";
// Disable kolom approval di menu posting
			/** 

			$td[] = $tables->approval;
			*/
			$btnDetail = "
				<button
					type='button'
					class='btn btn-sm btn-success'
					title='Detail Posting'
					onclick='detailPosting({$tables->id})'
				>
					<i class='fa fa-eye'></i>
				</button>
			";
/**
			 * Disable Button Edit & Delete di Menu Posting
			$btnEdit = "
				<button
					type='button'
					class='btn btn-sm btn-warning'
					title='Edit Posting'
					onclick='editPosting({$tables->id})'
				>
					<i class='fa fa-edit'></i>
				</button>
			";
			$btnDelete = "
				<button
					type='button'
					class='btn btn-sm btn-danger'
					title='Delete Posting'
					onclick='deletePosting({$tables->id})'
				>
					<i class='fa fa-trash'></i>
				</button>
			";
			*/

			if($request->user->id_user !== $tables->id_user) {
				$btnEdit = "";
				$btnDelete = "";
			}

			$btn = "
				<div class='d-flex justify-content-center'>
					<div class='p-1'>{$btnDetail}</div>
				</div>
			";

/** 
			 * Disable Button Edit & Delete di Menu Posting
			$btn = "
				<div class='d-flex justify-content-center'>
					<div class='p-1'>{$btnDetail}</div>
					<div class='p-1'>{$btnEdit}</div>
					<div class='p-1'>{$btnDelete}</div>
				</div>
			";
			*/


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

			$sosmeds = $this->db->get('tbl_master_sosmed')->result();
			$data['sosmeds'] = $sosmeds;

			$data['title'] = "Tambah Posting";
			$data['type'] = "add";
			return $this->load->view('posting/add', $data, FALSE);

		} elseif($page === "edit") {

			$id = $this->input->post('id');

			$posting = $this->db->get_where('tbl_posting', ['id' => $id])->row();
			if(!$posting) {
				return false;
			}

			$data['posting'] = $posting;

			$sosmeds = $this->db->get('tbl_master_sosmed')->result();
			$data['sosmeds'] = $sosmeds;

			$data['title'] = "Edit Posting";
			$data['type'] = "edit";
			return $this->load->view('posting/edit', $data, FALSE);

		} elseif($page === "detail") {

			$id = $this->input->post('id');

			$posting = $this->posting->detail($id)->row();
			if(!$posting) {
				return false;
			}

			$data['posting'] = $posting;

			$data['title'] = "Detail Posting";
			return $this->load->view('posting/detail', $data, FALSE);
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

				$data['id_user'] = $this->session->userdata('id_user');
				$data['kode_sosmed'] = $request->kode_sosmed;
				$data['tgl_posting'] = $request->tgl_posting;
				$data['link'] = rtrim($request->link, '/');
                
                // Disable Approval Posting Aktifkan Apabila inngin menabahkan approval ketika posting
				/**

				$approval = "disetujui";
				$approval_user = $this->session->id_user;
				if($this->session->level === "Marketing") {
					$approval = "pending";
					$approval_user = null;
				}

				$data['approval'] = $approval;
				$data['approval_user'] = $approval_user;

                **/
				$posting = $this->db->insert('tbl_posting', $data);
				if($posting) {
					$status = TRUE;
					$icon = "success";
					$title = "Berhasil";
					$text = "Data Posting berhasil disimpan!";
				
				} else {
					$status = FALSE;
					$icon = "error";
					$title = "Gagal";
					$text = "Data Posting gagal disimpan!";
				}

			} else {
				
				$status = FALSE;
				$icon = "error";
				$title = "Gagal";
				$text = $this->form_validation->error_string();
			}

		} elseif($method === "update") {

			$request = (object) $this->input->post();
			
			$posting = $this->db->get_where('tbl_posting', ['id' => $request->id])->row();

			// Set Up Validation
			$this->_rules_validation($method, $posting, $request);

			if ($this->form_validation->run() === TRUE) {

				$data['kode_sosmed'] = $request->kode_sosmed;
				$data['tgl_posting'] = $request->tgl_posting;
				$data['link'] = rtrim($request->link, '/');
				$data['updated_at'] = date('Y-m-d H:i:s');

				$posting = $this->db->update('tbl_posting', $data, ['id' => $request->id]);
				if($posting) {
					$status = TRUE;
					$icon = "success";
					$title = "Berhasil";
					$text = "Data Posting berhasil diperbarui!";
				
				} else {
					$status = FALSE;
					$icon = "error";
					$title = "Gagal";
					$text = "Data Posting gagal diperbarui!";
				}

			} else {
				
				$status = FALSE;
				$icon = "error";
				$title = "Gagal";
				$text = $this->form_validation->error_string();
			}

		} elseif($method === "delete") {

			$id = $this->input->post('id');

			$posting = $this->db->delete('tbl_posting', ['id' => $id]);
			if($posting) {
				$status = TRUE;
				$icon = "success";
				$title = "Berhasil";
				$text = "Data Posting berhasil dihapus!";
			
			} else {
				$status = FALSE;
				$icon = "error";
				$title = "Gagal";
				$text = "Data Posting gagal dihapus!";
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
	 * Search Section for Report
	 * */

	/**
	 * Search User
	 * */
	public function search_user()
	{
		$request = (object) $this->input->get();
		$request->search = $request->q ?? '';
		$request->user = (object) $this->session->userdata();

		$query = $this->posting->search("user", $request)->result();
		
		$results = [];
		if(empty($request->search)) {
			$results = [
				[
					'id' => 'All',
					'text' => 'All'
				]
			];
		}
			
		foreach($query as $queries) {
			$results[] = [
				'id' => $queries->id,
				'text' => $queries->text,
			];
		}

		$output['results'] = $results;
		return $this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Search Cabang
	 * */
	public function search_cabang()
	{
		$request = (object) $this->input->get();
		$request->search = $request->q ?? '';
		$request->user = (object) $this->session->userdata();

		$query = $this->posting->search("cabang", $request)->result();
		
		$results = [];
		if(empty($request->search)) {
			$results = [
				[
					'id' => 'All',
					'text' => 'All'
				]
			];
		}

		foreach($query as $queries) {
			$results[] = [
				'id' => $queries->id,
				'text' => $queries->text,
			];
		}

		$output['results'] = $results;
		return $this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Search Sosmed
	 * */
	public function search_sosmed()
	{
		$request = (object) $this->input->get();
		$request->search = $request->q ?? '';
		$request->user = (object) $this->session->userdata();

		$query = $this->posting->search("sosmed", $request)->result();
		
		$results = [];
		if(empty($request->search)) {
			$results = [
				[
					'id' => 'All',
					'text' => 'All'
				]
			];
		}

		foreach($query as $queries) {
			$results[] = [
				'id' => $queries->id,
				'text' => $queries->text,
			];
		}

		$output['results'] = $results;
		return $this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Set Up the validation rules
	 * 
	 * @param string $method
	 * @param object $posting
	 * @param object $request
	 * 
	 * @return void
	 * */
	private function _rules_validation($method = "save", $posting = null, $request = null)
	{
		$this->form_validation->set_rules('kode_sosmed', 'Sosmed', 'required');
		$this->form_validation->set_rules('tgl_posting', 'Tgl Posting', 'required');

		if($method === "save") {
			$this->form_validation->set_rules('link', 'Link Posting', 'rtrim[/]|required|valid_url|is_unique[tbl_posting.link]');

		} elseif($method === "update") {
			$this->form_validation->set_rules('id', 'ID Posting', 'required');

			if($posting->link !== $request->link) {
				$this->form_validation->set_rules('link', 'Link Posting', 'rtrim[/]|required|valid_url|is_unique[tbl_posting.link]');
			}

		}
	}

}
