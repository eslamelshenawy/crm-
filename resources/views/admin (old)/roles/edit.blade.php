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
            {!! Form::open(['url' => adminPath().'/roles/'.$role->id , 'method'=>'put']) !!}
            <div class="form-group @if($errors->has('name')) has-error @endif">
                <label>{{ trans('admin.name') }}</label>
                {!! Form::text('name',$role->name,['class' => 'form-control', 'placeholder' => trans('admin.name')]) !!}
            </div>
            <div class="form-group @if($errors->has('roles')) has-error @endif">
                <label>{{ trans('admin.roles') }}</label>
                @php($roles = json_decode($role->roles))
                @foreach($roles as $k => $v)
                    <input type="hidden" name="roles[{{ $k }}]" value="0">
                    <input type="checkbox" name="roles[{{ $k }}]" class="switch-box" data-on-text="{{ __('admin.yes') }}"
                           data-off-text="{{ __('admin.no') }}" @if($v) checked @endif data-label-text="{{ __('admin.'.$k) }}" value="1">
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary btn-flat">{{ trans('admin.submit') }}</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection