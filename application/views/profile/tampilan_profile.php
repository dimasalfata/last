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
        <h1 class="h3 mb-3 ml-5 text-gray-800">Profil BPR BKK Karangmalang</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12"> 

             <!-- Button trigger modal -->
             <?php if ($profil < 1) { ?>

               <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> Profil Perusahaan</button>
             <?php } ?>
             <button id="export" name="export" class="btn btn-sm refresh btn-warning btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>

           </div>
           
         </div>
         <div class="card-body">
          <div class="table-responsive">

            <table  id="tabel_profile"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
              <thead>
                <tr class="bg-primary text-light text-center">
                  <th>No</th>
                  <th >Nama Website</th>
                  <th >Pemilik</th>
                  <th >Email</th>
                  <th >Telepon</th>
                  <th >Logo</th>
                  <th style="text-align: center;" width="10%" >Opsi</th>
                </tr>
              </thead>
              <tbody id="show_data">
              </tbody>
            </table>
          </div>
        </div>

        <!-- modal add -->


        <div class="modal fade" data-backdrop="static" id="modal_profile" tabindex="-1" role="dialog" aria-labelledby="modal_profileLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content" >
             <form id="form_profile" method="post" enctype="multipart/form-data" action="<?php echo base_url('profile/simpan') ?>">
              <div class="modal-header bg-primary text-light"> 
                <h3 class="modal-title" id="label_header_profile"> <i class="fas fa-building mr-2"></i> TAMBAH DATA USER</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              </div>
              <div class="modal-body">

               <div class="row "> 
                <div class="col-md-6 mb-3"> 
                 <label style="color:#343a40;" for="nama_website">Nama Website</label>
                 <input type="hidden" name="id_profile" id="id_profile">
                 <input type="text" class="form-control" id="nama_website"  name="nama_website" required>
               </div>  
               <div class="col-md-6 mb-3"> 
                 <label style="color:#343a40;" for="pemilik">Pemilik</label>
                 <input type="text" class="form-control" id="pemilik"  name="pemilik">
               </div>   

               <div class="col-md-6 mb-3"> 
                 <label style="color:#343a40;" for="telp_profile">Telepon</label>
                 <input type="text" class="form-control" id="telp_profile"  name="telp_profile" onkeypress="return hanyaAngka(event)">
               </div>

               <div class="col-md-6 mb-3"> 
                 <label style="color:#343a40;" for="email_profile">Email</label>
                 <input type="text" class="form-control" id="email_profile"  name="email_profile">
               </div>   
               <div class="col-md-6 mb-3"> 
                 <label style="color:#343a40;" for="website_profile">Website</label>
                 <input type="text" class="form-control" id="website_profile"  name="website_profile">
               </div>   


               <div class="col-md-6 mb-3"> 
                 <label style="color:#343a40;" for="facebook_profile">Facebook</label>
                 <input type="text" class="form-control" id="facebook_profile"  name="facebook_profile">
               </div>   

               <div class="col-md-6 mb-3"> 
                 <label style="color:#343a40;" for="instagram_profile">Instagram</label>
                 <input type="text" class="form-control" id="instagram_profile"  name="instagram_profile">
               </div>   
               <div class="col-md-6 mb-3"> 
                 <label style="color:#343a40;" for="twitter_profile">Twitter</label>
                 <input type="text" class="form-control" id="twitter_profile"  name="twitter_profile">
               </div> 
               <div class="col-md-6 mb-3"> 
                 <label style="color:#343a40;" for="youtube_profile">Youtube</label>
                 <input type="text" class="form-control" id="youtube_profile"  name="youtube_profile">
               </div> 

               <div class="col-md-6 mb-3"> 
                 <label style="color:#343a40;" for="skype_profile">Skype</label>
                 <input type="text" class="form-control" id="skype_profile"  name="skype_profile">
               </div> 

               <div class="col-md-6 mb-3"> 
                 <label style="color:#343a40;" for="latitude_profile">Latitude</label>
                 <input type="text" class="form-control" id="latitude_profile"  name="latitude_profile">
               </div>

               <div class="col-md-6 mb-3"> 
                 <label style="color:#343a40;" for="longitude_profile">Longitude</label>
                 <input type="text" class="form-control" id="longitude_profile"  name="longitude_profile">
               </div>

               <div class="col-md-12 mb-3"> 
                 <label style="color:#343a40;" for="map_profile">Embed Map</label>
                 <input type="text" class="form-control" id="map_profile"  name="map_profile">
               </div> 

               <div class="col-md-12 mb-3"> 
                 <label style="color:#343a40;" for="sambutan">Kata Sambutan</label>
                 <input type="text" class="form-control" id="sambutan"  name="sambutan">
               </div> 



               <div class="col-md-6 mb-3"> 
                 <label style="color:#343a40;" for="alamat_profile">Alamat</label>
                 <textarea class="form-control" id="alamat_profile"  name="alamat_profile" rows="6"></textarea> 
               </div>  

               <div class="col-md-3 mb-3"> 
                <label class="imagecheck">Logo Perusahaan
                  <input type="hidden" name="lampiran_logo_lama" id="lampiran_logo_lama">
                  <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_logo" id="lampiran_logo" onchange="previewFile(this.id)">
                 <figure class="imagecheck-figure">
                  <img src="<?php echo base_url('assets/img/img03.jpg');?>"  class="imagecheck-image" id="preview_lampiran_logo">
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



  dataTable = $('#tabel_profile').DataTable( {
    paginationType:'full_numbers',
    processing: true,
    serverSide: true,
    searching: true,

    filter: false,
    autoWidth:false,
    aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: {
     url: '<?php echo base_url('profile/tabel_profile')?>',
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
  {'data':'nama_website'},
  {'data':'pemilik'},
  {'data':'email_profile'},
  {'data':'telp_profile'},
  {'data':'logo_profile'},
  {'data':'opsi',orderable:false},

  ],   
  columnDefs: [
  {
    targets: [0,4,5,-1],
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



  $('#show_data').on('click','.item_edit_profile',function(){
    let id_profile = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('profile/detail_profile')?>",
      dataType : "JSON",
      data : {'id_profile':id_profile},
      success: function(data){
        $('#modal_profile').modal('show');
        $('#form_profile').attr('action','<?php echo base_url('profile/ubah') ?>');
        $('#btn_simpan').html('UBAH');
        $('#label_header_profile').html('<i class="fas fa-building mr-2"></i> UBAH DATA PROFIL');
        $('#id_profile').val(id_profile);
        $('#nama_website').val(data[0].nama_website);
        $('#pemilik').val(data[0].pemilik);
        $('#telp_profile').val(data[0].telp_profile);
        $('#email_profile').val(data[0].email_profile);
        $('#website_profile').val(data[0].website);
        $('#facebook_profile').val(data[0].facebook);
        $('#instagram_profile').val(data[0].instagram);
        $('#twitter_profile').val(data[0].twitter);
        $('#youtube_profile').val(data[0].youtube);
        $('#skype_profile').val(data[0].skype);
        $('#latitude_profile').val(data[0].lat);
        $('#longitude_profile').val(data[0].long);
        $('#map_profile').val(data[0].map_profile);
        $('#sambutan').val(data[0].sambutan);

        $('#alamat_profile').val(data[0].alamat_profile);
        $('#lampiran_logo_lama').val(data[0].logo_profile);

        if(data[0].logo_profile!='')
        {
          $('#preview_lampiran_logo').attr('src','<?php echo base_url()?>'+data[0].logo_profile);
        }

      },

    });

    return false;
  });
  
  $('#btn_tambah').on('click',function(){
    $('#modal_profile').modal('show');
    $('#form_profile').attr('action','<?php echo base_url('profile/simpan') ?>');
    $('#btn_simpan').html('SIMPAN');

    $('#form_profile').trigger("reset");
    $('#preview_lampiran_profile').attr('src','<?php echo base_url()?>assets/img/img03.jpg');

    $('#label_header_profile').html('<i class="fas fa-building mr-2"></i> TAMBAH DATA PROFIL');
  });

  function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka != 8 && angka > 31 && (angka < 48 || angka > 57))
      return false;
    return true;
  }


  $('#btn_simpan').on('click',function(){

    let nama_website = $('#nama_website').val();
    if (nama_website=="") {
      $('#nama_website').focus();
      Swal.fire({
        title:'Nama Website Kosong',
        text:'Silahkan Masukkan Nama Website!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

    let email_profile = $('#email_profile').val();
    if (email_profile!="") {

      let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
      if (!testEmail.test(email_profile))
      {
       $('#email_profile').focus();
       Swal.fire({
        title:'Format Email Salah',
        text:'Silahkan Masukkan Email yang Valid!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }
  }

  let link = $('#form_profile').attr('action');

  if (link.includes('simpan')) {

    let lampiran_logo = $('#lampiran_logo').val();
    if (lampiran_logo=="") {
      $('#lampiran_logo').focus();
      Swal.fire({
        title:'Logo Kosong',
        text:'Silahkan Upload Logo!',
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
  $('#form_profile').submit();

});


</script>













