
			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li><a href="{{ route('account.home') }}">@lang('miscellaneous.menu.account.title')</a></li>
							<li class="active">{{ $entity_title }}</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="clearfix">
								<header class="content-title" style="float: left;">
									<h1 class="title" style="margin-bottom: 5px;">@lang('miscellaneous.menu.account.service.title')</h1>
									<p class="title-desc"><i class="bi bi-person" style="font-size: 2.5rem; vertical-align: -3px"></i> {{ $current_user->firstname . ' ' . $current_user->lastname }}</p>
								</header>
								<button class="btn strt-btn-green pb-2" style="float: right; display: flex; align-items: center;" class="btn btn-primary" data-toggle="modal" data-target="#newProductModal">
									<i class="bi bi-plus" style="font-size: 2.8rem; color: white"></i> <span class="d-xs-none" style="margin-left: 8px; color: white">@lang('miscellaneous.add')</span>
								</button>
							</div>

							<ul id="portfolio-filter" class="clearfix">
								<li><a href="{{ route('account.home') }}">@lang('miscellaneous.menu.account.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'cart']) }}">@lang('miscellaneous.menu.account.cart')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'projects']) }}">@lang('miscellaneous.menu.account.project.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'products']) }}">@lang('miscellaneous.menu.account.product.title')</a></li>
								<li><a class="active">@lang('miscellaneous.menu.account.service.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'customers']) }}">@lang('miscellaneous.menu.account.customer')</a></li>
							</ul><!-- End .portfolio-filter -->

							<div class="row">

                                <div class="col-md-9 col-sm-8 col-xs-12 main-content">
                                    <div id="category-header" class="category-banner">
                                        <img src="{{ $category->image_url ?? getWebURL() . '/template/public/images/banner.png' }}" alt="Category banner" class="img-responsive" style="height: 300px; object-fit: cover; filter: brightness(50%);">
                                        <div class="category-title">
                                            <h2>{{ $category->category_name }}</h2>
                                            <p>{{ $category->category_description }}</p>
                                        </div><!-- End .category-title -->
                                    </div><!-- End #category-header -->

                                    <div class="md-margin"></div><!-- space -->

                                    <div class="category-toolbar clearfix">
                                        <div class="toolbox-filter clearfix">

                                            <div class="sort-box">
                                                <span class="separator">@lang('miscellaneous.sort_by')</span>
                                                <div class="btn-group select-dropdown">
                                                    <button type="button" class="btn select-btn">@lang('miscellaneous.admin.product.action.title')</button>
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="?action=sell">@lang('miscellaneous.admin.product.action.sell')</a></li>
                                                        <li><a href="?action=rent">@lang('miscellaneous.admin.product.action.rent')</a></li>
                                                        <li><a href="?action=distribute">@lang('miscellaneous.admin.product.action.distribute')</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div><!-- End .toolbox-filter -->
                                        <div class="toolbox-pagination clearfix">
											{{ $items->links() }}
                                        </div><!-- End .toolbox-pagination -->
                                    </div><!-- End .category-toolbar -->
                                    <div class="md-margin"></div><!-- .space -->
                                    <div class="category-item-container">
                                        <div class="row">
@forelse ($items as $product)
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
                                                        <div id="product-{{ $product['id'] }}" class="item-action">
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
                                                            <a href="{{ route('login', ['product_id' => $product['id']]) }}" class="item-add-btn">
                                                                <span class="icon-cart-text">@lang('miscellaneous.public.add_to_cart')</span>
                                                            </a>
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

                                <aside
                                    class="col-md-3 col-sm-4 col-xs-12 sidebar">
                                    <div class="widget">
                                        <div
                                            class="panel-group custom-accordion sm-accordion"
                                            id="category-filter">
                                            <div class="panel">
                                                <div class="accordion-header">
                                                    <div class="accordion-title"><span>@lang('miscellaneous.menu.admin.categories.title')</span></div><!-- End .accordion-title -->
                                                    <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-1"></a>
                                                </div><!-- End .accordion-header -->

                                                <div id="category-list-1" class="collapse in">
                                                    <div class="panel-body">
                                                        <ul class="category-filter-list jscrollpane">
@foreach ($categories as $category)
                                                            <li>
																<a href="?category_id={{ $category->id }}">{{ $category->category_name }} ({{ $category->products_count }})</a>
															</li>
@endforeach
                                                        </ul>
                                                    </div><!-- End .panel-body -->
                                                </div><!-- #collapse -->
                                            </div><!-- End .panel -->

                                            <div class="panel">
                                                <div class="accordion-header">
                                                    <div class="accordion-title"><span>@lang('miscellaneous.admin.product.data.price')</span></div><!-- End .accordion-title -->
                                                    <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-3"></a>
                                                </div><!-- End .accordion-header -->

                                                <div id="category-list-3" class="collapse in">
                                                    <div class="panel-body">
                                                        <div id="price-range">

                                                        </div><!-- End #price-range -->
                                                        <div id="price-range-details">
                                                            <span class="sm-separator text-capitalize">@lang('miscellaneous.from')</span>
                                                            <input type="number" id="price-range-low" class="separator">
                                                            <span class="sm-separator">@lang('miscellaneous.to')</span>
                                                            <input type="number" id="price-range-high">
                                                        </div>
                                                        <div id="price-range-btns">
                                                            <a href="#" class="btn btn-custom-2 btn-sm">Ok</a>
                                                            <a href="#" class="btn btn-custom-2 btn-sm">@lang('miscellaneous.clear')</a>
                                                        </div>
                                                    </div><!-- End .panel-body -->
                                                </div><!-- #collapse -->
                                            </div><!-- End .panel -->
                                        </div><!-- .panel-group -->
                                    </div><!-- End .widget -->
                                </aside><!-- End .col-md-3 -->

                            </div><!-- End.row -->

						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
