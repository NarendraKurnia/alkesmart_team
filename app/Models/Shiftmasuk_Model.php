<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shiftmasuk_Model extends Model
{
    protected $table = 'shift_masuk'; 
    public $timestamps = false;
    
    // Listing dengan JOIN agar Nama Kabupaten dan Instansi muncul
    public function listing()
    {
        $query = DB::table('shift_masuk')
            ->select(
                'shift_masuk.*',
                'kabupaten.nama as nama_kabupaten',
                'instansi.nama as nama_instansi'
            )
            ->leftJoin('kabupaten', 'kabupaten.id_kabupaten', '=', 'shift_masuk.kabupaten_id')
            ->leftJoin('instansi', 'instansi.id_instansi', '=', 'shift_masuk.instansi_id')
            ->orderBy('id_masuk','DESC')
            ->get();
        return $query;
    }

    // Detail dengan JOIN agar Nama Kabupaten dan Instansi muncul di Modal
    public function detail($id_masuk)
    {
        $query = DB::table('shift_masuk')
            ->select(
                'shift_masuk.*',
                'kabupaten.nama as nama_kabupaten',
                'instansi.nama as nama_instansi'
            )
            ->leftJoin('kabupaten', 'kabupaten.id_kabupaten', '=', 'shift_masuk.kabupaten_id')
            ->leftJoin('instansi', 'instansi.id_instansi', '=', 'shift_masuk.instansi_id')
            ->where('id_masuk', $id_masuk)
            ->first();
        return $query;
    }

    // Tambah (Tetap)
    public function tambah ($data)
    {
        DB::table('shift_masuk')->insert($data);
    }

    // Hapus (Tetap)
    public function hapus ($data)
    {
        DB::table('shift_masuk')
            ->where('id_masuk',$data['id_masuk'])
            ->delete();
    }
}