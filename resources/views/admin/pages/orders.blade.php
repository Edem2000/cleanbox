@extends('layouts.admin')

@section('content')

            <section class="section with-margin">
                <div class="section-container">
                  <div class="filter">
                    <form action="">
                      <div class="conditions">
                        <div class="input-block">
                          <div class="input-sub-block">
                            <label for="paid">
                              <input type="checkbox" name="paid" id="paid" @if(request()->has('paid')) checked @endif>
                              Оплаченные
                            </label>
                            <label for="unpaid">
                              <input type="checkbox" name="unpaid" id="unpaid" @if(request()->has('unpaid')) checked @endif>
                              Неоплаченные
                            </label>
                          </div>
                        </div>
                        <div class="input-block">
                          <div class="input-sub-block">
                            <label for="click">
                              <input type="checkbox" name="click" id="click" @if(request()->has('click')) checked @endif>
                              Click
                            </label>
                            <label for="payme">
                              <input type="checkbox" name="payme" id="payme" @if(request()->has('payme')) checked @endif>
                              Payme
                            </label>
                          </div>
                          <div class="input-sub-block">
                            <label for="apelsin">
                              <input type="checkbox" name="apelsin" id="apelsin" @if(request()->has('apelsin')) checked @endif>
                              Apelsin
                            </label>
                          </div>
                        </div>
                        <div class="input-block"></div>
                      </div>
                      <div class="btn-block">
                        <button type="submit" class="btn btn-success green">Фильтр</button>
                        <a href="{{ route('orders.index') }}" class="btn btn-primary">Сброс</a>

                      </div>
                    </form>
                  </div>
                  @if(session('message'))
                    <div class="message">
                      <p class="text">{!! Session::get('message') !!}</p>
                    </div>
                  @endif
                    <div class="order-cards-block">
                      @foreach($orders as $order)
                        <div class="order-card">
                      <div class="info">
                        <div class="mini-info">
                          <div class="row">
                            <div class="column name-column">
                              <div class="element">
                                <p class="name">Номер:</p>
                                <p class="value id">#{{ $order->id }}</p>
                              </div>
                              <div class="element">
                                <p class="name">Сумма:</p>
                                <p class="value">{{ number_format($order->amount, 0, ',', '.') }} сум</p>
                              </div>
                            </div>
                            <div class="column">
                              <div class="element">
                                <p class="name long">Статус заказа:</p>
                                @foreach($statuses as $status)
                                  @if($status->status_id == $order->processing_status)
                                    <p class="value {{ $status->color }}">{{ $status->name }}</p>
                                  @endif
                                @endforeach
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
                            <div class="column">
                              <div class="element">
                                <p class="name">Имя:</p>
                                <p class="value name-value">{{ $order->customer }} </p>
                              </div>

                            </div>
                            <div class="btn-container">
                              <button class="btn order-show">Развернуть</button>
                            </div>

                          </div>
                        </div>
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
                                <a href="tel:{{ preg_replace("/[^0-9+]/", "", "+998" . $order->phone ) }}" class="value id">+998 {{ $order->phone }}</a>
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
                                @foreach($statuses as $status)
                                  @if($status->status_id == $order->processing_status)
                                  <p class="value {{ $status->color }}">{{ $status->name }}</p>
                                  @endif
                                @endforeach
                              </div>
                            </div>
                          </div>
                          <div class="buttons-block">
                            <div class="btn-container">
                              <a href="{{ route('orders.edit', $order) }}" class="btn">Редактировать</a>
                            </div>
                            <div class="btn-container">
                              <button class="btn order-hide">Свернуть</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                      @endforeach
                    </div>
                  <div class="orders-nav">
                    {!! $orders->links() !!}
                  </div>
                </div>
            </section>
@endsection
@push('scripts')
@endpush
@push('header-scripts')
@endpush

