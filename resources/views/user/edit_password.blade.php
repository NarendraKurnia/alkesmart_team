@include('layout.head')
@include('layout.header')

<div class="bg-gray-50 min-h-screen py-12 pt-36">
    <div class="max-w-md mx-auto px-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-700">
                    <i class="fas fa-key mr-2 text-blue-500"></i>Ganti Password
                </h3>
            </div>
            
            <form action="{{ route('userpublic.update_password') }}" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                    <div class="relative">
                        <input type="password" id="current_password" name="current_password" 
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('current_password') border-red-500 @enderror"
                               placeholder="Masukkan password lama">
                        <button type="button" onclick="togglePass('current_password', 'icon1')" class="absolute right-3 top-2.5 text-gray-400">
                            <i id="icon1" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('current_password') 
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
                    @enderror
                </div>

                <hr class="my-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" 
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('password') border-red-500 @enderror"
                               placeholder="Minimal 8 karakter">
                        <button type="button" onclick="togglePass('password', 'icon2')" class="absolute right-3 top-2.5 text-gray-400">
                            <i id="icon2" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                               placeholder="Ulangi password baru">
                        <button type="button" onclick="togglePass('password_confirmation', 'icon3')" class="absolute right-3 top-2.5 text-gray-400">
                            <i id="icon3" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password') 
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
                    @enderror
                </div>

                <div class="pt-4 space-y-3">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition duration-200">
                        Simpan Perubahan
                    </button>
                    <a href="{{ url()->previous() }}" class="block text-center text-sm text-gray-500 hover:text-gray-700">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // 1. Fungsi Toggle Password (hanya satu kali)
    function togglePass(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // 2. Alert Sukses dari Session Laravel
    @if(session('sukses'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('sukses') }}",
            icon: 'success',
            confirmButtonColor: '#2563eb'
        });
    @endif

    // 3. Alert Error jika validasi gagal (Opsional agar lebih user-friendly)
    @if($errors->any())
        Swal.fire({
            title: 'Gagal!',
            text: "Mohon periksa kembali inputan Anda.",
            icon: 'error',
            confirmButtonColor: '#dc2626'
        });
    @endif
</script>

@include('layout.footer')