
			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li><a href="{{ route('investor.home') }}">@lang('miscellaneous.menu.public.investors.title')</a></li>
							<li class="active">{{ $entity_title }}</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
                        <div class="col-md-12">
							<header class="content-title">
								<h1 class="title" style="margin-bottom: 5px;">{{ $selected_investor->firstname . ' ' . $selected_investor->lastname }}</h1>
								<p class="title-desc"><i class="bi bi-mortarboard" style="font-size: 2.5rem; vertical-align: -3px"></i> {{ !empty($selected_investor->selected_role) ? $selected_investor->selected_role->role_name : 'NO-ROLE' }}</p>
							</header>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <img src="{{ $selected_investor->avatar_url }}" alt="{{ $selected_investor->firstname . ' ' . $selected_investor->lastname }}" style="border-radius: 2rem;">
                        </div>
						<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                            <table id="personalInfo" class="table" style="border: 0;">
                                <!-- First name -->
                                <tr>
                                    <td><strong>@lang('miscellaneous.firstname')</strong></td>
                                    <td>@lang('miscellaneous.colon_after_word')</td>
                                    <td>{{ !empty($selected_investor->firstname) ? $selected_investor->firstname : '- - - - - -' }}</td>
                                </tr>

                                <!-- Last name -->
                                <tr>
                                    <td><strong>@lang('miscellaneous.lastname')</strong></td>
                                    <td>@lang('miscellaneous.colon_after_word')</td>
                                    <td class="text-uppercase">{{ !empty($selected_investor->lastname) ? $selected_investor->lastname : '- - - - - -' }}</td>
                                </tr>

                                <!-- Surname -->
                                <tr>
                                    <td><strong>@lang('miscellaneous.surname')</strong></td>
                                    <td>@lang('miscellaneous.colon_after_word')</td>
                                    <td class="text-uppercase">{{ !empty($selected_investor->surname) ? $selected_investor->surname : '- - - - - -' }}</td>
                                </tr>

                                <!-- Username -->
                                <tr>
                                    <td><strong>@lang('miscellaneous.username')</strong></td>
                                    <td>@lang('miscellaneous.colon_after_word')</td>
                                    <td>{{ !empty($selected_investor->username) ? $selected_investor->username : '- - - - - -' }}</td>
                                </tr>

                                <!-- Gender -->
                                <tr>
                                    <td><strong>@lang('miscellaneous.gender_title')</strong></td>
                                    <td>@lang('miscellaneous.colon_after_word')</td>
                                    <td>{{ !empty($selected_investor->gender) ? ($selected_investor->gender == 'F' ? __('miscellaneous.gender2') : __('miscellaneous.gender1')) : '- - - - - -' }}</td>
                                </tr>

                                <!-- Birth date -->
                                <tr>
                                    <td><strong>@lang('miscellaneous.birth_date.label')</strong></td>
                                    <td>@lang('miscellaneous.colon_after_word')</td>
                                    <td>{{ !empty($selected_investor->birthdate) ? ucfirst(__('miscellaneous.on_date') . ' ' . explicitDate($selected_investor->birthdate))  : '- - - - - -' }}</td>
                                </tr>

                                <!-- E-mail -->
                                <tr>
                                    <td><strong>@lang('miscellaneous.email')</strong></td>
                                    <td>@lang('miscellaneous.colon_after_word')</td>
                                    <td>{{ !empty($selected_investor->email) ? $selected_investor->email : '- - - - - -' }}</td>
                                </tr>

                                <!-- Phone -->
                                <tr>
                                    <td><strong>@lang('miscellaneous.phone')</strong></td>
                                    <td>@lang('miscellaneous.colon_after_word')</td>
                                    <td>{{ !empty($selected_investor->phone) ? $selected_investor->phone : '- - - - - -' }}</td>
                                </tr>

                                <!-- P.O. box -->
                                <tr>
                                    <td><strong>@lang('miscellaneous.p_o_box')</strong></td>
                                    <td>@lang('miscellaneous.colon_after_word')</td>
                                    <td>{{ !empty($selected_investor->p_o_box) ? $selected_investor->p_o_box : '- - - - - -' }}</td>
                                </tr>

                                <!-- City -->
                                <tr>
                                    <td><strong>@lang('miscellaneous.address.city')</strong></td>
                                    <td>@lang('miscellaneous.colon_after_word')</td>
                                    <td>{{ !empty($selected_investor->city) ? $selected_investor->city : '- - - - - -' }}</td>
                                </tr>

                                <!-- Country -->
                                <tr>
                                    <td><strong>@lang('miscellaneous.country')</strong></td>
                                    <td>@lang('miscellaneous.colon_after_word')</td>
                                    <td>{{ !empty($selected_investor->country) ? $selected_investor->country : '- - - - - -' }}</td>
                                </tr>
                            </table>

                            <button class="btn strt-btn-green" style="margin-top: 30px;">@lang('miscellaneous.public.investor.request')</button>
						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
