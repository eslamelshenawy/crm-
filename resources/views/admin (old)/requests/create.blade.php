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
            <form action="{{ url(adminPath().'/requests') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group @if($errors->has('lead')) has-error @endif col-md-12">
                    <label>{{ trans('admin.lead') }}</label>
                    <select name="lead" class="form-control select2" style="width: 100%"
                            data-placeholder="{{ trans('admin.lead') }}">
                        <option></option>
                        @foreach(@App\Lead::getAgentLeads() as $lead)
                            <option value="{{ $lead->id }}"
                                    @if(old('lead_id') == $lead->id) selected @endif>
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

                <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }} col-md-3">
                    {!! Form::label(trans('admin.location')) !!}
                    <select class="select2 form-control" id="location" name="location" style="width: 100%"
                            data-placeholder="{{ trans('admin.location') }}">
                        <option></option>
                        @foreach(@\App\Location::all() as $location)
                            <option value="{{ $location->id }}">{{ $location->{app()->getLocale().'_name'} }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group {{ $errors->has('unit_type') ? 'has-error' : '' }} col-md-3">
                    {!! Form::label(trans('admin.type')) !!}
                    <select class="select2 form-control" id="unit_type" name="unit_type" style="width: 100%"
                            data-placeholder="{{ trans('admin.type') }}">
                        <option></option>
                        <option value="commercial">{{ trans('admin.commercial') }}</option>
                        <option value="personal">{{ trans('admin.personal') }}</option>
                        <option value="land">{{ trans('admin.land') }}</option>
                    </select>
                </div>

                <div class="form-group {{ $errors->has('unit_type_id') ? 'has-error' : '' }} col-md-3">
                    {!! Form::label(trans('admin.unit_type')) !!}
                    <select class="select2 form-control" id="unit_type_id" name="unit_type_id" style="width: 100%"
                            data-placeholder="{{ trans('admin.unit_type') }}">
                        <option></option>
                    </select>
                </div>

                <div class="form-group {{ $errors->has('request_type') ? 'has-error' : '' }} col-md-3">
                    {!! Form::label(trans('admin.request_type')) !!}
                    <select class="select2 form-control" id="request_type" name="request_type" style="width: 100%"
                            data-placeholder="{{ trans('admin.request_type') }}">
                        <option></option>
                        <option value="resale">{{ trans('admin.resale') }}</option>
                        <option value="rental">{{ trans('admin.rental') }}</option>
                        <option value="new_home">{{ trans('admin.new_home') }}</option>
                    </select>
                </div>

                <span id="resale_rental" class="hidden">
                    <div class="form-group col-md-6 @if($errors->has('rooms_from')) has-error @endif">
                        <label> {{ trans('admin.rooms_from') }}</label>
                        <input type="number" name="rooms_from" id="rooms_from" class="form-control"
                               value="{{ old('rooms_from') }}"
                               placeholder="{{ trans('admin.from') }}">
                    </div>
                    <div class="form-group col-md-6 @if($errors->has('rooms_to')) has-error @endif">
                        <label> {{ trans('admin.rooms_to') }}</label>
                        <input type="number" name="rooms_to" id="rooms_to" class="form-control"
                               value="{{ old('rooms_to') }}"
                               placeholder="{{ trans('admin.to') }}">
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('bathrooms_from')) has-error @endif">
                        <label> {{ trans('admin.bathrooms_from') }}</label>
                        <input type="number" name="bathrooms_from" id="bathrooms_from" class="form-control"
                               value="{{ old('bathrooms_from') }}"
                               placeholder="{{ trans('admin.from') }}">
                    </div>
                    <div class="form-group col-md-6 @if($errors->has('bathrooms_to')) has-error @endif">
                        <label> {{ trans('admin.bathrooms_to') }}</label>
                        <input type="number" name="bathrooms_to" id="bathrooms_to" class="form-control"
                               value="{{ old('bathrooms_to') }}"
                               placeholder="{{ trans('admin.to') }}">
                    </div>
                </span>

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
                    <input type="number" name="area_to" id="area_to" class="form-control" value="{{ old('area_to') }}"
                           placeholder="{{ trans('admin.to') }}">
                </div>

                <div class="form-group @if($errors->has('date')) has-error @endif col-md-12">
                    <label>{{ trans('admin.delivery_date') }}</label>
                    <div class="input-group">
                        {!! Form::text('date','',['class' => 'form-control datepicker1', 'placeholder' => trans('admin.delivery_date'),'readonly'=>'','id'=>'date']) !!}
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>

                <div class="form-group @if($errors->has('down_payment')) has-error @endif col-md-12">
                    <label>{{ trans('admin.down_payment') }}</label>
                    <input type="number" class="form-control" name="down_payment"
                           placeholder="{{ trans('admin.down_payment') }}">
                </div>

                <div class="form-group @if($errors->has('notes')) has-error @endif col-md-12">
                    <label> {{ trans('admin.notes') }}</label>
                    <textarea name="notes" class="form-control" value="{{ old('notes') }}"
                              placeholder="{!! trans('admin.notes') !!}" rows="6"></textarea>
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-success btn-flat"
                            id="getSuggestions">{{ trans('admin.suggestions') }}</button>
                    <button type="submit" class="btn btn-primary btn-flat">{{ trans('admin.submit') }}</button>
                </div>
            </form>
            <span id="get_suggestions"></span>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.datepicker1').datepicker({
            autoclose: true,
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years",
        });
    </script>
    <script>
        $(document).on('change', '#unit_type', function () {
            $('#unit_type').prop('disabled', false);
            $('#request_type').prop('disabled', false);
            var usage = $(this).val();
            if (usage != 'land') {
                var _token = '{{ csrf_token() }}';
                $.ajax({
                    url: "{{ url(adminPath().'/get_unit_types')}}",
                    method: 'post',

                    data: {usage: usage, _token: _token},
                    success: function (data) {
                        $('#unit_type_id').html(data);
                    }
                });
            } else {
                $('#unit_type').prop('disabled', true);
                $('#request_type').prop('disabled', true);
                $('#resale_rental').addClass('hidden');
            }
        });
    </script>
    <script>
        $(document).on('change', '#request_type', function () {
            var reqType = $(this).val();
            if (reqType == 'new_home') {
                $('#resale_rental').addClass('hidden');
            } else {
                $('#resale_rental').removeClass('hidden');
            }
        })
    </script>
    <script>
        $(document).on('click', '#getSuggestions', function () {
            var location = $('#location').val();
            var unit_type = $('#unit_type').val();
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
    </script>
@endsection