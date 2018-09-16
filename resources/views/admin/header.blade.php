    <!DOCTYPE html>
<html>
<head>




    <style>
    .alert {
        padding: 0px !important;
    }
        .bootstrap-tagsinput {
            width: 100%;
            border-radius: 0 !important;
        }
        .navbar-nav > li > .dropdown-menu{
            background: rgba(0,0,0,0.8);
            border: 0;
        }
        .dropdown-menu > li > a {
             color: #fff !important;
        }
        .dropdown-menu > li > a:hover {
            background-color: transparent !important;
            color: #828080 !important;
        }
    </style>
     <style>

        .sidenav {
            height: 100%;
            /*width: 0;*/
            position: fixed;
            border: 1px solid #ccc;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: white;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px !important;
            margin-top: 30px !important;
            width: 0;
            margin-left: 0;
            /*border: 1px solid #ccc;*/
            /*background-color: white;*/
            /*margin-top: 30px;*/
        }

        .sidenav a {
            padding: 30px 0px 2px 7px;
            text-decoration: none;
            font-size: 22px;
            color: #818181;
            display: block;
            transition: 0.3s;
            @if(trans('hr')!='HR') direction:rtl; @endif

        }

        .sidenav a:hover {
            /*background-color: #555;*/
            color: #f1f1f1;

        }

        .sidenav .closebtn {
            position: absolute;
            top: 50px;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
            @if(trans('hr')!='HR') direction:rtl; @endif

        }
        div.content {
            margin-left: 200px;
            padding: 1px 16px;
            height: 1000px;
        }
        /* On screens that are less than 700px wide, make the sidebar into a topbar */
        @media screen and (max-width: 700px) {
            .sidenav {
                width: 100%;
                height: auto;
                position: relative;
            }
            .sidenav a {float:right;}
            div.content {margin-left: 0;}
        }

        /*!* On screens that are less than 400px, display the bar vertically, instead of horizontally *!*/
        /*@media screen and (max-width: 400px) {*/
            /*.sidenav a {*/
                /*text-align: center;*/
                /*float: none;*/
            /*}*/
        /*}*/

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }
        </style>

    <style>
        #piechart{
            position: absolute;
            width: 400px;
            height: 147px;
            margin-top: -62px;
        }
    </style>

        <style>


            /** card */

        .card-wrapper {
            /**background-color: black;*/
            color: white;
            display: flex;
            flex-flow: row nowrap;
            min-height: 100%;
            width: 100%;
        }

        .card-icon {
            align-self: center;
            /**background-color: yellow;*/
            /**color: black;*/
            flex: 0 0 auto;
            /**font-size: 32px;*/
            padding: 20px;
        }

        .card-icon-chars {
            align-self: center;
            /**background-color: yellow;*/
            /**color: black;*/
            flex: 0 0 auto;
            /**font-size: 32px;*/
            padding-left: 0;
            padding-top: 10px;
            padding-right: 20px;
            padding-bottom: 20px;
        }

        .card-content {
            color: black;
            flex: 12 1 auto;
            padding-top: 20px;
        }

        .card-content-left {
            color: black;
            padding-top: 10px;
        }

        .card-image{
            border: 1px solid #ccc;
            border-radius: 50% ;
            width: 60px;
            height: 60px;
        }

        .card-image-right {
            border: 1px solid #ccc;
            border-radius: 50% ;
            width: 75px;
            height: 75px;
            margin-right: 10px;
        }

        .card-image-right.characters-image {
            width: 63px;
            height: 63px;
            background-color: #f5f5f5;
            font-size: 20px;
            text-align: center;
            vertical-align: middle;
            line-height: 58px;
            font-weight: 600;
            /* padding: 2px; */
            color: black;

        }

        .fa.card-font-icon {
            color: #724a03;
            margin-right: 5px;
            margin-left: 0 !important;
            margin-top: 8px;
            font-size: 25px;
            cursor: pointer;
        }

        #notesUl li {
            list-style-type: none;
        }

        </style>
        <!-- rating stars style -->
        <style>
            .stars-outer {
  display: inline-block;
  position: relative;
  font-family: FontAwesome ! important ;
}

.stars-outer::before {
  content: "\f006 \f006 \f006 \f006 \f006";
}

.stars-inner {
  position: absolute;
  top: 0;
  left: 0;
  white-space: nowrap;
  overflow: hidden;
  width: 50%;
  font-family: FontAwesome ! important ;
}

.stars-inner::before {
  content: "\f005 \f005 \f005 \f005 \f005";
  color: #f8ce0b;
}

[data-notify="progressbar"] {
	margin-bottom: 0px;
	position: absolute;
	bottom: 0px;
	left: 0px;
	width: 100%;
	height: 5px;
}
 </style>
