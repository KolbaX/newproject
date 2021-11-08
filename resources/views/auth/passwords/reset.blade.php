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
        <div class="cont-form-box nst_sd">
            <h1 class="th-p-title">{{ __('index.change_password') }}</h1>
            <form id="demo-form" class="change-pass" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                <div class="ac-ins-box cont-contact-l">
                    <p class="pt_sans"><b>{{ __('index.new_password') }}</b></p>
                    <div class="password_toggle-eye">
                        <input id="password" type="password" class="in-pass-eye @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"  placeholder="{{ __('index.new_password') }}">

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
                <div class="ac-ins-box cont-contact-l">
                    <p class="pt_sans pass-400 psw-m">{{ __('index.password_strength') }}</p>
                    <div class="password_toggle-eye">
                        <input id="password-confirm" type="password" class="in-pass-eye" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('index.confirm_new_pass') }}">
                        <div class="bl-toggle-pass-img">
                            <img class="toggle-password" toggle="#password-field" src="{{ asset('img/eye.svg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="cont-btns-forms cont-btn-ff_0">
                    <div class="btn-form-send">
                        <button type="submit">{{ __('index.save_change') }}</button>
                    </div>
                    <div class="btn-winf-m">
                        <a href="{{ route('login') }}" class="pt_sans btn-wback-m">{{ __('index.back_btn') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
