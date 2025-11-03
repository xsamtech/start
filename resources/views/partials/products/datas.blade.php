
			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li><a href="{{ route('product.entity', ['entity' => $entity]) }}">{{ $entity_title }}</a></li>
							<li class="active">{{ $selected_product->product_name }}</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<header class="content-title">
								<h1 class="title" style="margin-bottom: 5px;">{{ $selected_product->product_name }}</h1>
@switch($entity)
    @case('service')
								<p class="title-desc">{{ __('miscellaneous.admin.product.details', ['entity' => __('miscellaneous.admin.product.entity.service.singular')]) }}</p>
        @break
    @case('project')
								<p class="title-desc">{{ __('miscellaneous.admin.product.details', ['entity' => __('miscellaneous.admin.product.entity.project.singular')]) }}</p>
        @break
    @default
								<p class="title-desc">{{ __('miscellaneous.admin.product.details', ['entity' => __('miscellaneous.admin.product.entity.product.singular')]) }}</p>
@endswitch
							</header>

							<div class="row" data-maxcolumn="2" data-layoutmode="fitRows">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12 product-viewer clearfix">
											<div id="product-image-carousel-container">
												<ul id="product-carousel" class="celastislide-list">
@foreach ($selected_product->photos as $photo)
													<li class="{{ $loop->index == 0 ? 'active-slide' : '' }}">
														<a data-rel='prettyPhoto[product]' href="{{ $photo->file_url ?? getWebURL() . '/template/public/images/products/big-item1.jpg' }}" data-image="{{ $photo->file_url ?? getWebURL() . '/template/public/images/products/big-item1.jpg' }}" data-zoom-image="{{ $photo->file_url ?? getWebURL() . '/template/public/images/products/big-item1.jpg' }}" class="product-gallery-item">
															<img src="{{ $photo->file_url ?? getWebURL() . '/template/public/images/products/thumbnails/item10.jpg' }}" alt="Photo {{ $loop->index }}">
														</a>
													</li>
