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
        <h1 class="h3 mb-3 ml-5 text-gray-800">Potensi Wilayah</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12"> 
             <!-- Button trigger modal -->
             <?php if ($this->session->level=="Marketing" || $this->session->level=="Supervisor") { ?>
               <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> Potensi Wilayah</button>
             <?php  } ?>
             <button id="export" name="export" class="btn btn-sm refresh btn-info btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>
           </div>
           
         </div>
          <div class="card-header">
            <ul class="nav nav-tabs" id="potensi-wilayah-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="default-tab" data-toggle="tab" data-target="#default" type="button" role="tab" aria-controls="default" aria-selected="true">Default</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="realisasi-tab" data-toggle="tab" data-target="#realisasi" type="button" role="tab" aria-controls="realisasi" aria-selected="false">Realisasi</button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="default" role="tabpanel" aria-labelledby="default-tab">
                    <div class="table-responsive">
                        <table id="tabel_potensi_wilayah" class="table table-striped table-bordered" style="width: 100%; font-size: 13px; text-align: left;">
                            <thead>
                                <tr class="bg-primary text-light ">
                                    <th class="text-center" width="1%">No</th>
                                    <th >Tanggal</th>
                                    <th >Marketing</th>
                                    <th >Cabang</th>
                                    <th >Nama Nasabah</th>
                                    <th >Telepon</th>
                                    <th >Alamat</th>
                                    <th >Status</th>

                                    <th style="text-align: center;" width="10%" >Opsi</th>
                                </tr>
                            </thead>
                            <tbody id="show_data"></tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="realisasi" role="tabpanel" aria-labelledby="realisasi-tab">
                    <div class="table-responsive">
                        <table id="tabel_potensi_wilayah_realisasi" class="table table-striped table-bordered" style="width: 100%; font-size: 13px; text-align: left;">
                            <thead>
                                <tr class="bg-primary text-light ">
                                    <th class="text-center" width="1%">No</th>
                                    <th >Tanggal</th>
                                    <th >Marketing</th>
                                    <th >Cabang</th>
                                    <th >Nama Nasabah</th>
                                    <th >Telepon</th>
                                    <th >Alamat</th>
                                    <th >Status</th>

                                    <th style="text-align: center;" width="10%" >Opsi</th>
                                </tr>
                            </thead>
                            <tbody id="show_data_realisasi"></tbody>
                        </table>
                    </div>
                </div>
            </div>     

        </div>
        <!-- modal add -->
        <div class="modal fade" data-backdrop="static" id="modal_potensi" tabindex="-1" role="dialog" aria-labelledby="modal_potensiLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content" >
              <div class="modal-header bg-primary text-light"> 
                <h3 class="modal-title" id="label_header_produk"> <i class="fas fa-building mr-2"></i> TAMBAH DATA USER</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              </div>
              <div class="modal-body">
               <form id="form_potensi" method="post" enctype="multipart/form-data" action="<?php echo base_url('potensi_wilayah/simpan') ?>">
                 <div class="row "> 
                  <div class="col-md-8 mb-3"> 
                   <label style="color:#343a40;" for="nama_nasabah">Nama Nasabah</label>
                   <input type="hidden" name="id_nasabah" id="id_nasabah">
                   <input type="hidden" name="latitude_gps" id="latitude_gps">
                   <input type="hidden" name="longitude_gps" id="longitude_gps">
                   <input type="text" class="form-control" id="nama_nasabah"  name="nama_nasabah" required>
                 </div> 
                 <div class="col-md-4 mb-3"> 
                   <label style="color:#343a40;" for="telp_nasabah">Telepon</label>
                   <input type="text" class="form-control" id="telp_nasabah"  name="telp_nasabah" required onkeypress="return hanyaAngka(event)" maxlength="13" minlength="10">
                   <input type="hidden" class="form-control" id="telp_nasabah_lama"  name="telp_nasabah_lama" required onkeypress="return hanyaAngka(event)" maxlength="13" minlength="10">

                 </div> 
                 <div class="col-md-6 mb-3"> 
                   <label style="color:#343a40;" for="prov_nasabah">Provinsi</label>
                   <select class="form-control" id="prov_nasabah"  name="prov_nasabah" required style="width: 100%" onchange="get_kab(this.value)">
                     <option value="0" selected disabled>Pilih Provinsi</option>
                     <?php foreach ($provinsi as $key): ?>
                       <option value="<?php echo $key->kode_wilayah ?>"><?php echo $key->nama_wilayah; ?></option>
                     <?php endforeach ?>
                   </select>
                 </div> 
                 <div class="col-md-6 mb-3"> 
                   <label style="color:#343a40;" for="kab_nasabah">Kab/kota</label>
                   <select class="form-control" id="kab_nasabah"  name="kab_nasabah" required style="width: 100%" onchange="get_kec(this.value)">
                     <option value="0" selected disabled>Pilih Kab/Kota</option>

                   </select>
                 </div> 

                 <div class="col-md-6 mb-3"> 
                   <label style="color:#343a40;" for="kec_nasabah">Kecamatan</label>
                   <select class="form-control" id="kec_nasabah"  name="kec_nasabah" required style="width: 100%" onchange="get_kel(this.value)">
                     <option value="0" selected disabled>Pilih Kecamatan</option>

                   </select>
                 </div> 

                 <div class="col-md-6 mb-3"> 
                   <label style="color:#343a40;" for="kel_nasabah">Kelurahan</label>
                   <select class="form-control" id="kel_nasabah"  name="kel_nasabah" required style="width: 100%" >
                     <option value="0" selected disabled>Pilih Kelurahan</option>

                   </select>
                 </div>

                 <div class=" col-md-8 mb-3">
                   <label style="color:#343a40;" for="usaha_nasabah">Usaha</label>
                   <input type="text" class="form-control" name="usaha_nasabah" id="usaha_nasabah"  required>
                 </div>
                 <div class="col-md-4 mb-3"> 
                   <label style="color:#343a40;" for="omset_nasabah">Omset</label>
                   <input type="text" class="form-control rupiah" id="omset_nasabah"  class="rupiah" name="omset_nasabah" required>
                   <small class="error-omset_nasabah text-danger"></small>
                  </div>

                 <div class="col-md-8 mb-3"> 
                   <label style="color:#343a40;" for="alamat_nasabah">Alamat Lengkap</label>
                   <textarea class="form-control" id="alamat_nasabah"  name="alamat_nasabah" rows="8"></textarea>
                 </div> 
                 <div class="col-md-3 mb-3"> 
                  <label class="imagecheck">Foto Usaha
                   <input type="hidden" name="lampiran_usaha_lama" id="lampiran_usaha_lama">
                   <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_usaha" id="lampiran_usaha" onchange="previewFile(this.id)" capture="camera">
                   <small class="error-lampiran_usaha text-danger"></small>
                   <figure class="imagecheck-figure">
                    <img src="<?php echo base_url('assets/img/img03.jpg');?>"  class="imagecheck-image" id="preview_lampiran_usaha" >
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

