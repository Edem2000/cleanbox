@extends('layouts.admin')

@section('content')

            <section class="section with-margin">
                <div class="section-container">
                    <div class="cards-row">
                        <div class="statistics">
                            <div class="diagram" id="diagram">
                            </div>
                        </div>
                        <div class="nums">
                            <div class="card">
                                <img src="{{ asset('img/admin/product_admin_icon.svg') }}" alt="" class="icon">
                                <div class="text-block">
                                    <p class="name">Всего товаров продано</p>
                                    <p class="value">{{ number_format($products_sold, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('img/admin/order_admin_icon.svg') }}" alt="" class="icon">
                                <div class="text-block">
                                    <p class="name">Всего заказов</p>
                                    <p class="value">{{ number_format($orders_quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('img/admin/money_admin_icon.svg') }}" alt="" class="icon">
                                <div class="text-block">
                                    <p class="name">Продано на сумму</p>
                                    <p class="value">{{ number_format($orders_amount, 0, ',', '.') }} сум</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cards-row">
                        <div class="last-orders">
                            <p class="last-orders__header">Последние покупки</p>
                            <div class="last-orders__table">
                              @foreach($orders->slice(0,5) as $order)
                                <div class="last-orders__item">
                                    <div class="left">
                                        <p class="id">{{ $order->id }}</p>
                                        <p class="name">{{ $order->customer }}</p>
                                    </div>
                                    <div class="right">
                                        <a href="tel:{{ preg_replace("/[^0-9+]/", "", "+998" . $order->phone ) }}" class="phone">+998 {{ $order->phone }}</a>
                                        <p class="cost">{{ number_format($order->amount, 0, ',', '.') }} сум</p>
                                      @foreach($statuses as $status)
                                        @if($status->status_id == $order->processing_status)
                                          <div class="status {{ $status->color }}">
                                            <p class="text">{{ $status->name }}</p>
                                          </div>
                                        @endif
                                      @endforeach
                                        <p class="created">{{ date("d.m.Y H:i", strtotime( $order->created_at)) }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/blog-cards-slider.js') }}"></script>
@endpush
@push('header-scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable(
                @json($products)
            );

            var options = {
                pieHole: 0.8,
                pieSliceTextStyle: {
                    color: 'transparent',
                },
                legend: {
                    position: 'right',
                    alignment: 'center',
                    textStyle: {color: '#9E9E9E', fontSize: 16, bold: true}
                },
                // legend: 'none',
                colors:['#F2D8FF','#1A5BC5', '#6FA8FF', '#9BF2AF'],
                chartArea: {
                    width: 450, height: 237, top: 10, bottom: 10,
                },
                pieStartAngle: 50,
            };

            var chart = new google.visualization.PieChart(document.getElementById('diagram'));
            chart.draw(data, options);
        }
    </script>
@endpush

