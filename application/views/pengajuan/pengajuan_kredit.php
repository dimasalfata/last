<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/fav.png">
  <!-- Author Meta -->
  <meta name="author" content="colorlib">
  <!-- Meta Description -->
  <meta name="description" content="">
  <!-- Meta Keyword -->
  <meta name="keywords" content="">
  <!-- meta character set -->
  <meta charset="UTF-8">
  <!-- Site Title -->
  <title>Pengajuan Kredit</title>

  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700,900" rel="stylesheet">
  <!--
      CSS

      ============================================= -->
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/linearicons.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/magnific-popup.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/nice-select.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/animate.min.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owl.carousel.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main.css">
      <link rel="stylesheet" href="<?php echo base_url('vendor/'); ?>assets/fonts/material-icon/css/material-design-iconic-font.min.css">
      <style type="text/css">
        .signature-pad {
          border: 1px solid #ced4da;
          border-radius: 3%
        }

          /* input[type="hidden"]{
            opacity: 0 !important;
            padding: 0 !important;
            width: 100%!important;

          } */

        #foto_selfie {
          position:relative;
          width:345px;
          height:30px;
          text-align: right;
          -moz-opacity:0;
          filter:alpha(opacity: 0);
          opacity: 0;
          z-index: 2;
        
}
          .imagecheck-figure > img {
            width: 70%!important;
          }
            /*#hapus_sign{
                position: absolute;
                top:80%;
                left:20%;
                }*/
              </style>
              <script src="<?php echo base_url() ?>assets/js/plugin/webfont/webfont.min.js"></script>
              <script>
                WebFont.load({
                  google: {"families":["Lato:300,400,700,900"]},
                  custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo base_url() ?>assets/css/fonts.min.css']},
                  active: function() {
                    sessionStorage.fonts = true;
                  }
                });
              </script>
              <!-- Sweet Alert -->
              <script src="<?php echo base_url() ?>assets/js/sweetalert2.all.js"></script>
            </head>

            <body class="hold-transition sidebar-mini">
              <div class="wrapper">

                <body>

                  <!-- Start Preloader Area -->
                  <div class="preloader-area">
                    <div class="loader-box">
                      <div class="loader"></div>
                    </div>
                  </div>
                  <!-- End Preloader Area -->

                  <!-- Start Header Area -->
                  <header id="header">
                    <div class="container main-menu">
                      <div class="row align-items-center d-flex">
                        <div id="logo">
                          <a href="#" onclick="location.reload()"><img src="<?php echo base_url()?>assets/img/logo.svg" alt="" title="" /></a>
                        </div>
                        <nav id="nav-menu-container">
                          <ul class="nav-menu">
                            <li class=""><a class="active" href="<?php echo base_url('landing') ?>">Home</a></li>
                            <li><a href="<?php echo base_url() ?>marketing/bpr/<?php echo $marketing ?>#produk_layanan">Produk dan Layanan</a></li>
                            <li><a href="https://bprbkk-karangmalang.com/simulasikredit.php" target="_blank">Simulasi Kredit</a></li>
                          </ul>
                        </nav>
                      </div>
                    </div>
                  </header>
                  <!-- End Header Area -->

                  <!-- start banner Area -->
                  <section class="banner-area relative">
                    <div class="flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
                      <div class="row d-flex align-items-center justify-content-center">
                        <div class="about-content col-lg-12">
                          <h1 class="text-white">
                            Pengajuan Kredit
                          </h1>
                        </div>
                      </div>
                    </div>
                  </section>
                  <!-- End banner Area -->

                  <!-- Start contact-page Area -->
                  <section class="contact-page-area mt-5 w-100 align-items-center">
                    <div class="container w-100 p-5">
                      <form class="form-area " id="form_pengajuan" action="<?php echo base_url('pengajuan/simpan') ?>" method="post" class="contact-form text-right" enctype="multipart/form-data">
                        <div class="row  w-100" style="border:2px solid #90acd1; padding-top: 15px">
                          <div class="col-lg-12 p-4">
                            <span style="cursor: pointer;" class="tombol-menu tombol-menu-1 col-lg-3 text-info" data="1">Data Diri</span>
                            <span style="cursor: pointer;" class="tombol-menu tombol-menu-2 col-lg-3" data="2">Data Usaha / Pekerjaan</span>
                            <span style="cursor: pointer;"  class="tombol-menu tombol-menu-3 col-lg-3" data="3">Syarat & Ketentuan</span>
                          </div>
                          <div class="col-lg-12 p-4 list_menu menu-1">
                            <div class="col-lg-12"> 
                              <h4 style="cursor: pointer;" class="tombol-menu" data="1">Data Diri</h4>
                              <hr>
                            </div>
                            <div class="col-lg-12 "> 
                              <input type="hidden" name="marketing" id="marketing" value="<?php echo $marketing ?>">
                              <input type="hidden" name="produk" id="produk" value="<?php echo $produk ?>">
                              <div class="row p-2">
                                <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="nik" id="nik"  maxlength="16" onkeypress="return hanyaAngka(event)"  />
                                  <small class="error-nik text-danger"></small>
                                </div>
                              </div>
                              <div class="row  p-2">
                                <label for="nama_nasabah" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="nama_nasabah" id="nama_nasabah" >
                                  <small class="error-nama_nasabah text-danger"></small>

                                </div>
                              </div>
                              <div class="row p-2">
                                <label for="nohp" class="col-sm-3 col-form-label">Nomor Telp/HP/WA</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="no_hp" id="no_hp"  maxlength="13" onkeypress="return hanyaAngka(event)"  />
                                  <small class="error-no_hp text-danger"></small>
                                </div>
                              </div>
                              <div class="row  p-2">
                                <label for="nama_suami_istri" class="col-sm-3 col-form-label">Nama Istri / Suami</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="nama_suami_istri" id="nama_suami_istri" />
                                  <small class="error-nama_suami_istri text-danger"></small>

                                </div>
                              </div>
                              <div class="row  p-2">
                                <label for="nama_ibu_kandung" class="col-sm-3 col-form-label">Nama Ibu Kandung</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="nama_ibu_kandung" id="nama_ibu_kandung" />
                                  <small class="error-nama_ibu_kandung text-danger"></small>

                                </div>
                              </div>
                              <div class="row  p-2">
                                <label for="alamat_nasabah" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                  <textarea type="text" class="form-control" name="alamat_nasabah" id="alamat_nasabah" rows="5"></textarea>
                                  <small class="error-alamat_nasabah text-danger"></small>

                                </div>
                              </div>
                              <div class="row p-2">
                                <label for="foto_ktp" class="col-sm-3 col-form-label">Foto KTP</label>
                                <div class="col-sm-9">
                                  <input type="file" class="form-control" name="foto_ktp" id="foto_ktp" accept="image/*" />
                                  <small class="error-foto_ktp text-danger"></small>

                                </div>
                              </div>
                              <div class="row p-2">
                                <label for="foto_ktp" class="col-sm-3 col-form-label">Foto KTP Suami / Istri</label>
                                <div class="col-sm-9">
                                  <input type="file" class="form-control" name="foto_ktp_pasangan" id="foto_ktp_pasangan" accept="image/*" />
                                  <small class="error-foto_ktp_pasangan text-danger"></small>

                                </div>   
                              </div>
                              <div class="row p-2 mb-3">
                                <label for="foto_selfie" class="col-sm-3 imagecheck">Foto Selfie dengan KTP</label>
                                <div class="col-sm-9">
                                <label class="imagecheck">
                                <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto_selfie" id="foto_selfie" onchange="previewFile(this.id)" capture="camera">
                                  <small class="error-foto_selfie text-danger"></small>
                                  <figure class="imagecheck-figure">
                                  <img src="<?php echo base_url('assets/img/ktpimg.jpg');?>"  class="imagecheck-image foto_selfie" >
                                  </figure>
                                </label>
                                </div>   
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-12 p-4 list_menu menu-2 d-none">
                           <div class="col-lg-12"> 
                            <h4 style="cursor: pointer;" class="tombol-menu" data="2">Data Usaha / Pekerjaan</h4>
                            <hr>
                          </div>
                          <div class="col-lg-12"> 
                            <div class="row p-2">
                              <label for="nama_usaha_pekerjaan" class="col-sm-3 col-form-label">Nama Usaha/Pekerjaan</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_usaha_pekerjaan" id="nama_usaha_pekerjaan"  />
                                <small class="error-nama_usaha_pekerjaan text-danger"></small>

                              </div>
                            </div>
                            <div class="row p-2">
                              <label for="alamat_usaha_pekerjaan" class="col-sm-3 col-form-label">Alamat Usaha/Pekerjaan</label>
                              <div class="col-sm-9">
                                <textarea name="alamat_usaha_pekerjaan" class="form-control" id="alamat_usaha_pekerjaan" ></textarea>
                                <small class="error-alamat_usaha_pekerjaan text-danger"></small>

                              </div>
                            </div>
                            <div class="row p-2">
                              <label for="omset_usaha" class="col-sm-3 col-form-label">Omset Usaha</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control rupiah" name="omset_usaha" class="rupiah" id="omset_usaha"/>
                                <small class="error-omset_usaha text-danger"></small>

                              </div>
                            </div>
                            <div class="row p-2">
                              <label for="besar_plafon" class="col-sm-3 col-form-label">Besar Plafon</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control rupiah" name="besar_plafon" class="rupiah" id="besar_plafon"  />
                                <small class="error-besar_plafon text-danger"></small>

                              </div>
                            </div>
                            <div class="row p-2">
                              <label for="foto_usaha" class="col-sm-3 col-form-label">Upload Foto Usaha</label>
                              <div class="col-sm-9">
                                <input type="file" class="form-control" name="foto_usaha" id="foto_usaha" accept="image/*" />
                                <small class="error-foto_usaha text-danger"></small>

                              </div>
                            </div>

                          </div>
                        </div>

                        <div class="col-lg-12 p-4 list_menu menu-3 d-none">
                         <div class="col-lg-12"> 

                          <h4 style="cursor: pointer;"  class="tombol-menu" data="3">Syarat & Ketentuan</h4>
                          <hr>
                        </div>
                        <div class="col-lg-12 menu-3 d-none"> 

                          <div class="row p-2">
                            <div class="col-sm-12 mb-3">

                              <a href="javascript:;" class="genric-btn info lihat_detail">Preview</a>
                              <a href="javascript:;" class="genric-btn info-border lihat_syarat">Syarat & Ketentuan</a>

                            </div>
                            <div class="col-sm-12">
                              <input type="checkbox" id="setuju" class="mr-2">
                              <label for="setuju"> Setuju & Ajukan Pinjaman</label>
                              <br>
                              <small class="error-setuju text-danger"></small>
                            </div>
                          </div>

                          <div class="row p-2">
                            <div class="col-sm-12">
                              <canvas id="signature-pad" name="signature-pad" class="signature-pad"></canvas>
                              <input type="hidden" name="isi_ttd" id="isi_ttd">
                              <button type="button" class="btn btn-lg  btn-danger btn-flat" id="hapus_sign"><i class="fas fa-eraser"></i></button>
                              <br>
                              <small class="error-isi_ttd text-danger"></small>


                                <!-- 
                                  <input type="file" class="form-control" name="foto_usaha" id="foto_usaha" accept="image/*" /> -->
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row  w-100 mt-3">
                          <div class="col-lg-12 text-right">
                            <div class="button-group-area">
                              <a href="javascript:;" class="genric-btn primary btn-sebelumnya d-none">Sebelumnya</a>
                              <a href="javascript:;" class="genric-btn info btn-selanjutnya" data="1">Selanjutnya</a>
                              <a href="javascript:;" class="genric-btn success btn_ajukan d-none">Ajukan</a>
                            </div>

                          </div>
                        </div>
                      </form>
                    </div>
                  </section>
                  <div id="back-top">
                    <a title="Go to Top" href="#">
                      <i class="lnr lnr-arrow-up"></i>
                    </a>
                  </div>

                  <script src="<?php echo base_url() ?>assets/js/vendor/jquery-2.2.4.min.js"></script>
                  <script src="<?php echo base_url() ?>assets/js/jquery.masknumber.js"></script>

                  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                  crossorigin="anonymous"></script>
                  <script src="<?php echo base_url() ?>assets/js/vendor/bootstrap.min.js"></script>
                  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
                  <script src="<?php echo base_url() ?>assets/js/easing.min.js"></script>
                  <script src="<?php echo base_url() ?>assets/js/hoverIntent.js"></script>
                  <script src="<?php echo base_url() ?>assets/js/superfish.min.js"></script>
                  <script src="<?php echo base_url() ?>assets/js/mn-accordion.js"></script>
                  <script src="<?php echo base_url() ?>assets/js/jquery.ajaxchimp.min.js"></script>
                  <script src="<?php echo base_url() ?>assets/js/jquery.magnific-popup.min.js"></script>
                  <script src="<?php echo base_url() ?>assets/js/owl.carousel.min.js"></script>
                  <script src="<?php echo base_url() ?>assets/js/jquery.nice-select.min.js"></script>
                  <script src="<?php echo base_url() ?>assets/js/isotope.pkgd.min.js"></script>
                  <script src="<?php echo base_url() ?>assets/js/jquery.circlechart.js"></script>
                  <script src="<?php echo base_url() ?>assets/js/mail-script.js"></script>
                  <script src="<?php echo base_url() ?>assets/js/wow.min.js"></script>
                  <script src="<?php echo base_url() ?>assets/js/main.js"></script>
                  <script src="<?php echo base_url(); ?>assets/js/signature_pad.min.js"></script>
                  <script type="text/javascript">
                    var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
                      backgroundColor: 'rgba(255, 255, 255, 0)',
                      penColor: 'rgb(0, 0, 0)'
                    });
                    signaturePad.onEnd = function(){
                      let ttd = document.getElementById("signature-pad").toDataURL();
                      if (!signaturePad.isEmpty()) {

                        $('#isi_ttd').val(ttd);

                      }else{
                        $('#isi_ttd').val('');
                      }

                    };

                    $('#hapus_sign').on('click',function(){
                      signaturePad.clear();
                      $('#isi_ttd').val('');
                    });


                   $('.btn-selanjutnya').on('click',function(){
                    let id = $(this).attr('data');
                    let next = parseInt(id)+1;

                    let cek = 0;

                    if (id==1) {

                      let nik = $('#nik').val();
                      if (nik=="") {
                        $('#nik').focus();
                        $('.error-nik').html('Nik Belum Terisi');
                        cek++;
                      }else if (nik.length!=16) {
                        $('#nik').focus();
                        $('.error-nik').html('NIK Harus 16 Digit');
                        cek++;
                      }else{
                        $('.error-nik').html('');
                      }
                      let nama_nasabah = $('#nama_nasabah').val();
                      if (nama_nasabah=="") {
                        $('.error-nama_nasabah').html('Nama Kosong');
                        cek++;

                      }else{
                        $('.error-nama_nasabah').html('');
                      }

                      let nama_ibu_kandung = $('#nama_ibu_kandung').val();
                      if (nama_ibu_kandung=="") {
                        $('.error-nama_ibu_kandung').html('Nama Ibu Kandung Tidak Boleh Kosong');
                        cek++;

                      }else{
                        $('.error-nama_ibu_kandung').html('');
                      }

                      let no_hp = $('#no_hp').val();

                        if (no_hp=="") {
                            $('#no_hp').focus();
                            Swal.fire({
                              title:'Nomor Telepon Kosong',
                              text:'Silahkan Masukkan Nomor Telepon!',
                              icon:'error'
                            }).then((result) => {
                              if (result.isConfirmed) {
                                Swal.close();
                              }
                            });
                            return false;
                          }

                          if (no_hp.length < 10 || no_hp.length > 13 ) {
                            $('#no_hp').focus();
                            Swal.fire({
                              title:'Nomor Telepon Tidak Valid',
                              text:'Nomor Telepon Min 10 Digit dan Max 13 Digit!',
                              icon:'error'
                            }).then((result) => {
                              if (result.isConfirmed) {
                                Swal.close();
                              }
                            });
                            return false;
                          }


                      let alamat_nasabah = $('#alamat_nasabah').val();
                      if (alamat_nasabah=="") {
                        $('.error-alamat_nasabah').html('Alamat Tidak Boleh Kosong');
                        cek++;

                      }else{
                        $('.error-alamat_nasabah').html('');
                      }
                      let foto_ktp = $('#foto_ktp').val();
                      if (foto_ktp=="") {
                        $('.error-foto_ktp').html('Silahkan Upload KTP');
                        cek++;

                      }else{
                        $('.error-foto_ktp').html('');
                      }

                      let foto_selfie = $('#foto_selfie').val();
                      if (foto_selfie=="") {
                        $('.error-foto_selfie').html('Silahkan Foto Selfie dengan memperlihatkan KTP anda');
                        cek++;

                      }else{
                        $('.error-foto_selfie').html('');
                      }

                      if (cek == 0) {
                        $('.btn-sebelumnya').removeClass('d-none');
                        $('.btn-sebelumnya').attr('data',id);
                        $('.btn_ajukan').addClass('d-none');
                      }
                    }
                    if (id==2) {

                     let nama_usaha_pekerjaan = $('#nama_usaha_pekerjaan').val();
                     if (nama_usaha_pekerjaan=="") {
                      $('.error-nama_usaha_pekerjaan').html('Nama Usaha / Pekerjaan Kosong');
                      cek++;

                    }else{
                      $('.error-nama_usaha_pekerjaan').html('');
                    }

                    let alamat_usaha_pekerjaan = $('#alamat_usaha_pekerjaan').val();
                    if (alamat_usaha_pekerjaan=="") {
                      $('.error-alamat_usaha_pekerjaan').html('Alamat Usaha / Pekerjaan Kosong');
                      cek++;

                    }else{
                      $('.error-alamat_usaha_pekerjaan').html('');
                    }

                    let omset_usaha = $('#omset_usaha').val();
                    if (omset_usaha=="") {
                      $('.error-omset_usaha').html('Omset Usaha Kosong');
                      cek++;

                    }else{
                      $('.error-omset_usaha').html('');
                    }

                    let besar_plafon = $('#besar_plafon').val();
                    if (besar_plafon=="") {
                      $('.error-besar_plafon').html('Besar Plafon Kosong');
                      cek++;

                    }else{
                      $('.error-besar_plafon').html('');
                    }

                    let foto_usaha = $('#foto_usaha').val();
                    if (foto_usaha=="") {
                      $('.error-foto_usaha').html('Silahkan Upload Foto Usaha!');
                      cek++;

                    }else{
                      $('.error-foto_usaha').html('');
                    }

                    if (cek == 0) {
                    $(this).addClass('d-none');
                    $('.btn-sebelumnya').removeClass('d-none');
                    $('.btn-sebelumnya').attr('data',id);
                    $('.btn_ajukan').removeClass('d-none');

                  }
                }
                  if (cek > 0) {
                    return false;
                  }else{
                    $('.list_menu').addClass('d-none');
                    $('.menu-'+next).removeClass('d-none');
                    $('.tombol-menu').removeClass('text-info');
                    $('.tombol-menu-'+next).addClass('text-info');
                    $(this).attr('data',next);
                  }
                });

