<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdeventStatus extends Model
{

     // function to get user from tabel user related ProdeventStatus in user_id
     public function users_event()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    //function to get title and description from ProdcastEvent related ProdeventStatus in prot_event_id
    // eslam
      public function users_sent()
    {
    return $this->belongsTo('App\ProdcastEvent','prot_event_id');
    }




}
