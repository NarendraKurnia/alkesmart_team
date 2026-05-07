<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Client_Model extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'id_client';  // tambahkan primary key yang benar

    const CREATED_AT = null;
    const UPDATED_AT = 'tanggal_update';
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'phone_number',
        'otp_code',
        'is_verified'
    ];

    // Kalau mau, tambahkan mutator untuk password agar selalu hash otomatis:
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    // login
    public function login($email, $password)
    {
    $query = DB::table('clients')
    ->select('id_client', 'email', 'nama', 'password')
    ->where('email', $email)
    ->where('password', sha1($password))
    ->first();
    return $query;
    }
}