$('.btn-sebelumnya').on('click',function(){
  let id = $(this).attr('data');
  if (id==1) {
   $(this).addClass('d-none');
   $('.btn-selanjutnya').removeClass('d-none');
   $('.btn-selanjutnya').attr('data',id);
 }

 if (id==2) {
   $('.btn-selanjutnya').removeClass('d-none');
   $('.btn-selanjutnya').attr('data',id);
 }

 let next = parseInt(id)-1;
 $('.list_menu').addClass('d-none');
 $('.menu-'+id).removeClass('d-none');
 $('.tombol-menu').removeClass('text-info');
 $('.tombol-menu-'+id).addClass('text-info');
 $(this).attr('data',next);
 $('.btn_ajukan').addClass('d-none');
});


$('.btn_ajukan').on('click',function(){
  let cek = 0;
  let setuju = $('#setuju').prop('checked');
  if(!setuju)
  {
   $('.error-setuju').html('Silahkan Checklist Jika Menyetujui Syarat & Ketentuan');
   cek++;
 }else{
   $('.error-setuju').html('');
 }

 if (signaturePad.isEmpty()) {
  $('#isi_ttd').val('');
  $('.error-isi_ttd').html('TTD Kosong');
  cek++;
}else{
 $('.error-isi_ttd').html('');
}

if (cek > 0) {
  return false;
}else{

  $('#form_pengajuan').submit();
}
});

