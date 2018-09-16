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
            <div class="col-md-9">
                <select class="select2 form-control" data-placeholder="{{ __('admin.developer') }}" id="developer">
                    <option></option>
                    <option value="all">{{ __('admin.all') }}</option>
                    @foreach(@\App\Developer::get() as $dev)
                        <option value="{{ $dev->id }}">{{ $dev->{app()->getLocale().'_name'} }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <a class="btn btn-success btn-flat @if(app()->getLocale() == 'en') pull-right @else pull-left @endif"
                   href="{{ url(adminPath().'/projects/create') }}">{{ trans('admin.add') }}</a>
            </div>
            <table class="table table-hover table-striped datatable">
                <thead>
                <tr>
                    <th>{{ trans('admin.id') }}</th>
                    <th>{{ trans('admin.en_name') }}</th>
                    <th>{{ trans('admin.developer') }}</th>
                    <th>{{ trans('admin.phases') }}</th>
                    <th>{{ trans('admin.show') }}</th>
                    <th>{{ trans('admin.edit') }}</th>
                    <th>{{ trans('admin.delete') }}</th>
                </tr>
                </thead>
                <tbody id="data">
                @foreach($project as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->{app()->getLocale().'_name'} }}</td>
                        <td>
                            <a href="{{ url(adminPath().'/developers/'.$row->developer_id) }}">{{ @App\Developer::find($row->developer_id)->{app()->getLocale().'_name'} }}</a>
                        </td>
                        <td>{{ @\App\Phase::where('project_id',$row->id)->count() }}</td>
                        {{--<td>--}}
                        {{--@if($row->featured == 0)--}}
                        {{--<a href="{{ url(adminPath().'/project_featured/'.$row->id) }}"><span class="fa fa-star"></span></a>--}}
                        {{--@elseif($row->featured == 1)--}}
                        {{--<a href="{{ url(adminPath().'/project_un_featured/'.$row->id) }}"><span class="fa fa-star featured"></span></a>--}}
                        {{--@endif--}}
                        {{--</td>--}}
                        <td><a href="{{ url(adminPath().'/projects/'.$row->id) }}"
                               class="btn btn-primary btn-flat">{{ trans('admin.show') }}</a></td>
                        <td><a href="{{ url(adminPath().'/projects/'.$row->id.'/edit') }}"
                               class="btn btn-warning btn-flat">{{ trans('admin.edit') }}</a></td>
                        <td><a data-toggle="modal" data-target="#delete{{ $row->id }}"
                               class="btn btn-danger btn-flat">{{ trans('admin.delete') }}</a></td>
                    </tr>
                    <div id="delete{{ $row->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{ trans('admin.delete') . ' ' . trans('admin.lead_source') }}</h4>
                                </div>
                                <div class="modal-body">
                                    <p>{{ trans('admin.delete') . ' ' . $row->name }}</p>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::open(['method'=>'DELETE','route'=>['projects.destroy',$row->id]]) !!}
                                    <button type="button" class="btn btn-default btn-flat"
                                            data-dismiss="modal">{{ trans('admin.close') }}</button>
                                    <button type="submit"
                                            class="btn btn-danger btn-flat">{{ trans('admin.delete') }}</button>
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
            "order": [[0, "desc"]],
            'autoWidth': true
        })
    </script>
    <script>
        $(document).on('change', '#developer', function () {
            var dev = $(this).val();
            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ url(adminPath().'/get_developer_projects')}}",
                method: 'post',
                dataType: 'html',
                data: {dev: dev, _token: _token},
                success: function (data) {
                    $('#data').html(data);
                }
            })
        })
    </script>
@endsection