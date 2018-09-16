<?php
            $not1=\App\ProjectRequest::select('id',DB::raw('null as assigned_to'),'name','status',DB::raw('null as user_id'),DB::raw('"project_added" as type'),DB::raw('null as type_id'), 'created_at', DB::raw('1 as projects') )->where('created_at','>=',date('Y-m-d H:i:s', strtotime('-1 day', time())));  
            
            $notToday=\App\AdminNotification::select('id','assigned_to',DB::raw('null as name'),'status','user_id','type','type_id', 'created_at', DB::raw('null as projects'))->where('assigned_to',Auth::user()->id)->union($not1)->where('created_at','>=',date('Y-m-d H:i:s', strtotime('-1 day', time())))->orderBy('created_at','desc')->limit(10)->get();
            
            $not2=\App\ProjectRequest::select('id',DB::raw('null as assigned_to'),'name','status',DB::raw('null as user_id'),DB::raw('"project_added" as type'),DB::raw('null as type_id'), 'created_at', DB::raw('1 as projects') )->where('created_at','<=',date('Y-m-d H:i:s', strtotime('-1 day', time())))->orWhere(function($q) {
                    $q->where('created_at','<=',date('Y-m-d H:i:s', strtotime('-1 day', time())))
                    ->Where('status',0);
                });
            $notEarly=\App\AdminNotification::select('id','assigned_to',DB::raw('null as name'),'status','user_id','type','type_id', 'created_at', DB::raw('null as projects'))->where('assigned_to',Auth::user()->id)->union($not2)->where('created_at','<=',date('Y-m-d H:i:s', strtotime('-1 day', time())))->orWhere(
                function($q) {
                    $q->where('created_at','<=',date('Y-m-d H:i:s', strtotime('-1 day', time())))
                    ->Where('status',0);
             })->orderBy('created_at','desc')->limit(10)->get();
?>
@include('admin.header')

@include('admin.nav')
{{--@include('admin.menu')--}}
@include('admin.error')
<div id="root">
@yield('content')
</div>
@include('admin.footer')
