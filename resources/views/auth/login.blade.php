@extends('layouts.app', ['title' => 'Sign In'])

@section('content')

    <section class="main-bg-shop">
        <div class="cont-1194">
            <div class="bread-crumbs">
                <ul class="ul-ppm">
                    <li><a href="/" class="bread-crumb">{{ __('index.main_title') }}</a></li>
                    <li class="bread-crumb-arrow"><img src="{{ asset('img/b-arrow.svg') }}" alt=""></li>
                    <li><a href="#" class="bread-crumb b-crumb-a">{{ __('index.log_in_title') }}</a></li>
                </ul>
            </div>
        </div>
    </section>

    <div class="cont-1194">
        <div class="cont-form-box sign_in_ss">
            <h1 class="th-p-title">{{ __('index.sign_id') }}</h1>
            <form action="{{ route('login') }}" method="POST" class="f-sign-in-c">
                @csrf
                <div class="ac-ins-box cont-contact-l pt-24p">
                    <p class="pt_sans fw_800">Email</p>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="ac-ins-box cont-contact-l pt-24p">
                    <p class="pt_sans fw_800">{{ __('index.password') }}</p>
                    <div class="password_toggle-eye">
                        <input id="pass_log_id" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div class="bl-toggle-pass-img">
                            <img class="toggle-password" toggle="#password-field" src="img/eye.svg" alt="">
                        </div>
                    </div>
                </div>

                <div class="form-box-rem-m">
                    <label class="checkbox-s-plat">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <p>{{ __('index.remember_me') }}</p>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="fb-for-pass" href="{{ route('password.request') }}">
                            {{ __('index.forgot_password') }}?
                        </a>
                    @endif
                </div>
                <div class="cont-btns-forms">
                    <div class="btn-form-send">
                        <button type="submit">{{ __('index.log_in_title') }}</button>
                    </div>
                </div>
                <div class="form-nreg-box">
                    <p>{{ __('index.account_yes') }}? <a href="{{ route('register') }}">{{ __('index.create_account') }}</a></p>
                </div>
            </form>
        </div>
    </div>

@endsection
