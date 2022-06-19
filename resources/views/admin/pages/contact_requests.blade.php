@extends('layouts.admin')

@section('content')

            <section class="section with-margin">
                <div class="section-container">
                  <div class="filter">
                    <form action="">
                      <div class="conditions">
                        <div class="input-block">
                          <div class="input-sub-block">
                            <label for="processed">
                              <input type="checkbox" name="processed" id="processed" @if(request()->has('processed')) checked @endif>
                              Обработанные
                            </label>
                            <label for="waiting">
                              <input type="checkbox" name="waiting" id="waiting" @if(request()->has('waiting')) checked @endif>
                              Необработанные
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="btn-block">
                        <button type="submit" class="btn btn-success green">Фильтр</button>
                        <a href="{{ route('feedback.index') }}" class="btn btn-primary">Сброс</a>

                      </div>
                    </form>
                  </div>
                  @if(session('message'))
                    <div class="message">
                      <p class="text">{!! Session::get('message') !!}</p>
                    </div>
                  @endif
                    <div class="order-cards-block">
                      @foreach($requests as $request)
                        <div class="order-card request-card">
                          <div class="content-container">

                            <div class="row">
                              <div class="column name-column">
                                <div class="element">
                                  <p class="name">Номер:</p>
                                  <p class="value id">#{{ $request->id }}</p>
                                </div>
                                <div class="element">
                                  <p class="name">Время:</p>
                                  <p class="value">{{ date("d.m.Y H:i:s", strtotime( $request->created_at)) }}</p>
                                </div>
                              </div>
                              <div class="column third">
                                <div class="element">
                                  <p class="name">Имя:</p>
                                  <p class="value name-value">{{ $request->name }}</p>
                                </div>
                                <div class="element">
                                  <p class="name">Телефон:</p>
                                  <a href="tel:{{ preg_replace("/[^0-9+]/", "", "+998" . $request->phone ) }}" class="value id">+998 {{ $request->phone }}</a>
                                </div>

                              </div>
                              <div class="column third">
                                <div class="element">
                                  <p class="name">E-mail:</p>
                                  <p class="value name-value">{{ $request->email }}</p>
                                </div>
                                <div class="element">
                                  <p class="name super-long">Статус обработки:</p>
                                  <p class="value
                                @if($request->status == 0)
                                    red
                                @elseif($request->status == 1)
                                    green
                                @endif">
                                    @if($request->status ==1) Обработано @elseif($request->status == 0) Ожидание @endif
                                  </p>
                                </div>
                              </div>

                            </div>
                            <div class="row message-row">
                              <div class="column-half">
                                <div class="element message-element">
                                  <p class="name">Сообщение:</p>
                                  <p class="value">{{ $request->message }}</p>
                                </div>
                              </div>
                              <div class="btn-container">
                                <div class="element btn-element">
{{--                                  <p class="name super-super-long">Изменить статус на:</p>--}}
                                  @if($request->status == 0)
                                    <a href="{{ route('markRequestAsProcessed', $request->id) }}" class="btn blue">Отметить обработанным</a>
                                  @elseif($request->status == 1)
                                    <a href="{{ route('markRequestAsWaiting', $request->id) }}" class="btn blue">Отметить необработанным</a>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  <div class="orders-nav">
                    {!! $requests->links() !!}
                  </div>
                </div>
            </section>
@endsection
@push('scripts')
@endpush
@push('header-scripts')
@endpush

