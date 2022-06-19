@extends('layouts.master')

@section('content')
    <section class="section with-margin" >
    <div class="container-my">
        <div class="section-content">
            <div class="section-header-container">
                <h2 class="section-header">@lang('common.our-products')</h2>
                <div class="breadcrumps">
                    <a href="{{ route('getIndex') }}" class="breadcrump link">@lang('common.main_page')</a>
                    <p class="breadcrump">@lang('common.catalog')</p>
                </div>
            </div>
            <div class="catalog">
                <div class="cards-container">
                    <div class="cards">
                        @foreach($products as $product)
                          @if($product->visible == 1)
                            <a href="{{ route('getProductPage', $product->id) }}" class="card-container">
                            <div class="products-card">
                                <div class="info">
                                    <p class="header">{{ $product->__('name') }}</p>
                                    <p class="price">{{ number_format($product->price, 0, ',', '.') }} UZS</p>
                                </div>
                                <div class="img-container">
                                    <img src="{{ Storage::url($product->img_doubled) }}" alt="" class="img">
                                </div>
                                <div class="bottom">
                                    <p class="link">@lang('common.more')  ></p>
                                </div>
                            </div>
                        </a>
                          @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
