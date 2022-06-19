@extends('layouts.admin')

@section('content')

    <section class="section with-margin">
        <div class="section-container">
            <div class="section-nav">
                <div class="btn-container">
                    <a href="{{ route('products.create') }}" class="btn">Добавить товар</a>
                </div>
            </div>
          @if(session('message'))
            <div class="message">
              <p class="text">{!! Session::get('message') !!}</p>
            </div>
          @endif
            <div class="product-cards-block">
                @foreach($products as $product)
                <div class="product-card">
                    <div class="img-container">
                        <img src="{{ Storage::url($product->img) }}" alt="" class="img">
                    </div>
                    <div class="info">
                        <p class="name">{{ $product->name_ru }}</p>
                        <p class="price">{{ number_format($product->price, 0, ',', '.') }} сум</p>
                        <div class="description">{!! $product->description_ru !!} </div>
                    </div>
                    <div class="btns-block">
                        <a href="{{ route('products.edit', $product) }}" class="btn blue">Изменить</a>
                        @if($product->visible === 1 )
                            <a href="{{ route('hideProduct', $product) }}" class="btn grey">Скрыть</a>
                        @else
                            <a href="{{ route('showProduct', $product) }}" class="btn green">Показать</a>
                        @endif
                        @if($product->active === 1 )
                            <a href="{{ route('disableProduct', $product) }}" class="btn red">Отключить</a>
                        @else
                            <a href="{{ route('enableProduct', $product) }}" class="btn green">Включить</a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@endpush

