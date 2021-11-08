<div class="section__shop-item @isset($class) {{ $class }} @endisset">
    <a href="{{ route('product', $product) }}" class="link-shom_mm">
        <img src="/storage/{{ $product->image }}" class="shop_img_m" alt="">
        <h6 class="shop-item-name pt_sans">{{ $product->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}</h6>
    </a>
    <b class="shop-item-start">{{ __('index.product_start_price') }}</b>
    <div class="shop-item-prices">
        @if(!isset($_COOKIE['currency']) OR $_COOKIE['currency'] == 'USD')
            <h4 class="shop-item-price">${{ $product->new_amount??$product->amount }}</h4>
            @if($product->new_amount) <h5 class="shop-item-ol-price">${{ $product->amount }}</h5> @endif
        @elseif($_COOKIE['currency'] == 'EUR')
            <h4 class="shop-item-price">€{{ $product->new_amount_eur??$product->amount_eur }}</h4>
            @if($product->new_amount_eur) <h5 class="shop-item-ol-price">€{{ $product->amount_eur }}</h5> @endif
        @else
            <h4 class="shop-item-price">₽{{ $product->new_amount_rub??$product->amount_rub }}</h4>
            @if($product->new_amount_rub) <h5 class="shop-item-ol-price">₽{{ $product->amount_rub }}</h5> @endif
        @endif

    </div>
</div>
