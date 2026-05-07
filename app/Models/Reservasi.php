<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    
    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';
    
    protected $fillable = [
        'kode_reservasi',
        'id_kamar', // Ini memang membingungkan - mungkin rename ke 'tipe_id'?
        'nama_tamu',
        'email',
        'no_hp',
        'jumlah_dewasa',
        'jumlah_anak',
        'jumlah_kamar',
        'check_in',
        'check_out',
        'payment_method',
        'bukti_pembayaran',
        'total_harga',
        'status',
        'catatan'
    ];
    
    /**
     * Relasi ke tipe kamar (jika id_kamar adalah tipe_id)
     */
    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class, 'id_kamar', 'id');
    }
    
    /**
     * Relasi ke detail reservasi
     */
    public function details()
    {
        return $this->hasMany(ReservasiDetail::class, 'reservasi_id', 'id_reservasi');
    }
    
    /**
     * Relasi ke kamar melalui detail (lebih sederhana)
     */
    public function kamars()
    {
        return $this->hasManyThrough(
            Kamar::class,
            ReservasiDetail::class,
            'reservasi_id', // Foreign key di reservasi_detail
            'nomor_kamar',  // Foreign key di kamar  
            'id_reservasi', // Local key di reservasi
            'nomor_kamar'   // Local key di reservasi_detail
        );
    }
    
    /**
     * Scope untuk reservasi aktif
     */
    public function scopeAktif($query)
    {
        return $query->whereIn('status', ['pending', 'confirmed', 'paid', 'check-in']);
    }
    public function kamar()
    {
        // Parameter kedua adalah foreign key di tabel reservasi (id_kamar)
        // Parameter ketiga adalah primary key di tabel kamar (id_kamar)
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id_kamar');
    }
}