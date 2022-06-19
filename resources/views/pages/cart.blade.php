@extends('layouts.master')

@section('content')
    <section class="section with-margin" >
        <div class="container-my">
            <div class="section-content">
                <div class="section-header-container">
                    <h2 class="section-header">@lang('common.cart')</h2>
                    <div class="breadcrumps">
                      <a href="{{ route('getIndex') }}" class="breadcrump link">@lang('common.main_page')</a>
                        <p class="breadcrump">@lang('common.cart')</p>
                    </div>
                </div>
                <div class="cart">
                    @if(!Cart::isEmpty())
                        <div class="cart-block">
                            <div class="cart-items-block">
                                @foreach($items as $item)
                                    <div class="cart-item">
                                        <div class="product-info">
                                            <div class="img-container">
                                                <img src="{{ asset('img/product.png') }}" alt="" class="img">
                                            </div>
                                            <div class="product-text">
                                                <p class="name">{{ $item->name }}</p>
{{--                                                <div class="description">{!! $item->description !!}</div>--}}
                                            </div>
                                        </div>
                                        <div  class="form">
                                            <div class="quantity-block">
                                                <input type="hidden" id="id" name="id" value="{{ $item->id }}">
                                                <div class="minus">-</div>
                                                <input name="quantity" type="text" class="quantity" value="{{ $item->quantity }}" readonly>
                                                <div class="plus">+</div>
                                            </div>
                                        </div>
                                        <div class="price-block">
                                            <p class="price"><span class="value">{{ number_format($item->price, 0, ',', '.') }}</span><span class="value-new">{{ number_format(($item->price * $item->quantity), 0, ',', '.') }}</span> @lang('common.currency')</p>
                                        </div>
                                        <div class="delete-block">
                                            <img src="{{ asset('img/icons/trash.svg') }}" alt="" class="delete">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="overall-block">
                                <p class="name">@lang('common.overall-cost'):</p>
                                <p class="overall"><span class="value">{{ number_format(\Cart::getTotal(), 0, ',', '.') }}</span> @lang('common.currency')</p>
                            </div>
                            <div class="btn-container">
                                <a href="{{ route('getCheckoutPage') }}" class="btn">@lang('common.create-order')</a>
                            </div>
                        </div>
                    @else
                        <div class="empty-cart-block">
                            <p class="empty-cart-message">@lang('common.cart-empty')</p>
                            <div class="btn-container">
                                <a href="{{ route('getCatalog') }}" class="btn">@lang('common.go-to-catalog')</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/cart-script.js') }}"></script>
@endpush
