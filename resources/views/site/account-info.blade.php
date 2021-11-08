@extends('layouts.app', ['title' => 'Account information'])

@section('content')

    <section class="main-bg-shop">
        <div class="cont-1194">
            <div class="bread-crumbs">
                <ul class="ul-ppm">
                    <li><a href="/" class="bread-crumb">{{ __('index.main_title') }}</a></li>
                    <li class="bread-crumb-arrow"><img src="{{ asset('img/b-arrow.svg') }}" alt=""></li>
                    <li><a href="/checkout" class="bread-crumb">{{ __('index.modal_8') }}</a></li>
                    <li class="bread-crumb-arrow"><img src="{{ asset('img/b-arrow.svg') }}" alt=""></li>
                    <li><a href="#" class="bread-crumb b-crumb-a">{{ __('index.account_info') }}</a></li>
                </ul>
            </div>
        </div>
    </section>

    <div class="cont-1194">
        <div class="cont-mc ac-chi">
            <h2>{{ __('index.account_info') }}</h2>
        </div>
        <form action="{{ route('order.account.info.store', $order) }}" method="POST" class="msb_mr">
            @csrf
            <div class="ac-ins-box cont-contact-l">
                <p class="pt_sans">{{ __('index.account_login') }}</p>
                <input type="text" placeholder="{{ __('index.account_login_you') }} " name="{{ __('index.account_login') }}">
            </div>
            <div class="ac-ins-box cont-contact-l">
                <p class="pt_sans mt-24-in">{{ __('index.password') }}</p>
                <input type="password" placeholder="{{ __('index.password') }}" name="password">
            </div>
            <div class="ac-ins-box cont-contact-l">
                <p class="pt_sans mt-24-in">Character Class</p>
                <input type="text" placeholder="Titan, Paladin 80 lvl,  etc." name="character_class">
            </div>
            <div class="ac-ins-box ac-adinfo cont-contact-l">
                <p class="pt_sans mt-24-in">{{ __('index.account_character') }}</p>
                <textarea placeholder="{{ __('index.account_additional') }}" name="info"></textarea>
            </div>
            <div class="cont-btns-forms msg_kjl">
                <div class="btn-form-send">
                    <button type="submit">{{ __('index.account_send_form') }}</button>
                </div>
                <div class="btn-winf-m">
                    <a href="{{ route('thank.order.contact') }}" class="pt_sans">{{ __('index.account_contact_operator') }}</a>
                </div>
            </div>
        </form>
    </div>

@endsection
