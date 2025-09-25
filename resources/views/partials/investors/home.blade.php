
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
								<header class="content-title" style="@auth float: left; @endauth">
                                    <h1 class="title">@lang('miscellaneous.public.agribusiness.title')</h1>
                                    <p class="title-desc">@lang('miscellaneous.public.agribusiness.description')</p>
								</header>
@auth
								<a href="{{ route('crowdfunding.home') }}" class="btn strt-btn-chocolate-3 pb-2" style="float: right; display: flex; align-items: center;">
									<i class="bi bi-plus" style="font-size: 2.5rem; color: white"></i> <span class="d-xs-none" style="margin-left: 8px; color: white">@lang('miscellaneous.write_new')</span>
								</a>
@endauth
							</div>
                        </div>

                        <div class="col-md-12">
@if (!empty($current_user))
							<div class="row">
	@forelse ($projects as $project)
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-4 col-sm-5 col-xs-12">
													<img src="{{ count($project->photos) > 0 ? $project->photos[0]->file_url : asset('assets/img/undefined.png') }}" alt="" style="height: 160px; margin-top: 10px; border-radius: 14px; object-fit: cover;" class="img-responsive">
												</div>
												<div class="col-lg-8 col-sm-7 col-xs-12">
													<p style="line-height: 19px; margin-top: 10px; margin-bottom: 1px;">{!! Str::limit($project->projects_description, 200) !!}</p>
													<a href="{{ route('investor.datas', ['id' => $project->id]) }}" class="small text-primary" style="text-decoration: underline;">@lang('miscellaneous.details') <i class="bi bi-chevron-double-right"></i></a>
												</div>
											</div>
										</div>
									</div>
								</div>
	@empty
								<div class="col-md-12">
									<div style="display: flex; justify-content: center; align-items: flex-end; height: 140px;">
										<i class="bi bi-file-text" style="font-size: 10rem"></i>
									</div>
									<h3 class="text-center">@lang('miscellaneous.empty_list')</h3>
								</div><!-- End .col-md-12 -->
	@endforelse
							</div>
@else
							<div id="flexItemsCenter" class="row">
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
									<div class="view" style="padding: 20px;">
										<img src="{{ asset('assets/img/financing-project.png') }}" alt="" class="img-responsive">
										<div class="mask"></div>
									</div>
								</div>
								<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
									<p>@lang('miscellaneous.public.agribusiness.infos.paragraph_1')</p>
									<p style="margin: 30px 0 0 0;">
										<a href="{{ route('login', ['redirect' => 'investor.home']) }}" class="btn strt-btn-chocolate-3 pb-2" style="float: right; display: flex; align-items: center;">
											<span style="margin-right: 8px; color: white">@lang('miscellaneous.public.agribusiness.infos.link')</span><i class="bi bi-chevron-double-right" style="font-size: 2rem; color: white"></i>
										</a>
									</p>
								</div>
							</div>
@endif
                        </div>
                    </div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
