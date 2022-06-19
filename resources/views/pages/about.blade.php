@extends('layouts.master')

@section('content')
    <section class="section with-margin" >
        <div class="container-my">
            <div class="section-content">
                <div class="section-header-container">
                    <h2 class="section-header">@lang('common.company-history')</h2>
                    <div class="breadcrumps">
                        <a href="{{ route('getIndex') }}" class="breadcrump link">@lang('common.main_page')</a>
                        <p class="breadcrump">@lang('common.about-us')</p>
                    </div>
                </div>
                <div class="about-section">
                  <div class="timeline">
{{--                    <div style="display: none;" class="title">2019</div>--}}
{{--                    @dd($years)--}}
                    @php $i=0 @endphp
                    @foreach($years as $year)
                      @if($year->months->first() && $year->months->where('active', '=', 1)->first())
                    <p class="title">{{ $year->year }}</p>
                      @foreach($year->months->sortByDesc('month_id') as $month)
                        @if($month->active == 1)
                        <div class="timeline-item wow @if($i==0)right_side slideInRight @php $i=1 @endphp @else left_side slideInLeft @php $i=0 @endphp @endif">
                          <div class="timewrap">
                            <div class="header">
                              <h3 class="date">{{ $month->__('month') }}</h3>
                            </div>
                            <div class="content">
                              {!! $month->__('content') !!}
                            </div>
                          </div>
                        </div>
                         @endif
                      @endforeach
                      @endif
                    @endforeach
                  </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
  <script src="{{ asset('js/wow.min.js') }}"></script>
@endpush
