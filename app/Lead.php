<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Result {
    public $count = 0;
    public $leads = [];
}

class Lead extends Authenticatable
{
    use HasApiTokens, Notifiable;

    private static $allLeads = [];

    public static function getLeads($id)
    {
        $groups = Group::where('parent_id', $id)->get();
        foreach ($groups as $group) {
            foreach (GroupMember::where('group_id', $group->id)->get() as $member) {

                array_push(self::$allLeads, $member->member_id);
                self::getLeads($group->id);
            }
        }
    }

    public static function getAgentLeads($user = null, $pageNate = null, $page = 1)
    {
        if ($user == null)
            $userData = auth()->user();
        else
            $userData = $user;

        // $total = 0;
        // $result = new Result();
        if ($userData->type == 'admin' or checkRole('show_all_leads', $userData)) {

            if ($pageNate == null) {
                return Lead::orderBy('updated_at', 'desc')->get();
                // $result->count = $result->leads->count();
            } else {
                $lds = Lead::orderBy('updated_at', 'desc');
                // $result->count = round($lds->count() / $pageNate);
                return $lds->offset(($page-1)*$pageNate)->limit($pageNate)->get();
            }
        } else {
                /* if (count(Group::where('team_leader_id', $userData->id)->get()) > 0) {
                $users = [];
                foreach (Group::where('team_leader_id', $userData->id)->get() as $group) {
                    if ($group->parent_id != 0) {
                        foreach (GroupMember::where('group_id', $group->id)->get() as $member) {
                            $users[] = $member->member_id;
                        }
                    } else {
                        self::getLeads($group->id);
                        $users = self::$allLeads;
                    }
                }
                $users[] = auth()->id();
                if ($pageNate == null) {
                    return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->orderBy('updated_at', 'desc')->get();
                } else {
                    return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->orderBy('updated_at', 'desc')->offset(($page-1)*$pageNate)->limit($pageNate)->get();
                }
            } else {*/
                if ($pageNate == null) {
                    return Lead::where('agent_id', $userData->id)->orWhere('commercial_agent_id', $userData->id)->orderBy('updated_at', 'desc')->get();
                    // $result->count = $result->leads->count();
                } else {
                    if($page == 1){
                        $lds = Lead::where('agent_id', $userData->id)->orWhere('commercial_agent_id', $userData->id)->orderBy('updated_at', 'desc');
                        // $result->count = round($lds->count() / $pageNate);
                        return $lds->offset(($page-1)*$pageNate)->limit($pageNate)->get();
                    } else {
                        // $result->count = 0;
                        return Lead::where('agent_id', $userData->id)->orWhere('commercial_agent_id', $userData->id)->orderBy('updated_at', 'desc')->offset(($page-1)*$pageNate)->limit($pageNate)->get();
                    }
                }
        }

        return null;
    }

