<!DOCTYPE html>
<html lang="zxx" class="no-js">
<style type="text/css">
	.single-service > ul
	{
		list-style-type: circle;
	}

	.single-service > li
	{
		margin-top: 25px;
	}

</style>
<?php foreach ($marketing as $key): ?>

	<?php
		$telepon = $key->telepon_portofolio;
		if(substr($key->telepon_portofolio, 0,1)==0) {
			$telepon = "62".substr($key->telepon_portofolio, 1);
		}
	?>
	
	<head>
		<style type="text/css">
			#btn_ajukan:hover{
				color:white!important;
			}
		</style>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="icon" type="image/x-icon" href="<?php echo base_url()?>assets/img/fav.png" />
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Marketing BPR Karangmalang</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700,900" rel="stylesheet">
	<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="<?php echo base_url()?>assets/css/linearicons.css">
			<link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.min.css">
			<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css">
			<link rel="stylesheet" href="<?php echo base_url()?>assets/css/magnific-popup.css">
			<link rel="stylesheet" href="<?php echo base_url()?>assets/css/nice-select.css">
			<link rel="stylesheet" href="<?php echo base_url()?>assets/css/animate.min.css">
			<link rel="stylesheet" href="<?php echo base_url()?>assets/css/owl.carousel.css">
			<link rel="stylesheet" href="<?php echo base_url()?>assets/css/main.css">
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
										<li><a href="#produk_layanan">Produk dan Layanan</a></li>
										<li><a href="https://bprbkk-karangmalang.com/simulasikredit.php" target="_blank">Simulasi Kredit</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</header>
					<!-- End Header Area -->


					<!-- start banner Area -->
					<section class="home-banner-area">
						<div class="container flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
							<div class="row fullscreen d-flex align-items-center">
								<div class="banner-content col-lg-6 col-md-12 justify-content-center ">
									<div class="me wow fadeInDown" data-wow-duration="1s" data-wow-delay="1.2s">Halo, Saya</div>
									<h1 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.7s"><?php echo $key->nama; ?></h1>
									<div class="designation mb-50 wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.1s"> 
										<span class="designer">Bagian <?php echo $key->nama_jabatan; ?></span>
										<br>
										<span class="developer">Di Kantor Cabang <?php echo $key->nama_cabang; ?></span>
										<span>PT. BPR BKK Karangmalang (Perseroda)</span>
									</div>
								<!-- 	<a href="<?php echo base_url() ?>pengajuan/tambah_pengajuan/<?php echo $this->uri->segment(3)?>/" class="primary-btn white mb-1" data-text="Pengajuan Simpanan">
										<span>Pengajuan</span>
										<span>Simpanan</span>

									</a>
									<a href="<?php echo base_url() ?>pengajuan/tambah_pengajuan/<?php echo $this->uri->segment(3) ?>/" class="primary-btn  mb-1" data-text="Pengajuan Kredit">
										<span>Pengajuan</span>
										<span>Kredit</span> -->

									</a>
								</div>
								<div class="banner-img col-lg-6 col-md-12 col-sm-12 col-12 align-self-end">
									<img class="img-fluid" src="<?php echo base_url() .$key->foto_portofolio; ?>" alt="">
								</div>
							</div>
						</div>
					</section>
					<!-- End banner Area -->


					<!-- Start brands Area -->
					<section class="brands-area">
						<div class="container">
							<div class="brand-wrap">
								<div class="row align-items-center active-brand-carusel justify-content-start no-gutters">
									<div class="col single-brand">
										<a target="_blank" class="social-icon" href="https://api.whatsapp.com/send?phone=<?php if(substr($key->telepon_portofolio, 0,1)==0){ echo "62".substr($key->telepon_portofolio, 1);} ?>"><i class="fa fa-whatsapp fa-3x" aria-hidden="true"></i></a>
									</div>

									<div class="col single-brand">
										<a target="_blank" class="social-icon" href="<?php echo $key->instagram_portofolio; ?>"><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a>
									</div>

									<div class="col single-brand">
										<a target="_blank" class="social-icon" href="<?php echo $key->twitter_portofolio; ?>"><i class="fa fa-twitter fa-3x" aria-hidden="true"></i></a>
									</div>

									<div class="col single-brand">
										<a target="_blank" class="social-icon" href="<?php echo $key->facebook_portofolio; ?>"><i class="fa fa-facebook fa-3x" aria-hidden="true"></i></a>
									</div>

								</div>
							</div>
						</div>
					</section>
					<!-- End brands Area -->


					<!-- Start About Area -->
					<section class="about-area section-gap">
						<div class="container">
							<div class="row align-items-center justify-content-between">
								<div class="col-lg-6 col-md-12 col-sm-12 col-12 about-left">
									<img class="img-fluid" src="<?php echo base_url(). $key->foto_portofolio; ?>" alt="">
								</div>
								<div class="col-lg-5 col-md-12 about-right">
									<div class="section-title">
										<h2>about myself</h2>
									</div>
									<div class="mb-50 wow fadeIn" data-wow-duration=".8s">
										<p style="text-align: justify;">
											<?php echo $key->sambutan_portofolio; ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</section>

					<section class="service-area section-gap"   id="produk_layanan">
						<div class="container">

							<div class="row mt-3">
								<div class="col-lg-12">
									<div class="section-title">
										<h2>Produk dan Layanan</h2>

									</div>
								</div>

								<div class="col-lg-12 mb-3">
									<ul class="nav nav-tabs">
										<?php $urut = 1; foreach ($kategori_produk as $kp): ?>
										<li class="nav-item">
											<a
												onclick="getKategoriProduk(`<?= $kp->nama_kategori ?>`)"
												class="
													nav-link tombol_tab
													<?php if ($urut==1){ echo "active"; } ?>
												"
												aria-current="page"
												href="javascript:void(0);"
												data="list<?php echo $kp->id_kategori?>">
												<?php echo $kp->nama_kategori; ?>
													
											</a>
										</li>
										<?php $urut++; endforeach ?>
									</ul>
								</div>
							</div>

							<?php $no=1; foreach ($kategori_produk as $kp): ?>
							<?php if ($no==1){ ?>
								<div class="row list<?php echo $kp->id_kategori?> list_produk">

								<?php }else { ?>
									<div class="row list<?php echo $kp->id_kategori?> list_produk d-none">
									<?php } ?>

									<?php $i=1; foreach ($produk as $prd): ?>
									<?php if ($prd->id_kategori==$kp->id_kategori): ?>

										<div class="col-lg-4 col-md-6 detailproduk" data="<?php echo $prd->id_produk ?>" 

											<?php if ($i % 2==0){ ?>
												style="background: #e45447;cursor: pointer;"
												d
											<?php } else { ?>
												style="background: #90acd1;cursor: pointer;"
											<?php } ?>
											>

											<div class="single-service wow fadeInUp" data-wow-duration="1s">
												<span class="lnr"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></span>
												<h4>
													<span><?php echo  $prd->nama_produk; ?></span>
												</h4>
											</p>


										</div>
									</div>
								<?php endif ?>
								<?php $i++; endforeach ?>

							</div>
							<?php $no++; endforeach ?>

						</div>
					</section>
					<!-- End Service Area -->

					<!-- Start Contact Area -->
					<section class="contact-area section-gap">
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
									<div class="contact-title">
										<h2>Contact Me</h2>
										<p>Hubungi Kami Jika Butuh Bantuan</p>
									</div>
								</div>
							</div>
							<div class="row mt-80">
								<div class="col-lg-4 col-md-4">
									<div class="contact-box">
										<h5 class="text-white"><?php echo $key->telepon_portofolio; ?></h5 class="text-white">
										</div>
									</div>
									<div class="col-lg-4 col-md-4">
										<div class="contact-box">
											<h5 class="text-white"><?php echo $key->email; ?></h5 class="text-white">
											</div>
										</div>
										<div class="col-lg-4 col-md-4">
											<div class="contact-box">
												<h5 class="text-white">www.bprbkk-karangmalang.com</h5 class="text-white">
												</div>
											</div>
										</div>


									</div>
								</section>
								<footer class="footer-area">
									<?php foreach ($profile as $pp): ?>
										<div class="container">
											<div class="row justify-content-center">
												<div class="col-lg-12">
													<div class="footer-top flex-column">
														<div class="footer-logo">
															<a href="#">
																<img src="<?php echo base_url().$pp->logo_profile?>" alt="" width="12%">
															</a>
															<h4><?php echo $pp->pemilik; ?></h4>
															<h6 style="color: #777777"><?php echo $pp->alamat_profile; ?></h6>
															<br>
														</div>
														<div class="footer-social">
															<a target="_blank" class="social-icon" href="https://api.whatsapp.com/send?phone=<?php if(substr($pp->telp_profile, 0,1)==0){ echo "62".substr($pp->telp_profile, 1);} ?>"><i class="fa fa-whatsapp fa-3x" aria-hidden="true"></i></a>
															<a href="mailto:<?php echo $pp->email_profile ?>" target="_blank"><i class="fa fa-envelope"></i></a>
															<a href="https://<?php echo $pp->website ?>" target="_blank"><i class="fa fa-globe"></i></a>
														</div>
													</div>
												</div>
											</div>
											<div class="row footer-bottom justify-content-center">
												<p class="col-lg-8 col-sm-12 footer-text">
													<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

													Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | by <a href="https://<?php echo $pp->website ?>" target="_blank"><?php echo $pp->pemilik; ?></a>
													<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
												</div>
											</div>
										<?php endforeach ?>

									</footer>
									<!-- End footer Area -->

									<!-- ####################### Start Scroll to Top Area ####################### -->
									<div id="back-top">
										<a title="Go to Top" href="#">
											<i class="lnr lnr-arrow-up"></i>
										</a>
									</div>
									<!-- ####################### End Scroll to Top Area ####################### -->

									<script src="<?php echo base_url()?>assets/js/vendor/jquery-2.2.4.min.js"></script>
									<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
									crossorigin="anonymous"></script>
									<script src="<?php echo base_url()?>assets/js/vendor/bootstrap.min.js"></script>
									<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
									<script src="<?php echo base_url()?>assets/js/easing.min.js"></script>
									<script src="<?php echo base_url()?>assets/js/hoverIntent.js"></script>
									<script src="<?php echo base_url()?>assets/js/superfish.min.js"></script>
									<script src="<?php echo base_url()?>assets/js/mn-accordion.js"></script>
									<script src="<?php echo base_url()?>assets/js/jquery.ajaxchimp.min.js"></script>
									<script src="<?php echo base_url()?>assets/js/jquery.magnific-popup.min.js"></script>
									<script src="<?php echo base_url()?>assets/js/owl.carousel.min.js"></script>
									<script src="<?php echo base_url()?>assets/js/jquery.nice-select.min.js"></script>
									<script src="<?php echo base_url()?>assets/js/isotope.pkgd.min.js"></script>
									<script src="<?php echo base_url()?>assets/js/jquery.circlechart.js"></script>
									<script src="<?php echo base_url()?>assets/js/mail-script.js"></script>
									<script src="<?php echo base_url()?>assets/js/wow.min.js"></script>
									<script src="<?php echo base_url()?>assets/js/main.js"></script>
								</body>
								<script type="text/javascript">
									$('.tombol_tab').on('click',function(){
										let data = $(this).attr('data');
										$('.tombol_tab').each(function(){
											$(this).removeClass('active');
										})

										$('.list_produk').each(function(){
											$(this).addClass('d-none');
										})

										$(this).addClass('active');

										$('.'+data).removeClass('d-none');
										return false;
									});

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


									});

									$(document).on('click','.detailproduk',function(){
										let id_produk = $(this).attr('data');
										$.ajax({
											type : "GET",
											url  : "<?php echo base_url('marketing/detail_produk')?>",
											dataType : "JSON",
											data : {'id_produk':id_produk},
											success: function(data){
												$('#modal_detail_produk').modal('show');
												$('.foto_produk').attr('src','<?php echo base_url() ?>'+data[0].foto_produk);
												$('.keterangan_produk').html(data[0].keterangan_produk);
												$('#btn_ajukan').attr('href','<?php echo base_url() ?>pengajuan/tambah_pengajuan/'+id_produk+'/<?php echo $this->uri->segment(3) ?>');
											}
										});
									});
								</script>
								</html>



							<?php endforeach ?>

							<div class="modal fade" data-backdrop="static" id="modal_detail_produk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">

										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" class="btn btn-light" aria-label="Close"><span aria-hidden="true">x</span></button>
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

										<div class="modal-footer" id="modal-footer-btn">
									    </div>
								
								</div>
							</div>
						</div>

<script type="text/javascript">
	function getKategoriProduk(name) {


		if((name == "Simpanan") || (name == "Deposito") || (name == "Lainnya")) {

			$("#modal-footer-btn").html(`
				<a
					href="https://wa.me/<?= $telepon ?>"
					target="_blank"
					class="btn w-100"
					style="border:1px solid white!important;font-size: 18px;background: #00f721;color:white;border-radius: 15px"
				>
					<i class="fa fa-whatsapp fa-3x" aria-hidden="true"></i>
					Hubungi Sekarang
				</a>
			`)

		} else {

			$("#modal-footer-btn").html(`
				<a
					id="btn_ajukan"
					href=""
					class="btn w-100"
					data-text="Ajukan Sekarang"
					style="border:1px solid white!important;font-size: 18px;background: #00f721;color:white;border-radius: 15px"
				>
					<span>Ajukan</span>
					<span>Sekarang</span>
				</a>
			`)
		}
	}getKategoriProduk('Kredit Modal Kerja')
</script>