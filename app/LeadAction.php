<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadAction extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function lead()
    {
        return $this->belongsTo('App\Lead', 'lead_id')->withDefault(['id' => null, 'first_name' => null, 'last_name' => null]);
    }
}
