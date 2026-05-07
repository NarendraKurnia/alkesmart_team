</div>
              <!-- /.card-body -->
              <div class="card-footer">
                Footer
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
<!-- script js  -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- /.content-wrapper -->
  <script>
@if ($message = Session::get('sukses'))
// Notifikasi
swal ( "Berhasil" ,  "<?php echo $message ?>" ,  "success" )
@endif

@if ($message = Session::get('warning'))
// Notifikasi
swal ( "Oops.." ,  "<?php echo $message ?>" ,  "warning" )
@endif

// Popup Delete
$(document).on("click", ".delete-link", function(e){
  e.preventDefault();
  url = $(this).attr("href");
  swal({
    title:"Yakin akan menghapus data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-success',
    buttonsStyling: false,
    confirmButtonText: "Delete",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },
  function(isConfirm){
    if(isConfirm){
      $.ajax({
        url: url,
        success: function(resp){
          window.location.href = url;
        }
      });
    }
    return false;
  });
});
// Popup disable
$(document).on("click", ".disable-link", function(e){
  e.preventDefault();
  url = $(this).attr("href");
  swal({
    title:"Yakin akan menonaktifkan data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-success',
    buttonsStyling: false,
    confirmButtonText: "Non Aktifkan",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },
  function(isConfirm){
    if(isConfirm){
      $.ajax({
        url: url,
        success: function(resp){
          window.location.href = url;
        }
      });
    }
    return false;
  });
});

// Popup approval
$(document).on("click", ".approval-link", function(e){
  e.preventDefault();
  url = $(this).attr("href");
  swal({
    title:"Anda yakin ingin menyetujui data ini?",
    type: "info",
    showCancelButton: true,
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-success',
    buttonsStyling: false,
    confirmButtonText: "Ya, Setujui",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },
  function(isConfirm){
    if(isConfirm){
      $.ajax({
        url: url,
        success: function(resp){
          window.location.href = url;
        }
      });
    }
    return false;
  });
});
</script>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2025 <a href="https://adminlte.io">Harmoni PT.PLN(Persero) UID Jawa Timur</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>
tinymce.init({
    selector: 'textarea.editor',
    menubar: false,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
      'bold italic | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat',
    height: 300,
    setup: function(editor) {
      editor.on('change', function () {
        tinymce.triggerSave(); // Sync TinyMCE content to textarea
      });
    }
  });
</script>

<?php 
$sek  = date('Y');
$awal = $sek-100;
?>
<script>
  // notifikasi
<?php if(Session::get('sukses')) { ?>
  Swal.fire({
    title: 'Berhasil!',
    text: "{{ Session::get('sukses') }}",
    icon: 'success',
    confirmButtonText: 'Ok, Terimakasih'
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


<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch('/security/dashboard/data')
        .then(response => response.json())
        .then(data => {
            // Total shift
            document.getElementById('shiftMasuk').textContent = data.total_shift_masuk;
            document.getElementById('shiftSelesai').textContent = data.total_shift_selesai;

            // Catatan
            document.getElementById('catatan').textContent = data.catatan_terakhir ?? 'Tidak ada catatan.';

            // Petugas shift
            const petugasList = document.getElementById('petugasList');
            petugasList.innerHTML = ''; // Clear loading

            if (data.petugas_shift.length > 0) {
                data.petugas_shift.forEach(item => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <strong>${item.shift}</strong> (${item.tanggal_shift}):
                        ${item.nama_security_1 ?? '-'}, ${item.nama_security_2 ?? '-'}, ${item.nama_security_3 ?? '-'}
                    `;
                    petugasList.appendChild(li);
                });
            } else {
                petugasList.innerHTML = '<li>Tidak ada data shift hari ini.</li>';
            }

            // (Opsional) render grafik shift...
        });
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const nama3 = document.getElementById("nama_security_3");
        const jam3 = document.getElementById("jam_kehadiran_3");

        // Fungsi untuk ambil waktu lokal sekarang dalam format "HH:MM"
        function getCurrentTime() {
            const now = new Date();
            return now.toTimeString().slice(0, 5);
        }

        // Event saat user mengetik nama
        nama3.addEventListener("input", function () {
            if (nama3.value.trim() !== "") {
                // Hanya set jam & disable jika jam masih kosong
                if (jam3.value === "") {
                    jam3.disabled = false; // Aktifkan sejenak
                    jam3.value = getCurrentTime(); // Isi otomatis
                    jam3.disabled = true; // Langsung disable kembali
                }
            } else {
                jam3.disabled = true;
                jam3.value = ""; // Kosongkan jika nama dihapus
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const namaSecurity3 = document.getElementById('nama_security_3');
        const jamSelesai3 = document.getElementById('jam_selesai_3');

        function setJamSelesai() {
            if (namaSecurity3.value.trim() === '') {
                // Kosongkan jam selesai 3 jika nama security 3 kosong
                jamSelesai3.value = '';
            } else {
                // Jika ada isian, isi jam selesai 3 dengan waktu sekarang (HH:mm)
                const now = new Date();
                const hours = now.getHours().toString().padStart(2, '0');
                const minutes = now.getMinutes().toString().padStart(2, '0');
                jamSelesai3.value = `${hours}:${minutes}`;
            }
        }

        // Jalankan saat load halaman (supaya nilai otomatis benar)
        setJamSelesai();

        // Jalankan tiap kali input nama security 3 berubah
        namaSecurity3.addEventListener('input', setJamSelesai);
    });
</script>

<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}
</script>



<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('assets/admin/dist/js/demo.js') }}"></script> -->
 <!-- grafik -->
</body>
</html>