@foreach(\App\Models\Cart::where('user', $_COOKIE['user']??'user-none')->get() as $cart)
    @php $product = \App\Models\Product::find($cart->product_id); @endphp
    <div class="cont-checkout-item">
        <div class="cont-checkout-item-start">
            <div class="c-checkout-item-img">
                <img src="/storage/{{ $product->image }}" alt="">
            </div>
            <div class="c-checkout-item-title">
                <h3 class="pt_sans title_mmjk">{{ $product->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }} ({{ $cart->platform }})</h3>
            </div>
        </div>
        <div class="cont-checkout-item-end">
            <a href="{{ route('cart.delete', $cart) }}" class="c-checkout-item-trash">
                <div class="trash-box">
                    <img class="trash" src="{{ asset('img/modal-trash.svg') }}" alt="">
                </div>
            </a>
            <div class="cont-checkout-prices check-prices-m">
                <h3 class="cont-lp-old-price"></h3>
                @php
                    $challenge = json_decode($cart->challenge);
                    $optionsAmount = 0;
                    foreach ($challenge as $ch) {
                        $option = \App\Models\ProductOption::find((int)substr($ch, 6));
                        if(!isset($_COOKIE['currency']) OR $_COOKIE['currency'] == 'USD'){
                            $optionsAmount += $option->amount??0;
                        }elseif ($_COOKIE['currency'] == 'EUR')
                            $optionsAmount += $option->amount_eur;
                        else $optionsAmount += $option->amount_rub;
                    }
                @endphp
                @if(!isset($_COOKIE['currency']) OR $_COOKIE['currency'] == 'USD')
                    <h2 class="cont-lp-price">${{ $product->new_amount??$product->amount + $optionsAmount }}</h2>
                @elseif($_COOKIE['currency'] == 'EUR')
                    <h2 class="cont-lp-price">€{{ $product->new_amount_eur??$product->amount_eur + $optionsAmount }}</h2>
                @else
                    <h2 class="cont-lp-price">₽{{ $product->new_amount_rub??$product->amount_rub + $optionsAmount }}</h2>
                @endif

            </div>
        </div>
    </div>
@endforeach
