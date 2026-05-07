<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Kabupaten_Model extends Model
{
    //
    use HasFactory;
    //
    protected $table = 'kabupaten'; // Nama tabel di database
    protected $primaryKey = 'id_kabupaten'; // Tentukan primary key yang benar
    public $incrementing = true; // Jika `id_unit` bukan auto-increment
    protected $keyType = 'int'; // Pastikan tipe data sesuai dengan di database

    protected $fillable = ['nama'];

    //listing
    public function listing()
    {
        $query = DB::table('kabupaten')
            ->select('*')
            ->orderBy('id_kabupaten','DESC')
            ->get();
        return $query;
    }
    // tambah 
    public function tambah ($data)
    {
        DB::table('kabupaten')->insert($data);
    }
    // edit 
    public function edit ($data)
    {
        DB::table('kabupaten')
            ->where('id_kabupaten',$data['id_kabupaten'])
            ->update($data);
    }
    // hapus
    public function hapus ($data)
    {
        DB::table('kabupaten')
            ->where('id_kabupaten',$data['id_kabupaten'])
            ->delete();
    }
    public function instansi()
    {
        return $this->hasMany(Instansi_Model::class, 'instansi_id', 'id');
    }
}
