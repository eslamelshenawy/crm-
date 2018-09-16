@extends('admin.index')

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('admin.events') }}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            {{-- <a class="btn btn-success btn-flat @if(app()->getLocale() == 'en') pull-right @else pull-left @endif"
               href="{{ url(adminPath().'/events/create') }}">{{ trans('admin.add') }}</a> --}}
            <table class="table datatable table-striped table-bordered  dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>{{ trans('admin.id') }}</th>
                    <th>{{ trans('admin.name') }}</th>
                    <th>{{ trans('admin.status') }}</th>
                    {{-- <th>{{ trans('admin.date') }}</th> --}}
                    {{-- <th>{{ trans('admin.show') }}</th> --}}
                    {{-- <th>{{ trans('admin.edit') }}</th> --}}
                    {{-- <th>{{ trans('admin.delete') }}</th> --}}
                </tr>
                </thead>
                <tbody>

                @foreach($show_events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{$event->users_event->name}}</td>
                        @if ($event->accept == 1)
                            <td>{{'Accept'}}</td>

                            @else
                                <td>{{'Declined'}}</td>

                        @endif
                        {{-- <td>{{$event->accept }}</td> --}}
                        {{-- <td>{{ $event->date_event }}</td> --}}
                        {{-- <td><a href="{{ url(adminPath().'/show_event/'.$event->id) }}"
                               class="btn btn-primary btn-flat">{{ trans('admin.show') }}</a></td> --}}
                        {{-- <td><a href="{{ url(adminPath().'/events/'.$event->id.'/edit') }}"
                               class="btn btn-warning btn-flat">{{ trans('admin.edit') }}</a></td> --}}
                        {{-- <td><a data-toggle="modal" data-target="#delete{{ $event->id }}"
                               class="btn btn-danger btn-flat">{{ trans('admin.delete') }}</a></td> --}}
                    </tr>
                    {{-- <div id="delete{{ $event->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{ trans('admin.delete') . ' ' . trans('admin.lead_source') }}</h4>
                                </div>
                                <div class="modal-body">
                                    <p>{{ trans('admin.delete') . ' ' . $event->name }}</p>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::open(['method'=>'DELETE','route'=>['events.destroy',$event->id]]) !!}
                                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">{{ trans('admin.close') }}</button>
                                    <button type="submit" class="btn btn-danger btn-flat">{{ trans('admin.delete') }}</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>

                        </div>
                    </div> --}}
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
            "order": [[ 0, "asc" ]],
            'autoWidth': true
        })
    </script>
@stop
