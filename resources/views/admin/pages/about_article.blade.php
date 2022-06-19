@extends('layouts.admin')

@section('content')
  <section class="section with-margin" >
    <div class="section-container">
      <div class="product-page-card">
        <div class="section-name-container">
          <h2 class="section-name">Добавить пункт истории:</h2>
        </div>
        @if(session('message'))
          <div class="message">
            <p class="text">{!! Session::get('message') !!}</p>
          </div>
        @endif
        <form  method="POST" @isset($month) action="{{ route('about.update', $month) }}"  @else action="{{ route('about.store') }}" @endisset>
          @csrf
          <div class="info">
            <div class="info-block">

              <div class="inputs-block">
                <label for="" class="label half-width">Год:
                  <input type="text" name="year" class="input"  pattern="[0-9]+" title="Только числовые значения" value="@isset($month){{ $month->year()->get()->first()->year }}@else{{ old('year') }}@endisset" required>
                </label>
                <label for="" class="label half-width">Месяц:
                  <select name="month_id" id="" class="input">
                    @foreach($months as $key => $value)
                    <option value="{{ $key }}"
                            @isset($month)
                              @if($key == $month->month_id)
                                selected
                              @endif
                            @endisset
                    >{{ $value }}</option>
                    @endforeach
{{--                    <option value="2" >Февраль</option>--}}
{{--                    <option value="3" >Март</option>--}}
{{--                    <option value="4" >Апрель</option>--}}
{{--                    <option value="5" >Май</option>--}}
{{--                    <option value="6" >Июнь</option>--}}
{{--                    <option value="7" >Июль</option>--}}
{{--                    <option value="8" >Август</option>--}}
{{--                    <option value="9" >Сентябрь</option>--}}
{{--                    <option value="10">Октябрь</option>--}}
{{--                    <option value="11">Ноябрь</option>--}}
{{--                    <option value="12">Декабрь</option>--}}
                  </select>
                </label>
              </div>
              <p class="block-header">Содержание:</p>
              <div class="inputs-block" style="flex-wrap: wrap">
                <label for="" class="label half-width">Русский язык:
                  <textarea name="content_ru" id="" cols="30" rows="10" >@isset($month){{ $month->content_ru }} @else {{ old('content_ru') }} @endisset</textarea>
                </label>
                <label for="" class="label half-width">Английский язык:
                  <textarea name="content_en" id="" cols="30" rows="10" >@isset($month){{ $month->content_en }} @else {{ old('content_en') }} @endisset</textarea>
                </label>
                <label for="" class="label half-width">Узбекский язык:
                  <textarea name="content_uz" id="" cols="30" rows="10" >@isset($month){{ $month->content_uz }} @else {{ old('content_uz') }} @endisset</textarea>
                </label>
              </div>
            </div>
          </div>
          <button type="submit" class="submit">Сохранить</button>
        </form>
      </div>
    </div>
  </section>
@endsection
@push('scripts')
  <script src="https://cdn.tiny.cloud/1/ablnb2dx5qmwz3sgosegtbpsr5wb13ylwjwhf4owkkj8w6na/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: '     autolink lists media    table link wordcount lists ',
      toolbar: ' addcomment showcomments  code table wordcount numlist bullist',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      setup: function (editor) {
        editor.on('change', function () {
          tinymce.triggerSave();
        });
      }
    });
  </script>
@endpush
