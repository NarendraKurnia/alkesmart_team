<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Instansi_Model extends Model
{
    use HasFactory;

    protected $table = 'instansi';
    protected $primaryKey = 'id_instansi';
    public $incrementing = true; 
    protected $keyType = 'int';

    protected $fillable = [
        'kabupaten_id',
        'nama',
    ];

    // Relasi ke tipe kamar
    public function kabupaten()
{
    // Foreign key adalah kabupaten_id, owner key adalah id_kabupaten
    return $this->belongsTo(Kabupaten_Model::class, 'kabupaten_id', 'id_kabupaten');
}
    //listing
    public function listing()
    {
        $query = DB::table('instansi')
            ->select('*')
            ->orderBy('id_instansi','DESC')
            ->get();
        return $query;
    }
    // tambah 
    public function tambah ($data)
    {
        DB::table('instansi')->insert($data);
    }
    // edit 
    public function edit ($data)
    {
        DB::table('instansi')
            ->where('id_instansi',$data['id_instansi'])
            ->update($data);
    }
    // hapus
    public function hapus ($data)
    {
        DB::table('instansi')
            ->where('id_instansi',$data['id_instansi'])
            ->delete();
    }
    
}
