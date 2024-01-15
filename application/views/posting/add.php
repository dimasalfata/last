<?php $this->load->view('posting/form'); ?>

<script type="text/javascript">
    $('#modal-title-posting').text(`<?= $title ?>`)
	$('#modal-footer-posting').html(`
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary" form="form-posting">Simpan</button>
	`)
</script>

<script type="text/javascript">
    $('#form-posting').on('submit', function(e) {
        e.preventDefault()

        Swal.fire({
            title: `Konfirmasi`,
            text: `Simpan Posting Baru?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan Sekarang!',
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
                    url: "<?= site_url('posting/process/save') ?>",
                    method: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,

                    beforeSend: function(){
                        Swal.fire({
                            title: "Memproses",
                            text: "Silahkan Tunggu, Proses Memakan Waktu",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                    },

                    success: function(data){
                        Swal.fire({
                            title: data.title,
                            html: data.text,
                            icon: data.icon,
                        }).then(()=> {
                            if(data.status) {
                            	tablePosting()
                            	$('#modal-posting').modal('hide')
                            }
                        })
                    },

                    error: (req, status, error)=> {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Kesalahan pada sistem',
                            icon: 'error'
                        })
                    },

                });
            }
        })
    })
</script>
