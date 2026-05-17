@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <form action="{{ url('absensi/masuk') }}" method="get">
            <div class="input-group">
                    <a href="{{ url('absensi/masuk/tambah') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Tambah Baru
                    </a>
                </span>
            </div>
        </form>
    </div>
    
    <div class="col-md-6">
        {{ $shift_masuk->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
    </div>
</div>

<hr>

<div class="table-responsive mailbox-messages mt-1">        
    <table class="table table-sm table-hover" id="example2">
        <thead>
            <tr class="text-left bg-light">
                <th width="5%" class="text-center">NO</th>
                <th width="20%">Nama</th>
                <th width="20%">Tanggal Kegiatan</th>
                <th width="15%">Waktu Mulai</th>
                <th width="20%">Update</th>
                <th width="20%">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $no = ($shift_masuk->currentPage() - 1) * $shift_masuk->perPage() + 1; @endphp
            @foreach($shift_masuk as $item)
            <tr>
                <td class="text-center">{{ $no }}</td>
                <td>{{ $item->nama }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->format('d-m-Y') }}
                </td>
                <td>{{ $item->jam_kehadiran }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($item->tanggal_update)->format('d-m-Y H:i') }}
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="{{ "#detailModal" . $item->id_masuk }}">
                            <i class="fa fa-eye"></i>
                        </button>

                        @php $unit_id = session('unit_id'); @endphp
                        @if ($unit_id != 1)
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="{{ "#hapusModal" . $item->id_masuk }}"> 
                            <i class="fa fa-trash"></i>
                        </button>
                        @endif

                        <a href="{{ route('masuk.cetak', $item->id_masuk) }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fa fa-print"></i>
                        </a>
                    </div>

                    <div class="modal fade" id="{{ 'detailModal' . $item->id_masuk }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Kunjungan: {{ $item->nama }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Nama Lengkap</label>
                                            <p class="font-weight-bold text-uppercase">{{ $item->nama }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Jenis Kegiatan</label>
                                            <p><span class="badge badge-info">{{ strtoupper($item->kegiatan) }}</span></p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Jam Kehadiran</label>
                                            <p>{{ $item->jam_kehadiran }} WIB</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Tanggal Kunjungan</label>
                                            <p>{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->format('d F Y') }}</p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Kabupaten</label>
                                            <p class="text-primary">{{ $item->nama_kabupaten ?? 'Data tidak ditemukan' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Instansi</label>
                                            <p class="text-primary">{{ $item->nama_instansi ?? 'Data tidak ditemukan' }}</p>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="text-muted mb-1">Foto Kegiatan</label><br>
                                            @if(!empty($item->foto))
                                                <img src="{{ asset('admin/upload/absensi/' . $item->foto) }}" class="img-fluid rounded border shadow-sm" style="max-height: 250px;">
                                            @else
                                                <div class="alert alert-secondary py-2">Tidak ada foto.</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="{{ "hapusModal" . $item->id_masuk }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus data kunjungan <strong>{{ $item->nama }}</strong>?
                                    <br><small class="text-danger">*Data yang dihapus tidak dapat dikembalikan.</small>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <form action="{{ route('masuk.delete', $item->id_masuk) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus Permanen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
            @php $no++; @endphp
            @endforeach
        </tbody>
    </table>
</div>