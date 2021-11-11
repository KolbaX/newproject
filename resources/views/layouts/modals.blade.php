<!-- Modal contact us -->
<div class="modal fade" id="modal-contact-us" tabindex="-1" role="dialog" aria-labelledby="modal-contact-us" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('img/modal-close.svg') }}" alt="">
                </a>
            </div>
            <div class="modal-body">
                <div class="modal-contact-us-b">
                    <div class="modal-contact-us-b-l">
                        <h3 class="pt_sans">{{ __('index.modal_1') }}</h3>
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
                            <div class="th-slink-box">
                                <a href="mailto:{{ setting('site.email_contact') }}" class="me-b"><i class="fas fa-envelope"></i>Email</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-contact-us-b-r">
                        <form action="{{ route('contact.form') }}" method="POST">
                            @csrf
                            <h3 class="pt_sans">{{ __('index.modal_2') }}</h3>
                            <div class="cont-contact-select">
                                <div class="cst-choose">
                                    <div class="ind-choose"><span class="ssch">{{ __('index.modal_3') }} Skype</span><img src="{{ asset('img/dw_b.svg') }}" alt=""></div>
                                    <input type="hidden" name="methodData" value="" class="ind-inp-choose">
                                    <div class="drop-en-choose">
                                        <div class="clk_ch">Skype</div>
                                        <div class="clk_ch">Telegram</div>
                                        <div class="clk_ch">Discord</div>
                                    </div>
                                </div>
                            </div>
                            <div class="cont-contact-l">
                                <p class="pt_sans">Contact information</p>
                                <input type="text" placeholder="" name="login">
                            </div>
                            <div class="ac-ins-box ac-adinfo cont-contact-l">
                                <p class="pt_sans">{{ __('index.modal_4') }}</p>
                                <textarea placeholder="" name="description"></textarea>
                            </div>
                            <div class="cont-btns-forms">
                                <div class="btn-form-send">
                                    <button type="submit">{{ __('index.modal_5') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal cart -->
<div class="modal fade" id="modal-cart" tabindex="-1" role="dialog" aria-labelledby="modal-cart" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('img/modal-close.svg') }}" alt="">
                </a>
            </div>
            <div class="modal-body">
                <div class="modal-cart-b">
                    <h2>{{ __('index.modal_6') }}</h2>
                    <div class="cont-checkouts-box">
                        @foreach(\App\Models\Cart::where('user', $_COOKIE['user']??'none-user')->get() as $cart)
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
                                            <h2 class="cont-lp-price">${{ $cart->amount + $optionsAmount }}</h2>
                                        @elseif($_COOKIE['currency'] == 'EUR')
                                            <h2 class="cont-lp-price">€{{ $product->amount_eur + $optionsAmount }}</h2>
                                        @else
                                            <h2 class="cont-lp-price">₽{{ $product->amount_rub + $optionsAmount }}</h2>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="cont-btns-forms">
                        <div class="btn-winf-m">
                            <!-- <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close" class="pt_sans">{{ __('index.modal_7') }}</a> -->
                                <a href="{{ route('shop') }}?game={{ Cart::firstGameItem() }}" class="close btn-continue-shop-modal" class="pt_sans">{{ __('index.modal_7') }}</a>
                        </div>
                        <div class="btn-form-send">
                            <a href="{{ route('checkout') }}">{{ __('index.modal_8') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal cart empty -->
<div class="modal fade" id="modal-cart-empty" tabindex="-1" role="dialog" aria-labelledby="modal-cart-empty" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('img/modal-close.svg') }}" alt="">
                </a>
            </div>
            <div class="modal-body">
                <div class="modal-cart-b">
                    <h2>{{ __('index.modal_6') }}</h2>
                    <div class="modal-cart-e-b">
                        <h1>Your cart is empty</h1>
                    </div>
                    <div class="cont-btns-forms">
                        <div class="btn-winf-m">
                            <a href="{{ route('shop') }}" class="pt_sans">{{ __('index.modal_9') }}</a>
                        </div>
                        <div class="btn-form-send modal-check-lock">
                            <a href="javascript:;">{{ __('index.modal_8') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
