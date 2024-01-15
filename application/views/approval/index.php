<div class="main-panel">
	<div class="content">
		
		<section class="content-header">
			<div class="container-fluid">
				<div class="row row-cols-1 mb-3">
					<div class="col">
						<h4 class="text-dark"><?= $title ?></h4>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="row">
				<div class="col-12 mb-3">

					<div class="card">

						<div class="card-header">
							<ul class="nav nav-tabs" id="approval-tab" role="tablist">
							    <li class="nav-item" role="presentation">
							        <button class="nav-link active" id="fu-tab" data-toggle="tab" data-target="#fu" type="button" role="tab" aria-controls="fu" aria-selected="true">Follow Up Potensi</button>
							    </li>
							    <li class="nav-item" role="presentation">
							        <button class="nav-link" id="fu-kunjungan-tab" data-toggle="tab" data-target="#fu-kunjungan" type="button" role="tab" aria-controls="fu-kunjungan" aria-selected="false">Follow Up Kunjungan</button>
							    </li>
                                <!--
								Disable Sub Menu Approvel Posting

							    <li class="nav-item" role="presentation">
							        <button class="nav-link" id="fu-tab" data-toggle="tab" data-target="#posting" type="button" role="tab" aria-controls="posting" aria-selected="true">Posting Sosmed</button>
							    </li>
                                -->
							</ul>
						</div>

						<div class="card-body">
							<div class="tab-content" id="myTabContent">
							    <div class="tab-pane fade show active" id="fu" role="tabpanel" aria-labelledby="fu-tab">
							    	<div class="table-responsive">
										<table class="table table-sm table-bordered table-hover w-100" id="table-fu">
											<thead>
												<tr class="bg-primary text-white">
													<th class="text-right">No</th>
													<th class="text-center">Tanggal</th>
													<th>Marketing</th>
													<th>Hasil</th>
													<th class="text-center">Approval</th>
													<th class="text-center">Tipe</th>
													<th class="text-center">Opsi</th>
												</tr>
											</thead>
										</table>
									</div>
							    </div>
							    <div class="tab-pane fade" id="fu-kunjungan" role="tabpanel" aria-labelledby="fu-kunjungan-tab">
							    	<div class="table-responsive">
										<table class="table table-sm table-bordered table-hover w-100" id="table-fu-kunjungan">
											<thead>
												<tr class="bg-primary text-white">
													<th class="text-right">No</th>
													<th class="text-center">Tanggal</th>
													<th>Marketing</th>
													<th>Hasil</th>
													<th class="text-center">Status</th>
													<th class="text-center">Approval</th>
													<th class="text-center">Opsi</th>
												</tr>
											</thead>
										</table>
									</div>
							    </div>
							    <div class="tab-pane fade" id="posting" role="tabpanel" aria-labelledby="posting-tab">
							    	<div class="table-responsive">
										<table class="table table-sm table-bordered table-hover w-100" id="table-posting">
											<thead>
												<tr class="bg-primary text-white">
													<th class="text-right">No</th>
													<th>Pegawai</th>
													<th>Cabang</th>
													<th class="text-center">Tgl Posting</th>
													<th>SOSMED</th>
													<th class="text-center">Link</th>
													<th class="text-center">Approval</th>
													<th class="text-center">Opsi</th>
												</tr>
											</thead>
										</table>
									</div>
							    </div>
							</div>
						</div>

					</div>

				</div>
			</div>
		</section>
	</div>
</div>

<!-- Modal Sosmed -->
<div class="modal fade" id="modal-approval" tabindex="-1" aria-labelledby="modal-title-approval" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-approval"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-body-approval"></div>
            </div>
            <div class="modal-footer" id="modal-footer-approval"></div>
        </div>
    </div>
</div>

<script type="text/javascript">

	function tableFu() {
		let tableFu = $('#table-fu').DataTable({
			responsive: true,
			destroy: true,
			order: [1, 'desc'],
	        pageLength: 5,
	        lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
	        processing: true,
	        serverSide: true,
	        ajax: {
	            url: "<?= site_url('approval/table_fu') ?>",
	            method: "get",
	        },
	        language: {
	            searchPlaceholder: 'Cari Sesuatu...'
	        },
	        columnDefs: [
	            {
	                targets: [-1],
	                orderable: false,
	            },
	        ],
	        initComplete: (settings, json)=> {
	            $('.dataTables_paginate').addClass('pagination-sm');
	        },
	        rowCallback: function(row, data, index) {
	            let tableData = [['row', row], ['data', data], ['index', index]]

	            $('td', row).eq(0).addClass('text-right')
	            $('td', row).eq(1).addClass('text-center')
	            $('td', row).eq(4).addClass('text-center')
	            $('td', row).eq(5).addClass('text-center')
	        },
		})
	}

	function tableFuKunjungan() {
		let tableFuKunjungan = $('#table-fu-kunjungan').DataTable({
			responsive: true,
			destroy: true,
			order: [1, 'desc'],
	        pageLength: 5,
	        lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
	        processing: true,
	        serverSide: true,
	        ajax: {
	            url: "<?= site_url('approval/table_fu_kunjungan') ?>",
	            method: "get",
	        },
	        language: {
	            searchPlaceholder: 'Cari Sesuatu...'
	        },
	        columnDefs: [
	            {
	                targets: [-1],
	                orderable: false,
	            },
	        ],
	        initComplete: (settings, json)=> {
	            $('.dataTables_paginate').addClass('pagination-sm');
	        },
	        rowCallback: function(row, data, index) {
	            let tableData = [['row', row], ['data', data], ['index', index]]

	            $('td', row).eq(0).addClass('text-right')
	            $('td', row).eq(1).addClass('text-center')
	            $('td', row).eq(4).addClass('text-center')
	            $('td', row).eq(5).addClass('text-center')
	            $('td', row).eq(6).addClass('text-center')
	        },
		})
	}

	function tablePosting() {
		let tablePosting = $('#table-posting').DataTable({
			responsive: true,
			destroy: true,
			order: [3, 'desc'],
	        pageLength: 5,
	        lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
	        processing: true,
	        serverSide: true,
	        ajax: {
	            url: "<?= site_url('approval/table_posting') ?>",
	            method: "get",
	        },
	        language: {
	            searchPlaceholder: 'Cari Sesuatu...'
	        },
	        columnDefs: [
	            {
	                targets: [-1],
	                orderable: false,
	            },
	        ],
	        initComplete: (settings, json)=> {
	            $('.dataTables_paginate').addClass('pagination-sm');
	        },
	        rowCallback: function(row, data, index) {
	            let tableData = [['row', row], ['data', data], ['index', index]]

	            $('td', row).eq(0).addClass('text-right')
	            $('td', row).eq(3).addClass('text-center')
	            $('td', row).eq(5).addClass('text-center')
	            $('td', row).eq(6).addClass('text-center')
	            $('td', row).eq(7).addClass('text-center')
	        },
		})
	}

	function prosesApproval(type, id) {

		$.ajax({
			url: "<?= site_url('approval/process') ?>",
			method: "GET",
			data: { type, id },

			beforeSend: ()=> {
				Swal.fire({
					title: 'Memuat ...',
					text: 'Silahkan tunggu sebentar',
					didOpen: ()=> {
						Swal.showLoading()
					}
				})
			},

			success: (data)=> {
				Swal.close()
				$('#modal-approval').modal('show')
				$('#modal-body-approval').html(data)
			},

			error: ()=> {
				Swal.fire('Gagal', 'Ada kesalahan pada sistem', 'error')
			}
		})
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		tableFu()
		tableFuKunjungan()
		tablePosting()
	})
</script>
