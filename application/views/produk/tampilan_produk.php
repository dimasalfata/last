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
        <h1 class="h3 mb-3 ml-5 text-gray-800">Produk</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12"> 

             <!-- Button trigger modal -->
             <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> Tambah Data Produk</button>
             <button id="export" name="export" class="btn btn-sm refresh btn-info btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>

           </div>
           
         </div>
         <div class="card-body">
          <div class="table-responsive">

            <table  id="tabel_produk"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
              <thead>
                <tr class="bg-primary text-light text-center">
                  <th width="5%">No</th>
                  <th width="15%">Kategori</th>
                  <th width="20%">Nama Produk</th>
                  <th width="10%">Foto</th>
                  <th width="30%">Keterangan</th>
                  <th style="text-align: center;" width="10%" >Opsi</th>
                </tr>

              </thead>
              <tbody id="show_data">
              </tbody>



            </table>
          </div>
        </div>

        <!-- modal add -->


        <div class="modal fade" data-backdrop="static" id="modal_produk" tabindex="-1" role="dialog" aria-labelledby="modal_produkLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" >
              <div class="modal-header bg-primary text-light"> 
                <h3 class="modal-title" id="label_header_produk"> <i class="fas fa-database mr-2"></i> TAMBAH DATA Produk</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              </div>
              <div class="modal-body">
               <form id="form_produk" method="post" enctype="multipart/form-data" action="<?php echo base_url('produk/simpan') ?>">
                 <div class="row "> 

                  <div class="col-md-8 mb-3"> 
                   <label style="color:#343a40;" for="nama_produk">Nama Produk</label>
                   <input type="hidden" name="id_produk" id="id_produk">
                   <input type="text" class="form-control" id="nama_produk"  name="nama_produk" required>
                 </div>   

                 <div class="col-md-4 mb-3"> 
                  <label style="color:#343a40;vertical-align:middle;" for="kategori">Kategori Produk</label> 
                  <select type="text" class="form-control" id="kategori" name="kategori" required>
                    <option value="0" selected="selected" disabled="disabled">Pilih Kategori</option>
                    <?php foreach ($kategori as $key): ?>
                      <option value="<?php echo $key->id_kategori ?>"><?php echo $key->nama_kategori; ?></option>
                    <?php endforeach ?>
                  </select>   
                </div>
                <div class="col-md-8 mb-3">  
                  <label style="color:#343a40;" for="keterangan_produk">Keterangan</label> 
                  <textarea type="text" class="form-control" id="keterangan_produk"  name="keterangan_produk" rows="8"></textarea>
                </div>

                <div class="col-md-4 mb-3"> 
                  <label class="imagecheck">Foto Produk
                   <input type="hidden" name="lampiran_produk_lama" id="lampiran_produk_lama">
                   <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_produk" id="lampiran_produk" onchange="previewFile(this.id)">
                   <figure class="imagecheck-figure">
                    <img src="<?php echo base_url('assets/img/img03.jpg');?>"  class="imagecheck-image" id="preview_lampiran_produk">
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

<div class="modal fade" data-backdrop="static" id="ModalAktivasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-database mr-2"></i> Status Produk</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal">
      <div class="modal-body">

        <input type="hidden" name="kode_produk_aktivasi" id="kode_produk_aktivasi" value=""> 
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

    $('#keterangan_produk').summernote({
      placeholder: 'Keterangan',
      tabsize: 2,
      height: 500,
      callbacks: {
        onImageUpload: function(image) {
          uploadImage('keterangan_produk',image[0]);
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



    dataTable = $('#tabel_produk').DataTable( {
      paginationType:'full_numbers',
      processing: true,
      serverSide: true,
      searching: true,

      filter: false,
      autoWidth:false,
      aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
      ajax: {
       url: '<?php echo base_url('produk/tabel_produk')?>',
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
    order: [1, 'asc'],
    columns: [
    {'data':'no'},
    {'data':'nama_kategori'},
    {'data':'nama_produk'},
    {'data':'foto_produk'},
    {'data':'keterangan_produk'},
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


  $('#btn_aktivasi').on('click',function(){
    var kode=$('#kode_produk_aktivasi').val();
    var isi=$('#isi_aktivasi').val();

    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('produk/aktivasi_produk')?>",
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

            text:'Produk Berhasil Di '+ pesan,
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

  $('#show_data').on('click','.item_aktivasi_produk',function(){
    if ($(this).html().includes('check')) {
      $('.notif_aktivasi').html('Aktifkan Produk... ?');
      $('#isi_aktivasi').val(1);

    }else{
      $('.notif_aktivasi').html('Nonaktifkan Produk... ?');
      $('#isi_aktivasi').val(0);
    }

    var kode= $(this).attr('data');
    $('#ModalAktivasi').modal('show');
    $('#kode_produk_aktivasi').val(kode);

    return false;
  });

  $('#show_data').on('click','.item_edit_produk',function(){
    let id_produk = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('produk/detail_produk')?>",
      dataType : "JSON",
      data : {'id_produk':id_produk},
      success: function(data){

        $('#modal_produk').modal('show');
        $('#form_produk').attr('action','<?php echo base_url('produk/ubah') ?>');
        $('#btn_simpan').html('UBAH');
        $('#label_header_produk').html('<i class="fas fa-database mr-2"></i> UBAH DATA PRODUK');
        $('#id_produk').val(id_produk);
        $('#nama_produk').val(data[0].nama_produk);
        $('#kategori').val(data[0].id_kategori).trigger('change');
        // $('#keterangan_produk').val(data[0].keterangan_produk);
        $('#keterangan_produk').summernote('code',data[0].keterangan_produk);
        $('#lampiran_produk_lama').val(data[0].foto_produk);
        if(data[0].foto_produk!='')
        {
          $('#preview_lampiran_produk').attr('src','<?php echo base_url()?>'+data[0].foto_produk);
          
        }
      },

    });

    return false;
  });

  $('#btn_tambah').on('click',function(){
    $('#modal_produk').modal('show');
    $('#form_produk').attr('action','<?php echo base_url('produk/simpan') ?>');
    $('#btn_simpan').html('SIMPAN');
    $('#form_produk').trigger("reset");
    $('#preview_lampiran_produk').attr('src','<?php echo base_url()?>assets/img/img03.jpg');
    $('#label_header_produk').html('<i class="fas fa-database mr-2"></i> TAMBAH DATA PRODUK');
  });






  $('#btn_simpan').on('click',function(){

    let nama_produk = $('#nama_produk').val();
    if (nama_produk=="") {
      $('#nama_produk').focus();
      Swal.fire({
        title:'Nama Produk Kosong',
        text:'Silahkan Masukkan Nama Produk!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

    let kategori = $('#kategori').val();
    if (kategori==null) {
     $('#kategori').focus();
     Swal.fire({
      title:'Kategori Produk Kosong',
      text:'Silahkan Pilih Kategori Produk!',
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

  $('#form_produk').submit();

});


</script>













