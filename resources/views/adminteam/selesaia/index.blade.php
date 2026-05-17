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
        <form action="{{ url('adminteam/selesaia') }}" method="get">
            <div class="input-group">
                <input type="text" name="keywords" class="form-control" placeholder="Cari nama atau kegiatan..." value="{{ request('keywords') }}">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat">
                        <i class="fa fa-search"></i> Cari
                    </button>
                    <a href="{{ url('adminteam/selesaia/tambah') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Tambah Baru
                    </a>
                </span>
            </div>
        </form>
    </div>
    
    <div class="col-md-6 text-right">
        {{ $shift_selesai->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
    </div>
</div>

<hr>

<div class="table-responsive mailbox-messages mt-1">        
    <table class="table table-sm table-hover" id="example2">
        <thead>
            <tr class="text-left bg-light">
                <th width="5%" class="text-center">NO</th>
                <th width="20%">Nama</th>
                <th width="20%">Tanggal</th>
                <th width="15%">Jam Selesai</th>
                <th width="20%">Update</th>
                <th width="20%">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $no = ($shift_selesai->currentPage() - 1) * $shift_selesai->perPage() + 1; @endphp
            @foreach($shift_selesai as $item)
            <tr>
                <td class="text-center">{{ $no }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_shift)->format('d-m-Y') }}</td>
                <td>{{ $item->jam_selesai }} WIB</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_update)->format('d-m-Y H:i') }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ asset('adminteam/selesaia/edit/'.$item->id_selesai) }}" 
                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="{{ "#detailModal" . $item->id_selesai }}">
                            <i class="fa fa-eye"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="{{ "#hapusModal" . $item->id_selesai }}"> 
                            <i class="fa fa-trash"></i>
                        </button>

                        <a href="{{ route('selesai.cetak', $item->id_selesai) }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fa fa-print"></i>
                        </a>
                    </div>

                    <div class="modal fade" id="{{ 'detailModal' . $item->id_selesai }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Laporan Selesai: {{ $item->nama }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1 small d-block">Nama Lengkap</label>
                                            <p class="font-weight-bold">{{ $item->nama }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted mb-1 small d-block">Jenis Kegiatan</label>
                                            <p><span class="badge badge-info">{{ strtoupper($item->kegiatan) }}</span></p>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="text-muted mb-1 small d-block">Jam Selesai</label>
                                            <p>{{ $item->jam_selesai }} WIB</p>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="text-muted mb-1 small d-block">Kabupaten</label>
                                            <p>{{ $item->nama_kabupaten ?? $item->kabupaten_id }}</p>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="text-muted mb-1 small d-block">Instansi</label>
                                            <p>{{ $item->nama_instansi ?? $item->instansi_id }}</p>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="text-muted mb-1 small d-block">Uraian Kegiatan</label>
                                            <div class="border p-3 rounded bg-light" style="min-height: 80px;">
                                                {!! $item->uraian_kegiatan ?? '<em>Tidak ada uraian</em>' !!}
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="text-muted mb-1 small d-block">Catatan Shift Selanjutnya</label>
                                            <div class="border p-3 rounded bg-light" style="min-height: 80px;">
                                                {!! $item->catatan_shift_selanjutnya ?? '<em>Tidak ada catatan</em>' !!}
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="text-muted mb-1 small d-block">Foto Lampiran</label>
                                            @if(!empty($item->foto))
                                                <img src="{{ asset('admin/upload/selesai/' . $item->foto) }}" class="img-fluid rounded border shadow-sm" style="max-height: 300px;">
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

                    <div class="modal fade" id="{{ "hapusModal" . $item->id_selesai }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body text-center">
                                    <p>Apakah Anda yakin ingin menghapus data laporan milik <strong>{{ $item->nama }}</strong>?</p>
                                    <small class="text-danger">*Data yang dihapus tidak dapat dikembalikan.</small>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <form action="{{ route('selesai.delete', $item->id_selesai) }}" method="POST">
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