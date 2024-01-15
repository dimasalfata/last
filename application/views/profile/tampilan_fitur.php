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
        <h1 class="h3 mb-3 ml-5 text-gray-800">Fitur</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12"> 

             <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> Fitur</button>
             <button id="export" name="export" class="btn btn-sm refresh btn-warning btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>

           </div>
           
         </div>
         <div class="card-body">
          <div class="table-responsive">

            <table  id="tabel_feature"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
              <thead>
                <tr class="bg-primary text-light text-center">
                  <th width="5%">No</th>
                  <th width="25%">Judul</th>
                  <th width="60%">Isi</th>
                  <th style="text-align: center;" width="10%" >Opsi</th>
                </tr>
              </thead>
              <tbody id="show_data">
              </tbody>
            </table>
          </div>
        </div>

        <!-- modal add -->


        <div class="modal fade" data-backdrop="static" id="modal_feature" tabindex="-1" role="dialog" aria-labelledby="modal_featureLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content" >
             <form id="form_feature" method="post" enctype="multipart/form-data" action="<?php echo base_url('profile/simpanabout') ?>">
              <div class="modal-header bg-primary text-light"> 
                <h3 class="modal-title" id="label_header_feature"> <i class="fas fa-receipt mr-2"></i> TAMBAH DATA</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              </div>
              <div class="modal-body">

               <div class="row "> 
                <div class="col-md-6 mb-3"> 
                  <label style="color:#343a40;" for="feature_judul">Judul</label>
                  <input type="hidden" name="feature_id" id="feature_id">
                  <input class="form-control" type="text" name="feature_judul" id="feature_judul">
                </div>  

                <div class="col-md-6 mb-3"> 
                  <label style="color:#343a40;" for="feature_judul">Icon</label>
                  <input class="form-control" type="text" name="feature_icon" id="feature_icon">
                </div>  

                <div class="col-md-12 mb-3"> 
                 <label style="color:#343a40;" for="feature_isi">Isi Fitur</label>
                 <textarea type="text" class="form-control" id="feature_isi"  name="feature_isi" required></textarea>
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

      }
    });
  }
  $('#feature_isi').summernote({
    placeholder: 'About Us',
    tabsize: 2,
    height: 500,
    callbacks: {
      onImageUpload: function(image) {
        uploadImage('feature_isi',image[0]);
      },
      onMediaDelete : function(target) {
        deleteImage(target[0].src);
      }
    }

  });

  dataTable = $('#tabel_feature').DataTable( {
    paginationType:'full_numbers',
    processing: true,
    serverSide: true,
    searching: true,
    filter: false,
    autoWidth:false,
    aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: {
     url: '<?php echo base_url('profile/tabel_feature')?>',
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
  {'data':'feature_judul'},
  {'data':'feature_isi'},
  {'data':'opsi',orderable:false},

  ],   
  columnDefs: [
  {
    targets: [0,-1],
    className: 'text-center'
  },
  ]

});


  function table_data(){
   dataTable.ajax.reload(null,true);
 }


 $(".refresh").click(function(){
   location.reload();
 });



});


 $('#show_data').on('click','.item_hapus_feature',function(){
    let feature_id = $(this).attr('data');
    $('#modal_hapus_feature').modal('show');
    $('#kode_hapus_feature').val(feature_id);

  });



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

  $('#show_data').on('click','.item_edit_feature',function(){
    let feature_id = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('profile/detail_feature')?>",
      dataType : "JSON",
      data : {'feature_id':feature_id},
      success: function(data){
        $('#modal_feature').modal('show');
        $('#form_feature').attr('action','<?php echo base_url('profile/ubah_feature') ?>');
        $('#btn_simpan').html('UBAH');
        $('#label_header_feature').html('<i class="fas fa-receipt mr-2"></i> UBAH DATA  FITUR');
        $('#feature_id').val(feature_id);
        $('#feature_isi').summernote('code',data[0].feature_isi);

        $('#feature_judul').val(data[0].feature_judul);
        $('#feature_icon').val(data[0].feature_icon);
      },

    });
    return false;
  });

  $('#btn_tambah').on('click',function(){
    $('#modal_feature').modal('show');
    $('#form_feature').attr('action','<?php echo base_url('profile/simpan_feature') ?>');
    $('#btn_simpan').html('SIMPAN');
    $('#form_feature').trigger("reset");
    $('#label_header_feature').html('<i class="fas fa-receipt mr-2"></i> TAMBAH DATA FITUR');
  });

  function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka != 8 && angka > 31 && (angka < 48 || angka > 57))
      return false;
    return true;
  }


  $('#btn_simpan').on('click',function(){

    if ($('#feature_judul').val()=='') {
      $('#feature_judul').focus();
      Swal.fire({
        title:'Error',
        text:'Silahkan Masukkan Judul!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

    if ($('#feature_icon').val()=='') {
      $('#feature_icon').focus();
      Swal.fire({
        title:'Error',
        text:'Silahkan Masukkan Icon!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

    if ($('#feature_isi').summernote('isEmpty')) {
      Swal.fire({
        title:'Error',
        text:'Silahkan Isi About Us!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

    $('#btn_simpan').attr('disabled','disabled');
    $('#btn_simpan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');
    $('#form_feature').submit();

  });

  function uploadImage(id,image) {
    var data = new FormData();
    data.append("image", image);
    $.ajax({
      url: "<?php echo site_url('profile/upload_image')?>",
      cache: false,
      contentType: false,
      processData: false,
      data: data,
      type: "POST",
      success: function(url) {
        $('#'+id).summernote("insertImage", url);
      },
      error: function(id,data) {
        console.log(data);
      }
    });
  }

  function deleteImage(src) {
    $.ajax({
      data: {src : src},
      type: "POST",
      url: "<?php echo site_url('profile/delete_image')?>",
      cache: false,
      success: function(response) {
      }
    });
  }


</script>




<div class="modal fade" data-backdrop="static" id="modal_hapus_feature" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-light">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-trash mr-2"></i> Hapus Fitur</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal" method="post" action="<?php echo base_url('profile/hapus_feature') ?>">
      <div class="modal-body">

        <input type="hidden" name="kode_hapus_feature" id="kode_hapus_feature" value=""> 

        <div class="alert alert-danger"><p class="notif_aktivasi">Hapus Data Fitur..?</p></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Batal</button>
        <button class="btn_hapus btn btn-success btn-flat" type="submit" id="btn_hapus"><i class="fas fa-check mr-2"></i>YA</button>
      </div>


    </form>
  </div>
</div>
</div>








