<div class="main-panel">
  <div class="content">
   <style type="text/css">
    input[type="file"]{
      opacity: 0 !important;
      padding: 0 !important;
      width: 100%!important;

    }
    .imagecheck-figure > img {
      width: 100%!important;
    }
  </style>

  <section class="content-header" >
    <div class="container-fluid" >
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
  <section class="content flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
    <div class="row">
      <div class="col-12">
        <h1 class="h3 mb-3 ml-5 text-gray-800">Portofolio</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12">
              <?php if ($this->session->level=="Marketing" && $portofolio == 0) { ?>

               <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> Tambah Portofolio</button>

             <?php } ?> 

             <button id="export" name="export" class="btn btn-sm refresh btn-info btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>
           </div>
         </div>
         <div class="card-body">
          <div class="table-responsive">

            <table  id="tabel_portofolio"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
              <thead>
                <tr class="bg-primary text-light ">
                  <th class="text-center" width="1%">No</th>
                  <th width="15%">Marketing</th>
                  <th width="10%">Telepon</th>
                  <th  width="5%">Twitter</th>
                  <th  width="5%">Facebook</th>
                  <th  width="5%">Instagram</th>
                  <th  width="5%">Linkedin</th>
                  <th  width="10%">Foto</th>
                  <th  width="19%">Sambutan</th>

                  <th width="15%">Alamat</th>
                  <th style="text-align: center;" width="10%" >Opsi</th>
                </tr>
              </thead>
              <tbody id="show_data">
              </tbody>

            </table>
          </div>
        </div>

        <!-- modal add -->


        <div class="modal fade" data-backdrop="static" id="modal_portofolio" tabindex="-1" role="dialog" aria-labelledby="modal_portofolioLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content" >
              <div class="modal-header bg-primary text-light"> 
                <h3 class="modal-title" id="label_header_produk"> <i class="fas fa-building mr-2"></i> TAMBAH DATA USER</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              </div>
              <div class="modal-body">
               <form id="form_portofolio" method="post" enctype="multipart/form-data" action="<?php echo base_url('marketing/simpan') ?>">
                 <div class="row "> 
                  <div class="col-6">  
                    <div class="col-md-12 mb-3"> 
                     <label style="color:#343a40;" for="telepon_portofolio">Telepon</label>
                     <input type="hidden" name="id_portofolio" id="id_portofolio">
                     <input type="text" class="form-control" id="telepon_portofolio"  name="telepon_portofolio" required>
                   </div>
                   <div class="col-md-12 mb-3"> 
                     <label style="color:#343a40;" for="facebook_portofolio">Facebook</label>
                     <input type="text" class="form-control" id="facebook_portofolio"  name="facebook_portofolio" required>
                   </div>
                   <div class="col-md-12 mb-3"> 
                     <label style="color:#343a40;" for="twitter_portofolio">Twitter</label>
                     <input type="text" class="form-control" id="twitter_portofolio"  name="twitter_portofolio" required>
                   </div>
                   <div class="col-md-12 mb-3"> 
                     <label style="color:#343a40;" for="instagram_portofolio">Instagram</label>
                     <input type="text" class="form-control" id="instagram_portofolio"  name="instagram_portofolio" required>
                   </div>

                   <div class="col-md-12 mb-3"> 
                     <label style="color:#343a40;" for="linkedin_portofolio">LinkedIn</label>
                     <input type="text" class="form-control" id="linkedin_portofolio"  name="linkedin_portofolio" required>
                   </div>
                 </div>

                 <div class="col-6">  

                   <div class="col-md-12 mb-3"> 
                    <label style="color:#343a40;" for="alamat_portofolio">Alamat</label>
                     <textarea type="text" class="form-control" id="alamat_portofolio"  name="alamat_portofolio" required rows="5"></textarea>
                   </div>

                    <div class="col-md-12 mb-3"> 
                    <label style="color:#343a40;" for="sambutan_portofolio">Kata Sambutan</label>
                     <textarea type="text" class="form-control" id="sambutan_portofolio"  name="sambutan_portofolio" required rows="5"></textarea>
                   </div>

                   <div class="col-md-4 mb-3"> 
                  <label class="imagecheck">Foto portofolio
                   <input type="hidden" name="lampiran_portofolio_lama" id="lampiran_portofolio_lama">
                   <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_portofolio" id="lampiran_portofolio" onchange="previewFile(this.id)">
                   <figure class="imagecheck-figure">
                    <img src="<?php echo base_url('assets/img/img03.jpg');?>"  class="imagecheck-image" id="preview_lampiran_portofolio">
                  </figure>
                </label>
              </div>
                 </div>
               </div>


           </div>
           <div class="modal-footer">

            <div class="form-group row"class="collapse" id="customer_collapse">

              <div class="col-sm-6">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><b>TUTUP</b></button>

              </div>

              <div class="col-sm-6 float-sm-right">
                <button type="button" class="btn btn-success" id="btn_simpan"><b>TAMBAH</b></button>

              </div>

            </div>



          </div>

        </form>



      </div>
    </div>
  </div> 


  <!-- /.card-body -->
</div>



</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
</div>
<div class="modal fade" data-backdrop="static" id="ModalAktivasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-buildings mr-2"></i> Status Kategori</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal">
      <div class="modal-body">

        <input type="hidden" name="kode_kategori_aktivasi" id="kode_kategori_aktivasi" value=""> 
        <input type="hidden" name="isi_aktivasi" id="isi_aktivasi" value="">  

        <div class="alert alert-danger"><p class="notif_aktivasi"></p></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Batal</button>
        <button class="btn_aktivasi btn btn-success btn-flat" id="btn_aktivasi"><i class="fas fa-check mr-2"></i>YA</button>
      </div>


    </form>
  </div>
