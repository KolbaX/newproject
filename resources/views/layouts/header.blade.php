<header class="header" id="top">
    <div class="header-mp">
        <div class="container">
            <div class="header__inner">
                <div class="header__left">
                    <div class="header__logo">
                        <a href="/" class="logo_a">
                            <img src="{{ asset('img/logo_m.svg') }}" alt="">
                        </a>
                    </div>

                    <div class="header__search">
                        <form action="/shop">
                            <img src="{{ asset('img/search-ico.svg') }}" alt="">
                            <input class="input-search search-input" type="text" placeholder="{{ __('index.search') }}" name="q" autocomplete="off">
                            <div class="search-res-bl">
                                <div class="search-res-bl-title pt_sans">
                                    Products
                                </div>
                                <div id="result-item-search">

                                </div>
                                <div class="search-res-bl-btn">
                                    <a href="{{ route('shop') }}" class="search-view-btn montserrat">View all products</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <nav class="header__menu header__link">
                    <ul>
                        <li><a href="{{ Request::is('/') ? '#game-list' : '/#game-list' }}" class="{{ Request::is('/') ? 'btn-anchor' : '' }}">{{ __('index.shop') }}</a></li>
                        <li class="hl-cu"><a href="#" id="contact-us" data-bs-toggle="modal" data-bs-target="#modal-contact-us">{{ __('index.contact_us') }}</a></li>
                        <li class="cart-bl">
                            @php $cartCount = \App\Models\Cart::where('user', $_COOKIE['user']??'user-none')->count(); @endphp
                            <a href="#" id="cart" data-bs-toggle="modal" @if($cartCount > 0) data-bs-target="#modal-cart" @else data-bs-target="#modal-cart-empty" @endif>
                                <span>{{ __('index.cart') }}

                                    @if($cartCount > 0)
                                        <div class="count-cart montserrat">{{ $cartCount }}</div>
                                    @endif
                                </span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="header__right">
                    <div class="header__prices">
                        <span class="prices_in">{{ __('index.prices_header') }}: </span>
                        <div class="select_n">
                            <div class="cst-select">
                                <div class="ind-sel"><span class="sssc">@isset($_COOKIE['currency']) {{ $_COOKIE['currency'] }} @else USD @endif</span> <img src="{{ asset('img/down.svg') }}" alt=""></div>
                                <!-- <input type="hidden" name="" value="USD" class="ind-inp"> -->
                                <div class="drop-sel">
                                    <div class="clk_d" onclick="setCurrency('RUB');"><b>RUB</b></div>
                                    <div class="clk_d" onclick="setCurrency('EUR');"><b>EUR</b></div>
                                    <div class="clk_d" onclick="setCurrency('USD');"><b>USD</b></div>
                                </div>
                            </div>
                        </div>
                        <div class="select_n">
                            <div class="cst-select">
                                <div class="ind-sel"><span class="sssc">{{ app()->getLocale() }}</span> <img src="{{ asset('img/down.svg') }}" alt=""></div>
                                <!-- <input type="hidden" name="" value="USD" class="ind-inp"> -->
                                <div class="drop-sel">
                                    <div class="clk_d" onclick="location = '/change/locale/ru'"><b>RU</b></div>
                                    <div class="clk_d" onclick="location = '/change/locale/en'"><b>EN</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @if(Auth::guest())
                        <div class="header__sign-in header__link">
                            <a href="{{ route('login') }}">{{ __('index.sign_id') }}</a>
                        </div>
                    @else
                        <div class="header__sign-in header__link">
                            <div class="header__profile-n-img">
                                <a href="{{ route('home') }}">
                                    <div class="u-n-img-profile">
                                        <p class="fw600 montserrat">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div class="profile-img-cc">
                                        <img src="/storage/{{ Auth::user()->avatar }}" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="header__mobile">
                <div class="header__left">
                    <div class="header__logo">
                        <a href="/" class="logo_a">
                            <img src="{{ asset('img/logo_m.svg') }}" alt="">
                        </a>
                    </div>
                    <div class="header__search">
                        <form action="/shop">
                            <img src="{{ asset('img/search-ico.svg') }}" alt="">
                            <input type="text" placeholder="{{ __('index.search') }}" name="q">
                        </form>
                    </div>
                </div>

                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="line_n line_n1"></span>
                    <span class="line_n line_n2"></span>
                    <span class="line_n line_n3"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMenu">
                    <div class="mob-cont">
                        <nav class="header__menu header__link">
                            <ul>
                                <li><a href="{{ route('shop') }}">{{ __('index.shop') }}</a></li>
                                <li class="hl-cu"><a href="#" id="contact-us-mobile" data-bs-toggle="modal" data-bs-target="#modal-contact-us">{{ __('index.contact_us') }}</a></li>
                                <li><a href="#" id="cart" data-bs-toggle="modal" data-bs-target="#modal-cart">{{ __('index.cart') }}</a></li>
                            </ul>
                        </nav>
                        <div class="header__right">
                            <div class="header__prices">
                                <span>{{ __('index.prices_header') }}: </span>
                                <div class="select_n">
                                    <div class="cst-select">
                                        <div class="ind-sel">USD <img src="{{ asset('img/down.svg') }}" alt=""></div>
                                        <!-- <input type="hidden" name="" value="USD" class="ind-inp"> -->
                                        <div class="drop-sel">
                                            <div class="clk_d" onclick="setCurrency('RUB');"><b>RUB</b></div>
                                            <div class="clk_d" onclick="setCurrency('EUR');"><b>EUR</b></div>
                                            <div class="clk_d" onclick="setCurrency('USD');"><b>USD</b></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="select_n">
                                    <div class="cst-select">
                                        <div class="indem-sel">{{ app()->getLocale() }} <img src="{{ asset('img/down.svg') }}" alt=""></div>
                                        <!-- <input type="hidden" name="" value="USD" class="ind-inp"> -->
                                        <div class="drop-en-sel">
                                            <div class="clk_r" onclick="location = '/change/locale/ru'"><b>RU</b></div>
                                            <div class="clk_r" onclick="location = '/change/locale/en'"><b>EN</b></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if(Auth::guest())
                                <div class="header__sign-in header__link">
                                    <a href="{{ route('login') }}">{{ __('index.sign_id') }}</a>
                                </div>
                            @else
                                <div class="header__sign-in header__link">
                                    <div class="header__profile-n-img">
                                        <a href="{{ route('home') }}">
                                            <div class="u-n-img-profile">
                                                <p class="fw600 montserrat">{{ Auth::user()->name }}</p>
                                            </div>
                                            <div class="profile-img-cc">
                                                <img src="/storage/{{ Auth::user()->avatar }}" alt="">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



<div class="successfully-subscribed montserrat" style="display: none;">
    <p class="succes-subscr-title montserrat fw_800">You successfully subscribed</p>
    <p class="succes-subscr-text pt_sans">Thank you!</p>
</div>
