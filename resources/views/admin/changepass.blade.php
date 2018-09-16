<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @if(!empty($title)) {{ $title . ' | Log in' }}
        @else {{ 'Hub | Log in' }}
        @endif</title>
            <!-- Tell the browser to be responsive to screen width -->
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <!-- Bootstrap 3.3.7 -->
            <link rel="stylesheet" href="{{ url('style/bootstrap/dist/css/bootstrap.min.css') }}">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="{{ url('style/font-awesome/css/font-awesome.min.css') }}">
            <!-- Ionicons -->
            <link rel="stylesheet" href="{{ url('style/Ionicons/css/ionicons.min.css') }}">
            <!-- Theme style -->
            <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
            <!-- iCheck -->
            <link rel="stylesheet" href="{{ url('plugins/iCheck/square/blue.css') }}">
            <link rel="stylesheet" href="{{ url('style/style.css') }}">
            <link href="https://fonts.googleapis.com/css?family=Lato:300&amp;subset=latin-ext" rel="stylesheet"> {{-- alertify --}}
            <!-- JavaScript -->
            <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>

            <!-- CSS -->
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css" />
            <!-- Default theme -->
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css" />
            <!-- Semantic UI theme -->
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/semantic.min.css" />
            <!-- Bootstrap theme -->
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/bootstrap.min.css" />



            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

            <!-- Google Font -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
    html {
        position: relative;
    }

    #bodymovin {
        background: url(../images/resources/BG.jpg);
        background-size: cover;
        transform: translate3d(0, 0, 0);
        display: block;
        opacity: 1;
        width: 100%;
        position: fixed;
        top: 0;
        bottom: 0;
    }

    .login-box {
        position: fixed;
        margin-left: calc(50% - 182px);
    }

    .ajs-message.ajs-visible {
        font-size: 17px;
        opacity: 1;
        max-height: 100%;
        padding: 15px;
        margin-top: 10px;
        color: black !important;
        font-weight: bold;
    }
</style>

<body class="hold-transition">
    <div id="bodymovin">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ url(adminPath().'/') }}"><img src="{{ url('images/resources/logo.png') }}"></a>
            </div>
            <span class="gold smsp"> Change Password</span>
            <!-- /.login-logo -->
            <div class="login-box-body hub-form">
                {{--
                <form> --}} {!! csrf_field() !!}
                    <input type="hidden" name="current_passw" value="{{ session()->get('passw' ) }}">
                    <input type="hidden" name="user_id" id="user_id" value="{{$uses->id}}">
                    <div class="form-group has-feedback @if($errors->has('new_password') or session()->has('login_error')) has-error @endif">
                        <input type="password" name="new_password" id="new_password" class="form-control " placeholder="{{ trans('admin.new_password') }}">
                        @if($errors->has('new_password'))
                            <span style="color: red; position: absolute; top: 65px;">{{ $errors->first('new_password') }}</span>
                        @endif
                        @if(session()->has('login_error'))
                            <span style="color: red; position: absolute; top: 65px;">{{ session()->get('login_error') }}</span>
                        @endif
                        <span class="password form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback @if($errors->has('confirm_password') or session()->has('login_error')) has-error @endif">
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="{{ trans('admin.confirm_password') }}">
                        @if($errors->has('confirm_password'))
                            <span style="color: red; position: absolute; top: 65px;">{{ $errors->first('confirm_password') }}</span>
                        @endif
                        <span class="password form-control-feedback"></span>
                    </div>

                    <div class="col-xs-8 center">
                        <button type="submit" id="change_pass" class="btn btn-primary btn-block btn-flat hub-btn">{{ trans('admin.sign_in') }}</button>
                    </div>
                    <!-- /.col -->
            </div>
            {{-- </form> --}}

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="{{ url('style/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ url('style/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ url('plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });

        $(document).on('click', '#change_pass', function() {
            // alert('test');
            var user_id = $('#user_id').val();
            var new_password = $('#new_password').val();
            var confirm_password = $('#confirm_password').val();
            var _token = '{{ csrf_token() }}';
            alertify.set('notifier', 'position', 'top-right');
            $.ajax({
                url: "{{ url(adminPath().'/change_pass')}}" + '/' + user_id,
                method: 'POST',
                data: {
                    new_password: new_password,
                    _token: _token,
                    confirm_password: confirm_password
                },
                beforeSend: function() {

                },
                success: function(data) {
                    console.log(data);
                    if (data.status == 'success') {
                        // alert('success')

                        // alertify.success('Current position : ' + alertify.get('notifier','position'));
                        alertify.success('Thanks Change Password');
                        // alertify.success('Success Change Password');
                        setTimeout(function() {
                            // alert("Hello");
                            window.location.replace("{{ url(adminPath())}}");
                        }, 3000);
                    } else if (data.status == 'error') {
                        var msg = '';
                        $.each(data.errors, function(key, value) {
                            console.log(value);
                            msg += value[0] + ',';
                        });
                        // console.log("Errors->", data.errors);
                        // alertify.set('notifier','position', 'top-right');
                        alertify.error(msg);
                    } else {
                        console.log(data.id);
                        alertify.error('New Password cannot be same as your current password. Please choose a different password.');
                    }
                }
            });
        });
    </script>
    </div>
</body>

</html>
