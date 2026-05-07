<p class="text-right">
	<a href="{{ asset('adminteam/user') }}" class="btn btn-outline-info btn-sm">
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
<form action="{{ asset('adminteam/user/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_user"	value="{{ $user->id_user }}">
                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Nama lengkap</label>
                    <div class="col-md-9">
                        <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" value="{{ $user->nama }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Email</label>
                    <div class="col-md-9">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}" required>
                    </div>
                </div>              

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Username</label>
                    <div class="col-md-9">
                        <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $user->username }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Password</label>
                    <div class="col-md-9">
                        <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" >
						<small class="text-danger">Biarkan kosong jika tidak ingin mengganti password. Password minimal 6 dan maksimal 32 karakter</small>
                    </div>
                </div>

                <div class="form-group row">
    <label class="col-md-3 control-label text-right">Pegawai</label>
    <div class="col-md-6">
        {{-- Gunakan $semua_pegawai, karena ini adalah list/array yang bisa di-count --}}
        @if(isset($semua_pegawai) && count($semua_pegawai) > 0)
        <select name="pegawai_id" class="form-control">
            <option value="" disabled>Pilih Pegawai</option>
            @foreach ($semua_pegawai as $p)
                <option value="{{ $p->id_pegawai }}" 
                    {{ (old('pegawai_id', $user->pegawai_id) == $p->id_pegawai) ? 'selected' : '' }}>
                    {{ $p->nama }}
                </option>
            @endforeach
        </select>
        @else
        <p class="text-danger">Data Pegawai tidak tersedia.</p>
        @endif
        <small class="text-secondary">Kategori</small>
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