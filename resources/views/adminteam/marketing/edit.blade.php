<div class="container">
    <h3>Edit Data Pegawai Marketing</h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('marketing.proses_edit', $customer->id) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Password (biarkan kosong jika tidak ingin diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="status">Role</label>
            <select name="role" class="form-control" required>
                <option value="admin" {{ $customer->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="owner" {{ $customer->role == 'owner' ? 'selected' : '' }}>Owner</option>
                <option value="staff" {{ $customer->role == 'staff' ? 'selected' : '' }}>Staff</option>
                <option value="marketing" {{ $customer->role == 'marketing' ? 'selected' : '' }}>Marketing</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $customer->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="verify" {{ $customer->status == 'verify' ? 'selected' : '' }}>Verify</option>
                <option value="banned" {{ $customer->status == 'banned' ? 'selected' : '' }}>Banned</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('marketing') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
