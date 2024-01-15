<?php $session = (object) $this->session->userdata(); ?>
<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; <?php echo  $this->session->nama_website ?> <?php echo  date('Y'); ?></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <a class="btn btn-primary" href="login.html">Logout</a>
    </div>
  </div>
</div>
</div>

<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/leaflet.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>

<!-- Sweet Alert -->
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.masknumber.js"></script>
<!-- Page level custom scripts -->
<!-- <script src="<?php echo base_url() ?>assets/js/demo/chart-area-demo.js"></script> -->
<!-- <script src="<?php echo base_url() ?>assets/js/demo/chart-pie-demo.js"></script> -->
<script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modules-datatables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


<script type="text/javascript">
  $('#jenis_laporan').on('change',function(){
    let jenis = $(this).val();
    let level = '<?php echo $this->session->level ?>';
    if (level=="Admin" || level=="PIC" || level=="Supervisor") {
      if (jenis=="Marketing") {
        $('.marketing_laporan').removeClass('d-none');
        let kategori = $('#kategori_laporan').val();
        if (kategori=="Kunjungan Nasabah") {
          $('#allmarketing').html('Pilih Marketing');
          $('#allmarketing').val('0');
          $('#allmarketing').attr('disabled','disabled');
        }else{
          $('#allmarketing').html('All');
          $('#allmarketing').val('All');
          $('#allmarketing').removeAttr('disabled');


        }
      }else{
        $('.marketing_laporan').addClass('d-none');
      }

      if (jenis=="Cabang" && level!="Supervisor") {
        $('.cabang_laporan').removeClass('d-none');
      }else{
        $('.cabang_laporan').addClass('d-none');
      }

      
    }

    if (jenis=="Nasabah") {
      $('.nasabah_kunjungan').removeClass('d-none');
    }else{
      $('.nasabah_kunjungan').addClass('d-none');
    }

    if(jenis == "sosmed_user") {

$('#sosmed-user').select2({
  placeholder:"Pilih User",
  allowClear :true,
  dropdownParent:$('#ModalLaporan'),
});
$('#div-sosmed-user').removeClass('d-none')
} else {
$('#div-sosmed-user').addClass('d-none')
}

if(jenis == "sosmed_cabang") {

$('#sosmed-cabang').select2({
  placeholder:"Pilih Cabang",
  allowClear :true,
  dropdownParent:$('#ModalLaporan'),
});
$('#div-sosmed-cabang').removeClass('d-none')
} else {
$('#div-sosmed-cabang').addClass('d-none')
}

if(jenis == "sosmed_sosmed") {

$('#sosmed-sosmed').select2({
  placeholder:"Pilih Sosmed",
  allowClear :true,
  dropdownParent:$('#ModalLaporan'),
});
$('#div-sosmed-sosmed').removeClass('d-none')
} else {
$('#div-sosmed-sosmed').addClass('d-none')
}

  });

  $('#kategori_laporan').on('change',function(){

    let kategori = $(this).val();
    let level = '<?php echo $this->session->level ?>';

    $('#jenis_laporan').removeAttr('disabled');

    let laporan =`<option value="0" disabled selected>Pilih Laporan</option>
    <option value="Marketing">Per Marketing</option>  
    <option value="Cabang">Per Cabang</option>  
    <option value="Periode">Per Periode</option>`;
    if (kategori=="Kunjungan Nasabah") {

      $.ajax({
        type : "GET",
        url  : "<?php echo base_url('dashboard/get_nasabah_kunjungan')?>",
        dataType : "JSON",
        success: function(data){
          let nasabah ='<option value="0" disabled selected>Pilih Nasabah</option>';
          for (var i = 0; i <data.nasabah.length; i++) {
            nasabah+='<option value="'+data.nasabah[i].id_kunjungan+'">'+data.nasabah[i].no_rekening+' - '+data.nasabah[i].nama_nasabah+'</option>';
          }
          $('#nasabah_kunjungan').html(nasabah);

          $('#nasabah_kunjungan').select2({
            placeholder:"Pilih Nasabah",
            allowClear :true,
            dropdownParent:$('#ModalLaporan'),
          });

          laporan =`<option value="0" disabled selected>Pilih Laporan</option>
          <option value="Marketing">Per Marketing</option><option value="Nasabah">Per Nasabah</option><option value="Cabang">Rekap Cabang</option>`;

          $('#jenis_laporan').html(laporan);

        },
      });

    } else if (kategori=="Potensi Wilayah") {

$.ajax({
  type : "GET",
  url  : "<?php echo base_url('dashboard/get_nasabah')?>",
  dataType : "JSON",
  success: function(data){
    let nasabah ='<option value="0" disabled selected>Pilih Nasabah</option>';
    for (var i = 0; i <data.nasabah.length; i++) {
      nasabah+='<option value="'+data.nasabah[i].id_nasabah+'">'+data.nasabah[i].telp_nasabah+' - '+data.nasabah[i].nama_nasabah+'</option>';
    }
    $('#nasabah_kunjungan').html(nasabah);

    $('#nasabah_kunjungan').select2({
      placeholder:"Pilih Nasabah",
      allowClear :true,
      dropdownParent:$('#ModalLaporan'),
    });

    laporan =`
    <option value="0" disabled selected>Pilih Laporan</option>
    <option value="Marketing">Per Marketing</option>
    <option value="Nasabah">Per Nasabah</option>
    <option value="Cabang">Rekap Cabang</option>
    <option value="Periode">Per Periode</option>`;

    $('#jenis_laporan').html(laporan);

  },
});

} else if (kategori=="Pengajuan Online") {

$.ajax({
  type : "GET",
  url  : "<?php echo base_url('dashboard/get_nasabah_pengajuan')?>",
  dataType : "JSON",
  success: function(data){
    let nasabah ='<option value="0" disabled selected>Pilih Nasabah</option>';
    for (var i = 0; i <data.nasabah.length; i++) {
      nasabah+='<option value="'+data.nasabah[i].id_pengajuan+'">'+data.nasabah[i].nik+' - '+data.nasabah[i].nama+'</option>';
    }
    $('#nasabah_kunjungan').html(nasabah);

    $('#nasabah_kunjungan').select2({
      placeholder:"Pilih Nasabah",
      allowClear :true,
      dropdownParent:$('#ModalLaporan'),
    });

    laporan =`
    <option value="0" disabled selected>Pilih Laporan</option>
    <option value="Marketing">Per Marketing</option>
    <option value="Nasabah">Per Nasabah</option>
    <option value="Cabang">Rekap Cabang</option>
    <option value="Nasabah">Per Nasabah</option>`;

    $('#jenis_laporan').html(laporan);

  },
});

    } else if(kategori == "sosmed") {

laporan = `
  <?php if($session->level !== "Marketing") : ?>
    <option value="sosmed_all">All</option>
  <?php endif ?>
  <option value="sosmed_user">Per User</option>
  <option value="sosmed_cabang">Per Cabang</option>
  <option value="sosmed_sosmed">Per Sosmed</option>
`

$('#jenis_laporan').html(laporan)

    } else{
      $('#jenis_laporan').html(laporan);

    }
  });


  $(document).on('click','.item_tarik_laporan',function(e){
    e.preventDefault();
    let level = '<?php echo $this->session->level ?>';
    if (level=="Admin" || level=="PIC" || level=="Supervisor") {
      $.ajax({
        type : "GET",
        url  : "<?php echo base_url('dashboard/get_option_laporan')?>",
        dataType : "JSON",
        success: function(data){
          $('#ModalLaporan').modal('show');

          $('.cabang_laporan').addClass('d-none');
          $('.marketing_laporan').addClass('d-none');
          let marketing ='<option value="All" >All</option>';
          for (var i = 0; i <data.marketing.length; i++) {
            marketing+='<option value="'+data.marketing[i].id_user+'">'+data.marketing[i].nama+'</option>';
          }
          $('#nama_marketing_laporan').html(marketing);
          $('#nama_marketing_laporan').select2({
            placeholder:'Pilih Marketing',
            allowClear:true,
            dropdownParent:$('#ModalLaporan'),
          });
          let cabang ='<option value="All">All</option>';
          for (var i = 0; i <data.cabang.length; i++) {
            cabang+='<option value="'+data.cabang[i].id_cabang+'">'+data.cabang[i].nama_cabang+'</option>';
          }
          $('#cabang_laporan').html(cabang);


        }
      });


    }else{
      $('#ModalLaporan').modal('show');
      $('.cabang_laporan').addClass('d-none');
      $('.marketing_laporan').addClass('d-none');
    }
  });

  function show_password_user(id) {
    if ($('#' + id).attr('type') == "password") {
      $('#' + id).attr('type', 'text');
      $('.' + id).html('<i class="fa fa-eye-slash"></i>');
    } else {
      $('#' + id).attr('type', 'password');
      $('.' + id).html('<i class="fa fa-eye"></i>');

    }
  }


  $('#btn_ubah_password_user').on('click', function() {
    let cek = 0;

    let password = $('#password_baru_user').val();
    let confirm = $('#confirm_password_baru_user').val();
    if (password == "") {
      cek++;
      $('#password_baru_user').focus();
      $('.error-password_baru_user').html('Silahkan Masukkan Password Baru');
    } else {
      $('.error-password_baru_user').html('');
    }
    if (password !== confirm) {
      cek++;
      $('#confirm_password_baru_user').focus();
      $('#confirm_password_baru_user').val();
      $('.error-confirm_password_baru_user').html('Konfirmasi Password Tidak Valid');
    } else {
      $('.error-confirm_password_baru_user').html('');
    }
    if (cek > 0) {
      return false;
    } else {
      $('#form_ubah_password_user').submit();

    }

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

  $('#btn_tarik_laporan').on('click',function(){

    let kategori_laporan = $('#kategori_laporan').val();
    if (kategori_laporan==null) {
      $('#kategori_laporan').focus();
      Swal.fire({
        title:'Error',
        text:'Silahkan Pilih Kategori Laporan!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }


    let jenis = $('#jenis_laporan').val();
    if (jenis==null) {
      $('#jenis_laporan').focus();
      Swal.fire({
        title:'Error',
        text:'Silahkan Pilih Jenis Laporan!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

    if (jenis=="Nasabah") {

      let nasabah = $('#nasabah_kunjungan').val();
      if (nasabah==null) {

        $('#jenis_laporan').focus();
        Swal.fire({
          title:'Error',
          text:'Silahkan Pilih Nasabah!',
          icon:'error'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.close();
          }
        });
        return false;
      }
    }

    if (jenis=="Marketing" && kategori_laporan=="Kunjungan Nasabah") {
      let level ='<?php echo $this->session->level ?>';
      if (level!="Marketing") {
      }
      let marketing = $('#nama_marketing_laporan').val();
      if (marketing==null) {

        $('#nama_marketing_laporan').focus();
        Swal.fire({
          title:'Error',
          text:'Silahkan Pilih Marketing!',
          icon:'error'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.close();
          }
        });
        return false;
      }
    }


    let tanggal_awal_laporan = $('#tanggal_awal_laporan').val();
    if (tanggal_awal_laporan=='') {
      $('#tanggal_awal_laporan').focus();
      Swal.fire({
        title:'Error',
        text:'Silahkan Masukkan Tanggal Awal!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

    let tanggal_akhir_laporan = $('#tanggal_akhir_laporan').val();
    if (tanggal_akhir_laporan=='') {
      $('#tanggal_akhir_laporan').focus();
      Swal.fire({
        title:'Error',
        text:'Silahkan Masukkan Tanggal Akhir!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }
    if (tanggal_akhir_laporan < tanggal_awal_laporan) {
      $('#tanggal_akhir_laporan').focus();
      Swal.fire({
        title:'Error',
        text:'Rentang Tanggal Tidak Valid!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

    $('#form_tarik_laporan').submit();

  });

</script>
</body>

</html>