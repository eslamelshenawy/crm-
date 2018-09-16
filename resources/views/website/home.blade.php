@include('website.nav')
<style>
.feature-home{
    background:rgba(51, 51, 51, 0.3);
    margin-left:5px;
    padding:10px;
}
.project-btn {
    background:black;
    margin-right:0px;
    height:40px;
    width:120px;
    
}
.project-bb,.property_item{
    background:rgba(202, 202, 202, 0.3);
}
.project-bb span{
    float:left;
    margin-left:4px;
}
.project-bb h4{
    padding-left:30px;
}
</style>
<!--Slider-->
<section class="banner_six hidden-xs hidden-sm">
    <h3 class="hidden">hidden</h3>
    <div id="property-d-1" class="owl-carousel">
        @foreach(@App\Project::where('on_slider',1)->orderBy('id', 'desc')->get() as $slider)
        <div class="item">
            <img src="{{ url('uploads/'.$slider->website_slider) }}" alt="" data-bgposition="center center" data-bgfit="cover">
            <div class="container">
            <div class="slider-property text-left">
                <div class="bg_white text-left">
                    <h2 >{{ $slider->{app()->getLocale().'_name'} }}</h2>
                    <div class="row">
                    <p class="col-xs-8">{{ \Illuminate\Support\Str::words($slider->{app()->getLocale().'_description'} , 65,'..') }}</p>
                        <h4 class="  col-xs-4" > <img src="{{ url('uploads/'.$slider->logo) }} " width="150px"> </h4>

                    </div>
                        <a href="{{ url('project/'.slug($slider->en_name).'-'.$slider->id) }}" class="btn-more empty-button" style="font-size:14px;color: #fff;">
                            <span>{{ __('admin.more_details') }}</span>
                        </a>
                </div>
                <div class="property_meta">
                    <span style="font-size: 22px">{{ $slider->down_payment }} % {{ __('admin.down_payment') }}</span>
                    <span style="font-size: 22px">{{ $slider->installment_year }} {{ __('admin.installment_year') }}</span>
                </div>
            </div>
            </div>
        </div>

       @endforeach
    </div>