function hanyaAngka(event) {
  var angka = (event.which) ? event.which : event.keyCode
  if (angka != 46 && angka != 8 && angka > 31 && (angka < 48 || angka > 57))
    return false;
  return true;
}

function SeparatorRibuan(bilangan,id){
  let angka = bilangan.replace(/\./g,'');
  let sisa  = angka.length % 3;
  awalan  = angka.substr(0, sisa);
  ribuan  = angka.substr(sisa).match(/\d{3}/g);
  if (ribuan) {
    separator = sisa ? '.' : '';
    hasil = awalan + separator + ribuan.join('.');
    $('#'+id).val(hasil);


  }
}

$(document).ready(function(){

 const notif = $('.flashdatart').data('title');
 if (notif) {
  Swal.fire({
    title:notif,
    html:$('.flashdatart').data('text'),
    icon:$('.flashdatart').data('icon'),
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close(); 

    }
  });
}


$('#foto_usaha').bind('change', function() {
  if(this.files[0].size > 6000000)
  {
    $('#foto_usaha').val('');

    Swal.fire({
    title:'Error',
    html:'File Max 6 Mb',
    icon:'error',
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close(); 

    }
  });

  }
});


$('#foto_ktp').bind('change', function() {
  if(this.files[0].size > 6000000)
  {
    $('#foto_ktp').val('');

    Swal.fire({
    title:'Error',
    html:'File Max 6 Mb',
    icon:'error',
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close(); 

    }
  });

  }
});


