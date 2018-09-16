<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdcastEvent extends Model
{

    public function users_sent()
{
    return $this->belongsTo('App\ProdeventStatus', 'prot_event_id');
}




}
