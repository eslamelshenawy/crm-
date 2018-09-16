<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResaleUnit extends Model
{
    protected $fillable = ['image'];

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'unit_facilities', 'unit_id');
    }
}
