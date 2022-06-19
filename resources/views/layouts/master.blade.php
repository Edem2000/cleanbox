<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">--}}

  <link rel="stylesheet" href="{{ asset('css/preload.css') }}">
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const preloader = document.getElementById("preloader");
      preloader.style.height = window.innerHeight + 'px';
    })
  </script>
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
  <script>
    Pace.on('done', function () {
      $('#preloader').fadeOut("slow");
      $('body, html').addClass('scrollable').removeClass('lock');
      @if(Route::currentRouteNamed('getIndex'))
      new WOW().init();
      carousel('CleanBox', "#mainscreen_brand");
      @elseif(Route::currentRouteNamed('getAbout'))
      new WOW().init();
      @endif
    });
    Pace.on('start',function () {

      $('body, html').removeClass('scrollable').addClass('lock');
      setTimeout(function () {
        Pace.stop();
      }, 30000)
    });
    //loader settings
    var paceCheck = setInterval(paceAttrGet, 30);
    function paceAttrGet() {
      var paceAttr = $('.pace-progress').attr('data-progress-text');
      $('#progress-bar').css('width', paceAttr);
      if ($('.pace').hasClass('pace-inactive')) {
        clearInterval(paceCheck);
      }
    }
  </script>
{{--  <script src="{{ asset('js/preload.js') }}"></script>--}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('fonts/montserrat/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/gilroy/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('owlcarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('owlcarousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/icons/favicon.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
  @yield('meta')
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="CleanBox">
  <meta property="og:url" content="https://cleanbox.uz/">
  <meta property="og:locale" content="ru_RU">
  <meta property="og:image:width" content="400">
  <meta property="og:image:height" content="400">
  <title>Cleanbox</title>
</head>

<body class="scrollable">
<section class="preloader" id="preloader">
  <div class="logo">
    <img src="{{asset('img/preloader/box-top.png')}}" alt="" class="box-top">
    <img src="{{asset('img/preloader/cat.png')}}" alt="" class="cat">
    <img src="{{asset('img/preloader/box-bottom.png')}}" alt="" class="box-bottom">
  </div>

  <div class="progress" id="progress-bar">
  </div>
  <input type="hidden" id="progress_width" value="0">
</section>

@include('partials.navbar')


<main class="main">
    @yield('content')
</main>

@include('partials.footer')
@include('partials.modals')

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>--}}

<script src="{{ asset('owlcarousel/dist/owl.carousel.min.js') }}"></script>
@stack('scripts')
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/carousels1.js') }}"></script>
</body>
</html>