$('#foto_ktp_pasangan').bind('change', function() {
  if(this.files[0].size > 6000000)
  {
    $('#foto_ktp_pasangan').val('');

    Swal.fire({
    title:'Error',
    html:'File Max 6 Mb',
    icon:'error',
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close(); 

    }
  });

  }
});

$('#omset_usaha').maskNumber({
  thousands:'.',
  integer:true,
});

$('#besar_plafon').maskNumber({
  thousands:'.',
  integer:true,
});

});

$(document).on('click','.lihat_syarat',function(){
 $.ajax({
  type : "GET",
  url  : "<?php echo base_url('pengajuan/syarat')?>",
  dataType : "JSON",
  success: function(data){
   $('#ModalSyarat').modal('show');
   $('.isi_syarat').html(data[0].syarat);

 }
});
});


$(document).on('click','.lihat_detail',function(){
 $('#ModalDetail').modal('show');

 $('.nik').html($('#nik').val());
 $('.nama_nasabah').html($('#nama_nasabah').val());
 $('.nama_suami_istri').html($('#nama_suami_istri').val());
 $('.nama_ibu_kandung').html($('#nama_ibu_kandung').val());
 $('.alamat_nasabah').html($('#alamat_nasabah').val());
 $('.nama_usaha_pekerjaan').html($('#nama_usaha_pekerjaan').val());
 $('.alamat_usaha_pekerjaan').html($('#alamat_usaha_pekerjaan').val());
 $('.omset_usaha').html($('#omset_usaha').val());
 $('.besar_plafon').html($('#besar_plafon').val());

 previewFile('foto_ktp');
 previewFile('foto_ktp_pasangan');

 previewFile('foto_usaha');
 previewFile('foto_selfie');

});


