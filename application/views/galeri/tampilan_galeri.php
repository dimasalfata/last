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
        <h1 class="h3 mb-3 ml-5 text-gray-800">Galeri</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12"> 

             <!-- Button trigger modal -->
             <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> Tambah Data Galeri</button>
             <button id="export" name="export" class="btn btn-sm refresh btn-info btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>

           </div>
           
         </div>
         <div class="card-body">
          <div class="table-responsive">

            <table  id="tabel_galeri"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
              <thead>
                <tr class="bg-primary text-light ">
                  <th class="text-center" width="1%">No</th>
                  <th >Kategori</th>
                  <th >Judul</th>
                  <th >Deskripsi</th>
                  <th >Gambar</th>
                  <th style="text-align: center;" width="10%" >Opsi</th>
                </tr>

              </thead>
              <tbody id="show_data">
              </tbody>



            </table>
          </div>
        </div>

        <!-- modal add -->


        <div class="modal fade" data-backdrop="static" id="modal_galeri" tabindex="-1" role="dialog" aria-labelledby="modal_galeriLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" >
              <div class="modal-header bg-primary text-light"> 
                <h3 class="modal-title" id="label_header_galeri"> <i class="fas fa-camera mr-2"></i> TAMBAH DATA GALERI</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              </div>
              <div class="modal-body">
               <form id="form_galeri" method="post" enctype="multipart/form-data" action="<?php echo base_url('galeri/simpan') ?>">
                 <div class="row "> 
                  <div class="col-md-9 mb-3"> 
                   <label style="color:#343a40;" for="judul_foto">Judul</label>
                   <input type="hidden" name="id_galeri" id="id_galeri">
                   <input type="text" class="form-control" id="judul_foto"  name="judul_foto" required>
                 </div>

                 <div class="col-md-3 mb-3"> 
                   <label style="color:#343a40;" for="kategori_foto">Kategori</label>
                   <select class="form-control" id="kategori_foto"  name="kategori_foto" required>
                    <option value="0" selected disabled>Pilih Kategori</option>
                    <?php foreach ($kategori as $key): ?>
                      <option value="<?php echo $key->id_kategori ?>"><?php echo $key->nama_kategori ?></option>
                    <?php endforeach ?>
                  </select>
                </div>     
                <div class="col-md-12 mb-3"> 
                 <label style="color:#343a40;" for="deskripsi_foto">Deskripsi</label>
                 <textarea type="text" class="form-control summernote" id="deskripsi_foto"  name="deskripsi_foto" required rows="5"></textarea>
               </div>  

               <div class="col-md-3 mb-3"> 

                <label class="imagecheck">Gambar
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
<div class="modal fade" data-backdrop="static" id="ModalHapusGaleri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-trash mr-2"></i> Hapus</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal" method="post" action="<?php echo base_url('galeri/hapus') ?>">
      <div class="modal-body">
        <input type="hidden" name="kode_galeri_hapus" id="kode_galeri_hapus" value=""> 
        <div class="alert alert-danger"><p class="notif_aktivasi"></p></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Batal</button>
        <button class="btn_hapus_galeri btn btn-success btn-flat" id="btn_hapus_galeri" type="submit"><i class="fas fa-check mr-2"></i>YA</button>
      </div>


    </form>
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



  dataTable = $('#tabel_galeri').DataTable( {
    paginationType:'full_numbers',
    processing: true,
    serverSide: true,
    searching: true,

    filter: false,
    autoWidth:false,
    aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: {
     url: '<?php echo base_url('galeri/tabel_galeri')?>',
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
  {'data':'nama_kategori'},
  {'data':'judul_foto'},
  {'data':'deskripsi_foto'},
  {'data':'gambar_foto'},
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



  $('#show_data').on('click','.item_hapus_galeri',function(){
    $('.notif_aktivasi').html('Hapus Galeri... ?');
    var kode= $(this).attr('data');
    $('#ModalHapusGaleri').modal('show');
    $('#kode_galeri_hapus').val(kode);

    return false;
  });

  $('#show_data').on('click','.item_edit_galeri',function(){
    let id_galeri = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('galeri/detail_galeri')?>",
      dataType : "JSON",
      data : {'id_galeri':id_galeri},
      success: function(data){
        $('#modal_galeri').modal('show');
        $('#form_galeri').attr('action','<?php echo base_url('galeri/ubah') ?>');
        $('#btn_simpan').html('UBAH');
        $('#label_header_galeri').html('<i class="fas fa-camera mr-2"></i> UBAH DATA GALERI');
        $('#id_galeri').val(id_galeri);
        $('#judul_foto').val(data[0].judul_foto);
        $('#deskripsi_foto').val(data[0].deskripsi_foto);
        $('#lampiran_foto_lama').val(data[0].gambar_foto);
        $('#kategori_foto').val(data[0].id_kategori).trigger('change');
        if (data[0].gambar_foto!='') {
          $('#preview_lampiran_foto').attr('src','<?php echo base_url() ?>'+data[0].gambar_foto);
        }

        $('.summernote').summernote({
          placeholder: 'Deskripsi',
          tabsize: 2,
          height: 150,
          callbacks: {
            onImageUpload: function(image) {
              uploadImage('deskripsi_foto',image[0]);
            },
            onMediaDelete : function(target) {
              deleteImage(target[0].src);
            }
          }
        });

        $('#deskripsi_foto').summernote('code',data[0].deskripsi_foto);
      },

    });

    return false;
  });

  $('#btn_tambah').on('click',function(){
    $('#modal_galeri').modal('show');
    $('#form_galeri').attr('action','<?php echo base_url('galeri/simpan') ?>');
    $('#btn_simpan').html('SIMPAN');

    $('#form_galeri').trigger("reset");
    $('#label_header_galeri').html('<i class="fas fa-camera mr-2"></i> TAMBAH DATA GALERI');
    $('.summernote').summernote({
      placeholder: 'Deskripsi',
      tabsize: 2,
      height: 150,
      callbacks: {
        onImageUpload: function(image) {
          uploadImage('misi',image[0]);
        },
        onMediaDelete : function(target) {
          deleteImage(target[0].src);
        }
      }
    });
  });




  $('#btn_simpan').on('click',function(){

    let judul_foto = $('#judul_foto').val();
    if (judul_foto=="") {
      $('#judul_foto').focus();
      Swal.fire({
        title:'Judul Kosong',
        text:'Silahkan Masukkan Judul!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

    let kategori_foto = $('#kategori_foto').val();
    if (kategori_foto==null) {
      $('#kategori_foto').focus();
      Swal.fire({
        title:'Kategori Kosong',
        text:'Silahkan Pilih Kategori!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

    let link = $('#form_galeri').attr('action');
    if (link.includes('simpan')!==false) {
    let lampiran_foto = $('#lampiran_foto').val();
    if (lampiran_foto=="") {
      $('#lampiran_foto').focus();
      Swal.fire({
        title:'Gambar Kosong',
        text:'Silahkan Masukkan Gambar!',
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
    $('#form_galeri').submit();
  });

  function uploadImage(id,image) {
    var data = new FormData();
    data.append("image", image);
    $.ajax({
      url: "<?php echo site_url('galeri/upload_image')?>",
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
      url: "<?php echo site_url('galeri/delete_image')?>",
      cache: false,
      success: function(response) {
      }
    });
  }

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


</script>













