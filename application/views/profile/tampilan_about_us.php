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
        <h1 class="h3 mb-3 ml-5 text-gray-800">About Us</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12"> 

             <!-- Button trigger modal -->
             <?php if ($about_us < 1) { ?>

               <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> About Us</button>
             <?php } ?>
             <button id="export" name="export" class="btn btn-sm refresh btn-warning btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>

           </div>
           
         </div>
         <div class="card-body">
          <div class="table-responsive">

            <table  id="tabel_about"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
              <thead>
                <tr class="bg-primary text-light text-center">
                  <th width="5%">No</th>
                  <th width="70%">About Us</th>
                  <th width="15%">Foto</th>

                  <th style="text-align: center;" width="10%" >Opsi</th>
                </tr>
              </thead>
              <tbody id="show_data">
              </tbody>
            </table>
          </div>
        </div>

        <!-- modal add -->


        <div class="modal fade" data-backdrop="static" id="modal_about" tabindex="-1" role="dialog" aria-labelledby="modal_aboutLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content" >
             <form id="form_about" method="post" enctype="multipart/form-data" action="<?php echo base_url('profile/simpanabout') ?>">
              <div class="modal-header bg-primary text-light"> 
                <h3 class="modal-title" id="label_header_about"> <i class="fas fa-receipt mr-2"></i> TAMBAH DATA</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              </div>
              <div class="modal-body">

               <div class="row "> 
                <div class="col-md-9 mb-3"> 
                 <label style="color:#343a40;" for="about_us_isi">About Us</label>
                 <input type="hidden" name="about_id" id="about_id">
                 <textarea type="text" class="form-control" id="about_us_isi"  name="about_us_isi" required></textarea>
               </div>  
               <div class="col-md-3 mb-3"> 
                <label class="imagecheck">Foto
                 <input type="hidden" name="lampiran_foto_lama" id="lampiran_foto_lama">
                 <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_foto" id="lampiran_foto" onchange="previewFile(this.id)">
                 <figure class="imagecheck-figure">
                  <img src="<?php echo base_url('assets/img/img03.jpg');?>"  class="imagecheck-image" id="preview_lampiran_foto">
                </figure>
              </label>

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
  $('#about_us_isi').summernote({
    placeholder: 'About Us',
    tabsize: 2,
    height: 500,
    callbacks: {
      onImageUpload: function(image) {
        uploadImage('about_us_isi',image[0]);
      },
      onMediaDelete : function(target) {
        deleteImage(target[0].src);
      }
    }

  });

  dataTable = $('#tabel_about').DataTable( {
    paginationType:'full_numbers',
    processing: true,
    serverSide: true,
    searching: true,
    filter: false,
    autoWidth:false,
    aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: {
     url: '<?php echo base_url('profile/tabel_about')?>',
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
  {'data':'about_isi'},
  {'data':'about_foto'},

  {'data':'opsi',orderable:false},

  ],   
  columnDefs: [
  {
    targets: [0,2,-1],
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

  $('#show_data').on('click','.item_edit_about',function(){
    let about_id = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('profile/detail_about')?>",
      dataType : "JSON",
      data : {'about_id':about_id},
      success: function(data){
        $('#modal_about').modal('show');
        $('#form_about').attr('action','<?php echo base_url('profile/ubah_about') ?>');
        $('#btn_simpan').html('UBAH');
        $('#label_header_about').html('<i class="fas fa-receipt mr-2"></i> UBAH DATA  ABOUT US');
        $('#about_id').val(about_id);
        $('#about_us_isi').summernote('code',data[0].about_isi);
        $('#lampiran_foto_lama').val(data[0].about_foto);
        if (data[0].about_foto!='') {
          $('#preview_lampiran_foto').attr('src','<?php echo base_url() ?>'+data[0].about_foto);
        }

      },

    });
    return false;
  });

  $('#btn_tambah').on('click',function(){
    $('#modal_about').modal('show');
    $('#form_about').attr('action','<?php echo base_url('profile/simpan_about') ?>');
    $('#btn_simpan').html('SIMPAN');

    $('#form_about').trigger("reset");
    $('#preview_lampiran_profile').attr('src','<?php echo base_url()?>assets/img/img03.jpg');

    $('#label_header_about').html('<i class="fas fa-receipt mr-2"></i> TAMBAH DATA ABOUT US');
  });

  function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka != 8 && angka > 31 && (angka < 48 || angka > 57))
      return false;
    return true;
  }


  $('#btn_simpan').on('click',function(){

 if ($('#about_us_isi').summernote('isEmpty')) {
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
  let link = $('#form_about').attr('action');
  if (link.includes('simpan')!==false) {
    let lampiran_foto = $('#lampiran_foto').val();
    if (lampiran_foto=='') {
     Swal.fire({
      title:'Error',
      text:'Silahkan Upload Foto!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });
    return false;
  }else{
    $('#btn_simpan').attr('disabled','disabled');
    $('#btn_simpan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');
    $('#form_about').submit();
  }
}else{

  $('#btn_simpan').attr('disabled','disabled');
  $('#btn_simpan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');
  $('#form_about').submit();
}

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













