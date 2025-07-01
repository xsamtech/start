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
									{{-- <div class="md-margin"></div><!-- space --> --}}
									<a href="{{ route('register') }}" class="btn btn-custom-2">@lang('miscellaneous.register_title2')</a>
									<div class="lg-margin"></div><!-- space -->
								</div><!-- End .col-md-6 -->
								<div class="col-md-6 col-sm-6 col-xs-12">
									{{-- <div class="xs-margin"></div> --}}

									<form id="login-form" method="POST" action="{{ route('login') }}">
    @csrf
                                        <div class="input-group" style="margin-bottom: 5px">
											<span class="input-group-addon">
                                                <span class="input-icon input-icon-email"></span>
                                                <span class="input-text">@lang('miscellaneous.email_phone')</span>
                                            </span>
                                            <input type="text" name="login" required class="form-control input-lg @error('login') is-invalid @enderror" placeholder="@lang('miscellaneous.login_username')">
										</div><!-- End .input-group -->

    @error('login')
                                        <p class="text-danger text-right" style="margin-bottom: 0;">{{ $message }}</p>
    @enderror

                                        <div class="xs-margin"></div>

                                        <div class="input-group xs-margin" style="margin-bottom: 5px">
											<span class="input-group-addon">
                                                <span class="input-icon input-icon-password"></span>
                                                <span class="input-text">@lang('miscellaneous.password.label')&#42;</span>
                                            </span>
                                            <input type="password" name="password" required class="form-control input-lg @error('password') is-invalid @enderror" placeholder="@lang('miscellaneous.password.label')">
										</div><!-- End .input-group -->
    @error('password')
                                        <p class="text-danger text-right" style="margin-bottom: 0;">{{ $message }}</p>
    @enderror

                                        <div class="xs-margin"></div>

                                        <div class="d-flex justify-content-between">
                                        </div>
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
