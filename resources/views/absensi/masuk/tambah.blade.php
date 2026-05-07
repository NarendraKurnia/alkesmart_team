<p class="text-right">
    <a href="{{ url('absensi/masuk') }}" class="btn btn-outline-info btn-sm">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</p>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Input Kunjungan</h3>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('absensi/masuk/proses-tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
            <label class="col-md-3 text-right">Nama Lengkap</label>
            <div class="col-md-9">
                <input type="text" name="nama" class="form-control" value="{{ Auth::user()->name }}" readonly>
            </div>
        </div>

        <div class="form-group row">
    <label class="col-md-3 text-right">Jam Kehadiran</label>
    <div class="col-md-9">
        @php
            // Jika variabel dari controller kosong, buat baru di sini
            $now = $currentTime ?? \Carbon\Carbon::now()->format('H:i');
        @endphp
        <input type="time" name="jam_kehadiran" class="form-control" value="{{ $now }}" required>
    </div>
</div>

        <div class="form-group row">
            <label class="col-md-3 text-right">Tanggal</label>
            <div class="col-md-9">
                @php
        $today = \Carbon\Carbon::now()->format('d-m-Y');
    @endphp
    {{-- Jangan pakai name agar tidak dikirim --}}
    <input type="text" class="form-control" value="{{ $today }}" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right">Jenis Kegiatan</label>
            <div class="col-md-9">
                <select name="kegiatan" class="form-control" required>
                    <option value="" disabled selected>Pilih Kegiatan</option>
                            <option value="kunjungan">Kunjungan</option>
                            <option value="byWA">By WA</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right">Kabupaten</label>
            <div class="col-md-9">
                <select name="kabupaten_id" id="kabupaten_id" class="form-control select2" required>
                    <option value="" disabled selected>Pilih Kabupaten</option>
                    @foreach($kabupaten as $k)
                        <option value="{{ $k->id_kabupaten }}">{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right">Instansi</label>
            <div class="col-md-9">
                <select name="instansi_id" id="instansi_id" class="form-control select2" required>
                    <option value="">-- Pilih Instansi --</option>
                    @foreach($instansi as $i)
                        <option value="{{ $i->id_instansi }}" 
                                data-kabupaten="{{ $i->kabupaten_id }}" 
                                style="display: none;">
                            {{ $i->nama }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Pilih kabupaten terlebih dahulu untuk memfilter instansi.</small>
            </div>
        </div>

        <div id="box-catatan" class="form-group row" style="display:none;">
            <label class="col-md-3 text-right text-primary"><b>CATATAN SEBELUMNYA</b></label>
            <div class="col-md-9">
                <div class="alert alert-warning" style="border-left: 5px solid #ffc107;">
                    <p id="isi-catatan" style="margin-bottom: 0; font-weight: bold;"></p>
                    <small id="info-catatan" class="text-muted"></small>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right">Foto Kunjungan</label>
            <div class="col-md-9">
                <input type="file" name="foto" class="form-control" accept="image/*" required>
                <small class="text-danger">Format: JPG, PNG, JPEG</small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right"></label>
            <div class="col-md-9">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-save"></i> Simpan Presensi
                </button>
                <button class="btn btn-default" type="reset">Reset</button>
            </div>
        </div>

        </form>
    </div>
</div>

{{-- Script sederhana untuk filter Instansi berdasarkan Kabupaten --}}
<script>
document.getElementById('kabupaten_id').addEventListener('change', function() {
    var kabId = this.value;
    var instansiSelect = document.getElementById('instansi_id');
    var options = instansiSelect.options;

    // 1. Reset pilihan instansi ke default
    instansiSelect.value = "";

    // 2. Loop semua pilihan instansi
    for (var i = 0; i < options.length; i++) {
        var option = options[i];
        
        if (option.value === "") {
            option.style.display = 'block'; // Tetap tampilkan "-- Pilih Instansi --"
            continue;
        }

        // 3. Cek kesesuaian data-kabupaten
        if (option.getAttribute('data-kabupaten') == kabId) {
            option.style.display = 'block';
            option.disabled = false; // Pastikan tidak di-disable
        } else {
            option.style.display = 'none';
            option.disabled = true;  // Disable agar tidak bisa dipilih via keyboard
        }
    }
    
    // Khusus jika Anda menggunakan plugin Select2, tambahkan baris ini:
    // $('#instansi_id').select2(); 
});
</script>
<script>
$('#instansi_id').on('change', function() {
    var instansiId = $(this).val();
    
    if (instansiId) {
        $.ajax({
            url: "{{ url('absensi/masuk/ambil-catatan') }}",
            type: "GET",
            data: { instansi_id: instansiId },
            dataType: "json",
            success: function(data) {
                if (data.status === 'success') {
                    $('#box-catatan').fadeIn();
                    $('#isi-catatan').text(data.catatan);
                    $('#info-catatan').text("Ditulis oleh: " + data.oleh + " pada " + data.tanggal);
                } else {
                    $('#box-catatan').hide();
                }
            }
        });
    } else {
        $('#box-catatan').hide();
    }
});
</script>