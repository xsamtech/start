
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
								<h1 class="title" style="margin-bottom: 5px;">@lang('miscellaneous.menu.notifications')</h1>
								<p class="title-desc"><i class="bi bi-person" style="font-size: 2.5rem; vertical-align: -3px"></i> {{ $current_user->firstname . ' ' . $current_user->lastname }}</p>
							</header>

@if (count($items['unread']) > 0 || count($items['read']) > 0)
							<div class="row">
								<div class="col-md-12">
									<div class="list-group">
	@forelse ($items['unread'] as $notif)
										<a href="{{ $notif['url'] }}" class="list-group-item list-group-item-action bg-light" style="color: #000;; padding: 10px 5px;">
											<div id="notificationItem">
												<p style="margin-bottom: 0;">
													{!! $notif['text'] !!}
												</p>
												<small class="text-muted">{{ ucfirst(explicitDate($notif['created_at'])) }}</small>
											</div>
										</a>
		
	@empty
	@endforelse
	@forelse ($items['read'] as $notif)
										<a href="{{ $notif['url'] }}" class="list-group-item list-group-item-action" style="color: #000;; padding: 10px 5px;">
											<div id="notificationItem">
												<p style="margin-bottom: 0;">
													{!! $notif['text'] !!}
												</p>
												<small class="text-muted">{{ ucfirst(explicitDate($notif['created_at'])) }}</small>
											</div>
										</a>
		
	@empty
	@endforelse
									</div>
								</div><!-- End .col-md-12 -->
							</div><!-- End .row -->
	
@else
							<div class="row">
								<div class="col-md-12">
									<div style="display: flex; justify-content: center; align-items: flex-end; height: 100px;">
										<i class="bi bi-bell" style="font-size: 10rem"></i>
									</div>
									<h3 class="text-center">@lang('miscellaneous.empty_list')</h3>
								</div><!-- End .col-md-12 -->
							</div><!-- End .row -->
	
@endif

						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
