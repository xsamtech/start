
			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li class="active">@lang('miscellaneous.menu.discussions')</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="clearfix">
								<header class="content-title" style="float: left;">
									<h1 class="title">@lang('miscellaneous.public.discussion.title')</h1>
									<p class="title-desc">@lang('miscellaneous.public.discussion.description')</p>
								</header>
@if (!empty($current_user))
								<button class="btn strt-btn-green pb-2" style="float: right; display: flex; align-items: center;" class="btn btn-primary" data-toggle="modal" data-target="#newPostModal">
									<i class="bi bi-pencil" style="font-size: 2.5rem; color: white"></i> <span class="d-xs-none" style="margin-left: 8px; color: white">@lang('miscellaneous.publish')</span>
								</button>
@endif
							</div>

							<div class="xs-margin"></div><!-- space -->
							<div class="row">
								<div class="col-md-9 col-sm-8 col-xs-12 articles-container">
@if ($posts_req_total > 0)
	@foreach ($posts as $post)
									<article class="article">
										<div class="article-meta-date">
											<span>{{ $post->created_at->format('d') }}</span>
											{{ $post->created_at->format('M') }}
										</div><!-- End .article-meta-date -->

										<figure class="article-media-container">
											<img src="{{ $post->photos[0]->file_url ?? getWebURL() . '/template/public/images/blog/post2-large.jpg' }}" alt="{{ $post->posts_title }}" style="width: 100%; height: 300px; object-fit: cover;">
										</figure>

										<h2><a href="{{ route('discussion.datas', ['id' => $post->id]) }}">{{ $post->posts_title }}</a></h2>

										<div class="article-meta-container clearfix">
											<div class="article-meta-more">
												<a href="{{ route('profile', ['id' => $post->user->id]) }}">
													<span class="separator"><i class="fa fa-user"></i></span>{{ $post->user->firstname . ' ' . $post->user->lastname }}
												</a><br class="d-lg-none">
												<a href="{{ route('discussion.datas', ['id' => $post->id]) }}">
													<span class="separator"><i class="fa fa-comments "></i></span>{{ trans_choice('miscellaneous.comments', $post->countComments(), ['count' => $post->countComments()]) }}
												</a>
											</div><!-- End. pull-left -->
										</div><!-- End .article-meta-container -->

										<div class="article-content-container">
											<p>
												{!! Str::limit($post->posts_content, 200) !!}<br class="d-lg-none">
												<a href="{{ route('discussion.datas', ['id' => $post->id]) }}" style="text-decoration: underline;">@lang('miscellaneous.details') <i class="bi bi-chevron-double-right"></i></a>
											</p>
										</div><!-- End .article-content-container -->
									</article><!-- End .article -->
	@endforeach

									<div class="pagination-container clearfix">
										<div class="pull-left page-count">
											@lang('miscellaneous.pages_count', ['count' => $posts_req_currentPage, 'total' => $posts_req_lastPage])
										</div><!-- End .pull-left -->

										<div class="pull-right">
											{{ $posts_req->links() }}
										</div><!-- End .pull-right -->
									</div><!-- End pagination-container -->
@else
									<div style="display: flex; justify-content: center; align-items: center; flex-direction: column; height: 210px;">
										<p style="margin-bottom: 0;"><i class="bi bi-pencil-square" style="font-size: 7rem;"></i></p>
										<p class="lead strt-text-chocolate-2 text-center" style="margin-bottom: 0;">@lang('miscellaneous.empty_list')</p>
									</div><!-- End pagination-container -->
@endif
								</div><!-- End .col-md-9 -->

								<aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
									<div class="widget category-accordion">
										<h3>@lang('miscellaneous.menu.admin.categories.title')</h3>

										<div class="panel-group" id="accordion">
											{{-- Project categories --}}
											<div class="panel panel-custom">
												<div class="panel-heading">
													<h4 class="panel-title">
														<span class="text-uppercase">@lang('miscellaneous.menu.admin.categories.projects')</span>
														<a data-toggle="collapse" href="#collapseOne">
															<span class="icon-box">&plus;</span>
														</a>
													</h4>
												</div>

												<div id="collapseOne" class="panel-collapse collapse in">
													<div class="panel-body">
														<ul class="category-accordion-list">
@forelse ($project_categories as $category)
															<li><a href="?category_id={{ $category->id }}">{{ $category->category_name }}</a></li>
@empty
@endforelse
														</ul>
													</div>
												</div>
											</div><!-- End .panel -->

											{{-- Product categories --}}
											<div class="panel panel-custom">
												<div class="panel-heading">
													<h4 class="panel-title">
														<span class="text-uppercase">@lang('miscellaneous.menu.admin.categories.products')</span>
														<a data-toggle="collapse" href="#collapseTwo">
															<span class="icon-box">&minus;</span>
														</a>
													</h4>
												</div>

												<div id="collapseTwo" class="panel-collapse collapse">
													<div class="panel-body">
														<ul class="category-accordion-list">
@forelse ($product_categories as $category)
															<li><a href="?category_id={{ $category->id }}">{{ $category->category_name }}</a></li>
@empty
@endforelse
														</ul>
													</div>
												</div>
											</div><!-- End .panel -->

											<div class="panel panel-custom">
												<div class="panel-heading">
													<h4 class="panel-title">
														<span class="text-uppercase">@lang('miscellaneous.menu.admin.categories.services')</span>
														<a data-toggle="collapse" href="#collapseThree">
															<span class="icon-box">&minus;</span>
														</a>
													</h4>
												</div>

												<div id="collapseThree" class="panel-collapse collapse">
													<div class="panel-body">
														<ul class="category-accordion-list">
@forelse ($service_categories as $category)
															<li><a href="?category_id={{ $category->id }}">{{ $category->category_name }}</a></li>
@empty
@endforelse
														</ul>
													</div>
												</div>
											</div><!-- End .panel -->
										</div><!-- End .panel-group -->
									</div><!-- End .widget -->
								</aside><!-- End .col-md-3 -->
							</div><!-- End .row -->
						</div><!-- End .col-md-12 -->
                    </div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
