
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
	@if (count($projects) > 0)
		@foreach ($projects as $project)
								<div class="col-lg-6 col-sm-6 col-xs-12">
									<div class="panel panel-default">
										<div class="panel-heading clearfix" style="display: flex; align-items: center; flex-direction: row;">
											<img src="{{ $project->user->avatar_url }}" alt="{{ $project->user->firstname . ' ' . $project->user->lastname }}" width="40" style="float: left; border-radius: 50%; margin-right: 10px;">
											<p style="font-weight: 700; margin: 0;">{{ $project->user->firstname . ' ' . $project->user->lastname }}</p>
										</div>

			@if (count($project->photos) > 0)
										<div class="panel-body" style="padding-bottom: 0;">
											<img src="{{ $project->photos[0]->file_url }}" class="d-block w-100" alt="Image 1" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
										</div>
			@endif
										<div class="panel-body">
											<p style="margin: 0;">
												{!! Str::limit($project->project_description, 200) !!}<br class="d-lg-none">
											</p>
										</div>

			@if (count($project->sheets) > 0)
				@php
					$completedSheet = $project->sheets->where('is_sheet_completed', 1)->first();
				@endphp

				@if ($completedSheet)
										<div class="panel-body" style="padding-top: 0; padding-bottom: 8px;">
											<a href="{{ $completedSheet->file_url }}" target="_blank">
												<p style="color: green; margin-bottom: 0;"><i class="bi bi-file-earmark-text" style="font-size: 2rem; margin-right: 8px; vertical-align: -3px;"></i>@lang('miscellaneous.admin.project_writing.data.sheet_url_public')</p>
											</a>
										</div>
				@endif
			@endif

										<div class="panel-footer clearfix" style="margin: 0;">
											<a href="{{ route('investor.datas', ['id' => $project->id]) }}" style="float: left; color: #6e9e1a;">@lang('miscellaneous.details') &raquo;</a>
										</div>
									</div>
								</div>
		@endforeach
	@else
								<div class="col-md-12">
									<div style="display: flex; justify-content: center; align-items: flex-end; height: 140px;">
										<i class="bi bi-file-text" style="font-size: 10rem"></i>
									</div>
									<h3 class="text-center">@lang('miscellaneous.empty_list')</h3>
								</div><!-- End .col-md-12 -->
	@endif
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
