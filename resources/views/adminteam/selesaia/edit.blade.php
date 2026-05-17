<p class="text-right">
    <a href="{{ url('adminteam/selesaia') }}" class="btn btn-outline-info btn-sm">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</p>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Edit Laporan Selesai Kunjungan</h3>
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

        <form action="{{ url('adminteam/selesaia/proses-edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <input type="hidden" name="id_selesai" value="{{ $detail->id_selesai }}">

        {{-- 1. NAMA LENGKAP PEGAWAI --}}
        <div class="form-group row">
            <label class="col-md-3 text-right">Nama Lengkap</label>
            <div class="col-md-9">
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $detail->nama) }}" required>
            </div>
        </div>

        {{-- 2. JAM SELESAI --}}
       <div class="form-group row">
            <label class="col-md-3 text-right">Jam Selesai</label>
            <div class="col-md-9">
                {{-- Diaktifkan kembali dengan mengambil format H:i dari database --}}
                <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai', \Carbon\Carbon::parse($detail->jam_selesai)->format('H:i')) }}" required>
            </div>
        </div>

        {{-- 3. TANGGAL --}}
        <div class="form-group row">
            <label class="col-md-3 text-right">Tanggal</label>
            <div class="col-md-9">
                {{-- Diubah menjadi type="date", diberikan name="tanggal_shift", dan atribut disabled dibuang --}}
                <input type="date" name="tanggal_shift" class="form-control" value="{{ old('tanggal_shift', \Carbon\Carbon::parse($detail->tanggal_shift)->format('Y-m-d')) }}" required>
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

        {{-- 6. INSTANSI (DENGAN FILTER JAVASCRIPT) --}}
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
                <small class="text-muted">Pilih kembali kabupaten jika ingin mengubah/memfilter daftar instansi baru.</small>
            </div>
        </div>

        {{-- 7. URAIAN KEGIATAN --}}
        <div class="form-group row">
            <label class="col-md-3 text-right">Uraian Kegiatan</label>
            <div class="col-md-9">
                <textarea name="uraian_kegiatan" class="form-control" rows="4" placeholder="Jelaskan apa saja yang dilakukan selama kunjungan..." required>{{ old('uraian_kegiatan', $detail->uraian_kegiatan) }}</textarea>
            </div>
        </div>

        {{-- 8. CATATAN SHIFT BERIKUTNYA --}}
        <div class="form-group row">
            <label class="col-md-3 text-right">Catatan Shift Berikutnya</label>
            <div class="col-md-9">
                <textarea name="catatan_berikutnya" class="form-control" rows="3" placeholder="Contoh: Bertemu dengan Bapak/Ibu...">{{ old('catatan_berikutnya', $detail->catatan_shift_selanjutnya) }}</textarea>
            </div>
        </div>

        {{-- 9. FOTO LAMPIRAN (OPSIONAL SAAT EDIT) --}}
        <div class="form-group row">
            <label class="col-md-3 text-right">Foto Lampiran</label>
            <div class="col-md-9">
                <input type="file" name="foto" class="form-control" accept="image/*">
                <small class="text-danger d-block mt-1">*Kosongkan jika tidak ingin mengubah berkas foto lampiran saat ini.</small>
                
                @if(!empty($detail->foto))
                    <div class="mt-3 p-2 border rounded bg-light d-inline-block">
                        <p class="small text-muted mb-1 font-weight-bold"><i class="fa fa-image"></i> Foto Lampiran Saat Ini:</p>
                        <img src="{{ asset('admin/upload/selesai/' . $detail->foto) }}" class="img-fluid rounded shadow-sm" style="max-height: 180px; object-fit: contain;">
                    </div>
                @endif
            </div>
        </div>

        {{-- TOMBOL SUBMIT --}}
        <div class="form-group row">
            <label class="col-md-3 text-right"></label>
            <div class="col-md-9">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-save"></i> Perbarui Laporan Selesai
                </button>
                <button class="btn btn-default" type="reset">Reset</button>
            </div>
        </div>

        </form>
    </div>
</div>

<script>
// Menjalankan filter saat pertama kali halaman edit dibuka (agar instansi kabupaten lain tersembunyi)
document.addEventListener("DOMContentLoaded", function() {
    filterInstansi(document.getElementById('kabupaten_id').value, false);
});

// Jalankan filter saat Admin mengganti pilihan Kabupaten target
document.getElementById('kabupaten_id').addEventListener('change', function() {
    filterInstansi(this.value, true);
});

function filterInstansi(kabId, resetValue) {
    var instansiSelect = document.getElementById('instansi_id');
    var options = instansiSelect.options;

    if(resetValue) {
        instansiSelect.value = "";
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
</script>