    public static function getAgentLeadsResult($user = null, $pageNate = null, $page = 1)
    {
        if ($user == null)
            $userData = auth()->user();
        else
            $userData = $user;

        $total = 0;
        $result = new Result();
        if ($userData->type == 'admin' or checkRole('show_all_leads', $userData)) {

            if ($pageNate == null) {
                $result->leads = Lead::orderBy('updated_at', 'desc')->get();
                $result->count = $result->leads->count();
            } else {
                $lds = Lead::orderBy('updated_at', 'desc');
                $result->count = round($lds->count() / $pageNate);
                $result->leads = $lds->offset(($page-1)*$pageNate)->limit($pageNate)->get();
            }
        } else {
                /* if (count(Group::where('team_leader_id', $userData->id)->get()) > 0) {
                $users = [];
                foreach (Group::where('team_leader_id', $userData->id)->get() as $group) {
                    if ($group->parent_id != 0) {
                        foreach (GroupMember::where('group_id', $group->id)->get() as $member) {
                            $users[] = $member->member_id;
                        }
                    } else {
                        self::getLeads($group->id);
                        $users = self::$allLeads;
                    }
                }
                $users[] = auth()->id();
                if ($pageNate == null) {
                    return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->orderBy('updated_at', 'desc')->get();
                } else {
                    return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->orderBy('updated_at', 'desc')->offset(($page-1)*$pageNate)->limit($pageNate)->get();
                }
            } else {*/
                if ($pageNate == null) {
                    $result->leads = Lead::where('agent_id', $userData->id)->orWhere('commercial_agent_id', $userData->id)->orderBy('updated_at', 'desc')->get();
                    $result->count = $result->leads->count();
                } else {
                    if($page == 1){
                        $lds = Lead::where('agent_id', $userData->id)->orWhere('commercial_agent_id', $userData->id)->orderBy('updated_at', 'desc');
                        $result->count = round($lds->count() / $pageNate);
                        $result->leads = $lds->offset(($page-1)*$pageNate)->limit($pageNate)->get();
                    } else {
                        // $result->count = 0;
                        $result->leads = Lead::where('agent_id', $userData->id)->orWhere('commercial_agent_id', $userData->id)->orderBy('updated_at', 'desc')->offset(($page-1)*$pageNate)->limit($pageNate)->get();
                    }
                }
        }

        return $result;
    }

    public static function getAgentLeadsByAgent($user = null, $pageNate = null, $page = 1, $agent_id)
    {
        if ($user == null)
            $userData = auth()->user();
        else
            $userData = $user;
        if ($userData->type == 'admin' or checkRole('show_all_leads', $userData)) {

            if ($pageNate == null) {
                return Lead::where('agent_id', $agent_id)->get();
            } else {
                return Lead::where('agent_id', $agent_id)->offset(($page-1)*$pageNate)->limit($pageNate)->get();
            }
        } else {
/*            if (count(Group::where('team_leader_id', $userData->id)->get()) > 0) {
                $users = [];
                foreach (Group::where('team_leader_id', $userData->id)->get() as $group) {
                    if ($group->parent_id != 0) {
                        foreach (GroupMember::where('group_id', $group->id)->get() as $member) {
                            $users[] = $member->member_id;
                        }
                    }
                    $users[] = $userData->id;
                    if ($pageNate == null) {
                        return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->get();
                    } else {
                        self::getLeads($group->id);
                        $users = self::$allLeads;
                    }
                }
                $users[] = auth()->id();
                if ($pageNate == null) {
                    return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->get();
                } else {
                    return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->offset(($page-1)*$pageNate)->limit($pageNate)->get();
                }
            } else {*/
                if ($pageNate == null) {
                    return Lead::where('agent_id', $userData->id)->orWhere('commercial_agent_id', $userData->id)->orderBy('updated_at', 'desc')->get();
                } else {
                    return Lead::where('agent_id', $userData->id)->orWhere('commercial_agent_id', $userData->id)->orderBy('updated_at', 'desc')->offset(($page-1)*$pageNate)->limit($pageNate)->get();
                }
/*            }*/
        }
    }