</div>
</div>
<script type="text/javascript">


 function previewFile(id) {
    let file = $('#'+id)[0].files[0];
    let reader = new FileReader();
    reader.addEventListener("load", function () {
      $('#preview_'+id).attr('src',reader.result);
    }, false);
    if (file) {
      reader.readAsDataURL(file);
    }
  }

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

      }
    });
  }



  dataTable = $('#tabel_portofolio').DataTable( {
    paginationType:'full_numbers',
    processing: true,
    serverSide: true,
    searching: true,

    filter: false,
    autoWidth:false,
    aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: {
     url: '<?php echo base_url('marketing/tabel_portofolio')?>',
     type: 'get',
     data: function (data) {
     }
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
  // order: [1, 'asc'],
  columns: [
  {'data':'no'},
  {'data':'nama'},
  {'data':'telepon_portofolio'},
  {'data':'twitter_portofolio'},
  {'data':'facebook_portofolio'},
  {'data':'instagram_portofolio'},
  {'data':'linkedin_portofolio'},
  {'data':'foto_portofolio'},
  {'data':'sambutan_portofolio'},
  {'data':'alamat_portofolio'},
  {'data':'opsi',orderable:false},
  ],   
  columnDefs: [
  {
    targets: [0,3,4,5,6,7,-1],
    className: 'text-center'
  },
  

  <?php if ($this->session->level=="Marketing") { ?>
    {

      targets: [1],
      visible:false

    },

  <?php } ?>


  ]

});


  function table_data(){
   dataTable.ajax.reload(null,true);
 }


 $(".refresh").click(function(){
   location.reload();
 });

});

  $('#btn_aktivasi').on('click',function(){
    var kode=$('#kode_kategori_aktivasi').val();
    var isi=$('#isi_aktivasi').val();

    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('marketing/aktivasi_kategori')?>",
      dataType : "JSON",
      data : {'kode': kode,'isi': isi},
      success: function(data){
        let pesan='';
        if (data) {
          if (isi==1) {
            pesan = "Diaktifkan";
          }else{
            pesan = "DiNonaktifkan";
          }
          Swal.fire({
            title:'Berhasil',

            text:'Kategori Produk Berhasil Di '+ pesan,
            icon:'success'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.close();
              $('#ModalAktivasi').modal('hide');

              location.reload();

            }
          });
        }


      }
    });
    return false;
  });

  $('#show_data').on('click','.item_aktivasi_kategori',function(){
    if ($(this).html().includes('check')) {
      $('.notif_aktivasi').html('Aktifkan Kategori... ?');
      $('#isi_aktivasi').val(1);

    }else{
      $('.notif_aktivasi').html('Nonaktifkan Kategori... ?');
      $('#isi_aktivasi').val(0);
    }

    var kode= $(this).attr('data');
    $('#ModalAktivasi').modal('show');
    $('#kode_kategori_aktivasi').val(kode);

    return false;
  });

  $('#show_data').on('click','.item_edit_portofolio',function(){
    let id_portofolio = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('marketing/detail_portofolio')?>",
      dataType : "JSON",
      data : {'id_portofolio':id_portofolio},
      success: function(data){
        $('#modal_portofolio').modal('show');
        $('#form_portofolio').attr('action','<?php echo base_url('marketing/ubah') ?>');
        $('#btn_simpan').html('UBAH');
        $('#label_header_produk').html('<i class="fas fa-id-card mr-2"></i> UBAH PORTOFOLIO');
        $('#id_portofolio').val(id_portofolio);
        $('#telepon_portofolio').val(data[0].telepon_portofolio);
        $('#facebook_portofolio').val(data[0].facebook_portofolio);
        $('#twitter_portofolio').val(data[0].twitter_portofolio);
        $('#instagram_portofolio').val(data[0].instagram_portofolio);
        $('#linkedin_portofolio').val(data[0].linkedin_portofolio);
        $('#sambutan_portofolio').val(data[0].sambutan_portofolio);
        $('#alamat_portofolio').val(data[0].alamat_portofolio);
        $('#lampiran_portofolio_lama').val(data[0].foto_portofolio);

        if (data[0].foto_portofolio!='') {
          $('#preview_lampiran_portofolio').attr('src','<?php echo base_url()?>'+data[0].foto_portofolio);
        }


      },

    });

    return false;
  });

  $('#btn_tambah').on('click',function(){
    $('#modal_portofolio').modal('show');
    $('#form_portofolio').attr('action','<?php echo base_url('marketing/simpan') ?>');
    $('#btn_simpan').html('SIMPAN');

    $('#form_portofolio').trigger("reset");
    $('#label_header_produk').html('<i class="fas fa-id-card mr-2"></i> TAMBAH PORTOFOLIO');
  });




  $('#btn_simpan').on('click',function(){

    let telepon_portofolio = $('#telepon_portofolio').val();
    if (telepon_portofolio=="") {
      $('#telepon_portofolio').focus();
      Swal.fire({
        title:'Telepon Kosong',
        text:'Silahkan Masukkan Telepon!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

    let link = $('#form_portofolio').attr('action');
    if (link.includes('simpan')!==false) {
    let foto = $('#lampiran_portofolio').val();
    if (foto=="") {
      $('#lampiran_portofolio').focus();
      Swal.fire({
        title:'Foto Kosong',
        text:'Silahkan Upload Foto!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }
}

    $('#btn_simpan').attr('disabled','disabled');
    $('#btn_simpan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');

    $('#form_portofolio').submit();
  });


</script>













