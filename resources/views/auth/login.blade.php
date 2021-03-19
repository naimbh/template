<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in | {{env('APP_NAME')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{asset('backend')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend')}}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{route('home')}}"><b>{{env('APP_NAME')}}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-body login-card-body">

            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                @if ($errors->has('email'))
                    <div class="alert alert-danger text-center small">
                        {{ $errors->first('email') }}
                    </div>

                @else
                    <div class="text-info text-center m-3">Welcome Back!</div>
                @endif

                <div class="input-group">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required
                           placeholder="Email" autofocus>

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mt-3">

                    <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                           required>

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>

                    @if ($errors->has('password'))
                        <span class="text-danger small">{{ $errors->first('email') }}</span>
                    @endif

                </div>

                <div class="form-group mt-3">
                    <div class="col">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember
                                Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-block btn-primary">Login</button>
                </div>

            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

</body>
</html>
