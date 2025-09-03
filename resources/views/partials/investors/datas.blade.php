			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li><a href="{{ route('investor.home') }}">@lang('miscellaneous.menu.public.investors.title')</a></li>
							<li class="active">@lang('miscellaneous.admin.project_writing.details')</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div id="aboutProject" class="row">
						<!-- Profile -->
						<div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
							<div class="panel panel-default text-center">
								<div class="panel-heading">
									<h5 style="font-weight: bold; margin: 0;">@lang('miscellaneous.admin.project_writing.data.profile')</h5>
								</div>
								<div class="panel-body">
									<img src="{{ $selected_project->user->avatar_url }}" alt="{{ $selected_project->user->firstname . ' ' . $selected_project->user->lastname }}" width="100" height="100" class="img-thumbnail" style="border-radius: 50%; margin: 0 auto;">

									<table id="personalInfo" class="table text-left" style="margin-bottom: 0; border: 0;">
										<!-- First name -->
										<tr class="small">
											<td style="width: 100px;"><strong>@lang('miscellaneous.firstname')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
											<td class="text-left">{{ !empty($selected_project->user->firstname) ? $selected_project->user->firstname : '- - - - - -' }}</td>
										</tr>

										<!-- Last name -->
										<tr class="small">
											<td style="width: 100px;"><strong>@lang('miscellaneous.lastname')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
											<td class="text-uppercase text-left">{{ !empty($selected_project->user->lastname) ? $selected_project->user->lastname : '- - - - - -' }}</td>
										</tr>

										<!-- Surname -->
										<tr class="small">
											<td style="width: 100px;"><strong>@lang('miscellaneous.surname')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
											<td class="text-uppercase text-left">{{ !empty($selected_project->user->surname) ? $selected_project->user->surname : '- - - - - -' }}</td>
										</tr>

										<!-- Gender -->
										<tr class="small">
											<td style="width: 100px;"><strong>@lang('miscellaneous.gender_title')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
											<td class="text-left">{{ !empty($selected_project->user->gender) ? ($selected_project->user->gender == 'F' ? __('miscellaneous.gender2') : __('miscellaneous.gender1')) : '- - - - - -' }}</td>
										</tr>

										<!-- Nationality -->
										<tr class="small" style="border-bottom: 0px;">
											<td style="width: 100px;"><strong>@lang('miscellaneous.nationality')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
											<td class="text-left">{{ !empty($selected_project->user->nationality) ? $selected_project->user->nationality : '- - - - - -' }}</td>
										</tr>
									</table>
								</div>
							</div>

							<div>
			@if (!empty($selected_project->sheet_url))
								<a href="{{ $selected_project->sheet_url }}">
									<div class="panel panel-default">
										<div class="panel-body">
											<p class="lead"><i class="bi bi-file-excel-fill" style="color: green; margin-right: 8px;"></i>@lang('miscellaneous.admin.project_writing.data.sheet_url')</p>
										</div>
									</div>
								</a>
			@endif

							</div>
						</div>

						<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
@if (count($selected_project->photos) > 0)
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="row">
	@foreach ($selected_project->photos as $photo)
		@if (count($selected_project->photos) == 1)
										<div class="col-lg-12">
		@else
			@if (count($selected_project->photos) > 2)
										<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
			@else
										<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
			@endif
		@endif
											<div>
												<img src="{{ $photo->file_url }}" class="d-block w-100" alt="Image {{ $loop->index + 1 }}" style="width: 100%; margin-bottom: 10px; height: 300px; object-fit: cover;">
											</div>
										</div>
	@endforeach
									</div>
								</div>
							</div>
