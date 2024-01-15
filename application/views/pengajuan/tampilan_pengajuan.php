<div class="main-panel">
    <div class="content">
        <style type="text/css">
        input[type="file"] {
            opacity: 0 !important;
            padding: 0 !important;
            width: 100% !important;

        }

        .imagecheck-figure>img {
            width: 100% !important;
        }
        </style>

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <!-- Main content -->
        <section class="content flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>"
            data-text="<?php echo $this->session->flashdata('text'); ?>"
            data-icon="<?php echo $this->session->flashdata('icon'); ?>">
            <div class="row">
                <div class="col-12">
                    <h1 class="h3 mb-3 ml-5 text-gray-800">Pengajuan Online</h1>
                    <div class="card">
                        <div class="card-header">
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-12">
                                <button id="export" name="export" class="btn btn-sm refresh btn-info btn-md"><i
                                        class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>
                            </div>

                        </div>
                            <div class="card-header">
                            <ul class="nav nav-tabs" id="pengajuan-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="default-tab" data-toggle="tab" data-target="#default" type="button" role="tab" aria-controls="default" aria-selected="true">Default</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="realisasi-tab" data-toggle="tab" data-target="#realisasi" type="button" role="tab" aria-controls="realisasi" aria-selected="false">Realisasi</button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">

<div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="default" role="tabpanel" aria-labelledby="default-tab">
                <div class="table-responsive">
                    <table id="tabel_pengajuan" class="table table-striped table-bordered "style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
                        <thead>
                            <tr class="bg-primary text-light ">
                                <th class="text-center" width="1%">No</th>
                                <th>Tanggal</th>
                                <th>Marketing</th>
                                <th>Cabang</th>
                                <th>Kode Pengajuan</th>
                                <th>Pengajuan</th>
                                <th>Nama Nasabah</th>
                                <th>Plafon</th>
                                <th>Status</th>
                                <th style="text-align: center;" width="10%">Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="show_data"></tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="realisasi" role="tabpanel" aria-labelledby="realisasi-tab">
                <div class="table-responsive">
                    <table id="tabel_pengajuan_realisasi" class="table table-striped table-bordered "style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
                        <thead>
                            <tr class="bg-primary text-light ">
                                <th class="text-center" width="1%">No</th>
                                <th>Tanggal</th>
                                <th>Marketing</th>
                                <th>Cabang</th>
                                <th>Kode Pengajuan</th>
                                <th>Pengajuan</th>
                                <th>Nama Nasabah</th>
                                <th>Plafon</th>
                                <th>Status</th>
                                <th style="text-align: center;" width="10%">Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="show_data_realisasi"></tbody>
                    </table>
                </div>
            </div>


            </div>
                        </div>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</div>

