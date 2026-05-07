<p class="text-right">
	<a href="{{ route('instansi.index') }}" class="btn btn-outline-info btn-sm">
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
<form action="{{ asset('adminteam/instansi/proses-tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="csrf_test_name" value="155e3af88478230f860a934020e9214a">

<div class="form-group row">
	<label class="col-md-3 text-right">Nama Instansi</label>
	<div class="col-md-9">
		<input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
	</div>
</div>

<div class="form-group row">
                    <label class="col-md-3 control-label text-right p-0">Kabupaten</label>
                    <div class="col-md-9">
                        @if(isset($kabupaten) && count($kabupaten) > 0)
                            <select name="tipe_id" class="form-control" required>
                                <option value="" disabled selected>-- Pilih Kabupaten --</option>
                                @foreach ($kabupaten as $k) {{-- Gunakan alias $k agar tidak bingung dengan $kabupaten --}}
                                    <option value="{{ $k->id_kabupaten }}">
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <p class="text-danger">Data Kabupaten tidak tersedia.</p>
                        @endif
                    </div>
                </div>


<div class="form-group row">
                    <label class="col-md-3 control-label text-right"></label>
                    <div class="col-md-9">
                        <div class="form-group pull-right btn-group">
							<button class="btn btn-success" type="submit" name="submit" value="submit">
								<i class="fa fa-save"></i>Simpan Data Berita
							</button>
                            <input type="reset" name="reset" class="btn btn-danger " value="Reset">

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>