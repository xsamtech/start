
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
								<h1 class="title" style="margin-bottom: 5px;">{{ $current_user->firstname . ' ' . $current_user->lastname }}</h1>
								<p class="title-desc"><i class="bi bi-mortarboard" style="font-size: 2.5rem; vertical-align: -3px"></i> {{ !empty($current_user->selected_role) ? $current_user->selected_role->role_name : 'NO-ROLE' }}</p>
							</header>

							<ul id="portfolio-filter" class="clearfix">
								<li><a href="{{ route('account.home') }}">@lang('miscellaneous.menu.account.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'cart']) }}">@lang('miscellaneous.menu.account.cart')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'projects']) }}">@lang('miscellaneous.menu.account.project.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'products']) }}">@lang('miscellaneous.menu.account.product.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'services']) }}">@lang('miscellaneous.menu.account.service.title')</a></li>
							</ul><!-- End .portfolio-filter -->

							<div class="row portfolio-item-container" data-maxcolumn="2" data-layoutmode="fitRows">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-11" style="margin-bottom: 25px;">
                                    <div class="view" style="position: relative;">
                                        <img src="{{ !empty($current_user->avatar_url) ? $current_user->avatar_url : asset('assets/img/user.png') }}" alt="{{ $current_user->firstname . ' ' . $current_user->lastname }}" class="user-image img-fluid img-thumbnail rounded-4">
                                        <form method="POST">
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $current_user->id }}">
                                            <label for="avatar" class="btn btn-custom" style="position: absolute; bottom: -0.5rem; right: -0.5rem; z-index: 9; width: 5rem; height: 5rem; padding: 1rem; border-radius: 900px;" title="@lang('miscellaneous.change_image')" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                <span class="bi bi-pencil-fill" style="font-size: 2.1rem; color: #fff;"></span>
                                                <input type="file" name="avatar" id="avatar" style="display: none;">
                                            </label>
                                        </form>
                                    </div>

                                    <div style="margin-top: 25px;">
                                        <h3>{{ $current_user->firstname . ' ' . $current_user->surname . ' ' . $current_user->lastname }}</h3>
@if (!empty($current_user->about_me))
                                        <p class="text-muted">{{ $current_user->about_me }}</p>
                                        <hr style="border-color: rgba(0, 0, 0, 0.3);">
@endif
@if (!empty($current_user->birthdate))
                                        <p class="small" style="margin-bottom: 0;"><u>@lang('miscellaneous.birth_date.label')</u></p>
                                        <p class="small"><span class="text-muted">{{ ucfirst(__('miscellaneous.on_date')) . ' ' . explicitDate($current_user->birthdate) }}</span></p>
@endif
@if (!empty($current_user->country))
                                        <p class="small"><u>@lang('miscellaneous.country')</u>@lang('miscellaneous.colon_after_word') <span class="text-muted">{{ $current_user->country }}</span></p>
@endif
@if (!empty($current_user->city))
                                        <p class="small"><u>@lang('miscellaneous.address.city')</u>@lang('miscellaneous.colon_after_word') <span class="text-muted">{{ $current_user->city }}</span></p>
@endif
@if (!empty($current_user->address_1) && !empty($current_user->address_2))
                                        <p class="small" style="margin-bottom: 0"><u>@lang('miscellaneous.addresses')</u></p>
                                        <ul>
                                            <li><span class="text-muted">{{ $current_user->address_1 }}</span></li>
                                            <li><span class="text-muted">{{ $current_user->address_2 }}</span></li>
                                        </ul>
@else
    @if (!empty($current_user->address_1))
                                        <p class="small" style="margin-bottom: 0;"><u>@lang('miscellaneous.address.title')</u></p>
                                        <p class="small"><span class="text-muted">{{ $current_user->address_1 }}</span></p>
    @endif
    @if (!empty($current_user->address_2))
                                        <p class="small" style="margin-bottom: 0;"><u>@lang('miscellaneous.address.title')</u></p>
                                        <p class="small"><span class="text-muted">{{ $current_user->address_2 }}</span></p>
    @endif
@endif
                                    </div>
                                </div>

                                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12" style="margin: 0 auto;">
                                    <form method="POST" action="{{ route('account.home') }}" id="register-form">