</section>
<!--Slider eands-->
<!--Slider-->
<div class="rev_slider_wrapper hidden-lg hidden-md">
    <div id="rev_slider" class="rev_slider"  data-version="5.0">
        <ul>
            <!-- SLIDE  -->
            @foreach(@App\Project::where('on_slider',1)->orderBy('id', 'desc')->get() as $slider)
                <li data-transition="fade">
                    <!-- MAIN IMAGE -->
                    <img src="{{ url('uploads/' . $slider->website_slider) }}" alt="" data-bgposition="center center" data-bgfit="cover">
                    <h1 class="tp-caption tp-resizeme uppercase"
                        data-x="center" data-hoffset="0"
                        data-y="275"
                        data-transform_idle="o:1;"
                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;"
                        data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;"
                        data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                        data-mask_out="x:0;y:0;s:inherit;e:inherit;"
                        data-start="500"
                        data-splitin="none"
                        data-splitout="none"
                        style="z-index: 6; color: #fff;font-size: 56px">{{ $slider->{app()->getLocale().'_name'} }}
                    </h1>
                    <p class="tp-caption  tp-resizeme"
                       data-x="center" data-hoffset="0"
                       data-y="320"
                       data-transform_idle="o:1;"
                       data-transform_in="opacity:0;s:2000;e:Power3.easeInOut;"
                       data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;"
                       data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                       data-mask_out="x:0;y:0;s:inherit;e:inherit;"
                       data-start="800" style="color: #e6e6e6; font-size: 20px;margin-top: 10px;">{{ @App\Location::find($slider->location_id)->{app()->getLocale().'_name'} }}
                    </p>
                    <img src="{{ url('uploads/' . $slider->image) }}" alt="" data-bgposition="center center" data-bgfit="cover">
                    <div class="slider-caption tp-caption tp-resizeme"
                         data-x="['right','right','center','center']" data-hoffset="['0','0','0','0']"
                         data-y="['center','center','center','center']" data-voffset="['0','0','0','0']"
                         data-responsive_offset="on"
                         data-visibility="['on','on','off','off']"
                         data-start="1500"
                         data-transition="fade"
                         data-transform_idle="o:1;"
                         data-transform_in="x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power3.easeInOut;"
                         data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                         data-mask_in="x:0px;y:0px;s:inherit;e:inherit;">
                    </div>
                    <div class="tp-caption  tp-resizeme"
                         data-x="center" data-hoffset="0"
                         data-y="400"
                         data-width="full"
                         data-transform_idle="o:1;"
                         data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;"
                         data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;"
                         data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                         data-mask_out="x:0;y:0;s:inherit;e:inherit;"
                         data-start="800" style="color: #fff;font-size: 36px;">
                        {{ $slider->down_payment }}% {{ __('admin.down_payment')}} & {{ $slider->installment_year }}
                        {{ __('admin.installment') }}
                        @if($slider->installment_year > 1 && app()->getLocale() == 'en'){{ __('admin.years')}}
                        @elseif($slider->installment_year <= 1 && app()->getLocale() == 'en'){{ __('admin.year')}}
                        @elseif($slider->installment_year <= 10 && app()->getLocale() == 'ar'){{ __('admin.years')}}
                        @elseif($slider->installment_year > 10 && app()->getLocale() == 'ar'){{ __('admin.year')}}
                        @endif
                    </div>
                    <div class="tp-caption tp-static-layer"
                         id="slide-37-layer-2"
                         data-x="left" data-hoffset="550"
                         data-y="500" data-voffset="560"
                         data-whitespace="nowrap"
                         data-visibility="['on','on','on','on']"
                         data-start="500"
                         data-basealign="slide"
                         data-startslide="0"
                         data-endslide="5"
                         style="z-index: 5;"><a href="{{ url('project/'.slug($slider->en_name).'-'.$slider->id) }}" class="btn-white border_radius uppercase">{{ __('admin.read_more') }}</a>
                    </div>
                </li>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<!--Slider ends-->
