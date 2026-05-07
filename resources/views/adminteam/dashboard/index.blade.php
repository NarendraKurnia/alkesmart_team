<div class="card">
    <div class="card-body">
        
        
        <h2 class="mt-4 mb-4">Statistik Reservasi</h2>

        <div class="row">
            
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-hourglass-half"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Perlu Konfirmasi</span>
                        <span class="info-box-number text-lg">{{ $pendingCount }}</span> 
                        <a href="{{ route('adminvillas.reservasi.pending') }}" class="btn btn-xs btn-warning mt-1">
                            <i class="fa fa-arrow-circle-right"></i> Lihat dan Kelola
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pesanan Berhasil</span>
                        <span class="info-box-number text-lg">{{ $confirmedCount }}</span>
                        <a href="{{ route('adminvillas.reservasi.confirmed') }}" class="btn btn-xs btn-success mt-1">
                            <i class="fa fa-arrow-circle-right"></i> Lihat dan Kelola
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-bed"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sedang Check-in</span>
                        <span class="info-box-number text-lg">{{ $checkinCount }}</span>
                        <a href="{{ route('adminvillas.reservasi.checkin') }}" class="btn btn-xs btn-primary mt-1">
                            <i class="fa fa-arrow-circle-right"></i> Lihat dan Kelola
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-calendar-check"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pesanan Selesai</span>
                        <span class="info-box-number text-lg">{{ $completedCount }}</span>
                        <a href="{{ route('adminvillas.reservasi.completed') }}" class="btn btn-xs btn-secondary mt-1">
                            <i class="fa fa-arrow-circle-right"></i> Lihat dan Kelola
                        </a>
                    </div>
                </div>
            </div>
            </div>
        <div class="alert alert-info mt-4 text-center">
            Total Keseluruhan Reservasi di Database: <strong class="text-xl">{{ $totalReservasi }}</strong>
        </div>

    </div>
    </div>