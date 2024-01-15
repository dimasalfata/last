<?php $this->load->view('sosmed/form'); ?>

<script type="text/javascript">
    $('#modal-title-sosmed').text(`<?= $title ?>`)
	$('#modal-footer-sosmed').html(`
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary" form="form-sosmed">Simpan</button>
	`)
</script>

<script type="text/javascript">
    $('#form-sosmed').on('submit', function(e) {
        e.preventDefault()

        Swal.fire({
            title: `Konfirmasi`,
            text: `Simpan Sosmed Baru?`,
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
                    url: "<?= site_url('sosmed/process/save') ?>",
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
                            	tableSosmed()
                            	$('#modal-sosmed').modal('hide')
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