@endif

							<!-- Description -->
							<div class="panel panel-default">
								<div class="panel-heading text-center">
									<h5 style="font-weight: bold; margin: 0;">@lang('miscellaneous.admin.project_writing.data.description')</h5>
								</div>
								<div class="panel-body">
									<p style="margin-bottom: 0;">{{ $selected_project->projects_description }}</p>
								</div>
							</div>

							<!-- About company -->
							<div class="panel panel-default">
								<div class="panel-heading text-center">
									<h5 style="font-weight: bold; margin: 0;">@lang('miscellaneous.admin.project_writing.data.about_company')</h5>
								</div>
								<div class="panel-body">
									<table id="personalInfo" class="table text-left" style="margin-bottom: 0; border: 0;">
										<!-- Company name -->
										<tr class="small">
											<td class="table-label"><strong>@lang('miscellaneous.admin.project_writing.data.company_name')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
											<td class="text-left">{{ !empty($selected_project->company_name) ? $selected_project->company_name : '- - - - - -' }}</td>
										</tr>

										<!-- RCCM -->
										<tr class="small">
											<td class="table-label"><strong>@lang('miscellaneous.admin.project_writing.data.rccm')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
											<td class="text-left">{{ !empty($selected_project->rccm) ? $selected_project->rccm : '- - - - - -' }}</td>
										</tr>

										<!-- ID NAT -->
										<tr class="small">
											<td class="table-label"><strong>@lang('miscellaneous.admin.project_writing.data.id_nat')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
											<td class="text-left">{{ !empty($selected_project->id_nat) ? $selected_project->id_nat : '- - - - - -' }}</td>
										</tr>

										<!-- Tax number -->
										<tr class="small">
											<td class="table-label"><strong>@lang('miscellaneous.admin.project_writing.data.tax_number')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
											<td class="text-left">{{ !empty($selected_project->tax_number) ? $selected_project->tax_number : '- - - - - -' }}</td>
										</tr>

										<!-- Company address -->
										<tr class="small">
											<td class="table-label"><strong>@lang('miscellaneous.admin.project_writing.data.company_address')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
											<td class="text-left">{{ !empty($selected_project->company_address) ? $selected_project->company_address : '- - - - - -' }}</td>
										</tr>

										<!-- Creation year -->
										<tr class="small">
											<td class="table-label"><strong>@lang('miscellaneous.admin.project_writing.data.creation_year')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
											<td class="text-left">{{ !empty($selected_project->creation_year) ? $selected_project->creation_year : '- - - - - -' }}</td>
										</tr>

										<!-- Company email -->
										<tr class="small">
											<td class="table-label"><strong>@lang('miscellaneous.admin.project_writing.data.company_email')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
@if (!empty($selected_project->company_email))
											<td class="text-left"><a href="mailto:{{ $selected_project->company_email }}" target="_blank">{{ $selected_project->company_email }}</a></td>
@else
											<td class="text-left">- - - - - -</td>
@endif
										</tr>

										<!-- Company phone -->
										<tr class="small">
											<td class="table-label"><strong>@lang('miscellaneous.admin.project_writing.data.company_phone')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
@if (!empty($selected_project->company_phone))
											<td class="text-left"><a href="tel:{{ $selected_project->company_phone }}" target="_blank">{{ $selected_project->company_phone }}</a></td>
@else
											<td class="text-left">- - - - - -</td>
@endif
										</tr>

										<!-- Website URL -->
										<tr class="small" style="border-bottom: 0;">
											<td class="table-label"><strong>@lang('miscellaneous.admin.project_writing.data.website_url')</strong></td>
											<td style="width: 10px;">@lang('miscellaneous.colon_after_word')</td>
@if (!empty($selected_project->website_url))
											<td class="text-left"><a href="{{ $selected_project->website_url }}" target="_blank">{{ $selected_project->website_url }}</a></td>
@else
											<td class="text-left">- - - - - -</td>
@endif
										</tr>

									</table>
								</div>
							</div>

							<!-- Field experience -->
							<div class="panel panel-default">
								<div class="panel-body">
									@lang('miscellaneous.admin.project_writing.data.field_experience.title') :<br class="d-sm-none">
									<strong>{{ __('miscellaneous.admin.project_writing.data.field_experience.' . $selected_project->field_experience) }}</strong>
								</div>
							</div>

