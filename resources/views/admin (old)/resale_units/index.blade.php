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
            <a class="btn btn-success btn-flat @if(app()->getLocale() == 'en') pull-right @else pull-left @endif"
               href="{{ url(adminPath().'/resale_units/create') }}">{{ trans('admin.add') }}</a>
            <table class="table table-hover table-striped datatable">
                <thead>
                <tr>
                    <th>{{ trans('admin.property') }}</th>
                    <th>{{ trans('admin.title') }}</th>
                    <th>{{ trans('admin.status') }}</th>
                    <th>{{ trans('admin.location') }}</th>
                    <th>{{ trans('admin.price') }}</th>
                    <th>{{ trans('admin.rooms') }}</th>
                    <th>{{ trans('admin.bathrooms') }}</th>
                    <th>{{ trans('admin.area') }}</th>
                    <th>{{ trans('admin.delivery_date') }}</th>
                    <th>{{ trans('admin.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($units as $unit)
                    <tr>
                        <td><img src="{{ url('uploads/'.$unit->image) }}" width="75 px"></td>
                        <td>{{ $unit->{app()->getLocale().'_title'} }}</td>
                        <td>{{ trans('admin.'.$unit->availability) }}</td>
                        <td>{{ @\App\Location::find($unit->location)->{app()->getLocale().'_name'} }}</td>
                        <td>{{ $unit->total }}</td>
                        <td>{{ $unit->rooms }}</td>
                        <td>{{ $unit->bathrooms }}</td>
                        <td>{{ $unit->area }}</td>
                        <td>{{ $unit->delivery_date }}</td>
                        <td><a href="{{ url(adminPath().'/resale_units/'.$unit->id) }}"
                               class="btn btn-primary btn-flat">{{ trans('admin.show') }}</a>
                            <a href="{{ url(adminPath().'/resale_units/'.$unit->id.'/edit') }}"
                               class="btn btn-warning btn-flat">{{ trans('admin.edit') }}</a>
                            <a data-toggle="modal" data-target="#delete{{ $unit->id }}"
                               class="btn btn-danger btn-flat">{{ trans('admin.delete') }}</a></td>
                        @if($unit->confirmed)

                            <a href="{{ url(adminPath().'/resale_units/'.$unit->id) }}" class="btn btn-warning btn-flat"> added by lead</a>
                        @endif
                    </tr>
                    <div id="delete{{ $unit->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{ trans('admin.delete') . ' ' . trans('admin.resale_unit') }}</h4>
                                </div>
                                <div class="modal-body">
                                    <p>{{ trans('admin.delete') . ' ' . $unit->name }}</p>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::open(['method'=>'DELETE','route'=>['resale_units.destroy',$unit->id]]) !!}
                                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">{{ trans('admin.close') }}</button>
                                    <button type="submit" class="btn btn-danger btn-flat">{{ trans('admin.delete') }}</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.datatable').dataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            "order": [[ 0, "desc" ]],
            'autoWidth': true
        })
    </script>
@stop