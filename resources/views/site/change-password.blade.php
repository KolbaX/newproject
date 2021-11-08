@extends('layouts.app', ['title' => 'Thank order'])

@section('content')

    @extends('layouts.app')

@section('content')

    <section class="main-bg-shop">
        <div class="cont-1194">
            <div class="bread-crumbs">
                <ul  class="ul-ppm">
                    <li><a href="#" class="bread-crumb">Main</a></li>
                </ul>
            </div>
        </div>
    </section>

    <div class="cont-1194 reb-f">
        <div class="cont-form-box nst_sd">
            <h1 class="th-p-title">Change Password</h1>
            <form id="demo-form" class="change-pass" method="POST" action="{{ route('change.password.set') }}">
                @csrf

                <div class="ac-ins-box cont-contact-l">
                    <p class="pt_sans"><b>New Password</b></p>
                    <div class="password_toggle-eye">
                        <input id="password" type="password" class="in-pass-eye @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"  placeholder="New Password">

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
                    <p class="pt_sans pass-400 psw-m">Password Strength: Weak</p>
                    <div class="password_toggle-eye">
                        <input id="password-confirm" type="password" class="in-pass-eye" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm New Password">
                        <div class="bl-toggle-pass-img">
                            <img class="toggle-password" toggle="#password-field" src="{{ asset('img/eye.svg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="cont-btns-forms cont-btn-ff_0">
                    <div class="btn-form-send">
                        <button type="submit">Save Changes</button>
                    </div>
                    <div class="btn-winf-m">
                        <a href="{{ route('home') }}" class="pt_sans btn-wback-m">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


@endsection