function previewFile(id) {
  let file = $('#'+id)[0].files[0];
  let reader = new FileReader();
  reader.addEventListener("load", function () {
    $('.'+id).attr('src',reader.result);
  }, false);
  if (file) {
    reader.readAsDataURL(file);
  }
}




</script>

<div class="modal fade" data-backdrop="static" id="ModalSyarat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif;color: white!important ">Syarat Dan Ketentuan</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal">
      <div class="modal-body">

        <div class="alert alert-default isi_syarat"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Tutup</button>
      </div>
    </form>
  </div>
</div>
</div>

<div class="modal fade" data-backdrop="static" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif;color: white!important ">Detail Pengajuan</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal">
      <div class="modal-body">
        <div class="row">
         <div class="col-lg-12 p-4">
          <div class="col-lg-12"> 
            <h4>Data Diri</h4>
            <hr>
          </div>
          <div class="col-lg-12 "> 
           <div class="row p-2">
            <span class="col-sm-6">NIK</span>
            <span class="nik col-sm-6" style="font-weight: bold;"></span>
          </div>
          

          <div class="row p-2">
            <span class="col-sm-6">Nama Lengkap</span>
            <span class="nama_nasabah col-sm-6" style="font-weight: bold;"></span>
          </div>
          
          <div class="row p-2">
            <span class="col-sm-6">Nama Suami / Istri</span>
            <span class="nama_suami_istri col-sm-6" style="font-weight: bold;"></span>
          </div>
          

          <div class="row p-2">
            <span class="col-sm-6">Nama Ibu Kandung</span>
            <span class="nama_ibu_kandung col-sm-6" style="font-weight: bold;"></span>
          </div>

          <div class="row p-2">
            <span class="col-sm-6">Alamat</span>
            <span class="alamat_nasabah col-sm-6" style="font-weight: bold;"></span>
          </div>


        </div>
      </div>
      <div class="col-lg-12 p-4">
       <div class="col-lg-12"> 
        <h4>Data Usaha / Pekerjaan</h4>
        <hr>
      </div>
      <div class="col-lg-12"> 

        <div class="row p-2">
          <span class="col-sm-6">Nama Usaha/Pekerjaan</span>
          <span class="nama_usaha_pekerjaan col-sm-6" style="font-weight: bold;"></span>
        </div>
        <div class="row p-2">
          <span class="col-sm-6">Alamat Usaha/Pekerjaan</span>
          <span class="alamat_usaha_pekerjaan col-sm-6" style="font-weight: bold;"></span>
        </div>

        <div class="row p-2">
          <span class="col-sm-6">Omset Usaha</span>
          <span class="omset_usaha col-sm-6" style="font-weight: bold;"></span>
        </div>

        <div class="row p-2">
          <span class="col-sm-6">Besar Plafon</span>
          <span class="besar_plafon col-sm-6" style="font-weight: bold;"></span>
        </div>

        

      </div>
    </div>
    <div class="col-lg-12 p-4  mt-3">

     <div class="col-lg-12"> 
      <h4>Lampiran</h4>
      <hr>
    </div>
    <div class="col-lg-12"> 
      <div class="row p-2">
        <span class="col-sm-3">Foto KTP</span>
        <span class="col-sm-3">Foto KTP Suami / Istri</span>
        <span class="col-sm-3">Foto Usaha</span>
        <span class="col-sm-3">Foto Selfie</span>

        <img class="foto_ktp col-sm-3 mt-3" src="<?php echo base_url() ?>assets/img/img03.jpg">
        <img class="foto_ktp_pasangan col-sm-3 mt-3" src="<?php echo base_url() ?>assets/img/img03.jpg">
        <img class="foto_usaha col-sm-3 mt-3" src="<?php echo base_url() ?>assets/img/img03.jpg">
        <img class="foto_selfie col-sm-3 mt-3" src="<?php echo base_url() ?>assets/img/img03.jpg">

      </div>
    </div>
  </div>

</div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Tutup</button>
</div>


</form>
</div>
</div>
</div>

</body>

</html>