<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class User_Model extends Model
{
    //use HasFactory;
    protected $table = 'pengguna';
    protected $fillable = ['nama', 'email', 'username', 'password', 'pegawai_id'];

    public function pegawai()
    {
    return $this->belongsTo(Pegawai_Model::class, 'pegawai_id', 'id_pegawai'); 
    }
    //listing
    public function listing()
    {
        $query = DB::table('pengguna')
            ->select('*')
            ->orderBy('id_user','DESC')
            ->get();
        return $query;
    }
    // tambah 
    public function tambah ($data)
    {
        DB::table('pengguna')->insert($data);
    }
    // detail
    public function detail($id_user)
    {
        $query = DB::table('pengguna')
            ->select('*')
            ->where('id_user', $id_user)
            ->orderBy('id_user','DESC')
            ->first();
        return $query;
    }
    // login
    public function login($username, $password)
    {
        $query = DB::table('pengguna')
        ->select('id_user', 'username', 'nama', 'pegawai_id', 'password')
        ->where('username', $username)
        ->where('password', sha1($password))
        ->first();
        return $query;
    }
    // edit 
    public function edit ($data)
    {
        DB::table('pengguna')
            ->where('id_user',$data['id_user'])
            ->update($data);
    }
    // hapus
    public function hapus ($data)
    {
        DB::table('pengguna')
            ->where('id_user',$data['id_user'])
            ->delete();
    }
    

}
