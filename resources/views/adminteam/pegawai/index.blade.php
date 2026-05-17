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
        <form action="{{ url('adminteam/pegawai') }}" method="get">
        <div class="input-group">
                <a href="{{ url('adminteam/pegawai/tambah') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i> Tambah Baru
                </a>
            </span>
        </div>
    </form>
    </div>
    
    <div class="col-md-6">
    {{ $pegawai->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
    </div>
</div>

<hr>

<div class="table-responsive mailbox-messages mt-1">        
<table class="table table-sm table-hover" id="example2">
    <thead>
        <tr class="text-left bg-light">
            <th width="10%" class="text-center">NO</th>
            <th width="70%">Nama Akses Pegawai</th>
            <th width="20%">Action</th>
        </tr>
    </thead>
    <tbody>
    @php $no = ($pegawai->currentPage() - 1) * $pegawai->perPage() + 1; @endphp
    @foreach($pegawai as $item)
        <tr>
            <td class="text-center">{{ $no }}</td>
            <td>{{ $item->nama }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ asset('adminteam/pegawai/edit/'.$item->id_pegawai) }}" 
                class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="{{ '#exampleModal2' . $item->id_pegawai }}"> 
                        <i class="fa fa-trash"></i>
                    </button>
                </button>

                <!-- Modal 2-->
                <div class="modal fade" id={{"exampleModal2" . $item->id_pegawai}} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Data Yang di Hapus Tidak Dapat Dikembalikan!!!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{ route('pegawai.delete', $item->id_pegawai) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Hapus Data</button>
                        </form>
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