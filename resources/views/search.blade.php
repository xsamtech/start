@php
	$status = null;

    if (auth()->check()) {
        switch (auth()->user()->status) {
            case 'disabled':
                $status = 'deactivated';
                break;

            case 'deleted':
                $status = 'deleted';
                break;

            default:
                $status = 'locked';
                break;
        }
    }
@endphp

@extends('layouts.app', ['page_title' => __('miscellaneous.search') . __('miscellaneous.colon_after_word') . ' « ' . $query . ' »'])

@section('app-content')

			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li class="active">@lang('miscellaneous.search')@lang('miscellaneous.colon_after_word') &laquo; {{ $query }} &raquo;</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 main-content">
                            <div class="category-item-container">
                                <div class="row">
@forelse ($items as $product)
    @php
        $cart = session()->get('cart', []);
        $isInCart = isset($cart[$product['id']]);
    @endphp
                                    <div class="col-md-3 col-sm-5 col-xs-12">
                                        <div class="item item-hover">
                                            <div class="item-image-wrapper">
                                                <figure class="item-image-container">
                                                    <a href="{{ route('product.entity.datas', ['entity' => 'product', 'id' => $product['id']]) }}">
                                                        <img src="{{ count($product['photos']) > 0 ? $product['photos'][0]->file_url : getWebURL() . '/template/public/images/products/item6.jpg' }}" alt="item1" class="item-image">
                                                        <img src="{{ count($product['photos']) > 0 ? (!empty($product['photos'][1]) ? $product['photos'][1]->file_url : $product['photos'][0]->file_url) : getWebURL() . '/template/public/images/products/item6-hover.jpg' }}" alt="item1  Hover" class="item-image-hover">
                                                    </a>
                                                </figure>
                                                <div class="item-price-container">
                                                    <span class="item-price">{{ !empty($current_user) ? ($product['converted_price'] . ' ' . $current_user->readable_currency) : $product['price'] . ' ' . $product['currency'] }} @lang('miscellaneous.per_ton.abbreviated')</span>
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
        @if ($current_user->status == 'activated')
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
                                                    <p class="btn btn-default disabled" style="margin: -2px;">
                                                        <span class="text-uppercase" style="font-size: 12px">@lang('miscellaneous.account.' . $status . '.title')</span>
                                                    </p>
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

                                </div><!-- End .row -->
                            </div><!-- End .category-item-container -->

                            <div class="pagination-container clearfix">
									{{ $items->links() }}
                            </div><!-- End pagination-container -->

                        </div><!-- End .col-md-9 -->

					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->

@endsection
