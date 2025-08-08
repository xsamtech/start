
			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li><a href="{{ route('discussion.home') }}">@lang('miscellaneous.menu.discussions')</a></li>
							<li class="active">{{ $entity_title }}</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<header class="content-title">
								<h1 class="title">@lang('miscellaneous.admin.post.details')</h1>
							</header>

							<div class="xs-margin"></div><!-- space -->
							<div class="row">
								<div class="col-md-9 col-sm-8 col-xs-12 articles-container">
									<article class="article">
										<div class="article-meta-date">
											<span>{{ $selected_post->created_at->format('d') }}</span>
											{{ $selected_post->created_at->format('M') }}
										</div><!-- End .article-meta-date -->

@if (count($selected_post->photos) > 0)
										<div class="my-carousel">
	@foreach ($selected_post->photos as $photo)
												<div>
													<img src="{{ $photo->file_url }}" class="d-block w-100" alt="Image {{ $loop->index + 1 }}" style="width: 100%; height: 300px; object-fit: cover;">
												</div>
	@endforeach
										</div>
@else
										<figure class="article-media-container">
											<img src="{{ getWebURL() . '/template/public/images/blog/post2-large.jpg' }}" alt="{{ $selected_post->posts_title }}">
										</figure>
@endif

										<h2><a href="{{ route('discussion.datas', ['id' => $selected_post->id]) }}">{{ $selected_post->posts_title }}</a></h2>

										<div class="article-meta-container clearfix">
											<div class="article-meta-more">
												<a href="{{ route('discussion.datas', ['id' => $selected_post->id]) }}">
													<span class="separator"><i class="fa fa-comments "></i></span>{{ trans_choice('miscellaneous.comments', $selected_post->countComments(), ['count' => $selected_post->countComments()]) }}
												</a>
											</div><!-- End. pull-left -->
										</div><!-- End .article-meta-container -->

										<div class="article-content-container">
											{!! $selected_post->posts_content !!}
										</div><!-- End .article-content-container -->

										<div class="article-author clearfix">
											<figure class="article-author-image">
												<img src="{{ $selected_post->user->avatar_url }}" alt="{{ $selected_post->user->firstname . ' ' . $selected_post->user->lastname }}">
											</figure>

											<div class="article-author-details">
												<h4 style="font-weight: bold; margin-bottom: 5px;">@lang('miscellaneous.admin.post.data.about_author')</h4>
												<p class="lead" style="margin-bottom: 3px;">{{ $selected_post->user->firstname . ' ' . $selected_post->user->lastname }}</p>
												<p style="margin-bottom: 7px;">{{ $selected_post->user->about_me }}</p>
												<a href="{{ route('profile', ['id' => $selected_post->user->id]) }}" class="btn strt-btn-green">@lang('miscellaneous.details')</a>
											</div><!-- End .article-author-details -->
										</div><!-- End .article-author -->

										<div class="comments">
											<header class="title-bg">
												<h3>@lang('miscellaneous.admin.post.data.comments') ({{ $selected_post->countComments() }})</h3>
											</header>

@if (count($selected_post->comments) > 0)
											<ul class="comments-list">
	@foreach ($selected_post->comments as $comment)
												<li>
													<div class="comment clearfix">
														<figure>
															<img src="{{ $comment->user->avatar_url }}" alt="{{ $comment->user->firstname . ' ' . $comment->user->lastname }}">
														</figure>
														<div class="comment-details">
															<div class="comment-title">
																<a href="{{ route('profile', ['id' => $comment->user->id]) }}">{{ $comment->user->firstname . ' ' . $comment->user->lastname }}</a>
															</div><!-- End .comment-title -->
															<div class="comment-meta-container">
																<span>{{ \Carbon\Carbon::parse($comment->created_at)->format('d.m.Y') }}</span>
		@if (!empty($current_user))
																<a class="replay-button strt-text-green" style="cursor: pointer;" onclick="document.getElementById('posts_content').focus()">@lang('miscellaneous.answer')</a>
		@endif
															</div><!-- End .comment-meta-container -->
															<p>{!! $comment->posts_content !!}</p>
														</div><!-- End .comment-details -->
													</div><!-- End .comment -->
												</li>
	@endforeach
											</ul>
