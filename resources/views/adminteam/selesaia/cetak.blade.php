<!DOCTYPE html>
<html>
<head>
    <title>Cetak Shift</title>
<!-- Icon web -->
  <link rel="icon" href="{{asset('admin/dist/img/Logo_PLN.png') }}">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .title { text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        td { border: 1px solid #000; padding: 8px; vertical-align: top; }
        .label { font-weight: bold; width: 30%; background-color: #f5f5f5; }
        .foto-img {
            max-height: 200px;
            max-width: 100%;
            height: auto;
            display: block;
        }
    </style>
</head>
<body>

    <div class="title">Detail Shift</div>

    <table>
        <tr>
            <td class="label">Nama Security 1:</td>
            <td>{{ $shift->nama_security_1 }}</td>
        </tr>
        <tr>
            <td class="label">Jam Selesai:</td>
            <td>{{ $shift->jam_selesai_1 }}</td>
        </tr>
        <tr>
            <td class="label">Nama Security 2:</td>
            <td>{{ $shift->nama_security_2 }}</td>
        </tr>
        <tr>
            <td class="label">Jam Selesai:</td>
            <td>{{ $shift->jam_selesai_2 }}</td>
        </tr>
        <tr>
            <td class="label">Nama Security 3:</td>
            <td>{{ $shift->nama_security_3 }}</td>
        </tr>
        <tr>
            <td class="label">Jam Selesai:</td>
            <td>{{ $shift->jam_selesai_3 }}</td>
        </tr>
        <tr>
            <td class="label">Lampu</td>
            <td>{!! $shift->lampu !!}</td>
        </tr>
        <tr>
            <td class="label">Membuka Kunci</td>
            <td>{!! $shift->membuka_kunci !!}</td>
        </tr>
        <tr>
            <td class="label">Mengunci Pintu</td>
            <td>{!! $shift->mengunci_pintu !!}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Shift</td>
            <td>{{ \Carbon\Carbon::parse($shift->tanggal_shift)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td class="label">Waktu Shift</td>
            <td>{{ $shift->shift }}</td>
        </tr>
        <tr>
            <td class="label">Uraian Kegiatan</td>
            <td>{!! $shift->uraian_kegiatan !!}</td>
        </tr>
        <tr>
            <td class="label">Catatan Shift Selanjutnya</td>
            <td>{!! $shift->catatan_shift_selanjutnya !!}</td>
        </tr>
        <tr>
            <td class="label">Foto</td>
            <td>
                @if(!empty($shift->foto))
                    <img src="{{ asset('admin/upload/shift-selesai/' . $shift->foto) }}" alt="Foto Shift" class="foto-img">
                @else
                    <em>Tidak ada foto.</em>
                @endif
            </td>
        </tr>
    </table>
<script type="text/javascript">
    window.print();
</script>
</body>
</html>
