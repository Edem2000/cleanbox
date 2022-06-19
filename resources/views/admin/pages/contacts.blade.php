@extends('layouts.admin')

@section('content')
    <section class="section with-margin" >
        <div class="section-container">
          <div class="product-page-card">
            <div class="section-name-container">
              <h2 class="section-name">Контакты:</h2>
            </div>
            @if(session('message'))
              <div class="message">
                <p class="text">{!! Session::get('message') !!}</p>
              </div>
            @endif
            <form  method="POST" action="{{ route('contacts.update') }}" >
              @csrf

              <div class="info">
                <div class="info-block">
                  <div class="inputs-block">
                    <label for="" class="label half-width">Номер телефона (с разделителями):
                      <input type="text" name="phone" class="input" value="{{ $contacts->phone }}"  required>
                    </label>
                    <label for="" class="label half-width">Ссылка на профиль Telegram:
                      <input type="text" name="telegram" class="input" value="{{ $contacts->telegram }}"  >
                    </label>
                  </div>
                  <div class="inputs-block">
                    <label for="" class="label half-width">Ссылка на страницу Instagram:
                      <input type="text" name="instagram" class="input" value="{{ $contacts->instagram }}"  >
                    </label>
                    <label for="" class="label half-width">Ссылка на страницу Facebook:
                      <input type="text" name="facebook" class="input" value="{{ $contacts->facebook }}"  >
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


@endpush
