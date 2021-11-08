@extends('layouts.app', ['title' => 'Checkout'])

@section('content')

    <section class="main-bg-shop">
        <div class="cont-1194">
            <div class="bread-crumbs">
                <ul class="ul-ppm">
                    <li><a href="/" class="bread-crumb">{{ __('index.main_title') }}</a></li>
                    <li class="bread-crumb-arrow"><img src="{{ asset('img/b-arrow.svg') }}" alt=""></li>
                    <li><a href="#" class="bread-crumb b-crumb-a">{{ __('index.modal_8') }}</a></li>
                </ul>
            </div>
        </div>
    </section>


    <div class="cont-1194">
        <div class="cont-mc">
            <div class="cont-title-b">
                <h2>{{ __('index.modal_8') }}</h2>
            </div>
            <div class="cont-checkouts-box">
                @foreach(\App\Models\Cart::where('user', $_COOKIE['user']??0)->get() as $cart)
                    @php
                        $product = \App\Models\Product::find($cart->product_id);
                        $totalAmount = 0;

                        if(!isset($_COOKIE['currency']) OR $_COOKIE['currency'] == 'USD'){
                            if($product->new_amount)
                                $totalAmount += $product->new_amount;
                            else $totalAmount += $product->amount;
                        }elseif ($_COOKIE['currency'] == 'EUR'){
                            if($product->new_amount_eur)
                                $totalAmount += $product->new_amount_eur;
                            else $totalAmount += $product->amount_eur;
                        }else{
                            if($product->new_amount_rub)
                                $totalAmount += $product->new_amount_rub;
                            else $totalAmount += $product->amount_rub;
                        }

                        $challenge = json_decode($cart->challenge);

                        $optionsAmount = 0;
                        foreach ($challenge as $ch) {
                            $option = \App\Models\ProductOption::find((int)substr($ch, 6));
                            if(!isset($_COOKIE['currency']) OR $_COOKIE['currency'] == 'USD'){
                                $optionsAmount += $option->amount;
                            }elseif ($_COOKIE['currency'] == 'EUR')
                                $optionsAmount += $option->amount_eur;
                            else $optionsAmount += $option->amount_rub;
                        }

                        $totalAmount += $optionsAmount;
                    @endphp
                    <div class="cont-checkout-item">
                        <div class="cont-checkout-item-start">
                            <div class="c-checkout-item-img">
                                <img src="/storage/{{ $product->image }}" alt="{{ $product->title }}">
                            </div>
                            <div class="c-checkout-item-title">
                                <h5 class="pt_sans">{{ $product->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }} ({{ $cart->platform }})</h5>
                            </div>
                        </div>
                        <div class="cont-checkout-item-end">
                            <div class="cont-checkout-prices check-prices-m">
                                @php
                                    $challenge = json_decode($cart->challenge);
                                    $optionsAmountView = 0;
                                    foreach ($challenge as $ch) {
                                        $option = \App\Models\ProductOption::find((int)substr($ch, 6));
                                        if(!isset($_COOKIE['currency']) OR $_COOKIE['currency'] == 'USD'){
                                            $optionsAmountView += $option->amount;
                                        }elseif ($_COOKIE['currency'] == 'EUR')
                                            $optionsAmountView += $option->amount_eur;
                                        else $optionsAmountView += $option->amount_rub;
                                    }
                                @endphp
                                @if(!isset($_COOKIE['currency']) OR $_COOKIE['currency'] == 'USD')
                                    <h3 class="cont-lp-old-price"><span></span>@if($product->new_amount) ${{ $product->amount+$optionsAmountView }} @endif</h3>
                                    <h2 class="cont-lp-price">@if($product->new_amount) ${{ $product->new_amount+$optionsAmountView }} @else ${{ $product->amount+$optionsAmountView }} @endif</h2>
                                @elseif($_COOKIE['currency'] == 'EUR')
                                    <h3 class="cont-lp-old-price"><span></span>@if($product->new_amount_eur) €{{ $product->amount_eur+$optionsAmountView }} @endif</h3>
                                    <h2 class="cont-lp-price">@if($product->new_amount_eur) €{{ $product->new_amount_eur+$optionsAmountView }} @else €{{ $product->amount_eur+$optionsAmountView }} @endif</h2>
                                @else
                                    <h3 class="cont-lp-old-price"><span></span>@if($product->new_amount_rub) ₽{{ $product->amount_eur+$optionsAmountView }} @endif</h3>
                                    <h2 class="cont-lp-price">@if($product->new_amount_rub) ₽{{ $product->new_amount_rub+$optionsAmountView }} @else ₽{{ $product->amount_rub+$optionsAmountView }} @endif</h2>
                                @endif
                            </div>
                            <a href="{{ route('cart.delete', $cart) }}" class="c-checkout-item-trash">
                                <div class="trash-box">
                                    <img class="trash" src="{{ asset('img/trash.svg') }}" alt="">
                                    <img class="trash-h" src="{{ asset('img/trash-h.svg') }}" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

            <form action="{{ route('order') }}" method="POST" id="form-check">
                @csrf
                <div class="cont-contact-box">
                    <div class="cont-contact-l">
                        <h3 class="pt_sans">{{ __('index.how_contact') }}?</h3>
                        <p class="pt_sans cls_first_tf"><b>{{ __('index.contact_me') }}</b></p>
                        <div class="cont-contact-select">

                            <div class="cst-choose">
                                <div class="ind-choose cls_chs input-block-1"><span class="ssch">{{ __('index.contact_method') }}</span><img src="img/down.svg" alt=""></div>
                                <input type="hidden" name="contact_method" value="" class="ind-inp-choose input-method required-input">
                                <div class="drop-en-choose">
                                    <div class="clk_ch">Skype</div>
                                    <div class="clk_ch">Telegram</div>
                                    <div class="clk_ch">Discord</div>
                                </div>
                            </div>
                        </div>
                        <div class="pp_place ">
                            <input type="text" placeholder="Write a contact information" name="contact_data" class="contact-input required-input input-block-2">
                        </div>
                        <p class="pt_sans mt-24-in mrgt_40"><b>Email</b></p>
                        <input type="email" placeholder="" name="email" class="input-email required-input input-block-3" @if(Auth::check()) value="{{ Auth::user()->email }} @endif">
                    </div>
                    <div class="cont-contact-r">
                        @if(!isset($_COOKIE['currency']) OR $_COOKIE['currency'] == 'USD')
                            <p class="fw_800">{{ __('index.total') }}: <h1 class="mr-r-1">${{ $totalAmount??0 }}</h1></p>
                        @elseif($_COOKIE['currency'] == 'EUR')
                            <p class="fw_800">{{ __('index.total') }}: <h1 class="mr-r-1">€{{ $totalAmount??0 }}</h1></p>
                        @else
                            <p class="fw_800">{{ __('index.total') }}: <h1 class="mr-r-1">₽{{ $totalAmount??0 }}</h1></p>
                        @endif
                    </div>
                </div>
                <div class="cont-contact-disc">
                    <div class="cont-contact-l">
                        <p class="pt_sans dc-cod"><b>{{ __('index.discount') }}</b></p>
                        <div class="pp_place">
                            <input type="text" placeholder="I<3WEROTBOOST" name="promocode">
                        </div>
                    </div>
                </div>
                <div class="cont-payment-b">
                    <div class="cont-contact-l">
                        <h3 class="pt_sans">{{ __('index.payment_method') }}</h3>
                    </div>
                </div>

                <div class="cont-payment-mm nav nav-pills" id="pills-tab" role="tablist">
                    @foreach($payMethods as $payMethod)
                        <a class="cont-payment-ma-item option-pay-method" data-bs-toggle="pill" data-bs-target="#{{ str_replace(" ", '', $payMethod->title) }}" role="tab" aria-controls="{{ str_replace(" ", '', $payMethod->title) }}" aria-selected="false"  data-pay="{{ $payMethod->id }}">
                            <div class="cont-payment-m-item">
                                <img src="/storage/{{ $payMethod->logo }}" alt="">
                            </div>
                        </a>
                    @endforeach
                    <input type="hidden" class="payment-method" name="pay_method" value="">
                </div>
                <div class="cont-cart-boxes tab-content" id="pills-tabContent">
                    @foreach($payMethods as $pm)
                        <div class="tab-pane fade cart-box-brd" id="{{ str_replace(" ", '', $pm->title) }}" role="tabpanel" aria-labelledby="pills-home-tab">
                            <p>{!! $pm->description !!}</p>
                        </div>
                    @endforeach

                </div>
                <div class="cont-priv-polic">
                    <label class="checkbox-s-plat input-block-4">
                        <input type="checkbox" class="required-check required-check-1 required-input">
                        <p>{{ __('index.check_1') }}</p>
                    </label>
                    <label class="checkbox-s-plat input-block-5">
                        <input type="checkbox" class="required-check required-check-2 required-input" name="subscribe">
                        <p>{{ __('index.check_2') }}</p>
                    </label>
                </div>
                <div class="cont-prv-info">
                    <p>{{ __('index.info_check') }} </p>
                </div>
                <div class="cont-btn-proc-i ascsf">
                    <button type="submit" class="blockd btn-checkout cks_bbs">{{ __('index.process_info') }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
