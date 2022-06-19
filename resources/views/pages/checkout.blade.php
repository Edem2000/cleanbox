@extends('layouts.master')

@section('content')
    <section class="section with-margin" >
        <div class="container-my">
            <div class="section-content">
                <div class="section-header-container">
                    <!--                    <div class="breadcrumps">-->
                    <!--                        <a href="" class="breadcrump link">Главная</a>-->
                    <!--                        <a href="" class="breadcrump link">Корзина</a>-->
                    <!--                        <p class="breadcrump">Оформление заказа</p>-->
                    <!--                    </div>-->
                    <h2 class="section-header center">@lang('common.ordering')</h2>
                </div>
                <div class="checkout-page-section">
                    <div class="products-block">
                        <p class="block-header">@lang('common.your-purchases'):</p>
                        <div class="header">
                            <div class="number">
                                <p>@lang('common.number')</p>
                            </div>
                            <div class="name">
                                <p>@lang('common.name')</p>
                            </div>
                            <div class="quantity">
                                <p class="desktop-only">@lang('common.quantity')</p>
                                <p class="mobile-only">@lang('common.q-ty')</p>
                            </div>
                            <div class="overall">
                                <p class="desktop-only">@lang('common.overall-cost')</p>
                                <p class="mobile-only">@lang('common.cost')</p>
                            </div>
                        </div>
                        @foreach($items as $item)
                        <div class="product-item">
                            <p class="number">{{ $loop->iteration }}</p>
                            <p class="name">{{ $item->name }}</p>
                            <p class="quantity">{{ $item->quantity }}</p>
                            <p class="overall">{{ number_format(($item->price * $item->quantity), 0, ',', '.') }} @lang('common.currency')</p>
                        </div>
                        @endforeach
                        <div class="overall-block">
                            <p class="number"></p>
                            <p class="name">@lang('common.amount'):</p>
                            <p class="quantity"></p>
                            <p class="overall">{{ number_format(\Cart::getSubTotal(), 0, ',', '.') }} @lang('common.currency')</p>
                        </div>
                        <div class="btn-container">
                            <a href="{{ route('getCart') }}" class="btn">@lang('common.back-to-cart')</a>
                        </div>
                    </div>
                    <div class="form-block">
                        <p class="block-header">@lang('common.your-data'):</p>
                        <form method="post" action="{{ route('checkoutComplete') }}" class="form" id="checkout_form">
                            @csrf
                            <div class="input-row">
                                <div class="input-container">
                                    <input type="text" class="input" placeholder="@lang('common.form-name')" name="customer">
                                </div>
                                <div class="input-container phone-container">
                                    <input type="tel"  class="input" placeholder="@lang('common.form-your-phone')" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <input type="text" class="input" placeholder="@lang('common.form-address')" name="address">
                                </div>
                                <div class="input-container align">
                                    <label for="delivery" class="label">@lang('common.courier-delivery')
                                        <input type="checkbox" class="checkbox" id="delivery" name="delivery" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="input-block">
                                <p class="input-block-header">@lang('common.payment-method'):</p>
                                <div class="radio-input-row">
                                    <label for="click" class="label">
                                        <input name="payment_method" type="radio" id="click" value="click" class="radio" checked>
                                        <img src="{{ asset('img/gateways/click-logo_.png') }}" alt="" class="gateway-logo">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                    <label for="payme" class="label">
                                        <input name="payment_method" type="radio" id="payme" value="payme" class="radio">
                                        <img src="{{ asset('img/gateways/payme_01.png') }}" alt="" class="gateway-logo">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                    <label for="apelsin" class="label">
                                        <input name="payment_method" type="radio" id="apelsin" value="apelsin" class="radio">
                                        <img src="{{ asset('img/gateways/apelsin_logo.png') }}" alt="" class="gateway-logo">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class=" input-row ">
                                <div class="input-container comment">
                                    <textarea name="comment" id="" cols="30" rows="5" class="comment" placeholder="@lang('common.order-comment')"></textarea>
                                </div>
                            </div>
                            <div class="btn-container">
                                <button class="btn">@lang('common.checkout')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/form-validation.js') }}"></script>
@endpush

