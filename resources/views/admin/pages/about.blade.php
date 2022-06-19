{{--@extends('layouts.admin')--}}

{{--@section('content')--}}
{{--  <section class="section with-margin" >--}}
{{--    <div class="section-container">--}}
{{--      <div class="product-page-card">--}}
{{--        <div class="section-name-container">--}}
{{--          <h2 class="section-name">Контакты:</h2>--}}
{{--        </div>--}}
{{--        @if(session('message'))--}}
{{--          <div class="message">--}}
{{--            <p class="text">{!! Session::get('message') !!}</p>--}}
{{--          </div>--}}
{{--        @endif--}}
{{--        <form  method="POST" action="{{ route('contacts.update') }}" >--}}
{{--          @csrf--}}

{{--          <div class="info">--}}
{{--            <div class="info-block">--}}
{{--              Добавить пункт истории:--}}
{{--              <div class="inputs-block">--}}
{{--                <label for="" class="label half-width">Год:--}}
{{--                  <input type="text" name="year" class="input" value=""  required>--}}
{{--                </label>--}}
{{--                <label for="" class="label half-width">Месяц:--}}
{{--                  <input type="text" name="month_id" class="input" value="{{ $contacts->telegram }}"  >--}}
{{--                </label>--}}
{{--              </div>--}}
{{--              <div class="inputs-block">--}}
{{--                <label for="" class="label half-width">Ссылка на страницу Instagram:--}}
{{--                  <input type="text" name="instagram" class="input" value="{{ $contacts->instagram }}"  >--}}
{{--                </label>--}}
{{--                <label for="" class="label half-width">Ссылка на страницу Facebook:--}}
{{--                  <input type="text" name="facebook" class="input" value="{{ $contacts->facebook }}"  >--}}
{{--                </label>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--          <button type="submit" class="submit">Сохранить</button>--}}
{{--        </form>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </section>--}}
{{--@endsection--}}
{{--@push('scripts')--}}


{{--@endpush--}}

@extends('layouts.admin')

@section('content')

  <section class="section with-margin">
    <div class="section-container">
      <div class="section-nav">
        <div class="btn-container">
          <a href="{{ route('about.create') }}" class="btn">Добавить пункт</a>
        </div>
      </div>
      @if(session('message'))
        <div class="message">
          <p class="text">{!! Session::get('message') !!}</p>
        </div>
      @endif
      <div class="product-cards-block">
        @foreach($years as $year)
          @if($year->months->first())
            <p class="about-year-title">
              {{ $year->year }}
            </p>
          @foreach($year->months->sortByDesc('month_id') as $month)
          <div class="product-card about-card">
{{--            <div class="img-container">--}}
{{--              <img src="{{ Storage::url($product->img) }}" alt="" class="img">--}}
{{--            </div>--}}
            <div class="info">
              <p class="name">{{ $month->month_ru }}</p>
            </div>
            <div class="info">
              <div class="description">{!! $month->content_ru !!} </div>
            </div>
            <div class="btns-block">
              @if($month->active === 1 )
                <a href="{{ route('about.disable', $month) }}" class="btn red">Отключить</a>
              @else
                <a href="{{ route('about.enable', $month) }}" class="btn green">Включить</a>
              @endif
              <a href="{{ route('about.edit', $month) }}" class="btn blue">Изменить</a>
            </div>
          </div>
          @endforeach
          @endif
        @endforeach
      </div>
    </div>
  </section>
@endsection
@push('scripts')
@endpush


