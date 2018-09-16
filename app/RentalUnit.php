<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentalUnit extends Model
{
    public function facilities(){
		return $this->belongsToMany(Facility::class, 'unit_facilities', 'unit_id');
	}
}