    public static function getAgentLeadsSync($user = null, $pageNate = null, $page = 1, $last_sync, $ids)
    {
        if ($user == null)
            $userData = auth()->user();
        else
            $userData = $user;

        if ($userData->type == 'admin' or checkRole('show_all_leads', $userData)) {
            if ($pageNate == null) {
                return Lead::where('updated_at', '>=', $last_sync)->orWhereIn('id', $ids)->orderBy('updated_at', 'desc')->get();
            } else {
                return Lead::where('updated_at', '>=', $last_sync)->orWhereIn('id', $ids)->orderBy('updated_at', 'desc')->offset(($page-1)*$pageNate)->limit($pageNate)->get();
            }
        } else {
            if (count(Group::where('team_leader_id', $userData->id)->get()) > 0) {
                $users = [];
                foreach (Group::where('team_leader_id', $userData->id)->get() as $group) {
                    if ($group->parent_id != 0) {
                        foreach (GroupMember::where('group_id', $group->id)->get() as $member) {
                            $users[] = $member->member_id;
                        }
                    } else {
                        self::getLeads($group->id);
                        $users = self::$allLeads;
                    }
                }
                $users[] = $userData->id;
                if ($pageNate == null) {
                    return Lead::where('updated_at', '>=', $last_sync)->WhereIn('agent_id', $users)->orWhereIn('id', $ids)->orWhereIn('commercial_agent_id', $users)->orderBy('updated_at', 'desc')->get();
                } else {
                    return Lead::where('updated_at', '>=', $last_sync)->WhereIn('agent_id', $users)->orWhereIn('id', $ids)->orWhereIn('commercial_agent_id', $users)->orderBy('updated_at', 'desc')->offset(($page-1)*$pageNate)->limit($pageNate)->get();
                }
            } else {
                if ($pageNate == null) {
                    return Lead::where('agent_id', $userData->id)->where('updated_at', '>=', $last_sync)->orWhereIn('id', $ids)->orWhere('commercial_agent_id', $userData->id)->orderBy('updated_at', 'desc')->get();
                } else {
                    return Lead::where('agent_id', $userData->id)->where('updated_at', '>=', $last_sync)->orWhereIn('id', $ids)->orWhere('commercial_agent_id', $userData->id)->offset(($page-1)*$pageNate)->orderBy('updated_at', 'desc')->limit($pageNate)->get();
                }
            }
        }
    }


    public static function getTeamLeads($user = null, $number = null, $count = 25)
    {

        if ($user == null)
            $userData = auth()->user();
        else
            $userData = $user;

        self::$allLeads = [];

        if ($userData->type == 'admin' or checkRole('show_all_leads')) {
            if ($number == null) {
                return Lead::where('agent_id', '!=', $userData->id)->where('agent_id', '!=', 0)->
                orWhere('commercial_agent_id', '!=', $userData->id)->where('commercial_agent_id', '!=', 0)->
                orderBy('created_at', 'desc')->get();
            } else {
                return Lead::where('agent_id', '!=', $userData->id)->where('agent_id', '!=', 0)->
                orWhere('commercial_agent_id', '!=', $userData->id)->where('commercial_agent_id', '!=', 0)->
                orderBy('created_at', 'desc')->paginate($count, ['*'], 'team',$number);
            }
        } else {
            if (count(Group::where('team_leader_id', $userData->id)->get()) > 0) {
                $users = [];

                foreach (Group::where('team_leader_id', $userData->id)->get() as $group) {
                    foreach (GroupMember::where('group_id', $group->id)->get() as $member) {
                        array_push(self::$allLeads, $member->member_id);
                    }
                    self::getLeads($group->id);
                    $users = self::$allLeads;
                }
                if ($number == null) {
                    return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->orderBy('created_at', 'desc')->get();
                } else {
                    return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->orderBy('created_at', 'desc')->paginate($count, ['*'], 'team',$number);
                }
            }
        }
    }


    public static function getTeamLeadsTwo($user = null, $number = null, $count = 25)
        {

            if ($user == null)
                $userData = auth()->user();
            else
                $userData = $user;

            self::$allLeads = [];

            if ($userData->type == 'admin' or checkRole('show_all_leads')) {

                if ($number == null) {
                    return Lead::where('agent_id', '!=', $userData->id)->where('agent_id', '!=', 0)->
                    orWhere('commercial_agent_id', '!=', $userData->id)->where('commercial_agent_id', '!=', 0)->
                    orderBy('created_at', 'desc');
                } else {
                    return Lead::where('agent_id', '!=', $userData->id)->where('agent_id', '!=', 0)->
                    orWhere('commercial_agent_id', '!=', $userData->id)->where('commercial_agent_id', '!=', 0)->
                    orderBy('created_at', 'desc');
                }
            } else {
                if (count(Group::where('team_leader_id', $userData->id)->get()) > 0) {
                    $users = [];

                    foreach (Group::where('team_leader_id', $userData->id)->get() as $group) {
                        foreach (GroupMember::where('group_id', $group->id)->get() as $member) {
                            array_push(self::$allLeads, $member->member_id);
                        }
                        self::getLeads($group->id);
                        $users = self::$allLeads;
                    }
                    if ($number == null) {
                        return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->orderBy('created_at', 'desc');
                    } else {
                        return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->orderBy('created_at', 'desc');
                    }
                }
            }
        }


