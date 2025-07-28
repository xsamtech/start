@extends('layouts.app', ['page_title' => __('auth.reset-password')])

@section('app-content')


			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li class="active">@lang('auth.reset-password')</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<header class="content-title">
								<h1 class="title">@lang('auth.reset-password')</h1>
								<div class="md-margin"></div><!-- space -->
							</header>

							<div class="row">

								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="lead">@lang('miscellaneous.reset_password_info')</p>
									<a href="{{ route('login') }}" class="lead text-uppercase">@lang('miscellaneous.cancel') <i class="bi bi-chevron-double-right"></i></a>
									<div class="lg-margin"></div><!-- space -->
								</div><!-- End .col-md-6 -->
								<div class="col-md-6 col-sm-6 col-xs-12">
									<form id="login-form" method="POST" action="{{ route('password.reset') }}">
    @csrf
                                        <!-- Password -->
                                        <div class="input-group" style="margin-bottom: 5px;">
											<span class="input-group-addon">
                                                <span class="input-icon input-icon-password"></span>
                                                <span class="input-text">@lang('miscellaneous.password.label') <span class="text-danger">&#42;</span></span>
                                            </span>
											<input type="password" name="new_password" id="register_password" class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.password.label')">
											<a id="showNewPassword" class="btn" style="position: absolute; top: 5px; right: 5px; z-index: 999; background-color: transparent; padding: 5px; cursor: pointer;" onclick="event.preventDefault(); passwordVisible(this, 'register_password');">
												<i class="bi bi-eye-fill"></i>
											</a>
										</div><!-- End .input-group -->

    @error('new_password')
                                        <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
    @enderror
                                        <!-- Password confirmation -->
                                        <div class="input-group" style="margin-bottom: 5px;">
											<span class="input-group-addon">
                                                <span class="input-icon input-icon-password"></span>
                                                <span class="input-text">@lang('miscellaneous.confirm') <span class="text-danger">&#42;</span></span>
                                            </span>
											<input type="password" name="confirm_new_password" id="register_confirm_password" class="form-control input-lg" placeholder="@lang('auth.confirm-password')">
											<a id="showConfirmNewPassword" class="btn" style="position: absolute; top: 5px; right: 5px; z-index: 999; background-color: transparent; padding: 5px; cursor: pointer;" onclick="event.preventDefault(); passwordVisible(this, 'register_confirm_password');">
												<i class="bi bi-eye-fill"></i>
											</a>
										</div><!-- End .input-group -->
    @error('confirm_new_password')
                                        <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
    @enderror

                                        <div class="xs-margin"></div>

                                        <button class="btn btn-custom-2">@lang('miscellaneous.register')</button>
									</form>
									<div class="sm-margin"></div><!-- space -->
								</div><!-- End .col-md-6 -->

							</div><!-- End.row -->

						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->


@endsection
