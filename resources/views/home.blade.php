@extends('layouts.app')

@section('content')

    <section class="main-bg-shop">
        <div class="cont-1194">
            <div class="bread-crumbs">
                <ul  class="ul-ppm prf_pd">
                    <li><a href="/" class="bread-crumb">Main</a></li>
                    <li class="bread-crumb-arrow"><img src="{{ asset('img/b-arrow.svg') }}" alt=""></li>
                    <li><a href="#" class="bread-crumb b-crumb-a">Profile</a></li>
                </ul>
            </div>
        </div>
    </section>

    <div class="cont-1194">
        <div class="cont-profile-box">
            <div class="cont-profile-box-title">
                <h1>Profile</h1>
            </div>
            <div class="cont-profile-box-fp">
                <div class="cont-profile-box-l">
                    <div class="profile-b-item">
                        <div class="profile-img-c">
                            <img src="/storage/{{ Auth::user()->avatar }}" alt="">
                            <div class="pr-img-edit">
                                <img src="{{ asset('img/pr-img.svg') }}" alt="">
                            </div>
                            <form id="form-avatar" action="{{ route('update.avatar') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                                @csrf
                                <input type="file" id="avatar" name="avatar" accept="image/*">
                            </form>
                        </div>
                        <div class="profile-name-c">
                            <h5>{{ Auth::user()->name }}</h5>
                        </div>
                        <div class="profile-email-c mu-pd_f">
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="profile-b-item-l">
                        <div class="nav profile-h-link nav-pills" id="v-pills-tab" role="tablist" >
                            <a href="#" class="profile-link-h4 ckjjj active" id="v-pills-profile-tab"  data-bs-toggle="pill" role="tab" data-bs-target="#v-pills-profile" role="tab" aria-controls="v-pills-profile">Profile</a>
                            <a href="#" class="profile-link-h4 ckjjj lin-prof-link" id="v-pills-orders-tab"  data-bs-toggle="pill" role="tab" data-bs-target="#v-pills-orders" role="tab" aria-controls="v-pills-orders">My Orders</a>
                            <a href="javascript:;" class="profile-link-h4 ckjjj" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>

                <div class="cont-profile-box-r profile-b-item-r">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active my-prof_m" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="profile-item-title my-prof_m">
                                <h2>My Profile</h2>
                            </div>
                            <div class="profile-item-box-r">
                                <div class="profile-un-box">
                                    <h5 class="pt_sans">Username</h5>

                                    <form action="{{ route('update.name') }}" method="POST">
                                        @csrf
                                        <div class="profile-user-name">
                                            <div class="profile-un-static">
                                                <p>{{ Auth::user()->name }}</p>
                                            </div>
                                            <div class="profile-un-static un-static-none">
                                                <input type="text" value="{{ Auth::user()->name }}" name="name">
                                            </div>
                                            <div class="profile-a-btn">
                                                <a href="javascript:;" class="prof-btn_ed-sa">Edit</a>
                                            </div>
                                            <div class="profile-a-btn un-static-none">
                                                <button type="submit" class="prof-btn_ed-sa">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="profile-uemail-box">
                                    <h5 class="pt_sans">Email</h5>
                                    <div class="profile-user-email">
                                        <p>{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class="profile-newsletter-box">
                                    <h5 class="pt_sans">Newsletter Settings</h5>
                                    <div class="profile-user-name">
                                        <p>Status:
                                            <span class="newsletter_status @if(Auth::user()->news_latter == 1) newsletter_none @endif">Enabled</span>
                                            <span class="newsletter_status @if(Auth::user()->news_latter === 0) newsletter_none @endif">Disabled</span>
                                        </p>
                                        <div class="profile-a-btn">
                                            <a href="#" class="prof-btn_active @if(Auth::user()->news_latter === 0) newsletter_none @endif">Off</a>
                                        </div>
                                        <div class="profile-a-btn newsletter_btn_on @if(Auth::user()->news_latter == 1) newsletter_none @endif">
                                            <a href="#" class="prof-btn_active">On</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-ch-pass-box">
                                    <a href="{{ route('change.password') }}" class="bord-bottom">Change password</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
                            <div class="profile-item-title">
                                <h2>Orders</h2>
                            </div>
                            <div class="cont-checkouts-box fs20_profile">

                                <input type="hidden" class="page-number" value="0">

                                @foreach($productsIDs as $_product)
                                    @foreach($_product as $product)
                                        <div class="cont-checkout-item" style="display: none;">
                                            <div class="cont-checkout-item-start">
                                                <div class="c-checkout-item-img">
                                                    <img src="/storage/{{ $product->image }}" alt="">
                                                </div>
                                                <div class="c-checkout-item-title">
                                                    <h5 class="pt_sans">{{ $product->title }}</h5>
                                                </div>
                                            </div>
                                            <div class="cont-checkout-item-end">
                                                <div class="cont-checkout-prices">
                                                    <h3 class="cont-lp-price">${{ $product->amount }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach

                            </div>
                            <div class="pos-rel">
                                @if(count($productsIDs) > 3)
                                    <div class="section__t-sell" onclick="showPageMyOrder()">
                                        <div class="first_bb">
                                            <img src="{{ asset('img/down.svg') }}" class="">
                                        </div>
                                        <div class="ln_content lr_gnn">
                                            <p class="montserrat ln_tpc fw700">See more</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-sign" role="tabpanel" aria-labelledby="v-pills-sign-tab">7 8 9</div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        showPageMyOrder();
    </script>
@endsection
