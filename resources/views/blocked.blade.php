@php
	$status = null;
	$icon = null;

	switch (auth()->user()->status) {
		case 'disabled':
			$status = 'deactivated';
			$icon = 'bi-shield-shaded text-danger';
			break;

		case 'deleted':
			$status = 'deleted';
			$icon = 'bi-trash text-primary';
			break;

		default:
			$status = 'locked';
			$icon = 'bi-person-lock text-danger';
			break;
	}
@endphp

@extends('layouts.app', ['page_title' => __('miscellaneous.account.' . $status . '.title')])

@section('app-content')

			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li class="active">{{ __('miscellaneous.account.' . $status . '.title') }}</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<header class="content-title">
								<h1 class="title" style="margin-bottom: 5px;">@lang('miscellaneous.account.' . $status . '.title')</h1>
							</header>

							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="row">
										<div class="col-md-4 col-sm-5 col-xs-12">
		                                    <img src="{{ !empty($current_user->avatar_url) ? $current_user->avatar_url : asset('assets/img/user.png') }}" alt="{{ $current_user->firstname . ' ' . $current_user->lastname }}" class="user-image img-fluid img-thumbnail rounded-4">
										</div>
										<div class="col-md-8 col-sm-7 col-xs-12">
											<h3 style="font-weight: bold; max-width: 250px; margin-top: 30px;">{{ $current_user->firstname . ' ' . $current_user->lastname . ' ' . $current_user->surname }}</h3>
											<p class="text-muted" style="margin: 0;">
												<i class="bi bi-envelope-fill" style="margin-right: 10px;"></i><a href="mailto:{{  $current_user->email }}">{{ $current_user->email }}</a>
											</p>
											<p class="text-muted" style="margin: 0;">
												<i class="bi bi-telephone-fill" style="margin-right: 10px;"></i>{{ $current_user->phone }}
											</p>
										</div>
									</div>
								</div><!-- End .col-md-6 -->

								<div class="col-md-6 col-sm-6 col-xs-12">
									<i class="bi {{ $icon }}" style="font-size: 70px;"></i>
									<p class="lead" style="margin-top: 0;">@lang('miscellaneous.account.' . $status . '.message')</p>

	@if (auth()->user()->status === 'disabled' || auth()->user()->status === 'deleted')
									<form action="{{ route('user.status', ['id' => auth()->id()]) }}" method="POST">
		@csrf
										<input type="hidden" name="status" value="activated">
										<button type="submit" class="btn btn-custom-2">@lang('miscellaneous.alert.attention.account.activate')</button>
									</form>
	@endif
								</div><!-- End .col-md-6 -->
							</div><!-- End .row -->

						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->

@endsection
