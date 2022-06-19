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
                        <form method="GET" action="https://oplata.kapitalbank.uz">
                            <input type="hidden" name="cash" value="{{ $config['client_id'] }}"/>
                            <input type="hidden" name="redirectUrl" value="{{ route('checkoutSuccess', $orderId) }}"/>
                            <input type="hidden" name="description" value="Оплата заказа №{{ $orderId }}"/>
                            <input type="hidden" name="amount" value="{{ $amount * 100 }}"/>
                            <input type="hidden" name="order_id" value="{{ $orderId }}"/>
                            <button type="submit" class="payment-btn apelsin" style="cursor: pointer; ">
                            	Оплатить с помощью <b>Apelsin</b>
                                {{--<img style="width: 100px; height: 42px;" src="https://oplata.kapitalbank.uz/images/humo.png">--}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection