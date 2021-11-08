<div class="search-res-bl-items cst-cls_mj-search">

    @foreach($products as $product)
    <div class="search-res-bl-item">
        <a class="" href="{{ route('product', $product) }}">
            <img src="/storage/{{ $product->image }}" alt="">
            <div class="search-res-bli">
                <h6 class="search-res-item-n pt_sans fw700">{{ $product->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}</h6>
                <p class="search-res-st pt_sans fw700">{{ __('index.product_start_price') }}</p>

                @if(!isset($_COOKIE['currency']) OR $_COOKIE['currency'] == 'USD')
                    @if($product->new_amount)
                        <p class="search-res-price montserrat">${{ $product->new_amount }}</p>
                    @else
                        <p class="search-res-price montserrat">${{ $product->amount }}</p>
                    @endif
                @elseif($_COOKIE['currency'] == 'EUR')
                    @if($product->new_amount_eur)
                        <p class="search-res-price montserrat">€{{ $product->new_amount_eur }}</p>
                    @else
                        <p class="search-res-price montserrat">€{{ $product->amount_eur }}</p>
                    @endif
                @else
                    @if($product->new_amount_rub)
                        <p class="search-res-price montserrat">₽{{ $product->new_amount_rub }}</p>
                    @else
                        <p class="search-res-price montserrat">₽{{ $product->amount_rub }}</p>
                    @endif
                @endif
            </div>
        </a>
    </div>

@endforeach

</div>
