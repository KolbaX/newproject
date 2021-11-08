@extends('layouts.app')

@section('content')

    <section class="main-bg-shop">
        <div class="cont-1194">
            <div class="bread-crumbs">
                <ul  class="ul-ppm">
                    <li><a href="/" class="bread-crumb">{{ __('index.main_title') }}</a></li>
                </ul>
            </div>
        </div>
    </section>

    <div class="cont-1194 reb-f">
        <div class="cont-form-box my_fix-spacing">
            <h1 class="th-p-title mu-pd_f">{{ __('index.forgot_password_title') }}?</h1>
            <form method="POST" action="{{ route('password.email') }}" class="forgot-form" id="demo-form">
                @csrf

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="ac-ins-box cont-contact-l">
                    <p class="pt_sans"><b>Email</b></p>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-recaptcha">
                    <div class="g-recaptcha" data-sitekey="{{ config('app.recaptcha_site_key') }}"></div>
                    <script src="https://www.google.com/recaptcha/api.js"></script>
                </div>
                <div class="cont-btns-forms">
                    <div class="btn-form-send">
                        <button type="submit">{{ __('index.reset_btn_password') }}</button>
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
