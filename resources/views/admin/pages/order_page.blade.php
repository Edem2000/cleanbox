@extends('layouts.admin')

@section('content')

            <section class="section with-margin">
                <div class="section-container">
                    <div class="order-cards-block">
                        <div class="order-card page">
                      <div class="info">
                        <div class="full-info">
                          <div class="row">
                            <div class="column third">
                              <div class="element">
                                <p class="name long">Номер заказа:</p>
                                <p class="value id">#{{ $order->id }}</p>
                              </div>
                              <div class="element">
                                <p class="name long">Сумма:</p>
                                <p class="value">{{ number_format($order->amount, 0, ',', '.') }} сум</p>
                              </div>
                            </div>
                            <div class="column third">
                              <div class="element">
                                <p class="name">Имя:</p>
                                <p class="value name-value">{{ $order->customer }}</p>
                              </div>
                              <div class="element">
                                <p class="name">Телефон:</p>
                                <a href="tel:" class="value id">+998 {{ $order->phone }}</a>
                              </div>

                            </div>
                            <div class="column third">
                              <div class="element">
                                <p class="name long">Метод оплаты:</p>
                                <p class="value">{{ $order->payment_method }}</p>
                              </div>
                              <div class="element">
                                <p class="name long">Статус оплаты:</p>
                                <p class="value
                                @if($order->status == 0)
                                  red
                                @elseif($order->status == 1)
                                  green
                                @endif">
                                  @if($order->status ==1) Оплачено @elseif($order->status == 0) Ожидание @endif
                                </p>
                              </div>

                            </div>
{{--                            <div class="btn-container">--}}
{{--                              <button class="btn order-hide">Свернуть</button>--}}
{{--                            </div>--}}
                          </div>
                          <div class="row">
                            <div class="column half">
                              <div class="products">
                                <div class="products-header">
                                  <p class="name product-name">Товар:</p>
                                  <p class="name quantity">Количество:</p>
                                </div>
                                <div class="content">
                                  @foreach($order->items as $item)
                                  <div class="product">
                                    <p class="name">{{ $item->item_name }}</p>
                                    <p class="quantity">{{ $item->quantity }} шт</p>
                                  </div>
                                  @endforeach
                                </div>
                              </div>
                            </div>
                            <div class="column half">
                              <div class="element address-element">
                                <p class="name super-long">Адрес доставки:</p>
                                <p class="value address-value">{{ $order->address }}</p>
                              </div>
                            </div>
                          </div>
                          <form action="{{ route('orders.update', $order) }}" method="POST" class="form">
                            @csrf
                            @method('PUT')
                          <div class="row">
                            <div class="column half">
                              <div class="element">
                                <p class="name long">Время заказа:</p>
                                <p class="value">{{ date("d.m.Y H:i:s", strtotime( $order->created_at)) }}</p>
                              </div>
                            </div>
                            <div class="column half">
                              <div class="element">
                                <p class="name long">Статус заказа:</p>

                                <select class="input" name="processing_status" id="">
                                @foreach($statuses as $status)
                                  <option value="{{ $status->status_id }}"
                                          @if($status->status_id == $order->processing_status)
                                          selected
                                    @endif
                                  >{{ $status->name }}
                                  </option>
                                  @endforeach
                                  </select>
                              </div>
                            </div>
                          </div>
                          <div class="buttons-block">
                            <div class="btn-container">
                              <button type="submit" class="btn">Сохранить</button>
                          </div>
                          </form>
                          </div>
                        </div>
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
@endpush

