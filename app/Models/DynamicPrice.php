<?php
// app/Models/DynamicPrice.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicPrice extends Model
{
    protected $table = 'dynamic_prices';
    
    protected $fillable = [
        'tipe_kamar_id',
        'base_price',
        'holiday_price',
        'markup_percentage',
        'effective_date',
        'is_active'
    ];
    
    protected $casts = [
        'base_price' => 'decimal:2',
        'holiday_price' => 'decimal:2',
        'markup_percentage' => 'decimal:2',
        'effective_date' => 'date',
        'is_active' => 'boolean'
    ];
    
    // Relasi ke TipeKamar
    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class, 'tipe_kamar_id');
    }
    
    // Format harga
    public function getFormattedBasePriceAttribute()
    {
        return 'Rp ' . number_format($this->base_price, 0, ',', '.');
    }
    
    public function getFormattedHolidayPriceAttribute()
    {
        return 'Rp ' . number_format($this->holiday_price, 0, ',', '.');
    }
    
    // Scope aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}