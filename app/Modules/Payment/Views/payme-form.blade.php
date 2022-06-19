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
                    <h2 class="section-header center">Оплата заказа</h2>
                </div>
                <div class="checkout-page-section">
                    <div class="text-center">
                        <form method="POST" action="{{ $config['url'] }}">

                            <!-- Идентификатор WEB Кассы -->
                            <input type="hidden" name="merchant" value="{{ $config['merchant-id'] }}"/>

                            <!-- Сумма платежа в тийинах -->
                            <input type="hidden" name="amount" value="{{ $amount }}"/>

                            <!-- Поля Объекта Account -->
                            <input type="hidden" name="account[order_id]" value="{{ $orderId }}"/>

                            <input type="hidden" name="callback" value="{{ route('checkoutSuccess', $orderId) }}"/>

                            <input type="hidden" name="description" value="Оплата заказа №{{ $orderId }}"/>

                            <button type="submit" class="payment-btn payme">Оплатить с помощью <b>Payme</b></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection