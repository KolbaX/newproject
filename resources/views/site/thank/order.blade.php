@extends('layouts.app', ['title' => 'Thank order'])

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

    <div class="cont-1194">
        <div class="cont-th-p th_2">
            <h1 class="th-p-title">{{ __('index.thank_title_operator') }}</h1>
            <h3 class="thnk_2">{{ __('index.thank_order_desc') }}</h3>
            <div class="btn-winf-m c-btn-ty">
                <a href="{{ route('shop') }}" class="pt_sans btn-wback-m come_back_btn">{{ __('index.thank_back_btn') }}</a>
            </div>
        </div>
    </div>

@endsection
