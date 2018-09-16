@extends('admin.index')

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            {!! Form::open(['url' => adminPath().'/calls/'.$call->id , 'method'=>'put']) !!}
            <div class="form-group @if($errors->has('lead_id')) has-error @endif">
                <label>{{ trans('admin.lead') }}</label>
                <select name="lead_id" class="form-control select2" style="width: 100%"
                        data-placeholder="{{ trans('admin.lead') }}" id="lead_id">
                    <option></option>
                    @foreach(@App\Lead::getAgentLeads() as $lead)
                        <option value="{{ $lead->id }}"
                                @if(old('lead_id') == $lead->id) selected
                                @elseif(request()->lead == $lead->id) selected @endif>
                            {{ $lead->first_name . ' ' . $lead->last_name }}
                            -
                            @if($lead->agent_id == auth()->id())
                                {{ __('admin.my_lead') }}
                            @else
                                {{ __('admin.team_lead', ['agent' => @$lead->agent->name]) }}
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <span id="contacts">
                @if(request()->has('lead'))
                    <div class="form-group @if($errors->has('contact_id')) has-error @endif">
                        <label>{{ trans('admin.contact') }}</label>
                        <select name="contact_id" class="form-control select2" id="Contact_id" style="width: 100%"
                                data-placeholder="{{ trans('admin.contact') }}">
                            <option value="0">{{ trans('admin.lead') }}</option>
                            @foreach(@\App\Contact::where('lead_id',request()->lead)->get() as $contact)
                                <option value="{{ $contact->id }}">
                                    {{ $contact->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <span id="getPhones">
                    <div class="form-group">
                        <label>{{ trans('admin.phone') }}</label>
                        <select name="phone" class="form-control select2" id="phone" style="width: 100%"
                                data-placeholder="{{ trans('admin.phone') }}">
                            <option value="{{ @$lead->phone }}">{{ @$lead->phone }}</option>
                            @if(@$lead->other_phones != null)
                                @php($allPhones = json_decode(@$lead->other_phones))
                                @foreach($allPhones as $phones)
                                    @foreach($phones as $phone => $v)
                                        <option value="{{ $phone }}">
                                    {{ $phone }}
                                </option>
                                    @endforeach
                                @endforeach
                            @endif
                        </select>
                    </div>
                    </span>
                @endif
            </span>

            <div class="form-group @if($errors->has('duration')) has-error @endif">
                <label>{{ trans('admin.duration') }}</label>
                {!! Form::number('duration',$call->duration,['class' => 'form-control', 'placeholder' => trans('admin.duration')]) !!}
            </div>



            <div class="form-group @if($errors->has('date')) has-error @endif">
                <label>{{ trans('admin.date') }}</label>
                <div class="input-group">
                    {!! Form::text('date',date('Y-m-d',$call->date),['class' => 'form-control datepicker', 'placeholder' => trans('admin.date'),'readonly'=>'']) !!}
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>

            <div class="form-group @if($errors->has('probability')) has-error @endif" style="width:97%">
                <label>{{ trans('admin.probability') }}</label>
                <select class="form-control select2" name="probability" >
                    <option></option>
                    <option value="highest" @if(old('probability')=='highest' || $call->probability == 'highest') selected @endif>{{ __('admin.highest') }}</option>
                    <option value="high" @if(old('probability')=='high' || $call->probability == 'high') selected @endif>{{ __('admin.high') }}</option>
                    <option value="normal" @if(old('probability')=='normal' || $call->probability == 'normal') selected @endif>{{ __('admin.normal') }}</option>
                    <option value="low" @if(old('probability')=='low' || $call->probability == 'low') selected @endif>{{ __('admin.low') }}</option>
                    <option value="lowest" @if(old('probability')=='lowest' || $call->probability == 'lowest') selected @endif >{{ __('admin.lowest') }}</option>
                </select>
            </div>
            
            <div class="form-group @if($errors->has('projects')) has-error @endif">
                <label>{{ trans('admin.projects') }}</label>
                @php($projects = json_decode($call->projects))
                <select multiple class="form-control select2" name="projects[]" style="width: 100%" data-placeholder="{{ trans('admin.projects') }}">
                    <option></option>
                    @foreach(@\App\Project::get() as $project)
                        <option value="{{ $project->id }}" @if(in_array($project->id, $projects)) selected @endif>{{ $project->{app()->getLocale().'_name'} }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group @if($errors->has('description')) has-error @endif">
                <label>{{ trans('admin.description') }}</label>
                {!! Form::textarea('description',$call->description,['class' => 'form-control', 'placeholder' => trans('admin.description'),'rows'=>5]) !!}
            </div>
            <button type="submit" class="btn btn-primary btn-flat">{{ trans('admin.submit') }}</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).on('change', '#lead_id', function () {
            var id = $(this).val();
            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ url(adminPath().'/get_calls_contacts')}}",
                method: 'post',
                dataType: 'html',
                data: {id: id, _token: _token},
                success: function (data) {
                    $('#contacts').html(data);
                    $('.select2').select2();
                }
            });
            $.ajax({
                url: "{{ url(adminPath().'/get_calls')}}",
                method: 'post',
                dataType: 'html',
                data: {id: id, _token: _token},
                success: function (data) {
                    $('#getCalls').html(data);
                }
            });

            $.ajax({
                url: "{{ url(adminPath().'/get_meetings')}}",
                method: 'post',
                dataType: 'html',
                data: {id: id, _token: _token},
                success: function (data) {
                    $('#getMeetings').html(data);
                }
            });

            $.ajax({
                url: "{{ url(adminPath().'/get_requests')}}",
                method: 'post',
                dataType: 'html',
                data: {id: id, _token: _token},
                success: function (data) {
                    $('#getRequests').html(data);
                }
            })
        })
    </script>

@endsection
