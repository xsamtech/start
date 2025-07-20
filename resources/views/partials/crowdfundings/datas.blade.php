@php
	$crowdfunding_product = $selected_crowdfunding['product']->resolve();
	$crowdfunding_product_user = $crowdfunding_product['user']->resolve();
	$crowdfunding_product_category = $crowdfunding_product['category']->resolve();
	$crowdfunding_product_sector = $crowdfunding_product_category['project_sector']->resolve();
	$crowdfunding_product_photos = $crowdfunding_product['photos']->resolve();
@endphp

			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li><a href="{{ route('crowdfunding.home') }}">@lang('miscellaneous.menu.public.crowdfunding')</a></li>
							<li class="active">@lang('miscellaneous.admin.crowdfunding.details')</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 10px;">
							<div class="clearfix">
								<header class="content-title" style="float: left;">
                                    <h1 class="title">{{ $crowdfunding_product['product_name'] }}</h1>

                                    <p style="margin: 0;">
                                        <strong>@lang('miscellaneous.public.crowdfunding.sector.title')</strong>@lang('miscellaneous.colon_after_word') {{ $crowdfunding_product_sector['sector_name'] }}
                                    </p><!-- End team-member-title -->
                                    <p>
                                        <strong>@lang('miscellaneous.public.crowdfunding.sector.category')</strong>@lang('miscellaneous.colon_after_word') {{ $crowdfunding_product_category['category_name'] }}
                                    </p><!-- End team-member-title -->
                                </header>
                            </div>
                        </div>

						<div class="container">
							<div class="row">
								<div class="col-md-4 col-sm-5 col-xs-12">
									<figure>
										<img src="{{ count($crowdfunding_product_photos) > 0 ? $crowdfunding_product_photos[0]['file_url'] : getWebURL() . '/template/public/images/team/bryant.jpg' }}" alt="Dawe Bryant" class="img-responsive">
									</figure>
									<div class="md-margin visible-xs visible-sm"></div><!-- space for small devices -->
								</div><!-- End .col-md-4-->

								<div class="col-md-8 col-sm-7 col-xs-12">
									<div class="team-member-header-meta">
										<p>{!! $selected_crowdfunding['description'] !!}</p>
										<hr style="border-color: #ccc; margin-top: 10px; margin-bottom: 10px;">

										<div class="progress-container">
											<p style="margin-bottom: 5px;">
												<strong>@lang('miscellaneous.admin.crowdfunding.data.expected_amount')</strong>@lang('miscellaneous.colon_after_word') {{ formatIntegerNumber($selected_crowdfunding['convert_expected_amount']) . ' ' . ($selected_crowdfunding['currency'] == 'USD' ? '$' : 'FC') }}
											</p>
											<p style="margin-bottom: 30px;">
												<strong>@lang('miscellaneous.admin.crowdfunding.data.collected_amount')</strong>@lang('miscellaneous.colon_after_word') {{ formatIntegerNumber($selected_crowdfunding['total_paid']) . ' ' . ($selected_crowdfunding['currency'] == 'USD' ? '$' : 'FC') }}
											</p>
											<div class="progress">
												<div class="progress-bar progress-bar-custom progress-animate" role="progressbar" aria-valuenow="{{ $selected_crowdfunding['financing_rate'] }}" aria-valuemin="0" aria-valuemax="100" data-width="{{ $selected_crowdfunding['financing_rate'] }}">
													<span class="progress-text">{{ $selected_crowdfunding['financing_rate'] }}%</span>
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
												<button class="btn strt-btn-chocolate-3" data-toggle="modal" data-target="#newCrowdfundingModal">@lang('miscellaneous.participate')</button>
											</div>
										</div><!-- End .team-member-extra-->
									</div><!-- End .team-member-header-meta -->
								</div><!-- End .col-md-8--> 

                            </div>
						</div><!-- End .container -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
