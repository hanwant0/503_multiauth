<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $page_title or "Admin Login" }}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css")}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{asset("/bower_components/AdminLTE/plugins/iCheck/square/blue.css")}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <header class="main-header">
            <!-- Logo -->
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown"> 
                            <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle lang" href="#">
                                <img src="{{url('images/'.App::getLocale().'.gif')}}"> 
                                <span class="caret"></span>
                            </a>
                            <ul role="menu" class="dropdown-menu ">
                                <li><a class="switch_lang" href="#" id="en"><img src="{{url('images/en.gif')}}"/> English</a></li>
                                <li><a class="switch_lang" href="#" id="fr"><img src="{{url('images/fr.gif')}}"/> français</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>Admin</b>LTE</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">{{trans('language.sign_in_session')}}</p>

                @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
                @endif
                @if (count($errors)) 

                <div class="alert alert-danger">
                    @foreach($errors->all() as $error) 
                    <p>{{ $error }}</p>
                    @endforeach 
                </div>
                @endif

                {!! Form::open(['enctype'=>"multipart/form-data",'class'=>'','url' => url('admin/login')]) !!}

                <div class="form-group has-feedback">
                    {!!Form::text('email','',['class'=>'form-control','autofocus','placeholder'=>trans('language.email')])!!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {!!Form::password('password',['class'=>'form-control','placeholder'=>trans('language.password')])!!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                {!!Form::checkbox('remember')!!} {{trans('language.remember_me')}}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        {!!Form::submit(trans('language.login'),['class'=>'btn btn-primary btn-block btn-flat'])!!}
                    </div>
                    <!-- /.col -->
                </div>
                {!! Form::close() !!}
                <!-- /.social-auth-links -->
                <a href="{{ url('admin/password/reset') }}">{{trans('language.forgot_password')}}</a><br>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 2.2.3 -->
        <script src="{{asset("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{asset("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js")}}"></script>
        <!-- iCheck -->
        <script src="{{asset("/bower_components/AdminLTE/plugins/iCheck/icheck.min.js")}}"></script>
        <script>
$(function() {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});
$(function() {
    $('.switch_lang').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('id');

        var token = '{!!csrf_token()!!}';

        $.ajax(
                {
                    url: "{!!url('set-language')!!}",
                    type: 'POST',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'POST',
                        "_token": token
                    },
                    error: function()
                    {
                        alert('something goes wrong');
                    },
                    success: function(res)
                    {
                        location.reload();
                    }
                });
    });

});
        </script>
    </body>
</html>
