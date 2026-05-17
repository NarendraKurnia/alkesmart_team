<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shiftselesai_Model extends Model
{
     protected $table = 'shift_selesai';
    public $timestamps = false;
    
    //listing
    public function listing()
    {
        $query = DB::table('shift_selesai')
            ->select(
                'shift_selesai.*',
                'kabupaten.nama as nama_kabupaten',
                'instansi.nama as nama_instansi'
            )
            ->leftJoin('kabupaten', 'kabupaten.id_kabupaten', '=', 'shift_selesai.kabupaten_id')
            ->leftJoin('instansi', 'instansi.id_instansi', '=', 'shift_selesai.instansi_id')
            ->orderBy('id_selesai','DESC')
            ->get();
        return $query;
    }

    // Detail dengan JOIN agar Nama Kabupaten dan Instansi muncul di Modal
    public function detail($id_selesai)
    {
        $query = DB::table('shift_selesai')
            ->select(
                'shift_selesai.*',
                'kabupaten.nama as nama_kabupaten',
                'instansi.nama as nama_instansi'
            )
            ->leftJoin('kabupaten', 'kabupaten.id_kabupaten', '=', 'shift_selesai.kabupaten_id')
            ->leftJoin('instansi', 'instansi.id_instansi', '=', 'shift_selesai.instansi_id')
            ->where('id_selesai', $id_selesai)
            ->first();
        return $query;
    }
    // tambah 
    public function tambah ($data)
    {
        DB::table('shift_selesai')->insert($data);
    }

    // tambah 
    public function edit($data)
    {
        \DB::table('shift_selesai') // Ganti 'shift_selesai' sesuai dengan nama tabel database kamu jika berbeda
            ->where('id_selesai', $data['id_selesai'])
            ->update($data);
    }

    // hapus
    public function hapus ($data)
    {
        DB::table('shift_selesai')
            ->where('id_selesai',$data['id_selesai'])
            ->delete();
    }
    
}
