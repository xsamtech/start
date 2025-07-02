@extends('layouts.app', ['page_title' => __('auth.register')])

@section('app-content')


			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li class="active">@lang('auth.register')</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<header class="content-title">
								<h1 class="title">@lang('auth.register')</h1>
								<p class="title-desc">@lang('miscellaneous.go_login') <a href="{{ route('login') }}">@lang('auth.login')</a>.</p>
							</header>

                            <div class="xs-margin"></div><!-- space -->

                            <form action="{{ route('register') }}" id="register-form">
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<fieldset>
											<h2 class="sub-title text-uppercase">@lang('miscellaneous.account.personal_infos.title')</h2>

                                            <!-- Avatar -->
                                            <div id="profileImageWrapper" style="margin-bottom: 5px;">
                                                <div style="display: flex; justify-content: center; align-items: center;">
                                                    <img src="{{ asset('assets/img/user.png') }}" alt="Avatar" width="200" class="other-user-image" style="border-radius: 5px;">
                                                    <label role="button" for="image_profile" class="btn btn-sm btn-default pt-2" style="margin-left: 5px;">
                                                        <i class="bi bi-pencil-fill text-white" style="margin-right: 5px;"></i>@lang('miscellaneous.change_image')
                                                        <input type="file" name="image_profile" id="image_profile" style="display: none;">
                                                    </label>
                                                </div>
                                                <input type="hidden" name="image_64" id="image_64">
                                            </div>

                                            <!-- First name -->
                                            <div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon">
                                                    <span class="input-icon input-icon-user"></span>
                                                    <span class="input-text">@lang('miscellaneous.firstname') <span class="text-danger">&#42;</span></span>
                                                </span>
												<input type="text" name="firstname" required id="firstname" class="form-control input-lg @error('firstname') is-invalid @enderror" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.firstname')" autofocus>
											</div><!-- End .input-group -->
    @error('firstname')
                                            <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
    @enderror

                                            <!-- Last name -->
                                            <div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon">
                                                    <span class="input-icon input-icon-user"></span>
                                                    <span class="input-text">@lang('miscellaneous.lastname')</span>
                                                </span>
                                                <input type="text" name="lastname" id="lastname" class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.lastname')">
											</div><!-- End .input-group -->
 
                                            <!-- Surname -->
                                            <div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon">
                                                    <span class="input-icon input-icon-user"></span>
                                                    <span class="input-text">@lang('miscellaneous.surname')</span>
                                                </span>
                                                <input type="text" name="surname" id="surname" class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.surname')">
											</div><!-- End .input-group -->

                                            <!-- Birth date -->
                                            <div class="input-group" style="margin-bottom: 5px; z-index: 5;">
												<span class="input-group-addon">
                                                    <span class="input-icon input-icon-region"></span>
                                                    <span class="input-text">@lang('miscellaneous.birth_date.label2')</span>
                                                </span>
												<input type="text" name="birthdate" id="birthdate" class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.birth_date.label')">
											</div><!-- End .input-group -->

                                            <!-- Gender -->
                                            <div class="text-center">
                                                <p style="margin-bottom: 0">@lang('miscellaneous.gender_title')</p>

                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender1" value="M"><span class="text-muted">@lang('miscellaneous.gender1')</span>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender2" value="F"><span class="text-muted">@lang('miscellaneous.gender2')</span>
                                                </label>
                                            </div>

                                            <!-- E-mail -->
                                            <div class="input-group" style="margin: 5px 0;">
												<span class="input-group-addon">
                                                    <span class="input-icon input-icon-email"></span>
                                                    <span class="input-text">@lang('miscellaneous.email')</span>
                                                </span>
												<input type="text" name="email" class="form-control input-lg @error('email') is-invalid @enderror" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.email')">
											</div><!-- End .input-group -->
    @error('email')
                                            <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
    @enderror

                                            <!-- Phone -->
                                            <div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon">
                                                    <span class="input-icon input-icon-phone"></span>
                                                    <span class="input-text">@lang('miscellaneous.phone') <span class="text-danger">&#42;</span></span>
                                                </span>
												<input type="text" name="email" class="form-control input-lg @error('phone') is-invalid @enderror" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.phone_number')">
											</div><!-- End .input-group -->
    @error('phone')
                                            <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
    @enderror
										</fieldset>
									</div><!-- End .col-md-6 -->

									<div class="col-md-6 col-sm-6 col-xs-12">
                                        <fieldset>
											<h2 class="sub-title text-uppercase">@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.address.title')</h2>

                                            <!-- Address 1 -->
											<div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon">
                                                    <span class="input-icon input-icon-address"></span>
                                                    <span class="input-text">@lang('miscellaneous.address.title') 1</span>
                                                </span>
												<input type="text" name="address_1" id="address_1" class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.address.title')">
											</div><!-- End .input-group -->

                                            <!-- Address 2 -->
											<div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon">
                                                    <span class="input-icon input-icon-address"></span>
                                                    <span class="input-text">@lang('miscellaneous.address.title') 2</span>
                                                </span>
												<input type="text" name="address_2" id="address_2" class="form-control input-lg" placeholder="@lang('miscellaneous.address.line2')">
											</div><!-- End .input-group -->

                                            <div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon">
                                                    <span class="input-icon input-icon-city"></span>
                                                    <span class="input-text">@lang('miscellaneous.address.city')</span>
                                                </span>
												<input type="text" required class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.address.city')">
											</div><!-- End .input-group -->

                                            <div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon">
                                                    <span class="input-icon input-icon-country"></span>
                                                    <span class="input-text">@lang('miscellaneous.country')</span>
                                                </span>
												<div class="large-selectbox clearfix">
													<select id="country" name="country" class="selectbox form-control input-lg">
														<option class="small" disabled selected>@lang('miscellaneous.choose_country')</option>
    @forelse ($countries as $country)
														<option>{{ $country['name'] }}</option>
    @empty
    @endforelse
													</select>
												</div><!-- End .large-selectbox-->
											</div><!-- End .input-group -->

                                            <!-- Abour me -->
                                            <div class="input-group textarea-container" style="z-index: 3">
                                                <span class="input-group-addon"><span class="input-icon input-icon-message"></span><span class="input-text">@lang('miscellaneous.about_user.label')</span></span>
                                                <textarea name="about_me" id="about_me" class="form-control" cols="30" rows="4" placeholder="@lang('miscellaneous.about_user.placeholder')"></textarea>
                                            </div><!-- End .input-group -->
										</fieldset>
                                        
										<fieldset>
											<h2 class="sub-title text-uppercase">@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.password.label')</h2>
											<div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon">
                                                    <span class="input-icon input-icon-password"></span>
                                                    <span class="input-text">@lang('miscellaneous.password.label') <span class="text-danger">&#42;</span></span>
                                                </span>
												<input type="password" name="password" class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.password.label')">
											</div><!-- End .input-group -->
											<div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon">
                                                    <span class="input-icon input-icon-password"></span>
                                                    <span class="input-text">@lang('miscellaneous.confirm') <span class="text-danger">&#42;</span></span>
                                                </span>
												<input type="password" name="password_confirmation" class="form-control input-lg" placeholder="@lang('auth.confirm-password')">
											</div><!-- End .input-group -->
										</fieldset>

                                        <button class="btn btn-custom-2" style="width: 300px;">@lang('auth.register')</button>
									</div><!-- End .col-md-6 -->

								</div><!-- End .row -->
							</form>

                        </div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->


@endsection
