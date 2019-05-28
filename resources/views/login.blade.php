<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>{{ \Dean\Login\Login::config('pageTitle')?:'Login' }}</title>

    <link href="{{ admin_asset('/vendor/laravel-admin-ext/dean/login/system/frame/css/bootstrap.min.css') }}?v=3.4.0" rel="stylesheet">
    <link href="{{ admin_asset('/vendor/laravel-admin-ext/dean/login/system/frame/css/font-awesome.min.css') }}?v=4.3.0" rel="stylesheet">
    <link href="{{ admin_asset('/vendor/laravel-admin-ext/dean/login/system/frame/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ admin_asset('/vendor/laravel-admin-ext/dean/login/system/frame/css/style.min.css') }}?v=3.0.0" rel="stylesheet">
    <script>
        top != window && (top.location.href = location.href);
    </script>
    @if(\Dean\Login\Login::config('backgroundImagePath',''))
        <style>
            @media (min-width:768px) {
            .login-bg {
                background-image: url("{{ \Dean\Login\Login::config('backgroundImagePath','/vendor/laravel-admin-ext/dean/login/system/images/bg-logo.jpg') }}")
            }
        }
        </style>
    @endif
</head>
<body class="gray-bg login-bg">
<canvas id="canvas" width="900" height="300" style="position: fixed;top: -50px;width: 60%;left: 20%"></canvas>
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div class="login-group">
        <h3 class="login-logo">
            @if(\Dean\Login\Login::config('logoPath',''))
                <img src="{{ \Dean\Login\Login::config('logoPath', admin_asset('/vendor/laravel-admin-ext/dean/login/system/images/logo.png') )}}">
            @else
                <span style="font-size: 24px;">{{ \Dean\Login\Login::config('logoText')?:'Login' }}</span>
            @endif
        </h3>
        <form role="form" action="{{ admin_base_path('auth/login') }}" method="post">
            <div class="form-group">
                <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-user"></i> </span>
                    <input type="text" id="account" name="username" placeholder="{{ trans('admin.username') }}" class="form-control" value="{{ old('username') }}">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-unlock-alt"></i> </span>
                    <input type="password" class="form-control" id="pwd" name="password" placeholder="{{ trans('admin.password') }}">
                </div>

            </div>
            @if(\Dean\Login\Login::config('verification_code_enable'))
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" id="verify" name="captcha" placeholder="{{ trans('admin.captcha') }}">
                    <span class="input-group-btn" style="padding: 0;margin: 0;">
                        <img id="verify_img" src="{{ captcha_src('admin') }}" alt="{{ trans('admin.captcha') }}" style="padding: 0;height: 34px;margin: 0;" onclick="this.src='{{ captcha_src('admin') }}'+Math.random()">
                    </span>
                </div>
            </div>
            @endif
            <div class="form-group">
                <strong>
                    <p class="text-danger" id="err" style="display: {!! $errors->isNotEmpty() ? 'block':'none' !!};">
                        @if($errors->isNotEmpty())
                            @foreach($errors->all() as $message)
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
                            @endforeach
                        @endif
                    </p>
                </strong>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-primary block full-width m-b">{{ trans('admin.login') }}</button>
        </form>
    </div>
</div>
<div class="footer" style=" position: fixed;bottom: 0;width: 100%;left: 0;margin: 0;opacity: 0.8;">
    <div class="pull-right">{{ config('app.name') }} </div>
</div>

<!-- 全局js -->
<script src="{{ admin_asset('/vendor/laravel-admin-ext/dean/login/static/plug/jquery-1.10.2.min.js') }}"></script>
<script src="{{ admin_asset('/vendor/laravel-admin-ext/dean/login/system/frame/js/bootstrap.min.js?v=3.4.0') }}"></script>
<script src="{{ admin_asset("/vendor/laravel-admin-ext/dean/login/login/flaotfont.js") }}"></script>
<script src="{{ admin_asset("/vendor/laravel-admin-ext/dean/login/login/ios-parallax.js") }}"></script>
<script src="{{ admin_asset("/vendor/laravel-admin-ext/dean/login/login/index.js") }}"></script>
<!--统计代码，可删除-->
<!--点击刷新验证码-->
</body>
</html>