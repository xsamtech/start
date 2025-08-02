
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
								<li><a href="{{ route('account.entity', ['entity' => 'cart']) }}">@lang('miscellaneous.menu.account.cart')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'projects']) }}">@lang('miscellaneous.menu.account.project.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'products']) }}">@lang('miscellaneous.menu.account.product.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'services']) }}">@lang('miscellaneous.menu.account.service.title')</a></li>
								<li><a class="active">@lang('miscellaneous.menu.account.customer')</a></li>
							</ul><!-- End .portfolio-filter -->

@if (count($items) > 0)
	@php
		$period = request()->get('period') ?? 'yearly';
	@endphp
							<div class="row">
								<div class="col-md-12 table-responsive">
									<table class="table cart-table">
										<thead>
											<tr>
												<th></th>
												<th>@lang('miscellaneous.names')</th>
												<th>@lang('miscellaneous.email')</th>
												<th>@lang('miscellaneous.public.number_of_products_ordered')</th>
												<th>@lang('miscellaneous.public.total')</th>
												<th>@lang('miscellaneous.public.order_data')</th>
											</tr>
										</thead>

										<tbody>
	@foreach ($items as $customer)
		@foreach ($customer->carts as $cart)
											<tr>
												<td class="item-name-col"><img src="{{ $customer->avatar_url }}" alt="" width="50" style="border-radius: 50%;"></td>
												<td class="item-name-col">{{ $customer->firstname }} {{ $customer->lastname }}</td>
												<td class="item-name-col">{{ $customer->email }}</td>
												<td class="item-name-col">{{ count($cart->customer_orders) }}</td>
												<td class="item-name-col">{{ formatDecimalNumber($cart->totalConvertedAmountInPeriod($current_user->currency, $period)) }} {{ $current_user->currency == 'USD' ? '$' :$current_user->currency }}</td>
												<td class="item-name-col">{{ $cart->customer_orders[0]->created_at->format('d/m/Y H:i') }}</td>
											</tr>
		@endforeach
	@endforeach
										</tbody>
									</table>
								</div><!-- End .col-md-12 -->
							</div><!-- End .row -->
	
@else
							<div class="row">
								<div class="col-md-12">
									<div style="display: flex; justify-content: center; align-items: flex-end; height: 200px;">
										<i class="bi bi-people" style="font-size: 10rem"></i>
									</div>
									<h3 class="text-center">@lang('miscellaneous.empty_list')</h3>
								</div><!-- End .col-md-12 -->
							</div><!-- End .row -->
	
@endif

						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
