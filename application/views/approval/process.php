<?php $user = (object) $this->session->userdata(); ?>

<?php if($type === "fu") : ?>
    <div class="row row-cols-1 row-cols-md-2 mb-3">

        <?php if($fu_type === "nasabah") : ?>

            <div class="col">
                <table class="table table-sm table-borderless">
                    <tr>
                        <th>Nama Nasabah</th>
                        <td><?= $fu->nama_nasabah ?></td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td><?= $fu->telp_nasabah ?></td>
                    </tr>
                    <tr>
                        <th>Usaha</th>
                        <td><?= $fu->usaha_nasabah ?></td>
                    </tr>
                    <tr>
                        <th>Omset</th>
                        <td>Rp. <?= number_format($fu->omset_nasabah) ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?= $fu->alamat_nasabah ?></td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table class="table table-sm table-borderless">
                    <tr>
                        <th>Provinsi</th>
                        <td><?= $fu->provinsi ?></td>
                    </tr>
                    <tr>
                        <th>Kabupaten</th>
                        <td><?= $fu->kabupaten ?></td>
                    </tr>
                    <tr>
                        <th>Kecamatan</th>
                        <td><?= $fu->kecamatan ?></td>
                    </tr>
                    <tr>
                        <th>Kelurahan</th>
                        <td><?= $fu->kelurahan ?></td>
                    </tr>
                </table>
            </div>

        <?php elseif($fu_type === "pengajuan") : ?>

            <div class="col">
                <table class="table table-sm table-borderless">
                    <tr>
                        <th>Produk</th>
                        <td><?= $fu->nama_produk ?></td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td><?= $fu->nik ?></td>
                    </tr>
                    <tr>
                        <th>No. HP/Telp/WA</th>
                        <td><?= $fu->no_hp ?></td>
                    </tr>
                    <tr>
                        <th>Nama Suami / Istri</th>
                        <td><?= $fu->nama_suami_istri ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?= $fu->alamat_rumah ?></td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table class="table table-sm table-borderless">
                    <tr>
                        <th>Nama Usaha</th>
                        <td><?= $fu->nama_usaha_pekerjaan ?></td>
                    </tr>
                    <tr>
                        <th>Nama Nasabah</th>
                        <td><?= $fu->nama ?></td>
                    </tr>
                    <tr>
                        <th>Omset</th>
                        <td>Rp. <?= number_format($fu->omset_usaha) ?></td>
                    </tr>
                    <tr>
                        <th>Plafon</th>
                        <td>Rp. <?= number_format($fu->omset_usaha) ?></td>
                    </tr>
                    <tr>
                        <th>Alamat Usaha</th>
                        <td><?= $fu->alamat_usaha_pekerjaan ?></td>
                    </tr>
                </table>
            </div>

        <?php endif ?>
    </div>

    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover w-100">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="text-center">Tanggal</th>
                    <th>Marketing</th>
                    <th>Hasil</th>
                    <th class="text-center">Approval</th>
                    <th class="text-center">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center"><?= date('d/m/Y H:i:s', strtotime($fu->tanggal_fu)) ?></td>
                    <td><?= $fu->marketing ?></td>
                    <td><?= $fu->hasil_fu ?></td>
                    <td class="text-center"><?= $fu->approval ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <div class='p-1'>

                                <?php if(!empty($fu->lampiran_fu)) : ?>
                                    <a
                                        class='btn btn-sm btn-success'
                                        target='_blank'
                                        href='<?= base_url($fu->lampiran_fu) ?>'
                                    >
                                        <i class='fa fa-paperclip'></i>
                                    </a>
                                <?php else : ?>
                                    <button
                                        type='button'
                                        class='btn btn-sm btn-danger'
                                        onclick='Swal.fire(`File Tidak Ada`, `Tidak ada file yang diupload`, `error`)'
                                    >
                                        <i class='fa fa-paperclip'></i>
                                    </button>
                                <?php endif ?>
                                    
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

<?php elseif($type === "fu-kunjungan") :  ?>

    <div class="row row-cols-1 row-cols-md-2 mb-3">
        <div class="col">
            <table class="table table-sm table-borderless">
                <tr>
                    <th>Nama Nasabah</th>
                    <td><?= $fu->nama_nasabah ?></td>
                </tr>
                <tr>
                    <th>No. Rekening</th>
                    <td><?= $fu->no_rekening ?></td>
                </tr>
                <tr>
                    <th>Plafon</th>
                    <td>Rp. <?= number_format($fu->plafon) ?></td>
                </tr>
                <tr>
                    <th>Tgl Realisasi</th>
                    <td><?= date('d/m/Y', strtotime($fu->tgl_realisasi)) ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?= $fu->alamat_nasabah ?></td>
                </tr>
            </table>
        </div>
        <div class="col">
            <table class="table table-sm table-borderless">
                <tr>
                    <th>Provinsi</th>
                    <td><?= $fu->provinsi ?></td>
                </tr>
                <tr>
                    <th>Kabupaten</th>
                    <td><?= $fu->kabupaten ?></td>
                </tr>
                <tr>
                    <th>Kecamatan</th>
                    <td><?= $fu->kecamatan ?></td>
                </tr>
                <tr>
                    <th>Kelurahan</th>
                    <td><?= $fu->kelurahan ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover w-100">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="text-center">Tanggal</th>
                    <th>Marketing</th>
                    <th>Hasil</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Approval</th>
                    <th class="text-center">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center"><?= date('d/m/Y H:i:s', strtotime($fu->tanggal_kunjungan)) ?></td>
                    <td><?= $fu->marketing ?></td>
                    <td><?= $fu->hasil_kunjungan ?></td>
                    <td class="text-center"><?= $fu->status_fu ?></td>
                    <td class="text-center"><?= $fu->approval ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <div class='p-1'>

                                <?php if(!empty($fu->lampiran_kunjungan)) : ?>
                                    <a
                                        class='btn btn-sm btn-success'
                                        target='_blank'
                                        href='<?= base_url($fu->lampiran_kunjungan) ?>'
                                    >
                                        <i class='fa fa-paperclip'></i>
                                    </a>
                                <?php else : ?>
                                    <button
                                        type='button'
                                        class='btn btn-sm btn-danger'
                                        onclick='Swal.fire(`File Tidak Ada`, `Tidak ada file yang diupload`, `error`)'
                                    >
                                        <i class='fa fa-paperclip'></i>
                                    </button>
                                <?php endif ?>
                                    
                            </div>
                            <div class='p-1'>

                                <?php if(!empty($fu->latitude_kunjungan) && !empty($fu->longitude_kunjungan)) : ?>
                                    <a
                                        class='btn btn-sm btn-primary'
                                        target='_blank'
                                        href='http://maps.google.com/maps?q=<?= $fu->latitude_kunjungan ?>, <?= $fu->longitude_kunjungan ?>'
                                    >
                                        <i class='fa fa-map'></i>
                                    </a>
                                <?php else : ?>

                                    <button
                                        type='button'
                                        class='btn btn-sm btn-danger'
                                        onclick='Swal.fire(`Lokasi Tidak Ada`, `Tidak ada Lokasi yang terdeteksi`, `error`)'
                                    >
                                        <i class='fa fa-map'></i>
                                    </button>
                                <?php endif ?>
                                    
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