<div class="modal fade" data-backdrop="static" id="modalrealisasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-buildings mr-2"></i> Realisasi Nasabah</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
     </div>
     <form class="form-horizontal" method="post" id="form_realisasi" action="<?php echo base_url('potensi_wilayah/realisasi') ?>" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
           <label style="color:#343a40;" for="hasil_follow_up">Nomor Referensi</label>
           <input type="hidden" name="id_nasabah_realisasi" id="id_nasabah_realisasi" value=""> 
           <input type="text" class="form-control" name="no_ref" id="no_ref">
         </div>
       </div>
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Batal</button>
      <button class="btn_realisasi btn btn-success btn-flat" id="btn_realisasi" type="button"><i class="fas fa-check mr-2"></i>Simpan</button>
    </div>


  </form>
</div>
</div>
</div>


<div class="modal fade" data-backdrop="static" id="modalfollowup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-buildings mr-2"></i> Follow UP Nasabah</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal" method="post" id="form_followup" action="<?php echo base_url('potensi_wilayah/simpan_fu') ?>" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-9">
           <label style="color:#343a40;" for="hasil_follow_up">Hasil Follow UP</label>

           <input type="hidden" name="id_nasabah_follow_up" id="id_nasabah_follow_up" value=""> 
           <textarea class="form-control" name="hasil_follow_up" id="hasil_follow_up" rows="5"></textarea>
         </div>
         <div class="col-md-3 mb-3"> 
          <label class="imagecheck">Foto
           <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_follow_up" id="lampiran_follow_up" onchange="previewFile(this.id)" capture="camera">
           <small class="error-lampiran_follow_up text-danger"></small>
           <figure class="imagecheck-figure">
            <img src="<?php echo base_url('assets/img/img03.jpg');?>"  class="imagecheck-image" id="preview_lampiran_follow_up" >
          </figure>
        </label>
      </div>

    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Batal</button>
    <button class="btn_simpan_followup btn btn-success btn-flat" id="btn_simpan_followup" type="button"><i class="fas fa-check mr-2"></i>Simpan</button>
  </div>


</form>
</div>
</div>
</div>


