@extends('admin.index')

<?php
            $not2=\App\ProjectRequest::select('id',DB::raw('null as assigned_to'),'name','status',DB::raw('null as user_id'),DB::raw('null as type'),DB::raw('null as type_id'), 'created_at', DB::raw('1 as projects') )->where('created_at','<=',date('Y-m-d H:i:s', strtotime('-1 day', time())))->orWhere(function($q) {
                    $q->Where('status',0);
                });
            $notEarly=\App\AdminNotification::select('id','assigned_to',DB::raw('null as name'),'status','user_id','type','type_id', 'created_at', DB::raw('null as projects'))->where('assigned_to',Auth::user()->id)->union($not2)->where('created_at','<=',date('Y-m-d H:i:s', strtotime('-1 day', time())))->orWhere(
                function($q) {
                    $q->Where('status',0);
             })->orderBy('created_at','desc')->limit(10)->get();
?>

@section('content')
<style>
    #app{
        width:100%;
    }
    .dash_desk{
       padding:5px 0px 50px 10px;
       border:1px solid #EEE;
       text-align:left;
       background:#F2E8DA;
       clear: left;
       display: block;
       overflow: auto;
       margin-bottom:15px;
    }

    .dash_desk>label{
        margin:5px 5px 40px 20px;
    }
    .dash_desk>label>h2>img{
        width:50px !important;
        margin-right:15px;
    }
    .dash_desk>div>div{
        text-align:center;
        float:left;
        background:#FFFFFF;
        margin-left:15px;
        border-radius:5px;

    }
    .dash_desk>div>div>p{
    background:#EFEFEF;
    padding:5px 10px 5px 10px;
    }
    .dash_desk>div>div>h3{
        font-size:46px;
        font-weight:600;
    }
    .dash_desk>div>div>span{

    }
    .box{
        border:none !important;
        color:#000;
    }
    .box-header{
        padding-top: 30px;
    }
    .fc-widget-header{
        background:#A0670F;
        color:#000;
    }
    .box-title{
        text-align: center;

    }
    .box-title>img{
      width:30px !important;
      margin-left: 30px;
    }


    .project_table {
        border-collapse: initial !important;
        padding:3px;
        text-align:center;
    }
    .project_table th{
        color:#FBC525 !important;
    }

    .project_table td,th{
        border:1px solid #F2E8DA;
        margin:3px;
        padding:5px;
        background:#FFF;
    }
    .withIn{
        width:200px;
        float:left;
        text-align:center;
    }
    .percentCalls{
        position: absolute;
        z-index: 100;
        font-weight: bolder;
        margin-top: -77px;
        margin-left: -18px;
    }
    .bts_dropdown{
        position:absolute !important;

    }
    .team_group_span{
        float: right;
        left: 500px;
        margin-top: -56px;
        position: absolute;
    }
    .select2-selection__choice {
    background-color: #9f6906 !important;
    border-color: #9f6906 !important;
    }
    .select2{
        width:250px !important;
    }
    .daterangepicker td.in-range {
        background-color: #9f69061a !important;
    }
    .daterangepicker td.active, .daterangepicker td.active:hover {
        background-color: #9f6906 !important;
    }
    .btn-primary{
        background-color: #9f6906 !important;
    }
    .daterangepicker .ranges li.active {
        background-color: #9f6906 !important;
        border-radius:10px;
    }
    .daterangepicker .ranges li:hover {
        background-color: #e0d1b3 !important;
        border-radius:10px;
    }
    .daterangepicker .ranges li{
        color:#B8AB97 !important;
        font-weight:999;
    }
    .daterangepicker .ranges {
        padding-top:20px;
    }
    #reportrange{
        width:300px;
        float:right;
    }
    .dropdown-menu > li > a {
    color: #777 !important;
    }
    .vl{
        border-left:1px solid #CCC;
        height:100px;
        width:0px;
    }
    .editBtn{
        background-color: #9e6900;
        border-radius: 40px;
        color: white;
    }
    .editBtn:hover{
        background-color: #EEE;
    }
    #notiDash{
        height:300px;
        overflow-y:scroll;
    }
    #notiDash::-webkit-scrollbar {
        width: 5px;
        height:3px;
    }

    #notiDash::-webkit-scrollbar-track {
        background: #9e6900;
    }

    #notiDash::-webkit-scrollbar-thumb {
        background: #333;

    }

    #notiDash li{
        border-bottom:1px solid #333 !important;
        margin-bottom:5px;
    }
    #notiDash .active{
    }
    .activityLog label>h2>img{
        width:30px;
        margin-top:-6px;
    }
    .activityLog label>h2{
        font-size:26px;
        text-align:center;
        font:italic bold 20px/30px Georgia, serif;
    }
    .edit-bar{
        width:400px;
        margin-bottom:30px;
        margin-left:350px;
        padding: 4px;
        background: #e2d8ce;
        border-radius: 5px;
        margin-top: 3px;
        -moz-box-shadow: inset 0 0 10px #000000;
        -webkit-box-shadow: inset 0 0 10px #f1d5b9;
        box-shadow: inset 0 0 10px #92887d;
    }
    #activityLogFilter{
        margin-bottom:10px !important;
    }
    .dropdowntree-name{
        background:rgba(244, 244, 244, 0) !important;
    }
    .btn-default{
        background:rgba(244, 244, 244, 0) !important;
    }
    .box{
        background: #f5ebe1 !important;
        box-shadow:none !important;
    }

    .fc-scroller::-webkit-scrollbar{
        height:3px;
        width:4px;
    }
    .fc-scroller::-webkit-scrollbar-track {
        background: #9e6900;
    }

    .fc-scroller::-webkit-scrollbar-thumb {
        background: #333;

    }
    .btn-box-tool{
        margin-top:30px;
    }
    .fc-button{
        background:#EEE !important;
        color:#444 !important;
        border-radius:3px;
    }
    .fc-today {
        background: #ffffff;
    }
