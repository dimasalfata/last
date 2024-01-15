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
        <h1 class="h3 mb-3 ml-5 text-gray-800">Informasi Produk</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12"> 

             <!-- Button trigger modal -->
             <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> Tambah Informasi Produk</button>
           </div>
           
         </div>
         <div class="card-body">
          <div class="table-responsive">

            <table  id="tabel_informasi"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
              <thead>
                <tr class="bg-primary text-light text-center">
                  <th width="5%">No</th>
                  <th width="20%">Nama Produk</th>
                  <th width="30%">Informasi</th>
                  <th width="10%">Foto</th>
                  <th style="text-align: center;" width="10%" >Opsi</th>
                </tr>
              </thead>
              <tbody id="show_data">
              </tbody>



            </table>
          </div>
        </div>

        <!-- modal add -->


        <div class="modal fade" data-backdrop="static" id="modal_informasi" tabindex="-1" role="dialog" aria-labelledby="modal_informasiLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" >
              <div class="modal-header bg-primary text-light"> 
                <h3 class="modal-title" id="label_header_produk"> <i class="fas fa-database mr-2"></i> TAMBAH DATA Produk</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              </div>
              <div class="modal-body">
               <form id="form_informasi" method="post" enctype="multipart/form-data" action="<?php echo base_url('produk/simpan') ?>">
                 <div class="row "> 

                   <div class="col-md-12 mb-4 id_produk"> 
                    <label style="color:#343a40;vertical-align:middle;" for="kategori">Produk</label> 
                    <input type="hidden" name="id_informasi" id="id_informasi">
                    <select type="text" class="form-control" id="id_produk" name="id_produk" required>
                      <option value="0" selected="selected" disabled="disabled">Pilih Produk</option>
                      <?php foreach ($produk as $key): ?>
                        <option value="<?php echo $key->id_produk ?>"><?php echo $key->nama_produk; ?></option>
                      <?php endforeach ?>
                    </select>   
                  </div>
                  <div class="col-md-8 mb-4">  
                    <label style="color:#343a40;" for="informasi_produk">Informasi</label> 
                    <textarea type="text" class="form-control" id="informasi_produk"  name="informasi_produk" rows="8"></textarea>
                  </div>

                  <div class="col-md-4 mb-4"> 
                    <label class="imagecheck">Foto Produk
                     <input type="hidden" name="lampiran_informasi_lama" id="lampiran_informasi_lama">
                     <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_informasi" id="lampiran_informasi" onchange="previewFile(this.id)">
                     <figure class="imagecheck-figure">
                      <img src="<?php echo base_url('assets/img/img03.jpg');?>"  class="imagecheck-image" id="preview_lampiran_informasi">
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

<div class="modal fade" data-backdrop="static" id="ModalHapusInformasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-light">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-trash mr-2"></i>Hapus Informasi</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal" method="post" action="<?php echo base_url('produk/hapus_informasi') ?>">
      <div class="modal-body">
        <input type="hidden" name="id_informasi_hapus" id="id_informasi_hapus" value=""> 
        <div class="alert alert-danger"><p>Hapus Informasi Produk...?</p></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Batal</button>
        <button type="submit" class="btn_hapus_informasi btn btn-success btn-flat" id="btn_hapus_informasi"><i class="fas fa-check mr-2"></i>YA</button>
      </div>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">



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


  $(document).ready(function(){

    $('#informasi_produk').summernote({
      placeholder: 'Masukkan Informasi Produk',
      tabsize: 2,
      height: 500,
      callbacks: {
        onImageUpload: function(image) {
          uploadImage('informasi_produk',image[0]);
        },
        onMediaDelete : function(target) {
          deleteImage(target[0].src);
        }
      }

    });


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



    dataTable = $('#tabel_informasi').DataTable( {
      paginationType:'full_numbers',
      processing: true,
      serverSide: true,
      searching: true,

      filter: false,
      autoWidth:false,
      aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
      ajax: {
       url: '<?php echo base_url('produk/tabel_informasi')?>',
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
    {'data':'nama_produk'},
    {'data':'informasi_produk'},
    {'data':'informasi_foto'},
    {'data':'opsi',orderable:false},

    ],   
    columnDefs: [
    {
      targets: [0,3,-1],
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

  function show_password(id)
  {
    if($('#'+id).attr('type')=="password")
    {
      $('#'+id).attr('type','text');
      $('.'+id).html('<i class="fa fa-eye-slash"></i>');
    }else{
      $('#'+id).attr('type','password');
      $('.'+id).html('<i class="fa fa-eye"></i>');

    }
  }

  $('#show_data').on('click','.item_hapus_informasi',function(){
    var kode= $(this).attr('data');
    $('#ModalHapusInformasi').modal('show');
    $('#id_informasi_hapus').val(kode);

    return false;
  });

  $('#show_data').on('click','.item_edit_informasi',function(){
    let id_informasi = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('produk/detail_informasi')?>",
      dataType : "JSON",
      data : {'id_informasi':id_informasi},
      success: function(data){

        $('#modal_informasi').modal('show');
        $('#form_informasi').attr('action','<?php echo base_url('produk/ubah_informasi') ?>');
        $('#btn_simpan').html('UBAH');
        $('#label_header_produk').html('<i class="fas fa-database mr-2"></i> UBAH INFORMASI PRODUK');
        $('#id_informasi').val(id_informasi);

        $('#id_produk').val(data[0].id_produk).trigger('change');
        // $('#informasi_produk').val(data[0].informasi_produk);
        $('#informasi_produk').summernote('code',data[0].informasi_produk);
        $('#lampiran_informasi_lama').val(data[0].informasi_foto);
        $('.id_produk').addClass('d-none');
        if(data[0].informasi_foto!='')
        {
          $('#preview_lampiran_informasi').attr('src','<?php echo base_url()?>'+data[0].informasi_foto);
          
        }
      },

    });

    return false;
  });

  $('#btn_tambah').on('click',function(){
    $('#modal_informasi').modal('show');
    $('#form_informasi').attr('action','<?php echo base_url('produk/simpan_informasi') ?>');

    $('#btn_simpan').html('SIMPAN');
    $('#form_informasi').trigger("reset");
    $('#informasi_produk').summernote('code','');

    $('#preview_lampiran_informasi').attr('src','<?php echo base_url()?>assets/img/img03.jpg');
    $('#label_header_produk').html('<i class="fas fa-database mr-2"></i> TAMBAH INFORMASI PRODUK');
    $('.id_produk').removeClass('d-none');
  });

  $('#btn_simpan').on('click',function(){
    let link = $('#form_informasi').attr('action');
    if (link.includes('simpan')!=false) {
      let id_produk = $('#id_produk').val();
      if (id_produk==null) {
       $('#id_produk').focus();
       Swal.fire({
        title:'Produk Kosong',
        text:'Silahkan Pilih Produk!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

  }

  if ($('#informasi_produk').summernote('isEmpty')) {
    Swal.fire({
      title:'Error',
      text:'Silahkan Masukkan Informasi Produk!',
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

  $('#form_informasi').submit();

});


</script>