<!-- Activity field: AGRICULTURE -->
@if (!empty($selected_project->project_activities[0]->agriculture_type))
	@php
		$activity = $selected_project->project_activities[0];
	@endphp
							<div class="panel panel-default">
								<div class="panel-heading text-center">
									<h5 style="margin: 0;">@lang('miscellaneous.admin.project_writing.data.activity_description.title') : <span style="font-weight: bold;">@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.title')</span></h5>
								</div>
								<div class="panel-body">
									<p>
										@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.is_land_owner')<br class="d-sm-none">
										<strong>{{ $activity->is_land_owner_agriculture == 1 ? __('miscellaneous.yes') : __('miscellaneous.no') }}</strong>
									</p>
	@if ($activity->is_land_owner_agriculture == 1)
									<p>
										@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.land_area') : <br class="d-sm-none">
										<strong>{{ formatIntegerNumber($activity->land_area_agriculture) }}</strong>
									</p>
									<p>
										@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.land_yield_per_hectare') : <br class="d-sm-none">
										<strong>{{ formatIntegerNumber($activity->land_yield_per_hectare) }}</strong>
									</p>
	@endif
									<p>
										@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.title') : <br class="d-sm-none">
										<strong>{{ $activity->agriculture_type }}</strong>
									</p>
	@if (!empty($activity->agriculture_type_production_content))
									<p>
										@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.production.cultivated_products.title') : <br class="d-sm-none">
										<strong>{{ $activity->agriculture_type_production_content }}</strong>
									</p>
	@endif
	@if (!empty($activity->agriculture_type_transformation_content))
									<p>
										@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.transformation.processed_products.title') : <br class="d-sm-none">
										<strong>{{ $activity->agriculture_type_transformation_content }}</strong>
									</p>
	@endif
	@if (!empty($activity->agriculture_type_transformation_quantity))
									<p>
										@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.transformation.quantity_processed') : <br class="d-sm-none">
										<strong>{{ formatIntegerNumber($activity->agriculture_type_transformation_quantity) }}</strong>
									</p>
	@endif
	@if (!empty($activity->agriculture_type_transformation_period))
									<p>
										@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.transformation.choose_period') : <br class="d-sm-none">
										<strong>{{ __('miscellaneous.period.expression.' . $activity->agriculture_type_transformation_period) }}</strong>
									</p>
	@endif
	@if (!empty($activity->agriculture_type_inputs_content))
		@if (!empty($activity->agriculture_type_equipment_content))
									<p style="margin-bottom: 0;">
		@else
									<p>
		@endif
										@lang('miscellaneous.admin.project_writing.data.activity_description.agriculture.culture_type.supply_content') : <br class="d-sm-none">
										<strong>{{ $activity->agriculture_type_inputs_content }}</strong>
									</p>
	@endif
	@if (!empty($activity->agriculture_type_equipment_content))
									<p>
										<strong>{{ $activity->agriculture_type_equipment_content }}</strong>
									</p>
	@endif
								</div>
							</div>
@endif

