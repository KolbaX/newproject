@extends('layouts.app')

@section('content')

    <div class="container" name="top">
        <section class="section__first">
            <div class="section__df1">
                <h1>{{ __('index.main_title_s_1') }}</h1>
                <h5 class="pt_sans fw400">{{ __('index.main_desc_s_1') }}</h5>
                <div class="section__first-btn">
                    <a href="#game-list" class="blue-btn btn-b-a btn-anchor">{{ __('index.main_btn_s_1') }}</a>
                </div>
            </div>
            <div class="wd-57">
                <div class="desk-rbf">
                    <img src="{{ asset('img/robot-min.png') }}" alt="">
                </div>
            </div>
        </section>
    </div>
    <div class="container">
        <section class="section__first-s">
            <div class="section__desc-img">
                <img src="{{ asset('img/rbk-circ.png') }}" alt="">
            </div>
            <div class="wd-49">
                <div class="section__desc">
                    <h2 class="d-2-mb">{{ __('index.main_title_s_2') }}?</h2>
                    <p class="lh-h jkmm">{{ __('index.main_desc_s_2') }}</p>
                    <div class="section__orders-comp">
                        <div class="star-containers">
                            <div class="star-container">
                                <img src="{{ asset('img/star.svg') }}" alt="">
                            </div>
                            <div class="star-container">
                                <img src="{{ asset('img/star.svg') }}" alt="">
                            </div>
                            <div class="star-container">
                                <img src="{{ asset('img/star.svg') }}" alt="">
                            </div>
                            <div class="star-container">
                                <img src="{{ asset('img/star.svg') }}" alt="">
                            </div>
                            <div class="star-container">
                                <img src="{{ asset('img/star.svg') }}" alt="">
                            </div>
                        </div>


                        <!-- TrustBox widget - Micro Review Count -->
                        <div class="trustpilot-widget" data-locale="en-US" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="616f23597add56db278d6179" data-style-height="24px" data-style-width="100%" data-theme="light" data-min-review-count="10">
                          <a href="https://www.trustpilot.com/review/werotboost.shop" target="_blank" rel="noopener">Trustpilot</a>
                        </div>
                        <!-- End TrustBox widget -->


                        <!-- <p class="fix_dd"><span><b>1102</b> {{ __('index.main_stars_s_2') }}</span><img src="{{ asset('img/Trustpilot_logo.png') }}" alt=""></p> -->
                        <p class="order-mu">{{ __('index.main_orders_s_2') }}</p>
                        @php 
                            $orderCount = \App\Models\Order::count();
                            $orderCountStr = str_split(str_pad($orderCount, 6, '0', STR_PAD_LEFT));
                        @endphp
                        <div class="cnt_ss">
                         @foreach($orderCountStr as $ocs)
                                <span class="cnt_lc">
                                    <span>{{ $ocs }}</span>
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <p class="mrl-2">{{ __('index.main_desc_2_s_2') }}</p>
                    <div class="section__first-btn">
                        <a href="https://www.trustpilot.com/review/werotboost.shop" class="green-btn btn-gtr-h">{{ __('index.main_btn_s_2') }}</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container">
        <section class="section__first mt-240">
            <div class="w-45">
                <div class="section__d-2">
                    <h2 class="d-12-mb fx_jk3">WEROT'S {{ __('index.main_title_s_3') }}</h2>
                    <h3 class="pt_sans fw400 iklop">{{ __('index.main_desc_s_3') }}</h3>
                    <div class="section__desc-opt">
                        <div class="section__desc-opt__img">
                            <img src="{{ asset('img/telegram-L.svg') }}" alt="" class="fxilk1">
                        </div>
                        <div class="section__desc-opt__text desc_container">
                            <h4>{{ __('index.main_block_title_1_s_3') }}</h4>
                            <p class="lh-l">{{ __('index.main_block_desc_1_s_3') }}</p>
                        </div>
                    </div>
                    <div class="section__desc-opt">
                        <div class="section__desc-opt__img">
                            <img src="{{ asset('img/Group120.svg') }}" alt="" class="fxilk2">
                        </div>
                        <div class="section__desc-opt__text desc_container">
                            <h4>{{ __('index.main_block_title_2_s_3') }}</h4>
                            <p class="lh-l">{{ __('index.main_block_desc_2_s_3') }}</p>
                        </div>
                    </div>
                    <div class="section__desc-opt">
                        <div class="section__desc-opt__img">
                            <img src="{{ asset('img/Group121.svg') }}" alt="" class="osobl_im">
                        </div>
                        <div class="section__desc-opt__text desc_container">
                            <h4>{{ __('index.main_block_title_3_s_3') }}</h4>
                            <p class="lh-l">{{ __('index.main_block_desc_3_s_3') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-55">
                <div class="desk-rbk">
                    <img src="{{ asset('img/rbk.png') }}" alt="">
                </div>
            </div>
        </section>
    </div>
    <div class="container" id="game-list">
        <section class="section__second">
            <h2 class="section__h-title">SELECTION OF GAMES</h2>
            <div class="section__games-items kt-fix_pd">
                @foreach($games as $game)
                    @if($game->coming_soon === 0)
                        <div class="game__item-d">
                            <img class="game__item-img" src="/storage/{{ $game->image }}" alt="">
                            <h2 class="game__item-title">
                                {{ $game->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}
                            </h2>
                            <div class="game__item-btn">
                                <a href="{{ route('shop') }}?game={{ $game->id }}" class="btn-b-a">{{ __('index.main_btn_s_4') }}</a>
                            </div>
                        </div>
                    @else
                        <div class="game__item-d">
                            <img class="game__item-img" src="/storage/{{ $game->image }}" alt="">
                            <h2 class="game__item-title">
                                {{ $game->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}
                            </h2>
                            <div class="game__item-btn">
                                <a href="javascript:;" class="btn-b-a">{{ __('index.main_btn_s_4') }}</a>
                            </div>
                            <div class="diss_blk">
                                <img src="{{ asset('img/arm.svg') }}" class="arm">
                            </div>
                        </div>
                    @endif

                @endforeach

            </div>
        </section>
    </div>
    <section class="section__second">
        <div class="container">
            <h2 class="section__h-title">{{ __('index.main_title_s_5') }}</h2>
            <img src="{{ asset('img/image 8.png') }}" class="section__img-mw" alt="" id="banner-res-game" style="max-height: 120px;">
            <div class="pos-rel cls_kjf">
                <div class="section__t-sell">
                    <div class="first_bb">
                        <img src="{{ asset('img/down.svg') }}" class="img_icn">
                    </div>
                    <div class="lr_ggf">
                    </div>
                    <div class="ln_content">
                        <h5 class="fw_800" id="title-res-game">Destiny 2</h5>
                    </div>
                </div>
                <div class="dropdown-menu container cst-cls_mj">
                    <div class="bgouto_a">
                        @foreach($gameTops as $pt)
                            <div class="bgv_s">
                                <a class="dropdown-item" href="javascript:;" onclick="loadGame({{ $pt->id }}, '{{ $pt->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}', '/storage/{{ $pt->banner }}');">
                                    <div class="bgv_s-img">
                                        <img src="/storage/{{ $pt->image_preview }}" alt="">
                                    </div>
                                    <h5 class="fw_800">{{ $pt->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}</h5>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="section__shop-items home" id="result-product-home">
                @foreach($products as $product)
                    @include('site.product.card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

@endsection
