@extends('layouts.master')

@section('content')
    <section class="section" id="start">
      <div id="particles-js" ></div>
        <div class="overlay"></div>
        <div class="container-my">
            <h2 class="brand wow fadeInDown" > <span id="mainscreen_brand"></span> <span class="input-cursor" id="input_cursor"></span></h2>
            <h1 class="header wow fadeInUp" data-wow-delay="200ms"> @lang('main_page.germs-killer') <br>@lang('main_page.disinfectant')</h1>
            <div class="comments">
                <p class="comment wow fadeInUp" data-wow-delay="400ms">@lang('main_page.modern')</p>
                <p class="divider wow fadeInUp" data-wow-delay="400ms">|</p>
                <p class="comment wow fadeInUp" data-wow-delay="600ms">@lang('main_page.advanced')</p>
                <p class="divider wow fadeInUp" data-wow-delay="600ms">|</p>
                <p class="comment wow fadeInUp" data-wow-delay="800ms">@lang('main_page.kills-99')</p>
            </div>
            <div class="btn-container wow fadeInUp" data-wow-delay="1000ms">
                <a href="{{ route('getCatalog') }}" class="btn">@lang('common.show-catalog')</a>
            </div>
        </div>
    </section>
    <section class="section" id="collection">
        <div class="container-my">
            <div class="collection">
                <div class="collection-header-container wow fadeInUp">
                    <h1 class="small-header">@lang('common.collection')</h1>
                    <h2 class="header">@lang('common.our-products')</h2>
                </div>
                <div class="cards-container">
                    <div class="cards" id="products-common-slider">
                        @foreach($products as $product)
                        @if($product->visible == 1)
                          <a href="{{ route('getProductPage', $product) }}" class="card-container wow fadeInLeft" data-wow-delay="{{$loop->index*200}}ms">
                              <div class="products-card">
                                  <div class="info">
                                      <p class="header">{{ $product->__('name') }}</p>
                                      <p class="price">{{ number_format($product->price, 0, '.', ',' ) }} @lang('common.currency')</p>
                                  </div>
                                  <div class="img-container">
                                      <img src="{{ Storage::url($product->img_doubled) }}" alt="" class="img">
                                  </div>
                                  <div class="bottom">
                                      <p class="link">@lang('common.more')  ></p>
                                  </div>
                              </div>
                          </a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="products-slider-section">
        <div class="container-my">
            <div class="slider-container">
                <div class="slider owl-carousel" id="products-slider">
                  @foreach($products as $product)
                      @if($product->visible == 1)
                        <div class="slide-container">
                        <div class="slide">
                            <h2 class="header">{{ $product->__('name') }}</h2>
                            <div class="text">
                              {!! $product->__('description')  !!}
                            </div>
                            <p class="price">{{ number_format($product->price, 0, '.', ',' ) }} @lang('common.currency')</p>
                            <div class="bottom">

                                <div class="btn-container">
                                    <a href="{{ route('getProductPage', $product) }}" class="btn">@lang('common.order-now')</a>
                                </div>
                                <div class="nav-block">
                                    <div class="products-nav prev">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0)">
                                                <path d="M4.52934 6.99676L10.6131 13.0805C10.8234 13.2909 10.8234 13.6319 10.6131 13.8423C10.4027 14.0526 10.0617 14.0526 9.85137 13.8423L3.38672 7.37764C3.17643 7.16728 3.17643 6.82625 3.38672 6.61589L9.85137 0.151248C10.0654 -0.0554441 10.4064 -0.0495094 10.6131 0.164506C10.8147 0.373281 10.8147 0.704247 10.6131 0.91299L4.52934 6.99676Z" fill="#747474" stroke="#747474" stroke-width="0.2"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0">
                                                    <rect width="14" height="14" fill="white" transform="matrix(1 8.74228e-08 8.74228e-08 -1 0 14)"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="products-nav next">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0)">
                                                <path d="M9.47066 7.00324L3.38689 0.91946C3.17657 0.709107 3.17657 0.368071 3.38689 0.157718C3.59727 -0.0525726 3.93828 -0.0525726 4.14863 0.157718L10.6133 6.62236C10.8236 6.83272 10.8236 7.17375 10.6133 7.38411L4.14863 13.8488C3.93462 14.0554 3.59358 14.0495 3.38689 13.8355C3.18528 13.6267 3.18528 13.2958 3.38689 13.087L9.47066 7.00324Z" fill="white" stroke="white" stroke-width="0.2"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0">
                                                    <rect width="14" height="14" fill="white" transform="matrix(-1 0 0 1 14 0)"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="img-container">
                                <img src="{{ Storage::url($product->img) }}" alt="" class="img">
                            </div>
                        </div>
                    </div>
                      @endif
                  @endforeach
                </div>
            </div>
        </div>
        <div class="lines-container">
            <img src="{{ asset('img/design/waves.svg') }}" alt="" class="lines">
        </div>
    </section>
    <section class="section" id="diplomas-section">
        <div class="container-my">
            <div class="diplomas">
                <div class="info-block">
                    <h1 class="header wow fadeInLeft">@lang('main_page.quality-sure')</h1>
{{--                    <p class="text">Несколько слов о том какие достижения есть, возможно число довольных клиентов</p>--}}
                    <ul class="list">
                        <li class="text wow fadeInLeft" data-wow-delay="200ms">@lang('main_page.quality-item-1')</li>
                        <li class="text wow fadeInLeft" data-wow-delay="400ms">@lang('main_page.quality-item-2')</li>
                        <li class="text wow fadeInLeft" data-wow-delay="600ms">@lang('main_page.quality-item-3')</li>
                        <li class="text wow fadeInLeft" data-wow-delay="800ms">@lang('main_page.quality-item-4')</li>
                    </ul>
                </div>
                <div class="slider-block wow fadeInRight" data-wow-delay="1000ms">
                    <div class="slider-container">
                        <div class="slider owl-carousel" id="diplomas-slider">
                          @foreach($diplomas as $diploma)
{{--                            <div class="slide">--}}
                                <img src="{{ Storage::url($diploma->img) }}" alt="" class="img">
{{--                            </div>--}}
                          @endforeach
                        </div>
                    </div>
                    <div class="bottom">
                        <a href="{{ route('getDiplomas') }}" class="btn" id="diplomas-btn">@lang('common.see-all')</a>
                        <div class="nav-block">
                            <div class="diplomas-nav prev">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                        <path d="M4.52934 6.99676L10.6131 13.0805C10.8234 13.2909 10.8234 13.6319 10.6131 13.8423C10.4027 14.0526 10.0617 14.0526 9.85137 13.8423L3.38672 7.37764C3.17643 7.16728 3.17643 6.82625 3.38672 6.61589L9.85137 0.151248C10.0654 -0.0554441 10.4064 -0.0495094 10.6131 0.164506C10.8147 0.373281 10.8147 0.704247 10.6131 0.91299L4.52934 6.99676Z" fill="#747474" stroke="#747474" stroke-width="0.2"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="14" height="14" fill="white" transform="matrix(1 8.74228e-08 8.74228e-08 -1 0 14)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="diplomas-nav next">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                        <path d="M9.47066 7.00324L3.38689 0.91946C3.17657 0.709107 3.17657 0.368071 3.38689 0.157718C3.59727 -0.0525726 3.93828 -0.0525726 4.14863 0.157718L10.6133 6.62236C10.8236 6.83272 10.8236 7.17375 10.6133 7.38411L4.14863 13.8488C3.93462 14.0554 3.59358 14.0495 3.38689 13.8355C3.18528 13.6267 3.18528 13.2958 3.38689 13.087L9.47066 7.00324Z" fill="white" stroke="white" stroke-width="0.2"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="14" height="14" fill="white" transform="matrix(-1 0 0 1 14 0)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="about-section">
        <div class="container-my">
            <div class="about">
                <h1 class="about-header wow fadeInUp">@lang('main_page.about-company')</h1>
                <div class="info-block">
                    <h1 class="header wow fadeInLeft" data-wow-delay="200ms">CleanBox.</h1>
                    <p class="text wow fadeInLeft" data-wow-delay="400ms">@lang('main_page.our-company')</p>
                    <p class="text wow fadeInLeft" data-wow-delay="600ms">@lang('main_page.working-principle')</p>
                </div>
                <div class="btn-container">

                  <a href="{{ route('getAbout') }}" class="btn">@lang('common.learn-more')</a>
                </div>
            </div>
        </div>
        <div class="filter-container">
            <img src="{{ asset('img/design/filter.webp') }}" alt="" class="filter wow fadeInRight" data-wow-delay="800ms">
            <p class="text wow fadeInRight" data-wow-delay="1000ms">@lang('main_page.nanocatalytic-filter')</p>
        </div>
    </section>
    <section class="section" id="how-to">
        <div class="container-my">
            <div class="how-to">
                <div class="photo-container wow fadeInLeft">
                    <img src="{{ asset('img/product.webp') }}" alt="" class="photo">
                    <img src="{{ asset('img/design/ellipse.svg') }}" alt="" class="ellipse">
                </div>
                <div class="info-block">
                    <h1 class="header wow fadeInRight" data-wow-delay="200ms">@lang('main_page.how-to-use')?</h1>
                    <p class="text wow fadeInRight" data-wow-delay="400ms">@lang('main_page.how-to-use-instruction')</p>
                    <div class="list">
                        <p class="list-item wow fadeInRight" data-wow-delay="600ms">@lang('main_page.how-to-use-item-1')</p>
                        <p class="list-item wow fadeInRight" data-wow-delay="800ms">@lang('main_page.how-to-use-item-2')</p>
                        <p class="list-item wow fadeInRight" data-wow-delay="1000ms">@lang('main_page.how-to-use-item-3')</p>
                        <p class="list-item wow fadeInRight" data-wow-delay="1200ms">@lang('main_page.how-to-use-item-4')</p>
                    </div>
                    <br>
                    <p class="text wow fadeInRight" data-wow-delay="1400ms">@lang('main_page.full-sterilization')!</p>
                    <div class="btn-container wow fadeInRight" data-wow-delay="1600ms">
                        <a href="{{ route('getCatalog') }}" class="btn">@lang('common.order-now')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="why-us-section">
        <div class="why-us">
            <div class="why-left">
                <div class="half-container-my left">
                    <div class="info-content">
                        <h1 class="info-header wow fadeInLeft">@lang('main_page.why-cleanbox')?</h1>
                        <div class="block wow fadeInLeft" data-wow-delay="200ms">
                            <p class="header">@lang('main_page.doesnt-harm')</p>
                            <p class="text">@lang('main_page.new-clean')</p>
                        </div>
                        <div class="block wow fadeInLeft" data-wow-delay="400ms">
                            <p class="header">@lang('main_page.no-chemicals')</p>
                            <p class="text">@lang('main_page.work-process')</p>
                        </div>
                        <div class="block wow fadeInLeft" data-wow-delay="600ms">
                            <p class="header">@lang('main_page.10-mins')</p>
                            <p class="text">@lang('main_page.10-mins-text')</p>
                        </div>
                        <div class="block wow fadeInLeft" data-wow-delay="800ms">
                            <p class="header">@lang('main_page.no-uv')</p>
                            <p class="text">@lang('main_page.no-uv-text')</p>
                        </div>
                        <div class="btn-container wow fadeInLeft" data-wow-delay="1000ms">
                            <a href="{{ route('getCatalog') }}" class="btn">@lang('common.order-now')</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="why-right">
                <div class="interior"></div>
                <div class="news-block">
                    <div class="header-container">
                        <h2 class="header">@lang('main_page.news')</h2>
                    </div>
                    <div class="content">
                        <div class="text">
                          @if($news_articles->last())
                          {!! $news_articles->last()->__('content') !!}
                            @endif
                        </div>
                      @if($news_articles->last())
                        <div class="btn-container">
                            <a href="{{ route('getBlogArticlePage', $news_articles->last()->id) }}" class="btn">
                              @lang('common.more')
                                <svg width="71" height="16" viewBox="0 0 71 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.8" d="M70.7071 8.70711C71.0976 8.31659 71.0976 7.68342 70.7071 7.2929L64.3431 0.928938C63.9526 0.538413 63.3195 0.538413 62.9289 0.928938C62.5384 1.31946 62.5384 1.95263 62.9289 2.34315L68.5858 8.00001L62.9289 13.6569C62.5384 14.0474 62.5384 14.6805 62.9289 15.0711C63.3195 15.4616 63.9526 15.4616 64.3431 15.0711L70.7071 8.70711ZM-8.74228e-08 9L70 9.00001L70 7.00001L8.74228e-08 7L-8.74228e-08 9Z" fill="white"/>
                                </svg>
                            </a>
                        </div>
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="advantages-section">
        <div class="container-my">
            <div class="advantages">
                <div class="figures-block">
                    <div class="circle one wow fadeInLeft" data-wow-delay="200ms">
                        <svg class="dashed">
                            <circle cx="50%" cy="50%" r="90px"></circle>
                        </svg>
                        <p class="number">4</p>
                        <p class="description">@lang('main_page.unique-products')</p>
                    </div>
                    <div class="circle two wow fadeInLeft">
                        <svg class="dashed">
                            <circle cx="50%" cy="50%" r="90px"></circle>
                        </svg>
                        <p class="number">352</p>
                        <p class="description">@lang('main_page.happy-clients')</p>
                    </div>
                    <div class="circle three wow fadeInLeft" data-wow-delay="400ms">
                        <svg class="dashed">
                            <circle cx="50%" cy="50%" r="90px"></circle>
                        </svg>
                        <p class="number">352</p>
                        <p class="description">@lang('main_page.happy-clients')</p>
                    </div>
                </div>
                <div class="info">
                    <h1 class="header wow fadeInRight" data-wow-delay="600ms">@lang('main_page.only-clean')!</h1>
                    <p class="text wow fadeInRight" data-wow-delay="800ms">@lang('main_page.special-tech')</p>
                    <p class="text wow fadeInRight" data-wow-delay="1000ms">@lang('main_page.100-clean')</p>
                    <div class="btn-container wow fadeInRight" data-wow-delay="1200ms">
                        <a href="{{ route('getCatalog') }}" class="btn">@lang('common.show-catalog')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="blog-section">
        <div class="container-my">
            <div class="blog">
                <h1 class="blog-header wow fadeInUp">@lang('main_page.follow-news')</h1>
                <div class="blog-cards owl-carousel" id="blog-slider">
                  @foreach($news_articles as $news)
                    <div class="blog-card wow fadeInLeft" data-wow-delay="{{$loop->index*200}}ms">
                        <p class="header">{{ $news->__('name') }}</p>
                        <div class="card-description">
                            {!! $news->__('content') !!}
                        </div>
                        <div class="bottom">
                            <p class="date">{{ date("d.m.Y", strtotime( $news->created_at)) }}</p>
                            <a href="{{ route('getBlogArticlePage', $news->id) }}" class="link">@lang('common.more') >></a>
                        </div>
                    </div>
                  @endforeach
                </div>
                <div class="btn-container">
                    <a href="{{ route('getBlogPage') }}" class="btn">@lang('common.all-news')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="form-section">
        <div class="container-my" >
            <div class="form-container">
                <h1 class="form-header">@lang('main_page.contact-us')</h1>
                <p class="form-description">@lang('main_page.contact-us-text')</p>
                <form method="post" action="" class="form" id="apply">
                  @csrf
                    <div class="row">
                        <div class="input-container">
                            <input type="text" class="input" name="name" placeholder="@lang('common.form-name')">
                        </div>
                        <div class="input-container">
                            <input type="email" class="input" name="email" placeholder="E-mail">
                        </div>
                        <div class="input-container">
                            <input type="tel" class="input" name="phone" id="phone" placeholder="@lang('common.form-phone')">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-container">
                            <textarea class="input" name="message" placeholder="@lang('common.form-message')"></textarea>
                        </div>
                    </div>
                    <div class="btn-container">
                        <button class="submit">
                            Отправить
                            <svg width="42" height="8" viewBox="0 0 42 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M41.3536 4.35355C41.5488 4.15829 41.5488 3.84171 41.3536 3.64645L38.1716 0.464466C37.9763 0.269204 37.6597 0.269204 37.4645 0.464466C37.2692 0.659728 37.2692 0.976311 37.4645 1.17157L40.2929 4L37.4645 6.82843C37.2692 7.02369 37.2692 7.34027 37.4645 7.53553C37.6597 7.7308 37.9763 7.7308 38.1716 7.53553L41.3536 4.35355ZM0 4.5H41V3.5H0V4.5Z" fill="white"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
  <script src="{{ asset('js/form-validation.js') }}"></script>
  <script src="{{ asset('js/particles.min.js') }}"></script>
  <script >
    particlesJS("particles-js", {"particles":{"number":{"value":100,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":5,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"grab"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});var count_particles, stats, update; stats = new Stats; stats.setMode(0); stats.domElement.style.position = 'absolute'; stats.domElement.style.left = '0px'; stats.domElement.style.top = '0px'; document.body.appendChild(stats.domElement); count_particles = document.querySelector('.js-count-particles'); update = function() { stats.begin(); stats.end(); if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) { count_particles.innerText = window.pJSDom[0].pJS.particles.array.length; } requestAnimationFrame(update); }; requestAnimationFrame(update);
  </script>
  <script src="{{ asset('js/wow.min.js') }}"></script>
{{--  <script>--}}
{{--    new WOW().init();--}}
{{--  </script>--}}
@endpush