<div class="modal fade" data-backdrop="static" id="modalrealisasi" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i
                        class="fas fa-buildings mr-2"></i> Realisasi Nasabah</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">x</span></button>
            </div>
            <form class="form-horizontal" method="post" id="form_realisasi"
                action="<?php echo base_url('pengajuan/realisasi') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label style="color:#343a40;" for="hasil_follow_up">No. Rekening Kredit</label>
                            <input type="hidden" name="id_nasabah_realisasi" id="id_nasabah_realisasi" value="">
                            <input type="text" class="form-control" name="no_ref" id="no_ref">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i
                            class="far fa-times-circle mr-2"></i> Batal</button>
                    <button class="btn_realisasi btn btn-success btn-flat" id="btn_realisasi" type="button"><i
                            class="fas fa-check mr-2"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" data-backdrop="static" id="modalfollowup" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i
                        class="fas fa-buildings mr-2"></i> Follow UP Nasabah</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">x</span></button>

            </div>
            <form class="form-horizontal" method="post" id="form_followup"
                action="<?php echo base_url('pengajuan/simpan_fu') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-9">
                            <label style="color:#343a40;" for="hasil_follow_up">Hasil Follow UP</label>

                            <input type="hidden" name="id_nasabah_follow_up" id="id_nasabah_follow_up" value="">
                            <textarea class="form-control" name="hasil_follow_up" id="hasil_follow_up"
                                rows="5"></textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="imagecheck">Foto
                                <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control"
                                    name="lampiran_follow_up" id="lampiran_follow_up" onchange="previewFile(this.id)"
                                    capture="camera">
                                <figure class="imagecheck-figure">
                                    <img src="<?php echo base_url('assets/img/img03.jpg');?>" class="imagecheck-image"
                                        id="preview_lampiran_follow_up">
                                </figure>
                            </label>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i
                            class="far fa-times-circle mr-2"></i> Batal</button>
                    <button class="btn_simpan_followup btn btn-success btn-flat" id="btn_simpan_followup"
                        type="button"><i class="fas fa-check mr-2"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" data-backdrop="static" id="modal_detail" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i
                        class="fas fa-buildings mr-2"></i>Detail Pengajuan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">x</span></button>

            </div>
            <form class="form-horizontal">
                <div class="modal-body detail_pengajuan">
                    <div class="row p-3">
                        <div class="col-md-6 mb-3">
                            <span style="width: 200px;font-weight: bold;display: inline-block;">Produk</span><span
                                class=" produk_pengajuan"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <span style="width: 200px;font-weight: bold;display: inline-block;">Nama Usaha</span><span
                                class=" nama_usaha_pekerjaan"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span style="width: 200px;font-weight: bold;display: inline-block;">NIK</span>
                            <span class=" nik"></span>
                        </div>



                        <div class="col-md-6 mb-3">
                            <span style="width: 200px;font-weight: bold;display: inline-block;">Nama Nasabah</span><span
                                class=" nama_nasabah"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <span style="width: 200px;font-weight: bold;display: inline-block;">No. HP/Telp/WA</span>
                            <span class=" no_hp"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <span style="width: 200px;font-weight: bold;display: inline-block;">Omset</span><span
                                class=" omset_usaha"></span>
                        </div>


                        <div class="col-md-6 mb-3">
                            <span style="width: 200px;font-weight: bold;display: inline-block;">Nama Suami /
                                Istri</span><span class=" nama_suami_istri"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <span style="width: 200px;font-weight: bold;display: inline-block;">Plafon</span><span
                                class=" besar_plafon"></span>
                        </div>


                        <div class="col-md-6 mb-3">
                            <span style="width: 200px;font-weight: bold;display: inline-block;">Nama Ibu
                                Kandung</span><span class=" nama_ibu_kandung"></span>
                        </div>
                        <!-- <div class="col-md-6 mb-3">
          </div> -->

                        <div class="col-md-6 mb-3">
                            <span style="width: 200px;font-weight: bold;display: inline-block;">Alamat Usaha</span><span
                                class=" alamat_usaha_pekerjaan"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <span style="width: 200px;font-weight: bold;display: inline-block;">Alamat</span><span
                                class=" alamat_nasabah"></span>
                        </div>

                        <div class="col-md-6 mb-3 mt-3 btn-group">
                            <a href="javascript:;" target="_blank" id="foto_ktp"
                                class="btn btn-primary w-50 mr-3">KTP</a>
                            <a href="javascript:;" target="_blank" id="foto_ktp_pasangan"
                                class="btn btn-success w-50 mr-3">Pasangan</a>
                            <a href="" id="foto_usaha" class="btn btn-primary w-50  mr-3" target="_blank">Foto Usaha</a>
                            <a href="javascript:;" target="_blank" id="foto_selfie" class="btn btn-success w-50">Foto
                                Selfie</a>

                        </div>
                        <div class="col-md-12 mb-3 mt-3">
                            <table class="table table-bordered table-striped display table-sm">
                                <thead>
                                    <tr>
                                        <th class="bg-primary text-light text-center" colspan="5">History Follow UP</th>
                                    </tr>
                                    <tr class="bg-danger text-light ">
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tanggal</th>
                                        <th>Marketing</th>
                                        <th>Hasil</th>
                                        <th class="text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody id="list_fu">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" type="button" class="btn btn-primary btn-flat mr-2" id="cetak_data_pengajuan"
                        target="_blank"><i class="fas fa-print mr-2"></i>Cetak</a>
                    <a href="javascript:;" type="button" class="btn btn-danger btn-flat mr-2 tolak_pengajuan" data=""><i
                            class="fas fa-user-times mr-2"></i>Tolak</a>

                    <button type="button" class="btn btn-secondary btn-flat mr-2" data-dismiss="modal"><i
                            class="far fa-times-circle mr-2"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" data-backdrop="static" id="ModalTolak" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i
                        class="fas fa-users-times mr-2"></i> Tolak Pengajuan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">x</span></button>

            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url('pengajuan/tolak') ?>">
                <div class="modal-body">

                    <input type="hidden" name="id_pengajuan_tolak" id="id_pengajuan_tolak" value="">
                    <div class="alert alert-danger">
                        <p class="notif">Tolak Pengajuan Nasabah...?</p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i
                            class="far fa-times-circle mr-2"></i> Batal</button>
                    <button type="submit" class="btn_tolak btn btn-success btn-flat" id="btn_tolak"><i
                            class="fas fa-check mr-2"></i>YA</button>
                </div>


            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
