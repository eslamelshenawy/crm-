@extends('admin.index')

@section('style')
    <style>
        .subDetail{
            font-weight: bold;
            margin-bottom: 15px;
        }
        .subDetail span{
            background: #000;
            border-radius: 14px;
            padding: 8px 20px 6px 20px;
            color: white;
            margin-left: 8px;
            cursor: pointer;
        }
        .subDetail span>i{
            background: #f70e0e;
            border-radius: 6px;
            padding: 5px 8px 4px 8px;
            color: white;
            text-align: center;
            margin-left: 10px;
        }

        .modal-backdrop.in {
    /* filter: alpha(opacity=50); */
    /* opacity: 1; */
}
    </style>
@endsection

@php
  $agents_options = '';
  foreach(@App\User::get() as $agent){
    $agents_options .= '<option value="'. $agent->id .'">'. $agent->name .'</option>';
  }
@endphp

@section('content')
    <div class="filter"  id="vue-panel">
        <i class="fa fa-times card-font-icon" @click="closeHint()" title="Close"></i>
        <i class="fa fa-trash card-font-icon pull-right" @click="testClick()"></i>
        <i class="fa fa-cloud card-font-icon pull-right" @click="searchCloud()"></i>
        <div class="card-wrapper">
            <div class="card-icon">
                <img v-if="leadImage" :src="l_image" class="card-image" >
                <div v-if="!leadImage && l_nameChars" class="card-image-right characters-image" >@{{ l_nameChars }}</div>
            </div>
            <div class="card-content">
                <h4 > @{{ full_name }}</h4>
                <i class="fa fa-trash-alt pull-right" ></i>

                <i class="fa fa-phone card-font-icon" @click="switchPhone()" ></i>
                <label v-text="phone" v-show="showPhone"></label> | <i class="fa fa-envelope card-font-icon" @click="switchEmail()"></i>
                <label v-text="email" v-show="showEmail"></label> | <i class="fa fa-bell card-font-icon" ></i>
                <a :href="more_url" class="btn btn-default pull-right" style="background-color:#f5f5f5">More</a>
            </div>
        </div>

        <hr>
        <div class="row" style="margin-bottom: 50px;">
            <div class="col-md-2">
                <div class="card-icon-chars">
                    <img id="9666" v-if="residencialAgentImage" :src="r_agent_image" class="card-image-right" >
                    <div id="9555" v-if="!residencialAgentImage && r_nameChars" class="card-image-right characters-image" >@{{ r_nameChars }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div >
                    <h4 v-if="residencialAgentName" style="color: #724a03;">@{{ residencialAgentName }}</h4>
                    <p v-if="residencialAgentType" style="line-height: 19px; color :#e28824;">@{{ residencialAgentType }}</p>
                    <p v-if="residencialAgentName"  style="line-height: 10px; color :#e28824;">Residencial</p>
                </div>
            </div>

            <div class="col-md-2">
                <div class="card-icon-chars">
                    <img v-if="commercialAgentImage" :src="c_agent_image" class="card-image-right" >
                    <div v-if="!commercialAgentImage && c_nameChars" class="card-image-right characters-image" >@{{ c_nameChars }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <h4 v-if="commercialAgentName">@{{ commercialAgentName }}</h4>
                <p  v-if="commercialAgentType"  style="line-height: 10px;">@{{ commercialAgentType }}</p>
                <p v-if="commercialAgentName"  style="line-height: 10px;">Commercial</p>
            </div>
            <!-- <div class="card-wrapper">
                <div class="card-icon">
                    <img src="{{ asset('images/img_1.png') }}" class="card-image" >
                </div>
                <div class="card-content">
                    <h4 > @{{ full_name }}</h4>
                    <i class="fa fa-phone card-font-icon" @click="switchPhone()" ></i> <label v-text="phone" v-show="showPhone"></label> | <i class="fa fa-envelope card-font-icon" @click="switchEmail()"></i> <label v-text="email" v-show="showEmail"></label> | <i class="fa fa-trash card-font-icon" ></i>
                </div>
            </div>
            <div class="card-wrapper">
                <div class="card-icon">
                    <img src="{{ asset('images/img_1.png') }}" class="card-image" >
                </div>
                <div class="card-content">
                    <h4 > @{{ full_name }}</h4>
                    <i class="fa fa-phone card-font-icon" @click="switchPhone()" ></i> <label v-text="phone" v-show="showPhone"></label> | <i class="fa fa-envelope card-font-icon" @click="switchEmail()"></i> <label v-text="email" v-show="showEmail"></label> | <i class="fa fa-trash card-font-icon" ></i>
                </div>
            </div> -->
        </div>

        <div class="box" id="actions-accordion">
            <div class="box-header with-border">
                <h3 class="box-title" style="font-weight: 700 !important;">{{ trans('admin.actions') }}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div id="accordion" class="panel-group">

                    <div class="panel panel-default">
                        <div id='headingCall' class="actionTab panel-title">
                        <label style="font-weight: 300 !important; ">{{ trans('admin.add_call') }}<button type="button"  style="margin-left: 311px;" id="add_call_btn" class="btn btnCol" data-toggle="collapse" data-target="#add_call" aria-expanded="true" aria-controls="add_call">+</button></label>
                        </div>
                        <div class="collapse" id="add_call" aria-labelledby="headingCall" data-parent="#accordion">
                            <form  method="post">
                            <input type="hidden" name="lead_id" value="{{ $show->id }}">
                            <div class="form-group cc-selector @if($errors->has('phone_in_out')) has-error @endif">
                                <label>{{ trans('admin.phone_in_out') }}</label>
                                <br><br>
                                <input checked="checked" @change="radioChanged('in')" id="inGoing" type="radio" name="phone_in_out" value="in" />
                                <label class="drinkcard-cc inGoing" for="inGoing"></label>
                                <input id="outGoing" @change="radioChanged('out')" type="radio" name="phone_in_out" value="out" />
                                <label class="drinkcard-cc outGoing" for="outGoing"></label>
                            </div>
                            <div class="form-group @if($errors->has('contact_id')) has-error @endif" id="contact">
                                <label>{{ trans('admin.contact') }}</label>
                                <select  name="contact_id" class="form-control select2" id="contact_id" style="width: 100%"
                                        data-placeholder="{{ trans('admin.contact') }}">
                                    <option value="0">{{ trans('admin.lead') }}</option>
                                    @foreach(@\App\Contact::where('lead_id', $show->id)->get() as $contact)
                                        <option value="{{ $contact->id }}">
                                            {{ $contact->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group @if($errors->has('phone')) has-error @endif">
                                <label>{{ trans('admin.phone') }}</label>
                                <select v-model="phoneSelected" name="phone" class="form-control" id="phone" style="width: 100%" data-placeholder="{{ trans('admin.phone') }}">
                                    <option v-for="option of optionPhones" v-bind:value="option.value">@{{ option.text }}</option>
                                </select>
                            </div>

                            <div class="form-group @if($errors->has('call_status_id')) has-error @endif">
                                <label>{{ trans('admin.call_status') }}</label>
                                <select class="form-control select2" name="call_status_id" id="callStatus" data-placeholder="{{ __('admin.call_status') }}" style="width: 100%">
                                    <option></option>
                                    @foreach(@\App\CallStatus::get() as $status)
                                        <option value="{{ $status->id }}" next="{{ $status->has_next_action }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <span id="nextAction"></span>

                            <div class="form-group @if($errors->has('duration')) has-error @endif">
                                <label>{{ trans('admin.duration') }}</label>
                                <input name='duration' type="number" class='form-control' placeholder="{{ trans('admin.duration') }}" id="callduration">
                            </div>


                            <div class="form-group @if($errors->has('date')) has-error @endif">
                                <label>{{ trans('admin.date') }}</label>
                                <div class="input-group">
                                    <input placeholder="Date" id="call_date" readonly="readonly" name="date" type="text" value="" class="form-control datepicker">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('probability')) has-error @endif">
                                <label>{{ trans('admin.probability') }}</label>
                                <select class="form-control select2" id="callprobability" name="probability" style="width: 100%" data-placeholder="{{ __('admin.probability') }}">
                                    <option value=""></option>
                                    <option value="highest">{{ __('admin.highest') }}</option>
                                    <option value="high">{{ __('admin.high') }}</option>
                                    <option value="normal">{{ __('admin.normal') }}</option>
                                    <option value="low">{{ __('admin.low') }}</option>
                                    <option value="lowest">{{ __('admin.lowest') }}</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>{{ trans('admin.budget') }}</label>
                                <div class="input-group">
                                    <input placeholder="Budget" id="callbudget" name="budget" type="number" value="" class="form-control">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                </div>
                            </div>



                            <div class="form-group @if($errors->has('projects')) has-error @endif">
                                <label>{{ trans('admin.projects') }}</label>
                                <select multiple id="callprojects" class="form-control select2" name="projects[]" style="width: 100%"
                                        data-placeholder="{{ trans('admin.projects') }}">
                                    <option></option>
                                    @foreach(@\App\Project::get() as $project)
                                        <option value="{{ $project->id }}">{{ $project->{app()->getLocale().'_name'} }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group @if($errors->has('description')) has-error @endif">
                                <label>{{ trans('admin.description') }}</label>
                                <textarea placeholder="Description" rows="5" name="description" cols="50" class="form-control" id="calldescription"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-success btn-flat"
                                        id="addAction">{{ trans('admin.next_action') }}</button>
                                <button type="button" class="btn btn-danger btn-flat hidden"
                                        id="removeAction">{{ trans('admin.remove') . ' ' . trans('admin.next_action') }}</button>
                            </div>
                            <br/>
                            <button type="button" @click.prevent="addCall()" class="btn btn-primary btn-flat">{{ trans('admin.submit') }}</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="panel panel-default">
                    <div id='headingMeet' class="actionTab panel-title">
                             <label style="font-weight: 300 !important; ">{{ trans('admin.add_meeting') }}<button type="button" id="add_meeting_btn" style="margin-left: 279px;"  class="btn btnCol" data-toggle="collapse" data-target="#add_meeting" aria-expanded="false" aria-controls="add_meeting">+</button></label>
                    </div>
                        <div class="collapse" id="add_meeting" aria-labelledby="headingMeet" data-parent="#accordion">
                            <form  method="post">
                            <input type="hidden" name="lead_id" id="meetting_lead_id" value="{{ $show->id }}">

                            <div class="form-group @if($errors->has('contact_id')) has-error @endif" id="contact">
                                <label>{{ trans('admin.contact') }}</label>
                                <select name="contact_id" class="form-control select2" id="contact_id" style="width: 100%"
                                        data-placeholder="{{ trans('admin.contact') }}">
                                    <option value="0">{{ trans('admin.lead') }}</option>
                                    @foreach(@\App\Contact::where('lead_id', $show->id)->get() as $contact)
                                        <option value="{{ $contact->id }}">
                                            {{ $contact->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group @if($errors->has('meeting_status_id')) has-error @endif">
                                <label>{{ trans('admin.meeting_status') }}</label>
                                <select class="form-control select2" name="meeting_status_id" id="meetingStatus" data-placeholder="{{ __('admin.meeting_status') }}" style="width: 100%">
                                    <option></option>
                                    @foreach(@\App\MeetingStatus::get() as $status)
                                        <option value="{{ $status->id }}" next="{{ $status->has_next_action }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <span id="MnextAction"></span>

                            <div class="form-group @if($errors->has('duration')) has-error @endif">
                                <label>{{ trans('admin.duration') }}</label>
                                <input class="form-control" placeholder="Duration" name="duration" type="number" value="" id="meetingduration">
                            </div>


                            <div class="form-group @if($errors->has('date')) has-error @endif">
                                <label>{{ trans('admin.date') }}</label>
                                <div class="input-group">
                                    <input class="form-control datepicker" placeholder="Date"  name="date" type="text" value="" id="date_meeting">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>

                            <div class="form-group @if($errors->has('time')) has-error @endif">
                                <label>{{ trans('admin.time') }}</label>
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <input class="form-control" placeholder="time" name="time" type="text" value="" id="time_meeting">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>

                            <div class="form-group @if($errors->has('location')) has-error @endif">
                                <label>{{ trans('admin.location') }}</label>
                                <div class="input-group">
                                    <input class="form-control" placeholder="location"  name="location" type="text" value="" id="location_meeting">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                </div>
                            </div>

                            <div class="form-group @if($errors->has('probability')) has-error @endif">
                                <label>{{ trans('admin.probability') }}</label>
                                <select class="form-control select2" name="probability" id="meetingprobability"  style="width: 100%" data-placeholder="{{ __('admin.probability') }}">
                                    <option></option>
                                    <option value="highest">{{ __('admin.highest') }}</option>
                                    <option value="high">{{ __('admin.high') }}</option>
                                    <option value="normal">{{ __('admin.normal') }}</option>
                                    <option value="low">{{ __('admin.low') }}</option>
                                    <option value="lowest">{{ __('admin.lowest') }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('admin.budget') }}</label>
                                <div class="input-group">
                                    <input placeholder="Budget" id="mettingbudget" name="budget" type="number" value="" class="form-control">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                </div>
                            </div>

                            <div class="form-group @if($errors->has('projects')) has-error @endif">
                                <label>{{ trans('admin.projects') }}</label>
                                <select multiple class="form-control select2" id="meetingprojects"  name="projects[]" style="width: 100%"
                                        data-placeholder="{{ trans('admin.projects') }}">
                                    <option></option>
                                    @foreach(@\App\Project::get() as $project)
                                        <option value="{{ $project->id }}">{{ $project->{app()->getLocale().'_name'} }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group @if($errors->has('description')) has-error @endif">
                                <label>{{ trans('admin.description') }}</label>
                                <textarea placeholder="Description" rows="5" name="description" cols="50" class="form-control" id="meetingdescription"></textarea>

                                {{-- {!! Form::textarea('description','',['class' => 'form-control', 'placeholder' => trans('admin.description'),'rows'=>5]) !!} --}}
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-success btn-flat"
                                        id="MaddAction">{{ trans('admin.next_action') }}</button>
                                <button type="button" class="btn btn-danger btn-flat hidden"
                                        id="MremoveAction">{{ trans('admin.remove') . ' ' . trans('admin.next_action') }}</button>
                            </div>
                            <br/>
                            <button type="submit" @click.prevent="addmeetings()" class="btn btn-primary btn-flat">{{ trans('admin.submit') }}</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="panel panel-default">
                    <div id='headingRequest' class="actionTab panel-title">
                             <label style="font-weight: 300 !important; ">{{ trans('admin.add_request') }}<button type="button" id="add_request_btn" class="btn btnCol" data-toggle="collapse" data-target="#add_request" aria-expanded="false" aria-controls="add_request">+</button></label>
                    </div>
                        <div class="collapse" id="add_request" aria-labelledby="headingRequest" data-parent="#accordion">
                            <div class="">
                                    <form  method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $show->id }}" name="lead">

                                    <div class="row">
                                        <div class="form-group {{ $errors->has('unit_type') ? 'has-error' : '' }} col-md-12">
                                            {!! Form::label(trans('admin.buyer_seller')) !!}
                                            <select class="select2 form-control"  id="buyer_seller" name="buyer_seller" style="width: 100%"
                                                    data-placeholder="{{ trans('admin.type') }}">
                                                <option></option>
                                                <option value="buyer">{{ trans('admin.buyer') }}</option>
                                                <option value="seller">{{ trans('admin.seller') }}</option>

                                            </select>
                                        </div>
                                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }} col-md-6">
                                            <label for="location">{{ trans('admin.location') }}</label>
                                            <select class="select2 form-control" id="location" name="location"
                                                    style="width: 100%"
                                                    data-placeholder="{{ trans('admin.location') }}">
                                                <option></option>
                                                @foreach(@\App\Location::all() as $location)
                                                    <option value="{{ $location->id }}">{{ $location->{app()->getLocale().'_name'} }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group {{ $errors->has('unit_type') ? 'has-error' : '' }} col-md-6">
                                            <label for="unit_type">{{ trans('admin.type') }}</label>
                                            <select class="select2 form-control" id="unit_type" name="unit_type"
                                                    style="width: 100%"
                                                    data-placeholder="{{ trans('admin.type') }}">
                                                <option></option>
                                                <option value="commercial">{{ trans('admin.commercial') }}</option>
                                                <option value="personal">{{ trans('admin.personal') }}</option>
                                                <option value="land">{{ trans('admin.land') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group {{ $errors->has('unit_type_id') ? 'has-error' : '' }} col-md-6">
                                            <label for="unit_type_id">{{ trans('admin.unit_type') }}</label>
                                            <select class="select2 form-control" id="unit_type_id"
                                                    name="unit_type_id"
                                                    style="width: 100%"
                                                    data-placeholder="{{ trans('admin.unit_type') }}">
                                                <option></option>
                                            </select>
                                        </div>

                                        <div class="form-group {{ $errors->has('request_type') ? 'has-error' : '' }} col-md-6">
                                            <label for="request_type">{{ trans('admin.request_type') }}</label>
                                            <select class="select2 form-control" id="request_type"
                                                    name="request_type"
                                                    style="width: 100%"
                                                    data-placeholder="{{ trans('admin.request_type') }}">
                                                <option></option>
                                                <option value="resale">{{ trans('admin.resale') }}</option>
                                                <option value="rental">{{ trans('admin.rental') }}</option>
                                                <option value="new_home">{{ trans('admin.new_home') }}</option>
                                            </select>
                                        </div>

                                    <div id="resale_rental" class="hidden col-md-12">
                                        <div class="form-group col-md-6 @if($errors->has('rooms_from')) has-error @endif">
                                            <label> {{ trans('admin.rooms_from') }}</label>
                                            <input type="number" name="rooms_from" id="rooms_from"
                                                   class="form-control"
                                                   value="{{ old('rooms_from') }}"
                                                   placeholder="{{ trans('admin.from') }}">
                                        </div>
                                        <div class="form-group col-md-6 @if($errors->has('rooms_to')) has-error @endif">
                                            <label> {{ trans('admin.rooms_to') }}</label>
                                            <input type="number" name="rooms_to" id="rooms_to"
                                                   class="form-control"
                                                   value="{{ old('rooms_to') }}"
                                                   placeholder="{{ trans('admin.to') }}">
                                        </div>

                                        <div class="form-group col-md-6 @if($errors->has('bathrooms_from')) has-error @endif">
                                            <label> {{ trans('admin.bathrooms_from') }}</label>
                                            <input type="number" name="bathrooms_from" id="bathrooms_from"
                                                   class="form-control"
                                                   value="{{ old('bathrooms_from') }}"
                                                   placeholder="{{ trans('admin.from') }}">
                                        </div>
                                        <div class="form-group col-md-6 @if($errors->has('bathrooms_to')) has-error @endif">
                                            <label> {{ trans('admin.bathrooms_to') }}</label>
                                            <input type="number" name="bathrooms_to" id="bathrooms_to"
                                                   class="form-control"
                                                   value="{{ old('bathrooms_to') }}"
                                                   placeholder="{{ trans('admin.to') }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 @if($errors->has('price_from')) has-error @endif">
                                        <label> {{ trans('admin.price_from') }}</label>
                                        <input type="number" name="price_from" id="price_from" class="form-control"
                                               value="{{ old('price_from') }}"
                                               placeholder="{{ trans('admin.from') }}">
                                    </div>

                                    <div class="form-group col-md-6 @if($errors->has('price_to')) has-error @endif">
                                        <label> {{ trans('admin.price_to') }}</label>
                                        <input type="number" name="price_to" id="price_to" class="form-control"
                                               value="{{ old('price_to') }}"
                                               placeholder="{{ trans('admin.to') }}">
                                    </div>

                                    <div class="form-group col-md-6 @if($errors->has('area_from')) has-error @endif">
                                        <label> {{ trans('admin.area_from') }}</label>
                                        <input type="number" name="area_from" id="area_from" class="form-control"
                                               value="{{ old('area_from') }}"
                                               placeholder="{{ trans('admin.from') }}">
                                    </div>

                                    <div class="form-group col-md-6 @if($errors->has('area_to')) has-error @endif">
                                        <label> {{ trans('admin.area_to') }}</label>
                                        <input type="number" name="area_to" id="area_to" class="form-control"
                                               value="{{ old('area_to') }}"
                                               placeholder="{{ trans('admin.to') }}">
                                    </div>

                                    {{--<div class="form-group col-md-6 @if($errors->has('price_from')) has-error @endif">--}}
                                    {{--<label> {{ trans('admin.price_from') }}</label>--}}
                                    {{--<input type="number" name="price_from" id="price_from"--}}
                                    {{--class="form-control"--}}
                                    {{--value="{{ old('price_from') }}"--}}
                                    {{--placeholder="{{ trans('admin.from') }}">--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group col-md-6 @if($errors->has('price_to')) has-error @endif">--}}
                                    {{--<label> {{ trans('admin.price_to') }}</label>--}}
                                    {{--<input type="number" name="price_to" id="price_to" class="form-control"--}}
                                    {{--value="{{ old('price_to') }}"--}}
                                    {{--placeholder="{{ trans('admin.to') }}">--}}
                                    {{--</div>--}}

                                    <div class="form-group @if($errors->has('date')) has-error @endif col-md-12">
                                        <label>{{ trans('admin.delivery_date') }}</label>
                                        <div class="input-group">
                                            <input placeholder="Delivery Date" readonly="readonly" id="date" name="date" type="text" value="" class="form-control datepicker2">
                                            {{-- {!! Form::text('date','',['class' => 'form-control', 'placeholder' => trans('admin.delivery_date'),'readonly'=>'','id'=>'date']) !!} --}}
                                            <span class="input-group-addon"><i
                                                        class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>

                                    <div class="form-group @if($errors->has('down_payment')) has-error @endif col-md-12">
                                        <label>{{ trans('admin.down_payment') }}</label>
                                        <input type="number" class="form-control" name="down_payment" id="down_payment"
                                               placeholder="{{ trans('admin.down_payment') }}">
                                    </div>

                                    <div class="form-group @if($errors->has('notes')) has-error @endif col-md-12">
                                        <label> {{ trans('admin.notes') }}</label>
                                        <textarea name="notes" class="form-control" value="{{ old('notes') }}"id="notes"
                                                  placeholder="{!! trans('admin.notes') !!}"
                                                  rows="6"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success btn-flat"
                                                id="getSuggestions">{{ trans('admin.suggestions') }}</button>
                                        <button type="submit"@click.prevent="addrequest()"
                                                class="btn btn-primary btn-flat">{{ trans('admin.submit') }}</button>
                                    </div>
                                </div>
                                </form>
                                <span id="get_suggestions"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-10">
                <h3>Notes</h3>
            </div>
            <div class="col-md-2" style="">
                    <i class="fa fa-pencil card-font-icon pull-right" id="note_show" style="color: #e28824;"></i>
                    {{-- <i class="fa fa-microphone card-font-icon pull-right"style="color: #ae2000;" ></i> --}}
            </div>
            {{-- <div id="allNotes" style="display: none;">
                @foreach(@\App\LeadNote::where('lead_id',$show->id)->orderBy('id')->get() as $note)
                    <div class="well col-md-12">
                        <div class="col-md-2 text-center">
                            <img height="50" width="50"
                                 style="border-radius: 50px; border: 2px solid #caa42d"
                                 src="{{ url('uploads/'.@\App\User::find($note->user_id)->image) }}">
                            <br/>
                            <br/>
                            <span style="color: gray">{{ $note->created_at }}</span>
                        </div>
                        <div class="col-md-10">
                            <p>
                                {{ $note->note }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div> --}}
            <div class="col-md-12" style="display: none;" id="not_view">
                <textarea class="form-control" data-target="#newNote" id="newNote"
                          placeholder="{{ __('admin.notes') }}"></textarea>
                <br/>
                <button @click.prevent="addNote()" type="button" class="btn btn-flat btn-success" data-target="#noteBTN"
                        id="noteBTN">{{ __('admin.add') }}</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <ul id="notesUl" v-if="lead && lead.notes.length > 0">
               <?php
            $tes=\App\LeadNote::where('lead_id',$show->id)->orderBy('id')->get();
                ?>
                {{-- @foreach(@\App\LeadNote::where('lead_id',$show->id)->orderBy('id')->get() as $note)

                @endforeach --}}
                <li v-for="note of lead.notes">
                    <div class="card-wrapper">
                        <div class="card-icon">
                            <img v-if="note.user.image" :src="getUserImage(note.user)" class="card-image" >
                            <div v-if="!note.user.image" class="card-image-right characters-image" >@{{ getUserChars(note.user) }}</div>
                        </div>
                        <div class="card-content">
                            <h4 style="color: rgb(114, 74, 3);">@{{ note.user.name }}</h4>
                            <p   style="line-height: 10px; color: rgb(226, 136, 36);">@{{ note.note }}</p>
                            <p   style="line-height: 10px; color: rgb(226, 136, 36);">@{{ note.date }} by @{{ note.user.name }}</p>
                        </div>
                    </div>
                </li>
                <li v-for="note of lead.voice_notes">
                    <div class="card-wrapper">
                        <div class="card-icon">
                            <img v-if="note.user.image" :src="getUserImage(note.user)" class="card-image" >
                            <div v-if="!note.user.image" class="card-image-right characters-image" >@{{ getUserChars(note.user) }}</div>
                        </div>
                        <div class="card-content">
                            <h4>@{{ note.user.name }}</h4>
                            {{-- <p   style="line-height: 10px;">@{{ 'Voice Note' }}</p> --}}
                            <audio controls preload="none" style="width:300px;">
                                <source :src="getAudioPath(note.note)" type="audio/mp4" />
                                <p>Your browser does not support HTML5 audio.</p>
                            </audio>
                            <p   style="line-height: 10px;">@{{ note.date }} by @{{ note.user.name }}</p>
                        </div>
                    </div>
                </li>

                <!-- <li>
                    <div class="card-wrapper">
                        <div class="card-icon">
                            <img src="{{ asset('images/img_1.png') }}" class="card-image" >
                        </div>
                        <div class="card-content">
                            <h4>Kirolos Alfy</h4>
                            <p>He needs Saleeh in sahel</p>
                            <p>2 days ago by Kirolos Alfy</p>
                        </div>
                    </div>
                </li> -->
            </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11">
                <h3>Calls</h3>
            </div>
            <div class="col-md-1">
                <i class="fa fa-plus card-font-icon pull-right" ></i>
            </div>
        </div>
        <div v-if="lead" >
            <a data-toggle="modal" data-target="#call-popup" style="" >
                 <div class="row" style=" background: linear-gradient(to right ,#b57800a6, #c48200d1); margin-bottom: 30px;" v-for="call of lead.calls">
                <div class="col-md-6" >
                   <p>Date: @{{ formatDate(call.date) }}</p>
                    <p>Probability: @{{ call.probability }}</p>
                </div>
                <div class="col-md-6" >
                    <p>Call Status: @{{ call.call_status.name }}</p>
                    <p>Budget: @{{ call.budget != null? call.budget: '0' }} </p>
                </div>
            </div>
        </a>
        </div>
            <!-- Modal -->
            <div   id="call-popup" class="modal fade"  role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div v-if="lead" class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Call</h4>
                        </div>
                            <div  class="modal-body" v-for="call of lead.calls">
                                <div class="col-md-6" >
                                   <p>Date: @{{ formatDate(call.date) }}</p>
                                    <p>Probability: @{{ call.probability }}</p>
                                </div>
                                <div class="col-md-6" >
                                    <p>Call Status: @{{ call.call_status.name }}</p>
                                    <p>Budget: @{{ call.budget != null? call.budget: '0' }} </p>
                                </div>
                                <div class="col-md-6" >
                                    <p>Phone : @{{ call.phone }}</p>
                                    <p>description : @{{ call.description }}</p>
                                </div>
                                <div class="col-md-6" >
                                    {{-- <p>projects: @{{ call.project_id.en_name }}</p> --}}
                                </div>
                            </div>


                    </div>

                </div>
            </div>
        <div class="row">
            <div class="col-md-11">
                <h3>Meetings</h3>
            </div>
            <div class="col-md-1">
                <i class="fa fa-plus card-font-icon pull-right" ></i>
            </div>
        </div>
        <div v-if="lead" >
            <div class="row" style=" background: linear-gradient(to right ,#b57800a6, #c48200d1); margin-bottom: 30px;" v-for="meeting of lead.meetings">
                <div class="col-md-6" >
                    <p>Date: @{{ formatDate(meeting.date) }} @{{ meeting.time }}</p>
                    <p>Probability: @{{ meeting.probability }}</p>
                </div>
                <div class="col-md-6" >
                    <p>Call Status: @{{ meeting.meeting_status.name }}</p>
                    <p>Budget: @{{ meeting.budget != null? meeting.budget: '0' }} </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11">
                <h3>Requests</h3>
            </div>
            <div class="col-md-1">
                <i class="fa fa-plus card-font-icon pull-right" ></i>
            </div>
        </div>
        <div v-if="lead" >
            <div class="row" style=" background: linear-gradient(to right ,#b57800a6, #c48200d1); margin-bottom: 30px;" v-for="req of lead.requests">
                <div class="col-md-6" >
                    <p>Date: @{{ formatDate(req.date) }}</p>
                    <p>Location: @{{ req.loc.en_name }}</p>
                    <p>Down Payment: @{{ req.down_payment }}</p>
                    <p>Price from: @{{ req.price_from }} TO : @{{ req.price_to }} </p>
                </div>
                <div class="col-md-6" >
                    <p>Unit Type: @{{ req.unit_type.en_name }}</p>
                    {{-- <p>Projects: <span v-for="proj of req.project">@{{ proj.en_name }},</span> </p> --}}
                    <p>Projects: @{{ req.project.en_name }} </p>
                    <p>Area from: @{{ req.area_from }} TO : @{{ req.area_to }} </p>
                    <p>Notes: @{{ req.notes }} </p>
                </div>
            </div>
        </div>
    </div>
    <div class="box" id="contents">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <a class="btn btn-success btn-flat @if(app()->getLocale() == 'en') pull-right @else pull-left @endif"
               href="{{ url(adminPath().'/leads/create') }}">{{ trans('admin.add') }}</a>
            @if(checkRole('export_excel') or @auth()->user()->type == 'admin')
                <a class="btn btn-success btn-flat @if(app()->getLocale() == 'en') pull-right @else pull-left @endif"
                   style="margin: 0 7px" href="{{ url(adminPath().'/xlsrequest') }}">Excel</a>
            @endif
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="@if(!request()->has('team')) active @endif"><a href="#active_leads" data-toggle="tab"
                                                                              aria-expanded="false">{{ trans('admin.my_leads') }}</a></li>
                    @if(@auth()->user()->type == 'admin')
                        <li class=""><a href="#individual_leads" data-toggle="tab"
                                        aria-expanded="true">{{ trans('admin.individual_leads') }}</a></li>
                    @endif
                    @if(auth()->user()->type == 'admin' or @\App\Group::where('team_leader_id', auth()->id())->count())
                        <li class="@if(request()->has('team')) active @endif"><a href="#team_leads" data-toggle="tab"
                                                                                 aria-expanded="true">{{ trans('admin.team_leads') }}</a></li>
                    @endif
                    <li class=""><a href="#hot_leads" data-toggle="tab"
                                    aria-expanded="true">{{ trans('admin.hot') . ' ' . trans('admin.leads') }}</a></li>
                    <li class=""><a href="#fav_leads" data-toggle="tab"
                                    aria-expanded="true">{{ trans('admin.favorite') . ' ' . trans('admin.leads') }}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane @if(!request()->has('team')) active @endif" style="min-height: 650px;" id="active_leads">
                        <button type="button" class="btn btn-info btn-flat" data-toggle="collapse" data-target="#filter" style="margin: 10px 0">{{ __('admin.filter') }}</button>
                        <div id="filter" class="collapse">
                            <div class="form-group col-md-6">
                                <label>{{ trans('admin.from') }}</label>
                                <input type="text" readonly id="dateFrom" name="dateFrom"class="form-control datepicker" placeholder="{{ trans('admin.from') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ trans('admin.to') }}</label>
                                <input type="text" readonly id="dateTo" name="dateTo" class="form-control datepicker" placeholder="{{ trans('admin.to') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{ trans('admin.call_status') }}</label>
                                <select class="form-control " id="callStatus_id" name="callStatus" data-placeholder="{{ trans('admin.call_status') }}" style="width: 100%">
                                    <option></option>
                                    @foreach(@\App\CallStatus::get() as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ trans('admin.meeting_status') }}</label>
                                <select class="form-control " id="meetingStatus_id" name="meetingStatus" data-placeholder="{{ trans('admin.meeting_status') }}" style="width: 100%">
                                    <option></option>
                                    @foreach(@\App\MeetingStatus::get() as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label>{{ trans('admin.location') }}</label>
                                <select class="form-control " id="location_lead" name="location" data-placeholder="{{ trans('admin.location') }}" style="width: 100%">
                                    <option></option>
                                    @foreach(@\App\Location::get() as $location)
                                        <option value="{{ $location->id }}">{{ $location->{app()->getLocale() . '_name'} }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <button class="btn btn-success btn-flat" id="filterLeads">
                                    {{ __('admin.get') }}
                                    <i class="fa fa-spinner fa-spin hidden" id="Spinner"></i>
                                </button>
                            </div>
                        </div>
                        @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                            <a data-toggle="modal" data-target="#switchLead"
                               class="btn btn-success btn-flat switchLeadModal" >{{ trans('admin.switch') }}</a>
                        @endif
                            <div class="col-md-12" id="myLeads_filter">
                            <span class="hidden" id="spanShowHidden" @click.prevent="showHintJQuery()"></span>
                            <div class="subDetail">
                                <span target="facebook">
                                    Facebook
                                    <i >{{$facebook}}</i>
                                </span>
                                <span target="coldCalls">
                                    ColdCalls
                                    <i >{{$coldCalls}}</i>
                                </span>
                                <span target="followUp">
                                    FollowUp
                                    <i >{{$followUp}}</i>
                                </span>
                                <span target="lowest">
                                    Lowest
                                    <i >{{$lowest}}</i>
                                </span>
                                <span target="high">
                                    High
                                    <i >{{$high}}</i>
                                </span>
                                <span target="highest">
                                    Highest
                                    <i >{{$highest}}</i>
                                </span>
                                <span target="switch">
                                    Switched
                                    <i >{{$switch}}</i>
                                </span>
                            </div>
                            {{--<table class="table datatable" >--}}


                            <table class="table datatable table-striped table-bordered " style="width:100%">
                                <thead>
                                <tr>
                                     <th>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="checkAll2">
                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                </label>
                                            </div>
                                        </th>
                                    {{-- <th>{{ trans('admin.id') }}</th> --}}
                                    <th>{{ trans('admin.name') }}</th>
                                    <th>{{ trans('admin.probability') }}</th>
                                    <th>{{ trans('admin.request_location') }}</th>
                                    <th>{{ trans('admin.request_project') }}</th>
                                    @if(Auth()->user()->residential_commercial == 'residential')
                                        <th>{{ trans('admin.lpersonal') .' '.trans('admin.status') }}</th>
                                    @endif
                                    @if(Auth()->user()->residential_commercial == 'commercial')
                                        <th>{{ trans('admin.lscommercial') .' '.trans('admin.status') }}</th>
                                    @endif
                                    <th>{{ trans('admin.type') }}</th>
                                    <th>{{ trans('admin.seen') }}</th>
                                    <th>{{ trans('admin.favorite') }}</th>
                                    <th>{{ trans('admin.hot') }}</th>
                                    <th>{{ trans('admin.option') }}</th>
                                    @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                                        <th>{{ trans('admin.switch') }}</th>
                                    @endif
                                    <th>{{ trans('admin.hint') }}</th>
                                </tr>
                                </thead>
                                <tbody id="myLeads"></tbody>
                            </table>
                        </div>


                    </div>
                    @if(auth()->user()->type == 'admin')
                        <div class="tab-pane" style="min-height: 650px;" id="individual_leads">
                        @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                            <a data-toggle="modal" data-target="#switchLead"
                               class="btn btn-success btn-flat switchLeadModal">{{ trans('admin.switch') }}</a>
                        @endif

                            <table class="table table-hover table-striped datatable1" style="width:100%">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="checkAll">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            </label>
                                        </div>
                                    </th>
                                    {{-- <th>{{ trans('admin.id') }}</th> --}}
                                    <th>{{ trans('admin.name') }}</th>
                                    <th>{{ trans('admin.probability') }}</th>
                                    <th>{{ trans('admin.request_location') }}</th>
                                    <th>{{ trans('admin.request_project') }}</th>
                                    @if(Auth()->user()->residential_commercial == 'residential')
                                        <th>{{ trans('admin.lpersonal') .' '.trans('admin.status') }}</th>
                                    @endif
                                    @if(Auth()->user()->residential_commercial == 'commercial')
                                        <th>{{ trans('admin.lscommercial') .' '.trans('admin.status') }}</th>
                                    @endif
                                    <th>{{ trans('admin.type') }}</th>
                                    <th>{{ trans('admin.seen') }}</th>
                                    <th>{{ trans('admin.favorite') }}</th>
                                    <th>{{ trans('admin.hot') }}</th>
                                    <th>{{ trans('admin.option') }}</th>
                                    @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                                        <th>{{ trans('admin.switch') }}</th>
                                    @endif
                                    <th>{{ trans('admin.hint') }}</th>
                                </tr>
                                </thead>
                            </table>

                        </div>
                    @endif
                    @if(auth()->user()->type == 'admin' or @\App\Group::where('team_leader_id', auth()->id())->count())
                        <div class="tab-pane @if(request()->has('team')) active @endif" style="min-height: 650px;" id="team_leads">
                            <button type="button" class="btn btn-info btn-flat" data-toggle="collapse"  data-target="#Tfilter" style="margin: 10px 0">{{ __('admin.filter') }}</button>
                            <div id="Tfilter" class="collapse">
                                    <div class="form-group col-md-6">
                                        <label>{{ trans('admin.from') }}</label>
                                        <input type="text" readonly id="TdateFrom" name="date_from" class="form-control datepicker" placeholder="{{ trans('admin.from') }}" value="{{ request()->date_from }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ trans('admin.to') }}</label>
                                        <input type="text" readonly id="TdateTo" name="date_to" class="form-control datepicker" placeholder="{{ trans('admin.to') }}" value="{{ request()->date_to }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{ trans('admin.call_status') }}</label>
                                        <select class="form-control " id="TcallStatus" name="call_status" data-placeholder="{{ trans('admin.call_status') }}" style="width: 100%">
                                            <option></option>
                                            @foreach(@\App\CallStatus::get() as $status)
                                                <option value="{{ $status->id }}" @if(request()->call_status == $status->id) selected @endif>{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ trans('admin.meeting_status') }}</label>
                                        <select class="form-control " id="TmeetingStatus" name="meeting_status" data-placeholder="{{ trans('admin.meeting_status') }}" style="width: 100%">
                                            <option></option>
                                            @foreach(@\App\MeetingStatus::get() as $status)
                                                <option value="{{ $status->id }}" @if(request()->meeting_status == $status->id) selected @endif>{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>{{ trans('admin.location') }}</label>
                                        <select class="form-control " id="Tlocation" name="location" data-placeholder="{{ trans('admin.location') }}" style="width: 100%">
                                            <option></option>
                                            @foreach(@\App\Location::get() as $location)
                                                <option value="{{ $location->id }}" @if(request()->location == $location->id) selected @endif>{{ $location->{app()->getLocale() . '_name'} }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>{{ trans('admin.groups') }}</label>
                                        <select class="form-control " id="Groups" name="group_id" style="width: 100%" data-placeholder="{{ __('admin.groups') }}">
                                            <option value="0">{{ __('admin.all') }}</option>
                                            @foreach($groups as $group)
                                                <option value="{{ @$group->id }}" @if(request()->group_id == $group->id) selected @endif>{{ @$group->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>{{ trans('admin.agent') }}</label>
                                        <select class="form-control " id="teamAgent" name="agent_id" style="width: 100%" data-placeholder="{{ __('admin.agent') }}">
                                            <option value="0">{{ __('admin.all') }}</option>
                                            @foreach($Agents as $agent)
                                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="team" value="1">
                                    <div class="form-group col-md-12">
                                        <button class="btn btn-success btn-flat" id="TfilterLeads">
                                            {{ __('admin.get') }}
                                        </button>
                                    </div>
                            </div>
                            @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                                <a data-toggle="modal" data-target="#switchLead"
                               class="btn btn-success btn-flat switchLeadModal" >{{ trans('admin.switch') }}</a>
                            @endif

                            <input type="text" id="searchTeam" placeholder="{{ __('admin.search') }}" class="form-control">
                            <div id="teamData">

                                <table class="table table-hover table-striped datatableTeam  nowrap" style="width:100%" id="teamDataTable">
                                    <thead>
                                    <tr>
                                        <th>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="checkAll_teams">
                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                </label>
                                            </div>
                                        </th>
                                        {{-- <th>{{ trans('admin.id') }}</th> --}}
                                        <th>{{ trans('admin.name') }}</th>
                                        <th>{{ trans('admin.probability') }}</th>
                                        <th>{{ trans('admin.request_location') }}</th>
                                        <th>{{ trans('admin.request_project') }}</th>
                                        @if(Auth()->user()->residential_commercial == 'residential')
                                            <th>{{ trans('admin.personal') .' '.trans('admin.status') }}</th>
                                        @endif
                                        @if(Auth()->user()->residential_commercial == 'commercial')
                                            <th>{{ trans('admin.commerical') .' ' .trans('admin.status') }}</th>
                                        @endif
                                        <th>{{ trans('admin.personal') }} {{ trans('admin.agent') }}</th>
                                        <th>{{ trans('admin.commercial') }} {{ trans('admin.agent') }}</th>

                                        <th>{{ trans('admin.type') }}</th>
                                        {{-- <th>{{ trans('admin.phone') }}</th> --}}
                                        <th>{{ trans('admin.source') }}</th>
                                        <th>{{ trans('admin.option') }}</th>
                                        @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                                            <th>{{ trans('admin.switch') }}</th>
                                        @endif
                                        <th>{{ trans('admin.hint') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="">

                                    @php($commercialAgents = @\App\User::where('residential_commercial', 'commercial')->pluck('id')->toArray())
                                    @php($residentialAgents = @\App\User::where('residential_commercial', 'residential')->pluck('id')->toArray())

                                    @foreach($teams as $lead)
                                      <?php
                                      if ( @\App\Request::where('lead_id', $lead->id)->where('unit_type', 'residential')->where('unit_type', 'commercial')->count() > 0) {
                                          $leadType = __('admin.personal') . ' - ' . __('admin.commercial');
                                      } elseif ( @\App\Request::where('lead_id', $lead->id)->where('unit_type', 'residential')->where('unit_type', '!=', 'commercial')->count() > 0) {
                                          $leadType = __('admin.personal');
                                      } elseif ( @\App\Request::where('lead_id', $lead->id)->where('unit_type', '!=', 'residential')->where('unit_type', 'commercial')->count() > 0) {
                                          $leadType = __('admin.commercial');
                                      } else {
                                          $leadType = __('admin.personal');
                                      }

                                      $type = $leadType;
                                      $lastCall = @\App\Call::where('lead_id', $lead->id)->orderBy('id', 'desc')->first();
                                      $lastMeeting = @\App\Meeting::where('lead_id', $lead->id)->orderBy('id', 'desc')->first();

                                      if (@$lastCall->created_at->timestamp > @$lastMeeting->created_at->timestamp) {
                                          @$leadProbability = $lastCall->probability;
                                      } else {
                                          @$leadProbability = $lastMeeting->probability;
                                      }
                                      if (!$leadProbability) {
                                          $leadProbability = 'normal';
                                      }

                                       ?>
                                        <tr>
                                            <td class="checkbox">
                                                <label>
                                                    <input class="switch_teams" name="checked_leads[]" id="checked_leads" type="checkbox"
                                                           value={{ $lead->id }}>
                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                </label>
                                            </td>
                                            {{-- <td>{{ $lead->id }}</td> --}}
                                            {{-- <td>{{ @App\User::find($lead->agent_id)->name }}</td> --}}
                                            <td>{{ $lead->first_name . ' ' . $lead->last_name }}</td>

                                             <td>{{$leadProbability}}</td>
                                             <?php
                                             $source = '';
                                             $ques = @\App\Request::where('lead_id', $lead->id)->with('loc')->orderBy('created_at', 'desc')->first();
                                             $r = @$ques->loc;
                                             if ($r) {
                                                 $source = $r->en_name;
                                             } else {
                                                 $source = '';
                                             }
                                             ?>
                                             <td>{{$source}}</td>
                                             <td>{{@$ques->project->en_name}}</td>

                                            @if(Auth()->user()->residential_commercial == 'residential')
                                                <td>
                                                    <i class="fa fa-circle" aria-hidden="true" style="@if(DB::table('lead_actions')->whereIn('user_id', $residentialAgents)->where('lead_id',$lead->id)->count() > 0) color:green;@else color:red @endif"></i>
                                                </td>
                                            @endif
                                            @if(Auth()->user()->residential_commercial == 'commercial')
                                                <td>
                                                    <i class="fa fa-circle" aria-hidden="true" style="@if(DB::table('lead_actions')->whereIn('user_id', $commercialAgents)->where('lead_id',$lead->id)->count() > 0) color:green;@else color:red @endif"></i>
                                                </td>
                                            @endif
                                            {{-- <td>
                                                <i class="fa fa-circle" aria-hidden="true" style="@if(DB::table('lead_actions')->whereIn('user_id', $residentialAgents)->where('lead_id',$lead->id)->count() > 0) color:green;@else color:red @endif"></i>
                                            </td>
                                            <td>
                                                <i class="fa fa-circle" aria-hidden="true" style="@if(DB::table('lead_actions')->whereIn('user_id', $commercialAgents)->where('lead_id',$lead->id)->count() > 0) color:green;@else color:red @endif"></i>
                                            </td> --}}
                                            <td>{{ @App\User::find($lead->commercial_agent_id)->name }}</td>
                                            {{-- <td>{{ $lead->first_name . ' ' . $lead->last_name }}</td> --}}
                                            <td>{{ @App\User::find($lead->agent_id)->name }}</td>
                                            <td>
                                            {{ $type}}
                                            </td>
                                            {{-- <td>{{ $lead->phone }}</td> --}}
                                            <td>{{ @App\LeadSource::find($lead->lead_source_id)->name }}</td>
                                            <td>
                                            <select class="form-control"  onchange="if(this.value=='del'){$('#delete{{ $lead->id }}').modal();} else{location = this.value;}">
                                                <option value="#" disabled selected >Options</option>
                                                <option value="{{ url(adminPath() . '/leads/' . $lead->id) }}"> {{ trans('admin.show') }} </option>
                                                <option value="{{ url(adminPath() . '/leads/' . $lead->id . '/edit') }} ">{{  trans('admin.edit') }}</option>
                                                <option value="del" class="delete" data-toggle="modal" data-target='#delete{{ $lead->id }}' class="btn btn-danger btn-flat">{{ trans('admin.delete') }}</option>
                                            </select>
                                            </td>
                                            @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                                                <td><a data-toggle="modal" data-target="#switch{{ $lead->id }}" class="btn btn-success btn-flat">{{ trans('admin.switch') }}</a></td>
                                            @endif

                                            <td><a @click.prevent="showHint({{ $lead->id }})"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        </tr>
                                        <div id="delete{{ $lead->id }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">{{ trans('admin.delete') . ' ' . trans('admin.lead') }}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{ trans('admin.delete') . ' ' . $lead->name }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-flat"
                                                                data-dismiss="modal">{{ trans('admin.close') }}</button>
                                                        <a class="btn btn-danger btn-flat" href="{{ url(adminPath() . '/delete-lead/' . $lead->id) }}">{{ trans('admin.delete') }}</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                                            <div id="switch{{ $lead->id }}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ trans('admin.switch') . ' ' . trans('admin.lead') }}</h4>
                                                        </div>
                                                        <h2 class="alert alert-success" id="alert_switch" style="display:none;"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> Switched </h2>

                                                        <form action="{{ url(adminPath() . '/switch_leads') }}" method="post">
                                                            {{ csrf_field() }}
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                        <label>{{ __('admin.personal'). ' ' . __('admin.agent') }}</label>
                                                                        <select class="select2" name="agent_id" id="agent_id"
                                                                                data-placeholder="{{ __('admin.agent') }}" style="width: 100%">
                                                                            <option></option>
                                                                            @foreach(@\App\User::where('residential_commercial','residential')->get() as $agent)
                                                                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                                                            @endforeach
                                                                        </select>

                                                                        <label>{{ __('admin.commercial'). ' ' . __('admin.agent') }}</label>
                                                                        <select class="select2" name="commercial_agent_id" id="commercial_agent_id"
                                                                                data-placeholder="{{ __('admin.agent') }}" style="width: 100%">
                                                                            <option></option>
                                                                            @foreach(@\App\User::where('residential_commercial','commercial')->get() as $agent)
                                                                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <input type="hidden" value="{{ $lead->id }}" name="leads[]" id="leads">
                                                                        <span id="getLeads"></span>
                                                                        {{-- <span id="getLeadsNew"></span> --}}
                                                                        </div>

                                                                        <div class="modal-footer">

                                                                        <button type="button" class="btn btn-default btn-flat"
                                                                                data-dismiss="modal">{{ trans('admin.close') }}</button>
                                                                        <button type="submit" id="switch_team"
                                                                                class="btn btn-success btn-flat">{{ trans('admin.switch') }}</button>
                                                                    </div>
                                                                </div>
                                                        </form>
                                                    </div>

                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                <span id="teamLinks">

                                    {{ $teams->links() }}

                                </span>
                            </div>
                        </div>
                    @endif
                    <div class="tab-pane" style="min-height: 650px;" id="fav_leads">
                        <table class="table table-hover table-striped datatable2" style="width:100%">
                            <thead>
                            <tr>
                                <th>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="checkAll">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            </label>
                                        </div>
                                    </th>
                                {{-- <th>{{ trans('admin.id') }}</th> --}}
                                <th>{{ trans('admin.name') }}</th>
                                <th>{{ trans('admin.probability') }}</th>
                                <th>{{ trans('admin.request_location') }}</th>
                                <th>{{ trans('admin.request_project') }}</th>
                                @if(Auth()->user()->residential_commercial == 'residential')
                                    <th>{{ trans('admin.lpersonal') .' '.trans('admin.status') }}</th>
                                @endif
                                @if(Auth()->user()->residential_commercial == 'commercial')
                                    <th>{{ trans('admin.lscommercial') .' '.trans('admin.status') }}</th>
                                @endif
                                <th>{{ trans('admin.type') }}</th>
                                <th>{{ trans('admin.seen') }}</th>
                                <th>{{ trans('admin.option') }}</th>
                                @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                                    <th>{{ trans('admin.switch') }}</th>
                                @endif
                                <th>{{ trans('admin.hint') }}</th>

                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane" style="min-height: 650px;" id="hot_leads">
                        <table class="table table-hover table-striped datatable2" style="width:100%">
                            <thead>
                            <tr>
                                <th>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="checkAll">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            </label>
                                        </div>
                                    </th>
                                {{-- <th>{{ trans('admin.id') }}</th> --}}
                                <th>{{ trans('admin.name') }}</th>
                                <th>{{ trans('admin.probability') }}</th>
                                <th>{{ trans('admin.request_location') }}</th>
                                <th>{{ trans('admin.request_project') }}</th>
                                @if(Auth()->user()->residential_commercial == 'residential')
                                    <th>{{ trans('admin.lpersonal') .' '.trans('admin.status') }}</th>
                                @endif
                                @if(Auth()->user()->residential_commercial == 'commercial')
                                    <th>{{ trans('admin.lscommercial') .' '.trans('admin.status') }}</th>
                                @endif
                                <th>{{ trans('admin.type') }}</th>
                                <th>{{ trans('admin.seen') }}</th>
                                <th>{{ trans('admin.option') }}</th>
                                @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                                    <th>{{ trans('admin.switch') }}</th>
                                @endif
                                <th>{{ trans('admin.hint') }}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
    <div id="switchLead" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <form action="{{ url(adminPath().'/switch_leads') }}" method="post">
                                                {{ csrf_field() }}
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{ trans('admin.switch')  }}</h4>
                                        </div>
                                        <div class="modal-body">
                                                <label>{{ __('admin.personal'). ' ' . __('admin.agent') }}</label>
                                                <select class="select2" name="agent_id"
                                                        data-placeholder="{{ __('admin.agent') }}" style="width: 100%">
                                                    <option></option>
                                                    @foreach(@\App\User::where('residential_commercial','residential')->get() as $agent)
                                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label>{{ __('admin.commercial'). ' ' . __('admin.agent') }}</label>
                                                <select class="select2" name="commercial_agent_id"
                                                        data-placeholder="{{ __('admin.agent') }}" style="width: 100%">
                                                    <option></option>
                                                    @foreach(@\App\User::where('residential_commercial','commercial')->get() as $agent)
                                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" value="{{ $lead->id }}" name="leads[]" id="leads_teams">
                                                <span id="getLeads"></span>
                                                <span id="getLeadsTeams"></span>
                                                </div>

                                                <div class="modal-footer">

                                                <button type="button" class="btn btn-default btn-flat"
                                                        data-dismiss="modal">{{ trans('admin.close') }}</button>
                                                <button type="submit"
                                                        class="btn btn-success btn-flat">{{ trans('admin.switch') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
    @endif
@endsection

@section('js')
    <!--//new_sec_added datepicker ..-->
        {{-- <script type="text/javascript" src="{{url('js/bootstrap-datetimepicker.min.js')}}" charset="UTF-8"></script> --}}
    <script>
        setTimeout(function(){

            $('.datepicker1').datetimepicker({
            //new_sec_added datepicker ..
            language:  'en',
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 0,
            forceParse: 1,
            });

            $('.datepicker2').datepicker({
            autoclose: true,
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years",
        });
        $('.datetimepicker').datetimepicker({
                format: 'yyyy-mm-dd hh:ii'
        });
        $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
            $(document).ready(function() {
                $('#gCallSel').selectable();
                // var max_height = $('#contents').css('height');
                $('#vue-panel').css('max-height', '569.074px');
            });
            function show_error(name,t){
                if(t=='i'){
                    $('input[name='+name+']').parent().addClass('has-error');
                        $('html, body').animate({
                            scrollTop: $('input[name='+name+']').offset().top
                        }, 100);
                }else if(t=='ip'){
                    $('input[name='+name+']').parent().addClass('has-error');
                    $('input[name='+name+']').parent().parent().addClass('has-error');
                    $('html, body').animate({
                            scrollTop: $('input[name='+name+']').offset().top
                        }, 100);
                }
                else{
                    $('select[name='+name+']').parent().addClass('has-error');
                        $('html, body').animate({
                            scrollTop: $('select[name='+name+']').offset().top
                        }, 100);
                }

            }
            function hide_error(name,t){
                if(t=='i'){
                $('input[name='+name+']').parent().removeClass('has-error');
                }else if(t=='ip'){
                    $('input[name='+name+']').parent().removeClass('has-error');
                    $('input[name='+name+']').parent().parent().removeClass('has-error');
                }else{
                    $('select[name='+name+']').parent().removeClass('has-error');
                }
            }
            $('select[name=call_status_id]').next().focusout(function(){
                if($('select[name=call_status_id]').val()==''){
                    show_error('call_status_id','s');
                }else{
                    hide_error('call_status_id','s');
                }
            });
            $('input[name=duration]').focusout(function(){
                if($('input[name=duration]').val()==''){
                    show_error('duration','i');
                }else{
                    hide_error('duration','i');
                }
                if($('select[name=call_status_id]').val()==''){
                    show_error('call_status_id','s');
                }else{
                    hide_error('call_status_id','s');
                }

            });
            $('input[name=date]').focusout(function(){
                if($('input[name=date]').val()==''){
                    show_error('date','ip');
                }else{
                    hide_error('date','ip');
                }
                if($('input[name=duration]').val()==''){
                    show_error('duration','i');
                }else{
                    hide_error('duration','i');
                }
                if($('select[name=call_status_id]').val()==''){
                    show_error('call_status_id','s');
                }else{
                    hide_error('call_status_id','s');
                }
            });
            $('select[name=probability]').next().focusout(function(){
                if($('select[name=probability]').val()==''){
                    show_error('probability','s');
                }else{
                    hide_error('probability','s');
                }
                if($('input[name=date]').val()==''){
                    show_error('date','ip');
                }else{
                    hide_error('date','ip');
                }
                if($('input[name=duration]').val()==''){
                    show_error('duration','i');
                }else{
                    hide_error('duration','i');
                }
                if($('select[name=call_status_id]').val()==''){
                    show_error('call_status_id','s');
                }else{
                    hide_error('call_status_id','s');
                }
            });
            $('input[name=budget]').focusout(function(){
                if($('input[name=budget]').val()==''){
                    // show_error('budget','ip');
                }else{
                    // hide_error('budget','ip');
                }
                if($('select[name=probability]').val()==''){
                    show_error('probability','s');
                }else{
                    hide_error('probability','s');
                }
                if($('input[name=date]').val()==''){
                    show_error('date','ip');
                }else{
                    hide_error('date','ip');
                }
                if($('input[name=duration]').val()==''){
                    show_error('duration','i');
                }else{
                    hide_error('duration','i');
                }
                if($('select[name=call_status_id]').val()==''){
                    show_error('call_status_id','s');
                }else{
                    hide_error('call_status_id','s');
                }
            });
            $('select[name="projects[]"]').next().focusout(function(){
                if($('select[name="projects[]"]').length == 0){
                    show_error('"projects[]"','');
                }else{
                    hide_error('"projects[]"','s');
                }
                if($('input[name=budget]').val()==''){
                    show_error('budget','ip');
                }else{
                    hide_error('budget','ip');
                }
                if($('select[name=probability]').val()==''){
                    show_error('probability','s');
                }else{
                    hide_error('probability','s');
                }
                if($('input[name=date]').val()==''){
                    show_error('date','ip');
                }else{
                    hide_error('date','ip');
                }
                if($('input[name=duration]').val()==''){
                    show_error('duration','i');
                }else{
                    hide_error('duration','i');
                }
                if($('select[name=call_status_id]').val()==''){
                    show_error('call_status_id','s');
                }else{
                    hide_error('call_status_id','s');
                }
            });

            $('#phone .select2-search__field').change(function(){
                if($('input.select2-search__field').val()!=''){
                     $('#addPhoneBtn button').removeAttr('disable');
                     $('#addPhoneBtn button').removeClass('btn-primary');

                }else{
                     $('#addPhoneBtn button').attr('disable');
                     $('#addPhoneBtn button').addClass('btn-primary');
                }
            });

                $('#phone').next().click(function(){
                    if($('#phone').next().hasClass('select2-container--open')){
                        $('#addPhoneBtn').css('display','block');
                    }else{
                        $('#addPhoneBtn').css('display','none');
                    }
                });
                $('#phone').next().focusout(function(){
                    if($('#phone').next().hasClass('select2-container--open')){
                    $('#addPhoneBtn').css('display','block');
                    }else{
                        $('#addPhoneBtn').css('display','none');
                    }
                });

                $('.btnCol').click(function(){
                    console.log('btnCol clicked');
                 var exp = $(this).attr('aria-expanded');
                 if($(this).html()=='+'){
                     $(this).html('-');
                 } else if($(this).html()=='-'){
                     $(this).html('+');
                 }
              });

        }, 100);

    </script>

    <script>
    //     $(document).on('change', '#teamAgent', function () {
    //         var id = $(this).val();
    //         var _token = '{{ csrf_token() }}';
    //         $.ajax({
    //             url: '{{ url(adminPath() . '/filter_team_leads') }}',
    //             dataType: 'html',
    //             data: {_token: _token, id: id},
    //             type: 'post',
    //             success: function (data) {
    //                 $('#teamData').html(data);
    //             }
    //         })
    //     })
    </script>
    <script>
    setTimeout(function(){
        function datatableAw(target){
                    $('.datatable').DataTable().destroy();
                    var _token = '{{ csrf_token() }}';
                    $('.datatable').DataTable({
                        dom: 'Bfrtip',
                        responsive: true,
                        buttons: [
                            {
                                extend: 'print',
                                text: 'Print all',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'print',
                                text: 'Print selected',
                                exportOptions: {
                                    selected: true,
                                    columns: ':visible'
                                }

                            },
                            {
                                extend: 'copyHtml5',
                                text: 'Copy',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                text: 'Excel',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            'colvis'
                        ],
                        select: false,
                        pagingType: "full_numbers",
                        order: [[ 4, 'asc' ]],

                        processing: true,
                        createdRow: function ( row, data, index ) {
                        if (data.seen==0){
                            $('td', row).addClass('bg-danger');
                        }
                        },
                        serverSide: true,
                        ajax: {
                            method: 'GET',
                            url: '{{ url(adminPath().'/leads_ajax') }}',
                            data: {
                                _token: _token,
                                target: target
                            }
                        },
                        drawCallback: function ( settings ) {

                            var api = this.api();
                            var rows = api.rows( {page:'current'} ).nodes();
                            var last=null;
                        api.column(4, {page:'current'} ).data().each( function ( group, i ) {
                            if ( last !== group ) {
                                if(group==0){

                                    $(rows).eq( i ).before(
                                        '<tr class="group table-dark"><td colspan="10">'+'{{ trans('admin.unseen')}}'+'</td></tr>'
                                    );
                                }else if(group==1){
                                    $(rows).eq( i ).before(
                                        '<tr class="group table-dark"><td colspan="10">'+'{{ trans('admin.seen')}}'+'</td></tr>'
                                    );
                                }else if(group==2){
                                    $(rows).eq( i ).before(
                                        '<tr class="group table-dark"><td colspan="10">'+'{{ trans('admin.seenWithAction')}}'+'</td></tr>'
                                    );
                                }
                                last = group;
                            }
                        });
                        },
                        columns: [
                            {data: 'checkbox'},
                            {data: 'name'},
                            {data: 'probability'},
                            {data: 'source'},
                            {data: 'agent'},
                            @if(Auth()->user()->residential_commercial == 'residential')
                                {data: 'personal_status'},
                            @endif
                            @if(Auth()->user()->residential_commercial == 'commercial')
                                {data: 'commercial_status'},
                            @endif
                            {data: 'type'},
                            {data: 'seen'},
                            {data: 'fav', searchable: false, sortable: false},
                            {data: 'hot', searchable: false, sortable: false},
                            {data: 'option', searchable: false, sortable: false,className: "all" },
                            /*               {data: 'show', searchable: false, sortable: false},
                            {data: 'edit', searchable: false, sortable: false},
                            @if(checkRole('hard_delete_leads') or checkRole('soft_delete_leads') or auth()->user()->type == 'admin')
                            {data: 'delete', searchable: false, sortable: false},
                            @endif
                            */
                            @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                            {data: 'switch', searchable: false, sortable: false,className: "all" },
                            @endif
                            {data: 'hint', searchable: false, sortable: false,className: "all" },
                        ],
                        columnDefs: [
                        { "targets": 3 ,
                          "createdCell": function (td, cellData, rowData, row, col) {
                                // if($(td).html()==0){
                                //     $(td).html('<i class="fa fa-circle" aria-hidden="true" style="color: ' + 'red;' + '"></i>');
                                // }else if($(td).html()==1){
                                //     $(td).html('<i class="fa fa-circle" aria-hidden="true" style="color: ' + 'orange;' + '"></i>');
                                // }else{
                                //     $(td).html('<i class="fa fa-circle" aria-hidden="true" style="color: ' + 'green;' + '"></i>');
                                // }

                            },
                        }

                        ],
                    });
        }
        $(document).on('click', '.subDetail span', function () {
                var target=$(this).attr('target');

                    datatableAw(target);

        });
    }, 10);
    </script>
    <script>
        setTimeout(function(){
            $('.datatable').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                    {
                        extend: 'print',
                        text: 'Print all',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print selected',
                        exportOptions: {
                            selected: true,
                            columns: ':visible'
                        }

                    },
                    {
                        extend: 'copyHtml5',
                        text: 'Copy',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ],
                select: false,
                pagingType: "full_numbers",
                order: [[ 4, 'asc' ]],

                processing: true,
                createdRow: function ( row, data, index ) {
                if (data.seen==0){
                    $('td', row).addClass('bg-danger');
                }
                },
                serverSide: true,
                ajax: '{{ url(adminPath().'/leads_ajax') }}',
                drawCallback: function ( settings ) {

                    var api = this.api();
                    var rows = api.rows( {page:'current'} ).nodes();
                    var last=null;
                api.column(4, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last !== group ) {
                        if(group==0){

                            $(rows).eq( i ).before(
                                '<tr class="group table-dark"><td colspan="10">'+'{{ trans('admin.unseen')}}'+'</td></tr>'
                            );
                        }else if(group==1){
                            $(rows).eq( i ).before(
                                '<tr class="group table-dark"><td colspan="10">'+'{{ trans('admin.seen')}}'+'</td></tr>'
                            );
                        }else if(group==2){
                            $(rows).eq( i ).before(
                                '<tr class="group table-dark"><td colspan="10">'+'{{ trans('admin.seenWithAction')}}'+'</td></tr>'
                            );
                        }
                        last = group;
                    }
                });
                },
                columns: [
                    {data: 'checkbox'},
                    {data: 'name'},
                    {data: 'probability'},
                    {data: 'source'},
                    {data: 'agent'},
                    @if(Auth()->user()->residential_commercial == 'residential')
                        {data: 'personal_status'},
                    @endif
                    @if(Auth()->user()->residential_commercial == 'commercial')
                        {data: 'commercial_status'},
                    @endif
                    {data: 'type'},
                    {data: 'seen'},
                    {data: 'fav', searchable: false, sortable: false},
                    {data: 'hot', searchable: false, sortable: false},
                    {data: 'option', searchable: false, sortable: false,className: "all" },
                    /*               {data: 'show', searchable: false, sortable: false},
                    {data: 'edit', searchable: false, sortable: false},
                    @if(checkRole('hard_delete_leads') or checkRole('soft_delete_leads') or auth()->user()->type == 'admin')
                    {data: 'delete', searchable: false, sortable: false},
                    @endif
                    */
                    @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                    {data: 'switch', searchable: false, sortable: false,className: "all" },
                    @endif
                    {data: 'hint', searchable: false, sortable: false,className: "all" },
                ],
                columnDefs: [
                    // { "responsivePriority": 1, "targets": 12 },
                    // { "responsivePriority": 2, "targets": 14 },
                    // { "responsivePriority": 3, "targets": 13 },
                { "targets": 3 ,
                  "createdCell": function (td, cellData, rowData, row, col) {
                        // if($(td).html()==0){
                        //     $(td).html('<i class="fa fa-circle" aria-hidden="true" style="color: ' + 'red;' + '"></i>');
                        // }else if($(td).html()==1){
                        //     $(td).html('<i class="fa fa-circle" aria-hidden="true" style="color: ' + 'orange;' + '"></i>');
                        // }else{
                        //     $(td).html('<i class="fa fa-circle" aria-hidden="true" style="color: ' + 'green;' + '"></i>');
                        // }

                    },
                }

                ],
            });


            $('.datatable1').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                    {
                        extend: 'print',
                        text: 'Print all'
                    },
                    {
                        extend: 'print',
                        text: 'Print selected',
                        exportOptions: {
                            modifier: {
                                selected: true
                            }
                        }
                    }
                ],
                select: true,
                pagingType: "full_numbers",
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                ajax: '{{ url(adminPath().'/leads_ind_ajax') }}',
                columns: [
                    {data: 'checkbox'},
                    // {data: 'id'},
                    {data: 'name'},
                    {data: 'probability'},
                    {data: 'source'},
                    {data: 'agent'},
                    @if(Auth()->user()->residential_commercial == 'residential')
                        {data: 'personal_status'},
                    @endif
                    @if(Auth()->user()->residential_commercial == 'commercial')
                        {data: 'commercial_status'},
                    @endif
                    {data: 'type'},
                    {data: 'seen'},
                    // {data: 'email'},

                    // {data: 'phone'},
                    {data: 'fav', searchable: false, sortable: false},
                    {data: 'hot', searchable: false, sortable: false},
                    {data: 'option', searchable: false, sortable: false},
                    @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                        {data: 'switch', searchable: false, sortable: false},
                    @endif
                    {data: 'hint', searchable: false, sortable: false,className: "all" },
                ]
            });

            $('.datatable2').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                    {
                        extend: 'print',
                        text: 'Print all'
                    },
                    {
                        extend: 'print',
                        text: 'Print selected',
                        exportOptions: {
                            modifier: {
                                selected: true
                            }
                        }
                    }

            ],
            select: true,
            pagingType: "full_numbers",
            order: [[0, 'desc']],
            processing: true,
            serverSide: true,
            ajax: '{{ url(adminPath().'/leads_hot_ajax') }}',
            columns: [
                {data: 'checkbox'},
                // {data: 'id'},
                {data: 'name'},
                {data: 'probability'},
                {data: 'source'},
                {data: 'agent'},
                @if(Auth()->user()->residential_commercial == 'residential')
                    {data: 'personal_status'},
                @endif
                @if(Auth()->user()->residential_commercial == 'commercial')
                    {data: 'commercial_status'},
                @endif
                {data: 'type'},
                {data: 'seen'},
                // {data: 'email'},
                // {data: 'phone'},
                {data: 'option', searchable: false, sortable: false,className: "all" },
                /*               {data: 'show', searchable: false, sortable: false},
                {data: 'edit', searchable: false, sortable: false},
                @if(checkRole('hard_delete_leads') or checkRole('soft_delete_leads') or auth()->user()->type == 'admin')
                {data: 'delete', searchable: false, sortable: false},
                @endif
                */
                @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                {data: 'switch', searchable: false, sortable: false,className: "all" },
                @endif
                {data: 'hint', searchable: false, sortable: false,className: "all" },

            ]
        });
        $('.datatable3').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                {
                    extend: 'print',
                    text: 'Print all'
                },
                {
                    extend: 'print',
                    text: 'Print selected',
                    exportOptions: {
                        modifier: {
                            selected: true
                        }
                    }
                }
                ],
                select: true,
                pagingType: "full_numbers",
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                ajax: '{{ url(adminPath().'/leads_fav_ajax') }}',
                columns: [
                    {data: 'checkbox'},
                    // {data: 'id'},
                    {data: 'source'},
                    {data: 'name'},
                    {data: 'probability'},
                    {data: 'agent'},
                    @if(Auth()->user()->residential_commercial == 'residential')
                        {data: 'personal_status'},
                    @endif
                    @if(Auth()->user()->residential_commercial == 'commercial')
                        {data: 'commercial_status'},
                    @endif
                    {data: 'type'},
                    {data: 'seen'},
                    // {data: 'email'},
                    // {data: 'phone'},
                    {data: 'option', searchable: false, sortable: false,className: "all" },
                    /*               {data: 'show', searchable: false, sortable: false},
                    {data: 'edit', searchable: false, sortable: false},
                    @if(checkRole('hard_delete_leads') or checkRole('soft_delete_leads') or auth()->user()->type == 'admin')
                    {data: 'delete', searchable: false, sortable: false},
                    @endif
                    */
                    @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
                    {data: 'switch', searchable: false, sortable: false,className: "all" },
                    @endif
                    {data: 'hint', searchable: false, sortable: false,className: "all" },
                ]
            });
/**
            // $('.datatableTeam').DataTable({
            //     dom: 'Bfrtip',
            //     responsive: true,
            //     paging: true,
            //     info: true,
            //     buttons: [
            //         {
            //             extend: 'print',
            //             text: 'Print all'
            //         },
            //         {
            //             extend: 'print',
            //             text: 'Print selected',
            //             exportOptions: {
            //                 modifier: {
            //                     selected: true
            //                 }
            //             }
            //         }
            //     ],
            //     select: true,
            //     pagingType: "full_numbers",
            //     order: [[0, 'desc']],
            //     processing: true,
            //     serverSide: true,
            //     ajax: '{{ url(adminPath().'/team_leads_ajax') }}',
            //     columns: [
            //         {data: 'checkbox'},
            //         {data: 'id'},
            //         {data: 'residential_commercial'},
            //         {data: 'name'},
            //         {data: 'name_com_agent'},
            //         {data: 'name_agent'},
            //         {data: 'email'},
            //         {data: 'phone'},
            //         {data: 'source'},
            //         {data: 'option', searchable: false, sortable: false},
            //         @if(checkRole('switch_leads') or auth()->user()->type == 'admin')
            //             {data: 'switch', searchable: false, sortable: false},
            //         @endif
            //         {data: 'hint'},
            //     ]
            //
            // });
*/
        }, 10);

    </script>

<script type="text/javascript">
var leadIdGlobal = 0;
showHintSpan = function(id){
        // console.log(id);
        leadIdGlobal = id;
        $('#spanShowHidden').trigger('click');
};
// $(document).on('click', '.showLeadVue', function(){
//     console.log('kdflsjj');
//     $('.spanShowHidden').trigger('click');
// });
</script>


    <script type="text/javascript">
        $(document).on('click', '.Fav', function () {
            var id = $(this).attr('count');
            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ url(adminPath().'/fav_lead')}}",
                method: 'post',
                dataType: 'json',
                data: {id: id, _token: _token},
                beforeSend: function () {
                    $('#Fav' + id).addClass('animated flip');
                },
                success: function (data) {
                    setTimeout(function () {
                        $('#Fav' + id).removeClass('animated flip');
                    }, 1000);
                    if (data.status == 1) {
                        $('#Fav' + id).css('color', '#caa42d');
                    } else {
                        $('#Fav' + id).css('color', '#161616');
                    }
                },
                error: function () {
                    alert('{{ __('admin.error') }}')
                }
            })
        })
    </script>
    <script type="text/javascript">

        $(document).on('click', '.Hot', function () {
            var id = $(this).attr('count');
            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ url(adminPath().'/hot_lead')}}",
                method: 'post',
                dataType: 'json',
                data: {id: id, _token: _token},
                beforeSend: function () {
                    $('#Hot' + id).addClass('animated flip');
                },
                success: function (data) {
                    setTimeout(function () {
                        $('#Hot' + id).removeClass('animated flip');
                    }, 1000);
                    if (data.status == 1) {
                        $('#Hot' + id).css('color', '#dd4b39');
                    } else {
                        $('#Hot' + id).css('color', '#161616');
                    }
                },
                error: function () {
                    alert('{{ __('admin.error') }}')
                }
            })
        })
    </script>
    <script>
        $(document).on('click','#filterLeads',function() {
            // alert('test');
            var location_lead = $('#location_lead').val();
            var meetingStatus_id = $('#meetingStatus_id').val();
            var callStatus_id = $('#callStatus_id').val();
            var dateTo = $('#dateTo').val();
            var dateFrom = $('#dateFrom').val();
            var _token = '{{ csrf_token() }}';
            var agent_id = '{{ auth()->id() }}';
            var data ={
                'location':location_lead,
                'meetingStatus':meetingStatus_id,
                'callStatus':callStatus_id,
                'dateTo':dateTo,
                'dateFrom':dateFrom,
                '_token':_token,
                'agent_id':agent_id,
                'data':data,
            };
            console.log(data);
            $.ajax({
                url: '{{ url(adminPath() . '/filter_leads') }}',
                dataType: 'html',
                data: data,
                type: 'post',
                success: function (data) {
                    // alert(data);
                    $('#myLeads_filter').html(data);
                    $('#Spinner').addClass('hidden');
                },
                beforeSend: function() {
                    $('#Spinner').removeClass('hidden');
                },
                error: function() {
                    alert("{{ __('admin.error') }}");
                    $('#Spinner').addClass('hidden');
                }
            });
        });
    </script>

    <script>
        $(document).on('click','#TfilterLeads',function() {
            // alert('test');
            var location = $('#Tlocation').val();
            var meetingStatus = $('#TmeetingStatus').val();
            var callStatus = $('#TcallStatus').val();
            var dateTo = $('#TdateTo').val();
            var dateFrom = $('#TdateFrom').val();
            var _token = '{{ csrf_token() }}';
            var agent_id = $('#teamAgent').val();
            var group_id = $('#Group').val();
            var _token = '{{ csrf_token() }}';
            var type = 'team';
            var data = {
                "location": location,
                "meetingStatus": meetingStatus,
                'callStatus': callStatus,
                "dateTo": dateTo,
                "dateFrom": dateFrom,
                "_token": _token,
                "agent_id": agent_id,
                "group_id": group_id,
                "type": type,
                "_token": _token,
            };

            $.ajax({
                url: '{{ url(adminPath() . '/filter_leads') }}',
                method: 'POST',
                dataType: 'html',
                data:data,
                success: function (data) {
                    // alert(data);
                    $('#teamData').html(data);
                    $('#Tspinner').addClass('hidden');
                },
                beforeSend: function() {
                    $('#Tspinner').removeClass('hidden');
                },
                error: function() {
                    alert("{{ __('admin.error') }}");
                    $('#Tspinner').addClass('hidden');
                }
            });
        });
    </script>
    <script>
    // $('#teamDataTable').dataTable({
    //     'paging': true,
    //     'lengthChange': false,
    //     'searching': true,
    //     'ordering': true,
    //     'info': true,
    //     "order": [[ 0, "asc" ]],
    //     'autoWidth': true
    // })

        $(document).on('keyup', '#searchTeam', $.debounce(250, function() {
            var q = $(this).val();
            var _token = '{{ csrf_token() }}';
            var agents = '{{ json_encode($agent_ids) }}';
            $('#teamLinks').hide();
            // $.ajax({
            //     url: "{{ url(adminPath() . '/search-team') }}",
            //     type: "post",
            //     dataType: "html",
            //     data: {_token: _token, q: q, agents: agents},
            //     success: function(data) {
            //         $('#teamLinks').hide();
            //         if ($('#teamLinks').length > 10) {
            //            $('.teamLinks').show();
            //        }
            //         $('#teamDataTable').html(data);
            //     }
            // });
            axios.post("{{ url(adminPath() . '/search-team') }}",
                    {_token: _token, q: q, agents: agents}
                )
                .then(function(response){
                    // console.log(response.data);
                    $('.datatableTeam').DataTable().destroy();
                    $('#teamDataTable').html(response.data);
                    $('.datatableTeam').DataTable({
                        dom: 'Bfrtip',
                        responsive: true,
                        paging: true,
                        info: true,
                        buttons: [
                            {
                                extend: 'print',
                                text: 'Print all'
                            },
                            {
                                extend: 'print',
                                text: 'Print selected',
                                exportOptions: {
                                    modifier: {
                                        selected: true
                                    }
                                }
                            }
                        ],
                        select: true,
                        order: [[0, 'desc']],

                    });
                })
                .catch(function(error){
                    console.log('Error:', error);
                });
        }));
    </script>
    <script>
        $(document).on('change', '#Groups', function() {
            var group_id = $(this).val();
            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: '{{ url(adminPath() . '/get_group_agents') }}',
                type: 'post',
                dataType: 'html',
                data: {_token: _token, group_id: group_id},
                success: function(data) {
                    $('#teamAgent').html(data);
                },
                error: function() {
                    alert('{{ __('admin.error') }}')
                }
            })
        });
    </script>
    <script>
        $(document).on('change', '#callStatus', function() {
            var action = $('option:selected', this).attr('next');
            if (action == 1) {
                $('#nextAction').html('<div class="well" id="action">' +
                    '<div class="form-group col-md-6">' +
                    '<label>{{ trans("admin.to_do_type") }}</label>' +
                    '<select class="form-control select2" id="callnextactiontype" name="to_do_type" data-placeholder="{{ trans("admin.to_do_type") }}" style="width: 100%">' +
                    '<option></option>' +
                    '<option value="call">{{ trans("admin.call") }}</option>' +
                    '<option value="meeting">{{ trans("admin.meeting") }}</option>' +
                    '<option value="other">{{ trans("admin.other") }}</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="form-group col-md-6">' +
                    '<label>{{ trans("admin.due_date") }}</label>' +
                    '<div class="input-group">' +
                    '<input class="form-control datetimepicker" placeholder="Due Date"  id="calltododuedate" name="to_do_due_date" type="text" value="">' +
                    '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>{{ trans("admin.description") }}</label>' +
                    '<textarea class="form-control" placeholder="Description" rows="5" id="calltododesc" name="to_do_description" cols="50"></textarea>' +
                    '</div>' +
                    '</div>');
                // $('.select2').select2();

                $('#addAction').addClass('hidden');
                $('#removeAction').removeClass('hidden');
            } else {
                $('#action').remove();
                $('#removeAction').addClass('hidden');
                $('#addAction').removeClass('hidden');
            }
        })
    </script>
    <script>
        $(document).on('click', '#addAction', function () {
            $('#nextAction').html('<div class="well" id="action">' +
                '<div class="form-group col-md-6">' +
                '<label>{{ trans("admin.to_do_type") }}</label>' +
                '<select class="form-control select2"  name="to_do_type" data-placeholder="{{ trans("admin.to_do_type") }}" style="width: 100%">' +
                '<option></option>' +
                '<option value="call">{{ trans("admin.call") }}</option>' +
                '<option value="meeting">{{ trans("admin.meeting") }}</option>' +
                '<option value="other">{{ trans("admin.other") }}</option>' +
                '</select>' +
                '</div>' +
                '<div class="form-group col-md-6">' +
                '<label>{{ trans("admin.due_date") }}</label>' +
                '<div class="input-group">' +
                '<input class="form-control datetimepicker" placeholder="Due Date"   id="calltododuedate" name="to_do_due_date" type="text" value="">' +
                // '{!! Form::text("to_do_due_date","",["class" => "form-control datepicker", "placeholder" => trans("admin.due_date"),"readonly"=>""]) !!}' +
                '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<label>{{ trans("admin.description") }}</label>' +
                '<textarea class="form-control" placeholder="Description" rows="5" id="meetingtododesc" name="to_do_description" cols="50"></textarea>' +
                // '{!! Form::textarea("to_do_description","",["class" => "form-control", "placeholder" => trans("admin.description"),"rows"=>5]) !!}' +
                '</div>' +
                '</div>')
            // $('.select2').select2();
            $('.datetimepicker').datetimepicker({
                    format: 'yyyy-mm-dd hh:ii'
            });
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
            $(this).addClass('hidden');
            $('#removeAction').removeClass('hidden');
        });

        $(document).on('click', '#removeAction', function () {
            $('#action').remove();
            $(this).addClass('hidden');
            $('#addAction').removeClass('hidden');
        })

    </script>
    <script>
        $(document).on('click', '#MaddAction', function () {
            $('#MnextAction').html('<div class="well" id="action">' +
                '<div class="form-group col-md-6">' +
                '<label>{{ trans("admin.to_do_type") }}</label>' +
                '<select class="form-control select2" id="meetingnextactiontype" name="to_do_type" data-placeholder="{{ trans("admin.to_do_type") }}" style="width: 100%">' +
                '<option></option>' +
                '<option value="call">{{ trans("admin.call") }}</option>' +
                '<option value="meeting">{{ trans("admin.meeting") }}</option>' +
                '<option value="other">{{ trans("admin.other") }}</option>' +
                '</select>' +
                '</div>' +
                '<div class="form-group col-md-6">' +
                '<label>{{ trans("admin.due_date") }}</label>' +
                '<div class="input-group">' +
                '<input class="form-control datetimepicker" placeholder="Due Date"  id="meetingtododuedate" name="to_do_due_date" type="text" value="">' +
                // '{!! Form::text("to_do_due_date","",["class" => "form-control datepicker", "placeholder" => trans("admin.due_date"),"readonly"=>""]) !!}' +
                '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<label>{{ trans("admin.description") }}</label>' +
                '<textarea class="form-control" placeholder="Description" rows="5" id="meetingtododesc" name="to_do_description" cols="50"></textarea>' +
                // '{!! Form::textarea("to_do_description","",["class" => "form-control", "placeholder" => trans("admin.description"),"rows"=>5]) !!}' +
                '</div>' +
                '</div>')
            // $('.select2').select2();
            $('.datetimepicker').datetimepicker({
                    format: 'yyyy-mm-dd hh:ii'
            });
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
            $(this).addClass('hidden');
            $('#MremoveAction').removeClass('hidden');
        });

        $(document).on('click', '#MremoveAction', function () {
            $('#Maction').remove();
            $(this).addClass('hidden');
            $('#MaddAction').removeClass('hidden');
        })

    </script>

    <script>

    var root = new Vue({
        el: '#root',
        props:[],
        data() {
            return {
                filter_show: 0,
                test: 10,
                showPhone: false,
                showEmail: false,
                r_agent_image: '',
                l_image: '',
                c_agent_image: '',
                l_nameChars: '',
                r_nameChars: '',
                c_nameChars: '',
                el: null,
                filter: null,
                token: '{!! csrf_token() !!}',
                url: '{!! url(adminPath().'/get_lead') !!}',
                lead_url: '{!! url(adminPath().'/update_lead_ajax') !!}',
                user_id: '{!! Auth::user()->id !!}',
                locale: '{!! app()->getLocale() !!}',
                lead: null,
                leads_url: '{!! url(adminPath() . '/leads/' ) !!}',
                cloud_url: '{!! url(adminPath() . '/search_cloud/') !!}',
                call_url: '{!! url(adminPath() . '/add_call') !!}',
                meetings_url: '{!! url(adminPath() . '/add_meetings') !!}',
                Request_url: '{!! url(adminPath() . '/add_Request') !!}',
                phone_in_out: 'in',
                uploads_url: '{{ url('uploads/')  }}',
                phoneSelected: '{{ @$show->phone }}',
                optionPhones: null

            }
        },
        computed: {

            more_url: function(){
                if(this.lead){
                    return this.leads_url + '/' + this.lead.id;
                }

                return '#';
            },
            full_name: function(){
                if(this.lead){
                    return this.lead.first_name + ' ' + this.lead.last_name;
                }

                return '';
            },
            phone: function(){
                if(this.lead){
                    return this.lead.phone;
                }

                return '';
            },
            email: function(){
                if(this.lead){

                    return this.lead.email;
                }

                return '';
            },
            residencialAgent: function(){
                if(this.lead && this.lead.r_agent.name){
                    this.r_agent_image = '{!! url("uploads") !!}/' + this.lead.r_agent.image;
                    return this.lead.r_agent;
                }

                return null;
            },
            residencialAgentName: function(){
                if(this.lead && this.lead.r_agent.name){
                    return this.lead.r_agent.name;
                }

                return null;
            },

            residencialAgentImage: function(){
                if(this.lead){
                    if(this.lead.r_agent.image && this.lead.r_agent.image != ''){
                        return true;
                    }

                    if(this.lead.r_agent.name){
                        var names = this.lead.r_agent.name.split(' ');
                        if(names.length == 1){
                            this.r_nameChars = names[0][0].toUpperCase();
                        } else if(names.length > 1){
                            this.r_nameChars = names[0][0].toUpperCase() + names[1][0].toUpperCase();
                        }
                        return false;
                    }
                }

                this.r_nameChars = '';
                return false;
            },
            leadImage: function(){
                if(this.lead){
                    if(this.lead.image){
                        this.l_image = '{!! url("uploads") !!}/' + this.lead.image;
                        return true;
                    }

                    if(this.lead.first_name){
                        this.l_nameChars = this.lead.first_name[0].toUpperCase();
                    }

                    if(this.lead.last_name){
                        this.l_nameChars += this.lead.last_name[0].toUpperCase();
                    }

                    return false;
                }

                return false;
            },
            residencialAgentType: function(){
                if(this.lead && this.lead.r_agent.type){
                    return this.lead.r_agent.type;
                }

                return null;
            },
            commercialAgent: function(){
                if(this.lead && this.lead.c_agent.name){
                    this.c_agent_image = '{!! url("uploads") !!}/' + this.lead.c_agent.image;
                    return this.lead.c_agent;
                }

                return [];
            },
            commercialAgentName: function(){
                if(this.lead && this.lead.c_agent.name){
                    return this.lead.c_agent.name;
                }

                return null;
            },
            commercialAgentImage: function(){
                if(this.lead){
                    if(this.lead.c_agent.image){
                        return true;
                    }

                    if(this.lead.c_agent.name){
                        var cnames = this.lead.c_agent.name.split(' ');
                        if(cnames.length == 1){
                            this.c_nameChars = cnames[0][0].toUpperCase();
                        } else if(cnames.length > 1){
                            this.c_nameChars = cnames[0][0].toUpperCase() + cnames[1][0].toUpperCase();
                        }
                        return false;
                    }
                }

                this.c_nameChars = '';
                return false;
            },
            commercialAgentType: function(){
                if(this.lead && this.lead.c_agent.type){
                    return this.lead.c_agent.type;
                }

                return null;
            },
        },
        methods: {
            getUserImage: function(user){
                return this.uploads_url + '/' + user.image;
            },
            getAudioPath: function(notepath){
                return this.uploads_url + '/' + notepath;
            },
            getLeadData: function(id){
                var vm = this;
                axios.post(this.url,
                    {"_token": this.token,"user_id": this.user_id, "lead_id": id}
                ).then(function(response){
                    // console.log(response);
                    // vm.el.style.right = '0';

                    vm.lead = response.data.lead;
                    vm.r_agent_image = (vm.lead.r_agent.image) ? '{!! url("uploads") !!}/' + vm.lead.r_agent.image: '';
                    vm.c_agent_image = (vm.lead.c_agent.image) ? '{!! url("uploads") !!}/' + vm.lead.c_agent.image: '';
                    vm.optionPhones = [{text: vm.lead.phone, value: vm.lead.phone}];
                    vm.phoneSelected = vm.lead.phone;
                    // vm.phoneSelected = vm.lead.phone;
                    // vm.filter.style.right = '500px';
                    // vm.filter_show = 1;
                })
                .catch(function(err){
                    console.log(err);
                });
            },
            radioChanged: function(val){
                this.phone_in_out = val;
            },
            updateLead: function(){
                console.log('dfsksgf');
                var vm = this;
                vm.lead.seen = 1;
                var data = vm.lead;
                data._token = this.token;
                data.user_id = this.user_id;
                axios.post(this.lead_url,
                    data
                ).then(function(response){
                    console.log(response);
                })
                .catch(function(err){
                    console.log(err);
                });
            },
            addNote: function(){
                // var lead_id = '{{ $show->id }}';
                // var user_id = '{{ auth()->user()->id }}';
                var note = $('#newNote').val();
                // var _token = '{{ csrf_token() }}';
                // var data = {
                //      'lead_id':lead_id,
                //      'user_id':user_id,
                //      'note':note,
                //      '_token':_token
                // }
                var vm = this;
                axios.post("{{ url(adminPath().'/add_note_ajax')}}",{
                        lead_id: this.lead.id,
                        user_id: this.user_id,
                        note: note,
                        _token: this.token
                }).then(function(response){
                    $('#newNote').val('');
                    // $('#allNotes').append(data);
                    vm.getLeadData(vm.lead.id);
                })
                .catch(function(err){
                    console.log(err);
                });
            },
            addCall: function(){
                // console.log('test');
                var contact_id = $('#contact_id option:selected').val();
                var phone = $('#phone option:selected').val();
                var call_status_id = $('#callStatus option:selected').val();
                var duration = $('#callduration').val();
                var date = $('#call_date').val();
                var probability = $('#callprobability option:selected').val();
                var budget = $('#callbudget').val();
                var callnextactiontype = $('#callStatus option:selected').attr('next');
                var _token = '{{ csrf_token() }}';
                var projects = [];
                $('#callprojects option:selected').each(function(i, item){
                    projects.push($(item).val());
                });
                var description = $('#calldescription').val();
                var to_do_type = $('#callnextactiontype option:selected').val();
                var to_do_due_date = $('#calltododuedate').val();
                var to_do_description = $('#calltododesc').val();
                // console.log(to_do_description2);
                var data = {
                    "_token": this.token,
                    "user_id": this.user_id,
                    'lead_id': this.lead.id,
                    "phone_in_out": this.phone_in_out,
                    "contact_id": contact_id,
                    "phone": phone,
                    "call_status_id": call_status_id,
                    "duration": duration,
                    "date": date,
                    "probability": probability,
                    "budget": budget,
                    "projects": projects,
                    "description": description,
                    "to_do_type": to_do_type,
                    "to_do_due_date": to_do_due_date,
                    "to_do_description": to_do_description,
                };
          console.log(data);


                // console.log(data);
                // return false;
                var vm = this;
                axios.post(this.call_url,
                    data
                ).then(function(response){
                    console.log(response);
                    vm.getLeadData(vm.lead.id);
                    $('#add_call_btn').trigger('click');
                    alertify.success('Success add Call');
                })
                .catch(function(err){
                    console.log(err);
                });
            },
            addmeetings: function(){
                // console.log('test');
                var meetingleade_id = $('#meetting_lead_id option:selected').val();
                var meet_status_id = $('#meetingStatus option:selected').val();
                var contact_id = $('#contact_id option:selected').val();
                var phone = $('#meetingStatus option:selected').val();
                // var call_status_id = $('#callStatus option:selected').val();
                var duration = $('#meetingduration').val();
                var date = $('#date_meeting').val();
                var time = $('#time_meeting').val();
                var location = $('#location_meeting').val();
                var probability = $('#meetingprobability option:selected').val();
                var budget = $('#mettingbudget').val();
                var meetingnextactiontype = $('#meetingStatus option:selected').attr('next');

                var projects = [];
                $('#meetingprojects option:selected').each(function(i, item){
                    projects.push($(item).val());
                });
                var meetingdescription = $('#meetingdescription').val();
                var to_do_type = $('#meetingnextactiontype option:selected').val();
                var to_do_due_date = $('#meetingtododuedate').val();
                var to_do_description = $('#meetingtododesc').val();

                var data = {
                    // "_token": this.token,
                    // "user_id": this.user_id,
                    'lead_id': this.lead.id,
                    // "phone_in_out": this.phone_in_out,
                    "contact_id": contact_id,
                    "phone": phone,
                    "meeting_status_id": meet_status_id,
                    "duration": duration,
                    "date": date,
                    "time": time,
                    "location": location,
                    "probability": probability,
                    "budget": budget,
                    "projects": projects,
                    "description": meetingdescription,
                    "to_do_type": to_do_type,
                    "to_do_due_date": to_do_due_date,
                    "to_do_description": to_do_description,
                };

                console.log(data);
                // return false;
                console.log(data);
                var vmm =this;
                axios.post(this.meetings_url,
                    data
                ).then(function(response){
                    console.log(response);
                    vmm.getLeadData(vmm.lead.id);
                    $('#add_meeting_btn').trigger('click');
                    alertify.success('Success Add Meeting');
                })
                .catch(function(err){
                    console.log(err);
                });
            },
            addrequest: function(){
                var buyer_seller = $('#buyer_seller option:selected').val();
                var location = $('#location option:selected').val();
                var unit_type = $('#unit_type option:selected').val();
                var unit_type_id = $('#unit_type_id option:selected').val();
                var request_type = $('#request_type option:selected').val();
                var price_from = $('#price_from').val();
                var price_to = $('#price_to').val();
                var area_from = $('#area_from').val();
                var area_to = $('#area_to').val();
                var date = $('#date').val();
                var down_payment = $('#down_payment').val();
                var notes = $('#notes').val();

                var data = {
                    'lead_id': this.lead.id,
                    "buyer_seller": buyer_seller,
                    "location": location,
                    "unit_type": unit_type,
                    "unit_type_id": unit_type_id,
                    "request_type": request_type,
                    "price_from": price_from,
                    "price_to": price_to,
                    "area_from": area_from,
                    "area_to": area_to,
                    "date": date,
                    "down_payment": down_payment,
                    "notes": notes,
                };

                console.log(data);
                // return false;
                console.log(data);
                var vmrq =this;
                axios.post(this.Request_url,
                    data
                ).then(function(response){
                    console.log(response);
                    vmrq.getLeadData(vmrq.lead.id);
                    $('#add_request_btn').trigger('click');
                    alertify.success('Success Add Request');
                })
                .catch(function(err){
                    console.log(err);
                });
            },
            formatDate: function(val){
                if(!val) return '';
                return moment.unix(val).format('YYYY-MM-D');
            },
            getUserChars: function(user){
                if(user.name){
                        var cnames = user.name.split(' ');
                        var names = '';
                        if(cnames.length == 1){
                            names = cnames[0][0].toUpperCase();
                        } else if(cnames.length == 2){
                            names = cnames[0][0].toUpperCase() + cnames[1][0].toUpperCase();
                        }
                        return names;
                }

                return '';
            },
            resetVariables: function(vm){
                vm.c_agent_image = '';
                vm.l_image = '';
                vm.c_agent_image = '';
                vm.l_nameChars = '';
                vm.r_nameChars = '';
                vm.c_nameChars = '';
                vm.el = null;
                vm.filter = null;
            },
            showHintJQuery: function(){
                this.showHint(leadIdGlobal);
            },
            showHint(id){
                console.log('showHint ID: ' + this.url);

                if (!this.filter_show){
                    // console.log(response);
                    this.el.style.right = '0';

                    this.getLeadData(id);
                    // vm.filter.style.right = '500px';
                    this.filter_show = 1;

                }


            },
            closeHint: function(){
                // console.log('showHint ID: ' + this.test);
                if(this.filter_show > 0){
                    // console.log('if cond : ' + this.filter_show);
                    // this.el = document.querySelector('.filter');
                    this.el.style.right = '-500px';

                    // this.el = document.querySelector('.filter-icon');
                    // this.filter.style.right = '0';
                    this.filter_show = 0;
                     $('#not_view').hide();
                }
            },
            searchCloud: function(){
                if (this.phone){

                    var vm = this;
                    axios.post(this.cloud_url,
                        {"_token": this.token,"user_id": this.user_id, "phone": this.phone, "name": this.full_name}
                    ).then(function(response){
                        console.log(response);
                        // vm.el.style.right = '0';
                        //
                        // vm.lead = response.data.lead;
                        // // vm.filter.style.right = '500px';
                        // vm.filter_show = 1;
                    })
                    .catch(function(err){
                        console.error(err);
                    });
                }
            },
            testClick: function(){
                console.log('event listener working');
                console.log(this.filter_show);
            },
            switchPhone: function(){
                this.showEmail = false;
                this.showPhone = !this.showPhone;
                this.updateLead();
            },
            switchEmail: function(){
                this.showPhone = false;
                this.showEmail = !this.showEmail;
            }
        },
        mounted(){
            // var filter_icon = document.querySelector('.filter-icon');
            // filter_icon.addEventListener('click', this.closeHint);
            this.el = document.querySelector('.filter');
            console.log('Mounted');
            console.log('locale', this.locale);
            setTimeout(function(){
                // $('.select2').select2();
            }, 1000);
            // this.filter = document.querySelector('.filter-icon');
        }
    });


        // $('.filter-icon').on('click',function ()
        //     if (!filter_show){
        //         el = document.querySelector('.filter');
        //         el.style.right = '0';

        //         el = document.querySelector('.filter-icon');
        //         el.style.right = '500px';
        //         filter_show = 1;
        //     }else{
        //         el = document.querySelector('.filter');
        //         el.style.right = '-500px';

        //         el = document.querySelector('.filter-icon');
        //         el.style.right = '0';
        //         filter_show = 0;
        //     }

        // });
    </script>

    <script>
        $(document).on('change', '#meetingStatus', function() {
            var action = $('option:selected', this).attr('next');
            if (action == 1) {
                $('#MnextAction').html('<div class="well" id="Maction">' +
                    '<div class="form-group col-md-6">' +
                    '<label>{{ trans("admin.to_do_type") }}</label>' +
                    '<select class="form-control select2" id="meetingnextactiontype" name="to_do_type" data-placeholder="{{ trans("admin.to_do_type") }}" style="width: 100%">' +
                    '<option></option>' +
                    '<option value="call">{{ trans("admin.call") }}</option>' +
                    '<option value="meeting">{{ trans("admin.meeting") }}</option>' +
                    '<option value="other">{{ trans("admin.other") }}</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="form-group col-md-6">' +
                    '<label>{{ trans("admin.due_date") }}</label>' +
                    '<div class="input-group">' +
                    '<input class="form-control datetimepicker" placeholder="Due Date"  id="meetingtododuedate" name="to_do_due_date" type="text" value="">' +

                    // '{!! Form::text("to_do_due_date","",["class" => "form-control datepicker1", "placeholder" => trans("admin.due_date"),"readonly"=>""]) !!}' +
                    '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>{{ trans("admin.description") }}</label>' +
                    '<textarea class="form-control" placeholder="Description" rows="5" id="meetingtododesc" name="to_do_description" cols="50"></textarea>' +
                                        // '{!! Form::textarea("to_do_description","",["class" => "form-control", "placeholder" => trans("admin.description"),"rows"=>5]) !!}' +
                    '</div>' +
                    '</div>')
                // $('.select2').select2();
                $('.datetimepicker').datetimepicker({
                        format: 'yyyy-mm-dd hh:ii'
                });
                    $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd'
                });
                $('#MaddAction').addClass('hidden');
                $('#MremoveAction').removeClass('hidden');
            } else {
                $('#Maction').remove();
                $('#MremoveAction').addClass('hidden');
                $('#MaddAction').removeClass('hidden');
            }
        })
    </script>

    <script>
        $(document).on('click', '#getSuggestions', function () {
            var location = $('#location').val();
            var unit_type = $('#unit_type').val();
            console.log(unit_type);
            var unit_type_id = $('#unit_type_id').val();
            var request_type = $('#request_type').val();
            var rooms_from = $('#rooms_from').val();
            var rooms_to = $('#rooms_to').val();
            var bathrooms_from = $('#bathrooms_from').val();
            var bathrooms_to = $('#bathrooms_to').val();
            var price_from = $('#price_from').val();
            var price_to = $('#price_to').val();
            var area_from = $('#area_from').val();
            var area_to = $('#area_to').val();
            var date = $('#date').val();
            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ url(adminPath().'/get_suggestions')}}",
                method: 'post',
                data: {
                    location: location,
                    unit_type: unit_type,
                    unit_type_id: unit_type_id,
                    request_type: request_type,
                    rooms_from: rooms_from,
                    rooms_to: rooms_to,
                    bathrooms_from: bathrooms_from,
                    bathrooms_to: bathrooms_to,
                    price_from: price_from,
                    price_to: price_to,
                    area_from: area_from,
                    area_to: area_to,
                    date: date,
                    _token: _token
                },
                success: function (data) {

                    $('#get_suggestions').html(data);
                }
            });
        })

                $(document).on('change', '#unit_type', function () {
                    // alert('test');
            var usage = $(this).val();
            // var _token = 'MXUQ892sy4jI6Wsvddi2Th6ruZWPmB67s43s8tCw';
            var _token =  '{{ csrf_token() }}';
            $.ajax({
                url: "{{url(adminPath().'/get_unit_types')}}",
                method: 'post',

                data: {usage: usage, _token: _token},
                success: function (data) {
                    console.log(data);
                    $('#unit_type_id').html(data);
                }
            });
        });

      $(document).on('click','#note_show',function(){
           $('#not_view').show();
           $('#allNotes').show();
      });

    </script>
    <script>
        $(document).on('change', '#unit_type', function () {
            var usage = $(this).val();
            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ url(adminPath().'/get_unit_types')}}",
                method: 'post',

                data: {usage: usage, _token: _token},
                success: function (data) {
                    $('#unit_type_id').html(data);
                }
            });
        });
    </script>
    <script type="text/javascript">
    $('#switch_team').click(function(){
        var agent_id = $('#agent_id').val();
        var commercial_agent_id = $('#commercial_agent_id').val();
        var leads_teams = [$('#leads_teams').val()];
        // var leads['0'] = $('#leads').val();
        var _token =  '{{ csrf_token() }}';
        var data = {
            'agent_id':agent_id,
            'commercial_agent_id':commercial_agent_id,
            'leads':leads_teams,
            '_token':_token,
        }
        console.log(data);
        var url=  "{{ url(adminPath().'/switch_leads')}}";
        //  window.location = url;

        $.ajax({
          url :"{{ url(adminPath().'/switch_leads')}}",
          method : 'post',
          data: data,
          success:function(data){
              // alert('test');
              // location.reload();

               $('#alert_switch').show();

          }
        });


    });

    </script>

    <script type="text/javascript">
        $(document).on('change', '#checkAll_teams', function () {
            if ($("#checkAll_teams").is(':checked')) {
                $('.switch_teams').prop('checked', true);
            } else {
                $('.switch_teams').prop('checked', false);
            }
        });
        $(document).on('change', '#checkAll2', function () {
            // alert('testjhj');
            if ($("#checkAll2").is(':checked')) {
                $('.checked').prop('checked', true);
            } else {
                $('.checked').prop('checked', false);
            }
        });
        $(document).on('change', '#checkAll', function () {
            // alert('testjhj');
            if ($("#checkAll").is(':checked')) {
                $('.switch').prop('checked', true);
            } else {
                $('.switch').prop('checked', false);
            }
        });
    </script>

    <script type="text/javascript">
        $(document).on('click', '.switchLeadModal', function () {
            alert('test');
            $('#getLeadsTeams').html('');
            var arr = [];
            $('.switch_teams').each(function () {
                if ($(this).is(':checked')) {
                    var lead_id = $(this).val();
                    arr.push(lead_id);
                    console.log(arr);
                    $('#leads_teams').val(lead_id);
                    $('#getLeadsTeams').append(
                        '<input type="hidden" name="leads[]" value="' + lead_id + '">'
                    )
                }
            }
        );
    });

    </script>






@stop
