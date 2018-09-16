<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestBroadcast extends Model
{
    protected $table = 'requests_broadcast';
    protected $fillable=["id","location"];
    
    public function lead()
    {
        return $this->belongsTo('App\Lead', 'lead_id')->withDefault(['id' => null,'first_name' => null,'last_name' => null]);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function unittype()
    {
        return $this->belongsTo('App\UnitType', 'unit_type_id')->withDefault(['id' => null,'en_name' => null,'ar_name' => null,'description' => null]);
    }

    public function loc()
    {
        return $this->belongsTo('App\Location', 'location')->withDefault(['id' => null,'en_name' => null,'ar_name' => null,'parent_id' => null]);
    }

    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id')->withDefault(['id' => null,'en_name' => null,'ar_name' => null,'parent_id' => null]);
    }
    
    public static function getLeadRequestsSync($LastSync){
        $reqsIds = Request::where('updated_at', '>=', $LastSync)->pluck('lead_id')->all();

        return $reqsIds;
    }
}