function previewFile(id) {
    let file = $('#' + id)[0].files[0];
    let reader = new FileReader();
    reader.addEventListener("load", function() {
        $('#preview_' + id).attr('src', reader.result);
    }, false);
    if (file) {
        reader.readAsDataURL(file);
    }
}



$(document).ready(function() {

    const notif = $('.flashdatart').data('title');
    if (notif) {
        Swal.fire({
            title: notif,
            text: $('.flashdatart').data('text'),
            icon: $('.flashdatart').data('icon'),
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.close();

            }
        });
    }

    $('#prov_nasabah').select2({
        placeholder: 'Pilih Provinsi',
        allowClear: true,
        dropdownParent: $('#modal_potensi .modal-content'),
    });



    dataTable = $('#tabel_pengajuan').DataTable({
        paginationType: 'full_numbers',
        processing: true,
        serverSide: true,
        searching: true,
        order: [0, 'desc'],
        filter: false,
        autoWidth: false,
        aLengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        ajax: {
            url: '<?php echo base_url('pengajuan/tabel_pengajuan')?>',
            type: 'get',
            data: function(data) {}
        },
        language: {
            sProcessing: 'Sedang memproses...',
            sLengthMenu: 'Tampilkan _MENU_ entri',
            sZeroRecords: 'Tidak ditemukan data yang sesuai',
            sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
            sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
            sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
            sInfoPostFix: '',
            sSearch: 'Cari:',
            sUrl: '',
            oPaginate: {
                sFirst: '<<',
                sPrevious: '<',
                sNext: '>',
                sLast: '>>'
            }
        },
    
        columns: [{
                'data': 'no'
            },
            {
                'data': 'tanggal',
                 orderable: false
            },
            {
                'data': 'marketing',
                 orderable: false
            },
            {
                'data': 'nama_cabang'
            },
            {
                'data': 'kode_pengajuan'
            },
            {
                'data': 'nama_produk'
            },
            {
                'data': 'nama'
            },
            {
                'data': 'besar_plafon'
            },
            {
                'data': 'status'
            },
            {
                'data': 'opsi',
                orderable: false
            },
        ],
        columnDefs: [{
                targets: [0, -1],
                className: 'text-center'
            },
            {
                targets: [6],
                className: 'text-right'
            },

        ]

    });

    dataTableRealisasi = $('#tabel_pengajuan_realisasi').DataTable({
        paginationType: 'full_numbers',
        processing: true,
        serverSide: true,
        searching: true,
        order: [0, 'desc'],
        filter: false,
        autoWidth: false,
        aLengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        ajax: {
            url: '<?php echo base_url('pengajuan/tabel_pengajuan_realisasi')?>',
            type: 'get',
            data: function(data) {}
        },
        language: {
            sProcessing: 'Sedang memproses...',
            sLengthMenu: 'Tampilkan _MENU_ entri',
            sZeroRecords: 'Tidak ditemukan data yang sesuai',
            sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
            sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
            sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
            sInfoPostFix: '',
            sSearch: 'Cari:',
            sUrl: '',
            oPaginate: {
                sFirst: '<<',
                sPrevious: '<',
                sNext: '>',
                sLast: '>>'
            }
        },
        columns: [{
                'data': 'no'
            },
            {
                'data': 'tanggal',
                orderable: false
            },
            {
                'data': 'marketing',
                orderable: false
            },
            {
                'data': 'nama_cabang'
            },
            {
                'data': 'kode_pengajuan'
            },
            {
                'data': 'nama_produk'
            },
            {
                'data': 'nama'
            },
            {
                'data': 'besar_plafon'
            },
            {
                'data': 'status'
            },
            {
                'data': 'opsi',
                orderable: false
            },
        ],
        columnDefs: [{
                targets: [0, -1],
                className: 'text-center'
            },
            {
                targets: [6],
                className: 'text-right'
            },

        ]

    });


    function table_data() {
        dataTable.ajax.reload(null, true);
    }


    $(".refresh").click(function() {
        location.reload();
    });

});


$('#show_data').on('click', '.item_follow_up', function() {
    let kode_pengajuan = $(this).attr('data');
    $('#modalfollowup').modal('show');
    $('#id_nasabah_follow_up').val(kode_pengajuan);
});

