@extends('layouts.admin')

@section('content')
    <section class="section with-margin" >
        <div class="section-container">
          <div class="product-page-card">
            <div class="section-name-container">
              <h2 class="section-name">@isset($diploma) Изменение сертификата <b>{{ $diploma->name_ru }}</b>:@elseДобавение сертификата: @endisset</h2>
            </div>
            <form  method="POST" @isset($diploma) action="{{ route('diplomas.update', $diploma) }}" @else action="{{ route('diplomas.store') }}" @endisset enctype="multipart/form-data" id="admin_news_form">
              @csrf
              @isset($diploma) @method('PUT') @endisset

              <div class="info">
                <p class="block-header">Название сертификата:</p>
                <div class="info-block">
                  <div class="inputs-block">
                    <label for="" class="label name-label">Название на русском:
                      <input type="text" name="name_ru" class="input" @isset($diploma)value="{{ $diploma->name_ru }}" @endisset required>
                    </label>
                    <label for="" class="label name-label">Название на английском:
                      <input type="text" name="name_en" class="input" @isset($diploma)value="{{ $diploma->name_en }}" @endisset required>
                    </label>
                    <label for="" class="label name-label">Название на узбекском:
                      <input type="text" name="name_uz" class="input" @isset($diploma)value="{{ $diploma->name_uz }}" @endisset required>
                    </label>
                  </div>
                </div>
              </div>
              <p class="block-header">Изображение сертификата:</p>
                <div class="images-block">
                  @isset($diploma)
                    <div class="images-container">
                      <div class="img-container big">
                        <p class="text">Картинка:</p>
                        <img src="{{ Storage::url($diploma->img) }}" alt="" class="img">
                      </div>
                    </div>
                  @endisset
                  <div class="images-inputs">
                    <div class="input-label-container">
                      <label for="" class="input-label">Картинка:
                        <input type="file" name="img" id="" class="image-input" accept=".png, .webp,.jpg" @empty($diploma) required @endempty>
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

  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="{{ asset('js/admin/form-validation.js') }}"></script>

@endpush
