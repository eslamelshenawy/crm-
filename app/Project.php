<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
//	public function getRouteKeyName()
//	{
//		return 'name';
//	}

    public function developer(){
        return $this->belongsTo('App\Developer');
    }

    public function request()
    {
        return $this->hasMany('App\Request','project_id');
    }

}
