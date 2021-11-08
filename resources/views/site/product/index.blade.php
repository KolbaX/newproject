@extends('layouts.app', ['title' => $title])

@section('content')

    <section class="main-bg-shop">
        <div class="cont-1194">
            <div class="bread-crumbs">
                <ul class="ul-ppm fxlp">
                    <li><a href="/" class="bread-crumb">{{ __('index.main_title') }}</a></li>
                    <li class="bread-crumb-arrow"><img src="{{ asset('img/b-arrow.svg') }}" alt=""></li>
                    <li><a href="/shop?game={{ $product->game_id }}" class="bread-crumb">{{ __('index.shop') }}</a></li>
                    <!-- <li class="bread-crumb-arrow"><img src="{{ asset('img/b-arrow.svg') }}" alt=""></li>
                    <li><a href="#" class="bread-crumb">Raid</a></li> -->
                    <li class="bread-crumb-arrow"><img src="{{ asset('img/b-arrow.svg') }}" alt=""></li>
                    <li><a href="javascript:;" class="bread-crumb b-crumb-a">{{ $product->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}</a></li>
                </ul>
            </div>
        </div>
    </section>

    <div class="cont-1194">
        <div class="c-tags-con">
            <div class="c-tag-con">
                <ul>
                    @foreach($tags as $tag)
                        <li><a href="#" class="pt_sans">{{ $tag->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="cont-1194">
        <div class="cont-lr-box">

            <div class="cont-lp">
                <form action="{{ route('add.cart', $product) }}" method="POST" class="form-add-cart">
                    @csrf
                    <img src="/storage/{{ $product->image }}" alt="">
                    <b class="txt-ttl_sf">{{ __('index.platform') }}</b>
                    <div class="form_radio">
                        <input id="radio-1" type="radio" name="platform" value="PC" @if($cart && $cart->platform == 'PC') checked @endif @if(!$cart) checked @endif>
                        <label for="radio-1">PC</label>
                    </div>
                    <div class="form_radio">
                        <input id="radio-2" type="radio" name="platform" value="PS4" @if($cart && $cart->platform == 'PS4') checked @endif>
                        <label for="radio-2">PS4</label>
                    </div>
                    <div class="form_radio">
                        <input id="radio-3" type="radio" name="platform" value="Xbox" @if($cart && $cart->platform == 'Xbox') checked @endif>
                        <label for="radio-3">Xbox</label>
                    </div>
                    <div class="filter-s-plat">
                        @isset($cart)
                            @php $challenge = json_decode($cart->challenge); @endphp
                        @endisset
                        @if(!isset($_COOKIE['currency']) OR $_COOKIE['currency'] == 'USD')
                            @foreach($product->options as $option)
                                <label class="checkbox-s-plat">
                                    <input type="checkbox" name="challenge[{{ $option->id }}]" value="option{{ $option->id }}" @isset($challenge) @if(array_search('option'.$option->id, $challenge) === 0 OR array_search('option'.$option->id, $challenge)) checked @endif @endisset class="product-option" data-amount="{{ $option->amount }}">
                                    <span class="pt_sans">{{ $option->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }} <h5 class="pt_sans"><b class="mrr_lls">+</b><b class="mrr_lls1">$</b>{{ $option->amount }}</h5></span>
                                </label>
                            @endforeach
                        @elseif($_COOKIE['currency'] == 'EUR')
                            @foreach($product->options as $option)
                                <label class="checkbox-s-plat">
                                    <input type="checkbox" name="challenge[{{ $option->id }}]" value="option{{ $option->id }}" @isset($challenge) @if(array_search('option'.$option->id, $challenge) === 0 OR array_search('option'.$option->id, $challenge)) checked @endif @endisset class="product-option" data-amount="{{ $option->amount_eur }}">
                                    <span class="pt_sans">{{ $option->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }} <h5 class="pt_sans"><b class="mrr_lls">+</b><b class="mrr_lls1">€</b>{{ $option->amount_eur }}</h5></span>
                                </label>
                            @endforeach
                        @else
                            @foreach($product->options as $option)
                                <label class="checkbox-s-plat">
                                    <input type="checkbox" name="challenge[{{ $option->id }}]" value="option{{ $option->id }}" @isset($challenge) @if(array_search('option'.$option->id, $challenge) === 0 OR array_search('option'.$option->id, $challenge)) checked @endif @endisset class="product-option" data-amount="{{ $option->amount_rub }}">
                                    <span class="pt_sans">{{ $option->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }} <h5 class="pt_sans"><b class="mrr_lls">+</b><b class="mrr_lls1">₽</b>{{ $option->amount_rub }}</h5></span>
                                </label>
                            @endforeach
                        @endif
                    </div>
                    <div class="cont-lp-prices">
                        @if(!isset($_COOKIE['currency']) OR $_COOKIE['currency'] == 'USD')
                            @if($product->new_amount) <h4 class="cont-lp-old-price">$<span class="old-total-amount">{{ $product->amount }}</span></h4> @endif
                            <h1 class="cont-lp-price">$<span class="total-amount">{{ $product->new_amount??$product->amount }}</span></h1>
                        @elseif($_COOKIE['currency'] == 'EUR')
                            @if($product->new_amount_eur) <h4 class="cont-lp-old-price">€<span class="old-total-amount">{{ $product->amount_eur }}</span></h4> @endif
                            <h1 class="cont-lp-price">€<span class="total-amount">{{ $product->new_amount_eur??$product->amount_eur }}</span></h1>
                        @else
                            @if($product->new_amount_rub) <h4 class="cont-lp-old-price">₽<span class="old-total-amount">{{ $product->amount_rub }}</span></h4> @endif
                            <h1 class="cont-lp-price">₽<span class="total-amount">{{ $product->new_amount_rub??$product->amount_rub }}</span></h1>
                        @endif
                    </div>
                    <div class="cont-lp-btn">
                        <button class="pt_sans" data-game="{{ $product->game_id }}">@if($cart) {{ __('index.remove_cart') }} @else {{ __('index.add_to_cart') }} @endif</button>
                    </div>
                </form>
            </div>

            <div class="cont-rp list_2fx">
                <h2 class="cont-rp-title">{{ $product->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}</h2>
                <h5 class="pt_sans mr-img_tx"><img src="{{ asset('img/des-p.svg') }}" alt=""> {{ __('index.service_include') }}</h5>
                {!! $product->getTranslatedAttribute('service', app()->getLocale(), 'fallbackLocale') !!}
                <p class="de-clo1 fw_800"><i class="far fa-clock"></i>{{ __('index.deadline') }}: {{ $product->getTranslatedAttribute('deadline', app()->getLocale(), 'fallbackLocale') }}</p>
                <h5 class="req-loc pt_sans"><img src="{{ asset('img/lock.svg') }}" alt=""> {{ __('index.requirements') }}</h5>
                {!! $product->getTranslatedAttribute('requirements', app()->getLocale(), 'fallbackLocale') !!}
                <p class="de-clo2"><img src="{{ asset('img/headset.svg') }}" alt=""><b>{{ __('index.desc_contact_operator') }}</b></p>
            </div>
        </div>
    </div>


    <div class="lis-cont-nn">
        <div class="pch-lvd cont-1194 pch_my_ck">
            <h3 class="ltr-spc">{{ __('index.often') }}</h3>
            <div class="wrp_ov_scrl">
                <div class="pch-lv-items slick_m">
                    @foreach($products as $more)
                        @include('site.product.card', ['product' => $more, 'class' => 'shop-item_w'])
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
