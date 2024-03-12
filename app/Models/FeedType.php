<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedType extends Model
{
    use HasFactory;

    protected $fillable = [
        'feed_type_name',
        'farm_id',
        'active_status',
    ];
    public function farm()
    {
        return $this->belongsTo(Farm::class, 'farm_id');
    }
    // public function ingredients()
    // {
    //     return $this->hasMany(Ingredient::class, 'id');
    // }
}
