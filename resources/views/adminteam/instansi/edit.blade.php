<p class="text-right">
	<a href="{{ asset('adminteam/instansi') }}" class="btn btn-outline-info btn-sm">
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
<form action="{{ asset('adminteam/instansi/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_instansi"value="{{ $instansi->id_instansi }}">
                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Nama Instansi</label>
                    <div class="col-md-9">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Instansi" value="{{ $instansi->nama }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Kabupaten</label>
                    <div class="col-md-9">
                        <select name="kabupaten_id" class="form-control select2" required>
                            <option value="">Pilih Kabupaten</option>
                            @foreach($kabupaten as $k)
                                <option value="{{ $k->id_kabupaten }}" 
                                    {{ (old('kabupaten_id', $instansi->kabupaten_id) == $k->id_kabupaten) ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-secondary">Kabupaten</small>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-3 control-label text-right"></label>
                    <div class="col-md-9">
                        <div class="form-group pull-right btn-group">
							<button class="btn btn-success" type="submit" name="submit" value="submit">
								<i class="fa fa-save"></i>Simpan Data Kamar
							</button>
                            <input type="reset" name="reset" class="btn btn-danger " value="Reset">

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                </form>