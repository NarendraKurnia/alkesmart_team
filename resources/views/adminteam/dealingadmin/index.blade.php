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
        <form action="{{ url('adminteam/dealingadmin') }}" method="get">
            <div class="input-group">
                <input type="text" name="keywords" class="form-control" placeholder="Cari nama, pegawai, atau petugas..." value="{{ request('keywords') }}">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat">
                        <i class="fa fa-search"></i> Cari
                    </button>
                    <a href="{{ url('adminteam/dealingadmin/tambah') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Tambah Baru
                    </a>
                </span>
            </div>
        </form>
    </div>
    
    <div class="col-md-6">
        {{ $data_dealing->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
    </div>
</div>

<hr>

<div class="table-responsive mailbox-messages mt-1">        
    <table class="table table-sm table-hover" id="example2">
        <thead>
            <tr class="text-left bg-light">
                <th width="5%" class="text-center">NO</th>
                <th width="20%">Nama Item</th>
                <th width="15%">Nama Pegawai</th>
                <th width="15%">Nama Petugas</th>
                <th width="15%">Tanggal Dealing</th>
                <th width="15%">Nominal Harga</th>
                <th width="15%">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $no = ($data_dealing->currentPage() - 1) * $data_dealing->perPage() + 1; @endphp
            @foreach($data_dealing as $item)
            <tr>
                <td class="text-center">{{ $no }}</td>
                <td>{{ $item->nama_item }}</td>
                <td>{{ $item->nama_pegawai }}</td>
                <td>{{ $item->nama_petugas }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($item->tanggal_dealing)->format('d-m-Y') }}
                </td>
                <td class="font-weight-bold text-success">
                    Rp{{ number_format($item->harga, 2, ',', '.') }}
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="{{ "#detailModal" . $item->id_dealing }}">
                            <i class="fa fa-eye"></i>
                        </button>

                        @php $unit_id = session('unit_id'); @endphp
                        @if ($unit_id != 1)
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="{{ "#hapusModal" . $item->id_dealing }}"> 
                            <i class="fa fa-trash"></i>
                        </button>
                        @endif

                        <a href="{{ route('dealing.cetak', $item->id_dealing) }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fa fa-print"></i>
                        </a>
                    </div>

                    <div class="modal fade" id="{{ 'detailModal' . $item->id_dealing }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Data Dealing: {{ $item->nama_pegawai }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Nama Item</label>
                                            <p class="font-weight-bold text-uppercase">{{ $item->nama_item}}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Nama Pegawai</label>
                                            <p class="font-weight-bold text-uppercase text-secondary">{{ $item->nama_pegawai }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Nama Petugas</label>
                                            <p class="font-weight-bold text-uppercase text-secondary">{{ $item->nama_petugas }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Tanggal Dealing</label>
                                            <p class="text-dark font-weight-bold">{{ \Carbon\Carbon::parse($item->tanggal_dealing)->format('d F Y') }}</p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Kabupaten Target</label>
                                            <p class="text-primary font-weight-bold">{{ $item->nama_kabupaten ?? 'Data tidak ditemukan' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Instansi Terkait</label>
                                            <p class="text-primary font-weight-bold">{{ $item->nama_instansi ?? 'Data tidak ditemukan' }}</p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Nominal Kesepakatan (Harga)</label>
                                            <h4 class="text-success font-weight-bold">Rp{{ number_format($item->harga, 2, ',', '.') }}</h4>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1">Terakhir Diperbarui</label>
                                            <p class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal_update)->format('d-m-Y H:i') }}</p>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="text-muted mb-1">Foto Berkas / Kegiatan</label><br>
                                            @if(!empty($item->foto))
                                                <img src="{{ asset('admin/upload/dealing/' . $item->foto) }}" class="img-fluid rounded border shadow-sm" style="max-height: 300px;">
                                            @else
                                                <div class="alert alert-secondary py-2">Tidak ada berkas foto yang diunggah.</div>
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

                    <div class="modal fade" id="{{ "hapusModal" . $item->id_dealing }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus data kesepakatan dealing atas nama <strong>{{ $item->nama_pegawai }}</strong>?
                                    <br><small class="text-danger">*Data beserta arsip foto yang dihapus tidak dapat dikembalikan.</small>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <form action="{{ route('dealing.delete', $item->id_dealing) }}" method="POST">
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