@csrf
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <fieldset>
                                                    <h2 class="sub-title text-uppercase">@lang('miscellaneous.account.personal_infos.title')</h2>

                                                    <!-- First name -->
                                                    <div class="input-group" style="margin-bottom: 5px;">
                                                        <span class="input-group-addon">
                                                            <span class="input-icon input-icon-user"></span>
                                                            <span class="input-text">@lang('miscellaneous.firstname') <span class="text-danger">&#42;</span></span>
                                                        </span>
                                                        <input type="text" name="firstname" required id="firstname" class="form-control input-lg @error('firstname') is-invalid @enderror" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.firstname')" value="{{ $current_user->firstname }}">
                                                    </div><!-- End .input-group -->
@error('firstname')
                                                    <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
@enderror

                                                    <!-- Last name -->
                                                    <div class="input-group" style="margin-bottom: 5px;">
                                                        <span class="input-group-addon">
                                                            <span class="input-icon input-icon-user"></span>
                                                            <span class="input-text">@lang('miscellaneous.lastname')</span>
                                                        </span>
                                                        <input type="text" name="lastname" id="lastname" class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.lastname')" value="{{ $current_user->lastname }}">
                                                    </div><!-- End .input-group -->
        
                                                    <!-- Surname -->
                                                    <div class="input-group" style="margin-bottom: 5px;">
                                                        <span class="input-group-addon">
                                                            <span class="input-icon input-icon-user"></span>
                                                            <span class="input-text">@lang('miscellaneous.surname')</span>
                                                        </span>
                                                        <input type="text" name="surname" id="surname" class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.surname')" value="{{ $current_user->surname }}">
                                                    </div><!-- End .input-group -->

                                                    <!-- Birth date -->
                                                    <div class="input-group" style="margin-bottom: 5px; z-index: 5;">
                                                        <span class="input-group-addon">
                                                            <span class="input-icon input-icon-region"></span>
                                                            <span class="input-text">@lang('miscellaneous.birth_date.label2')</span>
                                                        </span>
                                                        <input type="text" name="birthdate" id="birthdate" class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.birth_date.label')" value="{{ !empty($current_user->birthdate) ? date('m/d/Y', strtotime($current_user->birthdate)) : '' }}">
                                                    </div><!-- End .input-group -->

                                                    <!-- Gender -->
                                                    <div class="text-center">
                                                        <p style="margin-bottom: 0">@lang('miscellaneous.gender_title')</p>

                                                        <label class="radio-inline">
                                                            <input type="radio" name="gender" id="gender1" value="M"{{ $current_user->gender == 'M' ? ' checked' : '' }}><span class="text-muted">@lang('miscellaneous.gender1')</span>
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="gender" id="gender2" value="F"{{ $current_user->gender == 'F' ? ' checked' : '' }}><span class="text-muted">@lang('miscellaneous.gender2')</span>
                                                        </label>
                                                    </div>

                                                    <!-- E-mail -->
                                                    <div class="input-group" style="margin: 5px 0;">
                                                        <span class="input-group-addon">
                                                            <span class="input-icon input-icon-email"></span>
                                                            <span class="input-text">@lang('miscellaneous.email')</span>
                                                        </span>
                                                        <input type="text" name="email" class="form-control input-lg @error('email') is-invalid @enderror" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.email')" value="{{ $current_user->email }}">
                                                    </div><!-- End .input-group -->
@error('email')
                                                    <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
@enderror

                                                    <!-- Phone -->
                                                    <div class="input-group" style="margin-bottom: 5px;">
                                                        <span class="input-group-addon">
                                                            <span class="input-icon input-icon-phone"></span>
                                                            <span class="input-text">@lang('miscellaneous.phone') <span class="text-danger">&#42;</span></span>
                                                        </span>
                                                        <input type="text" name="phone" class="form-control input-lg @error('phone') is-invalid @enderror" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.phone_number')" value="{{ $current_user->phone }}">
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
                                                    <div class="input-group" style="margin-bottom: 5px;">
                                                        <span class="input-group-addon">
                                                            <span class="input-icon input-icon-address"></span>
                                                            <span class="input-text">@lang('miscellaneous.address.title') 1</span>
                                                        </span>
                                                        <input type="text" name="address_1" id="address_1" class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.address.title')" value="{{ $current_user->address_1 }}">
                                                    </div><!-- End .input-group -->

                                                    <!-- Address 2 -->
                                                    <div class="input-group" style="margin-bottom: 5px;">
                                                        <span class="input-group-addon">
                                                            <span class="input-icon input-icon-address"></span>
                                                            <span class="input-text">@lang('miscellaneous.address.title') 2</span>
                                                        </span>
                                                        <input type="text" name="address_2" id="address_2" class="form-control input-lg" placeholder="@lang('miscellaneous.address.line2')" value="{{ $current_user->address_2 }}">
                                                    </div><!-- End .input-group -->

                                                    <!-- City -->
                                                    <div class="input-group" style="margin-bottom: 5px;">
                                                        <span class="input-group-addon">
                                                            <span class="input-icon input-icon-city"></span>
                                                            <span class="input-text">@lang('miscellaneous.address.city')</span>
                                                        </span>
                                                        <input type="text" class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.address.city')" value="{{ $current_user->city }}">
                                                    </div><!-- End .input-group -->

                                                    <!-- Country -->
                                                    <div class="input-group" style="margin-bottom: 5px;">
                                                        <span class="input-group-addon">
                                                            <span class="input-icon input-icon-country"></span>
                                                            <span class="input-text">@lang('miscellaneous.country')</span>
                                                        </span>
                                                        <div class="large-selectbox clearfix">
                                                            <select id="country" name="country" class="selectbox form-control input-lg">
                                                                <option class="small" disabled{{ empty($current_user->country) ? ' selected' : '' }}>@lang('miscellaneous.choose_country')</option>
