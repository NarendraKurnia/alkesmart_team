
@section('content')
<div class="max-w-md mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-center mb-4">Verifikasi OTP</h2>

    <!-- Pesan sukses / error -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form OTP -->
    <form action="{{ route('otp.verify.submit') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">

        <div>
            <label for="otp_code" class="block font-semibold">Masukkan OTP</label>
            <input type="text" id="otp_code" name="otp_code" 
                   class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-blue-200"
                   placeholder="6 Digit OTP">
        </div>

        <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded transition">
            Verifikasi
        </button>
    </form>

    <!-- Form Resend -->
    <form action="{{ route('otp.resend') }}" method="POST" class="mt-4 text-center">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <button type="submit" class="text-blue-600 hover:underline">
            Kirim Ulang OTP
        </button>
    </form>
</div>
@endsection