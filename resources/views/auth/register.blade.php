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

                                            <!-- E-mail -->
                                            <div class="input-group" style="margin-bottom: 5px">
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

                                            <!-- Abour me -->
                                            <div class="input-group textarea-container">
                                                <span class="input-group-addon"><span class="input-icon input-icon-message"></span><span class="input-text">@lang('miscellaneous.about_user.label')</span></span>
                                                <textarea name="about_me" id="about_me" class="form-control" cols="30" rows="6" placeholder="@lang('miscellaneous.about_user.placeholder')"></textarea>
                                            </div><!-- End .input-group -->
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

                                            <!-- P.O. box -->
                                            <div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon">
                                                    <span class="input-icon input-icon-postcode"></span>
                                                    <span class="input-text">@lang('miscellaneous.p_o_box') <span class="text-danger">&#42;</span></span>
                                                </span>
												<input type="text" name="p_o_box"tidme="p_o_box" class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.p_o_box')">
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
                                                    <span class="input-text">Country</span>
                                                </span>
												<div class="large-selectbox clearfix">
													<select id="country" name="country" class="selectbox form">
														<option value="United Kingdom">United Kingdom</option>
														<option value="Brazil">Brazil</option>
														<option value="France">France</option>
														<option value="Italy">Italy</option>
														<option value="Spain">Spain</option>
													</select>
												</div><!-- End .large-selectbox-->
											</div><!-- End .input-group -->

											<div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon"><span
														class="input-icon input-icon-region"></span><span
														class="input-text">Region / State <span class="text-danger">&#42;</span></span></span>
												<div class="large-selectbox clearfix">
													<select id="state" name="state" class="selectbox">
														<option value="California">California</option>
														<option value="Texas">Texas</option>
														<option value="NewYork">NewYork</option>
														<option value="Narnia">Narnia</option>
														<option value="Jumanji">Jumanji</option>
													</select>
												</div><!-- End .large-selectbox-->
											</div><!-- End .input-group -->

										</fieldset>
                                        
										<fieldset>
											<h2 class="sub-title">YOUR PASSWORD</h2>
											<div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon"><span
														class="input-icon input-icon-password"></span><span
														class="input-text">Password <span class="text-danger">&#42;</span></span></span>
												<input type="password" required class="form-control input-lg"
													placeholder="Your Password">
											</div><!-- End .input-group -->
											<div class="input-group" style="margin-bottom: 5px">
												<span class="input-group-addon"><span
														class="input-icon input-icon-password"></span><span
														class="input-text">Password <span class="text-danger">&#42;</span></span></span>
												<input type="password" required class="form-control input-lg"
													placeholder="Your Password">
											</div><!-- End .input-group -->
										</fieldset>

									</div><!-- End .col-md-6 -->

								</div><!-- End .row -->
							</form>
						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->


@endsection