<!-- Activity field: BREEDING -->
@if (!empty($selected_project->project_activities[0]->breeding_type))
	@php
		$activity = $selected_project->project_activities[0];
	@endphp
							<div class="panel panel-default">
								<div class="panel-heading text-center">
									<h5 style="margin: 0;">@lang('miscellaneous.admin.project_writing.data.activity_description.title') : <span style="font-weight: bold;">@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.title')</span></h5>
								</div>
								<div class="panel-body">
									<p>
										@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.is_land_owner')<br class="d-sm-none">
										<strong>{{ $activity->is_land_owner_breeding == 1 ? __('miscellaneous.yes') : __('miscellaneous.no') }}</strong>
									</p>
	@if ($activity->is_land_owner_breeding == 1)
									<p>
										@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.land_area') : <br class="d-sm-none">
										<strong>{{ formatIntegerNumber($activity->land_area_breeding) }}</strong>
									</p>
	@endif
									<p>
										@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.title') : <br class="d-sm-none">
										<strong>{{ $activity->breeding_type }}</strong>
									</p>
	@if (!empty($activity->breeding_type_fish_content))
									<div class="panel panel-default">
										<div class="panel-heading">
											@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.title')
										</div>
										<div class="panel-body">
											<ul>
		@if (!empty($activity->breeding_type_fish_content))
												<li>
													@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.fish_species') : <br class="d-sm-none">
													<strong>{{ $activity->breeding_type_fish_content }}</strong>
												</li>
		@endif
		@if (!empty($activity->breeding_type_fish_pond_capacity))
												<li>
													@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.pond_capacity') : <br class="d-sm-none">
													<strong>{{ $activity->breeding_type_fish_pond_capacity }}</strong>
												</li>
		@endif
		@if (!empty($activity->breeding_type_fish_cage_capacity))
												<li>
													@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.cage_capacity') : <br class="d-sm-none">
													<strong>{{ $activity->breeding_type_fish_cage_capacity }}</strong>
												</li>
		@endif
		@if (!empty($activity->breeding_type_fish_bin_capacity))
												<li>
													@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.fish.bin_capacity') : <br class="d-sm-none">
													<strong>{{ $activity->breeding_type_fish_bin_capacity }}</strong>
												</li>
		@endif
											</ul>
										</div>
									</div>
	@endif
	@if (!empty($activity->breeding_type_poultry_total_number))
									<div class="panel panel-default">
										<div class="panel-heading">
											@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.poultry.title')
										</div>

										<div class="panel-body">
											<ul>
		@if (!empty($activity->breeding_type_poultry_content))
												<li>
													<strong>{{ $activity->breeding_type_poultry_content }}</strong>
												</li>
		@endif
												<li>
													@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.poultry.animals_total_number') : <br class="d-sm-none">
													<strong>{{ formatIntegerNumber($activity->breeding_type_poultry_total_number) }}</strong>
												</li>
											</ul>
										</div>
									</div>
	@endif
	@if (!empty($activity->breeding_type_pig_total_number))
									<div class="panel panel-default">
										<div class="panel-heading">
											@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.pig.title')
										</div>

										<div class="panel-body">
											<ul>
		@if (!empty($activity->breeding_type_pig_content))
												<li>
													<strong>{{ $activity->breeding_type_pig_content }}</strong>
												</li>
		@endif
												<li>
													@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.pig.animals_total_number') : <br class="d-sm-none">
													<strong>{{ formatIntegerNumber($activity->breeding_type_pig_total_number) }}</strong>
												</li>
											</ul>
										</div>
									</div>
	@endif
	@if (!empty($activity->breeding_type_rabbit_total_number))
									<div class="panel panel-default">
										<div class="panel-heading">
											@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.rabbit.title')
										</div>

										<div class="panel-body">
											<ul>
		@if (!empty($activity->breeding_type_rabbit_content))
												<li>
													<strong>{{ $activity->breeding_type_rabbit_content }}</strong>
												</li>
		@endif
												<li>
													@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.rabbit.animals_total_number') : <br class="d-sm-none">
													<strong>{{ formatIntegerNumber($activity->breeding_type_rabbit_total_number) }}</strong>
												</li>
											</ul>
										</div>
									</div>
	@endif
	@if (!empty($activity->breeding_type_cattle_total_number))
									<div class="panel panel-default">
										<div class="panel-heading">
											@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.cattle.title')
										</div>

										<div class="panel-body">
											<ul>
		@if (!empty($activity->breeding_type_cattle_content))
												<li>
													<strong>{{ $activity->breeding_type_cattle_content }}</strong>
												</li>
		@endif
												<li>
													@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.cattle.animals_total_number') : <br class="d-sm-none">
													<strong>{{ formatIntegerNumber($activity->breeding_type_cattle_total_number) }}</strong>
												</li>
		@if (!empty($activity->breeding_type_cattle_kind))
												<li>
													<strong>{{ __('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.cattle.kind.' . $activity->breeding_type_cattle_kind) }}</strong>
												</li>
		@endif
											</ul>
										</div>
									</div>
	@endif
	@if (!empty($activity->breeding_type_sheep_total_number))
									<div class="panel panel-default">
										<div class="panel-heading">
											@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.sheep.title')
										</div>

										<div class="panel-body">
											<ul>
		@if (!empty($activity->breeding_type_sheep_content))
												<li>
													<strong>{{ $activity->breeding_type_sheep_content }}</strong>
												</li>
		@endif
												<li>
													@lang('miscellaneous.admin.project_writing.data.activity_description.breeding.breeding_type.sheep.animals_total_number') : <br class="d-sm-none">
													<strong>{{ formatIntegerNumber($activity->breeding_type_sheep_total_number) }}</strong>
												</li>
											</ul>
										</div>
									</div>
	@endif

								</div>
							</div>
@endif

							<!-- Market segments -->
							<div class="panel panel-default">
								<div class="panel-heading text-center">
									<h5 style="font-weight: bold; margin: 0;">@lang('miscellaneous.admin.project_writing.data.market_segments_or_target.title')</h5>
								</div>
								<div class="panel-body{{ count($selected_project->market_segments) > 0 ? '' : ' text-center' }}">
									<ul style="padding-left: {{ count($selected_project->market_segments) > 0 ? '16px' : '0' }};">
@forelse ($selected_project->market_segments as $segment)
										<li style="list-style: square;">{{ __($segment->segment_name) }}</li>
@empty
										<li><i>@lang('miscellaneous.empty_list')</i></li>
@endforelse
									</ul>
								</div>
							</div>

							<!-- Accounting summary -->
							<div class="panel panel-default">
								<div class="panel-heading text-center">
									<h5 style="font-weight: bold; margin: 0;">@lang('miscellaneous.admin.project_writing.data.accounting_summary.title')</h5>
								</div>
								<div class="panel-body">
									<p style="margin-bottom: 19px;">
										@lang('miscellaneous.admin.project_writing.data.accounting_summary.employees_count') : <br class="d-sm-none">
										<strong>{{ !empty($selected_project->employees_count) ? formatIntegerNumber($selected_project->employees_count) : 0 }}</strong>
									</p>

