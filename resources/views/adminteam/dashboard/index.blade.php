{{-- CARD UTAMA RINGKASAN STATISTIK --}}
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm border-left border-primary">
            <span class="info-box-icon bg-primary"><i class="fa fa-handshake"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-muted">Total Dealing (Semua)</span>
                <span class="info-box-number h4 font-weight-bold mb-0">{{ $total_transaksi_all }} Kali</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm border-left border-success">
            <span class="info-box-icon bg-success"><i class="fa fa-money-bill-wave"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-muted">Total Nilai Kontrak</span>
                <span class="info-box-number h5 font-weight-bold mb-0">Rp{{ number_format($total_nominal_all, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm border-left border-info">
            <span class="info-box-icon bg-info"><i class="fa fa-calendar-check"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-muted">Dealing Bulan Ini</span>
                <span class="info-box-number h4 font-weight-bold mb-0">{{ $total_transaksi_bulan }} Transaksi</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm border-left border-warning">
            <span class="info-box-icon bg-warning text-white"><i class="fa fa-chart-line"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-muted">Omset Bulan Ini</span>
                <span class="info-box-number h5 font-weight-bold mb-0">Rp{{ number_format($total_nominal_bulan, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    {{-- HIGHLIGHT MARKETING TERBAIK BULAN INI --}}
    <div class="col-md-4">
        <div class="card card-outline card-success shadow-sm text-center py-4">
            <div class="card-body">
                <div class="mb-3 text-warning">
                    <i class="fa fa-trophy fa-4x animated bounce text-warning"></i>
                </div>
                <h5 class="text-muted font-weight-bold text-uppercase mb-1">Top Marketing Bulan Ini</h5>
                <p class="small text-secondary">Periode: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>

                @if($top_marketing)
                    <h3 class="text-success font-weight-bold my-2">
                        <i class="fa fa-user-circle mr-1"></i> {{ $top_marketing['nama'] }}
                    </h3>
                    <div class="bg-light p-3 rounded border mt-3 text-left">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total Goal Dealing:</span>
                            <span class="badge badge-success p-2 font-weight-bold">{{ $top_marketing['jumlah_dealing'] }} Kali Selesai</span>
                        </div>
                        <div class="d-flex justify-content-between mb-0">
                            <span class="text-muted font-weight-normal">Nilai Kontrak:</span>
                            <span class="font-weight-bold text-dark">Rp{{ number_format($top_marketing['total_omset'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning py-2 mt-3 mb-0">
                        <i class="fa fa-exclamation-triangle"></i> Belum ada pencatatan dealing di bulan ini.
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- TABEL RINCIAN PERFORMA SELURUH PEGAWAI MARKETING BULAN INI --}}
    <div class="col-md-8">
        <div class="card card-outline card-primary shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 pt-3">
                <h3 class="card-title font-weight-bold text-dark mt-1">
                    <i class="fa fa-users text-primary mr-2"></i> Rincian Performa Kerja Pegawai (Bulan Ini)
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-valign-middle mb-0">
                        <thead>
                            <tr class="bg-light">
                                <th width="10%" class="text-center">RANK</th>
                                <th width="45%">Nama Akun Marketing</th>
                                <th width="20%" class="text-center">Jumlah Selesai</th>
                                <th width="25%" class="text-right">Total Nilai Kontrak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rank_marketing as $index => $mkt)
                            <tr>
                                <td class="text-center font-weight-bold">
                                    @if(($index + 1) == 1)
                                        <span class="badge badge-warning text-white p-2 px-3"><i class="fa fa-star"></i> 1</span>
                                    @else
                                        <span class="text-muted">#{{ $index + 1 }}</span>
                                    @endif
                                </td>
                                <td class="font-weight-bold text-dark">
                                    <i class="fa fa-user text-muted mr-2"></i> {{ $mkt['nama'] }}
                                </td>
                                <td class="text-center font-weight-bold text-info">
                                    {{ $mkt['jumlah_dealing'] }} Transaksi
                                </td>
                                <td class="text-right font-weight-bold text-success">
                                    Rp{{ number_format($mkt['total_omset'], 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-5">
                                    <i class="fa fa-users-slash fa-2x d-block mb-2 text-secondary"></i>
                                    Tidak ada data aktivitas pegawai marketing yang ditemukan bulan ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>