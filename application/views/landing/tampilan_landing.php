<!DOCTYPE html>
<html lang="en">
<?php foreach ($landing['profil'] as $key) { ?>
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $key->nama_website; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo base_url().$key->logo_profile ?>" rel="icon">
    <link href="<?php echo base_url().$key->logo_profile ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url() ?>assets_landing/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_landing/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_landing/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_landing/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_landing/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/select2.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="<?php echo base_url() ?>assets_landing/css/style.css" rel="stylesheet">

    <style type="text/css">
     .btn-buy {
    background: #106eea;
    display: inline-block;
    padding: 8px 35px 10px 35px;
    border-radius: 4px;
    color: #fff;
    transition: none;
    font-size: 14px;
    font-weight: 400;
    font-family: "Roboto", sans-serif;
    font-weight: 600;
    transition: 0.3s;
    text-align:center;
}

      .select2-selection__rendered {
        line-height: 31px !important;
      }
      .select2-container .select2-selection--single {
        height: 40px !important;
      }
      .select2-selection__arrow {
        height: 34px !important;
      }

    </style>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
    <div class="container d-flex align-items-center justify-content-between flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">

      <h1 class="logo"><a href="<?php echo base_url('landing') ?>"><img src="<?php echo base_url().$key->logo_profile ?>" style="margin-right: 20px"><?php echo $key->nama_website; ?></a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#team">Marketing</a></li>
          <!-- <li><a class="nav-link scrollto" href="#about">About</a></li> -->
          <!-- <li><a class="nav-link scrollto" href="#services">Simulasi</a></li> -->
          <li><a class="nav-link scrollto " href="#track-pengajuan">Track Pengajuan</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Galeri</a></li>
          <li><a class="nav-link scrollto" href="#pricing">Produk</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>

          <?php if ($this->session->login) {?>
            <li><button class="btn btn-primary btn-sm btn_member_area" style="width: 100%!important">Member Area</button></li>
            
          <?php  }else{ ?>
            <li><button class="btn btn-primary btn-sm btn_login_member" style="width: 100%!important">Login</button></li>
          <?php  } ?>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>

      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1>Selamat Datang di <br/><span><?php echo $key->nama_website; ?></span></h1>
      <h2><?php echo $key->sambutan; ?></h2>
      <div class="d-flex">
        <a href="#pricing" class="btn-get-started scrollto">Produk Kami</a>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">
    <section id="team" class="team section-bg">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>MARKETING</h2>
      <h3>Tim Marketing <span>Kami</span></h3>
      <p>Marketing PT. BPR BKK Karangmalang (Perseroda) selalu melayani nasabah dengan segenap hati.</p>
    </div>
    <div class="row d-flex flex-row mb-3 justify-content-center">
      <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">

        <span class="input-group-text bg-primary text-light ">Cabang</span>
        <select class="form-control " id="cabang_marketing" name="cabang_marketing">
          <option value="0"  selected style="width: 100%">Pilih Cabang</option>
          <?php foreach ($landing['cabang'] as $cb): ?>
            <option value="<?php echo $cb->id_cabang ?>"><?php echo $cb->nama_cabang; ?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="row list_mkt">

      <?php foreach ($landing['marketing'] as $mkt): ?>
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="member" style="cursor: pointer;" onclick="buka_portofolio(<?php echo $mkt->id_user; ?>)">
            <div class="member-img">
              <img src="<?php echo base_url().$mkt->foto ?>" class="img-fluid" alt="">
              <div class="social">
                <a href="<?php echo $mkt->twitter_portofolio ?>" target="_blank"><i class="bi bi-twitter"></i></a>
                <a href="<?php echo $mkt->facebook_portofolio ?>" target="_blank"><i class="bi bi-facebook"></i></a>
                <a href="<?php echo $mkt->instagram_portofolio ?>" target="_blank"><i class="bi bi-instagram"></i></a>
                <a href="<?php echo $mkt->linkedin_portofolio ?>" target="_blank"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info">
              <h4><?php echo $mkt->nama; ?></h4>
              <span>Marketing <?php echo $mkt->nama_cabang; ?> <?php if ($mkt->telepon_portofolio!="") {?>
                | <?php echo $mkt->telepon_portofolio; } ?>
              </span>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section><!-- End Team Section -->

    <!-- ======= Featured Services Section ======= -->
    <?php if(count($landing['feature']) > 0) {?>
      <section id="featured-services" class="featured-services d-none">
        <div class="container" data-aos="fade-up">

          <div class="row">
            <?php foreach ($landing['feature'] as $f): ?>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                  <div class="icon"><?php echo $f->feature_icon; ?></div>
                  <h4 class="title"><a href=""><?php echo $f->feature_judul; ?></a></h4>
                  <p class="description"><?php echo $f->feature_isi; ?></p>
                </div>
              </div>
            <?php endforeach ?>

          </div>

        </div>
      </section>
    <?php } ?>
    <!-- ======= About Section ======= -->
    <?php if (count($landing['about_us'])>0) { ?>
      <?php foreach ($landing['about_us'] as $ab): ?>


        <section id="about" class="about section-bg d-none">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>About</h2>
              <h3><span>About Us</span></h3>

            </div>

            <div class="row">
              <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                <img src="<?php echo base_url().$ab->about_foto ?>" class="img-fluid" alt="">
              </div>
              <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <?php echo  $ab->about_isi; ?>
              </div>
            </div>

          </div>
        </section><!-- End About Section -->

      <?php endforeach ?>
    <?php   } ?>
    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts d-none">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-emoji-smile"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $landing['happy_client'] ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Happy Clients</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="bi bi-journal-richtext"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $landing['projects'] ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Projects</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-headset"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $landing['visitor'] ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Visitor</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-people"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $landing['subscriber'] ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Subscriber</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->
    <section id="clients" class="clients section-bg d-none">
     <div class="section-title">
      <h2 style="margin-top: 25px">Our Clients</h2>

    </div>
    <div class="container" data-aos="zoom-in">
      <div class="row">
        <?php foreach ($landing['clients'] as $cl): ?>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="<?php echo base_url().$cl->clients_logo ?>" class="img-fluid" alt="">
          </div>
        <?php endforeach ?>

      </div>

    </div>
  </section>
  <section id="testimonials" class="testimonials">
    <div class="container" data-aos="zoom-in">

      <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
          <?php foreach ($landing['testimoni'] as $tm): ?>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="<?php echo base_url().$tm->testimoni_foto ?>" class="testimonial-img" alt="">
                <h3><?php echo $tm->testimoni_nama; ?></h3>
                <h4><?php echo $tm->testimoni_jabatan; ?></h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  <?php echo $tm->testimoni_isi; ?>
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>

            <?php endforeach ?>

          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>
  </section><!-- End Testimonials Section -->
 <!-- ======= Track Pengajuan ======= -->
 <section id="track-pengajuan" class="team">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>Track</h2>
        <h3>Lacak <span>Pengajuan</span></h3>
        <p>Masukkan kode pengajuan</p>
      </div>

      <div class="row d-flex justify-content-center">

          <div class="col-12 col-md-4">
            <form id="form-track">
              <input type="text" name="kode" class="form-control" required placeholder="Ketik kode pengajuan">
            </form>

            <br>
            <div class="text-center">
              <button type="submit" class="btn btn-primary" form="form-track">Cari</button>
            </div>
          </div>

        <div id="div-track"></div>
      </div>
    </div>
  </section>

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Galeri</h2>
        <h3>Check our <span>Gallery</span></h3>
      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">

            <li data-filter="*" class="filter-active">All</li>
            <?php foreach ($landing['kategori'] as $ktg): ?>
              <li data-filter=".filter-<?php echo $ktg->id_kategori  ?>"><?php echo $ktg->nama_kategori; ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
       <?php foreach ($landing['galeri'] as $gl): ?>
        <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo $gl->id_kategori  ?>">
          <img src="<?php echo base_url().$gl->gambar_foto ?>" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4><?php echo $gl->judul_foto; ?></h4>
            <p><?php echo $gl->deskripsi_foto; ?></p>
            <a href="<?php echo base_url().$gl->gambar_foto ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>

          </div>
        </div>
      <?php endforeach ?>



    </div>

  </div>
</section><!-- End Portfolio Section -->
<!-- ======= Team Section ======= -->


<!-- ======= Pricing Section ======= -->
<section id="pricing" class="pricing">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Produk</h2>
      <h3>Check our <span>Produk</span></h3>

    </div>

    <div class="row">
     <?php foreach ($landing['kategori'] as $ktg): ?>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <?php if (strtolower($ktg->nama_kategori)=="simpanan") { ?>
          <div class="box featured">
          <?php }else{ ?>
            <div class="box">
            <?php } ?>
            <h3><?php echo $ktg->nama_kategori; ?></h3>
            <ul>
              <?php foreach ($landing['produk'] as $prd) {

                if ($prd->id_kategori==$ktg->id_kategori) { ?>

                  <li><a href="javascript:;" class="btn btn-transparent btn_detail_produk" data="<?php echo $prd->id_produk; ?>"><?php echo $prd->nama_produk; ?></a></li>

                <?php  }} ?>
              </ul>
              <?php
              if ($ktg->id_kategori <= 3) {?>
              <div class="btn-wrap">
                <a href="<?php echo base_url() ?>pengajuan/tambah_pengajuan/<?php echo $ktg->id_kategori ?>" class="btn-buy">Ajukan Sekarang</a>
              </div>
              <?php } ?>
            </div>
          </div>
        <?php endforeach ?>
      </div>

    </div>
  </section><!-- End Pricing Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Contact</h2>
        <h3><span>Contact Us</span></h3>
      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-4">
          <div class="info-box mb-4">
            <i class="bx bx-map"></i>
            <h3>Our Address</h3>
            <p><?php echo $key->alamat_profile; ?></p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="info-box  mb-4">
            <i class="bx bx-envelope"></i>
            <h3>Email Us</h3>
            <p><?php echo $key->email_profile; ?></p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="info-box  mb-4">
            <i class="bx bx-phone-call"></i>
            <h3>Call Us</h3>
            <p><?php echo $key->telp_profile; ?></p>
          </div>
        </div>

      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">

        <div class="col-lg-12 ">
          <iframe class="mb-4 mb-lg-0" src="<?php echo $key->map_profile ?>" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
        </div>

        <div class="col-lg-6 d-none">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="col form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>

    </div>
  </section>



</main>
<footer id="footer">

  <div class="footer-newsletter d-none">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <h4>Join Our Newsletter</h4>
          <p>Berlangganan Untuk Mendapatkan Penawaran Terbaik</p>
          <form action="" method="post" id="form_langganan">
            <input type="email" name="email_langganan" id="email_langganan"><input type="submit" value="Subscribe" id="btn_langganan" class="btn-primary">
          </form>
        </div>

      </div>
      <small class="text-danger error-email text-left"></small>

    </div>
  </div>

  <?php if (count($landing['pengawas']) > 0) { ?>

   <section id="clients" class="clients section-bg">
    <div class="container" data-aos="zoom-in">
      <div class="row">
        <?php foreach ($landing['pengawas'] as $cl): ?>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="<?php echo base_url().$cl->pengawas_logo ?>" class="img-fluid" alt="">
          </div>
        <?php endforeach ?>

      </div>

    </div>
  </section>

<?php } ?>

<div class="footer-top">
  <div class="container">
    <div class="row">

      <div class="col-lg-6 col-md-6 footer-contact">
        <h3><img src="<?php echo base_url().$key->logo_profile ?>" style="margin-right: 20px"><span><?php echo $key->nama_website; ?></span></h3>
        <p>
          <?php echo $key->alamat_profile; ?><br>
          <strong>Phone:</strong> <?php echo $key->telp_profile; ?><br>
          <strong>Email:</strong><?php echo $key->email_profile; ?><br>
        </p>
      </div>


      <div class="col-lg-6 col-md-6 footer-links">
        <h4>Our Social Networks</h4>
        <div class="social-links mt-3">
          <a href="<?php echo $key->twitter ?>" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="<?php echo $key->facebook ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="<?php echo $key->instagram ?>" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="<?php echo $key->youtube ?>" class="youtube"><i class="bx bxl-youtube"></i></a>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="container py-4">
  <div class="copyright">
    &copy; Copyright <strong><span><?php echo $key->nama_website; ?></span></strong>. All Rights Reserved
  </div>

</div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?php echo base_url() ?>assets_landing/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/purecounter/purecounter.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/aos/aos.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/waypoints/noframework.waypoints.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/php-email-form/validate.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.js"></script>
<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>

<!-- Template Main JS File -->
<script src="<?php echo base_url() ?>assets_landing/js/main.js"></script>
<script type="text/javascript">
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

  $('#cabang_marketing').select2({
    placeholder:"Pilih Cabang",
    allowClear:true,
  });

  $('.btn_member_area').on('click',function(){
    window.location.href='<?php echo base_url('dashboard') ?>';
  });
  $('.btn_login_member').on('click',function(){
    window.location.href='<?php echo base_url('login') ?>';
  });

  $('#btn_langganan').on('click',function(e){
    e.preventDefault();
    let email_langganan = $('#email_langganan').val();
    if (email_langganan=="") {
      $('#email_langganan').focus();
      $('.error-email').html('Email Kosong');
      return false;

    }else{
      let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
      if (!testEmail.test(email_langganan))
      {
       $('#email_langganan').focus();
       $('.error-email').html('Silahkan Masukkan Email yang Valid');
       return false;

     }else{
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('landing/simpan')?>",
        dataType : "JSON",
        data : {'email_langganan':email_langganan},
        success: function(data){
          if (data==0) {
            $('.error-email').html('Subscribe Gagal');
          }else{
            $('#btn_langganan').val('Subscribed');
            $('#email_langganan').attr('disabled','disabled');
          }
        },
      });


    }

  }

});

  $('#cabang_marketing').on('change',function(){
    let id_cabang = $(this).val();
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('landing/get_marketing')?>",
      dataType : "JSON",
      data : {'id_cabang':id_cabang},
      success: function(data){
        if (data.length > 0) {
          let mkt = '';
          for (i=0;i<data.length; i++){
            mkt+='<div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100"><div class="member" style="cursor: pointer;" onclick="buka_portofolio('+data[i].id_user+')"><div class="member-img"><img src="<?php echo base_url()?>'+data[i].foto+'" class="img-fluid" alt=""><div class="social"><a href="'+data[i].twitter_portofolio+'" target="_blank"><i class="bi bi-twitter"></i></a><a href="'+data[i].facebook_portofolio+'" target="_blank"><i class="bi bi-facebook"></i></a><a href="'+data[i].instagram_portofolio+'" target="_blank"><i class="bi bi-instagram"></i></a><a href="'+data[i].linkedin_portofolio+'" target="_blank"><i class="bi bi-linkedin"></i></a></div></div><div class="member-info"><h4>'+data[i].nama+'</h4><span>Marketing '+data[i].nama_cabang;

            if (data[i].telepon_portofolio!="") {
              mkt+=' | '+data[i].telepon_portofolio;
            }

            mkt+='</span></div></div></div>';

          }

            $('.list_mkt').html(mkt);


      }else{
           Swal.fire({
            title:'Error',
            text:'Data Tidak Di Temukan!',
            icon:'error'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.close();
              $('#cabang_marketing').val(0).trigger('change');
            }
          });
          return false;
        }
    }


  });

  });
})

  function buka_portofolio(id)
  {
    window.location.href="<?php echo base_url() ?>marketing/bpr/"+id
  }

  $(document).on('click','.close_modal',function(){
    $('#modal_detail_produk').modal('hide');

  });

  $(document).on('click','.btn_detail_produk',function(){
    let id_produk = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('landing/detail_produk')?>",
      dataType : "JSON",
      data : {'id_produk':id_produk},
      success: function(data){
        console.log(data);
        // $('#modal_detail_produk').modal('show');
        if(data[0].keterangan_produk!='' && data[0].keterangan_produk!=null)
        {

        $('#modal_detail_produk').modal('show');
												$('.foto_produk').attr('src','<?php echo base_url() ?>'+data[0].foto_produk);
												$('.keterangan_produk').html(data[0].keterangan_produk);
												$('#btn_ajukan').attr('href','<?php echo base_url() ?>pengajuan/tambah_pengajuan/'+id_produk);
                      }else{
                        return false;
                      }
											
      },

    });
  });
