@extends('website.index')
@section('content')
    <!-- Listing Start -->
    <section id="listing1" class="listing1">

        <div class="container">
            <div class="about-background"></div>
            <div class="row">
                
                <div class="col-md-12 col-sm-12 col-xs-12 ">
                    <div class="col-sm-12 about-text ">
                        
                        <h2 class="text-left">{{ __('admin.our_story') }}</h2>
                        <div class="clearfix"></div>
                        @if(app()->getLocale() == 'en')
                            <p class="blu-color" >{{ @App\Setting::first()->about_hub }}</p>
                        @else
                            <p class="blu-color" style="text-align: right">{{ @App\Setting::first()->ar_about_hub }}</p>
                        @endif
                    </div>

                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 ">

                    <div class="col-sm-6 about-text">

                        <h2 class="text-left">{{ __('admin.our_mission') }}</h2>
                        <div class="clearfix"></div>
                    @if(app()->getLocale() == 'en')
                            <p class="blu-color">{{ @App\Setting::first()->mission }}</p>
                        @else
                            <p class="blu-color" style="text-align: right">{{ @App\Setting::first()->ar_mission }}</p>
                        @endif
                    </div>
                    <div class="col-sm-6 about-text">

                        <h2 class="text-left">{{ __('admin.our_vision') }}</h2>
                        <div class="clearfix"></div>
                        @if(app()->getLocale() == 'en')
                            <p class="blu-color">{!!  @App\Setting::first()->vision  !!}</p>
                        @else
                            <p class="blu-color" style="text-align: right">{!!  @App\Setting::first()->ar_vision !!}</p>
                        @endif
                    </div>
                </div>



            </div>

        </div>

    </section>
@endsection