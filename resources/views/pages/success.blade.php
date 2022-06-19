@extends('layouts.master')

@section('content')
    <section class="section with-margin" >
        <div class="container-my">
            <div class="section-content">
              <div class="section-header-container">
                <h2 class="section-header center">@lang('common.thank-you-for-order')!</h2>
              </div>
              <div class="checkout-page-section">
                <div class="text-center">
                  <p>@lang('common.order-num'): <b>{{ $orderId }}</b>. <br></p>
                </div>
                <div class="text-center">
                  <p>@lang('common.manager-will')</p>
                </div>
              </div>
            </div>
        </div>
    </section>
@endsection

