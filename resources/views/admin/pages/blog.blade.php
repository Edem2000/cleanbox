@extends('layouts.admin')

@section('content')
    <section class="section with-margin" >
        <div class="section-container">
                <div class="section-nav">
                  <div class="blog-nav">
                    <button class="blog-nav__item active" id="news" >Последние новости</button>
                    <button class="blog-nav__item " id="press">Мы в прессе</button>
                  </div>
                  <div class="btn-container">
                    <a href="{{ route('news.create') }}" class="btn" id="create_news">Добавить статью</a>
                    <a href="{{ route('press.create') }}" class="btn hidden" id="create_press">Добавить статью</a>
                  </div>
                </div>
                @if(session('message'))
                  <div class="message">
                    <p class="text">{!! Session::get('message') !!}</p>
                  </div>
                @endif
                <div class="blog-page-section">
                    <div class="slider-container active" id="blog-cards-slider-container">
                        <div class="news-posts blog-cards slider owl-carousel " id="blog-cards-slider">
                          @foreach($news_articles as $news)
                              <div class="blog-card-container" data-slide-index="{{ $loop->iteration - 1 }}">
                                <div class="blog-card">
                                    <div class="img-container">
                                        <img src="{{ Storage::url($news->img) }}" alt="" class="img">
                                    </div>
                                    <div class="card-info">
                                        <p class="name">{{ $news->__('name') }}</p>
                                        <div class="meta">
                                            <div class="meta-item">
                                                <img src="{{ asset('img/icons/calendar.svg') }}" alt="Date:" class="icon">
                                                <p class="text">{{ date("d-m-Y H:i", strtotime( $news->created_at)) }}</p>
                                            </div>
                                            <div class="meta-item">
                                                <img src="{{ asset('img/icons/eye.svg') }}" alt="Views:" class="icon">
                                                <p class="text">{{ $news->views }}</p>
                                            </div>
                                        </div>
                                      <div class="card-buttons">
                                        <a href="{{ route('news.edit', $news) }}" class="btn blue">Редактировать</a>
                                        @if($news->active === 1 )
                                          <a href="{{ route('disableNews', $news) }}" class="btn grey">Скрыть</a>
                                        @else
                                          <a href="{{ route('enableNews', $news) }}" class="btn green">Показать</a>
                                        @endif
                                        <button class="btn red delete" data-article-id="{{ $news->id }}">
                                          <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.5938 1.75H9.1875V1.3125C9.1875 0.588793 8.59871 0 7.875 0H6.125C5.40129 0 4.8125 0.588793 4.8125 1.3125V1.75H2.40625C1.80316 1.75 1.3125 2.24066 1.3125 2.84375V4.375C1.3125 4.61661 1.50839 4.8125 1.75 4.8125H1.98909L2.36707 12.7499C2.40045 13.4509 2.97631 14 3.67806 14H10.3219C11.0237 14 11.5996 13.4509 11.6329 12.7499L12.0109 4.8125H12.25C12.4916 4.8125 12.6875 4.61661 12.6875 4.375V2.84375C12.6875 2.24066 12.1968 1.75 11.5938 1.75ZM5.6875 1.3125C5.6875 1.07127 5.88377 0.875 6.125 0.875H7.875C8.11623 0.875 8.3125 1.07127 8.3125 1.3125V1.75H5.6875V1.3125ZM2.1875 2.84375C2.1875 2.72314 2.28564 2.625 2.40625 2.625H11.5938C11.7144 2.625 11.8125 2.72314 11.8125 2.84375V3.9375C11.6777 3.9375 2.74621 3.9375 2.1875 3.9375V2.84375ZM10.7589 12.7083C10.7478 12.942 10.5558 13.125 10.3219 13.125H3.67806C3.44414 13.125 3.25218 12.942 3.24108 12.7083L2.86508 4.8125H11.1349L10.7589 12.7083Z" fill="white"/>
                                            <path d="M7 12.25C7.24161 12.25 7.4375 12.0541 7.4375 11.8125V6.125C7.4375 5.88339 7.24161 5.6875 7 5.6875C6.75839 5.6875 6.5625 5.88339 6.5625 6.125V11.8125C6.5625 12.0541 6.75836 12.25 7 12.25Z" fill="white"/>
                                            <path d="M9.1875 12.25C9.42911 12.25 9.625 12.0541 9.625 11.8125V6.125C9.625 5.88339 9.42911 5.6875 9.1875 5.6875C8.94589 5.6875 8.75 5.88339 8.75 6.125V11.8125C8.75 12.0541 8.94586 12.25 9.1875 12.25Z" fill="white"/>
                                            <path d="M4.8125 12.25C5.05411 12.25 5.25 12.0541 5.25 11.8125V6.125C5.25 5.88339 5.05411 5.6875 4.8125 5.6875C4.57089 5.6875 4.375 5.88339 4.375 6.125V11.8125C4.375 12.0541 4.57086 12.25 4.8125 12.25Z" fill="white"/>
                                          </svg>
                                        </button>
                                      </div>
                                    </div>
                                </div>
                            </div>
                          @endforeach
                        </div>
                    </div>
                    <div class="slider-container" id="press-cards-slider-container">
                        <div class="press-posts blog-cards slider owl-carousel" id="press-cards-slider">
                          @foreach($press_articles as $press)
                            <div class="blog-card-container" data-slide-index="{{ $loop->iteration - 1 }}">
                                <div class="blog-card">
                                    <div class="img-container">
                                        <img src="{{ Storage::url($press->img) }}" alt="" class="img">
                                    </div>
                                    <div class="card-info">
                                        <p class="name">{{ $press->__('name') }}</p>
                                        <div class="meta">
                                            <div class="meta-item">
                                                <img src="{{ asset('img/icons/calendar.svg') }}" alt="Date:" class="icon">
                                                <p class="text">{{ date("d-m-Y H:i:s", strtotime( $press->created_at)) }}</p>
                                            </div>
                                        </div>
                                        <div class="card-buttons">
                                        <a href="{{ route('press.edit', $press) }}" class="btn blue">Редактировать</a>
                                        @if($press->active === 1 )
                                          <a href="{{ route('disablePress', $press) }}" class="btn grey">Скрыть</a>
                                        @else
                                          <a href="{{ route('enablePress', $press) }}" class="btn green">Показать</a>
                                        @endif
                                        <button class="btn red delete" data-article-id="{{ $press->id }}">
                                          <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.5938 1.75H9.1875V1.3125C9.1875 0.588793 8.59871 0 7.875 0H6.125C5.40129 0 4.8125 0.588793 4.8125 1.3125V1.75H2.40625C1.80316 1.75 1.3125 2.24066 1.3125 2.84375V4.375C1.3125 4.61661 1.50839 4.8125 1.75 4.8125H1.98909L2.36707 12.7499C2.40045 13.4509 2.97631 14 3.67806 14H10.3219C11.0237 14 11.5996 13.4509 11.6329 12.7499L12.0109 4.8125H12.25C12.4916 4.8125 12.6875 4.61661 12.6875 4.375V2.84375C12.6875 2.24066 12.1968 1.75 11.5938 1.75ZM5.6875 1.3125C5.6875 1.07127 5.88377 0.875 6.125 0.875H7.875C8.11623 0.875 8.3125 1.07127 8.3125 1.3125V1.75H5.6875V1.3125ZM2.1875 2.84375C2.1875 2.72314 2.28564 2.625 2.40625 2.625H11.5938C11.7144 2.625 11.8125 2.72314 11.8125 2.84375V3.9375C11.6777 3.9375 2.74621 3.9375 2.1875 3.9375V2.84375ZM10.7589 12.7083C10.7478 12.942 10.5558 13.125 10.3219 13.125H3.67806C3.44414 13.125 3.25218 12.942 3.24108 12.7083L2.86508 4.8125H11.1349L10.7589 12.7083Z" fill="white"/>
                                            <path d="M7 12.25C7.24161 12.25 7.4375 12.0541 7.4375 11.8125V6.125C7.4375 5.88339 7.24161 5.6875 7 5.6875C6.75839 5.6875 6.5625 5.88339 6.5625 6.125V11.8125C6.5625 12.0541 6.75836 12.25 7 12.25Z" fill="white"/>
                                            <path d="M9.1875 12.25C9.42911 12.25 9.625 12.0541 9.625 11.8125V6.125C9.625 5.88339 9.42911 5.6875 9.1875 5.6875C8.94589 5.6875 8.75 5.88339 8.75 6.125V11.8125C8.75 12.0541 8.94586 12.25 9.1875 12.25Z" fill="white"/>
                                            <path d="M4.8125 12.25C5.05411 12.25 5.25 12.0541 5.25 11.8125V6.125C5.25 5.88339 5.05411 5.6875 4.8125 5.6875C4.57089 5.6875 4.375 5.88339 4.375 6.125V11.8125C4.375 12.0541 4.57086 12.25 4.8125 12.25Z" fill="white"/>
                                          </svg>
                                        </button>
                                      </div>
                                    </div>
                                </div>
                            </div>
                          @endforeach
                        </div>
                    </div>
                </div>
        </div>
    </section>
  <div class="custom-modal-overlay">
    <div class="custom-modal">
      <p class="heading">Вы действительно хотите удалить статью?</p>
      <form method="POST" action="{{ route('news.destroy', 1) }}" class="buttons-block " id="admin_news_delete">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn red" id="yes">Да</button>
        <div class="btn blue" id="close">Нет</div>
      </form>
      <form method="POST" action="{{ route('press.destroy', 1) }}" class="buttons-block hidden" id="admin_press_delete">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn red" id="yes">Да</button>
        <div class="btn blue" id="close">Нет</div>
      </form>
    </div>
  </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('owlcarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('owlcarousel/dist/assets/owl.theme.default.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('owlcarousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/blog-cards-slider.js') }}"></script>
@endpush