<!-- Property Search area Start -->
<div class="col-xs-12" style="background: #eee">
    <form class="callus container" action="{{ url('search') }}" method="get" style="padding: 20px;margin-top: 50px;">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-4">
            <div class="single-query bottom15">
                <input type="text" name="keyword" class="keyword-input" style="margin: 0;" placeholder="{{ __('admin.Keyword (e.g. "office")') }}">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="single-query bottom15">
                <select name="location" class="select2" data-placeholder="{{ trans('admin.select_location') }}">
                    <option></option>
                    @foreach($search['region'] as $location)
                        <option value="{{ $location['id'] }}">{{  $location['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="single-query bottom15">
                <select class="select2" id="unit_type" multiple name="unit_type[]" data-placeholder="{{ __('admin.select unit type') }}" style="height: 48px;">
                    <option></option>
                    @foreach($search['unit_type'] as $unit_type)
                        <option value="{{ $unit_type['id'] }}">{{ $unit_type['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-2" style="margin-top: 30px">
            <div class="single-query bottom15">
                <select name="type" class="select2" id="property_type"
                        data-placeholder="{{ trans('admin.select_type') }}">
                    <option></option>
                    <option value="project" selected>{{ trans('admin.project') }}</option>
                    <option value="resale"  >{{ trans('admin.resale') }}</option>
                    <option value="rental">{{ trans('admin.rental') }}</option>
                </select>
            </div>
        </div>
        <div class="col-sm-10">
            <div class="col-sm-6">
                <input type="hidden" name="min_price" id="min_price" value="{{ $search['data']['project_min_price'] }}">
                <input type="hidden" name="max_price" id="max_price" value="{{ $search['data']['project_max_price'] }}">
                <input type="hidden" name="min_area" id="min_area" value="{{ $search['data']['project_min_area'] }}">
                <input type="hidden" name="max_area" id="max_area" value="{{ $search['data']['project_max_area'] }}">
                <div class="col-md-12 col-sm-12 col-xs-12 bottom15" >
                    <div class="single-query-slider">
                        <div class="clearfix top20">
                            <label class="@if(app()->getLocale()=='en') pull-right @else pull-left @endif" id="price_lable">{{ trans('admin.price') }}</label>
                            <div class="price text-right @if(app()->getLocale()=='en') pull-left @else pull-right @endif">
                                (
                                <div class="leftLabel" id="mi_price"></div>
                                <span>EG</span> )
                                <span>to ( <div class="rightLabel" id="ma_price"></div> EG )</span>

                            </div>
                        </div>
                        <div id="price_range" data-range_min="{{ $search['data']['project_min_price'] }}"
                             data-range_max="{{ $search['data']['project_max_price'] }}"
                             data-cur_min="{{ $search['data']['project_min_price'] }}"
                             data-cur_max="{{ $search['data']['project_max_price'] }}"
                             class="nstSlider animating_css_class">
                            <div class="bar"></div>
                            <div class="leftGrip"></div>
                            <div class="rightGrip"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="col-md-12 col-sm-12 col-xs-12 bottom15">
                    <div class="single-query-slider">
                        <div class="clearfix top20">
                            <label class="pull-left">area Range:</label>
                            <div class="price text-right"> (
                                <div class="leftLabel" id="mi_area"></div>
                                <span>m<sup>2</sup> ) </span>

                                <span>to ( <div class="rightLabel" id="ma_area"></div> m<sup>2</sup> )</span>
                            </div>
                        </div>
                        <div id="area_range" data-range_min="{{ $search['data']['project_min_area'] }}"
                             data-range_max="{{ $search['data']['project_max_area'] }}"
                             data-cur_min="{{ $search['data']['project_min_area'] }}"
                             data-cur_max="{{ $search['data']['project_max_area'] }}"
                             class="nstSlider">
                            <div class="bar"></div>
                            <div class="leftGrip"></div>
                            <div class="rightGrip"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div id="non_project">
        <div class="search-2">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="single-query bottom15">
                    <select class="select2" name="rooms"
                            data-placeholder="{{ trans('admin.select_number_of_rooms') }}">
                        <option></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="single-query bottom15">
                    <select class="select2" name="bathrooms"
                            data-placeholder="{{ trans('admin.select_number_of_bathrooms') }}">
                        <option></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="facility1">
        <div class="col-sm-12">
            <div class="group-button-search">
                <a data-toggle="collapse" href=".search-propertie-filters" class="more-filter">
                    <i class="fa fa-plus text-1" aria-hidden="true"></i><i class="fa fa-minus text-2 hide"
                                                                           aria-hidden="true"></i>
                    <div class="text-1">{{ __('admin.Show more search options') }}</div>
                    <div class="text-2 hide">{{ __('admin.less more search options') }}</div>
                </a>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12 text-right facility1 form-group top30 pull-right">
                <button type="submit" class="border_radius btn-yellow text-uppercase">{{ __('admin.search') }}</button>
            </div>
            <br>
            <div class="search-propertie-filters collapse">
                <div class="container-2">
                    <div class="row">
                        @foreach($search['facilities'] as $facility)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="search-form-group white bottom10">
                                    <input type="checkbox" class="checkbox" value="{{ $facility['id'] }}"
                                           name="check-box"/>
                                    <span>{{ $facility['name'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</form>
</div>
<!-- Property Search area End -->


<!-- Latest Property -->
<section style="background:url('images/bg.jpg') no-repeat 100%" id="property" class="padding index2 ">
    <div class="container" style="padding: 350px 0px 80px 0px;">
    
        <div class="row">
            <div class="col-xs-12 text-center p-1" style="margin-top:20px;">
                <h2 class="uppercase blu-color" style="color:white !important;">{{ __('admin.featured_projects') }}</h2>
            </div>
        </div>
        <div class="row center">
                @foreach(@App\Project::where('show_website',1)->orderby('featured_priority')->limit('9')->get() as $project)
                <div class="col-sm-6 col-md-4 feature-home">
                <span><img class="developer-logo"  src="{{ url('uploads/'.$project->developer->logo) }}"></span>
                    <a href="{{ url('project/'.slug($project->{app()->getLocale().'_name'}).'-'.$project->id) }}">
                    <div class="property_item heading_space home-project" style="min-height:240px;">
                        {{--<div class="project-head">--}}
                            {{--<h4 class="text-center">{{ $project->{app()->getLocale().'_name'} }}</h4>--}}
                        {{--</div>--}}
                        <img src="{{ url('uploads/'.$project->logo) }}" class="home-project-logo">
                        <div class="image">
                            
                            <span class="tag_t">{{ \App\Location::find($project->location_id)->{app()->getLocale().'_name'} }}</span>
                           <img src="{{ url('uploads/'.$project->cover) }}" alt="latest property" class="img-responsive">


                        </div>
                        <div class="project-bb">
                            <span style="padding-left:20px;">
                                        <div style="margin-right:10px;float:left;">
                                            @if(isset($project->down_payment))
                                                    <bold>{{ __('admin.down_payment') }}</bold>
                                                    <h4> {{ @$project->down_payment }}%</h4>
                                            @endif
                                        </div>
                                        <div >
                                            @if(isset($project->installment_year))
                                                    <bold>{{ __('admin.installment') }}</bold>
                                                    <h4>{{ @$project->installment_year }} {{ __('admin.years') }}</h4>
                                            @endif
                                        </div>
                            </span>
                            <span style="padding-left:30px;">
                                            @if(isset($project->delivery_date))
                                                    <bold>{{ __('admin.delivery_date') }}</bold>
                                                    <h4>{{ @$project->delivery_date }}</h4>
                                            @endif
                            </span>
                            <button type="submit" class=" project-btn">{{ __('admin.read_more') }}</button>
                        </div>


                    </div>
                    </a>
                </div>

            @endforeach
        </div>
    </div>
</section>
<!-- Latest Property Ends -->
<section id="" class="padding col-md-10 col-md-offset-1">
    <div style="width: 100%;display: inline-block;">
    @php $count = @App\ResaleUnit::where('featured',1)->orderby('priority')->count(); @endphp
    @if($count)
        <h3 class="uppercase text-center blu-color" style="padding:0 0 30px 0">{{ __('admin.over') }} {{ $count }} {{ __('admin.properties_egypt') }}</h3>
    @endif
    </div>
    <section class="center slider col-xs-12">
        @foreach(@App\ResaleUnit::where('featured',1)->orderby('priority')->get() as $unit)
            <a href="{{ url('resale/'.slug($unit->{app()->getLocale().'_title'}).'-'.$unit->id) }}">
                <div class="resale-unit" >
                    <div class="col-sm-6" style="background: url({{ url($unit->watermarked_image) }});background-position: 50%;background-size:cover;height: 450px;padding: 0;margin-bottom: 20px; ">
                        <div class="resale-data" class="col-sm-12 bottom-20">
                            <h3 class="margin" style="padding: 4px 8px;font-size: 18px">{{ $unit->{app()->getLocale().'_title'} }}</h3>
                            <h5 class="col-xs-6" style="padding: 0 8px;">{{ @App\Location::find($unit->location)->{app()->getLocale().'_name'} }} </h5>
                            <h4 class="col-xs-6 text-right" style="">{{ $unit->price}} {{ __('admin.egp') }}</h4>
                            <span class="col-xs-12" style="color:#8a6d3b;text-align: center;width: 100%">
                                @if(isset($unit->rooms))
                                    <span class="pull-left resale-home"><i class="fas fa-bed"></i> {{ $unit->rooms }} {{ __('admin.bedrooms') }}</span>
                                @endif
                                @if(isset($unit->bathrooms))
                                    <span class="pull-right resale-home"><i class="fas fa-bath"></i> {{ $unit->bathrooms }} {{ __('admin.bathrooms') }}</span>
                                @endif
                            </span>

                        </div>
                    </div>

                </div>
            </a>
        @endforeach
    </section>

</section>
<!--Partners-->

<section id="logos">
    <div class="container partner2 padding">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h3 class="uppercase blu-color">{{ __('admin.our_partners') }}</h3>
                <p class="heading_space"></p>
            </div>
        </div>
        <div class="row">
            <div id="partners" class="owl-carousel" style="overflow: visible;">
                @foreach(@App\Developer::where('featured',1)->get() as $developer)
                    <div class="item">
                        <a href="{{ url('developer/'.slug($developer->{app()->getLocale().'_name'}).'-'.$developer->id) }}">
                            <img src="{{ url('uploads/'.$developer->logo)}}" alt="Featured Partner" style="width: 100px;height: 100px;border-radius: 50%" data-toggle="tooltip" data-placement="right" title="{{ $developer->{app()->getLocale().'_name'} }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--Partners Ends-->

@php
    $header =  $_SERVER['HTTP_USER_AGENT'];
@endphp
@if(stripos($header,'Android') !== false)
    <div class="android-dev" style="position: fixed;bottom: 0;background: #fff;width: 100%;float:right;padding: 20px;z-index: 1000">
        <a href="{{ \App\Setting::first()->play_store }}" style="width: 80%;float: left" >For better experience download our app<img src="{{ url('website_style/images/play-store-icon.png') }}" width="30px"></a>
        <div style="width: 20%;border-left:1px solid #000;float: left" class="dapp-close-btn"><i class="fas fa-times pull-right " style="text-align: center;font-size: 22px"></i></div>
    </div>


@elseif(stripos($header,'iPhone') !== false)
<div class="android-dev" style="position: fixed;bottom: 0;background: #fff;width: 100%;float:right;padding: 20px;z-index: 1000">
    <a href="{{ \App\Setting::first()->apple_store }}" style="width: 80%;float: left" >For better experience download our app<img src="{{ url('website_style/images/apple.png') }}" width="30px"></a>
    <div style="width: 20%;border-left:1px solid #000;float: left" class="dapp-close-btn"><i class="fas fa-times pull-right " style="text-align: center;font-size: 22px"></i></div>
</div>
@endif

<!--Footer-->
@php($contact = @App\Setting::first())
<footer class="footer_third" >
    <div class="container padding_top">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="footer_panel bottom30">
                    <a href="{{ url('/') }}" class="logo bottom30"><img src="{{ url('website_style/images/wlogo.png')}}" width="150px" alt="logo"></a>

                        <p class="bottom15">{{ __('admin.footer_text') }}
                        </p>


                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer_panel bottom30">
                    <h4 class="bottom30">{{ __('admin.latest_news') }}</h4>
                    @foreach(@App\Event::limit(3)->get() as $news)
                        <div class="media bottom30">
                            <div class="media-body">
                                <a href="{{ url('event/'.$news->id) }}"><i class="icon-clock5"></i> {{ $news->{app()->getLocale().'_title'} }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer_panel bottom30">
                    <h4 class="bottom30"> {{ __('admin.get_in_touch') }}</h4>
                    <div class="agetn-contact-2 bottom30">
                        <p><i class="icon-telephone114"></i>@foreach(@App\HubPhone::all() as $phone) {{ $phone->phone }} @if(!$loop->last) - @endif @endforeach</p>
                        <p><i class=" icon-icons142"></i> <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>

                        <p><i class="icon-browser2"></i>{{str_replace('http://',' ', url('/')) }}</p>
                        <p><i class="icon-icons74"></i> @if(app()->getLocale() == 'en'){{ $contact->address }} @else{{ $contact->ar_address }} @endif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer_panel bottom30">
                    <h4 class="bottom30">{{ __('admin.Subscribe') }}</h4>
                    <p>{{ __('admin.subscribe') }}</p>
                    <form class="top30" method="post" action="{{ url('newsletter') }}">
                        {{ csrf_field() }}
                        <input class="search" name="email" placeholder="{{ __('admin.email_enter') }}" type="text">
                        <button class="button_s" href="#">
                            <i class="icon-mail-envelope-open"></i>
                        </button>
                    </form>
                    <div class="row" style="margin-top: 20px">
                        <div class="col-xs-6">
                            <a href="{{ $contact->play_store }}">
                                <img src="{{ url('website_style/images/googleplay.png') }}" class="col-xs-12" style="padding: 0">
                            </a>
                        </div>
                        <div class="col-xs-6">
                            <a href="{{ $contact->apple_store }}">
                                <img src="{{ url('website_style/images/applestore.png') }}" class="col-xs-12" style="padding: 0">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--CopyRight-->
        <div class="copyright_simple">
            <div class="row">
                <div class="col-md-6 col-sm-5 top20 bottom20">
                    <p class="text-left">{!! __('admin.copyright') !!}</p>
                </div>
                <div class="col-md-6 col-sm-7 text-right top15 bottom10">
                    <ul class="social_share">
                        @foreach(@App\HubSocial::all() as $social)
                            <li><a href="{{ $social->link }}" ><img src="{{ url('uploads/'.$social->web_icon) }}" style="height: 30px"></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>




<script src="{{  asset('website_style/js/jquery-2.1.4.js')}}"></script>
<script src="{{  asset('website_style/js/bootstrap.min.js')}}"></script>
<script src="{{  asset('website_style/js/jquery.appear.js')}}"></script>
<script src="{{  asset('website_style/js/jquery-countTo.js') }}"></script>
<script src="{{  asset('website_style/js/bootsnav.js') }}"></script>
<script src="{{  asset('website_style/js/masonry.pkgd.min.js') }}"></script>
<script src="{{  asset('website_style/js/jquery.parallax-1.1.3.js') }}"></script>
<script src="{{  asset('website_style/js/jquery.cubeportfolio.min.js') }}"></script>
<script src="{{  asset('website_style/js/range-Slider.min.js') }}"></script>
<script src="{{  asset('website_style/js/owl.carousel.min.js') }}"></script>
<script src="{{  asset('website_style/js/selectbox-0.2.min.js') }}"></script>
<script src="{{  asset('website_style/js/zelect.js') }}"></script>
<script src="{{  asset('website_style/js/jquery.fancybox.js') }}"></script>
<script src="{{  asset('website_style/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{  asset('website_style/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{  asset('website_style/js/revolution.extension.actions.min.js') }}"></script>
<script src="{{  asset('website_style/js/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{  asset('website_style/js/revolution.extension.navigation.min.js') }}"></script>
<script src="{{  asset('style/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{  asset('website_style/js/revolution.extension.parallax.min.js') }}"></script>
<script src="{{  asset('website_style/js/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{  asset('website_style/js/revolution.extension.video.min.js') }}"></script>
<script src="{{  asset('website_style/js/custom.js') }}"></script>
<script src="{{  asset('website_style/js/functions.js') }}"></script>
<script src="{{  asset('website_style/css/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
@yield('js')
<script>
    $('.dapp-close-btn').on('click',function () {
        $('.android-dev').addClass('hidden');
    });
    $('.dapp-close-btn').on('click',function () {
        $('.ios-dev').addClass('hidden');
    });
</script>
<script>
    $('.select2').select2();
    $(document).on('click', '#price_range', function () {
        $('#min_price').val($('#mi_price').text());
        $('#max_price').val($('#ma_price').text());
    })
    $(document).on('click', '#area_range', function () {
        $('#min_area').val($('#mi_area').text());
        $('#max_area').val($('#ma_area').text());
    })
    $('#non_project').hide();
    $(document).on('change', '#property_type', function () {
        if ($(this).val() == "project") {
            $('#non_project').hide();
            $('#facility1').show();
            $('#price_range').nstSlider('set_range', parseInt("{{ $search['data']['project_min_price'] }}"), parseInt("{{ $search['data']['project_max_price'] }}"));
            $('#area_range').nstSlider('set_range', parseInt("{{ $search['data']['project_min_area'] }}"), parseInt("{{ $search['data']['project_max_area'] }}"));
            $('#price_range').nstSlider('set_position', parseInt("{{ $search['data']['project_min_price'] }}"), parseInt("{{ $search['data']['project_max_price'] }}"));
            $('#area_range').nstSlider('set_position', parseInt("{{ $search['data']['project_min_area'] }}"), parseInt("{{ $search['data']['project_max_area'] }}"));
            $('#price_lable').text("{{ trans('admin.price') }}");
            $('#min_price').val($('#mi_price').text());
            $('#max_price').val($('#ma_price').text());
            $('#min_area').val($('#mi_area').text());
            $('#max_area').val($('#ma_area').text());
        }
        else if ($(this).val() == "resale") {
            $('#non_project').show();
            $('#facility1').hide();
            $('#price_range').nstSlider('set_range', parseInt("{{ $search['data']['resale_min_price'] }}"), parseInt("{{ $search['data']['resale_max_price'] }}"));
            $('#area_range').nstSlider('set_range', parseInt("{{ $search['data']['resale_min_area'] }}"), parseInt("{{ $search['data']['resale_max_area'] }}"));
            $('#price_range').nstSlider('set_position', parseInt("{{ $search['data']['resale_min_price'] }}"), parseInt("{{ $search['data']['resale_max_price'] }}"));
            $('#area_range').nstSlider('set_position', parseInt("{{ $search['data']['resale_min_area'] }}"), parseInt("{{ $search['data']['resale_max_area'] }}"));
            $('#price_lable').text("{{ trans('admin.price') }}");
            $('#min_price').val($('#mi_price').text());
            $('#max_price').val($('#ma_price').text());
            $('#min_area').val($('#mi_area').text());
            $('#max_area').val($('#ma_area').text());
        }
        else if ($(this).val() == "rental") {
            $('#non_project').show();
            $('#facility1').hide();
            $('#price_range').nstSlider('set_range', parseInt("{{ $search['data']['rental_min_price'] }}"), parseInt("{{ $search['data']['rental_max_price'] }}"));
            $('#area_range').nstSlider('set_range', parseInt("{{ $search['data']['rental_min_area'] }}"), parseInt("{{ $search['data']['rental_max_area'] }}"));
            $('#price_range').nstSlider('set_position', parseInt("{{ $search['data']['rental_min_price'] }}"), parseInt("{{ $search['data']['rental_max_price'] }}"));
            $('#area_range').nstSlider('set_position', parseInt("{{ $search['data']['rental_min_area'] }}"), parseInt("{{ $search['data']['rental_max_area'] }}"));
            $('#price_lable').text("{{ trans('admin.rent') }}");
            $('#min_price').val($('#mi_price').text());
            $('#max_price').val($('#ma_price').text());
            $('#min_area').val($('#mi_area').text());
            $('#max_area').val($('#ma_area').text());
        }
    })
</script>
<script>
    $(document).ready(function () {
        $('.checkbox').attr('name', 'facilities[]');
    });
</script>
<script>
    $(".center").slick({
        dots: false,
        infinite: true,
        centerMode: true,
        autoplay:true,
        slidesToShow: 3,
        centerPadding: '-120px',
        arrows:true,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1,
                }
            }
            ,
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1,
                    autoplay:true,
                }
            }

        ]
    });
    $(".center2").slick({
        dots: false,
        infinite: true,
        autoplay:true,
        slidesToShow: 1,
        centerMode: true,
        centerPadding: '20px',
        variableWidth: true,
        slidesToScroll: -1,
        arrows:true,
        rtl: true,
        responsive: [

            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '200px',
                    slidesToShow: 1,
                    variableWidth: true,
                    variableHeight: true,
                    autoplay:true,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '50px',
                    slidesToShow: 1,
                    variableWidth: true,
                    variableHeight: true,
                    autoplay:true,
                }
            }
        ]
    });
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

</script>
<script>
    var show = true;
    $('.more-filter').on('click',function () {

        if(show==true)
        {
            $('.social').addClass('hidden');
            show=false;
        }

        else
        {
            show=true;
            $('.social').removeClass('hidden');
        }


    });


    $(document).ready(function () {
        $('.checkbox').attr('name','facility[]')
    })
</script>
@yield('js')
</body>
</html>

