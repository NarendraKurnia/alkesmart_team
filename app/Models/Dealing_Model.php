<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dealing_Model extends Model
{
    protected $table = 'dealing'; 
    protected $primaryKey = 'id_dealing'; 
    public $timestamps = false;
    
    public function listing()
    {
        $query = DB::table('dealing')
            ->select(
                'dealing.id_dealing',
                'dealing.nama_item', // Sesuai kolom database kamu
                'dealing.nama_pegawai',
                'dealing.nama_petugas',
                'dealing.no_petugas',
                'dealing.tanggal_dealing',
                'dealing.kabupaten_id',
                'dealing.instansi_id',
                'dealing.foto',
                'dealing.harga',
                'dealing.link_reset',
                'dealing.tanggal_update',
                'kabupaten.nama as nama_kabupaten',
                'instansi.nama as nama_instansi'
            )
            ->leftJoin('kabupaten', 'kabupaten.id_kabupaten', '=', 'dealing.kabupaten_id')
            ->leftJoin('instansi', 'instansi.id_instansi', '=', 'dealing.instansi_id')
            ->orderBy('dealing.id_dealing', 'DESC')
            ->get();
            
        return $query;
    }

    public function detail($id_dealing)
    {
        $query = DB::table('dealing')
            ->select(
                'dealing.id_dealing',
                'dealing.nama_item', // Sesuai kolom database kamu
                'dealing.nama_pegawai',
                'dealing.nama_petugas',
                'dealing.no_petugas',
                'dealing.tanggal_dealing',
                'dealing.kabupaten_id',
                'dealing.instansi_id',
                'dealing.foto',
                'dealing.harga',
                'dealing.link_reset',
                'dealing.tanggal_update',
                'kabupaten.nama as nama_kabupaten',
                'instansi.nama as nama_instansi'
            )
            ->leftJoin('kabupaten', 'kabupaten.id_kabupaten', '=', 'dealing.kabupaten_id')
            ->leftJoin('instansi', 'instansi.id_instansi', '=', 'dealing.instansi_id')
            ->where('dealing.id_dealing', $id_dealing)
            ->first();
            
        return $query;
    }

    public function tambah($data)
    {
        DB::table('dealing')->insert($data);
    }

    public function hapus($data)
    {
        DB::table('dealing')
            ->where('id_dealing', $data['id_dealing'])
            ->delete();
    }
}