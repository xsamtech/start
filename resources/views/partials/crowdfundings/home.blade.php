
			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li class="active">@lang('miscellaneous.menu.public.crowdfunding')</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 10px;">
							<div class="clearfix">
								<header class="content-title" style="float: left;">
                                    <h1 class="title">@lang('miscellaneous.public.crowdfunding.title')</h1>
                                    <p class="title-desc">@lang('miscellaneous.public.crowdfunding.description')</p>
								</header>
@if (!empty($current_user))
								<button class="btn strt-btn-green pb-2" style="float: right; display: flex; align-items: center;" class="btn btn-primary" data-toggle="modal" data-target="#newCrowdfundingModal">
									<i class="bi bi-plus" style="font-size: 2.8rem; color: white"></i> <span class="d-xs-none" style="margin-left: 8px; color: white">@lang('miscellaneous.launch_new')</span>
								</button>
@else
								<a href="{{ route('login', ['redirect' => 'crowdfunding.home']) }}" class="btn strt-btn-green pb-2" style="float: right; display: flex; align-items: center;" class="btn btn-primary">
									<i class="bi bi-plus" style="font-size: 2.8rem; color: white"></i> <span class="d-xs-none" style="margin-left: 8px; color: white">@lang('miscellaneous.launch_new')</span>
								</a>
@endif
                            </div>
                        </div>

						<div class="container">
							<div class="row">
@forelse ($crowdfundings as $crowdfunding)
	@php
		$crowdfunding_product = $crowdfunding['product']->resolve();
		$crowdfunding_product_user = $crowdfunding_product['user']->resolve();
		$crowdfunding_product_category = $crowdfunding_product['category']->resolve();
		$crowdfunding_product_sector = $crowdfunding_product_category['project_sector']->resolve();
		$crowdfunding_product_photos = $crowdfunding_product['photos']->resolve();
	@endphp
								<div class="col-md-6">
									<div class="team-member-header clearfix">
										<div class="row">
											<div class="col-md-4 col-sm-12 col-xs-12">
												<figure>
													<img src="{{ count($crowdfunding_product_photos) > 0 ? $crowdfunding_product_photos[0]['file_url'] : getWebURL() . '/template/public/images/team/bryant.jpg' }}" alt="Dawe Bryant" class="img-responsive" style="height: 210px; object-fit: cover;">
												</figure>
												<div class="md-margin visible-xs visible-sm"></div><!-- space for small devices -->
											</div><!-- End .col-md-4-->

											<div class="col-md-8 col-sm-12 col-xs-12">
												<div class="team-member-header-meta">
													<div class="team-member-name">{{ $crowdfunding_product['product_name'] }}</div><!-- End .team-member-name -->
													<p class="small text-muted" style="margin: 0;">
														<strong>@lang('miscellaneous.public.crowdfunding.sector.title')</strong>@lang('miscellaneous.colon_after_word') {{ $crowdfunding_product_sector['sector_name'] }}
													</p><!-- End team-member-title -->
													<p class="small text-muted">
														<strong>@lang('miscellaneous.public.crowdfunding.sector.category')</strong>@lang('miscellaneous.colon_after_word') {{ $crowdfunding_product_category['category_name'] }}
													</p><!-- End team-member-title -->

													<hr style="border-color: #ccc; margin-top: 10px; margin-bottom: 10px;">
													<p>{!! Str::limit($crowdfunding['description'], 140) !!}</p>
													<hr style="border-color: #ccc; margin-top: 10px; margin-bottom: 10px;">

													<div class="progress-container">
														<p class="text-muted" style="margin-bottom: 20px;">
															<strong>@lang('miscellaneous.admin.crowdfunding.data.expected_amount')</strong>@lang('miscellaneous.colon_after_word') {{ formatIntegerNumber($crowdfunding['convert_expected_amount']) . ' ' . ($crowdfunding['currency'] == 'USD' ? '$' : 'FC') }}
														</p>
														<div class="progress">
															<div class="progress-bar progress-bar-custom progress-animate" role="progressbar" aria-valuenow="{{ $crowdfunding['financing_rate'] }}" aria-valuemin="0" aria-valuemax="100" data-width="{{ $crowdfunding['financing_rate'] }}">
																<span class="progress-text">{{ $crowdfunding['financing_rate'] }}%</span>
															</div><!-- End .progress-bar -->
														</div><!-- End .progress -->
													</div><!-- End .progress-container -->

													<div class="team-member-extra" style="display: flex; justify-content: space-between; align-items: flex-start">
														<div class="team-member-contact" style="display: flex; justify-content: space-between; align-items: center">
															<img src="{{ $crowdfunding_product_user['avatar_url'] }}" alt="{{ $crowdfunding_product_user['firstname'] . ' ' . $crowdfunding_product_user['lastname'] }}" width="50" style="margin-right: 10px; border-radius: 50%">
															<div>
																<p class="text-muted" style="font-weight: 700; margin: 0;">{{ $crowdfunding_product_user['firstname'] . ' ' . $crowdfunding_product_user['lastname'] }}</p>
																<p class="small text-muted" style="margin: 0;">{{ $crowdfunding_product_user['email'] }}</p>
																<p class="small text-muted" style="margin: 0;">{{ $crowdfunding_product_user['phone'] }}</p>
															</div>
														</div>
														<div class="social-links">
															<a href="{{ route('crowdfunding.datas', ['id' => $crowdfunding['id']]) }}" class="btn btn-small strt-btn-chocolate-3">@lang('miscellaneous.details')</a>
														</div>
													</div><!-- End .team-member-extra-->
												</div><!-- End .team-member-header-meta -->
											</div><!-- End .col-md-8--> 
										</div><!-- End .row -->
									</div><!-- End .team-member-header -->
								</div>
@empty
								<div class="col-md-12">
									<div style="display: flex; justify-content: center; align-items: flex-end; height: 200px;">
										<i class="bi bi-cash-coin" style="font-size: 10rem"></i>
									</div>
									<h3 class="text-center">@lang('miscellaneous.empty_list')</h3>
								</div><!-- End .col-md-12 -->
@endforelse
							</div>
						</div><!-- End .container -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
