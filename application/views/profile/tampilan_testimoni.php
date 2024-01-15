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
        <h1 class="h3 mb-3 ml-5 text-gray-800">Testimoni</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12"> 
             <!-- Button trigger modal -->
             <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> Testimoni</button>
             <button id="export" name="export" class="btn btn-sm refresh btn-warning btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>
           </div>
         </div>
         <div class="card-body">
          <div class="table-responsive">

            <table  id="tabel_testimoni"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
              <thead>
                <tr class="bg-primary text-light text-center">
                  <th width="5%">No</th>
                  <th width="20%">Nama</th>
                  <th width="20%">Jabatan</th>
                  <th width="10%">Photo</th>
                  <th width="35%">Testimoni</th>
                  <th style="text-align: center;" width="10%" >Opsi</th>
                </tr>
              </thead>
              <tbody id="show_data">
              </tbody>
            </table>
          </div>
        </div>

        <!-- modal add -->


        <div class="modal fade" data-backdrop="static" id="modal_testimoni" tabindex="-1" role="dialog" aria-labelledby="modal_testimoniLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content" >
             <form id="form_testimoni" method="post" enctype="multipart/form-data" action="<?php echo base_url('profile/simpan_testimoni') ?>">
              <div class="modal-header bg-primary text-light"> 
                <h3 class="modal-title" id="label_header_testimoni"> <i class="fas fa-users mr-2"></i> TAMBAH DATA USER</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              </div>
              <div class="modal-body">
               <div class="row "> 
                <div class="col-md-12 mb-3"> 
                 <label style="color:#343a40;" for="testimoni_nama">Nama Lengkap</label>
                 <input type="hidden" name="testimoni_id" id="testimoni_id">
                 <input type="text" class="form-control" id="testimoni_nama"  name="testimoni_nama" required>
               </div>  
                <div class="col-md-12 mb-3"> 
                 <label style="color:#343a40;" for="testimoni_jabatan">Jabatan</label>
                 <input type="text" class="form-control" id="testimoni_jabatan"  name="testimoni_jabatan" required>
               </div>

               <div class="col-md-12 mb-3"> 
                 <label style="color:#343a40;" for="testimoni_jabatan">Testimoni</label>
                 <textarea type="text" class="form-control" id="testimoni_isi"  name="testimoni_isi" required rows="6"></textarea>
               </div>

               <div class="col-md-12 mb-3"> 

                <label class="imagecheck">Logo
                 <input type="hidden" name="lampiran_testimoni_lama" id="lampiran_testimoni_lama">
                 <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_testimoni" id="lampiran_testimoni" onchange="previewFile(this.id)">
                 <figure class="imagecheck-figure">
                  <img src="<?php echo base_url('assets/img/img03.jpg');?>"  class="imagecheck-image" id="preview_lampiran_testimoni">
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
  dataTable = $('#tabel_testimoni').DataTable( {
    paginationType:'full_numbers',
    processing: true,
    serverSide: true,
    searching: true,

    filter: false,
    autoWidth:false,
    aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: {
     url: '<?php echo base_url('profile/tabel_testimoni')?>',
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
  {'data':'testimoni_nama'},
  {'data':'testimoni_jabatan'},
  {'data':'testimoni_foto'},
  {'data':'testimoni_isi'},
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

  $('#show_data').on('click','.item_edit_testimoni',function(){
    let testimoni_id = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('profile/detail_testimoni')?>",
      dataType : "JSON",
      data : {'testimoni_id':testimoni_id},
      success: function(data){
        $('#modal_testimoni').modal('show');

        $('#form_testimoni').attr('action','<?php echo base_url('profile/ubah_testimoni') ?>');
        $('#btn_simpan').html('UBAH');

        $('#label_header_testimoni').html('<i class="fas fa-users mr-2"></i> UBAH TESTIMONI');
        $('#testimoni_id').val(testimoni_id);
        $('#testimoni_nama').val(data[0].testimoni_nama);
        $('#testimoni_jabatan').val(data[0].testimoni_jabatan);
        $('#testimoni_isi').val(data[0].testimoni_isi);
        $('#lampiran_testimoni_lama').val(data[0].testimoni_foto);
        if (data[0].testimoni_foto !='') {
          $('#preview_lampiran_testimoni').attr('src','<?php echo base_url() ?>'+data[0].testimoni_foto);
        }

      },

    });
    return false;
  });

  $('#show_data').on('click','.item_hapus_testimoni',function(){
    let testimoni_id = $(this).attr('data');
    $('#modal_hapus_testimoni').modal('show');
    $('#kode_hapus_testimoni').val(testimoni_id);

  });

  $('#btn_tambah').on('click',function(){
    $('#modal_testimoni').modal('show');
    $('#form_testimoni').attr('action','<?php echo base_url('profile/simpan_testimoni') ?>');
    $('#btn_simpan').html('SIMPAN');

    $('#form_testimoni').trigger("reset");
    $('#preview_lampiran_testimoni').attr('src','<?php echo base_url()?>assets/img/img03.jpg');
    $('#label_header_testimoni').html('<i class="fas fa-users mr-2"></i> TAMBAH TESTIMONI');
  });

  function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka != 8 && angka > 31 && (angka < 48 || angka > 57))
      return false;
    return true;
  }


  $('#btn_simpan').on('click',function(){

   if ($('#testimoni_nama').val()=='') {
    $('#testimoni_nama').focus();
    Swal.fire({
      title:'Error',
      text:'Silahkan Masukkan Nama Lengkap!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });
    return false;
  }

  if ($('#testimoni_jabatan').val()=='') {
    $('#testimoni_jabatan').focus();
    Swal.fire({
      title:'Error',
      text:'Silahkan Masukkan Jabatan!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });
    return false;
  }

   if ($('#testimoni_isi').val()=='') {
    $('#testimoni_isi').focus();
    Swal.fire({
      title:'Error',
      text:'Silahkan Masukkan Isi Testimoni!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });
    return false;
  }


  let link = $('#form_testimoni').attr('action');

  if (link.includes('simpan')!==false) {

   if ($('#lampiran_testimoni').val()=='') {
    $('#lampiran_testimoni').focus();
    Swal.fire({
      title:'Error',
      text:'Silahkan Upload Foto testimoni!',
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
$('#form_testimoni').submit();

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



<div class="modal fade" data-backdrop="static" id="modal_hapus_testimoni" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-light">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-trash mr-2"></i> Hapus testimoni</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal" method="post" action="<?php echo base_url('profile/hapus_testimoni') ?>">
      <div class="modal-body">

        <input type="hidden" name="kode_hapus_testimoni" id="kode_hapus_testimoni" value=""> 

        <div class="alert alert-danger"><p class="notif_aktivasi">Hapus Data testimoni..?</p></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Batal</button>
        <button class="btn_hapus btn btn-success btn-flat" type="submit" id="btn_hapus"><i class="fas fa-check mr-2"></i>YA</button>
      </div>


    </form>
  </div>
</div>
</div>









