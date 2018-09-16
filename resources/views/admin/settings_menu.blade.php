@extends('admin.index')
@section('content')
<style>
    .select2 {
        width:100% !important;
    }
    .modal-content{
        width:800px; !important;
    }
    .modal-dialog{
        width:fit-content !important;
    }
    .modal-footer{
        clear:both;
    }
</style>
    <div id="refreshSitemap" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('admin.refresh_sitemap') }}</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('admin.last') . ' ' . trans('admin.refresh_sitemap') }}
                        : <span style="color: red" id="refreshDate">{{ date('Y-m-d',@\App\Setting::find(1)->refresh_sitemap) }}</span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat"
                            data-dismiss="modal">{{ trans('admin.close') }}</button>
                    <button type="button" id="refreshSitemap" class="btn btn-success btn-flat"><i class="fa fa-refresh" id="spinner"></i> {{ trans('admin.refresh') }}</button>
                </div>
            </div>

        </div>
    </div>
    <div id="newNotification" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('admin.notification') }}</h4>
                    {!! Form::open(['url' => adminPath().'/lead_notifications']) !!}
                </div>
                 <div class="modal-body">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Location:</label>
                            <select  name="nlocation" class="form-control select2 noti-select">
                            <option>No location</option>
                            @foreach(@App\Location::all() as $project)
                                <option value="{{ $project->id }}">{{ $project->{app()->getLocale().'_name'} }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Developer:</label>
                            <select name="ndeveloper" class="form-control select2 noti-select">
                            <option>No Developer</option>
                            @foreach(@App\Developer::all() as $devolper)
                                <option value="{{ $devolper->id }}">{{ $devolper->{app()->getLocale().'_name'} }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.probability') }}</label>
                            <select class="form-control select2 noti-select" name="nprobability" data-placeholder="{{ __('admin.probability') }}">
                                <option>No Location</option>
                                <option value="highest">{{ __('admin.highest') }}</option>
                                <option value="high">{{ __('admin.high') }}</option>
                                <option value="normal">{{ __('admin.normal') }}</option>
                                <option value="low">{{ __('admin.low') }}</option>
                                <option value="lowest">{{ __('admin.lowest') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Project</label>
                            <select name="nproject" class="form-control select2 noti-select">
                            <option>No Project</option>
                            @foreach(@App\Project::all() as $project)
                                <option value="{{ $project->id }}">{{ $project->{app()->getLocale().'_name'} }}</option>
                            @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                    <div class="panel with-nav-tabs panel-default">
                            <div class="panel-heading">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab1default" data-toggle="tab">Arabic</a></li>
                                        <li><a href="#tab2default" data-toggle="tab">Engilsh</a></li>
                                    </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1default">
                                        <div class="form-group">
                                            <input type="text" name="ar_title" class="form-control" placeholder="{{ __('admin.ar_title') }}">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="ar_body" class="form-control" placeholder="{{ __('admin.ar_body') }}"></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab2default">
                                        <div class="form-group">
                                            <input type="text" name="en_title" class="form-control" placeholder="{{ __('admin.en_title') }}">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="en_body" class="form-control" placeholder="{{ __('admin.en_body') }}"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="countNoti"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat"
                            data-dismiss="modal">{{ trans('admin.close') }}</button>
                    <button type="submit" class="btn btn-success btn-flat">{{ trans('admin.push') }}</button>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
    <div id="seo" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('admin.seo') }}</h4>
                </div>
                <form action="{{ url(adminPath().'/seo') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                    <input type="text" name="seo" class="form-control" placeholder="{{ __('admin.seo') }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat"
                            data-dismiss="modal">{{ trans('admin.close') }}</button>
                    <button type="submit" id="refreshSitemap" class="btn btn-success btn-flat"><i class="fa fa-refresh" id="spinner"></i> {{ trans('admin.submit') }}</button>
                </div>
                </form>
            </div>


        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <div class="row setting_dashboard">
                <a href="{{ url(adminPath().'/agent_types') }}">
                    <div class="single_box">
                        <i class="fa fa-id-card" aria-hidden="true"></i>
                        <span>{{ trans('admin.agent_types') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/agent') }}">
                    <div class="single_box">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>{{ trans('admin.agents') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/groups') }}">
                    <div class="single_box">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span>{{ trans('admin.groups') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/tasks') }}">
                    <div class="single_box">
                        <i class="fa fa-tasks" aria-hidden="true"></i>
                        <span>{{ trans('admin.tasks') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/targets') }}">
                    <div class="single_box">
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                        <span>{{ trans('admin.targets') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/competitors') }}">
                    <div class="single_box">
                        <i class="fa fa-handshake-o" aria-hidden="true"></i>
                        <span>{{ trans('admin.competitors') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/icons') }}">
                    <div class="single_box">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                        <span>{{ trans('admin.icons') }}</span>
                    </div>
                </a>
                <a href="#" data-toggle="modal" data-target="#refreshSitemap">
                    <div class="single_box">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                        <span>{{ trans('admin.refresh_sitemap') }}</span>
                    </div>
                </a>
                <a href="#" data-toggle="modal" data-target="#seo">
                    <div class="single_box">
                        <i class="fa fa-google" aria-hidden="true"></i>
                        <span>{{ trans('admin.seo') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/bank') }}">
                    <div class="single_box">
                        <i class="fa fa-money" aria-hidden="true"></i>
                        <span>{{ trans('admin.finance') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/titles') }}">
                    <div class="single_box">
                        <i class="fa fa-address-book" aria-hidden="true"></i>
                        <span>{{ trans('admin.titles') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/events') }}">
                    <div class="single_box">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span>{{ trans('admin.events') }}</span>
                    </div>
                </a>
                <a href="#" data-toggle="modal" data-target="#newNotification">
                    <div class="single_box">
                        <i class="fa fa-bell" aria-hidden="true"></i>
                        <span>{{ trans('admin.notification') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/roles') }}">
                    <div class="single_box">
                        <i class="fa fa-key" aria-hidden="true"></i>
                        <span>{{ trans('admin.roles') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/logs') }}">
                    <div class="single_box">
                        <i class="fa fa-exchange" aria-hidden="true"></i>
                        <span>{{ trans('admin.logs') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/lead_sources') }}">
                    <div class="single_box">
                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                        <span>{{ trans('admin.lead_sources') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/location') }}">
                    <div class="single_box">
                        <i class="fa fa-map" aria-hidden="true"></i>
                        <span>{{ trans('admin.locations') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/unit_types') }}">
                    <div class="single_box">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span>{{ trans('admin.unit_types') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/tags') }}">
                    <div class="single_box">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                        <span>{{ trans('admin.tags') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/facilities') }}">
                    <div class="single_box">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span>{{ trans('admin.facilities') }}</span>
                    </div>
                </a>
                <a href="#">
                    <div class="single_box">
                        <i class="fa fa-comments" aria-hidden="true"></i>
                        <span>{{ trans('admin.sms') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/get_project') }}">
                    <div class="single_box">
                        <i class="fa fa-globe" aria-hidden="true"></i>
                        <span>{{ trans('admin.pusher') }}</span>
                    </div>
                </a>
                   <a href="{{ url(adminPath().'/subscribe') }}">
                    <div class="single_box">
                        <i class="fa fa-facebook-square" aria-hidden="true"></i>
                        <span>Facebook App</span>
                    </div>
                </a>
                <a href="{{ url(adminPath().'/settings') }}">
                    <div class="single_box">
                        <i class="fa fa-gears" aria-hidden="true"></i>
                        <span>{{ trans('admin.settings') }}</span>
                    </div>
                </a>
                <a href="{{ url('change_marker') }}">
                    <div class="single_box">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <span>{{ trans('admin.change_marker') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath() . '/call_statuses') }}">
                    <div class="single_box">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <span>{{ trans('admin.call_statuses') }}</span>
                    </div>
                </a>
                <a href="{{ url(adminPath() . '/meeting_statuses') }}">
                    <div class="single_box">
                        <i class="fa fa-handshake-o" aria-hidden="true"></i>
                        <span>{{ trans('admin.meeting_statuses') }}</span>
                    </div>
                </a>

                <a href="{{ url(adminPath() . '/out_cats') }}">
                    <div class="single_box">
                        <i class="fa fa-money" aria-hidden="true"></i>
                        <span>{{ trans('admin.out_cats') }}</span>
                    </div>
                </a>

                <a href="{{ url(adminPath() . '/out_sub_cats') }}">
                    <div class="single_box">
                        <i class="fa fa-money" aria-hidden="true"></i>
                        <span>{{ trans('admin.out_sub_cats') }}</span>
                    </div>
                </a>
                @if(checkRole('export_excel') or @auth()->user()->type == 'admin')
                    <a>
                         <div class="single_box" style="position: relative;">
                             <i class="fa fa-file"></i> <span>{{ trans('admin.guide') }}</span>
                     <form action="{{ url(adminPath().'/guide') }}" method="post"
                                              enctype="multipart/form-data" style="position: absolute;width100%;height:100%;top:0;width:100%;">
                        {{ csrf_field() }}
                        <button style="color: white;font-size: 15px;background-color: transparent;border: 0px;margin-left: 10px;position: absolute;width100%;height:100%;top:0;width:100%;" type="submit" @if(Request::segment(2) == 'guide') class="gold-background"
                                @endif>

                        </button>
                    </form>
                    </div>
                    </a>
                    <a>
                         <div class="single_box" style="position: relative;">
                            <i class="fa fa-file"></i> <span>Excel</span>
                     <form action="{{ url(adminPath().'/xls') }}" method="post"
                          enctype="multipart/form-data"  style="position: absolute;width100%;height:100%;top:0;width:100%;">
                        {{ csrf_field() }}
                        <button style="color: white;font-size: 15px;background-color: transparent;border: 0px;margin-left: 10px;position: absolute;width100%;height:100%;top:0;width:100%;" type="submit" @if(Request::segment(2) == 'guide') class="gold-background"
                                @endif>

                        </button>
                    </form>
                    </div>
                    </a>
                @endif
                @if(checkRole('settings') or @auth()->user()->type == 'admin')
                 <a href="{{ url(adminPath().'/sort_projects') }}">
                    <div class="single_box">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        <span>{{ trans('admin.website') }}</span>
                    </div>
                </a>
                @endif
                @if(checkRole('settings') or @auth()->user()->type == 'admin')
                 <a href="{{ url(adminPath().'/change_password') }}">
                    <div class="single_box">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <span>{{ trans('admin.change_password') }}</span>
                    </div>
                </a>
                @endif
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
    $(".noti-select").change(function(){
        //$(".countNoti")
        //nlocation ndeveloper nprobability nproject
        var probability =$("input[name='nprobabilty']").val();
        var developer =$("input[name='ndeveloper']").val();
        var location =$("input[name='nlocation']").val();
        var project =$("input[name='nproject']").val();
        var _token = '{{ csrf_token() }}';
        $.ajax({
                url: "{{ url(adminPath().'/count_notify')}}",
                method: 'post',
                 
                data:{
                    "_token":_token,
                    "probability":probability,
                    "developer":developer,
                    "location":location,
                    "project":project,
                },
                success: function (data) {
                    $(".countNoti").html(data);
                },
                
        });
        
        
    });
    $(".noti-select").change();
    $('.select2').select2();
        $(document).on('click', '#refreshSitemap', function () {
            $.ajax({
                url: "{{ url(adminPath().'/sitemap')}}",
                method: 'get',
                dataType: 'json',
                beforeSend: function () {
                    $('#spinner').addClass('fa-spin');
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#refreshDate').html(data.date);
                        $('#spinner').removeClass('fa-spin');
                        $('#refreshSitemap').modal('hide');
                    } else {
                        alert('{{ __('admin.error') }}');
                        $('#spinner').removeClass('fa-spin');
                    }
                },
                error: function () {
                    alert('{{ __('admin.error') }}');
                    $('#spinner').removeClass('fa-spin');
                }
            });
        })
    
    </script>
@endsection