<div class="modal fade" data-backdrop="static" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-buildings mr-2"></i>Detail Potensi Wilayah</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal">
      <div class="modal-body detail_potensi_wilayah">
        <div class="row p-3">
          <div class="col-md-6 mb-3">
            <span style="width: 150px;font-weight: bold;display: inline-block;">Nama Nasabah</span><span class=" nama_nasabah"></span>
          </div>
          <div class="col-md-6 mb-3">
            <span style="width: 150px;font-weight: bold;display: inline-block;">Provinsi</span><span class=" provinsi_nasabah"></span>
          </div>
          <div class="col-md-6 mb-3">
            <span style="width: 150px;font-weight: bold;display: inline-block;">Telepon</span><span class=" telp_nasabah"></span>
          </div>


          <div class="col-md-6 mb-3">
            <span style="width: 150px;font-weight: bold;display: inline-block;">Kabupaten</span><span class=" kabupaten_nasabah"></span>
          </div>
          <div class="col-md-6 mb-3">
            <span style="width: 150px;font-weight: bold;display: inline-block;">Usaha</span><span class=" usaha_nasabah"></span>
          </div>
          <div class="col-md-6 mb-3">
            <span style="width: 150px;font-weight: bold;display: inline-block;">Kecamatan</span><span class=" kecamatan_nasabah"></span>
          </div>
          <div class="col-md-6 mb-3">
            <span style="width: 150px;font-weight: bold;display: inline-block;">Omset</span><span class=" omset_nasabah"></span>
          </div>
          <div class="col-md-6 mb-3">
            <span style="width: 150px;font-weight: bold;display: inline-block;">Kelurahan</span><span class=" kelurahan_nasabah"></span>
          </div>
          
          <div class="col-md-12 mb-3">
            <span style="width: 150px;font-weight: bold;display: inline-block;">Alamat</span><span class=" alamat_nasabah"></span>
          </div>




          <div class="col-md-6 mb-3 mt-3">
            <div class="row">
              <div class="col-md-12"  id="mapid" style="height:300px;">

              </div>
              <div class="col-md-12 mt-3 btn-group align-items-center">
                <a href="javascript:;" target="_blank" id="foto_usaha" class="btn btn-success w-50 mr-3">Lihat Foto Usaha</a>
                <a href="" id="lihat_map" class="btn btn-primary w-50" target="_blank">Lihat Map</a>
              </div>
            </div>

          </div>
          <div class="col-md-6 mb-3 mt-3">
          <div class="table-responsive">
            <table class="table table-bordered table-striped display table-sm">
              <thead>
                <tr>
                <th class="bg-primary text-light text-center" colspan="7">History Follow UP</th>
                </tr>
                <tr class="bg-danger text-light ">
                  <th class="text-center">No</th>
                  <th class="text-center">Tanggal</th>
                  <th>Marketing</th>
                  <th>Hasil</th>
                  <th>Tipe</th>
                  <th>Approval</th>
                  <th class="text-center">#</th>
                </tr>
              </thead>
              <tbody id="list_fu">
              </tbody>
            </table>
            </div>
          </div>

        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Tutup</button>
      </div>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
  var mapid;

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


