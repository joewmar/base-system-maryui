<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Farm extends Model
{
    use HasFactory;
    protected $fillable = [
        'farm_name',
        'active_status'
    ];
    protected function farmName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => $value,        
        );
    }
    public function location()
    {
        return $this->hasMany(FarmLocation::class, 'farm_id', 'id');
    }
    public function feedTypes()
    {
        return $this->hasMany(FeedType::class, 'farm_id');
    }
}
