@extends('layouts.app', ['page_title' => __('auth.login')])

@section('app-content')


			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li class="active">@lang('auth.login')</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<header class="content-title">
								<h1 class="title">@lang('miscellaneous.login_title2')</h1>
								<div class="md-margin"></div><!-- space -->
							</header>

							<div class="row">

								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="lead">@lang('miscellaneous.login_description')</p>
									<a href="{{ route('register') }}" class="lead text-uppercase">@lang('miscellaneous.register_title2') <i class="bi bi-chevron-double-right"></i></a>
									<div class="lg-margin"></div><!-- space -->
								</div><!-- End .col-md-6 -->
								<div class="col-md-6 col-sm-6 col-xs-12">
									<form id="login-form" method="POST" action="{{ route('login') }}">
    @csrf

	@if (request()->has('product_id'))
										<input type="hidden" name="product_id" value="{{ request()->get('product_id') }}">
	@endif

	@if (request()->has('cart'))
										<input type="hidden" name="cart" value="{{ request()->get('cart') }}">
	@endif

                                        <div class="input-group" style="margin-bottom: 5px">
											<span class="input-group-addon">
                                                <span class="input-icon input-icon-email"></span>
                                                <span class="input-text">@lang('miscellaneous.email_phone')</span>
                                            </span>
                                            <input type="text" name="login" id="sign_login" required class="form-control input-lg @error('login') is-invalid @enderror" value="{{ old('login') }}" placeholder="@lang('miscellaneous.login_username')">
										</div><!-- End .input-group -->

                                        <div class="input-group xs-margin" style="position: relative; margin-bottom: 5px;">
											<span class="input-group-addon">
                                                <span class="input-icon input-icon-password"></span>
                                                <span class="input-text">@lang('miscellaneous.password.label')</span>
                                            </span>
                                            <input type="password" name="password" id="sign_password" required class="form-control input-lg @error('password') is-invalid @enderror" placeholder="@lang('miscellaneous.password.label')">
											<button id="showPassword" class="btn" style="position: absolute; top: 5px; right: 5px; z-index: 999; background-color: transparent; padding: 5px;" onclick="event.preventDefault(); passwordVisible(this, 'sign_password');">
												<i class="bi bi-eye-fill"></i>
											</button>
										</div><!-- End .input-group -->
    @error('login')
                                        <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
    @enderror
    @error('password')
                                        <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
    @enderror

                                        <div class="xs-margin"></div>

                                        <button class="btn btn-custom-2">@lang('auth.login')</button>
                                        <span style="display: inline-block; margin-left: 20px;"><a href="{{ route('password.request') }}">@lang('miscellaneous.forgotten_password')</a> <i class="bi bi-chevron-double-right"></i></span>
									</form>
									<div class="sm-margin"></div><!-- space -->
								</div><!-- End .col-md-6 -->

							</div><!-- End.row -->

						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->


@endsection
