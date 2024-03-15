<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Premixes extends Model
{
    use HasFactory;

    protected $fillable = [
        'feed_type_id',
        'beginning', 
        'ending',
        'date',
        'active_status'
    ];

    public function ingedient()
    {
        return $this->belongsTo(Ingredient::class, 'feed_type_id', 'feed_type_id');
    }
    protected function micro(): Attribute
    {
        $mat_id = Material::where('category', 'micro')->orderBy('id', 'asc')->first()->id;
        $batch = Ingredient::where('material_id', $mat_id)->where('feed_type_id', $this->attributes['feed_type_id'])->orderby('id', 'asc')->first()->batch ?? 0;
        return Attribute::make(
            get: fn () => $batch,
        );
    }
    protected function macro(): Attribute
    {
        $mat_id = Material::where('category', 'macro')->orderBy('id', 'asc')->first()->id;
        $batch = Ingredient::where('material_id', $mat_id)->where('feed_type_id', $this->attributes['feed_type_id'])->orderby('id', 'asc')->first()->batch ?? 0;
        return Attribute::make(
            get: fn () => $batch,
        );
    }
    protected function ending(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->attributes['beginning'] + $this->micro + $this->macro) ?? 0,
        );
    }
}