function getLocation() {

  if (navigator.geolocation) {
   navigator.geolocation.getCurrentPosition(showPosition,showError);
 } else {
  Swal.fire({
    title:'Error!',
    text:'Geolocation tidak didukung oleh browser ini!',
    icon:'error'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close();
    }
  });
  return false;
}
}
function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
    Swal.fire({
      title:'GPS Error!',
      text:'Silahkan Periksa GPS, atau Ganti Browser!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });

    return false;
    break;
    case error.POSITION_UNAVAILABLE:
    Swal.fire({
      title:'GPS Error!',
      text:'Lokasi Tidak Terdeteksi!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });
    return false;

    break;
    case error.TIMEOUT:

    Swal.fire({
      title:'Error!',
      text:'Akses GPS Melebihi Batas Waktu!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });
    return false;

    break;
    case error.UNKNOWN_ERROR:

    Swal.fire({
      title:'Aplikasi Error!',
      text:'Silahkan Hubungi Pengembang!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });
    return false;

    break;
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



$('#omset_nasabah').maskNumber({
  thousands:'.',
  integer:true,
});

$('#prov_nasabah').select2({
  placeholder :'Pilih Provinsi',
  allowClear :true,
  dropdownParent :$('#modal_potensi .modal-content'),
});



dataTable = $('#tabel_potensi_wilayah').DataTable( {
  paginationType:'full_numbers',
  processing: true,
  serverSide: true,
  searching: true,

  filter: false,
  autoWidth:false,
  aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
  ajax: {
   url: '<?php echo base_url('potensi_wilayah/tabel_potensi_wilayah')?>',
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
order: [0, 'desc'],
columns: [
{'data':'no'},
{'data':'tanggal', orderable: false},
{'data':'marketing', orderable: false},
{'data':'nama_cabang'},
{'data':'nama_nasabah'},
{'data':'telp_nasabah'},
{'data':'alamat_nasabah'},
{'data':'status_nasabah'},

{'data':'opsi',orderable:false},
],   
columnDefs: [
{
  targets: [0,-1],
  className: 'text-center'
},
{
  targets: [6],
  className: 'text-right'
},

],

});

dataTableRealisasi = $('#tabel_potensi_wilayah_realisasi').DataTable( {
  paginationType:'full_numbers',
  processing: true,
  serverSide: true,
  searching: true,

  filter: false,
  autoWidth:false,
  aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
  ajax: {
   url: '<?php echo base_url('potensi_wilayah/tabel_potensi_wilayah_realisasi')?>',
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
order: [0, 'desc'],
columns: [
{'data':'no'},
{'data':'tanggal', orderable: false},
{'data':'marketing', orderable: false},
{'data':'nama_cabang'},
{'data':'nama_nasabah'},
{'data':'telp_nasabah'},
{'data':'alamat_nasabah'},
{'data':'status_nasabah'},

{'data':'opsi',orderable:false},
],   
columnDefs: [
{
  targets: [0,-1],
  className: 'text-center'
},
{
  targets: [6],
  className: 'text-right'
},

],

});


function table_data(){
 dataTable.ajax.reload(null,true);
}


$(".refresh").click(function(){
 location.reload();
});

});



$('#show_data').on('click','.item_edit_potensi_wilayah',function(){
  let id_nasabah = $(this).attr('data');
  $.ajax({
    type : "GET",
    url  : "<?php echo base_url('potensi_wilayah/detail_potensi_wilayah')?>",
    dataType : "JSON",
    data : {'id_nasabah':id_nasabah},
    success: function(data){

      $('#modal_potensi').modal('show');
      $('#form_potensi').attr('action','<?php echo base_url('potensi_wilayah/ubah') ?>');
      $('#btn_simpan').html('UBAH');
      $('#label_header_produk').html('<i class="fas fa-id-card mr-2"></i> UBAH POTENSI WILAYAH');
      $('#id_nasabah').val(id_nasabah);
      $('#nama_nasabah').val(data[0].nama_nasabah);
      $('#telp_nasabah').val(data[0].telp_nasabah);
      $('#telp_nasabah_lama').val(data[0].telp_nasabah);
      $('#alamat_nasabah').val(data[0].alamat_nasabah);
      SeparatorRibuan(data[0].omset_nasabah.toString(),'omset_nasabah');
      $('#usaha_nasabah').val(data[0].usaha_nasabah);
      $('#prov_nasabah').val(data[0].provinsi_nasabah).trigger('change');
      get_kab_edit(data[0].provinsi_nasabah,data[0].kabupaten_nasabah);
      get_kec_edit(data[0].kabupaten_nasabah,data[0].kecamatan_nasabah);
      get_kel_edit(data[0].kecamatan_nasabah,data[0].kelurahan_nasabah);

      if (data[0].foto_usaha!='') {
        $('#preview_lampiran_usaha').attr('src','<?php echo base_url()?>'+data[0].foto_usaha);
      }
      $('#kab_nasabah').val(data[0].kabupaten_nasabah).trigger('change');

      $('#lampiran_usaha_lama').val(data[0].foto_usaha);

    },

  });

  return false;
});
$('#show_data').on('click','.item_follow_up',function(){
  let id_nasabah = $(this).attr('data');
  $('#modalfollowup').modal('show');
  $('#id_nasabah_follow_up').val(id_nasabah);
});

$('#show_data').on('click','.item_realisasi_nasabah',function(){
  let id_nasabah = $(this).attr('data');
  $('#modalrealisasi').modal('show');
  $('#id_nasabah_realisasi').val(id_nasabah);
});
$('#show_data').on('click','.item_detail_potensi_wilayah',function(){
  let id_nasabah = $(this).attr('data');
  $.ajax({
    type : "GET",
    url  : "<?php echo base_url('potensi_wilayah/detail_potensi_wilayah_full')?>",
    dataType : "JSON",
    data : {'id_nasabah':id_nasabah},
    success: function(data){
      $('#modal_detail').modal('show');
      $('.nama_nasabah').html(data.nasabah[0].nama_nasabah);
      $('.telp_nasabah').html(data.nasabah[0].telp_nasabah);
      $('.provinsi_nasabah').html(data.nasabah[0].prov);
      $('.kabupaten_nasabah').html(data.nasabah[0].kab);
      $('.kecamatan_nasabah').html(data.nasabah[0].kec);
      $('.kelurahan_nasabah').html(data.nasabah[0].kel);
      $('.alamat_nasabah').html(data.nasabah[0].alamat_nasabah);
      $('.usaha_nasabah').html(data.nasabah[0].usaha_nasabah);
      SeparatorRibuanClass(data.nasabah[0].omset_nasabah.toString(),'omset_nasabah');
      var options = {
        center: [data.nasabah[0].latitude, data.nasabah[0].longitude],
        zoom: 13,
        minZoom: 6
      }
      if(mapid!=undefined)
      {
        mapid.remove();
      }
      mapid = new L.map('mapid', options);
      var marker = L.marker([data.nasabah[0].latitude, data.nasabah[0].longitude]).addTo(mapid);
      L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmFiaWxjaGVuIiwiYSI6ImNrOWZzeXh5bzA1eTQzZGxpZTQ0cjIxZ2UifQ.1YMI-9pZhxALpQ_7x2MxHw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiYXRob3h6b2VtYW50YSIsImEiOiJjbDI3bW82cnMwMHhjM2JwMXl2ajByNDN3In0.Esx5r-0LHnwqqgiO8DOfYA'
      }).addTo(mapid);

      $('#lihat_map').attr('href','http://maps.google.com/maps?q='+data.nasabah[0].latitude+', '+data.nasabah[0].longitude);

      if (data.nasabah[0].foto_usaha!='') {
        $('#foto_usaha').attr('href','<?php echo  base_url(); ?>'+data.nasabah[0].foto_usaha);
      }
      let fu ='';
      $('#list_fu').html('');
      for (var i = 0; i < data.follow_up.length; i++) {
        let approval = data.follow_up[i].approval
          approval_user = ""
        if(data.follow_up[i].approval_by != null) {
          approval_user = `|| ${data.follow_up[i].approval_by}`
        }

        if(approval == "pending") {
          approval = `
            <p class="text-dark bg-warning">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
              </svg> ${approval}

            </p>
          `;
        } else if(approval == "disetujui") {
          approval = `
            <p class="text-white bg-primary">
              <i class="fa fa-check-square"></i>
              ACC ${approval_user}
            </p>
          `;
       
        }

        fu+=`<tr>
        <td>`+(i+1)+`</td>
        <td>`+data.follow_up[i].tanggal_fu+`</td>
        <td>`+data.follow_up[i].nama+`</td>
        <td>`+data.follow_up[i].hasil_fu+`</td>
        <td>`+data.follow_up[i].status+`</td>
        <td class='text-center text-uppercase'>
          ${approval}
        </td>

        <td>`;

        if (data.follow_up[i].lampiran_fu!='') {
          fu+=`<a href="<?php echo base_url() ?>`+data.follow_up[i].lampiran_fu+`" target="_blank" class="btn btn-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>`;
        }
        fu+=`</td></tr>`;
      }
      $('#list_fu').html(fu);

    },

  });

  return false;
});

$('#show_data_realisasi').on('click','.item_detail_potensi_wilayah',function(){
  let id_nasabah = $(this).attr('data');
  $.ajax({
    type : "GET",
    url  : "<?php echo base_url('potensi_wilayah/detail_potensi_wilayah_full')?>",
    dataType : "JSON",
    data : {'id_nasabah':id_nasabah},
    success: function(data){
      $('#modal_detail').modal('show');
      $('.nama_nasabah').html(data.nasabah[0].nama_nasabah);
      $('.telp_nasabah').html(data.nasabah[0].telp_nasabah);
      $('.provinsi_nasabah').html(data.nasabah[0].prov);
      $('.kabupaten_nasabah').html(data.nasabah[0].kab);
      $('.kecamatan_nasabah').html(data.nasabah[0].kec);
      $('.kelurahan_nasabah').html(data.nasabah[0].kel);
      $('.alamat_nasabah').html(data.nasabah[0].alamat_nasabah);
      $('.usaha_nasabah').html(data.nasabah[0].usaha_nasabah);
      SeparatorRibuanClass(data.nasabah[0].omset_nasabah.toString(),'omset_nasabah');
      var options = {
        center: [data.nasabah[0].latitude, data.nasabah[0].longitude],
        zoom: 13,
        minZoom: 6
      }
      if(mapid!=undefined)
      {
        mapid.remove();
      }
      mapid = new L.map('mapid', options);
      var marker = L.marker([data.nasabah[0].latitude, data.nasabah[0].longitude]).addTo(mapid);
      L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmFiaWxjaGVuIiwiYSI6ImNrOWZzeXh5bzA1eTQzZGxpZTQ0cjIxZ2UifQ.1YMI-9pZhxALpQ_7x2MxHw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiYXRob3h6b2VtYW50YSIsImEiOiJjbDI3bW82cnMwMHhjM2JwMXl2ajByNDN3In0.Esx5r-0LHnwqqgiO8DOfYA'
      }).addTo(mapid);

      $('#lihat_map').attr('href','http://maps.google.com/maps?q='+data.nasabah[0].latitude+', '+data.nasabah[0].longitude);

      if (data.nasabah[0].foto_usaha!='') {
        $('#foto_usaha').attr('href','<?php echo  base_url(); ?>'+data.nasabah[0].foto_usaha);
      }
      let fu ='';
      $('#list_fu').html('');
      for (var i = 0; i < data.follow_up.length; i++) {

        let approval = data.follow_up[i].approval
          approval_user = ""
        if(data.follow_up[i].approval_by != null) {
          approval_user = `|| ${data.follow_up[i].approval_by}`
        }

        if(approval == "pending") {
          approval = `
            <p class="text-dark bg-warning">
              <i class="fa fa-times"></i>
              ${approval}
            </p>
          `;
        } else if(approval == "disetujui") {
          approval = `
            <p class="text-white bg-primary">
              <i class="fa fa-check-square"></i>
              ACC ${approval_user}
            </p>
          `;
        }

        let status = data.follow_up[i].status
        // Periksa apakah ini perulangan terakhir dan statusnya adalah "Follow UP"
        if (i === data.follow_up.length - 1 && status === "Follow UP") {
            status = "Realisasi";
        }

        fu+=`<tr>
        <td>`+(i+1)+`</td>
        <td>`+data.follow_up[i].tanggal_fu+`</td>
        <td>`+data.follow_up[i].nama+`</td>
        <td>`+data.follow_up[i].hasil_fu+`</td>
        <td>`+status+`</td>
        <td class='text-center text-uppercase'>
        ${approval ?? ''}
        </td>
        <td>`;
        if (data.follow_up[i].lampiran_fu!='') {
          fu+=`<a href="<?php echo base_url() ?>`+data.follow_up[i].lampiran_fu+`" target="_blank" class="btn btn-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>`;
        }
        fu+=`</td></tr>`;
      }
      $('#list_fu').html(fu);

    },

  });

  return false;
});


$('#btn_tambah').on('click',function(){
  getLocation();

});

$('#lampiran_usaha').bind('change', function() {
  if(this.files[0].size > 6000000)
  {
    $('#lampiran_usaha').val('');

    Swal.fire({
    title:'Foto Tidak dapat Disimpan!!',
    html:'Ukuran Maximal 6 Mb',
    icon:'error',
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close(); 

    }
  });

  }
});

$('#lampiran_follow_up').bind('change', function() {
  if(this.files[0].size > 6000000)
  {
    $('#lampiran_follow_up').val('');

    Swal.fire({
    title:'Foto Tidak dapat Disimpan!!',
    html:'Ukuran Maximal 6 Mb',
    icon:'error',
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close(); 

    }
  });

  }
});

$('#btn_realisasi').on('click',function(){
 let no_ref = $('#no_ref').val();
 if (no_ref=="") {
  $('#no_ref').focus();
  Swal.fire({
    title:'Nomor Referensi Kosong',
    text:'Silahkan Masukkan Nomor Referensi!',
    icon:'error'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close();
    }
  });
  return false;
}

$('#btn_realisasi').attr('disabled','disabled');
$('#btn_realisasi').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');

$('#form_realisasi').submit();

});


$('#btn_simpan_followup').on('click',function(){
 let hasil_follow_up = $('#hasil_follow_up').val();
 if (hasil_follow_up=="") {
  $('#hasil_follow_up').focus();
  Swal.fire({
    title:'Hasil Follow UP Kosong',
    text:'Silahkan Masukkan Hasil Follow UP!',
    icon:'error'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close();
    }
  });
  return false;
}

$('#btn_simpan_followup').attr('disabled','disabled');
$('#btn_simpan_followup').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');

$('#form_followup').submit();

});

