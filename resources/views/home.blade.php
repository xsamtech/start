@extends('layouts.app', ['page_title' => __('miscellaneous.menu.home')])

@section('app-content')


            <section id="content">
                <div id="slider-rev-container">
                    <div id="slider-rev">
                        <ul>
                            <li data-transition="fade" data-slotamount="6" data-masterspeed="600" data-saveperformance="on" data-title="Special Offers">
                                <img src="{{ getWebURL() . '/template/public/images/revslider/dummy.png' }}" alt="slidebg1" data-lazyload="{{ getWebURL() . '/template/public/images/homeslider/slide1.png' }}" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <div class="tp-caption rev-title lfr ltr" data-x="695" data-y="198" data-speed="1600" data-start="300" data-endspeed="300">OFFRE SPÉCIALE -25%</div>
                                <div class="tp-caption rev-text lfr ltr" data-x="695" data-y="252" data-speed="1600" data-start="600" data-endspeed="550">Lorem ipsum dolor sit amet.</div>

                                <div class="tp-caption lfr ltr" data-x="695" data-y="332" data-speed="1600" data-start="900" data-endspeed="800">
                                    <a href="#" class="btn btn-custom-2">@lang('miscellaneous.see_more')</a>
                                </div>
                                <div class="tp-caption lfl ltl" data-x="center" data-y="bottom" data-hoffset="-230" data-speed="2000" data-start="500" data-endspeed="800">
                                    <img src="{{ getWebURL() . '/template/public/images/homeslider/slide1_1.png' }}" alt="Slide 1_1">
                                </div>
                            </li>
                            <li data-transition="fade" data-slotamount="5" data-masterspeed="600" data-saveperformance="on" data-title="Learn More">
                                <img src="{{ getWebURL() . '/template/public/images/revslider/dummy.png' }}" alt="slidebg2" data-lazyload="{{ getWebURL() . '/template/public/images/homeslider/slide2.jpg' }}" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <div class="tp-caption rev-title lfr ltr" data-x="755" data-y="238" data-speed="1600" data-start="750" data-endspeed="300" style="z-index: 9999">The Next Big thing...</div>
                                <div class="tp-caption rev-text2 lfr ltr" data-x="755" data-y="290" data-speed="1600" data-start="1050" data-endspeed="550" style="z-index: 9999">Take, view and share photos with <br> the 13MP camera and stunning 5" display.</div>

                                <div class="tp-caption lfr ltr" data-x="755" data-y="360" data-speed="1600" data-start="1350" data-endspeed="800">
                                    <a href="#" class="btn btn-custom-2" style="z-index: 9999">Learn More</a>
                                </div>

                                <div class="tp-caption rev-price randomrotate randomrotateout" data-x="360" data-y="55" data-speed="1200" data-start="2000" data-endspeed="400">
                                    $1150
                                </div>

                                <div class="tp-caption lfl ltl" data-x="center" data-y="center" data-hoffset="-204" data-speed="1750" data-start="400" data-endspeed="800">
                                    <img src="{{ getWebURL() . '/template/public/images/homeslider/slide2_2.png' }}" alt="Slide 2_2">
                                </div>

                                <div class="tp-caption lfr ltr" data-x="380" data-y="50" data-speed="1800" data-start="250" data-endspeed="800">
                                    <img src="{{ getWebURL() . '/template/public/images/homeslider/slide2_1.png' }}" alt="Slide 2_1">
                                </div>
                            </li>

                            <li data-transition="fade" data-slotamount="4" data-masterspeed="600" data-saveperformance="on" data-title="More Features">
                                <img src="{{ getWebURL() . '/template/public/images/revslider/dummy.png' }}" alt="slidebg3" data-lazyload="{{ getWebURL() . '/template/public/images/homeslider/slide3.jpg' }}" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <div class="tp-caption sfr str" data-x="24" data-y="bottom" data-speed="900" data-start="500" data-endspeed="300">
                                    <img src="{{ getWebURL() . '/template/public/images/homeslider/slide3_1.png' }}" alt="Slide 3_1">
                                </div>

                                <div class="tp-caption sfl stl" data-x="788" data-y="95" data-speed="1000" data-start="1200" data-endspeed="540">
                                    <img src="{{ getWebURL() . '/template/public/images/homeslider/slide3_3.png' }}" alt="Slide 3_3">
                                </div>

                                <div class="tp-caption sfl stl" data-x="700" data-y="260" data-speed="800" data-start="800" data-endspeed="420">
                                    <img src="{{ getWebURL() . '/template/public/images/homeslider/slide3_2.png' }}" alt="Slide 3_2">
                                </div>

                                <div class="tp-caption sfl stl" data-x="613" data-y="325" data-speed="600" data-start="400" data-endspeed="300">
                                    <img src="{{ getWebURL() . '/template/public/images/homeslider/slide3_4.png' }}" alt="Slide 3_4">
                                </div>

                                <div class="tp-caption rev-title sfr str" data-x="20" data-y="56" data-speed="600" data-start="1400" data-endspeed="200">CONTROL. NAVIGATE. BE RECOGNIZED.</div>
                                <div class="tp-caption rev-text long sfr str" data-x="20" data-y="110" data-speed="600" data-start="1650" data-endspeed="300">Smart Interaction lets you interact <br> with your TV as never before.</div>

                                <div class="tp-caption sfr str" data-x="20" data-y="190" data-speed="600" data-start="1900" data-endspeed="400">
                                    <a href="#" class="btn btn-custom-2">Learn More</a>
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
                                    {{-- <ul id="products-tabs-list" class="tab-style-1 clearfix">
                                        <li class="active"><a href="#all" data-toggle="tab">All</a></li>
                                        <li><a href="#latest" data-toggle="tab">Latest</a></li>
                                        <li><a href="#featured" data-toggle="tab">Featured</a></li>
                                        <li><a href="#bestsellers" data-toggle="tab">Bestsellers</a></li>
                                        <li><a href="#special" data-toggle="tab">Special</a></li>
                                    </ul> --}}

                                    <div id="products-tabs-content" class="row tab-content">
                                        <div class="tab-pane active" id="all">
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item5.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item5-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$210<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$160<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                        <span class="discount-rect">-15%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="80"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">
                                                                5 Reviews
                                                            </span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#"
                                                                    class="icon-button icon-like">Favourite</a>
                                                                <a href="#"
                                                                    class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item6.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item6-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$199</span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="74"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">9 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item7.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item7-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$120<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$99<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="discount-rect">-25%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="90"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">4 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item10.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item10-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$180<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">

                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item8.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item8-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$99<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$84<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="discount-rect">-20%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="70"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">6 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item8.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item8-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$49<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="60"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">2 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                        </div><!-- End .tab-pane -->

                                        <div class="tab-pane" id="latest">
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item8.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item8-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$160<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="80"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">5 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item3.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item3-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$200</span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="discount-rect">-10%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="74"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">9 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item5.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item5-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$120<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$99<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="96"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">5 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#"
                                                                    class="icon-button icon-like">Favourite</a>
                                                                <a href="#"
                                                                    class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item3.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item3-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$99<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">

                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item7.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item7-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$99<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$84<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="discount-rect">-30%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="70"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">6 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#"
                                                                    class="icon-button icon-like">Favourite</a>
                                                                <a href="#"
                                                                    class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item5.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item5-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$49<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="60"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">2 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                        </div><!-- End .tab-pane -->

                                        <div class="tab-pane" id="featured">
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item1.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item1-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$210<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$140<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                        <span class="discount-rect">-25%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="50"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">3 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item4.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item4-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$399</span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="100"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">7 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item8.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item8-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$120<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$89<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="discount-rect">-35%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="50"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">2 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#"
                                                                    class="icon-button icon-like">Favourite</a>
                                                                <a href="#"
                                                                    class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item10.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item10-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$180<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">

                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item6.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item6-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$99<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$84<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="discount-rect">-20%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="70"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">6 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#"
                                                                    class="icon-button icon-like">Favourite</a>
                                                                <a href="#"
                                                                    class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item5.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item5-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$49<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="60"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">2 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                        </div><!-- End .tab-pane -->

                                        <div class="tab-pane" id="bestsellers">
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item3.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item3-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$210<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$160<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                        <span class="discount-rect">-15%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="80"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">5 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item4.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item4-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$199</span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="74"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">9 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#"
                                                                    class="icon-button icon-like">Favourite</a>
                                                                <a href="#"
                                                                    class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item2.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item2-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$180<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$99<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="discount-rect">-50%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="90"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">4 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#"
                                                                    class="icon-button icon-like">Favourite</a>
                                                                <a href="#"
                                                                    class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item9.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item9-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$180<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">

                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#"
                                                                    class="icon-button icon-like">Favourite</a>
                                                                <a href="#"
                                                                    class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item5.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item5-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$99<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$84<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="discount-rect">-20%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="70"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">6 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item3.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item3-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$99<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="60"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">2 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#"
                                                                    class="icon-button icon-like">Favourite</a>
                                                                <a href="#"
                                                                    class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                        </div><!-- End .tab-pane -->

                                        <div class="tab-pane" id="special">
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item2.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item2-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$210<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$160<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                        <span class="discount-rect">-15%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="80"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">5 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item1.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item1-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$199</span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="74"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">9 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item4.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item4-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$120<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$99<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="discount-rect">-25%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="90"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">4 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item10.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item10-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$180<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">

                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item6.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item6-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="old-price">$99<span class="sub-price">.99</span></span>
                                                            <span class="item-price">$84<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="discount-rect">-20%</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="70"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">6 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="product.html">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item9.jpg' }}" alt="item1" class="item-image">
                                                                <img src="{{ getWebURL() . '/template/public/images/products/item9-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                            <span class="item-price">$49<span class="sub-price">.99</span></span>
                                                        </div><!-- End .item-price-container -->
                                                        <span class="new-rect">New</span>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-result" data-result="60"></div>
                                                            </div><!-- End .ratings -->
                                                            <span class="ratings-amount">2 Reviews</span>
                                                        </div><!-- End .rating-container -->
                                                        <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text">Add to Cart</span>
                                                            </a>
                                                            <div class="item-action-inner">
                                                                <a href="#" class="icon-button icon-like">Favourite</a>
                                                                <a href="#" class="icon-button icon-compare">Checkout</a>
                                                            </div><!-- End .item-action-inner -->
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container -->
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->

                                        </div><!-- End .tab-pane -->
                                    </div><!-- End #products-tabs-content -->

                                    <div class="sm-margin"></div><!-- Space -->
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <header class="content-title">
                                                <h2 class="title">@lang('miscellaneous.welcome')</h2>
                                            </header>
                                            <p class="lead">La portée du projet inclut l’ensemble des acteurs de la chaîne de valeur agricole en RDC. La plateforme doit couvrir toutes les étapes, de la production agricole jusqu'à la commercialisation des produits finis.</p>
                                        </div><!-- End .col-md-7 -->
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="sm-margin visible-xs"></div><!-- space -->
                                            <img src="{{ asset('assets/img/logo-text.png') }}" alt="Showcase Venedor" class="img-fluid">
                                        </div><!-- End .col-md-5 -->
                                    </div><!-- End .row -->
                                    <div class="xlg-margin"></div><!-- Space -->

                                    <div class="hot-items carousel-wrapper">
                                        <header class="content-title">
                                            <div class="title-bg">
                                                <h2 class="title">@lang('miscellaneous.public.latest_investor.title')</h2>
                                            </div><!-- End .title-bg -->
                                            <p class="title-desc">@lang('miscellaneous.public.latest_investor.description')</p>
                                        </header>

                                        <div class="carousel-controls">
                                            <div id="hot-items-slider-prev" class="carousel-btn carousel-btn-prev">
                                            </div><!-- End .carousel-prev -->
                                            <div id="hot-items-slider-next" class="carousel-btn carousel-btn-next carousel-space">
                                            </div><!-- End .carousel-next -->
                                        </div><!-- End .carousel-controls -->
                                        <div class="hot-items-slider owl-carousel">
                                            <div class="item item-hover">
                                                <div class="item-image-wrapper">
                                                    <figure class="item-image-container">
                                                        <a href="product.html">
                                                            <img src="{{ getWebURL() . '/template/public/images/products/item2.jpg' }}" alt="item1" class="item-image">
                                                            <img src="{{ getWebURL() . '/template/public/images/products/item2-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                        </a>
                                                    </figure>
                                                    {{-- <div class="item-price-container">
                                                        <span class="item-price">$160<span class="sub-price">.99</span></span>
                                                    </div><!-- End .item-price-container -->
                                                    <span class="new-rect">New</span> --}}
                                                </div><!-- End .item-image-wrapper -->
                                                <div class="item-meta-container">
                                                    <div class="ratings-container">
                                                        <div class="ratings">
                                                            <div class="ratings-result" data-result="80"></div>
                                                        </div><!-- End .ratings -->
                                                        <span class="ratings-amount">Daniel Craig</span>
                                                    </div><!-- End .rating-container -->
                                                    <h3 class="item-name"><a href="{{ route('investor.datas', ['id' => 1]) }}">@lang('miscellaneous.details')</a></h3>
                                                    {{-- <div class="item-action">
                                                        <a href="#" class="item-add-btn">
                                                            <span class="icon-cart-text">Add to Cart</span>
                                                        </a>
                                                        <div class="item-action-inner">
                                                            <a href="#"
                                                                class="icon-button icon-like">Favourite</a>
                                                            <a href="#"
                                                                class="icon-button icon-compare">Checkout</a>
                                                        </div><!-- End .item-action-inner -->
                                                    </div><!-- End .item-action --> --}}
                                                </div><!-- End .item-meta-container -->
                                            </div><!-- End .item -->

                                            <div class="item item-hover">
                                                <div class="item-image-wrapper">
                                                    <figure class="item-image-container">
                                                        <a href="product.html">
                                                            <img src="{{ getWebURL() . '/template/public/images/products/item3.jpg' }}" alt="item1" class="item-image">
                                                            <img src="{{ getWebURL() . '/template/public/images/products/item3-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                        </a>
                                                    </figure>
                                                    {{-- <div class="item-price-container">
                                                        <span class="item-price">$160<span class="sub-price">.99</span></span>
                                                    </div><!-- End .item-price-container -->
                                                    <span class="new-rect">New</span> --}}
                                                </div><!-- End .item-image-wrapper -->
                                                <div class="item-meta-container">
                                                    <div class="ratings-container">
                                                        <div class="ratings">
                                                            <div class="ratings-result" data-result="80"></div>
                                                        </div><!-- End .ratings -->
                                                        <span class="ratings-amount">Daniel Craig</span>
                                                    </div><!-- End .rating-container -->
                                                    <h3 class="item-name"><a href="{{ route('investor.datas', ['id' => 1]) }}">@lang('miscellaneous.details')</a></h3>
                                                    {{-- <div class="item-action">
                                                        <a href="#" class="item-add-btn">
                                                            <span class="icon-cart-text">Add to Cart</span>
                                                        </a>
                                                        <div class="item-action-inner">
                                                            <a href="#"
                                                                class="icon-button icon-like">Favourite</a>
                                                            <a href="#"
                                                                class="icon-button icon-compare">Checkout</a>
                                                        </div><!-- End .item-action-inner -->
                                                    </div><!-- End .item-action --> --}}
                                                </div><!-- End .item-meta-container -->
                                            </div><!-- End .item -->

                                            <div class="item item-hover">
                                                <div class="item-image-wrapper">
                                                    <figure class="item-image-container">
                                                        <a href="product.html">
                                                            <img src="{{ getWebURL() . '/template/public/images/products/item8.jpg' }}" alt="item1" class="item-image">
                                                            <img src="{{ getWebURL() . '/template/public/images/products/item8-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                        </a>
                                                    </figure>
                                                    {{-- <div class="item-price-container">
                                                        <span class="item-price">$160<span class="sub-price">.99</span></span>
                                                    </div><!-- End .item-price-container -->
                                                    <span class="new-rect">New</span> --}}
                                                </div><!-- End .item-image-wrapper -->
                                                <div class="item-meta-container">
                                                    <div class="ratings-container">
                                                        <div class="ratings">
                                                            <div class="ratings-result" data-result="80"></div>
                                                        </div><!-- End .ratings -->
                                                        <span class="ratings-amount">Daniel Craig</span>
                                                    </div><!-- End .rating-container -->
                                                    <h3 class="item-name"><a href="{{ route('investor.datas', ['id' => 1]) }}">@lang('miscellaneous.details')</a></h3>
                                                    {{-- <div class="item-action">
                                                        <a href="#" class="item-add-btn">
                                                            <span class="icon-cart-text">Add to Cart</span>
                                                        </a>
                                                        <div class="item-action-inner">
                                                            <a href="#"
                                                                class="icon-button icon-like">Favourite</a>
                                                            <a href="#"
                                                                class="icon-button icon-compare">Checkout</a>
                                                        </div><!-- End .item-action-inner -->
                                                    </div><!-- End .item-action --> --}}
                                                </div><!-- End .item-meta-container -->
                                            </div><!-- End .item -->

                                            <div class="item item-hover">
                                                <div class="item-image-wrapper">
                                                    <figure class="item-image-container">
                                                        <a href="product.html">
                                                            <img src="{{ getWebURL() . '/template/public/images/products/item-5.jpg' }}" alt="item1" class="item-image">
                                                            <img src="{{ getWebURL() . '/template/public/images/products/item-5-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                        </a>
                                                    </figure>
                                                    {{-- <div class="item-price-container">
                                                        <span class="item-price">$160<span class="sub-price">.99</span></span>
                                                    </div><!-- End .item-price-container -->
                                                    <span class="new-rect">New</span> --}}
                                                </div><!-- End .item-image-wrapper -->
                                                <div class="item-meta-container">
                                                    <div class="ratings-container">
                                                        <div class="ratings">
                                                            <div class="ratings-result" data-result="80"></div>
                                                        </div><!-- End .ratings -->
                                                        <span class="ratings-amount">Daniel Craig</span>
                                                    </div><!-- End .rating-container -->
                                                    <h3 class="item-name"><a href="{{ route('investor.datas', ['id' => 1]) }}">@lang('miscellaneous.details')</a></h3>
                                                    {{-- <div class="item-action">
                                                        <a href="#" class="item-add-btn">
                                                            <span class="icon-cart-text">Add to Cart</span>
                                                        </a>
                                                        <div class="item-action-inner">
                                                            <a href="#"
                                                                class="icon-button icon-like">Favourite</a>
                                                            <a href="#"
                                                                class="icon-button icon-compare">Checkout</a>
                                                        </div><!-- End .item-action-inner -->
                                                    </div><!-- End .item-action --> --}}
                                                </div><!-- End .item-meta-container -->
                                            </div><!-- End .item -->

                                            <div class="item item-hover">
                                                <div class="item-image-wrapper">
                                                    <figure class="item-image-container">
                                                        <a href="product.html">
                                                            <img src="{{ getWebURL() . '/template/public/images/products/item7.jpg' }}" alt="item1" class="item-image">
                                                            <img src="{{ getWebURL() . '/template/public/images/products/item7-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                        </a>
                                                    </figure>
                                                    {{-- <div class="item-price-container">
                                                        <span class="item-price">$160<span class="sub-price">.99</span></span>
                                                    </div><!-- End .item-price-container -->
                                                    <span class="new-rect">New</span> --}}
                                                </div><!-- End .item-image-wrapper -->
                                                <div class="item-meta-container">
                                                    <div class="ratings-container">
                                                        <div class="ratings">
                                                            <div class="ratings-result" data-result="80"></div>
                                                        </div><!-- End .ratings -->
                                                        <span class="ratings-amount">Daniel Craig</span>
                                                    </div><!-- End .rating-container -->
                                                    <h3 class="item-name"><a href="{{ route('investor.datas', ['id' => 1]) }}">@lang('miscellaneous.details')</a></h3>
                                                    {{-- <div class="item-action">
                                                        <a href="#" class="item-add-btn">
                                                            <span class="icon-cart-text">Add to Cart</span>
                                                        </a>
                                                        <div class="item-action-inner">
                                                            <a href="#"
                                                                class="icon-button icon-like">Favourite</a>
                                                            <a href="#"
                                                                class="icon-button icon-compare">Checkout</a>
                                                        </div><!-- End .item-action-inner -->
                                                    </div><!-- End .item-action --> --}}
                                                </div><!-- End .item-meta-container -->
                                            </div><!-- End .item -->
                                        </div><!--hot-items-slider -->

                                        <div class="lg-margin"></div><!-- Space -->
                                    </div><!-- End .hot-items -->
                                </div><!-- End .col-md-9 -->

                                <div class="col-md-3 col-sm-4 col-xs-12 sidebar">
                                    <div class="widget testimonials">
                                        <h3 class="text-uppercase">@lang('miscellaneous.menu.discussions')</h3>

                                        <div class="testimonials-slider flexslider sidebarslider">
                                            <ul class="testimonials-list clearfix">
                                                <li>
                                                    <div class="testimonial-details">
                                                        {{-- <header>Best Service!</header> --}}
                                                        Maecenas semper aliquam massa. Praesent pharetra sem vitae nisi
                                                        eleifend molestie. Aliquam molestie scelerisque ultricies.
                                                        Suspendisse potenti.
                                                    </div><!-- End .testimonial-details -->
                                                    <figure class="clearfix">
                                                        <img src="{{ getWebURL() . '/template/public/images/testimonials/anna.jpg' }}" alt="Computer Ceo">
                                                        <figcaption>
                                                            <a href="#">Anna Retallic</a>
                                                            <span>12.05.2013</span>
                                                        </figcaption>
                                                    </figure>
                                                </li>
                                                <li>
                                                    <div class="testimonial-details">
                                                        {{-- <header>Cool Style!</header> --}}
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt iure
                                                        quisquam necessitatibus fugit! Nisi tempora reiciendis omnis error
                                                        sapiente ipsam maiores dolorem maxime.
                                                    </div><!-- End .testimonial-details -->
                                                    <figure class="clearfix">
                                                        <img src="{{ getWebURL() . '/template/public/images/testimonials/jake.jpg' }}" alt="Computer Ceo">
                                                        <figcaption>
                                                            <a href="#">Jake Suasoo</a>
                                                            <span>17.05.2013</span>
                                                        </figcaption>
                                                    </figure>
                                                </li>
                                            </ul>
                                        </div><!-- End .testimonials-slider -->
                                    </div><!-- End .widget -->


                                    <div class="widget latest-posts">
                                        <h3>@lang('miscellaneous.public.latest_news.title')</h3>

                                        <div class="latest-posts-slider flexslider sidebarslider">
                                            <ul class="latest-posts-list clearfix">
                                                <li>
                                                    <a href="single.html">
                                                        <figure class="latest-posts-media-container">
                                                            <img class="img-responsive" src="{{ getWebURL() . '/template/public/images/blog/post1-small.jpg' }}" alt="lats post">
                                                        </figure>
                                                    </a>
                                                    <h4><a href="single.html">35% Discount on second purchase!</a></h4>
                                                    <p>Sed blandit nulla nec nunc ullamcorper tristique. Mauris adipiscing
                                                        cursus ante ultricies dictum sed lobortis.</p>
                                                    <div class="latest-posts-meta-container clearfix">
                                                        <div class="pull-left">
                                                            <a href="#">Read More...</a>
                                                        </div><!-- End .pull-left -->
                                                        <div class="pull-right">
                                                            12.05.2013
                                                        </div><!-- End .pull-right -->
                                                    </div><!-- End .latest-posts-meta-container -->
                                                </li>

                                                <li>
                                                    <a href="single.html">
                                                        <figure class="latest-posts-media-container">
                                                            <img class="img-responsive" src="{{ getWebURL() . '/template/public/images/blog/post2-small.jpg' }}" alt="lats post">
                                                        </figure>
                                                    </a>
                                                    <h4><a href="single.html">Free shipping for regular customers.</a>
                                                    </h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque
                                                        fuga officia in molestiae easint..</p>
                                                    <div class="latest-posts-meta-container clearfix">
                                                        <div class="pull-left">
                                                            <a href="#">Read More...</a>
                                                        </div><!-- End .pull-left -->
                                                        <div class="pull-right">
                                                            10.05.2013
                                                        </div><!-- End .pull-right -->
                                                    </div><!-- End .latest-posts-meta-container -->
                                                </li>

                                                <li>
                                                    <a href="single.html">
                                                        <figure class="latest-posts-media-container">
                                                            <img class="img-responsive" src="{{ getWebURL() . '/template/public/images/blog/post3-small.jpg' }}" alt="lats post">
                                                        </figure>
                                                    </a>
                                                    <h4><a href="#">New jeans on sales!</a></h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque
                                                        fuga officia in molestiae easint..</p>
                                                    <div class="latest-posts-meta-container clearfix">
                                                        <div class="pull-left">
                                                            <a href="#">Read More...</a>
                                                        </div><!-- End .pull-left -->
                                                        <div class="pull-right">
                                                            8.05.2013
                                                        </div><!-- End .pull-right -->
                                                    </div><!-- End .latest-posts-meta-container -->
                                                </li>

                                            </ul>
                                        </div><!-- End .latest-posts-slider -->
                                    </div><!-- End .widget -->

                                    <div class="widget banner-slider-container">
                                        <div class="banner-slider flexslider">
                                            <ul class="banner-slider-list clearfix">
                                                <li><a href="#"><img src="{{ getWebURL() . '/template/public/images/banner1.jpg' }}" alt="Banner 1"></a></li>
                                                <li><a href="#"><img src="{{ getWebURL() . '/template/public/images/banner2.jpg' }}" alt="Banner 2"></a></li>
                                                <li><a href="#"><img src="{{ getWebURL() . '/template/public/images/banner3.jpg' }}" alt="Banner 3"></a></li>
                                            </ul>
                                        </div>
                                    </div><!-- End .widget -->

                                </div><!-- End .col-md-3 -->
                            </div><!-- End .row -->

                            <div id="brand-slider-container" class="carousel-wrapper">
                                <header class="content-title">
                                    <div class="title-bg">
                                        <h2 class="title">Manufacturers</h2>
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
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 1"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 2"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 3"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 4"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 5"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 6"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 7"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 8"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 9"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 10"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 11"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 12"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 13"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 14"></a>
                                        <a href="" target="_blank"><img src="{{ getWebURL() . '/template/public/images/brands/brand-logo.png' }}" alt="Brand Logo 15"></a>
                                    </div><!-- End .brand-slider -->
                                </div><!-- End .row -->
                            </div><!-- End #brand-slider-container -->

                        </div><!-- End .col-md-12 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->

            </section><!-- End #content -->


@endsection
