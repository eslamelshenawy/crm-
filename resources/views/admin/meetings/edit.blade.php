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
            {!! Form::open(['url' => adminPath().'/meetings/'.$meeting->id , 'method'=>'put']) !!}
            <div class="form-group @if($errors->has('lead_id')) has-error @endif">
                <label>{{ trans('admin.lead') }}</label>
                <select name="lead_id" class="form-control select2" style="width: 100%"
                        data-placeholder="{{ trans('admin.lead') }}" id="lead_id">
                    <option></option>
                    @foreach(@App\Lead::getAgentLeads() as $lead)
                        <option value="{{ $lead->id }}"
                                @if($meeting->lead_id == $lead->id) selected @endif>
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
                    <select name="contact_id" class="form-control select2" id="contact_id" style="width: 100%"
                            data-placeholder="{{ trans('admin.contact') }}">
                        <option value="0">{{ trans('admin.lead') }}</option>
                        @foreach(@\App\Contact::where('lead_id',request()->lead)->get() as $contact)
                            <option value="{{ $contact->id }}">
                                {{ $contact->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                    @endif
            </span>


            <div class="form-group @if($errors->has('duration')) has-error @endif">
                <label>{{ trans('admin.duration') }}</label>
                {!! Form::number('duration',$meeting->duration,['class' => 'form-control', 'placeholder' => trans('admin.duration')]) !!}
            </div>


            <div class="form-group @if($errors->has('date')) has-error @endif">
                <label>{{ trans('admin.date') }}</label>
                <div class="input-group">
                    {!! Form::text('date',date('Y-m-d',$meeting->date),['class' => 'form-control datepicker', 'placeholder' => trans('admin.date'),'readonly'=>'']) !!}
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>

            <div class="form-group @if($errors->has('time')) has-error @endif">
                <label>{{ trans('admin.time') }}</label>
                <div class="input-group bootstrap-timepicker timepicker">
                    {!! Form::text('time',$meeting->time,['class' => 'form-control timepicker', 'placeholder' => trans('admin.time'),'readonly'=>'']) !!}
                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                </div>
            </div>

            <div class="form-group @if($errors->has('location')) has-error @endif">
                <label>{{ trans('admin.location') }}</label>
                {!! Form::text('location',$meeting->location,['class' => 'form-control', 'placeholder' => trans('admin.location')]) !!}
            </div>
            <div class="form-group @if($errors->has('probability')) has-error @endif" style="width:97%">
                <label>{{ trans('admin.probability') }}</label>
                <select class="form-control select2" name="probability" >
                    <option></option>
                    <option value="highest" @if(old('probability')=='highest' || $meeting->probability == 'highest') selected @endif>{{ __('admin.highest') }}</option>
                    <option value="high" @if(old('probability')=='high' || $meeting->probability == 'high') selected @endif>{{ __('admin.high') }}</option>
                    <option value="normal" @if(old('probability')=='normal' || $meeting->probability == 'normal') selected @endif>{{ __('admin.normal') }}</option>
                    <option value="low" @if(old('probability')=='low' || $meeting->probability == 'low') selected @endif>{{ __('admin.low') }}</option>
                    <option value="lowest" @if(old('probability')=='lowest' || $meeting->probability == 'lowest') selected @endif >{{ __('admin.lowest') }}</option>
                </select>
            </div>
            <div class="form-group @if($errors->has('description')) has-error @endif">
                <label>{{ trans('admin.description') }}</label>
                {!! Form::textarea('description',$meeting->description,['class' => 'form-control', 'placeholder' => trans('admin.description'),'rows'=>5]) !!}
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
                url: "{{ url(adminPath().'/get_contacts')}}",
                method: 'post',
                dataType: 'html',
                data: {id: id, _token: _token},
                success: function (data) {
                    $('#contacts').html(data);
                    $('.select2').select2();
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
