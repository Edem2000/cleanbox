
<header class="@if(!Route::currentRouteNamed('getIndex')) white @endif" >
    <!--        <div class="mobile-menu-container">-->
    <!--        </div>-->
    <div class="mobile-menu">
        <div class="header-container">
            <p class="header">cleanbox</p>
        </div>
        <div class="menu-container">
            <a href="/#start" class="menu-item">@lang('common.main_page')</a>
            <a href="@if(Route::currentRouteNamed('getIndex')) /#about-section @else {{ route('getAbout') }} @endif" class="menu-item">@lang('common.about')</a>
            <a href="{{ route('getCatalog') }}" class="menu-item">@lang('common.catalog')</a>
            <a href="/#advantages-section" class="menu-item">@lang('common.advantages')</a>
            <a href="/#how-to" class="menu-item">@lang('common.how-to-use')</a>
            <a href="{{ route('getBlogPage') }}" class="menu-item">@lang('common.blog')</a>
            <a href="/#form-section" class="menu-item">@lang('common.contact-us')</a>
        </div>
    </div>
    <div class="container-my">
        <div class="header">
            <div class="center">
                <div class="top">
                    <h1 class="brand">CleanBox</h1>
                    <div class="btns-block">
                        <div class="lang-block">
                            <a href="{{ route('locale', 'ru') }}" class="lang @if(App::getLocale() == 'ru' || !App::getLocale()) active @endif">RU</a>
                            <p class="divider">/</p>
                            <a href="{{ route('locale', 'en') }}" class="lang @if(App::getLocale() == 'en') active @endif">EN</a>
                            <p class="divider">/</p>
                            <a href="{{ route('locale', 'uz') }}" class="lang @if(App::getLocale() == 'uz') active @endif">UZ</a>
                        </div>
                        <a href="{{ route('getCart') }}" class="cart-btn">
                            <svg width="25" height="25" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon">
                                <g filter="url(#filter0_d)">
                                    <path class="path" d="M20.8155 15.6682L19.8777 4.97644C19.8193 4.28762 19.1754 3.74801 18.4119
                                3.74801H16.5595V3.67268C16.5595 1.64755 14.7385 0 12.5002 0C10.2619 0 8.44092 1.64755
                                8.44092 3.67268V3.74801H6.58857C5.82498 3.74801 5.18108 4.28758 5.12284 4.97499L4.18473
                                15.6697C4.11213 16.526 4.44046 17.3785 5.08547 18.0085C5.73048 18.6386 6.64484 19 7.59407
                                19H17.4063C18.3555 19 19.2699 18.6386 19.9149 18.0085C20.5599 17.3785 20.8882 16.526
                                20.8155 15.6682ZM9.67098 3.67268C9.67098 2.26122 10.9402 1.11291 12.5002 1.11291C14.0602
                                1.11291 15.3294 2.26126 15.3294 3.67268V3.74801H9.67098V3.67268ZM19.0124 17.2523C18.5934
                                17.6616 18.023 17.8871 17.4063 17.8871H7.59411C6.9774 17.8871 6.40704 17.6616 5.98794
                                17.2523C5.56888 16.843 5.36405 16.3111 5.41114 15.7563L6.34916 5.06153C6.35868 4.94902
                                6.46384 4.86092 6.58857 4.86092H8.44092V6.23155C8.44092 6.53886 8.7163 6.78801 9.05595
                                6.78801C9.3956 6.78801 9.67098 6.53886 9.67098 6.23155V4.86092H15.3294V6.23155C15.3294
                                6.53886 15.6048 6.78801 15.9444 6.78801C16.2841 6.78801 16.5595 6.53886 16.5595
                                6.23155V4.86092H18.4119C18.5365 4.86092 18.6417 4.94905 18.6514 5.06302L19.5892
                                15.7548C19.6364 16.3111 19.4315 16.8429 19.0124 17.2523Z" fill="white"/>
                                </g>
                                <defs>
                                    <filter id="filter0_d" x="-2" y="0" width="29" height="27" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                                        <feOffset dy="4"/>
                                        <feGaussianBlur stdDeviation="2"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                                    </filter>
                                </defs>
                            </svg>
                            @if(!Cart::session(session_id())->isEmpty())
                                <div class="quantity">
                                    <p class="text">{{ Cart::session(session_id())->getContent()->count() }}</p>
                                </div>
                            @endif
                        </a>
                        <div class="burger-btn-container">
                            <div class="burger-btn">
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom">
                    <nav class="nav">
                        <a href="/#start" class="nav-item">@lang('common.main_page')</a>
                        <a href="@if(Route::currentRouteNamed('getIndex')) /#about-section @else {{ route('getAbout') }} @endif" class="nav-item @if(Route::currentRouteNamed('getAbout')) active @endif">@lang('common.about')</a>
                        <a href="/#advantages-section" class="nav-item">@lang('common.advantages')</a>
                        <a href="/#how-to" class="nav-item">@lang('common.how-to-use')</a>
                        <a href="/#form-section" class="nav-item">@lang('common.contact-us')</a>
                    </nav>
                </div>
            </div>
            <!--            <a href="index.html" class="logo-container" >-->
            <!--                <img src="img/icons/logo.webp" alt="" class="logo">-->
            <!--            </a>-->
            <!--            <div class="social-block">-->
            <!--                <a href="" class="social-item" aria-label="Facebook">-->
            <!--                    <img src="img/icons/facebook.svg" alt="" class="icon">-->
            <!--                </a>-->
            <!--                <a href="" class="social-item" aria-label="Instagram">-->
            <!--                    <img src="img/icons/instagram.svg" alt="" class="icon">-->
            <!--                </a>-->
            <!--            </div>-->
        </div>
    </div>
</header>
