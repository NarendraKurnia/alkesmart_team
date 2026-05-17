<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai_Model extends Model
{
    //
    use HasFactory;
    //
    protected $table = 'pegawai'; // Nama tabel di database
    protected $primaryKey = 'id_pegawai'; // Tentukan primary key yang benar
    public $incrementing = true; // Jika `id_unit` bukan auto-increment
    protected $keyType = 'int'; // Pastikan tipe data sesuai dengan di database

    protected $fillable = ['nama'];

    //listing
    public function listing()
    {
        $query = DB::table('pegawai')
            ->select('*')
            ->orderBy('id_pegawai','DESC')
            ->get();
        return $query;
    }
    // tambah 
    public function tambah ($data)
    {
        DB::table('pegawai')->insert($data);
    }
    // edit 
    public function edit ($data)
    {
        DB::table('pegawai')
            ->where('id_pegawai',$data['id_pegawai'])
            ->update($data);
    }
    // hapus
    public function hapus ($data)
    {
        DB::table('pegawai')
            ->where('id_pegawai',$data['id_pegawai'])
            ->delete();
    }
}
