@extends('layouts.master')

@section('content')
    <section class="section with-margin" >
        <div class="container-my">
            <div class="section-content">
                <div class="section-header-container">
                    <div class="breadcrumps">
                        <a href="{{ route('getIndex') }}" class="breadcrump link">@lang('common.main_page')</a>
                        <a href="{{ route('getCatalog') }}" class="breadcrump link">@lang('common.catalog')</a>
                        <p class="breadcrump">{{ $product->__('name') }}</p>
                    </div>
                </div>
                <div class="product">
                    <div class="img-block">
                        <div class="slider owl-carousel" id="product-page-slider">
                            <div class="slide">
                                <img src="{{ Storage::url($product->img) }}" alt="" class="img">
                            </div>
                            <div class="slide">
                                <img src="{{ Storage::url($product->img2) }}" alt="" class="img">
                            </div>
                            <div class="slide">
                                <img src="{{ Storage::url($product->img3) }}" alt="" class="img">
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <h1 class="name">{{ $product->__('name') }}</h1>
                        <p class="price">{{ number_format($product->price, 0, ',', '.') }} @lang('common.currency')</p>
                        <div class="description-block">
                            {!! $product->__('description') !!}
                        </div>
                        <div class="bottom" >
                          @if($product->active == 0)
                            <div class="coming-container">
                              <div class="coming_soon">@lang('common.coming-soon')</div>
                            </div>
                          @else
                            <form action="" class="form" id="to_cart">
                                <div class="quantity">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <p class="text">@lang('common.quantity'):</p>
                                    <div class="quantity-block">
                                        <div class="minus">-</div>
                                        <input name="quantity" type="text" class="quantity" value="1" readonly>
                                        <div class="plus">+</div>
                                    </div>
                                </div>
{{--                                <button class="submit" onclick="preventDefault(); addToCart('to_cart')">Добавить в корзину</button>--}}
                                <input type="button" class="submit" id="to_cart_submit" value="@lang('common.add-to-cart')">
                            </form>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/cart-script.js') }}"></script>
@endpush

