<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;
    protected $fillable = [
        'farm_name',
        'active_status'
    ];
    public function location()
    {
        return $this->hasMany(FarmLocation::class, 'farm_id', 'id');
    }
    public function feedTypes()
    {
        return $this->hasMany(FeedType::class, 'farm_id', 'id');
    }
}
