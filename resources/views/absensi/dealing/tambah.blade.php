<p class="text-right">
    <a href="{{ url('absensi/dealing') }}" class="btn btn-outline-info btn-sm">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</p>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Input Kesepakatan Dealing</h3>
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

        <form action="{{ url('absensi/dealing/proses-tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
            <label class="col-md-3 text-right font-weight-bold">Nama Item <span class="text-danger">*</span></label>
            <div class="col-md-9">
                <input type="text" name="nama_item" class="form-control" placeholder="Masukkan Nama Item yang disepakati..." value="{{ old('nama_item') }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right font-weight-bold">Nama Penginput</label>
            <div class="col-md-9">
                <input type="text" name="nama_pegawai" class="form-control" value="{{ Auth::user()->name }}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right font-weight-bold">Nama Petugas / Lapangan <span class="text-danger">*</span></label>
            <div class="col-md-9">
                <input type="text" name="nama_petugas" class="form-control" placeholder="Masukkan nama petugas..." value="{{ old('nama_petugas') }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right font-weight-bold">Nomor Handphone Petugas <span class="text-danger">*</span></label>
            <div class="col-md-9">
                <input type="text" name="no_petugas" class="form-control" placeholder="Masukkan nomor handphone petugas..." value="{{ old('no_petugas') }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right font-weight-bold">Tanggal Dealing <span class="text-danger">*</span></label>
            <div class="col-md-9">
                @php
                    $today = $currentDate ?? \Carbon\Carbon::now()->format('Y-m-d');
                @endphp
                <input type="date" name="tanggal_dealing" class="form-control" value="{{ $today }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right font-weight-bold">Kabupaten <span class="text-danger">*</span></label>
            <div class="col-md-9">
                <select name="kabupaten_id" id="kabupaten_id" class="form-control select2" required>
                    <option value="" disabled selected>Pilih Kabupaten</option>
                    @foreach($kabupaten as $k)
                        <option value="{{ $k->id_kabupaten }}" {{ old('kabupaten_id') == $k->id_kabupaten ? 'selected' : '' }}>{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right font-weight-bold">Instansi <span class="text-danger">*</span></label>
            <div class="col-md-9">
                <select name="instansi_id" id="instansi_id" class="form-control select2" required>
                    <option value="">-- Pilih Instansi --</option>
                    @foreach($instansi as $i)
                        <option value="{{ $i->id_instansi }}" 
                                data-kabupaten="{{ $i->kabupaten_id }}" 
                                {{ old('instansi_id') == $i->id_instansi ? 'selected' : '' }}
                                style="display: none;">
                            {{ $i->nama }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Pilih kabupaten terlebih dahulu untuk memfilter daftar instansi aktif.</small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right font-weight-bold">Nominal Harga (Rp) <span class="text-danger">*</span></label>
            <div class="col-md-9">
                <input type="number" name="harga" class="form-control" step="0.01" min="0" placeholder="Contoh: 15000000" value="{{ old('harga') }}" required>
                <small class="text-muted">Masukkan angka murni tanpa tanda titik pemisah ribuan.</small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right font-weight-bold">Foto Bukti / Nota Berkas <span class="text-danger">*</span></label>
            <div class="col-md-9">
                <input type="file" name="foto" class="form-control" accept="image/*" required>
                <small class="text-danger">Ekstensi file valid: .jpg, .png, .jpeg (Maks. 8MB)</small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right"></label>
            <div class="col-md-9">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-save"></i> Simpan Data Dealing
                </button>
                <button class="btn btn-default" type="reset">Reset</button>
            </div>
        </div>

        </form>
    </div>
</div>

{{-- Script penapis data Instansi berdasarkan Kabupaten --}}
<script>
document.getElementById('kabupaten_id').addEventListener('change', function() {
    var kabId = this.value;
    var instansiSelect = document.getElementById('instansi_id');
    var options = instansiSelect.options;

    // Reset isi pilihan instansi ke awal
    instansiSelect.value = "";

    // Lakukan pemindaian opsi instansi
    for (var i = 0; i < options.length; i++) {
        var option = options[i];
        
        if (option.value === "") {
            option.style.display = 'block';
            continue;
        }

        // Tampilkan instansi yang memiliki id kabupaten yang cocok
        if (option.getAttribute('data-kabupaten') == kabId) {
            option.style.display = 'block';
            option.disabled = false;
        } else {
            option.style.display = 'none';
            option.disabled = true;
        }
    }
});
</script>