@else
											<div style="display: flex; justify-content: center; align-items: center; flex-direction: column; height: 210px;">
												<p style="margin-bottom: 0;"><i class="far fa-comments" style="font-size: 7rem;"></i></p>
												<p class="lead strt-text-chocolate-2 text-center" style="margin-bottom: 0;">@lang('miscellaneous.public.discussion.empty_comments_list')</p>
											</div>
@endif

@if (!empty($current_user))
											<h4 class="sub-title">@lang('miscellaneous.public.discussion.leave_comment')</h4>

											<form action="{{ route('discussion.home') }}" id="comment-form">
	@csrf
												<input type="hidden" name="answered_for" value="{{ $selected_post->id }}">
												<input type="hidden" name="type" value="comment">

												<div class="input-group textarea-container">
													<span class="input-group-addon"><span class="input-icon input-icon-message"></span><span class="input-text">@lang('miscellaneous.public.discussion.your_comment')</span></span>
													<textarea name="posts_content" id="posts_content" class="form-control" cols="30" rows="3" placeholder="@lang('miscellaneous.public.discussion.your_comment')" required></textarea>
												</div><!-- End .input-group -->

												<div style="display: flex; justify-content: flex-start;">
													<button type="submit" class="btn strt-btn-chocolate-3" style="width: 250px">
														<span style="color: #fff;">@lang('miscellaneous.send')</span>
													</button>
													<img id="loading-icon" src="{{ asset('assets/img/ajax-loading.gif') }}" alt="" width="40" height="40" style="margin-left: 6px; display: none;">
												</div>
											</form>
@else
											<h6 style="margin: 0;">
												<a href="{{ route('login') }}" style="text-decoration: underline;">@lang('miscellaneous.public.discussion.login_leave_comment')</a>
											</h6>
@endif
										</div><!-- End .comments -->
									</article><!-- End .article -->
								</div><!-- End .col-md-9 -->

								<aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
									<div class="widget recent-posts">
										<h3>@lang('miscellaneous.public.discussion.related')</h3>
										
										<div class="recent-posts-slider flexslider sidebarslider">
											<ul class="recent-posts-list clearfix">
												<li>
													<a href="single.html">
														<figure class="recent-posts-media-container">
															<img src="images/blog/post1-small.jpg" class="img-responsive" alt="lats post">
														</figure>
													</a>
													<h4><a href="single.html">35% Discount on second purchase!</a></h4>
													<p>Sed blandit nulla nec nunc ullamcorper tristique. Mauris adipiscing cursus ante ultricies dictum sed lobortis.</p>
													<div class="recent-posts-meta-container clearfix">
														<div class="pull-left">
															<a href="#">Read More...</a>
														</div><!-- End .pull-left -->
														<div class="pull-right">
															12.05.2013
														</div><!-- End .pull-right -->
													</div><!-- End .recent-posts-meta-container -->
												</li>
												
												<li>
													<a href="single.html">
														<figure class="recent-posts-media-container">
															<img src="images/blog/post2-small.jpg" class="img-responsive" alt="lats post">
														</figure>
													</a>
													<h4><a href="single.html">Free shipping for regular customers.</a></h4>
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque fuga officia in molestiae easint..</p>
													<div class="recent-posts-meta-container clearfix">
														<div class="pull-left">
															<a href="#">Read More...</a>
														</div><!-- End .pull-left -->
														<div class="pull-right">
															10.05.2013
														</div><!-- End .pull-right -->
													</div><!-- End .recent-posts-meta-container -->
												</li>
												
												<li>
													<a href="single.html">
														<figure class="recent-posts-media-container">
															<img src="images/blog/post3-small.jpg" class="img-responsive" alt="lats post">
														</figure>
													</a>
													<h4><a href="#">New jeans on sales!</a></h4>
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque fuga officia in molestiae easint..</p>
													<div class="recent-posts-meta-container clearfix">
														<div class="pull-left">
															<a href="#">Read More...</a>
														</div><!-- End .pull-left -->
														<div class="pull-right">
															8.05.2013
														</div><!-- End .pull-right -->
													</div><!-- End .recent-posts-meta-container -->
												</li>
											</ul>
										</div><!-- End .recent-posts-slider -->
									</div><!-- End .widget -->
								</aside><!-- End .col-md-3 -->
							</div><!-- End .row -->
						</div><!-- End .col-md-12 -->
                    </div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
