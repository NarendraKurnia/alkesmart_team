<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['name','email','password','role','status'];

    // Listing
    public function listing()
    {
        return DB::table($this->table)
            ->orderBy('id', 'DESC')
            ->get();
    }

    // Tambah
    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    // Detail
    public static function detail($id)
    {
        return DB::table('users')->where('id', $id)->first();
    }

    // Hapus
    public function hapus($id)
    {
        return DB::table($this->table)->where('id', $id)->delete();
    }

    // Update
    public function updateProfil($id, $data)
    {
        DB::table($this->table)->where('id', $id)->update($data);
    }
}
