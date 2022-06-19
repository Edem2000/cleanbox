@extends('layouts.master')

@section('content')
    <section class="section with-margin" >
        <div class="container-my">
            <div class="section-content">
                <div class="section-header-container">
                    <div class="breadcrumps">
                        <a href="{{ route('getIndex') }}" class="breadcrump link">@lang('common.main_page')</a>
                        <p class="breadcrump">@lang('common.blog-plain')</p>
                    </div>
                </div>
                <div class="blog-page-section">
                    <div class="blog-nav">
                        <button class="blog-nav__item active" id="news" >@lang('common.last-news')</button>
                        <button class="blog-nav__item" id="press">@lang('common.in-press')</button>
                    </div>
                    <div class="slider-container active" id="blog-cards-slider-container">
                        <div class="news-posts blog-cards slider owl-carousel " id="blog-cards-slider">
                          <?php $i=0?>
                          @foreach($news_articles as $news)
                            @if($news->active != 1)
                              @continue
                            @else

                              <div class="blog-card-container" data-slide-index="{{ $i }}">
                                <a href="{{ route('getBlogArticlePage', $news) }}" class="blog-card">
                                  <div class="img-container">
                                    <img src="{{ Storage::url($news->img) }}" alt="" class="img">
                                  </div>
                                  <div class="card-info">
                                    <p class="name">{{ $news->__('name') }}</p>
                                    <div class="meta">
                                      <div class="meta-item">
                                        <img src="{{ asset('img/icons/calendar.svg') }}" alt="Date:" class="icon">
                                        <p class="text">{{ date("d.m.Y  H:i", strtotime( $news->created_at)) }}</p>
                                      </div>
                                      <div class="meta-item">
                                        <img src="{{ asset('img/icons/eye.svg') }}" alt="Views:" class="icon">
                                        <p class="text">{{ $news->views }}</p>
                                      </div>
                                    </div>
                                  </div>
                                </a>
                              </div>
                              <?php $i++?>
                            @endif
                          @endforeach
                        </div>
                    </div>
                    <div class="slider-container" id="press-cards-slider-container">
                        <div class="press-posts blog-cards slider owl-carousel" id="press-cards-slider">
                          <?php $k=0?>
                          @foreach($press_articles as $press)
                            @if($press->active != 1)
                              @continue
                            @else
                            <div class="blog-card-container" data-slide-index="{{ $k }}">
                                <a href="{{ $press->link }}" target="_blank" class="blog-card">
                                    <div class="img-container">
                                        <img src="{{ Storage::url($press->img) }}" alt="" class="img">
                                    </div>
                                    <div class="card-info">
                                        <p class="name">{{ $press->__('name') }}</p>
                                        <div class="meta">
                                            <div class="meta-item">
                                                <img src="{{ asset('img/icons/calendar.svg') }}" alt="Date:" class="icon">
                                                <p class="text">{{ date("d.m.Y  H:i", strtotime( $press->created_at)) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                              <?php $k++?>
                            @endif
                          @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/blog-cards-slider.js') }}"></script>
@endpush

