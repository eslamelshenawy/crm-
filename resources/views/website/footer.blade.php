@php
    $header =  $_SERVER['HTTP_USER_AGENT'];
@endphp
@if(stripos($header,'Android') !== false)
    <div class="android-dev" style="position: fixed;bottom: 0;background: #fff;width: 100%;float:right;padding: 20px;z-index: 1000">
        <a href="{{ \App\Setting::first()->play_store }}" style="width: 80%;float: left" >For better experience downland our app<img src="{{ url('website_style/images/play-store-icon.png') }}" width="30px"></a>
        <div style="width: 20%;border-left:1px solid #000;float: left" class="dapp-close-btn"><i class="fas fa-times pull-right " style="text-align: center;font-size: 22px"></i></div>
    </div>


@elseif(stripos($header,'iPhone') !== false){
    <div class="android-dev" style="position: fixed;bottom: 0;background: #fff;width: 100%;float:right;padding: 20px;z-index: 1000">
        <a href="{{ \App\Setting::first()->apple_store }}" style="width: 80%;float: left" >For better experience downland our app<img src="{{ url('website_style/images/apple.png') }}" width="30px"></a>
        <div style="width: 20%;border-left:1px solid #000;float: left" class="dapp-close-btn"><i class="fas fa-times pull-right " style="text-align: center;font-size: 22px"></i></div>
    </div>
@endif
<!--Footer-->
@php($contact =  @App\Setting::first())
<footer class="footer_third" >
    <div class="container padding_top">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="footer_panel bottom30">
                    <a href="{{ url('/') }}" class="logo bottom30"><img src="{{ url('website_style/images/wlogo.png')}}" width="200px" alt="logo"></a>

                    <p class="bottom15">{{ __('admin.footer_text') }}</p>
                    <h3 class="text-center" style="color: #fff;"><i class="fa fa-phone"></i> {{ @App\HubPhone::first()->phone }}</h3>

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
<!--CopyRight-->

<script src="{{  asset('website_style/js/jquery-2.1.4.js')}}"></script>
<script src="{{  asset('website_style/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('website_style/css/slick/slick.js')}}"></script>
<script src="{{  asset('website_style/js/jquery.appear.js')}}"></script>
<script src="{{  asset('website_style/js/jquery-countTo.js') }}"></script>
<script src="{{  asset('website_style/js/bootsnav.js') }}"></script>
<script src="{{  asset('website_style/js/masonry.pkgd.min.js') }}"></script>
<script src="{{  asset('website_style/js/jquery.parallax-1.1.3.js') }}"></script>
<script src="{{  asset('website_style/js/jquery.cubeportfolio.min.js') }}"></script>
<script src="{{  asset('website_style/js/owl.carousel.min.js') }}"></script>
<script src="{{  asset('website_style/js/selectbox-0.2.min.js') }}"></script>
<script src="{{  asset('website_style/js/zelect.js') }}"></script>
<script src="{{  asset('website_style/js/editor.js') }}"></script>
<script src="{{  asset('website_style/js/jquery.fancybox.js') }}"></script>
<script src="{{  asset('website_style/js/dropzone.min.js') }}"></script>
<script src="{{  asset('website_style/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{  asset('website_style/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{  asset('website_style/js/revolution.extension.actions.min.js') }}"></script>
<script src="{{  asset('website_style/js/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{  asset('website_style/js/revolution.extension.navigation.min.js') }}"></script>
<script src="{{  asset('website_style/js/revolution.extension.parallax.min.js') }}"></script>
<script src="{{  asset('website_style/js/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{  asset('website_style/js/revolution.extension.video.min.js') }}"></script>
<script src="{{  asset('website_style/js/functions.js') }}"></script>
<script src="{{  asset('website_style/js/custom-file-input.js') }}"></script>
<script src="{{  asset('website_style/js/range-Slider.min.js') }}"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{  asset('style/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $('.select2').select2();
</script>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5a4a2a6c9d192f00137436a8&product=inline-share-buttons"></script>

@yield('js')

</body>
</html>

