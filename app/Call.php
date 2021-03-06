<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function getLeadCallsSync($LastSync)
    {
        $leadIds = Call::where('updated_at', '>=', $LastSync)->pluck('lead_id')->all();

        return $leadIds;
    }

    public function call_status()
    {
        return $this->belongsTo('App\CallStatus', 'call_status_id')->withDefault(['id' => null, 'name' => null, 'has_next_action' => 0]);
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function lead()
    {
        return $this->belongsTo('App\Lead', 'lead_id')->withDefault(['id' => null, 'first_name' => null, 'last_name' => null]);
    }


}
