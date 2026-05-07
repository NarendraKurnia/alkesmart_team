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
}