@endforeach

												</ul><!-- End product-carousel -->
											</div>

											<div id="product-image-container">
												<figure>
													<img src="{{ $selected_product->photos[0]->file_url ?? getWebURL() . '/template/public/images/products/big-item1.jpg' }}" data-zoom-image="{{ $selected_product->photos[0]->file_url ?? getWebURL() . '/template/public/images/products/big-item1.jpg' }}" alt="Product Big image" id="product-image">
												</figure>
											</div><!-- product-image-container -->
										</div><!-- End .col-md-6 -->

										<div class="col-md-6 col-sm-12 col-xs-12 product">
											<div class="lg-margin visible-sm visible-xs"></div><!-- Space -->
											<h1 class="product-name">{{ $selected_product->product_name }}</h1>
											{{-- <div class="ratings-container">
												<div class="ratings separator">
													<div class="ratings-result" data-result="70"></div>
												</div><!-- End .ratings -->
												<a href="#review" class="rate-this">@lang('miscellaneous.public.add_rating')</a>
											</div><!-- End .rating-container --> --}}
											<ul class="product-list">
												<li><span>@lang('miscellaneous.admin.product.data.' . $selected_product->type . '_price')</span>@lang('miscellaneous.colon_after_word') {{ !empty($current_user) ? ($selected_product->price . ' ' . $current_user->readable_currency) : $selected_product->price . ' ' . $selected_product->currency }}</li>
												<li><span>@lang('miscellaneous.admin.product.data.quantity')</span>@lang('miscellaneous.colon_after_word') {{ $selected_product->quantity }}</li>
												<li><span>@lang('miscellaneous.admin.product.data.product_description')</span> <br>{{ $selected_product->product_description }}</li>
											</ul>
											<hr>
											<div class="product-add clearfix">
										{{-- <button class="btn btn-custom-2">@lang('miscellaneous.public.add_to_cart')</button> --}}
    @if (!empty($current_user))
        @if ($current_user->hasProductInUnpaidCart($selected_product->id))
                                                            <p class="btn btn-default disabled" style="margin: -2px;">
                                                                <span class="text-uppercase" style="font-size: 12px">@lang('miscellaneous.public.product_is_in_cart')</span>
                                                            </p>
        @else
            @if ($selected_product->quantity > 0)
                                                            <button class="item-add-btn" data-id="{{ $selected_product->id }}" style="position: relative;">
                                                                <span id="icon-cart-text-{{ $selected_product->id }}" class="icon-cart-text">@lang('miscellaneous.public.add_to_cart')</span>
                                                                <img id="ajax-loading-{{ $selected_product->id }}" src="{{ asset('assets/img/ajax-loading.gif') }}" alt="@lang('miscellaneous.loading')" width="30" height="30" style="position: absolute; top: 2px; right: 43%; display: none;">
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
                                                            <button class="item-add-btn" data-id="{{ $selected_product['id'] }}" style="position: relative;">
                                                                <span id="icon-cart-text-{{ $selected_product['id'] }}" class="icon-cart-text">@lang('miscellaneous.public.add_to_cart')</span>
                                                                <img id="ajax-loading-{{ $selected_product['id'] }}" src="{{ asset('assets/img/ajax-loading.gif') }}" alt="@lang('miscellaneous.loading')" width="30" height="30" style="position: absolute; top: 2px; right: 43%; display: none;">
                                                            </button>
        @endif
    @endif
	@if ($selected_product->user_id == $current_user->id)
															<button class="btn btn-custom-1" data-toggle="modal" data-target="#updateProductModal">@lang('miscellaneous.update')</button>
	@endif
											</div><!-- .product-add -->
											<hr>

											<div class="panel panel-default">
												<div class="panel-heading">
													<h6 style="margin: 0;">@lang('miscellaneous.public.report_product')</h6>
												</div>
												<div class="panel-body">
													<form action="{{ route('product.entity', ['entity' => 'feedback']) }}" method="POST">
	@csrf
														<input type="hidden" name="for_product_id" value="{{ $selected_product->id }}">
														<textarea name="comment" id="comment" class="form-control" placeholder="@lang('miscellaneous.admin.post.data.type.message') ..."></textarea>

														<button class="btn strt-btn-chocolate-3" style="width: 200px; margin-top: 20px;">@lang('miscellaneous.send')</button>
													</form>
												</div>
											</div>
										</div><!-- End .col-md-6 -->

							</div><!-- End .row -->
{{-- 
							<div class="lg-margin2x"></div><!-- End .space -->

							<div class="purchased-items-container carousel-wrapper">
								<header class="content-title">
									<div class="title-bg">
										<h2 class="title">@lang('miscellaneous.public.related_product')</h2>
									</div><!-- End .title-bg -->
									<p class="title-desc">Note the similar products - after buying for more
										than $500 you can get a discount.</p>
								</header>

								<div class="carousel-controls">
									<div id="purchased-items-slider-prev"
										class="carousel-btn carousel-btn-prev"></div><!-- End .carousel-prev -->
									<div id="purchased-items-slider-next"
										class="carousel-btn carousel-btn-next carousel-space"></div><!-- End .carousel-next -->
								</div><!-- End .carousel-controllers -->
								<div class="purchased-items-slider owl-carousel">
									<div class="item item-hover">
										<div class="item-image-wrapper">
											<figure class="item-image-container">
												<a href="product.html">
													<img src="images/products/item7.jpg" alt="item1"
														class="item-image">
													<img src="images/products/item7-hover.jpg" alt="item1  Hover"
														class="item-image-hover">
												</a>
											</figure>
											<div class="item-price-container">
												<span class="item-price">$160<span
														class="sub-price">.99</span></span>
											</div><!-- End .item-price-container -->
											<span class="new-rect">New</span>
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
											<h3 class="item-name"><a href="product.html">Phasellus
													consequat</a></h3>
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

									<div class="item item-hover">
										<div class="item-image-wrapper">
											<figure class="item-image-container">
												<a href="product.html">
													<img src="images/products/item8.jpg" alt="item1"
														class="item-image">
													<img src="images/products/item8-hover.jpg" alt="item1  Hover"
														class="item-image-hover">
												</a>
											</figure>
											<div class="item-price-container">
												<span class="item-price">$100</span>
											</div><!-- End .item-price-container -->
											<span class="new-rect">New</span>
										</div><!-- End .item-image-wrapper -->
										<div class="item-meta-container">
											<div class="ratings-container">
												<div class="ratings">
													<div class="ratings-result" data-result="99"></div>
												</div><!-- End .ratings -->
												<span class="ratings-amount">
													4 Reviews
												</span>
											</div><!-- End .rating-container -->
											<h3 class="item-name"><a href="product.html">Phasellus
													consequat</a></h3>
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

									<div class="item item-hover">
										<div class="item-image-wrapper">
											<figure class="item-image-container">
												<a href="product.html">
													<img src="images/products/item9.jpg" alt="item1"
														class="item-image">
													<img src="images/products/item9-hover.jpg" alt="item1  Hover"
														class="item-image-hover">
												</a>
											</figure>
											<div class="item-price-container">
												<span class="old-price">$100</span>
												<span class="item-price">$80</span>
											</div><!-- End .item-price-container -->
											<span class="discount-rect">-20%</span>
										</div><!-- End .item-image-wrapper -->
										<div class="item-meta-container">
											<div class="ratings-container">
												<div class="ratings">
													<div class="ratings-result" data-result="75"></div>
												</div><!-- End .ratings -->
												<span class="ratings-amount">
													2 Reviews
												</span>
											</div><!-- End .rating-container -->
											<h3 class="item-name"><a href="product.html">Phasellus
													consequat</a></h3>
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

									<div class="item item-hover">
										<div class="item-image-wrapper">
											<figure class="item-image-container">
												<a href="product.html">
													<img src="images/products/item6.jpg" alt="item1"
														class="item-image">
													<img src="images/products/item6-hover.jpg" alt="item1  Hover"
														class="item-image-hover">
												</a>
											</figure>
											<div class="item-price-container">
												<span class="item-price">$99</span>
											</div><!-- End .item-price-container -->
											<span class="new-rect">New</span>
										</div><!-- End .item-image-wrapper -->
										<div class="item-meta-container">
											<div class="ratings-container">
												<div class="ratings">
													<div class="ratings-result" data-result="40"></div>
												</div><!-- End .ratings -->
												<span class="ratings-amount">
													3 Reviews
												</span>
											</div><!-- End .rating-container -->
											<h3 class="item-name"><a href="product.html">Phasellus
													consequat</a></h3>
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

									<div class="item item-hover">
										<div class="item-image-wrapper">
											<figure class="item-image-container">
												<a href="product.html">
													<img src="images/products/item7.jpg" alt="item1"
														class="item-image">
													<img src="images/products/item7-hover.jpg" alt="item1  Hover"
														class="item-image-hover">
												</a>
											</figure>
											<div class="item-price-container">
												<span class="item-price">$280</span>
											</div><!-- End .item-price-container -->
										</div><!-- End .item-image-wrapper -->
										<div class="item-meta-container">
											<div class="ratings-container">
											</div><!-- End .rating-container -->
											<h3 class="item-name"><a href="product.html">Phasellus
													consequat</a></h3>
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

									<div class="item item-hover">
										<div class="item-image-wrapper">
											<figure class="item-image-container">
												<a href="product.html">
													<img src="images/products/item10.jpg" alt="item1"
														class="item-image">
													<img src="images/products/item10-hover.jpg" alt="item1  Hover"
														class="item-image-hover">
												</a>
											</figure>
											<div class="item-price-container">
												<span class="old-price">$150</span>
												<span class="item-price">$120</span>
											</div><!-- End .item-price-container -->
										</div><!-- End .item-image-wrapper -->
										<div class="item-meta-container">
											<div class="ratings-container">
											</div><!-- End .rating-container -->
											<h3 class="item-name"><a href="product.html">Phasellus
													consequat</a></h3>
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

								</div><!--purchased-items-slider -->
							</div><!-- End .purchased-items-container --> --}}

						</div><!-- End .col-md-12 -->

                            </div><!-- End.row -->

						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
