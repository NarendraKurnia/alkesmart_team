<p class="text-right">
	<a href="{{ asset('adminteam/kabupaten') }}" class="btn btn-outline-info btn-sm">
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
<form action="{{ asset('adminteam/kabupaten/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_kabupaten"value="{{ $kabupaten->id_kabupaten }}">
                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Nama Kabupaten</label>
                    <div class="col-md-9">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Kabupaten" value="{{ $kabupaten->nama }}" required>
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