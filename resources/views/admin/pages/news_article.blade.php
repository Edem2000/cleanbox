@extends('layouts.admin')

@section('content')
    <section class="section with-margin" >
        <div class="section-container">
          <div class="product-page-card">
            <div class="section-name-container">
              <h2 class="section-name">@isset($news) Изменение статьи <b>{{ $news->name_ru }}</b>:@elseДобавение статьи в раздел "Наши новости": @endisset</h2>
            </div>
            <form  method="POST" @isset($news) action="{{ route('news.update', $news) }}" @else action="{{ route('news.store') }}" @endisset enctype="multipart/form-data" id="admin_news_form">
              @csrf
              @isset($news) @method('PUT') @endisset

              <div class="info">
{{--                <p class="block-header">Информация о товаре:</p>--}}
                <div class="info-block">
                  <p class="block-header">Русский язык:</p>
                  <div class="inputs-block">
                    <label for="" class="label name-label">Название:
                      <input type="text" name="name_ru" class="input" @isset($news)value="{{ $news->name_ru }}" @endisset required>
                    </label>
                    <label for="" class="label">Содержание:
                      <textarea name="content_ru" id="" cols="30" rows="10" required> @isset($news){{ $news->content_ru }}@endisset</textarea>
                    </label>
                  </div>
                </div>
                <div class="info-block">
                  <p class="block-header">Английский язык:</p>
                  <div class="inputs-block">
                    <label for="" class="label name-label">Название:
                      <input type="text" name="name_en" class="input" @isset($news)value="{{ $news->name_en }}" @endisset required>
                    </label>
                    <label for="" class="label">Содержание:
                      <textarea name="content_en" id="" cols="30" rows="10" required>@isset($news){{ $news->content_en }}@endisset</textarea>
                    </label>
                  </div>
                </div>
                <div class="info-block">
                  <p class="block-header">Узбекский язык:</p>
                  <div class="inputs-block">
                    <label for="" class="label name-label">Название:
                      <input type="text" name="name_uz" class="input" @isset($news)value="{{ $news->name_uz }}" @endisset required>
                    </label>
                    <label for="" class="label">Содержание:
                      <textarea name="content_uz" id="" cols="30" rows="10" required>@isset($news){{ $news->content_uz }}@endisset</textarea>
                    </label>
                  </div>
                </div>
              </div>
              <p class="block-header">Изображение для превью статьи:</p>
                <div class="images-block">
                  @isset($news)
                    <div class="images-container">
                      <div class="img-container big">
                        <p class="text">Картинка:</p>
                        <img src="{{ Storage::url($news->img) }}" alt="" class="img">
                      </div>
                    </div>
                  @endisset
                  <div class="images-inputs">
                    <div class="input-label-container">
                      <label for="" class="input-label">Картинка:
                        <input type="file" name="img" id="" class="image-input" accept=".png, .webp,.jpg" @empty($news) required @endempty>
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

  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="{{ asset('js/admin/form-validation.js') }}"></script>

@endpush
