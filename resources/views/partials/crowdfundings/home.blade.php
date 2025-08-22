
			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li class="active">@lang('miscellaneous.menu.public.crowdfunding')</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 10px;">
							<header class="content-title">
								<h1 class="title">@lang('miscellaneous.public.project_writing.title')</h1>
								<p class="title-desc">@lang('miscellaneous.public.project_writing.description')</p>
							</header>
                        </div>

						<div class="col-md-12">
@if (!empty($current_user))
							<form action="{{ route('crowdfunding.home') }}" method="POST">
								<div class="row">
									<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
										<div class="panel panel-default text-center" style="background-color: #f2f2f2;">
											<div class="panel-body">
												<img src="{{ $current_user->avatar_url }}" alt="{{ $current_user->firstname . ' ' . $current_user->lastname }}" width="100" height="100" class="img-thumbnail" style="border-radius: 50%; margin: 0 auto;">

												<table id="personalInfo" class="table text-left" style="margin-bottom: 15px; border: 0;">
													<!-- First name -->
													<tr class="small">
														<td><strong>@lang('miscellaneous.firstname')</strong></td>
														<td>@lang('miscellaneous.colon_after_word')</td>
														<td>{{ !empty($current_user->firstname) ? $current_user->firstname : '- - - - - -' }}</td>
													</tr>

													<!-- Last name -->
													<tr class="small">
														<td><strong>@lang('miscellaneous.lastname')</strong></td>
														<td>@lang('miscellaneous.colon_after_word')</td>
														<td class="text-uppercase">{{ !empty($current_user->lastname) ? $current_user->lastname : '- - - - - -' }}</td>
													</tr>

													<!-- Surname -->
													<tr class="small">
														<td><strong>@lang('miscellaneous.surname')</strong></td>
														<td>@lang('miscellaneous.colon_after_word')</td>
														<td class="text-uppercase">{{ !empty($current_user->surname) ? $current_user->surname : '- - - - - -' }}</td>
													</tr>

													<!-- Gender -->
													<tr class="small">
														<td><strong>@lang('miscellaneous.gender_title')</strong></td>
														<td>@lang('miscellaneous.colon_after_word')</td>
														<td>{{ !empty($current_user->gender) ? ($current_user->gender == 'F' ? __('miscellaneous.gender2') : __('miscellaneous.gender1')) : '- - - - - -' }}</td>
													</tr>

													<!-- Nationality -->
													<tr class="small">
														<td><strong>@lang('miscellaneous.nationality')</strong></td>
														<td>@lang('miscellaneous.colon_after_word')</td>
														<td>{{ !empty($current_user->nationality) ? $current_user->nationality : '- - - - - -' }}</td>
													</tr>
												</table>

												<a href="{{ route('account.entity', ['entity' => 'update']) }}" class="custom-link text-uppercase">
													<i class="bi bi-pencil-fill" style="font-size: 2.3rem; vertical-align: -2px; margin-right: 8px;"></i> @lang('miscellaneous.change')
												</a>
											</div>
										</div>
									</div>
									<div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
										<fieldset>
											<!-- Project description -->
                                            <div class="input-group textarea-container" style="z-index: 3; margin-bottom: 5px;">
                                                <span class="input-group-addon clearfix">
                                                    <span style="float: left; display: inline-block; padding-top: 4px;">
                                                        <span class="input-text">@lang('miscellaneous.admin.project_writing.data.description')</span>
                                                    </span>
                                                    <span style="float: right; display: inline-block; padding-top: 5px;">
                                                        @lang('miscellaneous.words_remaining') 
                                                        <span id="wordCount" style="font-weight: 600;">500</span>
                                                    </span>
                                                </span>
                                                <textarea name="projects_description" required id="limitWords" class="form-control" cols="30" rows="4" placeholder="@lang('miscellaneous.admin.project_writing.data.description')"></textarea>
                                            </div><!-- End .input-group autofocus -->

											<!-- Company name -->
											<div class="input-group" style="margin-bottom: 5px;">
                                                <span class="input-group-addon">
                                                    <span class="input-text">@lang('miscellaneous.admin.project_writing.data.company_name')</span>
                                                </span>
                                                <input type="text" name="company_name" required id="company_name" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.company_name')">
                                            </div><!-- End .input-group -->

											<!-- RCCM -->
											<div class="input-group" style="margin-bottom: 5px;">
                                                <span class="input-group-addon">
                                                    <span class="input-text">@lang('miscellaneous.admin.project_writing.data.rccm')</span>
                                                </span>
                                                <input type="text" name="rccm" required id="rccm" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.rccm')">
                                            </div><!-- End .input-group -->

											<!-- NAT ID -->
											<div class="input-group" style="margin-bottom: 5px;">
                                                <span class="input-group-addon">
                                                    <span class="input-text">@lang('miscellaneous.admin.project_writing.data.id_nat')</span>
                                                </span>
                                                <input type="text" name="id_nat" id="id_nat" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.id_nat')">
                                            </div><!-- End .input-group -->

											<!-- Taxe number -->
											<div class="input-group" style="margin-bottom: 5px;">
                                                <span class="input-group-addon">
                                                    <span class="input-text">@lang('miscellaneous.admin.project_writing.data.tax_number')</span>
                                                </span>
                                                <input type="text" name="tax_number" id="tax_number" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.tax_number')">
                                            </div><!-- End .input-group -->

											<!-- Company address -->
                                            <div class="input-group textarea-container" style="z-index: 3; margin-bottom: 5px;">
                                                <span class="input-group-addon">
                                                    <span class="input-text">@lang('miscellaneous.admin.project_writing.data.company_address')</span>
                                                </span>
                                                <textarea name="company_address" required id="limitWords" class="form-control" cols="30" rows="2" placeholder="@lang('miscellaneous.admin.project_writing.data.company_address')"></textarea>
                                            </div><!-- End .input-group -->

											<!-- Company email -->
											<div class="input-group" style="margin-bottom: 5px;">
                                                <span class="input-group-addon">
                                                    <span class="input-text">@lang('miscellaneous.admin.project_writing.data.company_email')</span>
                                                </span>
                                                <input type="email" name="company_email" required id="company_email" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.company_email')">
                                            </div><!-- End .input-group -->

											<!-- Company phone -->
											<div class="input-group" style="margin-bottom: 5px;">
                                                <span class="input-group-addon">
                                                    <span class="input-text">@lang('miscellaneous.admin.project_writing.data.company_phone')</span>
                                                </span>
                                                <input type="tel" name="company_phone" required id="company_phone" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.company_phone')">
                                            </div><!-- End .input-group -->

											<!-- Company website URL -->
											<div class="input-group" style="margin-bottom: 5px;">
                                                <span class="input-group-addon">
                                                    <span class="input-text">@lang('miscellaneous.admin.project_writing.data.website_url')</span>
                                                </span>
                                                <input type="text" name="website_url" id="website_url" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.website_url')">
                                            </div><!-- End .input-group -->

                                            <!-- Field experience -->
                                            <div class="panel panel-default" style="margin: 0 0 5px 0;">
												<div class="panel-heading">
													<p style="margin-bottom: 0">@lang('miscellaneous.admin.project_writing.data.field_experience.title')</p>
												</div>
												<div class="panel-body">
													<label class="radio-inline">
														<input type="radio" name="field_experience" id="field_experience1" value="junior"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.field_experience.junior')</span>
													</label><br>
													<label class="radio-inline" style="margin-top: 5px; margin-left: 0;">
														<input type="radio" name="field_experience" id="field_experience2" value="intermediate"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.field_experience.intermediate')</span>
													</label><br>
													<label class="radio-inline" style="margin-top: 5px; margin-left: 0;">
														<input type="radio" name="field_experience" id="field_experience3" value="experienced"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.field_experience.experienced')</span>
													</label><br>
													<label class="radio-inline" style="margin-top: 5px; margin-left: 0;">
														<input type="radio" name="field_experience" id="field_experience4" value="expert"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.field_experience.expert')</span>
													</label>
												</div>
                                            </div>

											<!-- Activity description -->
                                            <div class="panel panel-default" style="margin: 0 0 5px 0;">
												<div class="panel-heading">
													<p style="margin-bottom: 0">@lang('miscellaneous.admin.project_writing.data.activity_description.title')</p>
												</div>
												<div class="panel-body">
													<label style="cursor: pointer;" onclick="toggleActivity();">
														<input type="checkbox" id="agriculture">
														<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
															@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.title')
														</span>
													</label><br>
													<label style="margin-top: 5px; margin-left: 0; cursor: pointer;" onclick="toggleActivity();">
														<input type="checkbox" id="breeding">
														<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
															@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.title')
														</span>
													</label><br>
												</div>
											</div>

											<!-- Agriculture -->
                                            <div id="blocAgriculture" class="panel panel-default d-none" style="margin: 0 0 5px 0;">
												<div class="panel-heading">
													<p style="margin-bottom: 0">@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.title')</p>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<label for="mySelect">@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.title')</label>
														<select class="form-control" id="agricultureType" name="agriculture_type" onchange="agricultureTypeChange('agricultureType')">
															<option value="production">@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.production')</option>
															<option value="transformation">@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.transformation.title')</option>
															<option value="selling">@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.selling')</option>
															<option value="inputs_supply">@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.inputs_supply')</option>
															<option value="equipment_supply">@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.equipment_supply')</option>
														</select>
													</div>

												</div>
											</div>

											<!-- Breeding -->
                                            <div id="blocBreeding" class="panel panel-default d-none" style="margin: 0 0 5px 0;">
												<div class="panel-heading">
													<p style="margin-bottom: 0">@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.title')</p>
												</div>
												<div class="panel-body">

												</div>
											</div>

										</fieldset>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
									</div>
								</div>
							</form>
@else
							<div class="row">
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
									<div class="view" style="padding: 20px;">
										<img src="{{ asset('assets/img/writing-project-00.png') }}" alt="" class="img-responsive">
										<div class="mask"></div>
									</div>
								</div>
								<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
									<p class="lead" style="line-height: 30px;">@lang('miscellaneous.public.project_writing.infos.paragraph_1')</p>
									<p class="lead" style="line-height: 30px;">@lang('miscellaneous.public.project_writing.infos.paragraph_2')</p>
									<p style="margin: 30px 0 0 0;">
										<a href="{{ route('login', ['redirect' => 'crowdfunding.home']) }}" class="btn strt-btn-chocolate-3 pb-2" style="float: right; display: flex; align-items: center;">
											<span style="margin-right: 8px; color: white">@lang('miscellaneous.public.project_writing.infos.link')</span><i class="bi bi-chevron-double-right" style="font-size: 2rem; color: white"></i>
										</a>
									</p>
								</div>
							</div>
@endif
						</div><!-- End .container -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
