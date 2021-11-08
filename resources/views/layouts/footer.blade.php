<footer class="footer">
    <div class="footer__inner">
        <div class="footer__inner-cont widt_18">
            <div class="container__logos">
                <img class="footer__logo-s" src="{{ asset('img/logo_white.png') }}" alt="">
            </div>
            <img src="{{ asset('img/trust_p.png') }}" alt="" class="trustP"> <br>
            <img src="{{ asset('img/stars.svg') }}" alt="" class="starS">
        </div>
        <div class="footer__inner-cont widt_15">
            <h5 class="f-cont-title pt_sans">{{ __('index.title_link_information') }}</h5>
            <ul>
                @if(app()->getLocale() == 'en')
                    <li><a href="/volutpat-est-velit-egestas-3">Privacy Policy</a></li>
                    <li><a href="/volutpat-est-velit-egestas-6">Terms of Service</a></li>
                @else
                    <li><a href="/volutpat-est-velit-egestas-4">Privacy Policy</a></li>
                    <li><a href="/volutpat-est-velit-egestas-2">Terms of Service</a></li>
                @endif
                <li><a href="/refund-policy">Refund Policy</a></li>
                <li><a href="/join-our-team">Join our team</a></li>
            </ul>
        </div>
        <div class="footer__inner-cont widt_15 cls_dp">
            <h5 class="f-cont-title pt_sans">{{ __('index.contact_us') }}</h5>
            <ul>
                <li><a href="mailto:{{ setting('site.email_contact') }}">{{ setting('site.email_contact') }}</a></li>
                <li><a href="{{ setting('site.discord') }}" class="f-cont-d">
                        <img src="{{ asset('img/discord.svg') }}" alt="">
                        <span>Kolba#1000</span>
                    </a></li>
                <li><a href="{{ setting('site.skype') }}" class="f-cont-d">
                        <img src="{{ asset('img/skype.svg') }}" alt="">
                        <span>Ales Werot</span>
                    </a></li>
                <li><a href="{{ setting('site.instagram') }}" class="f-cont-d">
                        <img src="{{ asset('img/instagram.svg') }}" alt="">
                        <span>@werotboost</span>
                    </a></li>
            </ul>
        </div>
        <div class="footer__inner-cont widt_42">
            <div class="f-cont-gt">
                <h5 class="f-cont-title pt_sans">{{ __('index.title_link_newsletter') }}</h5>
                <a href="#top" class="footer__g-tt btn-anchor">
                    {{ __('index.title_link_go_top') }}
                    <i class="far fa-angle-up caret_top"></i>
                </a>
            </div>
            <p class="f-cont-text">
                {{ __('index.subscribe') }}
            </p>
            <form action="{{ route('subscribe') }}" method="POST" class="form-subscribe">
                <div class="footer__subscribe">

                    @csrf
                    <input type="email" name="email" id="subscribe-email" placeholder="Email">
                    <button type="submit" class="subscribe-btn" disabled>{{ __('index.subscribe_btn') }}</button>

                </div>
            </form>
        </div>
        <div class="footer__d-name">
            Design by: <b>Jhinubis</b>
        </div>
    </div>
</footer>