</script>
<div class="modal fade" data-backdrop="static" id="modal_detail_produk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">

										<form class="form-horizontal">
											<div class="modal-header ">
                       
												<button type="button"  data-dismiss="modal" class="btn btn-outline-light text-dark close_modal" aria-label="Close" style="position:absolute;top:0px;right:0px;"><span aria-hidden="true">x</span></button>
											</div>


											<div class="modal-body">
												<div class="row p-3">
													<div class="col-md-12 mb-3 ">
														<center><img src="" class="foto_produk" width="50%"></center>
													</div>

													<div class="col-md-12 mb-3 mt-3">
														<p class="keterangan_produk"></p>
													</div>
													
												</div>
											</div>
                  <?php
                  if ($ktg->id_kategori <= 3) {?>
											<div class="modal-footer">
												<a id="btn_ajukan" href=""
												class="btn-buy w-100"
												data-text="Ajukan Sekarang">
												<span>Ajukan</span>
												<span>Sekarang</span>
											</a>
										</div>
                  <?php } ?>
									</form>
								</div>
							</div>
</body>

<?php } ?>

<script type="text/javascript">
    $('#form-track').on('submit', function (e) {
        e.preventDefault()

        $.ajax({
            url: "<?= site_url('landing/track') ?>",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,

            beforeSend: () => {
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

            success: (data) => {
                if(data.status == false) {
                    return Swal.fire('Kode Pengajuan Tidak Ditemukan!', 'Gunakan Kode Pengajuan Lain', 'warning')
                }

                Swal.close()

                $('#div-track').html(data)
            },

            error: () => {
                Swal.fire('Gagal', 'Ada Kesalahan Pada Sistem', 'error')
            }
        })
    })
</script>


</html>