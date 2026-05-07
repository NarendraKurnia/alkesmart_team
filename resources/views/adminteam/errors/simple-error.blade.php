<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'Error' }}</title>
    <style>
        body { font-family: Arial; padding: 50px; text-align: center; }
        .error-box { background: #fff3f3; border: 2px solid #ff4444; padding: 30px; margin: 0 auto; max-width: 600px; }
        h1 { color: #ff4444; }
    </style>
</head>
<body>
    <div class="error-box">
        <h1>⚠️ Terjadi Kesalahan</h1>
        <p>{{ $message ?? 'Mohon maaf, terjadi kesalahan pada sistem.' }}</p>
        <p>
            <a href="{{ url()->previous() }}" class="btn">Kembali</a> | 
            <a href="{{ url('/') }}" class="btn">Home</a>
        </p>
    </div>
</body>
</html>