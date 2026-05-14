@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row mb-3">
    <div class="col-md-12">
        <a href="{{ url('adminteam/marketing/tambah') }}" class="btn btn-success">
            <i class="fa fa-plus"></i> Tambah Data Pegawai Marketing
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-sm">
        <thead class="bg-info text-white">
            <tr>
                <th class="text-center">NO</th>
                <th>Foto Profil</th>
                <th>NAMA</th>
                <th>EMAIL</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($customers as $customer)
            <tr>
                <td class="text-center">{{ $no }}</td>
                <td class="text-center">
                    @if($customer->gambar)
                        <img src="{{ asset('umum/images/' . $customer->gambar) }}" 
                            class="img img-fluid img-thumbnail" 
                            alt="Gambar {{ $customer->name }}" 
                            style="max-width: 100px;">
                    @else
                        <span class="badge badge-warning">Tidak ada</span>
                    @endif
                </td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->status }}</td>
                <td>
                    <a href="{{ url('adminteam/marketing/edit/'.$customer->id) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>

                    <!-- Modal Hapus -->
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal{{ $customer->id }}">
                        <i class="fa fa-trash"></i>
                    </button>
                    <div class="modal fade" id="hapusModal{{ $customer->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    Data yang dihapus tidak dapat dikembalikan!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <form action="{{ url('adminteam/marketing/delete/'.$customer->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus</button>
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
    {{ $customers->links() }}
</div>
