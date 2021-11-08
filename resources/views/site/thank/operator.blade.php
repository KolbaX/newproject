@extends('layouts.app', ['title' => 'Thank order'])

@section('content')

    <section class="main-bg-shop">
        <div class="cont-1194">
            <div class="bread-crumbs">
                <ul class="ul-ppm">
                    <li><a href="/" class="bread-crumb">{{ __('index.main_title') }}</a></li>
                </ul>
            </div>
        </div>
    </section>

    <div class="cont-1194">
        <div class="cont-th-p">
            <h1 class="th-p-title pdr_fxc">{{ __('index.thank_title_operator') }}</h1>
            <h3 class="pdr_fxc1">{{ __('index.thank_desc_operator') }}</h3>
            <div class="cont-th-slinks">
                <div class="th-slink-box">
                    <a href="{{ setting('site.skype') }}"><img src="{{ asset('img/skype.svg') }}" alt=""> Skype</a>
                </div>
                <div class="th-slink-box">
                    <a href="{{ setting('site.discord') }}" class="slink-disc"><img src="{{ asset('img/discord.svg') }}" alt="">Discord</a>
                </div>
                <div class="th-slink-box">
                    <a href="{{ setting('site.telegram') }}" class="tlg_0"><img src="{{ asset('img/telegram.svg') }}" alt="">Telegram</a>
                </div>
            </div>
            <div class="btn-winf-m c-btn-j1">
                <a href="{{ route('shop') }}" class="pt_sans btn-wback-m come_back_btn">{{ __('index.thank_back_btn') }}</a>
            </div>
        </div>
    </div>

@endsection
