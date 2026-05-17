<?php

namespace App\Http\Controllers\Adminteam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dealing_Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $m_dealing = new Dealing_Model();
        // Mengambil semua data transaksi marketing lewat model
        $all_dealing = collect($m_dealing->listing());
        
        $bulan_ini = Carbon::now()->month;
        $tahun_ini = Carbon::now()->year;

        // 1. Filter data khusus bulan ini saja
        $dealing_bulan_ini = $all_dealing->filter(function($item) use ($bulan_ini, $tahun_ini) {
            $date = Carbon::parse($item->tanggal_dealing);
            return $date->month == $bulan_ini && $date->year == $tahun_ini;
        });

        // 2. Hitung Rincian Total Ringkasan
        $total_transaksi_all   = $all_dealing->count();
        $total_nominal_all     = $all_dealing->sum('harga');
        $total_transaksi_bulan = $dealing_bulan_ini->count();
        $total_nominal_bulan   = $dealing_bulan_ini->sum('harga');

        // 3. Cari Pegawai Teraktif (Paling Banyak Dealing Bulan Ini)
        $top_marketing = $dealing_bulan_ini->groupBy('nama_pegawai')
            ->map(function ($group) {
                return [
                    'nama' => $group->first()->nama_pegawai,
                    'jumlah_dealing' => $group->count(),
                    'total_omset' => $group->sum('harga')
                ];
            })
            ->sortByDesc('jumlah_dealing')
            ->first(); // Mengambil ranking 1

        // 4. List Rangking Seluruh Marketing Bulan Ini (Untuk Tabel Rincian)
        $rank_marketing = $dealing_bulan_ini->groupBy('nama_pegawai')
            ->map(function ($group) {
                return [
                    'nama' => $group->first()->nama_pegawai,
                    'jumlah_dealing' => $group->count(),
                    'total_omset' => $group->sum('harga')
                ];
            })
            ->sortByDesc('jumlah_dealing')
            ->values()
            ->all();

        $data = [
            'title'                 => 'Dashboard Analisis Marketing',
            'total_transaksi_all'   => $total_transaksi_all,
            'total_nominal_all'     => $total_nominal_all,
            'total_transaksi_bulan' => $total_transaksi_bulan,
            'total_nominal_bulan'   => $total_nominal_bulan,
            'top_marketing'         => $top_marketing,
            'rank_marketing'        => $rank_marketing,
            'pegawai'               => null,
            'content'               => 'adminteam/dashboard/index'
        ];

        return view('adminteam/layout/wrapper', $data);
    }
}