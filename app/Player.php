<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table="players_id";
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
