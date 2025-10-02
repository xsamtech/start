@extends('layouts.app', ['page_title' => __('miscellaneous.menu.home')])

@section('app-content')

            <section id="content">
                <div id="slider-rev-container">
                    <div id="slider-rev">
                        <ul>
                            <li data-transition="fade" data-slotamount="6" data-masterspeed="600" data-saveperformance="on" data-title="Special Offers">
                                <img src="{{ getWebURL() . '/template/public/images/revslider/dummy.png' }}" alt="slidebg1" data-lazyload="{{ getWebURL() . '/template/public/images/homeslider/slide1.png' }}" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <div class="tp-caption rev-title lfr ltr text-uppercase" data-x="695" data-y="160" data-speed="1600" data-start="300" data-endspeed="300">@lang('miscellaneous.public.slides.slide_1.title')</div>
                                <div class="tp-caption rev-text lfr ltr" data-x="695" data-y="252" data-speed="1600" data-start="600" data-endspeed="550">@lang('miscellaneous.public.slides.slide_1.description')</div>

                                <div class="tp-caption lfr ltr" data-x="695" data-y="370" data-speed="1600" data-start="900" data-endspeed="800">
                                    <a href="{{ route('product.entity', ['entity' => 'product']) }}" class="btn btn-custom-2">@lang('miscellaneous.see_more')</a>
                                </div>
                                <div class="tp-caption lfl ltl" data-x="center" data-y="bottom" data-hoffset="-230" data-speed="2000" data-start="500" data-endspeed="800">
                                    <img src="{{ asset('assets/img/slides/slide_1.png') }}" alt="Slide 1_1">
                                </div>
                            </li>

                            <li data-transition="fade" data-slotamount="5" data-masterspeed="600" data-saveperformance="on" data-title="Learn More">
                                <img src="{{ getWebURL() . '/template/public/images/revslider/dummy.png' }}" alt="slidebg2" data-lazyload="{{ getWebURL() . '/template/public/images/homeslider/slide2.jpg' }}" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <div class="tp-caption rev-title lfr ltr text-uppercase" data-x="755" data-y="160" data-speed="1600" data-start="750" data-endspeed="300" style="z-index: 9999; color: #fff; text-shadow: rgba(0,0,0,0.5)">@lang('miscellaneous.public.slides.slide_2.title')</div>
                                <div class="tp-caption rev-text2 lfr ltr" data-x="755" data-y="252" data-speed="1600" data-start="1050" data-endspeed="550" style="z-index: 9999; color: #fff; text-shadow: rgba(0,0,0,0.5)">@lang('miscellaneous.public.slides.slide_2.description')</div>

                                <div class="tp-caption lfr ltr" data-x="755" data-y="360" data-speed="1600" data-start="1350" data-endspeed="800" style="z-index: 9999">
                                    <a href="{{ route('discussion.home') }}" class="btn btn-custom-2">@lang('miscellaneous.see_more')</a>
                                </div>

                                <div class="tp-caption lfl ltl" data-x="center" data-y="center" data-hoffset="-204" data-speed="1750" data-start="400" data-endspeed="800">
                                    <img src="{{ asset('assets/img/slides/slide_2_2.png') }}" alt="Slide 2_2">
                                </div>

                                <div class="tp-caption lfr ltr" data-x="380" data-y="50" data-speed="1800" data-start="250" data-endspeed="800">
                                    <img src="{{ asset('assets/img/slides/slide_2_1.png') }}" alt="Slide 2_1">
                                </div>
                            </li>

                            <li data-transition="fade" data-slotamount="4" data-masterspeed="600" data-saveperformance="on" data-title="More Features">
                                <img src="{{ getWebURL() . '/template/public/images/revslider/dummy.png' }}" alt="slidebg3" data-lazyload="{{ getWebURL() . '/template/public/images/homeslider/slide3.jpg' }}" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <div class="tp-caption sfr str" data-x="24" data-y="bottom" data-speed="900" data-start="500" data-endspeed="300">
                                    <img src="{{ asset('assets/img/slides/slide_3_1.png') }}" alt="Slide 3_1">
                                </div>

                                <div class="tp-caption sfl stl" data-x="788" data-y="95" data-speed="1000" data-start="1200" data-endspeed="540">
                                    <img src="{{ asset('assets/img/slides/slide_3_3.png') }}" alt="Slide 3_3">
                                </div>

                                <div class="tp-caption sfl stl" data-x="700" data-y="260" data-speed="800" data-start="800" data-endspeed="420">
                                    <img src="{{ getWebURL() . '/template/public/images/homeslider/slide3_2.png' }}" alt="Slide 3_2">
                                </div>

                                <div class="tp-caption sfl stl" data-x="613" data-y="325" data-speed="600" data-start="400" data-endspeed="300">
                                    <img src="{{ getWebURL() . '/template/public/images/homeslider/slide3_4.png' }}" alt="Slide 3_4">
                                </div>

                                <div class="tp-caption rev-title sfr str text-uppercase" data-x="20" data-y="56" data-speed="600" data-start="1400" data-endspeed="200">@lang('miscellaneous.public.slides.slide_3.title')</div>
                                <div class="tp-caption rev-text long sfr str" data-x="20" data-y="110" data-speed="600" data-start="1650" data-endspeed="300">@lang('miscellaneous.public.slides.slide_3.description')</div>

                                <div class="tp-caption sfr str" data-x="20" data-y="190" data-speed="600" data-start="1900" data-endspeed="400">
                                    <a href="{{ route('investor.home') }}" class="btn btn-custom-2">@lang('miscellaneous.see_more')</a>
                                </div>
                            </li>
                        </ul>
                    </div><!-- End #slider-rev -->
                </div><!-- End #slider-rev-container -->

                <div class="md-margin2x"></div><!-- Space -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-9 col-sm-8 col-xs-12 main-content">
                                    <header class="content-title">
                                        <h2 class="title">@lang('miscellaneous.public.popular_products.title')</h2>
                                        <p class="title-desc">@lang('miscellaneous.public.popular_products.description')</p>
                                    </header>

                                    <div id="products-tabs-content" class="row tab-content">
                                        <div class="tab-pane active" id="all">
    @forelse ($popular_products as $product)
        @php
            $cart = session()->get('cart', []);
            $isInCart = isset($cart[$product['id']]);
        @endphp

                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="{{ route('product.entity.datas', ['entity' => 'product', 'id' => $product['id']]) }}">
                                                                <img src="{{ count($product['photos']) > 0 ? $product['photos'][0]->file_url : getWebURL() . '/template/public/images/products/item6.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ count($product['photos']) > 0 ? (!empty($product['photos'][1]) ? $product['photos'][1]->file_url : $product['photos'][0]->file_url) : getWebURL() . '/template/public/images/products/item6-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">{{ !empty($current_user) ? (formatDecimalNumber($product['converted_price'], 3) . ' ' . $current_user->readable_currency) : $product['price'] . ' ' . $product['currency'] }}</span>
                                                        </div><!-- End .item-price-container -->
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="{{ $product['average_rating'] }}"></div>
                                                            </div><!-- End .ratings -->
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name">
                                                            <a href="{{ route('product.entity.datas', ['entity' => 'product', 'id' => $product['id']]) }}">
                                                                {{ $product['product_name'] }}
                                                            </a>
                                                        </h3>
                                                        <div id="product-{{ $product['id'] }}" class="item-action" style="height: 64px; overflow: hidden;">
        @if (!empty($current_user))
            @if ($current_user->hasProductInUnpaidCart($product['id']))
                                                            <p class="btn btn-default disabled" style="margin: -2px;">
                                                                <span class="text-uppercase" style="font-size: 12px">@lang('miscellaneous.public.product_is_in_cart')</span>
                                                            </p>
            @else
                @if ($product['quantity'] > 0)
                                                            <button class="item-add-btn" data-id="{{ $product['id'] }}" style="position: relative;">
                                                                <span id="icon-cart-text-{{ $product['id'] }}" class="icon-cart-text">@lang('miscellaneous.public.add_to_cart')</span>
                                                                <img id="ajax-loading-{{ $product['id'] }}" src="{{ asset('assets/img/ajax-loading.gif') }}" alt="@lang('miscellaneous.loading')" width="30" height="30" style="position: absolute; top: 2px; right: 43%; display: none;">
                                                            </button>
                @else
                                                            <p class="btn btn-default disabled" style="margin: -2px;">
                                                                <span class="text-uppercase">@lang('miscellaneous.public.insufficient_stock')</span>
                                                            </p>
                @endif
            @endif
        @else
            @if ($isInCart)  <!-- Vérifie si le produit est dans la session -->
                                                            <p class="btn btn-default disabled" style="margin: -2px;">
                                                                <span class="text-uppercase" style="font-size: 12px">@lang('miscellaneous.public.product_is_in_cart')</span>
                                                            </p>
            @else
                                                            <button class="item-add-btn" data-id="{{ $product['id'] }}" style="position: relative;">
                                                                <span id="icon-cart-text-{{ $product['id'] }}" class="icon-cart-text">@lang('miscellaneous.public.add_to_cart')</span>
                                                                <img id="ajax-loading-{{ $product['id'] }}" src="{{ asset('assets/img/ajax-loading.gif') }}" alt="@lang('miscellaneous.loading')" width="30" height="30" style="position: absolute; top: 2px; right: 43%; display: none;">
                                                            </button>
            @endif
        @endif
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
    @empty
                                            <div class="col-12">
                                                <p class="lead text-center strt-text-chocolate-2">@lang('miscellaneous.empty_list')</p>
                                            </div><!-- End .col-md-4 -->
    @endforelse
                                        </div><!-- End .tab-pane -->
                                    </div><!-- End #products-tabs-content -->

                                    <div class="row">
                                        <div class="col-lg-5 col-xs-12">
                                            <header class="content-title">
                                                <h2 class="title">@lang('miscellaneous.welcome_about.mission.title')</h2>
                                            </header>
                                            <p class="lead">@lang('miscellaneous.welcome_about.mission.content')</p>
                                        </div><!-- End .col-md-7 -->
                                        <div class="col-lg-7 col-xs-12">
                                            <div class="sm-margin visible-xs"></div><!-- space -->
                                            <img src="{{ asset('assets/img/about/mission.png') }}" alt="Showcase Venedor" class="img-responsive">
                                        </div><!-- End .col-md-5 -->
                                    </div><!-- End .row -->

                                    <div class="xlg-margin"></div><!-- Space -->

                                    <header class="content-title">
                                        <h2 class="title">@lang('miscellaneous.public.latest_services.title')</h2>
                                        <p class="title-desc">@lang('miscellaneous.public.latest_services.description')</p>
                                    </header>

                                    <div id="products-tabs-content" class="row tab-content">
                                        <div class="tab-pane active" id="all">
    @forelse ($popular_services as $product)
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="{{ route('product.entity.datas', ['entity' => 'product', 'id' => $product['id']]) }}">
                                                                <img src="{{ count($product['photos']) > 0 ? $product['photos'][0]->file_url : getWebURL() . '/template/public/images/products/item6.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ count($product['photos']) > 0 ? (!empty($product['photos'][1]) ? $product['photos'][1]->file_url : $product['photos'][0]->file_url) : getWebURL() . '/template/public/images/products/item6-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">{{ !empty($current_user) ? ($product['converted_price'] . ' ' . $current_user->readable_currency) : $product['price'] . ' ' . $product['currency'] }}</span>
                                                        </div><!-- End .item-price-container -->
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="{{ $product['average_rating'] }}"></div>
                                                            </div><!-- End .ratings -->
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name">
                                                            <a href="{{ route('product.entity.datas', ['entity' => 'product', 'id' => $product['id']]) }}">
                                                                {{ $product['product_name'] }}
                                                            </a>
                                                        </h3>
                                                        <div id="product-{{ $product['id'] }}" class="item-action" style="height: 64px; overflow: hidden;">
                                                            <a href="{{ route('product.entity.datas', ['entity' => 'product', 'id' => $product['id']]) }}" class="btn strt-btn-chocolate-3">
                                                                @lang('miscellaneous.see_more')
                                                            </a>
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
    @empty
                                            <div class="col-12">
                                                <p class="lead text-center strt-text-chocolate-2">@lang('miscellaneous.empty_list')</p>
                                            </div><!-- End .col-md-4 -->
    @endforelse
                                        </div><!-- End .tab-pane -->
                                    </div><!-- End #products-tabs-content -->

                                    <div class="sm-margin"></div><!-- Space -->

                                </div><!-- End .col-md-9 -->

                                <div class="col-md-3 col-sm-4 col-xs-12 sidebar">
                                    <div class="widget testimonials">
                                        <h3 class="text-uppercase">@lang('miscellaneous.menu.discussions')</h3>

                                        <div class="testimonials-slider flexslider sidebarslider">
                                            <ul class="testimonials-list clearfix">
    @forelse ($comments_posts as $comment)
        @php
            $parentPost = \App\Models\Post::find($comment['answered_for']);
        @endphp
                                                <li>
                                                    <div class="testimonial-details">{!! Str::limit($comment['posts_content'], 100) !!}</div><!-- End .testimonial-details -->
                                                    <figure class="clearfix">
                                                        <img src="{{ $comment['user']['avatar_url'] }}" alt="{{ $comment['user']['firstname'] . ' ' . $comment['user']['lastname'] }}" width="75" height="75">
                                                        <figcaption>
                                                            <a href="{{ route('discussion.datas', ['id' => $parentPost->id]) }}">{{ $comment['user']['firstname'] . ' ' . $comment['user']['lastname'] }}</a>
                                                            <span>{{ \Carbon\Carbon::parse($comment['created_at'])->format('d.m.Y') }}</span>
                                                        </figcaption>
                                                    </figure>
                                                </li>
    @empty
                                                <li><i class="strt-text-chocolate-3">@lang('miscellaneous.empty_list')</i></li>
    @endforelse
                                            </ul>
                                        </div><!-- End .testimonials-slider -->
                                    </div><!-- End .widget -->


                                    <div class="widget latest-posts">
                                        <h3>@lang('miscellaneous.public.latest_news.title')</h3>

                                        <div class="latest-posts-slider flexslider sidebarslider">
                                            <ul class="latest-posts-list clearfix">
    @forelse ($news_posts as $news)
                                                <li>
                                                    <a href="{{ route('discussion.datas', ['id' => $news['id']]) }}">
                                                        <figure class="latest-posts-media-container">
                                                            <img class="img-responsive" src="{{ $news['photos'][0]['file_url'] ?? getWebURL() . '/template/public/images/blog/post1-small.jpg' }}" alt="lats post" style="width: 100%; height: 120px; object-fit: cover;">
                                                        </figure>
                                                    </a>
                                                    <h4><a href="{{ route('discussion.datas', ['id' => $news['id']]) }}">{{ $news['posts_title'] }}</a></h4>
                                                    <p>{!! Str::limit($news['posts_content'], 100) !!}</p>
                                                    <div class="latest-posts-meta-container clearfix">
                                                        <div class="pull-left">
                                                            <a href="{{ route('discussion.datas', ['id' => $news['id']]) }}">@lang('miscellaneous.see_more')...</a>
                                                        </div><!-- End .pull-left -->
                                                        <div class="pull-right">
                                                            {{ \Carbon\Carbon::parse($news['created_at'])->format('d.m.Y') }}
                                                        </div><!-- End .pull-right -->
                                                    </div><!-- End .latest-posts-meta-container -->
                                                </li>
    @empty
                                                <li><i class="strt-text-chocolate-3">@lang('miscellaneous.empty_list')</i></li>
    @endforelse
                                            </ul>
                                        </div><!-- End .latest-posts-slider -->
                                    </div><!-- End .widget -->

                                    <div class="widget banner-slider-container">
                                        <div class="banner-slider flexslider">
                                            <ul class="banner-slider-list clearfix">
                                                <li><a href="#"><img src="{{ asset('assets/img/gallery/ad001.png') }}" alt="Banner 1"></a></li>
                                                <li><a href="#"><img src="{{ asset('assets/img/gallery/ad002.png') }}" alt="Banner 2"></a></li>
                                                <li><a href="#"><img src="{{ asset('assets/img/gallery/ad003.png') }}" alt="Banner 3"></a></li>
                                                <li><a href="#"><img src="{{ asset('assets/img/gallery/ad004.png') }}" alt="Banner 4"></a></li>
                                            </ul>
                                        </div>
                                    </div><!-- End .widget -->

                                </div><!-- End .col-md-3 -->
                            </div><!-- End .row -->

                            <div id="brand-slider-container" class="carousel-wrapper">
                                <header class="content-title">
                                    <div class="title-bg">
                                        <h2 class="title">@lang('miscellaneous.public.our_partners')</h2>
                                    </div><!-- End .title-bg -->
                                </header>
                                <div class="carousel-controls">
                                    <div id="brand-slider-prev" class="carousel-btn carousel-btn-prev">
                                    </div><!-- End .carousel-prev -->
                                    <div id="brand-slider-next" class="carousel-btn carousel-btn-next carousel-space">
                                    </div><!-- End .carousel-next -->
                                </div><!-- End .carousel-controllers -->
                                <div class="sm-margin"></div><!-- space -->
                                <div class="row">
                                    <div class="brand-slider owl-carousel">
    @for ($i = 0; $i < 10; $i++)
                                        <a href="" target="_blank" style="min-height: 100px;"><img src="{{ asset('assets/img/partners/partner-' . $i . '.jpg') }}" alt="Brand Logo 1"></a>
    @endfor
                                    </div><!-- End .brand-slider -->
                                </div><!-- End .row -->
                            </div><!-- End #brand-slider-container -->

                        </div><!-- End .col-md-12 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->

            </section><!-- End #content -->


@endsection
