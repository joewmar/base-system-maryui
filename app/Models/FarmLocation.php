<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FarmLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'farm_id',
        'farm_location',
        'active_status'
    ];
    protected function farmLocation(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => $value,        
        );
    }
    public function farm()
    {
        return $this->belongsTo(Farm::class, 'farm_id', 'id');
    }
}