@forelse ($countries as $country)
        														<option {{ !empty($current_user->country) && $current_user->country == $country['name'] ? ' selected' : '' }}>{{ $country['name'] }}</option>
@empty
@endforelse
                                                            </select>
                                                        </div><!-- End .large-selectbox-->
                                                    </div><!-- End .input-group -->

                                                    <!-- Abour me -->
                                                    <div class="input-group textarea-container" style="z-index: 3">
                                                        <span class="input-group-addon"><span class="input-icon input-icon-message"></span><span class="input-text">@lang('miscellaneous.about_user.label')</span></span>
                                                        <textarea name="about_me" id="about_me" class="form-control" cols="30" rows="4" placeholder="@lang('miscellaneous.about_user.placeholder')">{{ $current_user->about_me }}</textarea>
                                                    </div><!-- End .input-group -->
                                                </fieldset>
                                                
                                                <fieldset>
                                                    <h2 class="sub-title text-uppercase">@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.password.label')</h2>

                                                    <!-- Password -->
                                                    <div class="input-group" style="position: relative; margin-bottom: 5px;">
                                                        <span class="input-group-addon">
                                                            <span class="input-icon input-icon-password"></span>
                                                            <span class="input-text">@lang('miscellaneous.password.label') <span class="text-danger">&#42;</span></span>
                                                        </span>
                                                        <input type="password" name="password" id="register_password" class="form-control input-lg" placeholder="@lang('miscellaneous.ones_you_masculine') @lang('miscellaneous.password.label')">
                                                        <button id="showPassword" class="btn" style="position: absolute; top: 5px; right: 5px; z-index: 999; background-color: transparent; padding: 5px;" onclick="event.preventDefault(); passwordVisible(this, 'register_password');">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    </div><!-- End .input-group -->

@error('password')
                                                    <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
@enderror
                                                    <!-- Password confirmation -->
                                                    <div class="input-group" style="position: relative; margin-bottom: 5px;">
                                                        <span class="input-group-addon">
                                                            <span class="input-icon input-icon-password"></span>
                                                            <span class="input-text">@lang('miscellaneous.confirm') <span class="text-danger">&#42;</span></span>
                                                        </span>
                                                        <input type="password" name="password_confirmation" id="register_confirm_password" class="form-control input-lg" placeholder="@lang('auth.confirm-password')">
                                                        <button id="showConfirmPassword" class="btn" style="position: absolute; top: 5px; right: 5px; z-index: 999; background-color: transparent; padding: 5px;" onclick="event.preventDefault(); passwordVisible(this, 'register_confirm_password');">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    </div><!-- End .input-group -->
@error('password_confirmation')
                                                    <p class="text-danger text-right" style="margin-bottom: 5px;">{{ $message }}</p>
@enderror
                                                </fieldset>
                                            </div><!-- End .col-md-6 -->

                                        </div><!-- End .row -->

                                        <div class="row">
                                            <div class="col-lg-5 col-sm-5 col-xs-12" style="margin: 0 auto!important;">
                                                <button type="submit" class="btn btn-custom-2" style="width: 100%;">@lang('miscellaneous.register')</button>
                                            </div>
                                            <div class="col-lg-5 col-sm-5 col-xs-12" style="margin: 0 auto!important;">
                                                <a href="{{ route('account.home') }}" class="btn btn-custom" style="width: 100%;">@lang('miscellaneous.cancel')</a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
							</div><!-- End.row -->

						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
