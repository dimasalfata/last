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
							<div class="d-flex justify-content-start">
								<div class="p-1">
									<button
										type="button"
										class="btn btn-sm btn-success"
										onclick="addPosting()"
									>
										<i class="fa fa-plus mr-1"></i>
										Tambah Posting
									</button>
								</div>

								<div class="p-1">
									<button
										type="button"
										class="btn btn-sm btn-info"
										onclick="tablePosting()"
									>
										<i class="fa fa-sync mr-1"></i>
										Refresh Data
									</button>
								</div>
							</div>
						</div>

						<div class="card-body">
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
                                            <!--
											<th>Approval</th>
-->
											<th class="text-center">Opsi</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
							
				</div>
			</div>
		</section>
	</div>
</div>

<!-- Modal Posting -->
<div class="modal fade" id="modal-posting" tabindex="-1" aria-labelledby="modal-title-posting" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-posting"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-body-posting"></div>
            </div>
            <div class="modal-footer" id="modal-footer-posting"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
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
	            url: "<?= site_url('posting/table_posting') ?>",
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
	          //  $('td', row).eq(7).addClass('text-center')
	        },
		})
	}

	function addPosting() {
		
		$.ajax({
			url: "<?= site_url('posting/page/add') ?>",
			method: "GET",

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
				$('#modal-posting').modal('show')
				$('#modal-body-posting').html(data)
			},

			error: ()=> {
				Swal.fire('Gagal', 'Ada kesalahan pada sistem', 'error')
			}
		})
	}

	function editPosting(id) {
		
		$.ajax({
			url: "<?= site_url('posting/page/edit') ?>",
			method: "POST",
			data: { id },

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
				$('#modal-posting').modal('show')
				$('#modal-body-posting').html(data)
			},

			error: ()=> {
				Swal.fire('Gagal', 'Ada kesalahan pada sistem', 'error')
			}
		})
	}

	function detailPosting(id) {
		
		$.ajax({
			url: "<?= site_url('posting/page/detail') ?>",
			method: "POST",
			data: { id },

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
				$('#modal-posting').modal('show')
				$('#modal-body-posting').html(data)
			},

			error: ()=> {
				Swal.fire('Gagal', 'Ada kesalahan pada sistem', 'error')
			}
		})
	}

	function deletePosting(id) {

		Swal.fire({
            title: `Konfirmasi`,
            text: `Hapus Posting?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Sekarang!',
            cancelButtonText: 'Tidak',
            reverseButtons: true,
            customClass: {
                confirmButton: 'btn-primary',
                cancelButton: 'btn-secondary'
            },
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        }).then((result)=> {
            if(result.value) {
                $.ajax({
					url: "<?= site_url('posting/process/delete') ?>",
					method: "POST",
					data: { id },

					beforeSend: ()=> {
						Swal.fire({
							title: 'Sedang diproses ...',
							text: 'Tunggu sebentar',
							didOpen: ()=> {
								Swal.showLoading()
							}
						})
					},

					success: (data)=> {
						Swal.fire({
							title: data.title,
							text: data.text,
							icon: data.icon
						}).then(() => {
							if(data.status) {
								tablePosting()
							}
						})
					},

					error: ()=> {
						Swal.fire('Gagal', 'Ada kesalahan pada sistem', 'error')
					}
				})
            }
        })
		
				
	}

</script>

<script type="text/javascript">
	$(document).ready(function() {
		tablePosting()
	})
</script>
