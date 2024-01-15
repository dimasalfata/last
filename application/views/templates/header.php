<?php $session = (object) $this->session->userdata(); ?>
<!DOCTYPE html>
<html lang="en">

<head>


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BPR BPKK Karangmalang</title>
  <link href="<?php echo base_url()?>assets_landing/img/logo_bkk.svg" rel="icon">
  <link href="<?php echo base_url()?>assets_landing/img/logo_bkk.svg" rel="apple-touch-icon">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/select2.min.css">
  <script src="<?php echo base_url() ?>assets_landing/js/jquery.min.js"></script>
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/select2.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
  <style type="text/css">
    .select2-selection__rendered {
      line-height: 31px !important;
    }
    .select2-container .select2-selection--single {
      height: 40px !important;
    }
    .select2-selection__arrow {
      height: 34px !important;
    }

    input[type="file"]{
      opacity: 0 !important;
      padding: 0 !important;
      width: 100%!important;

    }
    .imagecheck-figure > img {
      width: 100%!important;
    }

  </style>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/leaflet.css">
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

   <div class="modal fade" data-backdrop="static" id="modalubahpassworduser" tabindex="-1" role="dialog" aria-labelledby="modalubahpassworduserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header bg-danger text-light">
          <h5 id="modalubahpassworduserLabel">UBAH PASSWORD</h5>
        </div>
        <div class="modal-body">
          <form method="post" id="form_ubah_password_user" action="<?php echo base_url('dashboard/ubah_password') ?>">
            <div class="form-group row" class="collapse" id="customer_collapse">

              <div class="col-md-12 mb-3">
                <label for="pwd1">Password Baru</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password_baru_user" name="password_baru_user" placeholder="Masukkan Password" required>
                  <div class="input-group-text input-group-text-prepend password_baru_user pt-2" style="cursor: pointer;" onclick="show_password_user('password_baru_user')"><i class="fa fa-eye"></i></div>
                </div>
                <small class="mt-1 error-password_baru_user text-danger"></small>
              </div>
              <div class="col-md-12 mb-3">
                <label for="pwd1">Ulangi Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="confirm_password_baru_user" name="confirm_password_baru_user" placeholder="Ulangi Password" required>
                  <div class="input-group-text input-group-text-prepend confirm_password_baru_user pt-2" style="cursor: pointer;" onclick="show_password_user('confirm_password_baru_user')"><i class="fa fa-eye"></i></div>

                </div>
                <small class="mt-1 error-confirm_password_baru_user text-danger"></small>

              </div>
            </div>
          </form>
          <div class="modal-footer">
            <div class="form-group row" class="collapse" id="customer_collapse">
              <div class="col-sm-12 btn-group">
                <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><b>BATAL</b></button>

                <button type="button" class="btn btn-success" id="btn_ubah_password_user"><b>UBAH</b></button>

              </div>

            </div>



          </div>




        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>



  <div class="modal fade" data-backdrop="static" id="modalubahprofil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-user mr-2"></i>UBAH PROFILE</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        </div>
        <form class="form-horizontal" method="post" id="form_profil_user" action="<?php echo base_url('dashboard/ubah_profil') ?>" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 mb-3">
               <label style="color:#343a40;" for="nama_lengkap_user">Nama Lengkap</label>
               <input class="form-control" type="text" name="nama_lengkap_user" id="nama_lengkap_user" value="<?php echo $this->session->nama ?>">
             </div>
             <div class="col-md-12 mb-3">
               <label style="color:#343a40;" for="email_user">Email</label>
               <input class="form-control" type="email" name="email_user" id="email_user" value="<?php echo $this->session->email ?>">
             </div>
             <div class="col-md-12 mb-3"> 
              <label class="imagecheck">Foto
                <input type="hidden" name="lampiran_avatar_lama" value="<?php echo $this->session->foto ?>">
                <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_avatar" id="lampiran_avatar" onchange="previewFile(this.id)" capture="camera">
                <figure class="imagecheck-figure">
                  <?php if ($this->session->foto!='') { ?>
                    <img src="<?php echo base_url().$this->session->foto;?>"  class="imagecheck-image" id="preview_lampiran_avatar" >

                  <?php }else{ ?>
                    <img src="<?php echo base_url('assets/img/img03.jpg');?>"  class="imagecheck-image" id="preview_lampiran_avatar" >
                  <?php } ?>
                </figure>
              </label>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Batal</button>
          <button type="submit" class="btn_ubah_profil_user btn btn-success btn-flat" id="btn_ubah_profil_user" type="button"><i class="fas fa-check mr-2"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" data-backdrop="static"  id="ModalLaporan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h3 class="modal-title" id="judul_laporan" style=" font: sans-serif; "><i class="fas fa-receipt mr-2"></i>TARIK LAPORAN</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
      </div>
      <form method="post" target="_blank" class="form-horizontal" id="form_tarik_laporan" action="<?php echo base_url('dashboard/tarik_laporan') ?>">
        <div class="modal-body">
          <div class="row"> 
            <div class="col-md-6 mb-3" >
                <span class="input-group-text bg-primary text-light" id="basic-addon3" >Kategori</span>
                <select class="form-control" id="kategori_laporan" name="kategori_laporan">
                  <option value="0" disabled selected>Pilih Kategori</option>
                  <option value="Pengajuan Online">Pengajuan Online</option>
                  <option value="Potensi Wilayah">Potensi Wilayah</option> 
                  <option value="Kunjungan Nasabah">Kunjungan Nasabah</option>  
                  <option value="sosmed">Posting Sosial Media</option>  
                </select>
            </div>
              <div class="col-md-6 mb-3" >
                <span class="input-group-text bg-primary text-light" id="basic-addon3" >Laporan</span>
                <select class="form-control" id="jenis_laporan" name="jenis_laporan" disabled>
                  <option value="0" disabled selected>Pilih Laporan</option>
                  <option value="Marketing">Per Marketing</option>  
                  <option value="Cabang">Per Cabang</option>  
                  <option value="Periode">Per Periode</option>  
                  <option value="Nasabah">Per Nasabah</option>  
                </select>
            </div>
              

             <div class="col-md-12 mb-3 marketing_laporan d-none" >
                <span class="input-group-text bg-primary text-light" id="basic-addon3" >Marketing</span>
                <select class="form-control" id="nama_marketing_laporan" name="nama_marketing_laporan" style="width: 100%">
                  <option value="All">All</option>
                </select>
            </div>

               <div class="col-md-12 mb-3  cabang_laporan d-none" >
                <span class="input-group-text bg-primary text-light" id="basic-addon3" >Cabang</span>
                <select class="form-control" id="cabang_laporan" name="cabang_laporan">
                  <option value="All">All</option>
                </select>

            </div>

             <div class="col-md-12 mb-3  nasabah_kunjungan d-none" >
                <span class="input-group-text bg-primary text-light" id="basic-addon3" >Nasabah</span>
                <select class="form-control" id="nasabah_kunjungan" name="nasabah_kunjungan" style="width: 100%">
                  <option value="All">All</option>
                </select>

            </div>

            <?php if($session->level !== "Marketing"): ?>
              <div class="col-md-12 mb-3 d-none" id="div-sosmed-user">
                <span class="input-group-text bg-primary text-light">
                  User
                </span>
                <select
                  name="sosmed_users" id="sosmed-user" class="form-control"
                  data-ajax--url="<?= site_url('posting/search_user') ?>"
                  data-placeholder="Pilih User"
                  style="width: 100% !important;"
                >
                  <option value="All">All</option>
                </select>
              </div>
            <?php endif ?>

            <?php if(($session->level != "Marketing") && ($session->level != "Supervisor")) : ?>
              <div class="col-md-12 mb-3 d-none" id="div-sosmed-cabang">
                <span class="input-group-text bg-primary text-light">
                  Cabang
                </span>
                <select
                  name="sosmed_cabangs" id="sosmed-cabang" class="form-control"
                  data-ajax--url="<?= site_url('posting/search_cabang') ?>"
                  data-placeholder="Pilih Cabang"
                  style="width: 100% !important;"
                >
                  <option value="All">All</option>
                </select>
              </div>
            <?php endif ?>

            <div class="col-md-12 mb-3 d-none" id="div-sosmed-sosmed">
              <span class="input-group-text bg-primary text-light">
                Sosmed
              </span>
              <select
                name="sosmed_sosmeds" id="sosmed-sosmed" class="form-control"
                data-ajax--url="<?= site_url('posting/search_sosmed') ?>"
                data-placeholder="Pilih Sosmed"
                style="width: 100% !important;"
              >
                <option value="All">All</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
                <span class="input-group-text bg-primary text-light" id="basic-addon3" >Tanggal Awal</span>
                <input type="date" class="form-control"  name="tanggal_awal_laporan" id="tanggal_awal_laporan" >
            </div>
            <div class="col-md-6 mb-3">
                <span class="input-group-text bg-primary text-light" id="basic-addon3" >Tanggal Akhir</span>
                <input type="date" class="form-control flat"  name="tanggal_akhir_laporan" id="tanggal_akhir_laporan" >
            </div>  
          </div> 
          <div class="modal-footer">
            <button type="button"  class="btn btn-danger btn-flat" data-dismiss="modal"><i class="far fa-times-circle"></i> Batal</button>
            <button  type="button" class="btn btn-success btn-flat" id="btn_tarik_laporan"><i class="fas fa-receipt mr-2"></i>Tarik Laporan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>