<?php elseif($type === "posting") : ?>
    <div class="row row-cols-1 row-cols-md-2">
        <div class="col mb-3">
            <div class="d-flex justify-content-start">
                <div class="p-1">
                    <p>Nama Pegawai</p>
                </div>
                <div class="p-1">
                    <p class="font-weight-bold"><?= $fu->user ?></p>
                </div>
            </div>
        </div>
        <div class="col mb-3">
            <div class="d-flex justify-content-start">
                <div class="p-1">
                    <p>Sosial Media</p>
                </div>
                <div class="p-1">
                    <p class="font-weight-bold"><?= $fu->sosmed ?></p>
                </div>
            </div>
        </div>

        <div class="col mb-3">
            <div class="d-flex justify-content-start">
                <div class="p-1">
                    <p>Kantor Cabang</p>
                </div>
                <div class="p-1">
                    <p class="font-weight-bold"><?= $fu->cabang ?></p>
                </div>
            </div>
        </div>
        <div class="col mb-3">
            <div class="d-flex justify-content-start">
                <div class="p-1">
                    <p>Link Posting</p>
                </div>
                <div class="p-1">
                    <a href="<?= $fu->link ?>" target="_blank" class="text-decoration-none">
                        <?= mb_strimwidth($fu->link, 0, 25, '....') ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="col mb-3">
            <div class="d-flex justify-content-start">
                <div class="p-1">
                    <p>Tgl Posting</p>
                </div>
                <div class="p-1">
                    <p class="font-weight-bold"><?= date('d/m/Y', strtotime($fu->tgl_posting)) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h5 class="text-dark">Preview URL</h5>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="<?= $fu->link ?>" allowfullscreen></iframe>
            </div>
        </div>
    </div>
<?php endif ?>

<script type="text/javascript">
    $('#modal-title-approval').text(`<?= $title ?>`)
	$('#modal-footer-approval').html(`
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

        <?php if($type == "fu-kunjungan") : ?>

            <?php if(in_array($user->level, ['Supervisor', 'PIC', 'Admin'])) : ?>
                <button type="button" class="btn btn-danger" onclick="updateApproval('<?= $type ?>', '<?= $fu->id ?>', 'ditolak')">Tolak</button>
                <button type="button" class="btn btn-primary" onclick="updateApproval('<?= $type ?>', '<?= $fu->id ?>', 'disetujui')">Setuju</button>
            <?php endif ?>
        <?php endif ?>

        <?php if($type == 'fu') : ?>

            <?php if($fu->status == 'Realisasi' && in_array($user->level, ['Supervisor', 'PIC', 'Admin'])) : ?>
                <button type="button" class="btn btn-danger" onclick="updateApproval('<?= $type ?>', '<?= $fu->id ?>', 'ditolak')">Tolak</button>
                <button type="button" class="btn btn-primary" onclick="updateApproval('<?= $type ?>', '<?= $fu->id ?>', 'disetujui')">Setuju</button>

            <?php endif ?>
            
        <?php endif ?>

        <?php if($type == 'fu' && $fu->status != 'Realisasi') : ?>

            <?php if(($user->level != "Marketing") && ($fu->approval != "ditolak")) : ?>
                <button type="button" class="btn btn-danger" onclick="updateApproval('<?= $type ?>', '<?= $fu->id ?>', 'ditolak')">Tolak</button>
                <button type="button" class="btn btn-primary" onclick="updateApproval('<?= $type ?>', '<?= $fu->id ?>', 'disetujui')">Setuju</button>
            <?php endif ?>
        <?php endif ?>
            
	`)
</script>

<script type="text/javascript">

    function updateApproval(type, id, approval) {
        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbarui Status Approval: ${approval}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Perbarui Sekarang!',
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
                    url: "<?= site_url('approval/update') ?>",
                    method: "POST",
                    data: { type, id, approval },

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

                                <?php if($type === "fu") : ?>
                                    tableFu()
                                <?php elseif($type === "fu-kunjungan") : ?>
                                    tableFuKunjungan()
                                <?php elseif($type === "posting") : ?>
                                    tablePosting()
                                <?php endif ?>

                                $('#modal-approval').modal('hide')
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
    }
</script>