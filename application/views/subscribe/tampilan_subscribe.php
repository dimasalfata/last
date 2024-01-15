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
        <h1 class="h3 mb-3 ml-5 text-gray-800">Email Subscribe</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12"> 

             <button id="export" name="export" class="btn btn-sm refresh btn-info btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>

           </div>
           
         </div>
         <div class="card-body">
          <div class="table-responsive">

            <table  id="tabel_subscribe"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
              <thead>
                <tr class="bg-primary text-light ">
                  <th class="text-center" width="1%">No</th>
                  <th >Tanggal</th>
                  <th >Email</th>
                  <th style="text-align: center;" width="10%">Opsi</th>
                </tr>
              </thead>
              <tbody id="show_data">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
</div>
</div>

<div class="modal fade" data-backdrop="static" id="ModalAktivasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-buildings mr-2"></i> Email Subscribe</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal">
      <div class="modal-body">

        <input type="hidden" name="kode_subscribe_aktivasi" id="kode_subscribe_aktivasi" value=""> 
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



  dataTable = $('#tabel_subscribe').DataTable( {
    paginationType:'full_numbers',
    processing: true,
    serverSide: true,
    searching: true,

    filter: false,
    autoWidth:false,
    aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: {
     url: '<?php echo base_url('subscribe/tabel_subscribe')?>',
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
  {'data':'tgl_subscribe'},
  {'data':'email_subscribe'},
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


  $('#btn_aktivasi').on('click',function(){
    var kode=$('#kode_subscribe_aktivasi').val();
    var isi=$('#isi_aktivasi').val();

    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('subscribe/aktivasi_subscribe')?>",
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

            text:'Email Subscribe Berhasil '+ pesan,
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

  $('#show_data').on('click','.item_aktivasi_subscribe',function(){
    if ($(this).html().includes('check')) {
      $('.notif_aktivasi').html('Aktifkan Subscribe... ?');
      $('#isi_aktivasi').val(1);

    }else{
      $('.notif_aktivasi').html('Nonaktifkan Subscribe... ?');
      $('#isi_aktivasi').val(0);
    }

    var kode= $(this).attr('data');
    $('#ModalAktivasi').modal('show');
    $('#kode_subscribe_aktivasi').val(kode);

    return false;
  });

  $('#show_data').on('click','.item_edit_subscribe',function(){
    let id_subscribe = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('subscribe/detail_subscribe')?>",
      dataType : "JSON",
      data : {'id_subscribe':id_subscribe},
      success: function(data){

        $('#modal_subscribe').modal('show');
        $('#form_subscribe').attr('action','<?php echo base_url('subscribe/ubah') ?>');
        $('#btn_simpan').html('UBAH');
        $('#label_header_subscribe').html('<i class="fas fa-building mr-2"></i> UBAH DATA subscribe');
        $('#id_subscribe').val(id_subscribe);
        $('#nama_subscribe').val(data[0].nama_subscribe);
        $('#telp_subscribe').val(data[0].telp_subscribe);

      },

    });

    return false;
  });

  $('#btn_tambah').on('click',function(){
    $('#modal_subscribe').modal('show');
    $('#form_subscribe').attr('action','<?php echo base_url('subscribe/simpan') ?>');
    $('#btn_simpan').html('SIMPAN');

    $('#form_subscribe').trigger("reset");
    $('#label_header_subscribe').html('<i class="fas fa-building mr-2"></i> TAMBAH DATA subscribe');
  });


  

  $('#btn_simpan').on('click',function(){

    let nama_subscribe = $('#nama_subscribe').val();
    if (nama_subscribe=="") {
      $('#nama_subscribe').focus();
      Swal.fire({
        title:'Nama subscribe Kosong',
        text:'Silahkan Masukkan Nama subscribe!',
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

    $('#form_subscribe').submit();
  });


</script>













