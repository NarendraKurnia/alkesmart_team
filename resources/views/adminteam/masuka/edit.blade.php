<p class="text-right">
    <a href="{{ url('adminteam/masuka') }}" class="btn btn-outline-info btn-sm">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</p>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Edit Laporan Masuk Kunjungan</h3>
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

        {{-- URL Form dialihkan menuju proses-edit --}}
        <form action="{{ url('adminteam/masuka/proses-edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        {{-- Input Hidden ID Masuk untuk parameter update --}}
        <input type="hidden" name="id_masuk" value="{{ $detail->id_masuk }}">

        {{-- 1. NAMA LENGKAP MARKETING --}}
        <div class="form-group row">
            <label class="col-md-3 text-right">Nama Lengkap Marketing</label>
            <div class="col-md-9">
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $detail->nama) }}" required>
            </div>
        </div>

        {{-- 2. JAM KEHADIRAN (Bisa Diedit) --}}
        <div class="form-group row">
            <label class="col-md-3 text-right">Jam Kehadiran</label>
            <div class="col-md-9">
                <input type="time" name="jam_kehadiran" class="form-control" value="{{ old('jam_kehadiran', \Carbon\Carbon::parse($detail->jam_kehadiran)->format('H:i')) }}" required>
            </div>
        </div>

        {{-- 3. TANGGAL KUNJUNGAN (Bisa Diedit & Diberikan Atribut Name) --}}
        <div class="form-group row">
            <label class="col-md-3 text-right">Tanggal</label>
            <div class="col-md-9">
                <input type="date" name="tanggal_kunjungan" class="form-control" value="{{ old('tanggal_kunjungan', \Carbon\Carbon::parse($detail->tanggal_kunjungan)->format('Y-m-d')) }}" required>
            </div>
        </div>

        {{-- 4. JENIS KEGIATAN --}}
        <div class="form-group row">
            <label class="col-md-3 text-right">Jenis Kegiatan</label>
            <div class="col-md-9">
                <select name="kegiatan" class="form-control" required>
                    <option value="" disabled>Pilih Kegiatan</option>
                    <option value="kunjungan" {{ old('kegiatan', $detail->kegiatan) == 'kunjungan' ? 'selected' : '' }}>Kunjungan</option>
                    <option value="byWA" {{ old('kegiatan', $detail->kegiatan) == 'byWA' ? 'selected' : '' }}>By WA</option>
                </select>
            </div>
        </div>

        {{-- 5. KABUPATEN --}}
        <div class="form-group row">
            <label class="col-md-3 text-right">Kabupaten</label>
            <div class="col-md-9">
                <select name="kabupaten_id" id="kabupaten_id" class="form-control select2" required>
                    <option value="" disabled>Pilih Kabupaten</option>
                    @foreach($kabupaten as $k)
                        <option value="{{ $k->id_kabupaten }}" {{ old('kabupaten_id', $detail->kabupaten_id) == $k->id_kabupaten ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- 6. INSTANSI --}}
        <div class="form-group row">
            <label class="col-md-3 text-right">Instansi</label>
            <div class="col-md-9">
                <select name="instansi_id" id="instansi_id" class="form-control select2" required>
                    <option value="">-- Pilih Instansi --</option>
                    @foreach($instansi as $i)
                        <option value="{{ $i->id_instansi }}" 
                                data-kabupaten="{{ $i->kabupaten_id }}"
                                {{ old('instansi_id', $detail->instansi_id) == $i->id_instansi ? 'selected' : '' }}>
                            {{ $i->nama }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Pilih kabupaten terlebih dahulu untuk memfilter instansi.</small>
            </div>
        </div>

        {{-- AJAX BOX CATATAN SEBELUMNYA --}}
        <div id="box-catatan" class="form-group row" style="display:none;">
            <label class="col-md-3 text-right text-primary"><b>CATATAN SEBELUMNYA</b></label>
            <div class="col-md-9">
                <div class="alert alert-warning" style="border-left: 5px solid #ffc107;">
                    <p id="isi-catatan" style="margin-bottom: 0; font-weight: bold;"></p>
                    <small id="info-catatan" class="text-muted"></small>
                </div>
            </div>
        </div>

        {{-- 7. FOTO KUNJUNGAN (Required dihapus agar opsional saat edit) --}}
        <div class="form-group row">
            <label class="col-md-3 text-right">Foto Kunjungan</label>
            <div class="col-md-9">
                <input type="file" name="foto" class="form-control" accept="image/*">
                <small class="text-danger d-block mt-1">Format: JPG, PNG, JPEG. *Biarkan kosong jika tidak ingin mengganti foto bukti.</small>
                
                @if(!empty($detail->foto))
                    <div class="mt-3 p-2 border rounded bg-light d-inline-block">
                        <p class="small text-muted mb-1 font-weight-bold"><i class="fa fa-image"></i> Bukti Foto Terunggah:</p>
                        <img src="{{ asset('admin/upload/absensi/' . $detail->foto) }}" class="img-fluid rounded shadow-sm" style="max-height: 180px; object-fit: contain;">
                    </div>
                @endif
            </div>
        </div>

        {{-- BUTTON ACTIONS --}}
        <div class="form-group row">
            <label class="col-md-3 text-right"></label>
            <div class="col-md-9">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-save"></i> Perbarui Presensi
                </button>
                <button class="btn btn-default" type="reset">Reset</button>
            </div>
        </div>

        </form>
    </div>
</div>

{{-- SCRIPT JAVASCRIPT --}}
<script>
// Filter Instansi otomatis saat halaman pertama kali dimuat
document.addEventListener("DOMContentLoaded", function() {
    var kabId = document.getElementById('kabupaten_id').value;
    if (kabId) {
        filterInstansiData(kabId, false);
        // Trigger pencarian catatan otomatis berdasarkan instansi bawaan database
        var currentInstansi = document.getElementById('instansi_id').value;
        if(currentInstansi) {
            getCatatanTerakhir(currentInstansi);
        }
    }
});

// Filter Instansi ketika Kabupaten diubah
document.getElementById('kabupaten_id').addEventListener('change', function() {
    filterInstansiData(this.value, true);
});

function filterInstansiData(kabId, resetSelect) {
    var instansiSelect = document.getElementById('instansi_id');
    var options = instansiSelect.options;

    if (resetSelect) {
        instansiSelect.value = "";
        $('#box-catatan').hide();
    }

    for (var i = 0; i < options.length; i++) {
        var option = options[i];
        
        if (option.value === "") {
            option.style.display = 'block';
            continue;
        }

        if (option.getAttribute('data-kabupaten') == kabId) {
            option.style.display = 'block';
            option.disabled = false;
        } else {
            option.style.display = 'none';
            option.disabled = true;
        }
    }
}

// Handler event perubahan Instansi untuk memicu AJAX catatan
$('#instansi_id').on('change', function() {
    getCatatanTerakhir($(this).val());
});

function getCatatanTerakhir(instansiId) {
    if (instansiId) {
        $.ajax({
            url: "{{ url('adminteam/masuka/ambil-catatan') }}", // Menyesuaikan base URL adminteam Anda
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
}
</script>