
<footer id="footer">
    <div class="container-my">
        <div class="footer ">
            <div class="top">
                <div class="brand-container">
                    <h2 class="brand-name">CleanBox</h2>
                    <a href="tel:{{ preg_replace("/[^0-9+]/", "", $contacts->phone ) }}" class="phone">{{ $contacts->phone }}</a>
                </div>
                <div class="columns">
                    <div class="column">
                        <p class="header">@lang('common.products')</p>
                      @foreach($products as $product)
                        @if($product->visible == 1)
                          <a href="{{ route('getProductPage', $product->id) }}" class="item">{{ $product->__('name') }}</a>
                        @endif
                      @endforeach
                    </div>
                    <div class="column">
                        <p class="header">@lang('common.for-customers')</p>
                        <a href="/#how-to" class="item">@lang('common.working-principle')</a>
                        <a href="/#why-us-section" class="item">@lang('common.why-us')</a>
                        <a href="/#diplomas-section" class="item">@lang('common.certificates')</a>
                    </div>
                    <div class="column">
                        <p class="header">@lang('common.information')</p>
                        <a href="@if(Route::currentRouteNamed('getIndex')) /#about-section @else {{ route('getAbout') }} @endif" class="item">@lang('common.about')</a>
                        <a href="{{ route('getBlogPage') }}" class="item">@lang('common.blog-plain')</a>
                        <a href="/#form-section" class="item">@lang('common.contacts')</a>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <div class="copyright">
                    <p class="text">&copy; CleanBox, {{ date('Y') }}</p>
                </div>
                <div class="social">
                  @if( isset($contacts->telegram))
                    <a href="{{ $contacts->telegram }}" class="social-item" target="_blank">
                        <img src="{{ asset('img/icons/telegram.svg') }}" alt="" class="icon">
                    </a>
                  @endif
                  @if( isset($contacts->facebook))
                    <a href="{{ $contacts->facebook }}" class="social-item" target="_blank">
                        <img src="{{ asset('img/icons/facebook.svg') }}" alt="" class="icon">
                    </a>
                  @endif
                  @if( isset($contacts->instagram))
                    <a href="{{ $contacts->instagram }}" class="social-item" target="_blank">
                        <img src="{{ asset('img/icons/instagram.svg') }}" alt="" class="icon">
                    </a>
                  @endif
                </div>
            </div>
        </div>
    </div>

</footer>
