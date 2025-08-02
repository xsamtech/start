
			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li class="active">@lang('miscellaneous.menu.public.investors.title')</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="clearfix">
								<header class="content-title" style="float: left;">
                                    <h1 class="title">@lang('miscellaneous.public.agribusiness.title')</h1>
                                    <p class="title-desc">@lang('miscellaneous.public.agribusiness.description')</p>
								</header>
@if (!empty($current_user))
								<button class="btn strt-btn-green pb-2" style="float: right; display: flex; align-items: center;" class="btn btn-primary" data-toggle="modal" data-target="#newInvestorModal">
									<i class="bi bi-plus" style="font-size: 2.5rem; color: white"></i> <span class="d-xs-none" style="margin-left: 8px; color: white">@lang('miscellaneous.publish')</span>
								</button>
@endif
                        </div>

                        <div class="col-md-12">
							<div class="row portfolio-item-container" data-maxcolumn="4" data-layoutmode="fitRows">
@forelse ($investors as $user)
								<div class="col-md-3 col-sm-4 col-xs-6 portfolio-item photography">
									<figure>
										<img src="{{ $user->avatar_url }}" alt="{{ $user->firstname . ' ' . $user->lastname  }}">
										<figcaption>
											<a href="{{ $user->avatar_url }}" title="{{ $user->firstname . ' ' . $user->lastname  }}" data-rel="prettyPhoto[portfolio]" class="zoom-button"></a>
											<a href="{{ route('investor.datas', ['id' => $user->id]) }}" class="link-button"></a>
										</figcaption>
									</figure>
									<h2><a href="{{ route('investor.datas', ['id' => $user->id]) }}">{{ $user->firstname . ' ' . $user->lastname  }}</a></h2>
								</div><!-- End .portfolio-item -->
@empty
								<div class="col-md-12">
									<div style="display: flex; justify-content: center; align-items: flex-end; height: 150px;">
										<i class="bi bi-person" style="font-size: 10rem"></i>
									</div>
									<h3 class="text-center">@lang('miscellaneous.empty_list')</h3>
								</div><!-- End .col-md-12 -->
@endforelse
							</div><!-- .portfolio-item-container -->

							<div class="pagination-container clear-border clearfix">
								<div class="pull-right">
									{{ $investors_req->links() }}
								</div><!-- End .pull-right -->
							</div><!-- End pagination-container -->
                        </div>
                    </div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
