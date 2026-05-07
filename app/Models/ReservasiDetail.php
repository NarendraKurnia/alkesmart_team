<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiDetail extends Model
{
    use HasFactory;

    protected $table = 'reservasi_detail'; 
    
    // BERDASARKAN DATA ANDA: primary key adalah 'id', bukan 'id_detail'
    protected $primaryKey = 'id'; 
    
    public $timestamps = true; // Karena ada created_at/updated_at di data

    protected $fillable = [
        'reservasi_id',
        'tipe_id',
        'nomor_kamar',
        'harga',
        'subtotal',
        'jumlah_dewasa', // Di database: jumlah_dewasa (bukan jumlah_dewasa_detail)
        'jumlah_anak',   // Di database: jumlah_anak (bukan jumlah_anak_detail)
        'check_in',      // TAMBAHKAN - ada di data Anda
        'check_out',     // TAMBAHKAN - ada di data Anda
        'catatan_detail',
    ];

    /**
     * Relasi ke Reservasi.
     */
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'reservasi_id', 'id_reservasi');
    }

    /**
     * Relasi ke TipeKamar.
     */
    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class, 'tipe_id', 'id');
    }
    
    /**
     * Relasi ke Kamar berdasarkan nomor_kamar
     */
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'nomor_kamar', 'nomor_kamar');
    }
}