</style>
@php
function custom_number_format($n, $precision = 3) {
    if ($n < 1000000) {
        // Anything less than a million
        $n_format = number_format($n);
    } else if ($n < 1000000000) {
        // Anything less than a billion
        $n_format = number_format($n / 1000000, $precision) . ' M';
    } else {
        // At least a billion
        $n_format = number_format($n / 1000000000, $precision) . ' B';
    }

    return $n_format;
}
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css" media="print">
<div id="app">

<div class="modal " id="addEvent" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" type="button">
                    ×
                </button>
                <h4 class="modal-title" id="newDate">
                </h4>
            </div>
            <form action="{{ url(adminPath().'/tasks') }}" method="post">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group @if($errors->has('agent_id')) has-error @endif">
                        <label>
                            {{ trans('admin.agent') }}
                        </label>
                        <select class="form-control select2" data-placeholder="{{ trans('admin.agent') }}" name="agent_id" style="width: 100%">
                            @foreach(App\User::get() as $lead)
                            <option @if($lead->id==auth()->user()->id) selected @endif value="{{ $lead->id }}">
                                {{ $lead->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group @if($errors->has('leads')) has-error @endif">
                        <label>
                            {{ trans('admin.leads') }}
                        </label>
                        <select class="form-control select2" data-placeholder="{{ trans('admin.leads') }}" multiple="" name="leads[]" style="width: 100%">
                            <option>
                            </option>
                            @foreach(@App\Lead::get() as $lead)
                            <option value="{{ $lead->id }}">
                                {{ $lead->first_name.' '.$lead->last_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <input id="dueDate" name="due_date" type="hidden">
                        <!-- /.input group -->
                        <div class="form-group @if($errors->has('task_type')) has-error @endif">
                            <label>
                                {{ trans('admin.task_type') }}
                            </label>
                            <select class="form-control select2" data-placeholder="{{ trans('admin.task_type') }}" name="task_type" style="width: 100%">
                                <option>
                                </option>
                                <option value="call">
                                    {{ trans('admin.call') }}
                                </option>
                                <option value="meeting">
                                    {{ trans('admin.meeting') }}
                                </option>
                                <option value="others">
                                    {{ trans('admin.others') }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group @if($errors->has('description')) has-error @endif">
                            <label>
                                {{ trans('admin.description') }}
                            </label>
                            <textarea class="form-control" name="description" placeholder="{!! trans('admin.description') !!}" rows="6">
                                {{ old('description') }}
                            </textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default btn-flat" data-dismiss="modal" type="button">
                        {{ trans('admin.close') }}
                    </button>
                    <button class="btn btn-success btn-flat" type="submit">
                        {{ trans('admin.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
    <div class="fluid_container">
        <div class="row" width="100%">
            <div class="edit-bar">
            <button class="btn btn-default editBtn"><i class="fa fa-edit"></i></button>
                <div id="reportrange" style="background: #9e6900; color:white; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; min-width: 300px;">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                </div>
            </div>
            <div id="sortableDesk" class="col-md-8">

                <div n="1" id="r1" class="ui-state-default dash_desk">
                    <label><h2><img src="{{url('icon/dashboard.png')}}"/>DASHBOARD</h2>

                    </label>
                    <div>

                        <div class="d-inline">
                            <p >{{ trans('admin.saleD') }}</p>
                            <h3 style="color:#FBC525;">{{ $salesD }}</h3>
                            <span>EGP</span>
                        </div>
                        <div class="d-inline" >
                            <p>{{ trans('admin.saleM') }}</p>
                            <h3 style="color:#69BBBC">{{ $salesM }}</h3>
                            <span>EGP</span>
                        </div>
                        <div class="d-inline">
                            <p>{{ trans('admin.dash_lead') }}</p>
                            <h3 style="color:#317492">{{ $leadsD }}</h3>
                            <span>Customers</span>
                        </div>
                        <div class="d-inline">
                            <p>{{ trans('admin.customer_number') }}</p>
                            <h3 style="color:#E12F4F">{{ $leads }}</h3>
                            <span>Customers</span>
                        </div>
                        @if(auth()->user()->type == 'admin')
                        <div class="d-inline">
                            <p>{{ trans('admin.inventory_value') }}</p>
                            <h3 style="color:##02562D">{{ custom_number_format($inventory,2) }}</h3>
                            <span>EGP</span>
                        </div>
                        @endif
                        <br>

                    </div>
                </div>

                <div n="2" id="r2" class="ui-state-default dash_desk">
                    <label><h2><img src="{{url('icon/project.png')}}"/>PROJECT</h2></label>
                    <div class="row"></div>
                        <div class="col-xs-2">
                        <table class="project_table">
                        <tr>
                            <th>Project</th>
                            <th>Leads</th>
                        </tr>
                        @foreach($projects as $project)
                        <tr>
                            <td>{{substr($project->en_name, 0, 8)}}</td>
                            <td>{{$project->request_count}}</td>
                        </tr>
                        @endforeach
                        <tr><td>.</td><td>..</td></tr>
                        <tr style="display: none;">
                        <td style="background:red;font-weight:900;">Total</td>
                        <td style="background:red;font-weight:900;">{{$projectSum}}</td>
                        </tr>
                        </table>
                        </div>
                        <div class="col-xs-10">
                            <canvas id="ChartProject" width="200" height="100"></canvas>
                        </div>
                </div>
                <div n="3" id="r3" class="ui-state-default dash_desk">
                    <label><h2><img src="{{url('icon/leads-sources.png')}}"/>LEADS SOURCES</h2></label>
                    <div class="row"></div>
                    <div class="col-md-5 col-xs-12"><canvas  id="graphSources" ></canvas></div>
                    @if(auth()->user()->type=='admin' or \App\Group::where('team_leader_id',auth()->user()->id)->count() >0)
                    <div class="vl col-md-2"></div>
                    <div class="col-md-5 col-xs-12"><canvas  id="graphTeamSources" ></canvas></div>
                    @endif
                </div>

                <div n="4" id="r4" class="ui-state-default dash_desk">
                    <label>
                    <h2><img src="{{url('icon/call.png')}}"/>CALLS BY CALL STATUS</h2>
                    @if(auth()->user()->type=='admin' or \App\Group::where('team_leader_id',auth()->user()->id)->count() >0)
                    <span class="team_group_span">
                    <div class="dropdown dropdown-tree" id="callStatus"></div>
                    </span>
                    @endif
                    </label>

                    <div class="row">

                    </div>
                    <span id="callStatusPlace">
                    @php($sumCalls=0)
                    @foreach($callStatus as $c)
                        <div class="withIn"><canvas id="calla{{$c->id}}" ></canvas><span class="percentCalls" id="spancalla{{$c->id}}"></span></div>
                        @php($sumCalls+=$c->calls_count)
                    @endforeach
                    <?php if($sumCalls==0)$sumCalls=1; ?>
                    </span>
                </div>
                <div n="5" id="r5" class="ui-state-default dash_desk">
                    <label><h2><img src="{{url('icon/project.png')}}"/>ACTION PROJECTS</h2></label>
                    <div class="row"></div>
                        <div class="col-xs-2">
                        <table class="project_table">
                        <tr>
                            <th>Project</th>
                            <th>Calls</th>
                            <th>Meetings</th>
                        </tr>
                        @foreach($proMeetingCall['calls'] as $k=>$project)
                        <tr>
                            <td>{{substr($project['project'], 0, 8)}}</td>
                            <td>{{$project['count']}}</td>
                            <td>{{$proMeetingCall['meetings'][$k]['count']}}</td>
                        </tr>
                        @endforeach
                        <tr><td>.</td><td>..</td><td>..</td></tr>
                        <tr style="display: none;">
                        <td style="background:red;font-weight:900;">Total</td>
                        <td style="background:red;font-weight:900;">{{$projectSum}}</td>
                        </tr>
                        </table>
                        </div>
                        <div class="col-xs-10">
                            <canvas id="ChartProCallMeetings" width="150" height="100"></canvas>
                        </div>
                </div>

            </div>

            <div class="col-md-4 activityLog" style="background:#F6ECE2;">

                @if(auth()->user()->type=='admin')
                <label><h2><img src="{{url('icon/Activity-log.png')}}"/>Activity Log</h2>
                <div style="margin-left:0px;padding-bottom:3px;" class="cal-xs-4">
                    <div class="dropdown dropdown-tree" id="ActivityLogFilter"></div>
                </div>
                @if(count($notEarly) > 0)
                    <ul id="notiDash" class="admin-noti" style="list-style: none">

                    </ul>
                @endif
                @endif
                <div class="your_calendar @if(auth()->user()->type=='admin' or count(\App\Group::where('team_leader_id',auth()->user()->id)->get())>0) @endif">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><img src="{{url('icon/calendar.png')}}"/> {{ trans('admin.your_calendar') }}</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <div id="calendar2"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                 </div>

                @if(auth()->user()->type=='admin' or count(\App\Group::where('team_leader_id',auth()->user()->id)->get())>0)
                <div class="row"><a type="button" style="float: left;margin-left: 60%;color: #9e6900;"  data-toggle="modal" data-target="#myModal"><img width="30" src="{{url('/icon/event.png')}}"/>BroadcastEvent</a></div>
                <div class="team_calendar @if(auth()->user()->type=='admin' or count(\App\Group::where('team_leader_id',auth()->user()->id)->get())>0) @endif">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><img src="{{url('icon/calendar.png')}}"/> {{ trans('admin.team_calendar') }}</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <div id="calendar1"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                 </div>
                @endif

            </div>
        </div>
    </div>
</div>



    <div class="container">
            <!-- Trigger the modal with a button -->


            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">BroadcastEvent</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group @if($errors->has('date')) has-error @endif ">
                        <label>{{ trans('admin.date') }}</label>
                        <div class="input-group">
                            <input class="form-control datetimepicker1" placeholder="Date"data-format="dd/MM/yyyy hh:mm:ss"  name="date_event" type="text" value="" id="data_event">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('title_event')) has-error @endif">
                        <label>{{ trans('admin.title') }}</label>
                            <input class="form-control" placeholder="title"  name="title_event" type="text" value="" id="title_event">
                    </div>
                    <div class="form-group @if($errors->has('description')) has-error @endif">
                        <label>{{ trans('admin.description') }}</label>
                        <textarea placeholder="Description" rows="5" name="description_event" cols="50" class="form-control" id="description_event"></textarea>
                        {{-- {!! Form::textarea('description','',['class' => 'form-control', 'placeholder' => trans('admin.description'),'rows'=>5]) !!} --}}
                    </div>
                    <div class="form-group @if($errors->has('team_select_event')) has-error @endif">
                        <label>{{ trans('admin.team_select') }}</label>
                        @if(auth()->user()->type =='admin')
                        <select multiple class="form-control select2" id="team_select_event"  name="team_select_event[]" style="width: 100%"
                                data-placeholder="{{ trans('admin.team_select') }}">
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}" data-parent="{{$group->parent_id}}">{{$group->name}}</option>
                                @endforeach
                        </select>
                        @endif
                    </div>

                        <div class="form-group @if($errors->has('member_select_event')) has-error @endif"id="member_select_even" style="display: none;">
                            <label>{{ trans('admin.member_select') }}</label>
                            <select multiple class="form-control select2" id="member_select_event"  name="member_select_event[]" style="width: 100%"
                                    data-placeholder="{{ trans('admin.member_select') }}">
                                        <option value="" data-parent=""></option>
                            </select>
                        </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-info test_event" name="button" id="send_event">Send</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>

            </div>
            </div>

    </div>

    @if($event_note)
        @foreach ($event_note as  $value_event)
            <div class="alert"  role="alert">
                    <div data-notify="container" class="col-xs-11 col-sm-4 alert animated fadeInUp" role="alert" data-notify-position="bottom-left" style="background: rgba(204, 204, 204, 0.8);display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; bottom: 20px; left: 20px;">
                        <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                            <span data-notify="title"><strong> <div class="form-check">
                            {{-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> --}}
                        <div class="col-xs-12">
                            <label class="form-check-label" for="exampleCheck1">{{$value_event->title_event_en}}</label>
                        </div>
                                {{-- <div id="mesage_event" ></div> --}}

                    <div class="col-xs-12">
                        <span data-notify="message">{{$value_event->description_event_en}}</span><a href="#" target="_blank" data-notify="url"></a>
                    </div>

                            </div></strong></span>
                            <div>
                                <input type="hidden" name="value_user_id" id="value_user_id" value="{{Auth()->User()->id}}">
                            <button type="button" class="btn btn-success" id="send_note_accept" value="1" name="button_accept">Accept</button>
                            <button type="button" class="btn btn-danger"id="send_note_declind" value="0" name="button_declined">Declined</button>
                            </div>
                    </div>
            </div>
        @endforeach
    @endif
@endsection
@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>

$(document).on('click','#send_note_accept',function(){
         // alert('test');
         var user_id  = $('#value_user_id').val();
         var accept   = $('#send_note_accept').val();
         // var declined =$('input[name=button_declined]').val();
         var _token = '{{ csrf_token() }}';
         var data ={
             'user_id':user_id,
             '_token':_token,
             'accept':accept
     };
     console.log(data);
     $.ajax({
         url: "{{url(adminPath().'/send_note')}}"+'/'+ user_id,
         method: 'POST',
         data: data,
         success: function (data) {
             console.log(data);
             alertify.success('Event Accept');
             $('.alert').hide();
         }
     });

});
       $(document).on('click','#send_note_declind',function(){
                var user_id  = $('#value_user_id').val();
                var declind   = $('#send_note_declind').val();
                var _token = '{{ csrf_token() }}';
                var data ={
                    'user_id':user_id,
                    '_token':_token,
                    'accept':declind
            };
            console.log(data);
            $.ajax({
                url: "{{url(adminPath().'/send_note')}}"+'/'+ user_id,
                method: 'POST',
                data: data,
                success: function (data) {
                    console.log(data);
                    alertify.error('Event Declined');
                    $('.alert').hide();


                }
            });

       });

    var editbtn=0;
    @if(!$orderDesk)
    var order = ["r1", "r2", "r3", "r4","r5"];
    @else
    var order = {!! $orderDesk !!};
    @endif
    var el = $('#sortableDesk');
    var map = {};

    $('#sortableDesk>div').each(function() {
        var el = $(this);
        map[el.attr('id')] = el;
    });

    for (var i = 0, l = order.length; i < l; i ++) {
        if (map[order[i]]) {
            el.append(map[order[i]]);
        }
    }

    $(".editBtn").on('click',function(){
        if(editbtn==0){
            editbtn=1;
            $(this).html('<i class="fa fa-pencil" aria-hidden="true"></i>');
            $("#sortableDesk > div").hover(function(){
                $(this).css('cursor','move');
            });
            $(this).css('background','#EEE');
                $('#sortableDesk').sortable({
                axis: "y",
                cursor: "move",
                distance: 0,
                opacity: 0.5,
                });
        }else{
            editbtn=0;
            $(this).html('<i class="fa fa-edit" aria-hidden="true"></i>');
            $(this).css('background','#9e6900');
            $("#sortableDesk > div").hover(function(){
                $(this).css('cursor','auto');
            });


            axios.post('{{url(adminPath()."/edit_dashboard")}}',
            {
                type:"deskEdit",
                data:$('#sortableDesk').sortable("toArray"),
            }
            ).then(function(response){
               console.log(response);
            })
            .catch(function(err){
                console.log(err);
            });
            $('#sortableDesk').sortable("destroy");

        }
    });


    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
      window.location = "{{url(adminPath())}}"+"?startDate="+picker.startDate.format('YYYY-MM-DD')+"&endDate="+picker.endDate.format('YYYY-MM-DD');
    });
    </script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
            <script>
        var start = moment("{{$startDate}}");
        var end = moment("{{$endDate}}");

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        $(function() {
            $('#reportrange').daterangepicker({
            opens: "left",
            startDate: start,
            endDate: end,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
               'This year': [moment().startOf('year'), moment().endOf('year')],
               'Last year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                }
                }, cb);
            });

        cb(start, end);
        setTimeout(function(){
        $('.datetimepicker1').datetimepicker({
                language: 'pt-BR'
                });
            }, 100);

        $(function() {
            $("#e1").daterangepicker({
                initialText : 'Select period...',
                datepickerOptions : {
    				    numberOfMonths : 2
    				}
            });
        });
    </script>
<script src="{{url('js/Chart.bundle.min.js')}}"></script>
<script src="{{url('js/Chart.min.js')}}"></script>
<!-- <script src="{{url('js/transition.min.js')}}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-deferred@1"></script>
<!--<script src="{{url('js/randomColor.js')}}"></script> -->
<script src="{{url('js/dropdowntree.js')}}"></script>
<script>
    axios.post('{{url(adminPath()."/get_activity")}}',
    {users:null}
    ).then(function(response){
        $("#notiDash").html(response.data);
    })
    .catch(function(err){
        console.log(err);
    });

var data = [
    @if(\App\Group::where('team_leader_id',auth()->user()->id)->count() > 0 && auth()->user()->type!='admin')
        @foreach($groups as $group)
            @if($group->team_leader_id==auth()->user()->id)
            {
                title:"{{$group->name}}",href:"javascript:void(null)",dataAttrs:[{title:"parent",data:"{{$group->parent_id}}"},
            ],
                data:[
                            @foreach($group->groupMembers as $member)
                            {
                            title:"{{$member->member->name}}",href:"javascript:void(null)",dataAttrs:[
                                {title:"parent",data:"{{$member->group_id}}"},
                                {title:"user_id",data:"{{$member->member->id}}"},
                                ],
                            },
                            @endforeach
                        ]
                }
             ,
            @endif
        @endforeach
    @else
    @foreach($groups as $group)
        @if(count($group->children)>0)
        {title:"{{$group->name}}",href:"javascript:void(null)",dataAttrs:[{title:"parent",data:"{{$group->parent_id}}"},
        ],
            data:[
                    @foreach($group->children as $child)
                    {
                    title:"{{$child->name}}",href:"javascript:void(null)",dataAttrs:[{title:"parent",data:"{{$child->parent_id}}"},{title:"user_id",data:"{{$group->team_leader_id}}"}],
                        data:[
                        @foreach($child->groupMembers as $member)
                        {
                        title:"{{@$member->member->name}}",href:"javascript:void(null)",dataAttrs:[
                            {title:"parent",data:"{{$member->group_id}}"},
                            {title:"user_id",data:"{{@$member->member->id}}"},
                            ],
                        },
                        @endforeach
                        ]
                        }
                    ,
                    @endforeach
                    ]
            }
            ,
            @endif
    @endforeach
    @endif
    ];
    var options = {
        title : "Teams",
        data: data,
        maxHeight: 3000,
        selectChildren : true,
        clickHandler: function(element){

        },
        checkHandler: function(element){
            var d = $("#callStatus").GetSelected();
            var users=[];
            $.each(d, function(){
                    users.push($(this).data('user_id'));

            });
            axios.post('{{url(adminPath()."/get_dashboard_callstatus")}}',
            {users:users,startDate:"{{$startDate}}",endDate:"{{$endDate}}"}
            ).then(function(response){
                console.log(response.data);
                callStatus(response.data);
            })
            .catch(function(err){
                console.log(err);
            });
        },
        closedArrow: '<i class="fa fa-caret-right" aria-hidden="true"></i>',
        openedArrow: '<i class="fa fa-caret-down" aria-hidden="true"></i>',
        multiSelect: true,
    }


$("#callStatus").DropDownTree(options);
var options = {
        title : "Teams",
        data: data,
        maxHeight: 3000,
        selectChildren : true,
        clickHandler: function(element){
            return false;
        },
        checkHandler: function(element){
            var d = $("#ActivityLogFilter").GetSelected();
            var users=[];
            $.each(d, function(){
                    users.push($(this).data('user_id'));

            });
            axios.post('{{url(adminPath()."/get_activity")}}',
            {users:users}
            ).then(function(response){
                $("#notiDash").html(response.data);
            })
            .catch(function(err){
                console.log(err);
            });
        },
        closedArrow: '<i class="fa fa-caret-right" aria-hidden="true"></i>',
        openedArrow: '<i class="fa fa-caret-down" aria-hidden="true"></i>',
        multiSelect: true,
    }

$("#ActivityLogFilter").DropDownTree(options);

</script>
<script type="text/javascript">

function callStatus(data2 = null){
    Chart.defaults.global.legend.display=false;
    Chart.defaults.global.title.display=true;
    Chart.defaults.global.title.position="bottom";
    Chart.defaults.doughnut.cutoutPercentage=80;
    $("#callStatusPlace").html('');
    @foreach($callStatus as $k => $c)
    Chart.defaults.global.title.text="{{$c->name}}";

    if(data2){
        var percent=data2[{{$k}}][1]*100/(data2[{{$k}}][0]+data2[{{$k}}][1]);
        if(!percent)percent=0;
        $("#callStatusPlace").append('<div class="withIn"><canvas id="calla{{$c->id}}" ></canvas><span class="percentCalls" id="spancalla{{$c->id}}">'+percent.toFixed(1)+"%"+'</span></div>');
        var ctx = document.getElementById("calla{{$c->id}}");
        data = {
            datasets:[{
                data: data2[{{$k}}],
                backgroundColor:["#6A5A4E","#9E690F"],
                borderWidth:0,
                borderWidth:0,
            }],
        };
    }else{
        $("#callStatusPlace").append('<div class="withIn"><canvas id="calla{{$c->id}}" ></canvas><span class="percentCalls" id="spancalla{{$c->id}}">'+'{{round($c->calls_count*100/$sumCalls, 1)}}'+"%"+'</span></div>');
        var ctx = document.getElementById("calla{{$c->id}}");
        data = {
        datasets: [{
            data: [{{$sumCalls-$c->calls_count}}, {{$c->calls_count}}],
            backgroundColor:["#6A5A4E","#9E690F"],
            borderWidth:0,
            borderWidth:0,
        }],
        };
    }
    var callsChart = new Chart(ctx,{
        type: 'doughnut',
        data: data,
        option:{
            plugins: {
                deferred: {
                    xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                    yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                    delay: 500     // delay of 500 ms after the canvas is considered inside the viewport
                }
            },
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                },

            },
            title: {
                display: true,
                text: 'Custom Chart Title'
            },
        }
    });
    @endforeach
}
callStatus();

Chart.defaults.global.title.display=false;
Chart.defaults.global.legend.display=true;
Chart.defaults.global.defaultFontFamily = "'Roboto', 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif";
Chart.defaults.global.legend.position = 'right';
Chart.defaults.global.legend.labels.usePointStyle = true;
Chart.defaults.global.legend.labels.boxWidth = 15;
Chart.defaults.global.tooltips.backgroundColor = '#000';
isArray = Array.isArray ?
function (obj) {
  return Array.isArray(obj);
} :
function (obj) {
  return Object.prototype.toString.call(obj) === '[object Array]';
};

getValueAtIndexOrDefault = (value, index, defaultValue) => {
    if (value === undefined || value === null) {
    return defaultValue;
    }

    if (this.isArray(value)) {
    return index < value.length ? value[index] : defaultValue;
    }

    return value;
};
var ctx = document.getElementById("graphSources");
var d=[];
var coloR = ['#C0392B', '#F39C12', '#F1C40F',  '#9B59B6',  '#3498DB',  '#16A085', '#95A5A6',  '#273746', '#2ECC71', '#E8DAEF'];
var labels =[];
@foreach($sources as $source)
d.push({{$source->leads_count}});
labels.push("{{$source->name}}");
@endforeach
console.log(coloR);
data = {
    datasets: [{
        data: d,
        backgroundColor:coloR,
        borderWidth: 0,
    }],
    labels:labels,

};
var myPieChart = new Chart(ctx,{
    type: 'pie',
    data: data,
    option:{
        plugins: {
            deferred: {
                xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                delay: 500     // delay of 500 ms after the canvas is considered inside the viewport
            }
        },
        title: {
        display: true,
        text: 'Custom Chart Title',
        },
        legend:{
            display: true,
            position:"right",
            fillStyle:"#FFF",
            labels: {
                fontColor: '#373',

            }
        }
    }
});

Chart.defaults.global.legend.labels.boxWidth = 20;
Chart.defaults.global.legend.labels.fontSize = 10;
@if(auth()->user()->type=='admin' or count(\App\Group::where('team_leader_id',auth()->user()->id)->get())>0)
var ctx = document.getElementById("graphTeamSources");
var d=[];
var coloR = ['#16A085','#95A5A6','#273746','#F1C40F','#9B59B6','#3498DB','#2ECC71','#E8DAEF','#C0392B','#F39C12'];
var labels =[];
@foreach($leadTeamCount as $count)
    d.push({{$count['count']}});
    labels.push("{{substr($count['name'],0,7)}}");
@endforeach
data = {
    datasets: [{
        data: d,
        backgroundColor:coloR,
        borderWidth: 0,
    }],
    labels:labels,

};
var myPieChart = new Chart(ctx,{
    type: 'pie',
    data: data,
    option:{
        plugins: {
            deferred: {
                xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                delay: 500     // delay of 500 ms after the canvas is considered inside the viewport
            }
        },
        title: {
        display: true,
        text: 'Custom Chart Title',
        },
        legend:{
            display: true,
            position:"right",
            fillStyle:"#FFF",
            labels: {
                fontColor: '#373',
            }
        }
    }
});
@endif
var ctx = document.getElementById("ChartProject");
var d=[];
var labels =[];
@foreach($projects as $project)
d.push({{$project->request_count}});
labels.push("{{substr($project->en_name,0,8)}}");
@endforeach
data = {
    datasets: [{
        label: '# of leads',
        data: d,
        borderWidth: 1,
        backgroundColor:"#6A5A4E",
        borderColor:"#6A5A4E",
    }],
    labels:labels,
};
var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,

    options: {
        layout: {
            padding: {
                left: 50,
                right: 0,
                top: 0,
                bottom: 0
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                },
                scaleLabel:{
                    display:true,
                    labelString:"Leads",
                    fontColor:"#F28B18",
                    fontSize:14,
                }
            }],
            xAxes:[{
                gridLines: {
                    display:false,
                    zeroLineWidth: 4,
                },
                scaleLabel:{
                    display:true,
                    labelString:"Top Projects",
                    fontColor:"#F28B18",
                    fontSize:14
                },
                categoryPercentage: 1.0,
                barPercentage:0.1,
            }]
        },
        legend: {
            labels: {
                fontColor: 'black',
            }
        },plugins: {
            deferred: {
                xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                delay: 500     // delay of 500 ms after the canvas is considered inside the viewport
            }
        }
    }
});
var ctx = document.getElementById("ChartProCallMeetings");
var d1=[];
var d2=[];
var labels =[];
@foreach($proMeetingCall['calls'] as $k=>$project)
d1.push({{$project['count']}});
d2.push({{$proMeetingCall['meetings'][$k]['count']}});
labels.push("{{substr($project['project'], 0, 8)}}");
@endforeach
data = {
    datasets: [{
        label: '# of calls',
        data: d1,
        borderWidth: 3,
        backgroundColor:"green",
        borderColor:"green",

    },
    {
        label: '# of meetings',
        data: d2,
        borderWidth: 3,
        backgroundColor:"blue",
        borderColor:"blue",

    }],
    labels:labels,
};
var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,

    options: {
        layout: {
            padding: {
                left: 50,
                right: 0,
                top: 0,
                bottom: 0
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                },
                scaleLabel:{
                    display:true,
                    labelString:"Leads",
                    fontColor:"#F28B18",
                    fontSize:14,
                }
            }],
            xAxes:[{
                gridLines: {
                    display:false,
                    zeroLineWidth: 4,
                },
                scaleLabel:{
                    display:true,
                    labelString:"Top Projects",
                    fontColor:"#F28B18",
                    fontSize:10
                },
                categoryPercentage: 1,
                barPercentage:0.7,
            }]
        },
        legend: {
            labels: {
                fontColor: 'black',
            }
        },plugins: {
            deferred: {
                xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                delay: 500     // delay of 500 ms after the canvas is considered inside the viewport
            }
        }
    }
});
</script>
<script src={{ url("style/fullcalendar/dist/fullcalendar.min.js") }}></script>
<script>

        $(document).on('click', '#send_event', function () {
            var data_event = $('#data_event').val();
            var title_event = $('#title_event').val();
            var team_select_event = $('#team_select_event').val();
            var member_select_event = $('#member_select_event').val();
            var description_event = $('#description_event').val();
            var _token = '{{ csrf_token() }}';
            var data ={
              'date_event':data_event,
              'title_event':title_event,
              'team_select_event':team_select_event,
              'member_select_event':member_select_event,
              'description_event':description_event,
              '_token':_token
            };
            // console.log(data);
            $.ajax({
                url: "{{ url(adminPath().'/send_event')}}",
                method: 'post',
                data:data ,
                success: function (data) {
                    console.log(data.errors);
                    if (data.status =='success' ) {
                        alertify.success('Success creating Event');
                        $('#data_event').val('');
                        $('#title_event').val('');
                        $('#team_select_event').val('');
                        $('#member_select_event').val('');
                        $('#description_event').val('')
                    }
                    else {
                        $(data.errors).each(function( index ) {
                            alertify.error(data.errors['0']);
                        });
                    }
                }
            });
        })

    $('#team_select_event').change(function(){
      $('#member_select_even').show();
         var member =[];
         var member =$('#team_select_event').val();
         if (member == ''){
              $('#member_select_even').hide();
          }
          var _token = '{{ csrf_token() }}';
          $.ajax({
              url: "{{ url(adminPath().'/get_member')}}"+'/'+member,
              method: 'Get',
              data:member,
              success: function (data) {
                  $.each(data, function(key, value){
                      $.each(value.group_members, function(key, group){
                          console.log(group.member.name);
                          $("#member_select_event").append('<option value=' +group.member.id + '>' + group.member.name + '</option>');
                      });
                  });
              }
          });


    });


        $(function () {
            /* initialize the external events
             -----------------------------------------------------------------*/
            function init_events(ele) {
                ele.each(function () {

                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    })

                })
            }

            init_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()
            @if(auth()->user()->type=='admin' or count(\App\Group::where('team_leader_id',auth()->user()->id)->get())>0)
            $('#calendar1').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                },
                //Random default events
                @if(auth()->user()->type=='admin')
                events: [
                        @foreach(@App\Task::get() as $row)
                    {
                        title: '{{ trans("admin.task")."/".@App\User::find($row->agent_id)->name }}',
                        start: '{{ date("Y/m/d",$row->due_date) }}',
                        url: '{{ url(adminPath().'/tasks/'.$row->id) }}',
                        allDay: true,
                        backgroundColor: 'green', //Primary (light-blue)
                        borderColor: '#3c8dbc' //Primary (light-blue)
                    },
                    @endforeach
                ],
                @elseif(count($groups = @\App\Group::where('team_leader_id',auth()->user()->id)->get()) > 0)
                events: [
                        @foreach($groups as $group)
                        @php($users = Home::myTeam($group->id))
                        @foreach($users as $user)
                        @foreach(@App\Task::where('agent_id',$user)->get() as $row)
                    {
                        title: '{{ trans("admin.task")."/".@App\User::find($user)->name }}',
                        start: '{{ date("Y/m/d",$row->due_date) }}',
                        url: '{{ url(adminPath().'/tasks/'.$row->id) }}',
                        allDay: true,
                        backgroundColor: 'green', //Primary (light-blue)
                        borderColor: '#3c8dbc' //Primary (light-blue)
                    },
                    @endforeach
                    @endforeach
                    @endforeach
                ],
                @endif
                editable: false,
                droppable: false, // this allows things to be dropped onto the calendar !!!
                drop: function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject')

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject)

                    // assign it the date that was reported
                    copiedEventObject.start = date
                    copiedEventObject.allDay = allDay
                    copiedEventObject.backgroundColor = $(this).css('background-color')
                    copiedEventObject.borderColor = $(this).css('border-color')

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove()
                    }

                },
                dayClick: function (date, allDay, jsEvent, view) {
                    var end = new Date(date.format('YYYY-M-D')),
                        now = new Date(),
                        diff = new Date(end - now),
                        days = Math.ceil(diff / 1000 / 60 / 60 / 24);
                    if (days >= 0) {
                        var task = '{{ url(adminPath().'/tasks/create?date=') }}' + date.format('YYYY-M-D');
                        var todo = '{{ url(adminPath().'/todos/create?date=') }}' + date.format('YYYY-M-D');
                        $('#task').attr('href', task);
                        $('#todo').attr('href', todo);
                        $('#addEvent').modal({
                            closable  : false,
                            onDeny    : function(){
                                $('.modal').remove();
                            },
                            onApprove : function() {
                                $('.modal').remove();
                            }
                        }).modal('show');
                        $('select[name="agent_id"]').removeAttr('disabled');
                        $('#newDate').html(date.format('YYYY-M-D'));
                        $('#dueDate').val(date.format('YYYY-M-D'));
                    }
                }
            })
            @endif
            $('#calendar2').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                },
                //Random default events
                events: [
                    @foreach(@App\ToDo::where('user_id',auth()->user()->id)->get() as $row)
                    {
                        title: '{{ trans("admin.todo")."/".@App\User::find($row->user_id)->name }}',
                        start: '{{ date("Y/m/d",$row->due_date) }}',
                        url: '{{ url(adminPath().'/todos/'.$row->id) }}',
                        allDay: true,
                        backgroundColor: '#3c8dbc', //Primary (light-blue)
                        borderColor: '#3c8dbc' //Primary (light-blue)
                    },
                    @endforeach
                    @foreach(@App\Task::where('agent_id',auth()->user()->id)->orWhere('agent_id',auth()->user()->id)->get() as $row)
                    {
                        title: '{{ trans("admin.task")."/".@App\User::find($row->agent_id)->name }}',
                        start: '{{ date("Y/m/d",$row->due_date) }}',
                        url: '{{ url(adminPath().'/tasks/'.$row->id) }}',
                        allDay: true,
                        backgroundColor: 'green', //Primary (light-blue)
                        borderColor: '#3c8dbc' //Primary (light-blue)
                    },
                    @endforeach
                ],
                editable: false,
                droppable: false, // this allows things to be dropped onto the calendar !!!
                drop: function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject')

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject)

                    // assign it the date that was reported
                    copiedEventObject.start = date
                    copiedEventObject.allDay = allDay
                    copiedEventObject.backgroundColor = $(this).css('background-color')
                    copiedEventObject.borderColor = $(this).css('border-color')

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove()
                    }

                },
                dayClick: function (date, allDay, jsEvent, view) {
                    var end = new Date(date.format('YYYY-M-D')),
                        now = new Date(),
                        diff = new Date(end - now),
                        days = Math.ceil(diff / 1000 / 60 / 60 / 24);
                    if (days >= 0) {
                        var task = '{{ url(adminPath().'/tasks/create?date=') }}' + date.format('YYYY-M-D');
                        var todo = '{{ url(adminPath().'/todos/create?date=') }}' + date.format('YYYY-M-D');
                        $('#task').attr('href', task);
                        $('#todo').attr('href', todo);

                        $('#addEvent').modal('show');
                        $('select[name="agent_id"]').attr('disabled','disabled');
                        $('#newDate').html(date.format('YYYY-M-D'));

                        $('#dueDate').val(date.format('YYYY-M-D'));
                    }
                }
            })


            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
            //Color chooser button
            var colorChooser = $('#color-chooser-btn')
            $('#color-chooser > li > a').click(function (e) {
                e.preventDefault()
                //Save color
                currColor = $(this).css('color')
                //Add color effect to button
                $('#add-new-event').css({'background-color': currColor, 'border-color': currColor})
            })
            $('#add-new-event').click(function (e) {
                e.preventDefault()
                //Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }

                //Create events
                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event')
                event.html(val)
                $('#external-events').prepend(event)

                //Add draggable funtionality
                init_events(event)

                //Remove event from text input
                $('#new-event').val('')
            })

        })


</script>

@endsection
