@extends('layouts.master')

@section('content')
    <section class="section with-margin" >
        <div class="container-my">
            <div class="section-content">
                <div class="section-header-container">
                    <h2 class="section-header">@lang('common.why-trust-us')?</h2>
                    <div class="breadcrumps">
                        <a href="{{ route('getIndex') }}" class="breadcrump link">@lang('common.main_page')</a>
                        <p class="breadcrump">@lang('common.certificates')</p>
                    </div>
                </div>
                <div class="diplomas diplomas-block">
                  @foreach($diplomas as $diploma)
                    <div class="diploma">
                      <img src="{{ Storage::url($diploma->img) }}" alt="" class="img" title="">
                      <p class="diploma-title">{{ $diploma->__('name') }}</p>
                    </div>

                  @endforeach
                </div>
            </div>
        </div>
    </section>
    <div class="diploma-modal-overlay"></div>
  <div class="diploma-modal">
    <div class="img-container">
      <img src="" alt="" class="modal-diploma-img">
    </div>
  </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/cart-script.js') }}"></script>
@endpush
