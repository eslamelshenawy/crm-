<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadSource extends Model
{
    //
    public function leads()
    {
        return $this->hasMany('App\Lead', 'lead_source_id');
    }

}