    public static function getTeamLeads2($user = null, $number = null)
    {
        if ($user == null)
            $userData = auth()->user();
        else
            $userData = $user;
        if ($userData->type == 'admin' or checkRole('show_all_leads')) {
            if ($number == null) {

                return Lead::where('agent_id', '!=', $userData->id)->where('agent_id', '!=', 0)->
                orWhere('commercial_agent_id', '!=', $userData->id)->where('commercial_agent_id', '!=', 0)->
                orderBy('created_at', 'desc')->get();
            } else {
                return Lead::where('agent_id', '!=', $userData->id)->where('agent_id', '!=', 0)->
                orWhere('commercial_agent_id', '!=', $userData->id)->where('commercial_agent_id', '!=', 0)->
                orderBy('created_at', 'desc')->offset(($number-1)*20)->limit(20)->get();
            }
        } else {
            if (count(Group::where('team_leader_id', $userData->id)->get()) > 0) {
                $users = [];

                foreach (Group::where('team_leader_id', $userData->id)->get() as $group) {
                    foreach (GroupMember::where('group_id', $group->id)->get() as $member) {
                        array_push(self::$allLeads, $member->member_id);
                    }
                    self::getLeads($group->id);
                    $users = self::$allLeads;
                }
                if ($number == null) {
                    return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->orderBy('created_at', 'desc')->get();
                } else {
                    return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->orderBy('created_at', 'desc')->paginate(25, ['*'], 'team',$number);
                }
            }
        }
    }

     public static function getAgentLea($user = null)
    {
        if ($user == null)
            $userData = auth()->user();
        else
            $userData = $user;

        if ($userData->type == 'admin' or checkRole('show_all_leads', $userData)) {
            return Lead::get();

        } else {
            if (count(Group::where('team_leader_id', $userData->id)->get()) > 0) {
                $users = [];
                foreach (Group::where('team_leader_id', $userData->id)->get() as $group) {
                    if ($group->parent_id != 0) {
                        foreach (GroupMember::where('group_id', $group->id)->get() as $member) {
                            $users[] = $member->member_id;
                        }
                    } else {
                        self::getLeads($group->id);
                        $users = self::$allLeads;
                    }
                }
                $users[] = auth()->id();
                return Lead::whereIn('agent_id', $users)->orWhereIn('commercial_agent_id', $users)->get();
            } else {
                return Lead::where('agent_id', $userData->id)->orWhere('commercial_agent_id', $userData->id)->get()->paginate(25, ['*'], 'team',$number);
            }
        }
    }

    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function commercialAgent()
    {
        return $this->belongsTo('App\User', 'commercial_agent_id');
    }

    public function source()
    {
        return $this->belongsTo('App\LeadSource', 'lead_source_id')->withDefault(['id' => null, 'name' => null]);
    }

    public function industry()
    {
        return $this->belongsTo('App\Industry');
    }

    public function title()
    {
        return $this->belongsTo('App\Title');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function documents()
    {
        return $this->hasMany('App\LeadDocument');
    }

    public function player(){
        return $this->hasMany('App\Player');
    }

    public function lead_actions()
    {
        return $this->hasMany('App\LeadAction');
    }

    public function requests()
    {
        return $this->hasMany('App\Request');
    }

    public function calls()
    {
        return $this->hasMany('App\Call');
    }

    public function meetings()
    {
        return $this->hasMany('App\Meeting');
    }
}
