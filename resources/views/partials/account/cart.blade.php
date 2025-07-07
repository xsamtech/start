
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
							<header class="content-title">
								<h1 class="title" style="margin-bottom: 5px;">@lang('miscellaneous.menu.account.cart')</h1>
								<p class="title-desc"><i class="bi bi-person" style="font-size: 2.5rem; vertical-align: -3px"></i> {{ $current_user->firstname . ' ' . $current_user->lastname }}</p>
							</header>

							<ul id="portfolio-filter" class="clearfix">
								<li><a href="{{ route('account.home') }}">@lang('miscellaneous.menu.account.title')</a></li>
								<li><a class="active">@lang('miscellaneous.menu.account.cart')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'projects']) }}">@lang('miscellaneous.menu.account.project.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'products']) }}">@lang('miscellaneous.menu.account.product.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'services']) }}">@lang('miscellaneous.menu.account.service.title')</a></li>
							</ul><!-- End .portfolio-filter -->

@if (count($items) > 0)
							<div class="row">
								<div class="col-md-12 table-responsive">
									<table class="table cart-table">
										<thead>
											<tr>
												<th class="table-title">@lang('miscellaneous.admin.product.data.product_name', ['entity' => __('miscellaneous.admin.product.entity.product.singular')])</th>
												<th class="table-title">@lang('miscellaneous.admin.product.data.price')</th>
												<th class="table-title">@lang('miscellaneous.admin.product.data.quantity')</th>
												<th class="table-title">@lang('miscellaneous.public.subtotal')</th>
											</tr>
										</thead>

										<tbody>
	@php
		foreach ($items as $item) {
			$item->converted_price = $item->convertPriceAtThatTime($current_user->currency);
			$item->subtotal_price = $item->subtotalPrice($current_user->currency);
		}

		$itemsArray = $items->toArray();
	@endphp

	@foreach ($itemsArray as $item)
											<tr>
												<td class="item-name-col">
													<figure>
														<a href="{{ route('product.entity.datas', ['entity' => $item['product']['type'], 'id' => $item['product']['id']]) }}">
															<img src="{{ count($item['product']['photos']) > 0 ? $item['product']['photos'][0]['file_url'] : getWebURL() . '/template/public/images/products/compare1.jpg' }}" alt="{{ $item['product']['product_name'] }}">
														</a>
													</figure>
													<header class="item-name">
														<a href="{{ route('product.entity.datas', ['entity' => $item['product']['type'], 'id' => $item['product']['id']]) }}">
															{{ $item['product']['product_name'] }}
														</a>
													</header>
													<ul>
														<li>
															<u>Description</u><br>
															{{ $item['product']['product_description'] }}
														</li>
													</ul>
												</td>
												<td class="item-price-col">
													<span class="item-price-special">{{ $item['converted_price'] . ' ' . $current_user->readable_currency }}</span>
												</td>
												<td>
													<div class="custom-quantity-input">
														<input type="text" name="quantity" value="{{ $item['quantity'] }}" min="500">
														<a href="#" onclick="return false;" class="quantity-btn quantity-input-up">
															<i class="fa fa-angle-up"></i>
														</a>
														<a href="#" onclick="return false;" class="quantity-btn quantity-input-down">
															<i class="fa fa-angle-down"></i>
														</a>
													</div>
												</td>
												<td class="item-total-col">
													<span class="item-price-special">{{ $item['subtotal_price'] . ' ' . $current_user->readable_currency }}</span>
													<a href="#" class="close-button"></a>
												</td>
											</tr>
	@endforeach
										</tbody>
									</table>
								</div><!-- End .col-md-12 -->
							</div><!-- End .row -->
							<div class="lg-margin"></div><!-- End .space -->

							<div class="row">
								<div class="col-md-8 col-sm-12 col-xs-12 lg-margin"></div><!-- End .col-md-8 -->
								<div class="col-md-4 col-sm-12 col-xs-12">
									<table class="table total-table">
										<tfoot>
											<tr>
												<td>{{ 'TOTAL' . __('miscellaneous.colon_after_word') }}</td>
												<td>{{ $current_user->unpaidCartTotal() . ' ' . $current_user->readable_currency }}</td>
											</tr>
										</tfoot>
									</table>
									<div class="md-margin"></div><!-- End .space -->
									<a href="#" class="btn btn-custom text-uppercase">@lang('miscellaneous.checkout')</a>
								</div><!-- End .col-md-4 -->

                            </div><!-- End.row -->
	
@else
							<div class="row">
								<div class="col-md-12 table-responsive">
									<div style="display: flex; justify-content: center; align-items: flex-end; height: 200px;">
										<i class="bi bi-cart3" style="font-size: 10rem"></i>
									</div>
									<h3 class="text-center">@lang('miscellaneous.empty_list')</h3>
								</div><!-- End .col-md-12 -->
							</div><!-- End .row -->
	
@endif

						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
