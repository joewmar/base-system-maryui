<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricCost extends Model
{
    use HasFactory;
        protected $fillable = [
            'electric_cost', 
            'created_at',
            'active_status'
        ];

}
