@extends('layouts.payment')

@section('content')
    <div class="text-center">
        @lang('main_page.in_any_paynet') @lang('main_page.on_pay')  {{ $orderId }} @lang('main_page.and_amount') {{ number_format($amount, 0, '.', ' ') }} сум</b>.
    </div>
@endsection