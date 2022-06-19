@extends('layouts.admin')

@section('content')
    <?php
//        $product = \App\Models\Product::find($id);
    ?>
    <section class="section with-margin">
        <div class="section-container">
            <div class="product-page-card">
                <div class="section-name-container">
                    <h2 class="section-name">@isset($product) Изменение товара <b>{{ $product->name_ru }}</b>:@elseДобавение товара: @endisset</h2>
                </div>
                <form  method="POST" @isset($product) action="{{ route('products.update', $product) }}" @else action="{{ route('products.store') }}" @endisset enctype="multipart/form-data" id="admin_product_form">
                    @csrf
                    @isset($product) @method('PUT') @endisset

                    <div class="info">
                        <p class="block-header">Информация о товаре:</p>
                        <div class="info-block">
                            <p class="block-header">Русский язык:</p>
                            <div class="inputs-block">
                                <label for="" class="label name-label">Название:
                                    <input type="text" name="name_ru" class="input" @isset($product)value="{{ $product->name_ru }}" @endisset required>
                                </label>
                                <label for="" class="label">Описание:
                                    <textarea name="description_ru" id="" cols="30" rows="10" required> @isset($product){{ $product->description_ru }}@endisset</textarea>
                                </label>
                            </div>
                        </div>
                        <div class="info-block">
                            <p class="block-header">Английский язык:</p>
                            <div class="inputs-block">
                                <label for="" class="label name-label">Название:
                                    <input type="text" name="name_en" class="input" @isset($product)value="{{ $product->name_en }}" @endisset required>
                                </label>
                                <label for="" class="label">Описание:
                                    <textarea name="description_en" id="" cols="30" rows="10" >@isset($product){{ $product->description_en }}@endisset</textarea>
                                </label>
                            </div>
                        </div>
                        <div class="info-block">
                            <p class="block-header">Узбекский язык:</p>
                            <div class="inputs-block">
                                <label for="" class="label name-label">Название:
                                    <input type="text" name="name_uz" class="input" @isset($product)value="{{ $product->name_uz }}" @endisset required>
                                </label>
                                <label for="" class="label">Описание:
                                    <textarea name="description_uz" id="" cols="30" rows="10" required>@isset($product){{ $product->description_uz }}@endisset</textarea>
                                </label>
                            </div>
                        </div>
                        <div class="info-block">
                            <div class="inputs-block">
                                <label for="" class="label name-label">Цена (без разделителей):
                                    <input type="text" name="price" class="input" @isset($product)value="{{ $product->price }}" @endisset required>
                                </label>
                            </div>
                        </div>
                    </div>
                    <p class="block-header">Изображения товара:</p>
                    <div class="images-block">
                      @isset($product)
                        <div class="images-container">
                            <div class="img-container">
                                <p class="text">Картинка 1:</p>
                                <img src="{{ Storage::url($product->img) }}" alt="" class="img">
                            </div>
                            <div class="img-container">
                                <p class="text">Картинка 2:</p>
                                <img src="{{ Storage::url($product->img2) }}" alt="" class="img">
                            </div>
                            <div class="img-container">
                                <p class="text">Картинка 3:</p>
                                <img src="{{ Storage::url($product->img3) }}" alt="" class="img">
                            </div>
                            <div class="img-container">
                                <p class="text">Сдвоенная:</p>
                                <img src="{{ Storage::url($product->img_doubled) }}" alt="" class="img">
                            </div>
                        </div>
                        @endisset
                        <div class="images-inputs">
                            <div class="input-label-container">
                                <label for="" class="input-label">Картинка товара 1
                                    <input type="file" name="img" id="" class="image-input" accept=".png, .webp,.jpg" @empty($product) required @endempty>
                                </label>
                            </div>
                            <div class="input-label-container">
                                <label for="" class="input-label">Картинка товара 2
                                    <input type="file" name="img2" id="" class="image-input" accept=".png, .webp,.jpg" @empty($product) required @endempty>
                                </label>
                            </div>
                            <div class="input-label-container">
                                <label for="" class="input-label">Картинка товара 3
                                    <input type="file" name="img3" id="" class="image-input" accept=".png, .webp,.jpg" @empty($product) required @endempty>
                                </label>
                            </div>
                            <div class="input-label-container">
                                <label for="" class="input-label">Сдвоенная картинка товара
                                    <input type="file" name="img_doubled" id="" class="image-input" accept=".png, .webp,.jpg" @empty($product) required @endempty>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="submit">Сохранить</button>
                </form>
              <p class="note">Заполните описание товаров на всех языках</p>
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