<meta name="csrf-token" content="{{ csrf_token() }}">
 <!--//new_sec_added datepicker ..-->
 <link href="{{ url('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">
 <style type="text/css">
         .cc-selector input{
             margin:0px;padding:0px;
             -webkit-appearance:none;
                -moz-appearance:none;
                     appearance:none;
                     clear:both;

         }
         .cc-selector label{
                                 clear:both;
         }
         .cc-selector-2 input{
             position:absolute;
             z-index:999;
         }

         .inGoing{background-image:url({{ url('icon/inCall.png') }});}
         .outGoing{background-image:url({{ url('icon/outCall.png') }});
             -webkit-transform: scaleX(-1);
             transform: scaleX(-1);
             }

         .cc-selector-2 input:active +.drinkcard-cc, .cc-selector input:active +.drinkcard-cc{opacity: .9;}
         .cc-selector-2 input:checked +.drinkcard-cc, .cc-selector input:checked +.drinkcard-cc{
             -webkit-filter: none;
                -moz-filter: none;

                     filter: none;
         }
         .drinkcard-cc{
             cursor:pointer;
             background-size:contain;
             background-repeat:no-repeat;
             display:inline-block;
             width:40px;height:40px;
             -webkit-transition: all 100ms ease-in;
                -moz-transition: all 100ms ease-in;
                     transition: all 100ms ease-in;
             -webkit-filter: brightness(1.8) grayscale(1) opacity(.7);
                -moz-filter: brightness(1.8) grayscale(1) opacity(.7);
                     filter: brightness(1.8) grayscale(1) opacity(.7);
         }
         .drinkcard-cc:hover{
             -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
                -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
                     filter: brightness(1.2) grayscale(.5) opacity(.9);
         }

         /* Extras */
         a:visited{color:#888}
         a{color:#444;text-decoration:none;}
         p{margin-bottom:.3em;}
         * { font-family:monospace; }
         .cc-selector-2 input{ margin: 5px 0 0 12px; }
         .cc-selector-2 label{ margin-left: 7px; }
         span.cc{ color:#6d84b4 }
     /* btn select div */
     .btnCol{
         border-radius: 60px !important;
         background-color:gainsboro;
         height:20px !important;
         width: 20px;
         text-align: center;
         padding: 0px !important;
         font-weight: bold;
         margin-left: 281px;
         margin-top: -3px;
     }
     .actionTab{
             background: linear-gradient(to right ,#b57800a6, #c48200d1);
         /* background: #999 !important; */
         padding: 8px 20px 5px !important;
         margin-bottom: 5px;
     }
     .panel-default{
         border: none;
     }
     .panel-default form{
         padding: 30px 40px 30px 30px;
     }
     #addPhoneBtn{
     margin-top: 4px;
     position: absolute;
     z-index: 1000000000;
     float: right;
     right: 25px;
     display: none;
     }
     #addPhoneBtn button{
     height: 30px;
     font-size: 14;
     font-weight: bold;
     }
     .oCallSel{
         width: 80px;
         height: 80px;
         border: 1px solid #333;
         padding: 10px;
         margin: 10px;
         float: left;
     }
     .form-group{
         /* clear: both; */
     }
     .ui-selected{
         border: 4px solid #373;
     }

     #vue-panel{
         overflow-x: hidden;
         overflow-y: scroll;
     }
     /* .select2-selection--single{
         display: none;
     } */
 </style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@if(!empty($title)) {{ trans('admin.website_title') . ' | ' . $title }} @else {{ trans('admin.website_title') }} @endif</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
     <link rel="stylesheet" href="{{ url('style/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('style/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('style/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('css/image-picker.css') }}" >
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ url('dist/css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ url('style/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ url('style/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ url('style/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('plugins/timepicker/bootstrap-timepicker.min.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ url('style/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/file_upload/file_upload.css') }}">
    <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-tagsinput.css') }}">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    {{--<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link href="{{ url('css/gallery.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/SocialIcons/1.0.1/soc.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/style/style.css') }}">

    <!-- include the core styles -->
    <link rel="stylesheet" href="//fabien-d.github.io/alertify.js/assets/js/lib/alertify/alertify.core.css" />
    <!-- include a theme, can be included into the core instead of 2 separate files -->
    <link rel="stylesheet" href="//fabien-d.github.io/alertify.js/assets/js/lib/alertify/alertify.default.css" id="toggleCSS" />



    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-flipped.css">
        <link rel="stylesheet"
              href="{{ url('style/style_ar.css') }}">
    @endif
    <link rel="stylesheet" href="{{ url('css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{ url('css/animate.css') }}">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/notokufiarabic.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css" />
    <link rel="icon" href="{{ url('website_style/images/icon.png')}}">
    <link rel="manifest" href="{{ url('manifest.json') }}" />
    <link href="{{url('css/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{url('css/jquery.comiseo.daterangepicker.css')}}" rel="stylesheet">
    <link href="{{url('css/dropdowntree.css')}}" rel="stylesheet">
    <!-- <link href="{{url('css/semantic.min.css')}}" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
      var OneSignal = window.OneSignal || [];
      OneSignal.push(function() {
          OneSignal.init({
              appId: "3c515ba6-fe76-4329-b6d4-0767f26b99ec",
          });
            OneSignal.getUserId(function(userId) {
                  if(userId){
                var id = userId;
                var _token = '{{ csrf_token() }}';
                 $(".logoutUrl").attr('href',"{{ url(adminPath().'/logout?player_id=') }}"+userId);
                $.ajax({
                    url: "{{ url(adminPath().'/push_player')}}",
                    type: 'post',
                    dataType: 'html',
                    data: {id: id, _token: _token},
                    success: function (data) {
                       console.log("OneSignal User ID:", userId);
                    }
                });
              }
          });
});
</script>
    <link rel="icon" href="{{ url('website_style/images/icon.png')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    @yield('style')
</head>

<body class="hold-transition fixed sidebar-mini {{ getInfo()->theme }}" theme="{{ getInfo()->theme }}" id="themeColor">
<div class="wrapper">
<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">
	<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>
	<span data-notify="icon"></span>
	<span data-notify="title">{1}</span>
	<span data-notify="message">{2}</span>
	<div class="progress" data-notify="progressbar">
		<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
	</div>
	<a href="{3}" target="{4}" data-notify="url"></a>
</div>