$('#show_data').on('click', '.item_realisasi_nasabah', function() {
    let kode_pengajuan = $(this).attr('data');
    $('#modalrealisasi').modal('show');
    $('#id_nasabah_realisasi').val(kode_pengajuan);
});
$('#show_data').on('click', '.item_detail_pengajuan', function() {
    let kode_pengajuan = $(this).attr('data');
    $.ajax({
        type: "GET",
        url: "<?php echo base_url('pengajuan/detail_pengajuan')?>",
        dataType: "JSON",
        data: {
            'kode_pengajuan': kode_pengajuan
        },
        success: function(data) {
            $('#modal_detail').modal('show');
            $('.nama_nasabah').html(data.pengajuan[0].nama);
            $('.produk_pengajuan').html(data.pengajuan[0].nama_produk);
            $('.nik').html(data.pengajuan[0].nik);
            $('.no_hp').html(data.pengajuan[0].no_hp);
            $('.nama_suami_istri').html(data.pengajuan[0].nama_suami_istri);
            $('.nama_ibu_kandung').html(data.pengajuan[0].nama_ibu_kandung);
            $('.alamat_nasabah').html(data.pengajuan[0].alamat_rumah);
            $('.alamat_usaha_pekerjaan').html(data.pengajuan[0].alamat_usaha_pekerjaan);
            $('.nama_usaha_pekerjaan').html(data.pengajuan[0].nama_usaha_pekerjaan);
            if (data.pengajuan[0].foto_usaha != '') {
                $('#foto_usaha').attr('href', '<?php echo  base_url(); ?>' + data.pengajuan[0]
                    .foto_usaha);
            }

            if (data.pengajuan[0].foto_ktp != '') {
                $('#foto_ktp').attr('href', '<?php echo  base_url(); ?>' + data.pengajuan[0]
                    .foto_ktp);
            }

            if (data.pengajuan[0].foto_selfie != '') {
                $('#foto_selfie').attr('href', '<?php echo  base_url(); ?>' + data.pengajuan[0]
                    .foto_selfie);
            }

            if (data.pengajuan[0].foto_ktp_pasangan != '' && data.pengajuan[0].foto_ktp_pasangan !=
                null) {
                $('#foto_ktp_pasangan').attr('href', '<?php echo  base_url(); ?>' + data.pengajuan[
                    0].foto_ktp_pasangan);
                $('#foto_ktp_pasangan').removeClass('d-none');

            } else {
                $('#foto_ktp_pasangan').addClass('d-none');
            }


            if (data.pengajuan[0].status == "Nasabah Baru" || data.pengajuan[0].status ==
                "Follow UP") {
                $('.tolak_pengajuan').attr('data', kode_pengajuan);
                $('.tolak_pengajuan').removeClass('d-none');
            } else {
                $('.tolak_pengajuan').addClass('d-none');

            }

            $('#cetak_data_pengajuan').attr('href', '<?php echo  base_url(); ?>pengajuan/cetak/' +
                kode_pengajuan);

            SeparatorRibuan(data.pengajuan[0].omset_usaha.toString(), 'omset_usaha');
            SeparatorRibuan(data.pengajuan[0].besar_plafon.toString(), 'besar_plafon');
            let fu = '';
            for (var i = 0; i < data.follow_up.length; i++) {
                fu += `<tr>
                <td>` + (i + 1) + `</td>
                <td>` + data.follow_up[i].tanggal_fu + `</td>
                <td>` + data.follow_up[i].nama + `</td>
                <td>` + data.follow_up[i].hasil_fu + `</td>
                <td class="text-center">`;
                if (data.follow_up[i].lampiran_fu != '') {
                    fu += `<a href="<?php echo base_url() ?>` + data.follow_up[i].lampiran_fu +
                        `" target="_blank" class="btn btn-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>`;
                }
                fu += `</td></tr>`;
            }

            $('#list_fu').html(fu);

        },

    });

    return false;
});


