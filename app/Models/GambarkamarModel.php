<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GambarkamarModel extends Model
{
    // use HasFactory;

    protected $table = 'gambar_kamar';
    protected $primaryKey = 'id_gambar';
    public $incrementing = true; 
    protected $keyType = 'int';

    protected $fillable = [
        'tipe_id',
        'gambar',
        'judul',
    ];

     public function tipe()
    {
        return $this->belongsTo(TipeKamar::class, 'tipe_id', 'id');
    }
    //listing
    public function listing()
    {
        $query = DB::table('gambar_kamar')
            ->select('*')
            ->orderBy('id_gambar','DESC')
            ->get();
        return $query;
    }
    // tambah 
    public function tambah ($data)
    {
        DB::table('gambar_kamar')->insert($data);
    }
    // edit 
    public function edit ($data)
    {
        DB::table('gambar_kamar')
            ->where('id_gambar',$data['id_gambar'])
            ->update($data);
    }
    // hapus
    public function hapus ($data)
    {
        DB::table('gambar_kamar')
            ->where('id_gambar',$data['id_gambar'])
            ->delete();
    }
}
