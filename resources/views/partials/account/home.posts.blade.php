
			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li class="active">@lang('miscellaneous.menu.account.title')</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<header class="content-title">
								<h1 class="title" style="margin-bottom: 5px;">@lang('miscellaneous.menu.account.post.news')</h1>
								<p class="title-desc"><i class="bi bi-mortarboard" style="font-size: 2.5rem; vertical-align: -3px"></i> {{ !empty($current_user->selected_role) ? $current_user->selected_role->role_name : 'NO-ROLE' }}</p>
							</header>

							<ul id="portfolio-filter" class="clearfix">
								<li><a href="{{ route('account.home') }}">@lang('miscellaneous.menu.account.title')</a></li>
								<li><a class="active">@lang('miscellaneous.menu.account.cart')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'projects']) }}">@lang('miscellaneous.menu.account.project.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'products']) }}">@lang('miscellaneous.menu.account.product.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'services']) }}">@lang('miscellaneous.menu.account.service.title')</a></li>
							</ul><!-- End .portfolio-filter -->

							<div class="row portfolio-item-container" data-maxcolumn="2" data-layoutmode="fitRows">

                            </div><!-- End.row -->

						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
