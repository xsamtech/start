
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
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
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
									<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
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
										</fieldset>
									</div>
									<div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
										<fieldset>
                                            <!-- Activity orientation -->
                                            <div class="panel panel-default" style="margin: 0 0 5px 0;">
												<div class="panel-heading">
													<p style="margin-bottom: 0">@lang('miscellaneous.admin.project_writing.data.activity_orientation.title')</p>
												</div>
												<div class="panel-body">
													<label class="radio-inline">
														<input type="radio" name="activity_orientation" id="activity_orientation1" value="seed_producer_distributor"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.activity_orientation.seed_producer_distributor.title')</span>
													</label><br>
													<label class="radio-inline" style="margin-top: 5px; margin-left: 0;">
														<input type="radio" name="activity_orientation" id="activity_orientation2" value="farmer"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.activity_orientation.farmer.title')</span>
													</label><br>
													<label class="radio-inline" style="margin-top: 5px; margin-left: 0;">
														<input type="radio" name="activity_orientation" id="activity_orientation3" value="processing_transformation_unit"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.activity_orientation.processing_transformation_unit.title')</span>
													</label><br>
													<label class="radio-inline" style="margin-top: 5px; margin-left: 0;">
														<input type="radio" name="activity_orientation" id="activity_orientation4" value="marketing_agency"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.activity_orientation.marketing_agency')</span>
													</label><br>
													<label class="radio-inline" style="margin-top: 5px; margin-left: 0;">
														<input type="radio" name="activity_orientation" id="activity_orientation5" value="food_distribution"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.activity_orientation.food_distribution')</span>
													</label>
												</div>
												<div class="panel-body" style="padding-top: 0; padding-bottom: 0;">
													<span data-value="seed_producer_distributor" class="d-none">
														<p style="font-size: 1.3rem; margin-bottom: 5px; line-height: 20px;">@lang('miscellaneous.admin.project_writing.data.activity_orientation.seed_producer_distributor.info')</p>
														<input type="text" name="activity_orientation_content" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_orientation.seed_producer_distributor.info')" style="margin-bottom: 20px;">
													</span>
													<span data-value="farmer" class="d-none">
														<p style="font-size: 1.3rem; margin-bottom: 5px; line-height: 20px;">@lang('miscellaneous.admin.project_writing.data.activity_orientation.farmer.info')</p>
														<input type="text" name="activity_orientation_content" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_orientation.farmer.info')" style="margin-bottom: 20px;">
													</span>
													<span data-value="processing_transformation_unit" class="d-none">
														<p style="font-size: 1.3rem; margin-bottom: 5px; line-height: 20px;">@lang('miscellaneous.admin.project_writing.data.activity_orientation.processing_transformation_unit.info_1')</p>
														<input type="text" name="processing_transformation_quantity" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_orientation.processing_transformation_unit.info_1')" style="margin-bottom: 10px;">

														<p style="font-size: 1.3rem; margin-bottom: 5px; line-height: 20px;">@lang('miscellaneous.admin.project_writing.data.activity_orientation.processing_transformation_unit.info_2')</p>
														<select name="processing_transformation_period" class="form-control" style="margin-bottom: 20px;">
															<option selected>- - - - - - - - - -</option>
															<option value="daily">@lang('miscellaneous.admin.project_writing.data.activity_orientation.processing_transformation_unit.data_2.period.daily')</option>
															<option value="weekly">@lang('miscellaneous.admin.project_writing.data.activity_orientation.processing_transformation_unit.data_2.period.weekly')</option>
															<option value="monthly">@lang('miscellaneous.admin.project_writing.data.activity_orientation.processing_transformation_unit.data_2.period.monthly')</option>
															<option value="quarterly">@lang('miscellaneous.admin.project_writing.data.activity_orientation.processing_transformation_unit.data_2.period.quarterly')</option>
															<option value="biannual">@lang('miscellaneous.admin.project_writing.data.activity_orientation.processing_transformation_unit.data_2.period.biannual')</option>
															<option value="annual">@lang('miscellaneous.admin.project_writing.data.activity_orientation.processing_transformation_unit.data_2.period.annual')</option>
														</select>
													</span>
												</div>
                                            </div>

                                            <!-- Market segments or target -->
                                            <div class="panel panel-default" style="margin: 0 0 5px 0;">
												<div class="panel-heading">
													<p style="margin-bottom: 0">@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.title')</p>
												</div>
												<div class="panel-body">
													<label for="market_segments_or_target1" style="font-weight: normal;">
														<input type="checkbox" name="market_segments_or_target[]" value="@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.farmers')" id="market_segments_or_target1"> @lang('miscellaneous.admin.project_writing.data.market_segments_or_target.farmers')
													</label><br>

													<label for="market_segments_or_target2" style="font-weight: normal;">
														<input type="checkbox" name="market_segments_or_target[]" value="@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.ngo_research')" id="market_segments_or_target2"> @lang('miscellaneous.admin.project_writing.data.market_segments_or_target.ngo_research')
													</label><br>

													<label for="market_segments_or_target3" style="font-weight: normal;">
														<input type="checkbox" name="market_segments_or_target[]" value="@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.agro_dealers')" id="market_segments_or_target3"> @lang('miscellaneous.admin.project_writing.data.market_segments_or_target.agro_dealers')
													</label><br>

													<label for="market_segments_or_target4" style="font-weight: normal;">
														<input type="checkbox" name="market_segments_or_target[]" value="@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.consumers')" id="market_segments_or_target4"> @lang('miscellaneous.admin.project_writing.data.market_segments_or_target.consumers')
													</label><br>

													<label for="others" style="font-weight: normal; margin-top: 5px;">@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.others')</label>
													<input type="text" name="others" class="form-control" id="others" placeholder="@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.others')">
												</div>
                                            </div>

                                            <!-- Physical and land organization -->
                                            <div class="panel panel-default" style="margin: 0 0 5px 0;">
												<div class="panel-heading">
													<p style="margin-bottom: 0">@lang('miscellaneous.admin.project_writing.data.physical_and_land_organization.title')</p>
												</div>

												<div class="panel-body" onclick="toggleYes();">
													<p>@lang('miscellaneous.admin.project_writing.data.physical_and_land_organization.info')</p>
													<label class="radio-inline">
														<input type="radio" name="physical_and_land_organization" id="physical_and_land_organization1" value="yes"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.physical_and_land_organization.yes.title')</span>
													</label>
													<label class="radio-inline" style="margin-left: 10px;">
														<input type="radio" name="physical_and_land_organization" id="physical_and_land_organization2" value="no" checked><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.physical_and_land_organization.no')</span>
													</label>
												</div>

												<div id="yesHaveLand" class="panel-body" style="padding-top: 0;" class="d-none">
													<span>
														<p style="font-size: 1.3rem; text-align: center; line-height: 16px;">@lang('miscellaneous.admin.project_writing.data.physical_and_land_organization.yes.info')</p>

														<p style="margin-bottom: 5px;">@lang('miscellaneous.admin.project_writing.data.physical_and_land_organization.yes.size')</p>
														<input type="text" name="processing_transformation_quantity" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.physical_and_land_organization.yes.size')" style="margin-bottom: 10px;">

														<p style="margin-bottom: 5px;">@lang('miscellaneous.admin.project_writing.data.physical_and_land_organization.yes.yield')</p>
														<input type="text" name="processing_transformation_quantity" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.physical_and_land_organization.yes.yield')" style="margin-bottom: 0;">
													</span>
												</div>
                                            </div>

                                            <!-- Land status -->
                                            <div class="panel panel-default" style="margin: 0 0 5px 0;">
												<div class="panel-heading">
													<p style="margin-bottom: 0">@lang('miscellaneous.admin.project_writing.data.land_status.title')</p>
												</div>

												<div class="panel-body" onclick="toggleLandStatus();">
													<label class="radio-inline">
														<input type="radio" name="land_status" id="land_status1" value="tenant"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.land_status.tenant.title')</span>
													</label>
													<label class="radio-inline" style="margin-left: 10px;">
														<input type="radio" name="land_status" id="land_status2" value="owner"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.land_status.owner.title')</span>
													</label>
												</div>

												<div class="panel-body" style="padding-top: 0; padding-bottom: 0;">
													<span id="landStatusTenant" class="d-none">
														<p style="margin-bottom: 5px;">@lang('miscellaneous.admin.project_writing.data.land_status.tenant.info')</p>
														<input type="number" name="land_status_amount" class="form-control input-lg" placeholder="@lang('miscellaneous.amount')" style="margin-bottom: 10px;">
													</span>
													<span id="landStatusOwner" class="d-none">
														<p style="margin-bottom: 5px;">@lang('miscellaneous.admin.project_writing.data.land_status.owner.info')</p>
														<input type="file" name="land_status_property_deed_url" class="form-control input-lg" placeholder="@lang('miscellaneous.upload.upload_document')" style="margin-bottom: 10px;">
													</span>
												</div>
                                            </div>

										</fieldset>
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
