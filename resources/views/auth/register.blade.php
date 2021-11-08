@extends('layouts.app')

@section('content')

    <section class="main-bg-shop">
        <div class="cont-1194">
            <div class="bread-crumbs">
                <ul class="ul-ppm">
                    <li><a href="/" class="bread-crumb">{{ __('index.main_title') }}</a></li>
                    <li class="bread-crumb-arrow"><img src="{{ asset('img/b-arrow.svg') }}" alt=""></li>
                    <li><a href="#" class="bread-crumb b-crumb-a">{{ __('index.register_title') }}</a></li>
                </ul>
            </div>
        </div>
    </section>

    <div class="cont-1194 reb-f">
        <div class="cont-form-box">
            <h1 class="th-p-title">{{ __('index.register_title') }}</h1>
            <form id="demo-form" class="f-register-c" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="ac-ins-box cont-contact-l">
                    <p class="pt_sans"><b>{{ __('index.register_name') }}</b></p>
                    <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="KolbaWolba">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="ac-ins-box cont-contact-l pt-24p">
                    <p class="pt_sans"><b>Email</b></p>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="ac-ins-box cont-contact-l pt-24p">
                    <p class="pt_sans"><b>{{ __('index.password') }}</b></p>
                    <div class="password_toggle-eye">
                        <input id="password" type="password" class="in-pass-eye @error('password') is-invalid @enderror password-check" name="password" required autocomplete="new-password" placeholder="{{ __('index.password') }}">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="bl-toggle-pass-img">
                            <img class="toggle-password" toggle="#password-field" src="{{ asset('img/eye.svg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="ac-ins-box cont-contact-l pt-24p">
                    <p class="pt_sans pass-400 pas-str-w ">{{ __('index.password_strength') }}<span class="pass-str"></span></p>
                    <div class="password_toggle-eye">
                        <input id="password-confirm" type="password" class="in-pass-eye" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('index.confirm_password') }}">
                        <div class="bl-toggle-pass-img">
                            <img class="toggle-password" toggle="#password-field" src="{{ asset('img/eye.svg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="form-recaptcha">
                    <div class="g-recaptcha" data-sitekey="{{ config('app.recaptcha_site_key') }}"></div>
                    <script src="https://www.google.com/recaptcha/api.js"></script>
                    @error('g-recaptcha-response')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="cont-btns-forms register">
                    <div class="btn-form-send">
                        <button type="submit">{{ __('index.create_account') }}</button>
                    </div>
                    <div class="btn-winf-m">
                        <a href="{{ route('login') }}" class="pt_sans btn-wback-m">{{ __('index.back_btn') }}</a>
                    </div>
                    <div class="btn-form-back">
                        <a href="#"></a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
