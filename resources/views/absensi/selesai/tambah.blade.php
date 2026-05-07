<p class="text-right">
    <a href="{{ url('absensi/selesai') }}" class="btn btn-outline-info btn-sm">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</p>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Laporan Selesai Kunjungan</h3>
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

        <form action="{{ url('absensi/selesai/proses-tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
            <label class="col-md-3 text-right">Nama Lengkap</label>
            <div class="col-md-9">
                <input type="text" name="nama" class="form-control" value="{{ Auth::user()->name }}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right">Jam Selesai</label>
            <div class="col-md-9">
                @php
                    $now = $currentTime ?? \Carbon\Carbon::now()->format('H:i');
                @endphp
                <input type="time" name="jam_selesai" class="form-control" value="{{ $now }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right">Tanggal</label>
            <div class="col-md-9">
                @php $today = \Carbon\Carbon::now()->format('d-m-Y'); @endphp
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

        <div class="form-group row">
            <label class="col-md-3 text-right">Uraian Kegiatan</label>
            <div class="col-md-9">
                <textarea name="uraian_kegiatan" class="form-control" rows="4" placeholder="Jelaskan apa saja yang dilakukan selama kunjungan..." required>{{ old('uraian_kegiatan') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right">Catatan Shift Berikutnya</label>
            <div class="col-md-9">
                <textarea name="catatan_berikutnya" class="form-control" rows="3" placeholder="Contoh: Bertemu dengan Bapak/Ibu...">{{ old('catatan_berikutnya') }}</textarea>
                <small class="text-muted">Opsional: Isi jika ada pesan penting untuk petugas selanjutnya.</small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right">Foto Lampiran</label>
            <div class="col-md-9">
                <input type="file" name="foto" class="form-control" accept="image/*" required>
                <small class="text-danger">Format: JPG, PNG, JPEG. Foto bukti kegiatan selesai.</small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right"></label>
            <div class="col-md-9">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-paper-plane"></i> Simpan Laporan Selesai
                </button>
                <button class="btn btn-default" type="reset">Reset</button>
            </div>
        </div>

        </form>
    </div>
</div>

<script>
// Filter Instansi berdasarkan Kabupaten
document.getElementById('kabupaten_id').addEventListener('change', function() {
    var kabId = this.value;
    var instansiSelect = document.getElementById('instansi_id');
    var options = instansiSelect.options;

    instansiSelect.value = "";

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
});
</script>