$('#btn_simpan').on('click',function(){
  let nama_nasabah = $('#nama_nasabah').val();
  if (nama_nasabah=="") {
    $('#nama_nasabah').focus();
    Swal.fire({
      title:'Nama Nasabah Kosong',
      text:'Silahkan Masukkan Nama Nasabah!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });
    return false;
  }

  let omset_nasabah = $('#omset_nasabah').val();
  if (omset_nasabah=="") {
    $('#omset_nasabah').focus();
    Swal.fire({
      title:'Omset Usaha Kosong',
      text:'Silahkan Masukkan Perkiraan Omset!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });
    return false;
  }

  let telp_nasabah = $('#telp_nasabah').val();
  let telp_nasabah_lama = $('#telp_nasabah_lama').val();

  if (telp_nasabah=="") {
    $('#telp_nasabah').focus();
    Swal.fire({
      title:'Nomor Telepon Kosong',
      text:'Silahkan Masukkan Nomor Telepon!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });
    return false;
  }
  if (telp_nasabah.length < 10 || telp_nasabah.length > 13 ) {
    $('#telp_nasabah').focus();
    Swal.fire({
      title:'Nomor Telepon Tidak Valid',
      text:'Nomor Telepon Min 10 Digit dan Max 13 Digit!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });
    return false;
  }
  let link = $('#form_potensi').attr('action');


  let format_telepon = /^[0]/;
  if (format_telepon.test(telp_nasabah)==false) {
   $('#telp_nasabah').focus();
   Swal.fire({
    title:'Nomor Telepon Tidak Valid',
    text:'Nomor Telepon Harus diawali Angka 0!',
    icon:'error'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close();
    }
  });
  return false;
}
let cek = 0;

$.ajax({
  type : "GET",
  url  : "<?php echo base_url('potensi_wilayah/cek_telepon')?>",
  dataType : "JSON",
  async:false,
  data : {'telp_nasabah': telp_nasabah},
  success: function(data){
    if (link.includes('simpan')!==false) {
      if (data > 0) {
        cek+=1;
      }
    }else{
     if (data > 0 && telepon_lama !=telp_nasabah ) {
      cek+=1;
    }
  }
}
});
if (cek > 0) {
 $('#telp_nasabah').focus();
 Swal.fire({
  title:'Nomor Telepon Sudah Digunakan',
  text:'Silahkan Cari pada Data Nasabah!',
  icon:'error'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.close();
  }
});
return false;
}

let prov_nasabah = $('#prov_nasabah').val();
if (prov_nasabah==null) {
  Swal.fire({
    title:'Provinsi Kosong',
    text:'Silahkan Pilih Provinsi!',
    icon:'error'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close();
      $('#prov_nasabah').select2('open');
    }
  });
  return false;
}

let kab_nasabah = $('#kab_nasabah').val();
if (kab_nasabah==null) {
  Swal.fire({
    title:'Kab Kota Kosong',
    text:'Silahkan Pilih Kab Kota !',
    icon:'error'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close();
      $('#kab_nasabah').select2('open');
    }
  });
  return false;
}  

let kec_nasabah = $('#kec_nasabah').val();
if (kec_nasabah==null) {
  Swal.fire({
    title:'Kecamatan Kosong',
    text:'Silahkan Pilih Kecamatan!',
    icon:'error'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close();
      $('#kec_nasabah').select2('open');
    }
  });
  return false;
}

let kel_nasabah = $('#kel_nasabah').val();
if (kel_nasabah==null) {
  Swal.fire({
    title:'Kelurahan Kosong',
    text:'Silahkan Pilih Kelurahan!',
    icon:'error'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close();
      $('#kel_nasabah').select2('open');
    }
  });
  return false;
}

let alamat_nasabah = $('#alamat_nasabah').val();
if (alamat_nasabah=="") {
  $('#alamat_nasabah').focus();
  Swal.fire({
    title:'Alamat Kosong',
    text:'Silahkan Masukkan Alamat Lengkap!',
    icon:'error'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.close();
    }
  });
  return false;
}

if (link.includes('simpan')!==false) {
  let lampiran_usaha = $('#lampiran_usaha').val();
  if (lampiran_usaha=="") {
    $('#lampiran_usaha').focus();
    Swal.fire({
      title:'Foto Usaha Kosong',
      text:'Silahkan Upload Foto Usaha!',
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

$('#form_potensi').submit();
});

function showPosition(position) {

  $('#latitude_gps').val(position.coords.latitude);
  $('#longitude_gps').val(position.coords.longitude);
  $('#modal_potensi').modal('show');
  $('#form_potensi').attr('action','<?php echo base_url('potensi_wilayah/simpan') ?>');
  $('#btn_simpan').html('SIMPAN');
  $('#form_potensi').trigger("reset");
  $('#label_header_produk').html('<i class="fas fa-id-card mr-2"></i> TAMBAH POTENSI WILAYAH');

}

function hanyaAngka(event) {
  var angka = (event.which) ? event.which : event.keyCode
  if (angka != 46 && angka != 8 && angka > 31 && (angka < 48 || angka > 57))
    return false;
  return true;
}
function get_kab(kode_wilayah)
{

 $.ajax({
  type : "GET",
  url  : "<?php echo base_url('potensi_wilayah/get_kab')?>",
  dataType : "JSON",
  data : {'kode_wilayah':kode_wilayah},
  success: function(data){
    if (data.length > 0) {
      let kab = '<option value="0" selected disabled>Pilih Kab/Kota</option>';
      for (var i = 0; i < data.length; i++) {
        kab+='<option value="'+data[i].kode_wilayah+'">'+data[i].nama_wilayah+'</option>';
      }
      $('#kab_nasabah').html(kab);
      $('#kab_nasabah').select2({
        placeholder:'Pilih Kab/kota',
        allowClear:true,
        dropdownParent:$('#modal_potensi .modal-content'),
      });
    }

  },

});


}
function get_kel(kode_wilayah)
{

 $.ajax({
  type : "GET",
  url  : "<?php echo base_url('potensi_wilayah/get_kel')?>",
  dataType : "JSON",
  data : {'kode_wilayah':kode_wilayah},
  success: function(data){
    if (data.length > 0) {
      let kel = '<option value="0" selected disabled>Pilih Kelurahan</option>';
      for (var i = 0; i < data.length; i++) {
        kel+='<option value="'+data[i].id_wilayah+'">'+data[i].nama_wilayah+'</option>';
      }
      $('#kel_nasabah').html(kel);
      $('#kel_nasabah').select2({
        placeholder:'Pilih Kelurahan',
        allowClear:true,
        dropdownParent:$('#modal_potensi .modal-content'),
      });
    }

  },

});


}


function get_kab_edit(kode_wilayah,kode_kab)
{

 $.ajax({
  type : "GET",
  url  : "<?php echo base_url('potensi_wilayah/get_kab')?>",
  dataType : "JSON",
  data : {'kode_wilayah':kode_wilayah},
  success: function(data){
    if (data.length > 0) {
      let kab = '<option value="0" selected disabled>Pilih Kab/Kota</option>';
      for (var i = 0; i < data.length; i++) {
        if (data[i].kode_wilayah==kode_kab) {
          kab+='<option value="'+data[i].kode_wilayah+'" selected>'+data[i].nama_wilayah+'</option>';
        }else{
          kab+='<option value="'+data[i].kode_wilayah+'" >'+data[i].nama_wilayah+'</option>';

        }
      }
      $('#kab_nasabah').html(kab);
      $('#kab_nasabah').select2({
        placeholder:'Pilih Kab/kota',
        allowClear:true,
        dropdownParent:$('#modal_potensi .modal-content'),
      });
    }

  },

});


}

function get_kec_edit(kode_wilayah,kode_kec)
{
 $.ajax({
  type : "GET",
  url  : "<?php echo base_url('potensi_wilayah/get_kec')?>",
  dataType : "JSON",
  data : {'kode_wilayah':kode_wilayah},
  success: function(data){
    if (data.length > 0) {
      let kec = '<option value="0" disabled>Pilih Kecamatan</option>';
      for (var i = 0; i < data.length; i++) {
        if (data[i].kode_wilayah==kode_kec) {
          kec+='<option value="'+data[i].kode_wilayah+'" selected>'+data[i].nama_wilayah+'</option>';
        }else{
          kec+='<option value="'+data[i].kode_wilayah+'">'+data[i].nama_wilayah+'</option>';
        }
      }
      $('#kec_nasabah').html(kec);
      $('#kec_nasabah').select2({
        placeholder:'Pilih Kecamatan',
        allowClear:true,
        dropdownParent:$('#modal_potensi .modal-content'),
      });
    }

  },

});
}

function get_kel_edit(kode_wilayah,kode_kel)
{
 $.ajax({
  type : "GET",
  url  : "<?php echo base_url('potensi_wilayah/get_kel')?>",
  dataType : "JSON",
  data : {'kode_wilayah':kode_wilayah},
  success: function(data){
    if (data.length > 0) {
      let kec = '<option value="0" disabled>Pilih Kelurahan</option>';
      for (var i = 0; i < data.length; i++) {
        if (data[i].id_wilayah==kode_kel) {
          kec+='<option value="'+data[i].id_wilayah+'" selected>'+data[i].nama_wilayah+'</option>';
        }else{
          kec+='<option value="'+data[i].id_wilayah+'">'+data[i].nama_wilayah+'</option>';

        }
      }
      $('#kel_nasabah').html(kec);
      $('#kel_nasabah').select2({
        placeholder:'Pilih Kelurahan',
        allowClear:true,
        dropdownParent:$('#modal_potensi .modal-content'),
      });
    }

  },

});


}

function get_kec(kode_wilayah)
{
 $.ajax({
  type : "GET",
  url  : "<?php echo base_url('potensi_wilayah/get_kec')?>",
  dataType : "JSON",
  data : {'kode_wilayah':kode_wilayah},
  success: function(data){
    if (data.length > 0) {
      let kec = '<option value="0" selected disabled>Pilih Kecamatan</option>';
      for (var i = 0; i < data.length; i++) {
        kec+='<option value="'+data[i].kode_wilayah+'">'+data[i].nama_wilayah+'</option>';
      }
      $('#kec_nasabah').html(kec);
      $('#kec_nasabah').select2({
        placeholder:'Pilih Kecamatan',
        allowClear:true,
        dropdownParent:$('#modal_potensi .modal-content'),
      });
    }

  },

});


}

function SeparatorRibuan(bilangan,id){
  let angka = bilangan.replace(/\./g,'');
  let sisa  = angka.length % 3;
  awalan  = angka.substr(0, sisa);
  ribuan  = angka.substr(sisa).match(/\d{3}/g);
  if (ribuan) {
    separator = sisa ? '.' : '';
    hasil = awalan + separator + ribuan.join('.');
    $('#'+id).val(hasil);


  }
}

function SeparatorRibuanClass(bilangan,kelas){
  let angka = bilangan.replace(/\./g,'');
  let sisa  = angka.length % 3;
  awalan  = angka.substr(0, sisa);
  ribuan  = angka.substr(sisa).match(/\d{3}/g);
  if (ribuan) {
    separator = sisa ? '.' : '';
    hasil ='Rp. '+awalan + separator + ribuan.join('.');
    $('.'+kelas).html(hasil);


  }
}


function main() {

  var options = {
    center: [-7.4466262, 111.0254159,17],
    zoom: 13
  }

  var mapid = new L.map('mapid', options);
  var marker = L.marker([-7.4466262, 111.0254159,17]).addTo(mapid);
  L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmFiaWxjaGVuIiwiYSI6ImNrOWZzeXh5bzA1eTQzZGxpZTQ0cjIxZ2UifQ.1YMI-9pZhxALpQ_7x2MxHw', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 20,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiYXRob3h6b2VtYW50YSIsImEiOiJjbDI3bW82cnMwMHhjM2JwMXl2ajByNDN3In0.Esx5r-0LHnwqqgiO8DOfYA'
  }).addTo(mapid);


// get coordinate

mapid.on('click',
  function(e){
    var coord = e.latlng.toString().split(',');
    var lat = coord[0].replace('LatLng(','');
    var long = coord[1].replace(')','');
    $('#koorY').val(long);
    $('#koorX').val(lat);
    if (marker!==null) {
      mapid.removeLayer(marker);
    }
    marker = L.marker(e.latlng).addTo(mapid);
  });
}

// window.onload = main;



</script>













