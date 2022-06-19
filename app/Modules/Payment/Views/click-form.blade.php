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
                        <form action="https://my.click.uz/pay/" class="payment-form" method="POST">
                            <input type="hidden" name="MERCHANT_ID" value="{{ $config['merchant-id'] }}">
                            <input type="hidden" name="MERCHANT_TRANS_ID" value="{{ $orderId }}">
                            <input type="hidden" name="MERCHANT_SERVICE_ID" value="{{ $config['service-id'] }}">
                            <input type="hidden" name="MERCHANT_TRANS_NOTE" value="Оплата заказа №{{ $orderId }}">
                            <input type="hidden" name="SIGN_TIME" value="{{ $time }}">
                            <input type="hidden" name="SIGN_STRING" value="{{ $string }}">
                            <input type="hidden" name="MERCHANT_TRANS_AMOUNT" value="{{ $amount }}">
                            <input type="hidden" name="RETURN_URL" value="{{ route('checkoutSuccess', $orderId) }}">
                            <div class="text-center">
                                <button type="submit" class="payment-btn click_logo">Оплатить через <strong>Click</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .click_logo {
            padding:4px 10px;
            cursor:pointer;
            color: #fff;
            line-height:190%;
            font-size: 13px;
            font-family: Arial;
            font-weight: bold;
            text-align: center;
            border: 1px solid #037bc8;
            text-shadow: 0px -1px 0px #037bc8;
            border-radius: 4px;
            background: #27a8e0;
            background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzI3YThlMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMxYzhlZDciIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
            background: -webkit-gradient(linear, 0 0, 0 100%, from(#27a8e0), to(#1c8ed7));
            background: -webkit-linear-gradient(#27a8e0 0%, #1c8ed7 100%);
            background: -moz-linear-gradient(#27a8e0 0%, #1c8ed7 100%);
            background: -o-linear-gradient(#27a8e0 0%, #1c8ed7 100%);
            background: linear-gradient(#27a8e0 0%, #1c8ed7 100%);
            box-shadow:  inset    0px 1px 0px   #45c4fc;
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#27a8e0', endColorstr='#1c8ed7',GradientType=0 );
            -webkit-box-shadow: inset 0px 1px 0px #45c4fc;
            -moz-box-shadow: inset  0px 1px 0px  #45c4fc;
            -webkit-border-radius:4px;
            -moz-border-radius: 4px;
        }
        .click_logo i {
            background: url(https://m.click.uz/static/img/logo.png) no-repeat top left;
            width:30px;
            height: 25px;
            display: block;
            float: left;
        }
    </style>
@endpush