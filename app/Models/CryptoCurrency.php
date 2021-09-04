<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoCurrency extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol',
        'last_price',
        'daily_change',
        'daily_change_percent',
        'daily_high',
        'daily_low',
    ];

    protected $casts = [
        'last_price' => 'float',
        'daily_change' => 'float',
        'daily_change_percent' => 'float',
        'daily_high' => 'float',
        'daily_low' => 'float',
    ];

    public function getDailyChangePercentAttribute($value)
    {
        return number_format($value, 2, '.', '').'%';
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
