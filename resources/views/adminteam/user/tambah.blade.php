<p class="text-right">
	<a href="{{ asset('admiteam/user') }}" class="btn btn-outline-info btn-sm">
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
<form action="{{ asset('adminteam/user/proses-tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Nama lengkap</label>
                    <div class="col-md-9">
                        <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" value="{{ old('nama') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Email</label>
                    <div class="col-md-9">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                </div>              

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Username</label>
                    <div class="col-md-9">
                        <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Password</label>
                    <div class="col-md-9">
                        <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Konfirmasi Password</label>
                    <div class="col-md-9">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi Password" required>
                    </div>
                </div>
                
                <div class="form-group row">
    <label class="col-md-3 control-label text-right">Pegawai</label>
    <div class="col-md-9">
        {{-- Gunakan variabel $list_pegawai yang baru --}}
        @if(isset($list_pegawai) && count($list_pegawai) > 0)
            <select name="pegawai_id" class="form-control" required>
                <option value="" disabled selected>-- Pilih Pegawai --</option>
                @foreach ($list_pegawai as $p)
                    <option value="{{ $p->id_pegawai }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        @else
            <p class="text-danger">Data pegawai tidak tersedia.</p>
        @endif
    </div>
</div>
            </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right"></label>
                    <div class="col-md-9">
                        <div class="form-group pull-right btn-group">
							<button class="btn btn-success" type="submit" name="submit" value="submit">
								<i class="fa fa-save"></i>Simpan Data User
							</button>
                            <input type="reset" name="reset" class="btn btn-danger " value="Reset">

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                </form>