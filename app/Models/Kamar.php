<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';
    public $incrementing = true; 
    protected $keyType = 'int';

    protected $fillable = [
        'tipe_id',
        'nomor_kamar',
        'status',
        'keterangan',
        'harga',
    ];

    // Relasi ke tipe kamar
    public function tipe()
    {
        return $this->belongsTo(TipeKamar::class, 'tipe_id', 'id');
    }
    //listing
    public function listing()
    {
        $query = DB::table('kamar')
            ->select('*')
            ->orderBy('id_kamar','DESC')
            ->get();
        return $query;
    }
    // tambah 
    public function tambah ($data)
    {
        DB::table('kamar')->insert($data);
    }
    // edit 
    public function edit ($data)
    {
        DB::table('kamar')
            ->where('id_kamar',$data['id_kamar'])
            ->update($data);
    }
    // hapus
    public function hapus ($data)
    {
        DB::table('kamar')
            ->where('id_kamar',$data['id_kamar'])
            ->delete();
    }
    public function gambarKamar()
    {
        return $this->hasMany(GambarkamarModel::class, 'tipe_id', 'id');
    }
    public function dynamicPrices()
    {
        return $this->hasMany(DynamicPrice::class, 'tipe_kamar_id');
    }
    public function reservasi() {
        return $this->hasMany(Reservasi::class, 'id_kamar', 'id_kamar');
    }
    
}
