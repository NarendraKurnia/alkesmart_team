<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HighSeason extends Model
{
    protected $table = 'high_seasons';
    protected $fillable = ['nama','start_date','end_date','markup_persen','keterangan'];

    public function scopeActiveOn($query, $date)
    {
        return $query->whereDate('start_date', '<=', $date)
                     ->whereDate('end_date', '>=', $date);
    }
}
