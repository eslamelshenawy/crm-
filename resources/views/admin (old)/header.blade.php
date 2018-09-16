<!DOCTYPE html>
<html>
<head>
    <style>
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
    <link rel="stylesheet" href="{{ url('style/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ url('style/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/file_upload/file_upload.css') }}">
    <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-tagsinput.css') }}">




    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link href="{{ url('css/gallery.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/SocialIcons/1.0.1/soc.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/style/style.css') }}">
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-flipped.css">
        <link rel="stylesheet"
              href="{{ url('style/style_ar.css') }}">
    @endif
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
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/earlyaccess/notokufiarabic.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css" />
    <link rel="icon" href="{{ url('website_style/images/icon.png')}}">
</head>

<body class="hold-transition fixed sidebar-mini {{ getInfo()->theme }}" theme="{{ getInfo()->theme }}" id="themeColor">
<div class="wrapper">