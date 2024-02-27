<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'table',
        'farm_new',
        'farm_old',
        'user_id',
    ];

    public function user()
    {
    	return $this->belongsto('App\Models\User');
    }
}
