<p class="text-right">
    <a href="{{ asset('adminteam/dealingadmin') }}" class="btn btn-outline-info btn-sm">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</p>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('adminteam/dealing/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_dealing" value="{{ $detail->id_dealing }}">

{{-- 1. PILIH MARKETING (PEGAWAI) --}}
<div class="form-group row">
    <label class="col-md-3 control-label text-right">Nama Marketing (Pegawai)</label>
    <div class="col-md-9">
        <select name="nama_pegawai" class="form-control" required>
            <option value="">-- Pilih Marketing PJ --</option>
            @foreach($pegawai_list as $p)
                <option value="{{ $p->nama }}" {{ (old('nama_pegawai', $detail->nama_pegawai) == $p->nama) ? 'selected' : '' }}>
                    {{ $p->nama }}
                </option>
            @endforeach
        </select>
    </div>
</div>

{{-- 2. NAMA ITEM KESEPAKATAN --}}
<div class="form-group row">
    <label class="col-md-3 control-label text-right">Nama Item Kesepakatan</label>
    <div class="col-md-9">
        <input type="text" name="nama_item" class="form-control" placeholder="Nama Item Kesepakatan" value="{{ old('nama_item', $detail->nama_item) }}" required>
    </div>
</div>

{{-- 3. NAMA PETUGAS LAPANGAN + FITUR AMBIL KONTAK --}}
<div class="form-group row">
    <label class="col-md-3 control-label text-right">Nama Petugas Lapangan</label>
    <div class="col-md-9">
        <div class="input-group">
            <input type="text" name="nama_petugas" id="nama_petugas" class="form-control" placeholder="Nama Petugas" value="{{ old('nama_petugas', $detail->nama_petugas) }}" required>
            <div class="input-group-append">
                <button type="button" id="btnAmbilKontak" class="btn btn-info">
                    <i class="fa fa-address-book"></i> Kontak HP
                </button>
            </div>
        </div>
        <small class="text-muted d-block mt-1" id="contactSupportedText"></small>
    </div>
</div>

{{-- 4. TANGGAL DEALING --}}
<div class="form-group row">
    <label class="col-md-3 control-label text-right">Tanggal Dealing</label>
    <div class="col-md-9">
        <input type="date" name="tanggal_dealing" class="form-control" value="{{ old('tanggal_dealing', $detail->tanggal_dealing) }}" required>
    </div>
</div>

{{-- 5. KABUPATEN TARGET --}}
<div class="form-group row">
    <label class="col-md-3 control-label text-right">Kabupaten Target</label>
    <div class="col-md-9">
        <select name="kabupaten_id" class="form-control" required>
            <option value="">-- Pilih Kabupaten --</option>
            @foreach($kabupaten as $kab)
                <option value="{{ $kab->id_kabupaten }}" {{ (old('kabupaten_id', $detail->kabupaten_id) == $kab->id_kabupaten) ? 'selected' : '' }}>
                    {{ $kab->nama }}
                </option>
            @endforeach
        </select>
    </div>
</div>

{{-- 6. INSTANSI TERKAIT --}}
<div class="form-group row">
    <label class="col-md-3 control-label text-right">Instansi Terkait</label>
    <div class="col-md-9">
        <select name="instansi_id" class="form-control" required>
            <option value="">-- Pilih Instansi --</option>
            @foreach($instansi as $ins)
                <option value="{{ $ins->id_instansi }}" {{ (old('instansi_id', $detail->instansi_id) == $ins->id_instansi) ? 'selected' : '' }}>
                    {{ $ins->nama }}
                </option>
            @endforeach
        </select>
    </div>
</div>

{{-- 7. NOMINAL HARGA --}}
<div class="form-group row">
    <label class="col-md-3 control-label text-right">Nominal Harga Kontrak (Rp)</label>
    <div class="col-md-9">
        <input type="number" name="harga" class="form-control" placeholder="Nominal Harga" value="{{ old('harga', $detail->harga) }}" min="0" required>
    </div>
</div>

{{-- 8. GANTI FOTO / PREVIEW --}}
<div class="form-group row">
    <label class="col-md-3 control-label text-right">Bukti Foto / Berkas</label>
    <div class="col-md-9">
        <input type="file" name="foto" class="form-control-file">
        <small class="text-danger d-block mt-1">*Kosongkan jika tidak ingin mengganti foto saat ini.</small>
        
        @if(!empty($detail->foto))
            <div class="mt-2 p-2 border rounded bg-light d-inline-block">
                <p class="small text-muted mb-1 font-weight-bold">Berkas Foto Saat Ini:</p>
                <img src="{{ asset('admin/upload/dealing/' . $detail->foto) }}" class="img-fluid rounded shadow-sm" style="max-height: 150px; object-fit: contain;">
            </div>
        @endif
    </div>
</div>

{{-- TOMBOL SUBMIT & RESET --}}
<div class="form-group row">
    <label class="col-md-3 control-label text-right"></label>
    <div class="col-md-9">
        <div class="form-group pull-right btn-group">
            <button class="btn btn-success" type="submit" name="submit" value="submit">
                <i class="fa fa-save"></i> Simpan Data Dealing
            </button>
            <input type="reset" name="reset" class="btn btn-danger" value="Reset">
        </div>
    </div>
    <div class="clearfix"></div>
</div>
</form>

{{-- SCRIPT JAVASCRIPT KONTAK HP --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnAmbilKontak = document.getElementById('btnAmbilKontak');
        const inputPetugas = document.getElementById('nama_petugas');
        const infoTeks = document.getElementById('contactSupportedText');

        if (!('contacts' in navigator && 'select' in navigator.contacts)) {
            btnAmbilKontak.style.display = 'none';
            return;
        }

        btnAmbilKontak.addEventListener('click', async () => {
            const props = ['name', 'tel'];
            const opts = { multiple: false };

            try {
                const contacts = await navigator.contacts.select(props, opts);
                if (contacts.length > 0) {
                    const dataKontak = contacts[0];
                    if (dataKontak.name && dataKontak.name.length > 0) {
                        inputPetugas.value = dataKontak.name[0];
                    } else if (dataKontak.tel && dataKontak.tel.length > 0) {
                        inputPetugas.value = dataKontak.tel[0];
                    }
                }
            } catch (err) {
                console.log('Batal memilih kontak: ', err);
            }
        });
    });
</script>