<?php

namespace App\Http\Controllers;

use App\LeadNote;
use Illuminate\Http\Request;

class LeadNoteController extends Controller
{
    public function store(Request $request)
    {
        if($request->note !=""){
        $note          = new LeadNote;
        $note->lead_id = $request->lead_id;
        $note->user_id = $request->user_id?$request->user_id:($request->commercial_agent_id?$request->commercial_agent_id:null);
        $note->note    = $request->note;
        $note->save();
        $lead=\App\Lead::where('id',$request->lead_id)->first();
        $player_id=\App\Player::where('user_id',$lead->agent_id)->orWhere("user_id",$lead->commercial_agent_id)->get();
        $userDo=\App\User::find($request->user_id)->first();
        $notify = new \App\AdminNotification;
        $notify->type = 'note_lead';
        $notify->type_id = $request->lead_id;
        $notify->status = 0;
        $notify->user_id = $request->user_id;
        $notify->assigned_to = $lead->agent_id;
        $notify->save();
        $message="$userDo->first_name $userDo->first_name make a note for you to $lead->first_name $lead->last_name.";
            if(count($player_id)>0){
                foreach($player_id as $p){
                    $url=url(adminPath().'/leads/'.$request->lead_id);
                    sendOne($message, $p->player_id, $url, $data = null,$p->device);
                }
            }
        return view('admin.leads.new_comment', ['note' => $note]);
        }else{
            return view('admin.leads.new_comment', ['note' => ""]);
        }
        
    }
}
