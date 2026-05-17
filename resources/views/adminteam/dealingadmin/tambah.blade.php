<p class="text-right">
	<a href="{{ asset('adminteam/dealing') }}" class="btn btn-outline-info btn-sm">
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

<form action="{{ asset('adminteam/dealing/proses_tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}

{{-- 1. PILIH MARKETING (PEGAWAI) --}}
<div class="form-group row">
	<label class="col-md-3">Nama Pegawai</label>
	<div class="col-md-9">
		<input type="text" name="nama_pegawai" class="form-control" value="{{ old('nama_pegawai') }}" placeholder="Masukkan nama pegawai" required>
	</div>
</div>

{{-- 2. NAMA ITEM / PERIHAL KESEPAKATAN --}}
<div class="form-group row">
	<label class="col-md-3">Nama Item Kesepakatan</label>
	<div class="col-md-9">
		<input type="text" name="nama_item" class="form-control" value="{{ old('nama_item') }}" placeholder="Masukkan nama item" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-md-3">Nama Petugas Lapangan</label>
	<div class="col-md-9">
		<input type="text" name="nama_petugas" class="form-control" value="{{ old('nama_petugas') }}" placeholder="Nama petugas di lapangan" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Nomor Petugas Lapangan</label>
	<div class="col-md-9">
		<input type="text" name="no_petugas" class="form-control" value="{{ old('no_petugas') }}" placeholder="Nomor Handphone petugas di lapangan" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Tanggal Dealing</label>
	<div class="col-md-9">
		<input type="date" name="tanggal_dealing" class="form-control" value="{{ old('tanggal_dealing', $currentDate) }}" required>
	</div>
</div>

{{-- 5. KABUPATEN TARGET --}}
<div class="form-group row">
	<label class="col-md-3">Kabupaten Target</label>
	<div class="col-md-9">
		<select name="kabupaten_id" class="form-control" required>
			<option value="">-- Pilih Kabupaten --</option>
			@foreach($kabupaten as $kab)
				<option value="{{ $kab->id_kabupaten }}" {{ old('kabupaten_id') == $kab->id_kabupaten ? 'selected' : '' }}>
					{{ $kab->nama }}
				</option>
			@endforeach
		</select>
	</div>
</div>

{{-- 6. INSTANSI TERKAIT --}}
<div class="form-group row">
	<label class="col-md-3">Instansi Terkait</label>
	<div class="col-md-9">
		<select name="instansi_id" class="form-control" required>
			<option value="">-- Pilih Instansi --</option>
			@foreach($instansi as $ins)
				<option value="{{ $ins->id_instansi }}" {{ old('instansi_id') == $ins->id_instansi ? 'selected' : '' }}>
					{{ $ins->nama }}
				</option>
			@endforeach
		</select>
	</div>
</div>

{{-- 7. NOMINAL HARGA / KONTRAK --}}
<div class="form-group row">
	<label class="col-md-3">Nominal Harga Kontrak (Rp)</label>
	<div class="col-md-9">
		<input type="number" name="harga" class="form-control" value="{{ old('harga') }}" placeholder="Contoh: 15000000" min="0" required>
	</div>
</div>

{{-- 8. UPLOAD BUKTI FOTO --}}
<div class="form-group row">
	<label class="col-md-3">Upload Bukti Foto Kegiatan</label>
	<div class="col-md-9">
		<input type="file" name="foto" class="form-control-file" required>
		<small class="text-muted">Format berkas wajib: JPG, JPEG, PNG. Maksimal: 8MB</small>
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