$('#show_data_realisasi').on('click', '.item_detail_pengajuan', function() {
    let kode_pengajuan = $(this).attr('data');
    $.ajax({
        type: "GET",
        url: "<?php echo base_url('pengajuan/detail_pengajuan')?>",
        dataType: "JSON",
        data: {
            'kode_pengajuan': kode_pengajuan
        },
        success: function(data) {
            $('#modal_detail').modal('show');
            $('.nama_nasabah').html(data.pengajuan[0].nama);
            $('.produk_pengajuan').html(data.pengajuan[0].nama_produk);
            $('.nik').html(data.pengajuan[0].nik);
            $('.no_hp').html(data.pengajuan[0].no_hp);
            $('.nama_suami_istri').html(data.pengajuan[0].nama_suami_istri);
            $('.nama_ibu_kandung').html(data.pengajuan[0].nama_ibu_kandung);
            $('.alamat_nasabah').html(data.pengajuan[0].alamat_rumah);
            $('.alamat_usaha_pekerjaan').html(data.pengajuan[0].alamat_usaha_pekerjaan);
            $('.nama_usaha_pekerjaan').html(data.pengajuan[0].nama_usaha_pekerjaan);
            if (data.pengajuan[0].foto_usaha != '') {
                $('#foto_usaha').attr('href', '<?php echo  base_url(); ?>' + data.pengajuan[0]
                    .foto_usaha);
            }

            if (data.pengajuan[0].foto_ktp != '') {
                $('#foto_ktp').attr('href', '<?php echo  base_url(); ?>' + data.pengajuan[0]
                    .foto_ktp);
            }

            if (data.pengajuan[0].foto_selfie != '') {
                $('#foto_selfie').attr('href', '<?php echo  base_url(); ?>' + data.pengajuan[0]
                    .foto_selfie);
            }

            if (data.pengajuan[0].foto_ktp_pasangan != '' && data.pengajuan[0].foto_ktp_pasangan !=
                null) {
                $('#foto_ktp_pasangan').attr('href', '<?php echo  base_url(); ?>' + data.pengajuan[
                    0].foto_ktp_pasangan);
                $('#foto_ktp_pasangan').removeClass('d-none');

            } else {
                $('#foto_ktp_pasangan').addClass('d-none');
            }


            if (data.pengajuan[0].status == "Nasabah Baru" || data.pengajuan[0].status ==
                "Follow UP") {
                $('.tolak_pengajuan').attr('data', kode_pengajuan);
                $('.tolak_pengajuan').removeClass('d-none');
            } else {
                $('.tolak_pengajuan').addClass('d-none');

            }

            $('#cetak_data_pengajuan').attr('href', '<?php echo  base_url(); ?>pengajuan/cetak/' +
                kode_pengajuan);

            SeparatorRibuan(data.pengajuan[0].omset_usaha.toString(), 'omset_usaha');
            SeparatorRibuan(data.pengajuan[0].besar_plafon.toString(), 'besar_plafon');
            let fu = '';
            for (var i = 0; i < data.follow_up.length; i++) {

                fu += `<tr>
                <td>` + (i + 1) + `</td>
                <td>` + data.follow_up[i].tanggal_fu + `</td>
                <td>` + data.follow_up[i].nama + `</td>
                <td>` + data.follow_up[i].hasil_fu + `</td>
                <td class="text-center">`;
                if (data.follow_up[i].lampiran_fu != '') {
                    fu += `<a href="<?php echo base_url() ?>` + data.follow_up[i].lampiran_fu +
                        `" target="_blank" class="btn btn-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>`;
                }
                fu += `</td></tr>`;
            }

            $('#list_fu').html(fu);

        },

    });

    return false;
});



$(document).on('click', '.tolak_pengajuan', function() {
    let id_pengajuan_tolak = $(this).attr('data');
    $('#ModalTolak').modal('show');
    $('#id_pengajuan_tolak').val(id_pengajuan_tolak);
});

$('#btn_realisasi').on('click', function() {
    let no_ref = $('#no_ref').val();
    if (no_ref == "") {
        $('#no_ref').focus();
        Swal.fire({
            title: 'Nomor Referensi Kosong',
            text: 'Silahkan Masukkan Nomor Referensi!',
            icon: 'error'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.close();
            }
        });
        return false;
    }

    $('#btn_realisasi').attr('disabled', 'disabled');
    $('#btn_realisasi').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');

    $('#form_realisasi').submit();

});


$('#btn_simpan_followup').on('click', function() {
    let hasil_follow_up = $('#hasil_follow_up').val();
    if (hasil_follow_up == "") {
        $('#hasil_follow_up').focus();
        Swal.fire({
            title: 'Hasil Follow UP Kosong',
            text: 'Silahkan Masukkan Hasil Follow UP!',
            icon: 'error'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.close();
            }
        });
        return false;
    }

    $('#btn_simpan_followup').attr('disabled', 'disabled');
    $('#btn_simpan_followup').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');

    $('#form_followup').submit();

});

function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka != 8 && angka > 31 && (angka < 48 || angka > 57))
        return false;
    return true;
}


function SeparatorRibuan(bilangan, id) {
    let angka = bilangan.replace(/\./g, '');
    let sisa = angka.length % 3;
    awalan = angka.substr(0, sisa);
    ribuan = angka.substr(sisa).match(/\d{3}/g);
    if (ribuan) {
        separator = sisa ? '.' : '';
        hasil = awalan + separator + ribuan.join('.');
        $('.' + id).html(hasil);


    }
}
</script>