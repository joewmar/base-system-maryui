<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeedType extends Model
{
    use HasFactory;

    protected $fillable = [
        'feed_type_name',
        'farm_id',
        'active_status',
    ];
    protected function feedTypeName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => $value,        
        );
    }
    public function farm()
    {
        return $this->belongsTo(Farm::class, 'farm_id');
    }
    // public function ingredients()
    // {
    //     return $this->hasMany(Ingredient::class, 'id');
    // }
}
