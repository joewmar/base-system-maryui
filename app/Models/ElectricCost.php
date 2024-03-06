<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricCost extends Model
{
    use HasFactory;
        protected $fillable = [
            'date',
            'electric_cost', 
            'created_at',
            'active_status'
        ];

}
