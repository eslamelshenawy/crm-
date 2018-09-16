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
               href="{{ url(adminPath().'/leads/create') }}">{{ trans('admin.add') }}</a>
               @if(checkRole('export_excel') or @auth()->user()->type == 'admin')
                <a class="btn btn-success btn-flat @if(app()->getLocale() == 'en') pull-right @else pull-left @endif"
                   style="margin: 0 7px" href="{{ url(adminPath().'/xlsrequest') }}">Excel</a>
               @endif
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#active_leads" data-toggle="tab"
                                          aria-expanded="false">{{ trans('admin.my_leads') }}</a></li>
                    @if(@auth()->user()->type == 'admin')
                        <li class=""><a href="#individual_leads" data-toggle="tab"
                                        aria-expanded="true">{{ trans('admin.individual_leads') }}</a></li>
                    @endif
                    @if(auth()->user()->type == 'admin' or @\App\Group::where('team_leader_id', auth()->id())->count())
                        <li class=""><a href="#team_leads" data-toggle="tab"
                                        aria-expanded="true">{{ trans('admin.team_leads') }}</a></li>
                    @endif
                    <li class=""><a href="#hot_leads" data-toggle="tab"
                                    aria-expanded="true">{{ trans('admin.hot') . ' ' . trans('admin.leads') }}</a></li>
                    <li class=""><a href="#fav_leads" data-toggle="tab"
                                    aria-expanded="true">{{ trans('admin.favorite') . ' ' . trans('admin.leads') }}</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" style="min-height: 650px;" id="active_leads">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{ trans('admin.id') }}</th>
                                <th>{{ trans('admin.name') }}</th>
                                <th>{{ trans('admin.email') }}</th>
                                <th>{{ trans('admin.phone') }}</th>
                                <th>{{ trans('admin.source') }}</th>
                                <th>{{ trans('admin.agent') }}</th>
                                <th>{{ trans('admin.favorite') }}</th>
                                <th>{{ trans('admin.hot') }}</th>
                                <th>{{ trans('admin.show') }}</th>
                                <th>{{ trans('admin.edit') }}</th>
                                <th>{{ trans('admin.delete') }}</th>
                                <th>{{ trans('admin.switch') }}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    @if(auth()->user()->type == 'admin')
                        <div class="tab-pane" style="min-height: 650px;" id="individual_leads">
                            <a data-toggle="modal" data-target="#switchLead"
                               class="btn btn-success btn-flat" id="switchLeadModal">{{ trans('admin.switch') }}</a>
                            <table class="table table-hover table-striped datatable1" style="width: 100%">
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
                                    <th>{{ trans('admin.id') }}</th>
                                    <th>{{ trans('admin.name') }}</th>
                                    <th>{{ trans('admin.email') }}</th>
                                    <th>{{ trans('admin.phone') }}</th>
                                    <th>{{ trans('admin.source') }}</th>
                                    <th>{{ trans('admin.show') }}</th>
                                    <th>{{ trans('admin.edit') }}</th>
                                    <th>{{ trans('admin.delete') }}</th>
                                </tr>
                                </thead>
                            </table>
                            <div id="switchLead" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{ trans('admin.delete') . ' ' . trans('admin.lead_source') }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            {!! Form::open(['method'=>'post','url'=>adminPath().'/switch_leads']) !!}
                                            <select class="select2" name="agent_id"
                                                    data-placeholder="{{ __('admin.agent') }}" style="width: 100%">
                                                <option></option>
                                                @foreach(@\App\User::all() as $agent)
                                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                                @endforeach
                                            </select>
                                            <span id="getLeads"></span>
                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-default btn-flat"
                                                    data-dismiss="modal">{{ trans('admin.close') }}</button>
                                            <button type="submit"
                                                    class="btn btn-success btn-flat">{{ trans('admin.switch') }}</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                    @if(auth()->user()->type == 'admin' or @\App\Group::where('team_leader_id', auth()->id())->count())
                        <div class="tab-pane" style="min-height: 650px;" id="team_leads">
                            <select class="form-control select2" id="teamAgent" style="width: 100%"
                                    data-placeholder="{{ __('admin.agent') }}">
                                <option></option>
                                @foreach($agents as $agent)
                                    <option value="{{ @$agent->id }}">{{ @$agent->name }}</option>
                                @endforeach
                            </select>

                            <table class="table table-hover table-striped datatableTeam" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>{{ trans('admin.id') }}</th>
                                    <th>{{ trans('admin.agent') }}</th>
                                    <th>{{ trans('admin.name') }}</th>
                                    <th>{{ trans('admin.email') }}</th>
                                    <th>{{ trans('admin.phone') }}</th>
                                    <th>{{ trans('admin.source') }}</th>
                                    <th>{{ trans('admin.show') }}</th>
                                    <th>{{ trans('admin.edit') }}</th>
                                    <th>{{ trans('admin.delete') }}</th>
                                    <th>{{ trans('admin.switch') }}</th>
                                </tr>
                                </thead>
                                <tbody id="teamData">

                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="tab-pane" style="min-height: 650px;" id="hot_leads">
                        <table class="table table-hover table-striped datatable2" style="width: 100%">
                            <thead>
                            <tr>
                                <th>{{ trans('admin.id') }}</th>
                                <th>{{ trans('admin.name') }}</th>
                                <th>{{ trans('admin.email') }}</th>
                                <th>{{ trans('admin.phone') }}</th>
                                <th>{{ trans('admin.source') }}</th>
                                <th>{{ trans('admin.show') }}</th>
                                <th>{{ trans('admin.edit') }}</th>
                                <th>{{ trans('admin.delete') }}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane" style="min-height: 650px;" id="fav_leads">
                        <table class="table table-hover table-striped datatable3" style="width: 100%">
                            <thead>
                            <tr>
                                <th>{{ trans('admin.id') }}</th>
                                <th>{{ trans('admin.name') }}</th>
                                <th>{{ trans('admin.email') }}</th>
                                <th>{{ trans('admin.phone') }}</th>
                                <th>{{ trans('admin.source') }}</th>
                                <th>{{ trans('admin.show') }}</th>
                                <th>{{ trans('admin.edit') }}</th>
                                <th>{{ trans('admin.delete') }}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).on('change', '#teamAgent', function () {
            var id = $(this).val();
            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: '{{ url(adminPath() . '/filter_team_leads') }}',
                dataType: 'html',
                data: {_token: _token, id: id},
                type: 'post',
                success: function (data) {
                    $('#teamData').html(data);
                }
            })
        })
    </script>
    <script>
        $('.datatable').DataTable({
            dom: 'Bfrtip',
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
            select: true,
            pagingType: "full_numbers",
            order: [[0, 'desc']],
            processing: false,
            serverSide: true,
            ajax: '{{ url(adminPath().'/leads_ajax') }}',
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'source'},
                {data: 'agent'},
                {data: 'fav', searchable: false, sortable: false},
                {data: 'hot', searchable: false, sortable: false},
                {data: 'show', searchable: false, sortable: false},
                {data: 'edit', searchable: false, sortable: false},
                {data: 'delete', searchable: false, sortable: false},
                {data: 'switch', searchable: false, sortable: false}
            ]
        });
        $('.datatable1').DataTable({
            dom: 'Bfrtip',
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
            processing: false,
            serverSide: true,
            ajax: '{{ url(adminPath().'/leads_ind_ajax') }}',
            columns: [
                {data: 'checkbox'},
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'source'},
                {data: 'show', searchable: false, sortable: false},
                {data: 'edit', searchable: false, sortable: false},
                {data: 'delete', searchable: false, sortable: false}
            ]
        });
        $('.datatable2').DataTable({
            dom: 'Bfrtip',
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
            processing: false,
            serverSide: true,
            ajax: '{{ url(adminPath().'/leads_hot_ajax') }}',
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'source'},
                {data: 'show', searchable: false, sortable: false},
                {data: 'edit', searchable: false, sortable: false},
                {data: 'delete', searchable: false, sortable: false}
            ]
        });
        $('.datatable3').DataTable({
            dom: 'Bfrtip',
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
            processing: false,
            serverSide: true,
            ajax: '{{ url(adminPath().'/leads_fav_ajax') }}',
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'source'},
                {data: 'show', searchable: false, sortable: false},
                {data: 'edit', searchable: false, sortable: false},
                {data: 'delete', searchable: false, sortable: false}
            ]
        });
        $('.datatableTeam').DataTable({
            dom: 'Bfrtip',
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
            processing: false,
            serverSide: true,
            ajax: '{{ url(adminPath().'/team_leads_ajax') }}',
            columns: [
                {data: 'id'},
                {data: 'agent'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'source'},
                {data: 'show', searchable: false, sortable: false},
                {data: 'edit', searchable: false, sortable: false},
                {data: 'delete', searchable: false, sortable: false},
                {data: 'switch', searchable: false, sortable: false}
            ]
        });
    </script>
    <script>
        $(document).on('change', '#checkAll', function () {
            if ($("#checkAll").is(':checked')) {
                $('.switch').prop('checked', true);
            } else {
                $('.switch').prop('checked', false);
            }
        });
    </script>
    <script>
        $(document).on('click', '#switchLeadModal', function () {
            $('#getLeads').html('');
            $('.switch').each(function () {
                if ($(this).is(':checked')) {
                    $('#getLeads').append(
                        '<input type="hidden" name="leads[]" value="' + $(this).val() + '">'
                    )
                }
            });
        })
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
@stop