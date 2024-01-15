


<!-- Begin Page Content -->
<div class="container-fluid flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>" data-logout="<?php echo $this->session->flashdata('logout'); ?>">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </a>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2"> <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengajuan Tahun <?php echo date('Y'); ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php if (count($pengajuan_total)  > 0) {
                                    foreach ($pengajuan_total as $pt) {
                                        echo "Rp. ".number_format($pt->jumlah,0,",",".");
                                    }
                                }else{ ?>
                                 <?php echo "Rp. 0"; ?>
                             <?php } ?>
                         </div>
                     </div>
                     <div class="col-auto">
                        <i class="fas fa-money-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Potensi Wilayah Tahun <?php echo date('Y'); ?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php if (count($potensi_total)  > 0) {
                                foreach ($potensi_total as $key) {
                                    echo number_format($key->jumlah,0,",",".")." Calon Nasabah";
                                }
                            }else{ ?>
                             <?php echo "0"; ?>
                             <?php } ?></div>
                         </div>
                         <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Progress Penanganan Pengajuan Online
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <?php if ($jumlah_pengajuan > 0) {$persentase = round($total_progress / $jumlah_pengajuan * 100);}else{$persentase=0;};?>

                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $persentase; ?>%</div>
                                </div>
                                <div class="col">

                                    <div class="progress progress-sm mr-2">
                                        <?php if (floatval($persentase) < 60 ) { ?>
                                         <div class="progress-bar bg-danger" role="progressbar"
                                     <?php }else{ ?>
                                        <div class="progress-bar bg-info" role="progressbar"
                                    <?php } ?>
                                    style="width: <?php echo $persentase.'%'; ?>" aria-valuenow="<?php echo $persentase ?>" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pengajuan Menunggu</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nasabah_baru; ?> Calon Nasabah</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary text-center">INFORMASI PRODUK</h6>

        </div>
        <!-- Card Body -->
        <div class="card-body p-3">
            <div class="row mt-3">
                <div class="col-lg-12 mb-3">
                    <ul class="nav nav-tabs">
                        <?php $urut = 1; foreach ($kategori_produk as $kp): ?>
                        <li class="nav-item">
                            <a class="nav-link tombol_tab
                            <?php if ($urut==1){ echo "active"; } ?>
                            " aria-current="page" href="#" data="list<?php echo $kp->id_kategori?>"><?php echo $kp->nama_kategori; ?></a>
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

                        <div class="col-lg-4 col-md-6 detailproduk mb-3" data="<?php echo $prd->id_produk ?>" style="cursor: pointer;">
                           <div class="card p-3">
                            <div class="form-group text-center d-flex flex-row align-items-center justify-content-center">
                               <i class="fas fa-money-check mr-4 fa-3x text-primary" aria-hidden="true"></i>
                               <span class="text-center text-primary" style="font-size: 1.5em"><?php echo  $prd->nama_produk; ?></span>
                           </div>
                       </div>
                   </div>
               <?php endif ?>
               <?php $i++; endforeach ?>

           </div>
           <?php $no++; endforeach ?>

       </div>
   </div>
</div>

</div>


</div>
<!-- /.container-fluid -->

</div>
<script type="text/javascript">
    $(document).ready(function(){

        const notif = $('.flashdatart').data('title');
        if (notif) {
            Swal.fire({
                title:notif,
                text:$('.flashdatart').data('text'),
                icon:$('.flashdatart').data('icon'),
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.close(); 
                    if ($('.flashdatart').data('logout')=="Y") {
                        window.location.href='<?php echo base_url('login/logout') ?>';
                    }

                }
            });
        }
    });

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

    $(document).on('click','.detailproduk',function(){
        let id_produk = $(this).attr('data');
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('dashboard/detail_produk')?>",
            dataType : "JSON",
            data : {'id_produk':id_produk},
            success: function(data){
                if (data.length > 0) {
                    $('#modal_detail_produk').modal('show');
                    $('.foto_produk').attr('src','<?php echo base_url() ?>'+data[0].informasi_foto);
                    $('.keterangan_produk').html(data[0].informasi_produk);
                }else{
                 Swal.fire({
                    title:'Error',
                    text:'Informasi Produk Tidak Ditemukan!',
                    icon:'error'
                }).then((result) => {
                    if (result.isConfirmed) {
                      Swal.close();
                  }
              });
                return false;
            }
        }
    });
    });

</script>

<div class="modal fade" data-backdrop="static" id="modal_detail_produk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form class="form-horizontal">
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
                
            </form>
        </div>
    </div>
</div>

<!-- End of Main Content -->
