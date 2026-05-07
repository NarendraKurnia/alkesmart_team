
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>
  
  <!-- Icon web -->
  <link rel="icon" href="{{asset('umum/images/logo-arumbromo.png') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- jQuery -->
  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
   <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
 <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- SweetAlert2 -->
  <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- Tailwind CSS -->
     <script src="https://cdn.tailwindcss.com"></script>
     <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body class="hold-transition login-page">

@include($content)

<script>
tinymce.init({
  selector: '.simple',
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | help',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
</script>

<?php 
$sek  = date('Y');
$awal = $sek-100;
?>
<script>
  // notifikasi jika sukses
<?php if(Session::get('sukses')) { ?>
  Swal.fire({
    title: 'Berhasil!',
    text: "{{ Session::get('sukses') }}",
    icon: 'success',
    confirmButtonText: 'Ok, Terimakasih'
});
<?php } ?> 
// notifikasi jika gagal
<?php if(Session::get('warning')) { ?>
  Swal.fire({
    title: 'Oopsss..!',
    text: "{{ Session::get('warning') }}",
    icon: 'warning',
    confirmButtonText: 'Coba Lagi'
});
<?php } ?> 

  // Popup Delete
  $(document).ready(function() {
    // Event handler untuk link dengan class 'delete-link'
    $('.delete-link').on('click', function(e) {
      e.preventDefault(); //mencegah aksi default link

      var href = $(this).attr('href'); //Mendapatkan URL dari href link

      // Menampilkan konfirmasi dengan SweetAlert2
      Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor:  '#d33',
        confirmButtonText:  'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((reslut) => {
        if    (result.isConfirmed) {
          // Jika pengguna menkonfirmasi, lanjutkan ke URL penghapusan
          window.location.href;
        }    
      })
    })
   })

</script>

<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