@if ($selected_project->is_funded_by_self == 1 || $selected_project->is_funded_by_credit == 1 || $selected_project->is_funded_by_grant == 1)
									<div class="panel panel-default">
										<div class="panel-heading">
											@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.title')
										</div>

										<div class="panel-body">
	@if ($selected_project->is_funded_by_self == 1)
											<p style="margin-bottom: 0;">
												<u style="text-transform: uppercase;">@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_self.title')</u><br>
												@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_self.amount') : <br class="d-sm-none">
												<strong>{{ formatDecimalNumber($selected_project->funding_amount) }} $</strong>
											</p>
	@endif
	@if ($selected_project->is_funded_by_credit == 1)
											<p style="margin-top: 5px; margin-bottom: 0;">
												<u style="text-transform: uppercase;">@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_credit.title')</u><br>
												@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_credit.amount') : <br class="d-sm-none">
												<strong>{{ formatDecimalNumber($selected_project->credit_amount) }} $</strong>
											</p>
	@endif
	@if ($selected_project->is_funded_by_grant == 1)
											<p style="margin-top: 5px; margin-bottom: 0;">
												<u style="text-transform: uppercase;">@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_grant.title')</u><br>
												@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.is_funded_by_grant.amount') : <br class="d-sm-none">
												<strong>{{ formatDecimalNumber($selected_project->grant_amount) }} $</strong>
											</p>
	@endif
	@if (!empty($selected_project->other_funding_sources))
											<p style="margin-top: 5px; margin-bottom: 0;">
												@lang('miscellaneous.admin.project_writing.data.accounting_summary.funding_sources.other_funding_sources') : <br class="d-sm-none">
												<strong>{{ $selected_project->other_funding_sources }} $</strong>
											</p>
	@endif
										</div>
									</div>
@endif

									<p style="margin-bottom: 19px;">
										@lang('miscellaneous.admin.project_writing.data.accounting_summary.annual_turnover') : <br class="d-sm-none">
										<strong>{{ !empty($selected_project->annual_turnover) ? formatDecimalNumber($selected_project->annual_turnover) : 0 }} $</strong>
									</p>

									<div class="panel panel-default">
										<div class="panel-heading">
											@lang('miscellaneous.admin.project_writing.data.accounting_summary.last_year_net.title')
										</div>

										<div class="panel-body">
											<p>
												@lang('miscellaneous.admin.project_writing.data.accounting_summary.last_year_net.profit') : <br class="d-sm-none">
												<strong>{{ !empty($selected_project->last_year_net_profit) ? formatDecimalNumber($selected_project->last_year_net_profit) : 0 }} $</strong>
											</p>
											<p>
												@lang('miscellaneous.admin.project_writing.data.accounting_summary.last_year_net.loss') : <br class="d-sm-none">
												<strong>{{ !empty($selected_project->last_year_net_loss) ? formatDecimalNumber($selected_project->last_year_net_loss) : 0 }} $</strong>
											</p>
										</div>
									</div>

									<p style="margin-bottom: 0;">
										@lang('miscellaneous.admin.project_writing.data.accounting_summary.forecast_turnover') : <br class="d-sm-none">
										<strong>{{ !empty($selected_project->forecast_turnover) ? formatDecimalNumber($selected_project->forecast_turnover) : 0 }} $</strong>
									</p>
								</div>
							</div>

							<!-- Strategic synthesis -->
							<div class="panel panel-default">
								<div class="panel-heading text-center">
									<h5 style="font-weight: bold; margin: 0;">@lang('miscellaneous.admin.project_writing.data.strategic_synthesis.title')</h5>
								</div>
								<div class="panel-body">
									<!-- Business model -->
									<div class="panel panel-default">
										<div class="panel-heading">
											@lang('miscellaneous.admin.project_writing.data.strategic_synthesis.business_model.title')
										</div>
										<div class="panel-body">
											<p style="margin-bottom: 0;">{{ $selected_project->business_model }}</p>
										</div>
									</div>

									<!-- SWOT analysis -->
									<div class="panel panel-default" style="margin-bottom: 0;">
										<div class="panel-heading">
											@lang('miscellaneous.admin.project_writing.data.strategic_synthesis.swot_analysis.title')
										</div>
										<div class="panel-body">
											<p style="margin-bottom: 0;">{{ $selected_project->swot_analysis }}</p>
										</div>
									</div>
								</div>
							</div>

                            <button class="btn btn-custom-2" style="width: 300px; margin: 10px auto;">@lang('miscellaneous.public.agribusiness.finance')</button>
                        </div>
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
