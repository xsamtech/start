
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
							<form action="{{ route('crowdfunding.home') }}" method="POST" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
										<!-- Profile -->
										<div class="panel panel-default text-center">
											<div class="panel-heading" style="border-bottom: 0;">
												<img src="{{ $current_user->avatar_url }}" alt="{{ $current_user->firstname . ' ' . $current_user->lastname }}" width="100" height="100" class="img-thumbnail" style="border-radius: 50%; margin: 0 auto;">

												<table id="personalInfo" class="table text-left" style="margin-bottom: 15px; border: 0;">
													<!-- First name -->
													<tr class="small">
														<td style="width: 100px;"><strong>@lang('miscellaneous.firstname')</strong></td>
														<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
														<td class="text-left">{{ !empty($current_user->firstname) ? $current_user->firstname : '- - - - - -' }}</td>
													</tr>

													<!-- Last name -->
													<tr class="small">
														<td style="width: 100px;"><strong>@lang('miscellaneous.lastname')</strong></td>
														<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
														<td class="text-uppercase text-left">{{ !empty($current_user->lastname) ? $current_user->lastname : '- - - - - -' }}</td>
													</tr>

													<!-- Surname -->
													<tr class="small">
														<td style="width: 100px;"><strong>@lang('miscellaneous.surname')</strong></td>
														<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
														<td class="text-uppercase text-left">{{ !empty($current_user->surname) ? $current_user->surname : '- - - - - -' }}</td>
													</tr>

													<!-- Gender -->
													<tr class="small">
														<td style="width: 100px;"><strong>@lang('miscellaneous.gender_title')</strong></td>
														<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
														<td class="text-left">{{ !empty($current_user->gender) ? ($current_user->gender == 'F' ? __('miscellaneous.gender2') : __('miscellaneous.gender1')) : '- - - - - -' }}</td>
													</tr>

													<!-- Nationality -->
													<tr class="small">
														<td style="width: 100px;"><strong>@lang('miscellaneous.nationality')</strong></td>
														<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
														<td class="text-left">{{ !empty($current_user->nationality) ? $current_user->nationality : '- - - - - -' }}</td>
													</tr>
												</table>

												<a href="{{ route('account.entity', ['entity' => 'update']) }}" class="custom-link text-uppercase">
													<i class="bi bi-pencil-fill" style="font-size: 2.3rem; vertical-align: -2px; margin-right: 8px;"></i> @lang('miscellaneous.change')
												</a>
											</div>
										</div>

										<!-- Project photos -->
										<div class="panel panel-default text-center">
											<div class="panel-body">
												<div class="form-group">
													<label for="files_urls">@lang('miscellaneous.admin.project_writing.associate_image')</label>
													<input type="file" id="files_urls" name="files_urls[]" class="form-control" multiple>
												</div>
												<div id="image-preview-container" class="mt-2"></div> <!-- Conteneur pour les vignettes -->
											</div>
										</div>
									</div>
									<div class="col-lg-5 col-md-7 col-sm-7 col-xs-12">
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
                                                <input type="text" name="rccm" id="rccm" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.rccm')">
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
                                                <input type="email" name="company_email" id="company_email" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.company_email')">
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
													<label style="margin-top: 3px; margin-left: 0; cursor: pointer;" onclick="toggleActivity();">
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
													<!-- Culture type -->
													<div class="form-group">
														<label style="margin-bottom: 10px;">
															@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.title')
														</label><br>
														<label style="cursor: pointer;">
															<input type="checkbox" name="agriculture_types[]" id="productionAgriculture" value="@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.production.title')" onclick="toggleType();">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.production.title')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="agriculture_types[]" id="transformationAgriculture" value="@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.transformation.title')" onclick="toggleType();">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.transformation.title')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="agriculture_types[]" id="sellingAgriculture" value="@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.selling')" onclick="toggleType();">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.selling')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="agriculture_types[]" id="inputsSupplyAgriculture" value="@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.inputs_supply')" onclick="toggleType();">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.inputs_supply')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-bottom: 0; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="agriculture_types[]" id="equipmentSupplyAgriculture" value="@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.equipment_supply')" onclick="toggleType();">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.equipment_supply')
															</span>
														</label>
													</div>

                                                    <!-- Production data -->
                                                    <div id="productionData" class="panel panel-default d-none">
														<div class="panel-heading">@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.production.title')</div>
														<div class="panel-body">
															<!-- Is land owner -->
															<div id="isLandOwnerAgriculture" class="form-group">
																<p style="margin-bottom: 0;">@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.is_land_owner')</p>

																<label class="radio-inline" style="margin-top: 5px;">
																	<input type="radio" name="is_land_owner_agriculture" id="is_land_owner_agriculture_yes" value="1"><span class="text-muted">@lang('miscellaneous.yes')</span>
																</label><br>
																<label class="radio-inline" style="margin-top: 5px;">
																	<input type="radio" name="is_land_owner_agriculture" id="is_land_owner_agriculture_no" checked value="0"><span class="text-muted">@lang('miscellaneous.no')</span>
																</label>
															</div>

															<!-- Land area and yield -->
															<div id="landAreaYieldAgriculture" class="form-group d-none">
																<label for="land_area_agriculture" style="font-weight: normal;">
																	@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.land_area')
																</label>
																<input type="number" name="land_area_agriculture" id="land_area_agriculture" class="form-control input-lg" placeholder="@lang('miscellaneous.size')">

																<label for="land_yield_per_hectare" style="font-weight: normal; margin-top: 8px;">
																	@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.land_yield_per_hectare')
																</label>
																<input type="number" name="land_yield_per_hectare" id="land_yield_per_hectare" class="form-control input-lg" placeholder="@lang('miscellaneous.yield')">

																<label for="land_yield_per_hectare" style="font-weight: normal; margin-top: 8px;">
																	@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.is_land_owner')
																</label>
																<input type="number" name="land_yield_per_hectare" id="land_yield_per_hectare" class="form-control input-lg" placeholder="@lang('miscellaneous.yield')">
															</div>

															<!-- Cultivated products -->
															<label for="agriculture_type_production_content" style="font-weight: normal;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.production.cultivated_products.title')
															</label>
															<input type="text" name="agriculture_type_production_content" id="agriculture_type_production_content" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.production.cultivated_products.description')">
														</div>
                                                    </div>

                                                    <!-- Transformation data -->
													<div id="transformationData" class="panel panel-default d-none" style="margin-top: 8px;">
														<div class="panel-heading">@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.transformation.title')</div>
														<div class="panel-body">
															<label style="font-weight: normal;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.transformation.processing_unit_capacity')
															</label>
															<div class="row">
																<div class="col-lg-6 col-sm-6 col-xs-6" style="padding-right: 0;">
																	<input type="text" name="agriculture_type_content_quantity" id="agricultureTypeContentQuantity" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.transformation.quantity_processed')">
																</div>
																<div class="col-lg-6 col-sm-6 col-xs-6">
																	<select class="form-control input-lg" id="agricultureTypeContentPeriod" name="agriculture_type_content_period">
																		<option class="small" selected disabled>@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.transformation.choose_period')</option>
																		<option value="daily">@lang('miscellaneous.period.expression.daily')</option>
																		<option value="monthly">@lang('miscellaneous.period.expression.monthly')</option>
																		<option value="yearly">@lang('miscellaneous.period.expression.yearly')</option>
																	</select>
																</div>
															</div>

															<!-- Processed products -->
															<label for="agriculture_type_transformation_content" style="font-weight: normal; margin-top: 8px;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.transformation.processed_products.title')
															</label>
															<input type="text" name="agriculture_type_transformation_content" id="agriculture_type_transformation_content" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.transformation.processed_products.description')">
														</div>
													</div>

                                                    <!-- Inputs supplying data -->
													<div id="inputsSupplyingData" class="panel panel-default d-none" style="margin-top: 8px;">
														<div class="panel-heading">@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.inputs_supply')</div>
														<div class="panel-body">
															<label for="agriculture_type_equipment_content" style="font-weight: normal;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.supply_content')
															</label>
															<input type="text" name="agriculture_type_equipment_content" id="agriculture_type_equipment_content" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.supply_content')">
														</div>
													</div>

                                                    <!-- Equipment supplying data -->
													<div id="equipmentSupplyingData" class="panel panel-default d-none" style="margin-top: 8px;">
														<div class="panel-heading">@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.equipment_supply')</div>
														<div class="panel-body">
															<label for="agriculture_type_content" style="font-weight: normal;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.supply_content')
															</label>
															<input type="text" name="agriculture_type_content" id="agriculture_type_content" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.supply_content')">
														</div>
													</div>
												</div>
											</div>

											<!-- Breeding -->
                                            <div id="blocBreeding" class="panel panel-default d-none" style="margin: 0 0 5px 0;">
												<div class="panel-heading">
													<p style="margin-bottom: 0">@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.title')</p>
												</div>
												<div class="panel-body">
													<!-- Breeding type -->
													<div class="form-group">
														<label style="margin-bottom: 10px;">
															@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.title')
														</label><br>
														<label style="cursor: pointer;">
															<input type="checkbox" name="breeding_types[]" id="fishBreeding" value="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.title')" onclick="toggleType();">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.title')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="breeding_types[]" id="poultryBreeding" value="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.poultry.title')" onclick="toggleType();">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.poultry.title')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="breeding_types[]" id="pigBreeding" value="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.pig.title')" onclick="toggleType();">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.pig.title')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="breeding_types[]" id="rabbitBreeding" value="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.rabbit.title')" onclick="toggleType();">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.rabbit.title')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="breeding_types[]" id="cattleBreeding" value="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.cattle.title')" onclick="toggleType();">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.cattle.title')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="breeding_types[]" id="sheepBreeding" value="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.sheep.title')" onclick="toggleType();">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.sheep.title')
															</span>
														</label>
													</div>

                                                    <!-- Is Owner -->
													<div class="panel panel-default">
														<div class="panel-body">
															<!-- Is land owner -->
															<div id="isLandOwnerBreeding" class="form-group">
																<p style="margin-bottom: 0;">@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.is_land_owner')</p>

																<label class="radio-inline" style="margin-top: 5px;">
																	<input type="radio" name="is_land_owner_breeding" id="is_land_owner_breeding_yes" value="1"><span class="text-muted">@lang('miscellaneous.yes')</span>
																</label><br>
																<label class="radio-inline" style="margin-top: 5px;">
																	<input type="radio" name="is_land_owner_breeding" id="is_land_owner_breeding_no" checked value="0"><span class="text-muted">@lang('miscellaneous.no')</span>
																</label>
															</div>

															<!-- Land area -->
															<div id="landAreaBreeding" class="form-group d-none">
																<label for="land_area_breeding" style="font-weight: normal;">
																	@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.land_area')
																</label>
																<input type="number" name="land_area_breeding" id="land_area_breeding" class="form-control input-lg" placeholder="@lang('miscellaneous.size')">
															</div>
														</div>
													</div>

                                                    <!-- Fish data -->
                                                    <div id="fishData" class="panel panel-default d-none">
														<div class="panel-heading">@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.title')</div>
														<div class="panel-body">
															<!-- Species -->
															<label for="breeding_type_fish_content" style="font-weight: normal;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.fish_species')
															</label>
															<input type="text" name="breeding_type_fish_content" id="breeding_type_fish_content" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.fish_species')">

															<!-- Pond capacity -->
															<label for="breeding_type_fish_pond_capacity" style="font-weight: normal;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.pond_capacity')
															</label>
															<input type="text" name="breeding_type_fish_pond_capacity" id="breeding_type_fish_pond_capacity" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.pond_capacity')">

															<!-- Cage capacity -->
															<label for="breeding_type_fish_cage_capacity" style="font-weight: normal;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.cage_capacity')
															</label>
															<input type="text" name="breeding_type_fish_cage_capacity" id="breeding_type_fish_cage_capacity" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.cage_capacity')">

															<!-- Cage capacity -->
															<label for="breeding_type_fish_bin_capacity" style="font-weight: normal;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.bin_capacity')
															</label>
															<input type="text" name="breeding_type_fish_bin_capacity" id="breeding_type_fish_bin_capacity" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.bin_capacity')">
														</div>
                                                    </div>

                                                    <!-- Poultry data -->
                                                    <div id="poultryData" class="panel panel-default d-none">
														<div class="panel-heading">@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.poultry.title')</div>
														<div class="panel-body">
															<!-- Total number -->
															<label for="breeding_type_poultry_total_number" style="font-weight: normal;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.poultry.animals_total_number')
															</label>
															<input type="text" name="breeding_type_poultry_total_number" id="breeding_type_poultry_total_number" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.poultry.animals_total_number')">
														</div>
                                                    </div>

                                                    <!-- Pig data -->
                                                    <div id="pigData" class="panel panel-default d-none">
														<div class="panel-heading">@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.pig.title')</div>
														<div class="panel-body">
															<!-- Total number -->
															<label for="breeding_type_pig_total_number" style="font-weight: normal;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.pig.animals_total_number')
															</label>
															<input type="text" name="breeding_type_pig_total_number" id="breeding_type_pig_total_number" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.pig.animals_total_number')">
														</div>
                                                    </div>

                                                    <!-- Rabbit data -->
                                                    <div id="rabbitData" class="panel panel-default d-none">
														<div class="panel-heading">@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.rabbit.title')</div>
														<div class="panel-body">
															<!-- Total number -->
															<label for="breeding_type_rabbit_total_number" style="font-weight: normal;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.rabbit.animals_total_number')
															</label>
															<input type="text" name="breeding_type_rabbit_total_number" id="breeding_type_rabbit_total_number" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.rabbit.animals_total_number')">
														</div>
                                                    </div>

                                                    <!-- Cattle data -->
                                                    <div id="cattleData" class="panel panel-default d-none">
														<div class="panel-heading">@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.cattle.title')</div>
														<div class="panel-body">
															<!-- Total number -->
															<label for="breeding_type_rabbit_total_number" style="font-weight: normal;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.cattle.animals_total_number')
															</label>
															<input type="text" name="breeding_type_rabbit_total_number" id="breeding_type_rabbit_total_number" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.cattle.animals_total_number')">

															<!-- Kind -->
															<label class="radio-inline" style="margin-top: 8px;">
																<input type="radio" name="breeding_type_cattle_kind" id="breeding_type_cattle_kind_meat" checked value="meat"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.cattle.kind.meat')</span>
															</label><br>
															<label class="radio-inline" style="margin-top: 5px;">
																<input type="radio" name="breeding_type_cattle_kind" id="breeding_type_cattle_kind_milk" value="milk"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.cattle.kind.milk')</span>
															</label><br>
															<label class="radio-inline" style="margin-top: 5px;">
																<input type="radio" name="breeding_type_cattle_kind" id="breeding_type_cattle_kind_both" value="both"><span class="text-muted">@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.cattle.kind.both')</span>
															</label>
														</div>
                                                    </div>

                                                    <!-- Sheep data -->
                                                    <div id="sheepData" class="panel panel-default d-none">
														<div class="panel-heading">@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.sheep.title')</div>
														<div class="panel-body">
															<!-- Total number -->
															<label for="breeding_type_sheep_total_number" style="font-weight: normal;">
																@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.sheep.animals_total_number')
															</label>
															<input type="text" name="breeding_type_sheep_total_number" id="breeding_type_sheep_total_number" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.sheep.animals_total_number')">
														</div>
                                                    </div>
												</div>
											</div>

											<!-- Market segments -->
											<div class="panel panel-default" style="margin: 0 0 5px 0;">
												<div class="panel-heading">
													<p style="margin-bottom: 0">@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.title')</p>
												</div>
												<div class="panel-body">
													<div class="form-group" style="margin-bottom: 0;">
														<label style="font-weight: normal; margin-bottom: 10px;">
															@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.description')
														</label><br>

														<label style="cursor: pointer;">
															<input type="checkbox" name="segments_names[]" value="miscellaneous.admin.project_writing.data.market_segments_or_target.quantitative.retail_sale">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.quantitative.retail_sale')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="segments_names[]" value="miscellaneous.admin.project_writing.data.market_segments_or_target.quantitative.wholesale">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.quantitative.wholesale')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="segments_names[]" value="miscellaneous.admin.project_writing.data.market_segments_or_target.qualitative.farmers">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.qualitative.farmers')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="segments_names[]" value="miscellaneous.admin.project_writing.data.market_segments_or_target.qualitative.ngos_and_research_organizations">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.qualitative.ngos_and_research_organizations')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="segments_names[]" value="miscellaneous.admin.project_writing.data.market_segments_or_target.qualitative.agro_dealers_and_other_private_operators">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.qualitative.agro_dealers_and_other_private_operators')
															</span>
														</label><br>
														<label style="margin-top: 3px; margin-left: 0; cursor: pointer;">
															<input type="checkbox" name="segments_names[]" value="miscellaneous.admin.project_writing.data.market_segments_or_target.qualitative.consumers">
															<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.qualitative.consumers')
															</span>
														</label><br>
														<label for="land_area_breeding" class="d-none" style="font-weight: normal;">
															@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.qualitative.others')
														</label>
														<input type="text" name="segments_names[]" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.qualitative.others')" style="margin-top: 5px;">
													</div>
												</div>
											</div>

											<!-- Accounting summary -->
											<div class="panel panel-default" style="margin: 0 0 5px 0;">
												<div class="panel-heading">
													<p style="margin-bottom: 0">@lang('miscellaneous.admin.project_writing.data.accounting_summary.title')</p>
												</div>
												<div class="panel-body">
													<!-- Employees count -->
													<label for="employees_count" style="font-weight: normal;">
														@lang('miscellaneous.admin.project_writing.data.accounting_summary.employees_count')
													</label>
													<input type="number" name="employees_count" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.accounting_summary.employees_count')">

													<!-- Funding sources -->
													<div class="panel panel-default" style="margin: 10px 0 7px 0;">
														<div class="panel-body">
															<div class="form-group" style="margin-bottom: 0;">
																<label style="margin: 0 0 10px 0;">
																	@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.title')
																</label><br>

																<label style="cursor: pointer;" onclick="if (document.getElementById('is_funded_by_self').checked) { document.getElementById('fundingAmount').style.display = 'block'; } else { document.getElementById('fundingAmount').style.display = 'none'; }">
																	<input type="checkbox" name="is_funded_by_self" id="is_funded_by_self" value="1">
																	<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																		@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_self.title')
																	</span>
																</label><br>
																<span id="fundingAmount" style="display: none; margin: 0 0 10px 0;">
																	<label for="funding_amount" style="font-weight: normal;">
																		@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_self.amount')
																	</label>
																	<input type="text" name="funding_amount" id="funding_amount" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_self.amount')">
																</span>

																<label style="cursor: pointer;" onclick="if (document.getElementById('is_funded_by_credit').checked) { document.getElementById('creditAmount').style.display = 'block'; } else { document.getElementById('creditAmount').style.display = 'none'; }">
																	<input type="checkbox" name="is_funded_by_credit" id="is_funded_by_credit" value="1">
																	<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																		@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_credit.title')
																	</span>
																</label><br>
																<span id="creditAmount" style="display: none; margin: 0 0 10px 0;">
																	<label for="credit_amount" style="font-weight: normal;">
																		@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_self.amount')
																	</label>
																	<input type="text" name="credit_amount" id="credit_amount" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_self.amount')">
																</span>

																<label style="cursor: pointer;" onclick="if (document.getElementById('is_funded_by_grant').checked) { document.getElementById('grantAmount').style.display = 'block'; } else { document.getElementById('grantAmount').style.display = 'none'; }">
																	<input type="checkbox" name="is_funded_by_grant" id="is_funded_by_grant" value="1">
																	<span class="text-muted" style="font-weight: normal; display: inline-block; margin-right: 8px;">
																		@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_grant.title')
																	</span>
																</label><br>
																<span id="grantAmount" style="display: none; margin-bottom: 5px;">
																	<label for="grant_amount" style="font-weight: normal;">
																		@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_self.amount')
																	</label>
																	<input type="text" name="grant_amount" id="grant_amount" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_self.amount')">
																</span>

																<hr style="margin: 5px 0;">
																<label for="other_funding_sources" style="font-weight: normal;">
																	@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.other_funding_sources')
																</label>
																<input type="text" name="other_funding_sources" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.other_funding_sources')">
															</div>
														</div>
													</div>

													<!-- Annual turnover -->
													<label for="annual_turnover" style="font-weight: normal;">
														@lang('miscellaneous.admin.project_writing.data.accounting_summary.annual_turnover')
													</label>
													<input type="number" name="annual_turnover" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.accounting_summary.annual_turnover')">

													<!-- Last year net -->
													<div class="panel panel-default" style="margin: 7px 0;">
														<div class="panel-body">
															<div class="form-group" style="margin-bottom: 0;">
																<label style="margin: 0 0 10px 0;">
																	@lang('miscellaneous.admin.project_writing.data.accounting_summary.last_year_net.title')
																</label><br>

																<label for="last_year_net_profit" style="font-weight: normal;">
																	@lang('miscellaneous.admin.project_writing.data.accounting_summary.last_year_net.profit')
																</label>
																<input type="number" name="last_year_net_profit" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.accounting_summary.last_year_net.profit')">

																<label for="last_year_net_loss" style="font-weight: normal; margin-top: 5px;">
																	@lang('miscellaneous.admin.project_writing.data.accounting_summary.last_year_net.loss')
																</label>
																<input type="number" name="last_year_net_loss" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.accounting_summary.last_year_net.loss')">
															</div>
														</div>
													</div>

													<!-- Annual turnover -->
													<label for="forecast_turnover" style="font-weight: normal;">
														@lang('miscellaneous.admin.project_writing.data.accounting_summary.forecast_turnover')
													</label>
													<input type="number" name="forecast_turnover" class="form-control input-lg" placeholder="@lang('miscellaneous.admin.project_writing.data.accounting_summary.annual_turnover')">

												</div>
											</div>
										</fieldset>

										<button type="submit" class="btn strt-btn-green" style="width: 100%;">@lang('miscellaneous.send')</button>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
										<div class="panel panel-default">
											<div class="panel-heading" style="background-color: transparent!important;">
												<h5 class="h5-responsive" style="font-weight: 700; margin: 0;">@lang('miscellaneous.admin.project_writing.my_other_projects')</h5>
											</div>
	@if (count($user_projects) > 0)
											<ul class="list-group list-group-flush">
		@foreach ($user_projects as $project)
												<li class="list-group-item clearfix">
			@if (count($project->photos) > 0)
													<img src="{{ $project->photos[0]->file_url }}" alt="" style="height: 160px; margin-top: 10px; border-radius: 14px; object-fit: cover;" class="img-responsive">
			@endif
													<p class="small" style="line-height: 19px; margin-top: 10px; margin-bottom: 1px;">{!! Str::limit($project->projects_description, 100) !!}</p>
													<a href="{{ route('crowdfunding.datas', ['id' => $project->id]) }}" class="small text-primary" style="text-decoration: underline; float: right;">@lang('miscellaneous.details') <i class="bi bi-chevron-double-right"></i></a>
												</li>
		@endforeach
											</ul>
	@else
											<div class="panel-body text-center">
												<i class="bi bi-file-text" style="font-size: 7rem"></i>
												<h5>@lang('miscellaneous.empty_list')</h5>
											</div>
	@endif
										</div>
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
