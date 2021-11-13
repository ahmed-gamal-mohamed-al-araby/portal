<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('dist/img/favicon.png') }}">
    <title>EECGroup | Login</title>
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{asset('dist/css-rtl/login.css')}}" />
    @else
        <link rel="stylesheet" href="{{asset('dist/css/login.css')}}" />
    @endif
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('dist/css/loader.css')}}" />
    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: 'Cairo', sans-serif !important;
        }
    </style>
</head>
<body>
<div class="login-loader">
    <svg viewBox="0 0 1350 600">
        <text x="50%" y="50%" fill="transparent" text-anchor="middle">
            EEC  Group
        </text>

    </svg>
</div>
<div class="container sign-up-mode">
    <div class="overlay"></div>
    <div class="forms-container">

        <div class="signin-signup">

          @if($validUser ?? '' == 2)
          <form class="sign-up-form" method="POST" action="{{ route('login') }}">
            @csrf
        <h2 class="title">@lang('site.Login') {{ request()->userName_or_email_or_code }}</h2>


            <div class="input-field">
                <i class="fas fa-user"></i>
                <input id="userName_or_email_or_code" type="text" class=" @error('userName_or_email_or_code') is-invalid @enderror" placeholder="@lang('site.email-username-code')" name="userName_or_email_or_code" value="@if(request()->userName_or_email_or_code){{ request()->userName_or_email_or_code }}@endif" autofocus required>

            </div>
            <p class="login-error-message">
                @error('userName_or_email_or_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </p>

            <div class="input-field">
                <i class="fas fa-lock"></i>
                    <input id="password" type="password"  placeholder="@lang('site.password')"  class=" @error('password') is-invalid @enderror" name="password" required>
            </div>
            <p class="login-error-message">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </p>
            <input type="submit" class="btn" value="@lang('site.Login')" />


        </form>

          @elseif($validUser ?? '' == 1)
                <div class="message-permission">
                    <span>  عفوا !</span>
                <br>    لا يمكنك الدخول للتطبيق
                    <br>  الرجاء الرجوع للشخص المسئول

                </div>
          @else
          <form class="sign-up-form" method="POST" action="{{ route('login') }}">
            @csrf
        <h2 class="title">@lang('site.Login')</h2>

            <div class="input-field">
                <i class="fas fa-user"></i>
                <input id="userName_or_email_or_code" type="text" class=" @error('userName_or_email_or_code') is-invalid @enderror" placeholder="@lang('site.email-username-code')" name="userName_or_email_or_code" value="@if(request()->userName_or_email_or_code){{ request()->userName_or_email_or_code }}@endif" autofocus required>

            </div>
            <p class="login-error-message">
                @error('userName_or_email_or_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </p>

            <div class="input-field">
                <i class="fas fa-lock"></i>
                    <input id="password" type="password"  placeholder="@lang('site.password')"  class=" @error('password') is-invalid @enderror" name="password" required>
            </div>
            <p class="login-error-message">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </p>
            <input type="submit" class="btn" value="@lang('site.Login')" />
        </form>

          @endif
        </div>
    </div>

    <div class="panels-container">

        <div class="panel left-panel">

        </div>
        <div class="panel @if (app()->getLocale() == 'ar') right-panel @else left-panel  @endif">
            <div class="content">
                <h3>EEC Group</h3>
                {{-- <p>
                    <br> @lang('site.system_title')
                </p> --}}

            </div>
            <img src="{{asset('dist/img/register.svg')}}" class="image" alt="" />
        </div>
    </div>
</div>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
</body>
</html>
