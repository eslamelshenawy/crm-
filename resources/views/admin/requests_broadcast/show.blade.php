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
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li @if(!session()->has('return_to_suggestions')) class="active" @endif><a href="#main_info" data-toggle="tab"
                                          aria-expanded="false">{{ trans('admin.main_info') }}</a></li>
                </ul>
                <div class="tab-content">
                    @php
                        $locationsArray = \App\Http\Controllers\HomeController::getChildren(@$req->location);
                        $locationsArray[] = $req->location;
                    @endphp
                    <div class="tab-pane @if(!session()->has('return_to_suggestions')) active @endif" id="main_info">
                        <strong>{{ trans('admin.id') }} : </strong>{{ $req->id }}
                        <br>
                        <hr>
                        <strong>{{ trans('admin.price') }} : </strong>{{ $req->price_from }} <i
                                class="fa fa-arrows-h"></i> {{ $req->price_to }}
                        <br>
                        <hr>
                        <strong>{{ trans('admin.area') }} : </strong>{{ $req->area_from }} <i
                                class="fa fa-arrows-h"></i> {{ $req->area_to }}
                        <br>
                        <hr>
                        <strong>{{ trans('admin.request_type') }} : </strong>{{ trans('admin.'.$req->request_type) }}
                        <br>
                        <hr>
                        <strong>{{ trans('admin.type') }} : </strong>{{ trans('admin.'.$req->unit_type) }}
                        <br>
                        <hr>
                        <strong>{{ trans('admin.unit_type') }}
                            : </strong>{{ @App\UnitType::find($req->unit_type_id)->{app()->getLocale().'_name'} }}
                        <br>
                        <hr>
                        @if($req->request_type != 'new_home')
                            <strong>{{ trans('admin.rooms') }} : </strong>{{ $req->rooms_from }} <i
                                    class="fa fa-arrows-h"></i> {{ $req->rooms_to }}
                            <br>
                            <hr>
                            <strong>{{ trans('admin.bathrooms') }} : </strong>{{ $req->bathrooms_from }} <i
                                    class="fa fa-arrows-h"></i> {{ $req->bathrooms_to }}
                            <br>
                            <hr>
                        @endif
                        @php
                            $full_location="";
                            $location_id = $req->location;
                            if ($location_id) {
                                while($location_id != '0' && \App\Location::find($location_id)->first()) {
                                        $location = \App\Location::find($location_id);
                                        $location_id = @$location->parent_id;
                                        $full_location .= @$location->{app()->getLocale().'_name'}.' -';
        
                                }
                            }
                        @endphp
                        <strong>{{ trans('admin.location') }}: </strong>{{ trim($full_location, '-') }}
                        <br>
                        <hr>
                        <strong>{{ trans('admin.delivery_date') }}: </strong>{{ $req->date }}
                        <br>
                        <hr>
                        <strong>{{ trans('admin.down_payment') }}: </strong>{{ $req->down_payment }}
                        <br>
                        <hr>
                        <strong>{{ trans('admin.project') }}: </strong>{{ @App\Project::find($req->project_id)->{app()->getLocale() . '_name'} }}
                        <br>
                        <hr>
                        <strong>{{ trans('admin.notes') }} : </strong>{{ $req->notes }}
                        <br>
                        <hr>
                    </div>
                </div>
            </div>
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
            'autoWidth': true
        })
    </script>
    <script>
        function initAutocomplete() {
            var lat = parseFloat({{ $req->lat }});
            var lng = parseFloat({{ $req->lng }});
            var zoom = parseInt({{ $req->zoom }});
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: lat, lng: lng },
                zoom: zoom,
                mapTypeId: 'roadmap'
            });

            var marker = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: map,
                animation: google.maps.Animation.DROP
            });

        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJ67H5QBLVTdO2pnmEmC2THDx95rWyC1g&libraries=places&callback=initAutocomplete"
            async defer></script>
@stop