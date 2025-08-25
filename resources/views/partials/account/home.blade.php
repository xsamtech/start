
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
								<li><a class="active">@lang('miscellaneous.menu.account.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'cart']) }}">@lang('miscellaneous.menu.account.cart')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'products']) }}">@lang('miscellaneous.menu.account.product.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'services']) }}">@lang('miscellaneous.menu.account.service.title')</a></li>
								<li><a href="{{ route('account.entity', ['entity' => 'customers']) }}">@lang('miscellaneous.menu.account.customer')</a></li>
							</ul><!-- End .portfolio-filter -->

							<div class="row portfolio-item-container" data-maxcolumn="2" data-layoutmode="fitRows">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-11" style="margin-bottom: 25px;">
                                    <img src="{{ !empty($current_user->avatar_url) ? $current_user->avatar_url : asset('assets/img/user.png') }}" alt="{{ $current_user->firstname . ' ' . $current_user->lastname }}" class="user-image img-fluid img-thumbnail rounded-4">

                                    <div style="margin-top: 25px;">
                                        <h3>{{ $current_user->firstname . ' ' . $current_user->surname . ' ' . $current_user->lastname }}</h3>
                                        <a href="{{ route('account.entity', ['entity' => 'update']) }}" class="btn strt-btn-chocolate-3" style="width: 100%; color: #fff!important;">@lang('miscellaneous.update')</a>
                                    </div>
                                </div>

                                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12" style="margin: 0 auto;">
                                    <table id="personalInfo" class="table" style="border: 0;">
                                        <!-- First name -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.firstname')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($current_user->firstname) ? $current_user->firstname : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Last name -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.lastname')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td class="text-uppercase">{{ !empty($current_user->lastname) ? $current_user->lastname : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Surname -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.surname')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td class="text-uppercase">{{ !empty($current_user->surname) ? $current_user->surname : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Username -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.username')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($current_user->username) ? '@' . $current_user->username : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Gender -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.gender_title')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($current_user->gender) ? ($current_user->gender == 'F' ? __('miscellaneous.gender2') : __('miscellaneous.gender1')) : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Birth date -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.birth_date.label')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($current_user->birthdate) ? ucfirst(__('miscellaneous.on_date') . ' ' . explicitDate($current_user->birthdate))  : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Nationality -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.nationality')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($current_user->nationality) ? $current_user->nationality : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- E-mail -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.email')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($current_user->email) ? $current_user->email : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Phone -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.phone')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($current_user->phone) ? $current_user->phone : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Addresses -->
@if (!empty($current_user->address_1) && !empty($current_user->address_2))
                                        <tr>
                                            <td><strong>@lang('miscellaneous.addresses')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>
                                                <ul class="ps-0">
                                                    <li class="dktv-line-height-1_4 mb-2" style="list-style: none;">
                                                        <i class="bi bi-geo-alt-fill me-1"></i>{{ $current_user->address_1 }}
                                                    </li>
                                                    <li class="dktv-line-height-1_4" style="list-style: none;">
                                                        <i class="bi bi-geo-alt-fill me-1"></i>{{ $current_user->address_2 }}
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
@else
                                        <tr>
                                            <td><strong>@lang('miscellaneous.address.title')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($current_user->address_1) ? $current_user->address_1 : (!empty($current_user->address_2) ? $current_user->address_2 : '- - - - - -') }}</td>
                                        </tr>
@endif

                                        <!-- P.O. box -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.p_o_box')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($current_user->p_o_box) ? $current_user->p_o_box : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- City -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.address.city')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($current_user->city) ? $current_user->city : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Country -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.country')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($current_user->country) ? $current_user->country : '- - - - - -' }}</td>
                                        </tr>
                                    </table>
                                </div>
							</div><!-- End.row -->

						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
