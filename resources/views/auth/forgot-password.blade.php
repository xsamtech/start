@extends('layouts.app', ['page_title' => (session()->has('email') || session()->has('phone') ? __('notifications.token_title') : (request()->get('check') == 'phone' ? __('auth.verify-phone') : __('auth.verify-email')))])

@section('app-content')


			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li class="active">{{ session()->has('email') || session()->has('phone') ? __('notifications.token_title') : __('auth.verify-email-phone') }}</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<header class="content-title">
								<h1 class="title">{{ session()->has('email') || session()->has('phone') ? __('notifications.token_title') : __('auth.verify-email-phone') }}</h1>
								<div class="md-margin"></div><!-- space -->
							</header>

							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="lead">{{ session()->has('email') || session()->has('phone') ? __('notifications.token_sent') : __('miscellaneous.forgotten_password_info') }}</p>
									<a href="{{ route('login') }}" class="lead text-uppercase">@lang('miscellaneous.cancel') <i class="bi bi-chevron-double-right"></i></a>
									<div class="lg-margin"></div><!-- space -->
								</div><!-- End .col-md-6 -->
								<div class="col-md-6 col-sm-6 col-xs-12">
									<form id="login-form" method="POST" action="{{ session()->has('email') || session()->has('phone') ? route('token.request') : route('password.request') }}">
    @csrf

    @if (session()->has('email') || session()->has('phone'))
									    <p class="lead" style="font-weight: 700;">@lang('notifications.token_title')</p>
                                        <div class="input-group" style="margin-bottom: 5px">
											<span class="input-group-addon">
                                                <span class="input-icon input-icon-password"></span>
                                                <span class="input-text">@lang('notifications.token_label')</span>
                                            </span>
                                            <input type="text" name="token" id="check_token" required class="form-control input-lg @error('token') is-invalid @enderror" value="{{ old('token') }}" placeholder="@lang('notifications.token_placeholder')">
										</div><!-- End .input-group -->
        @error('token')
                                        <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
        @enderror

                                        <div class="xs-margin"></div>

                                        <button class="btn btn-custom-2">@lang('miscellaneous.send')</button>
        
    @else
        @if (request()->get('check') == 'phone')
									    <p class="lead" style="font-weight: 700;">@lang('auth.verify-phone')</p>
                                        <div class="input-group" style="margin-bottom: 5px">
											<span class="input-group-addon">
                                                <span class="input-icon input-icon-phone"></span>
                                                <span class="input-text">@lang('miscellaneous.phone')</span>
                                            </span>
                                            <input type="text" name="data" id="check_data" required class="form-control input-lg @error('data') is-invalid @enderror" value="{{ old('data') }}" placeholder="@lang('miscellaneous.phone_number')">
										</div><!-- End .input-group -->
            @error('data')
                                        <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
            @enderror
        @else
									    <p class="lead" style="font-weight: 700;">@lang('auth.verify-email')</p>
                                        <div class="input-group" style="margin-bottom: 5px">
											<span class="input-group-addon">
                                                <span class="input-icon input-icon-email"></span>
                                                <span class="input-text">@lang('miscellaneous.email')</span>
                                            </span>
                                            <input type="text" name="data" id="check_data" required class="form-control input-lg @error('data') is-invalid @enderror" value="{{ old('data') }}" placeholder="@lang('miscellaneous.email')">
										</div><!-- End .input-group -->
            @error('data')
                                        <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
            @enderror
        @endif

                                        <div class="xs-margin"></div>

                                        <button class="btn btn-custom-2">@lang('miscellaneous.send')</button>
        @if (request()->get('check') == 'phone')
                                        <span style="display: inline-block; margin-left: 20px;"><a href="{{ route('password.request') }}">@lang('auth.verify-email')</a> <i class="bi bi-chevron-double-right"></i></span>
        @else
                                        <span style="display: inline-block; margin-left: 20px;"><a href="{{ route('password.request', ['check' => 'phone']) }}">@lang('auth.verify-phone')</a> <i class="bi bi-chevron-double-right"></i></span>
        @endif
    @endif
									</form>
									<div class="sm-margin"></div><!-- space -->
								</div><!-- End .col-md-6 -->

							</div><!-- End.row -->

						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->


@endsection
