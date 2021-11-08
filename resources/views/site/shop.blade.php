@extends('layouts.app', ['title' => 'shop'])

@section('content')

    <section class="main-bg-shop" @if($game && $game->shop_big_banner) style="background-image: url(/storage/{{ $game->shop_big_banner }});" @endif>
        <div class="cont-1194">
            <div class="bread-crumbs">
                <ul>
                    <li><a href="/" class="bread-crumb">{{ __('index.main_title') }}</a></li>
                    <li class="bread-crumb-arrow"><img src="img/b-arrow.svg" alt=""></li>
                    <li><a href="#" class="bread-crumb b-crumb-a">{{ __('index.shop') }}</a></li>
                </ul>
            </div>
        </div>
    </section>

    <div class="cont-1194">
        @if(!$game)
            <div class="b_pvp-sale" style="background-image: url('/storage/{{ setting('site.shop_dafault_banner') }}');">
                <h1>{{ setting('site.title_1_shop') }}</h1>
                <h1 class="b_pvp-sale-bl">{{ setting('site.title_2_shop') }}</h1>
            </div>
        @else
            <div class="b_pvp-sale" @if($game->shop_banner) style="background-image: url('/storage/{{ $game->shop_banner }}');" @else style="background-image: url('/storage/{{ setting('site.shop_dafault_banner') }}');" @endif>
                @if($game->shop_title) <h1>{{ $game->getTranslatedAttribute('shop_title', app()->getLocale(), 'fallbackLocale') }}</h1> @else <h1>
                {{ setting('site.title_1_shop') }}</h1> @endif
                <h1 class="b_pvp-sale-bl">@if($game->shop_sub_title) {{ $game->getTranslatedAttribute('shop_sub_title', app()->getLocale(), 'fallbackLocale') }} @else {{ setting('site.title_2_shop') }} @endif</h1>
            </div>
        @endif
    </div>

    @if(isset($request->q))
        <div class="cont-1194">
            <div class="big-w-sale">
                <h3 class="pt_sans">{{ __('index.search_result') }}: <span class="search-rr-f">{{ $request->q }}<a
                            href="/shop"><span class="search-close_img"><img src="img/Union.svg"></span></a></span></h3>
            </div>
        </div>
    @endif

    <div class="cont-1194">
        <div class="shop__search-b">
            <div class="search__filters">
                <form id="filter-form" method="POST" action="/filter">

                    <input type="hidden" name="game" value="@if($request->game) {{ $request->game }} @else none @endif">
                    <input type="hidden" name="q" value="{{ $request->q }}">

                    @csrf

                    @if($game)
                        @foreach($tagGroups as $group)

                            <div class="filter-box">
                                <h6 class="pt_sans fb-title">{{ $group->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}</h6>
                                @foreach(\App\Models\Tag::where('group_id', $group->id)->get() as $tag)
                                    <label class="checkbox-other">
                                        <input type="checkbox" class="filter-tag" name="tags[]" value="{{ $tag->id }}">
                                        <span>{{ $tag->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endforeach
                    @else

                        @foreach($games as $g)
                            <div class="parent_block_t">
                                <h6 class="pt_sans fb-title parent_title hide_p">{{ $g->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}</h6>
                                <div class="filter-box parent_box" style="display: none;">

                                    @foreach($g->tags as $tagGroup)
                                        <div class="box-togle_cont">
                                            <h6 class="pt_sans fb-title child-title_m hide_c">{{ $tagGroup->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}</h6>
                                            <div class="child-box_m" style="display: none;">
                                                @foreach(\App\Models\Tag::where('group_id', $tagGroup->id)->get() as $_tag)
                                                    <label class="checkbox-other">
                                                        <input type="checkbox" class="filter-tag" name="tags[]" value="{{ $_tag->id }}">
                                                        <span>{{ $_tag->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        @endforeach
                    @endif

                </form>
            </div>
            <div class="search__results">
                @include('site.shop-list')
            </div>
        </div>
    </div>

    <div class="pch-lv cont-1194 shop-perfect">
        <h3 class="ltr-spc">{{ __('index.popular_title') }}</h3>
        <div class="wrp_ov_scrl">
            <div class="pch-lv-items slick_m kifix">

                @if($request->game)
                    @foreach(\App\Models\Product::where('game_id', $request->game)->orderBy('view', 'desc')->limit(12)->get() as $prodView)
                        @include('site.product.card', ['product' => $prodView, 'class' => 'shop-item_w'])
                    @endforeach
                @else
                    @foreach(\App\Models\Product::orderBy('view', 'desc')->limit(12)->get() as $prodView)
                        @include('site.product.card', ['product' => $prodView, 'class' => 'shop-item_w'])
                    @endforeach
                @endif

            </div>
        </div>
    </div>

    <div class="pch-lvd cont-1194 pch_my_ck">
        <h3 class="ltr-spc">{{ __('index.last_viewed_title') }}</h3>
        <div class="wrp_ov_scrl">
            <div class="pch-lv-items slick_m kifix">
                @php
                    $_productViewed = [];
                    foreach ($_COOKIE as $key => $value){
                        if(stripos($key, 'product') !== false){
                            $_productViewed[] = $value;
                        }
                    }
                    $productViewed = \App\Models\Product::whereIn('id', $_productViewed)->limit(12)->get();
                @endphp

                @foreach($productViewed as $pv)
                    @include('site.product.card', ['product' => $pv, 'class' => 'shop-item_w'])
                @endforeach

            </div>
        </div>
    </div>

@endsection
