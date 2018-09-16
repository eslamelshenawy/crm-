<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    //
    public function broadcast(){
        return $this->belongsTo('App\BroadcastRequest','type_id');
    }
}
