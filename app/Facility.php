<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public function resales()
    {
        return $this->belongsToMany(ResaleUnit::class, 'unit_facilities', 'facility_id');
    }

    public function rentals()
    {
        return $this->belongsToMany(RentalUnit::class, 'unit_facilities', 'facility_id');
    }
}
