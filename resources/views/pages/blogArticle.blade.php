@extends('layouts.master')
@section('meta')
  <meta property="og:image" content="{{ $news->img }}">
  <title>{{ $news -> __('name') }}</title>
  <meta property="og:title" content="{{ $news -> __('name') }}">
@endsection
@section('content')
    <section class="section with-margin" >
        <div class="container-my">
            <div class="section-content">
                <div class="section-header-container">
                    <div class="breadcrumps">
                      <a href="{{ route('getIndex') }}" class="breadcrump link">@lang('common.main_page')</a>
                        <a href="{{ route('getBlogPage') }}" class="breadcrump link">@lang('common.blog-plain')</a>
                        <p class="breadcrump">{{ $news->__('name') }}</p>
                    </div>
                </div>
                <div class="blog-page-section">
                    <div class="article-content">
                        <div class="article-header">
                            <div class="article-info">
                                <h1 class="name">{{ $news->__('name') }}</h1>
                                <div class="meta">
                                    <div class="meta-item">
                                        <img src="{{ asset('img/icons/calendar-grey.svg') }}" alt="Дата:" class="icon">
                                        <p class="text">{{ date("d.m.Y  H:i", strtotime( $news->created_at)) }}</p>
                                    </div>
                                    <div class="meta-item">
                                        <img src="{{ asset('img/icons/eye-grey.svg') }}" alt="Просмотров:" class="icon">
                                        <p class="text">{{ $news->views }}</p>
                                    </div>
                                    <div class="meta-item">
                                        <img src="{{ asset('img/icons/share-grey.svg') }}" alt="Поделились:" class="icon">
                                        <p class="text">{{ $news->shares }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="share-block">
                                <div class="share-content">
                                    <div class="ya-share2" id="share-block" data-curtain data-shape="round" data-color-scheme="blackwhite" data-limit="3" data-services="vkontakte,facebook,telegram,twitter,whatsapp"></div>
                                </div>
                            </div>
                        </div>
                        <div class="article-content__text-container">
                          {!! $news->__('content') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/blog-cards-slider.js') }}"></script>
    <script src="https://yastatic.net/share2/share.js"></script>
    <script>
      var share = document.getElementById('share-block');
      {{--var title = {{ $news->__('name') }};--}}
      {{--var img = {{ $news->img }};--}}
      Ya.share2( 'share-block', {
        // content: {
        //   url: 'https://yandex.com',
        //   title: title,
        //   image: img,
        // },
        hooks:{
          onshare: function (){
            updateShares({{ $news->id }})
          }
        }
      });
    </script>
@endpush

