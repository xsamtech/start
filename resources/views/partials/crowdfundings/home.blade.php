
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
	@if (count($user_projects) < 3)
		@if (count($questions) > 0)
							<div class="row">
								<div class="col-lg-7 col-sm-8 col-xs-12">
									<form action="{{ route('crowdfunding.home') }}" method="POST" enctype="multipart/form-data">
			@if (request()->missing('project'))
										<div class="panel panel-default">
											<div class="panel-body">
												<div class="form-group">
													<label for="files_urls">@lang('miscellaneous.upload.upload_images')</label>
													<input type="file" id="files_urls" name="files_urls[]" class="form-control" multiple>
												</div>

												<div id="image-preview-container"></div> <!-- Conteneur pour les vignettes -->

												<div class="input-group textarea-container" style="z-index: 3; margin-top: 10px; margin-bottom: 0;">
													<span class="input-group-addon clearfix">
														<span style="float: left;">
															<span class="input-icon input-icon-message"></span>
															<span class="input-text">@lang('miscellaneous.admin.project_writing.data.description.label')</span>
														</span>
														<span style="float: right; display: inline-block; padding-top: 5px;">
															@lang('miscellaneous.words_remaining') 
															<span id="wordCount" style="font-weight: 600;">500</span>
														</span>
													</span>
													<textarea name="project_description" id="limitWords" class="form-control" cols="30" rows="4" placeholder="@lang('miscellaneous.admin.project_writing.data.description.placeholder')" required></textarea>
												</div>
											</div>
										</div>
			@endif
										<div class="panel panel-default">
											<div class="panel-body">
												<h2 class="text-center" style="margin-bottom: 5px;">{{ $currentPart->part_name }}</h2>
												<p class="text-center text-muted" style="margin-bottom: 20px;">{{ $currentPart->part_description }}</p>

	        @csrf
													<input type="hidden" name="current_part_id" value="{{ $currentPart->id }}">
			@if (request()->has('project'))
													<input type="hidden" name="project_id" value="{{ request()->get('project') }}">
			@endif


			@foreach($questions as $question)
													<div class="form-group question-block" id="question-{{ $question->id }}"
														@if($question->belongs_to) data-belongs-to="{{ $question->belongs_to }}" @endif
														data-assertions="{{ $question->linked_assertion }}" @if($question->belongs_to) style="display:none;" @endif>

														<label>{{ $question->question_content }}</label>

														{{-- Cas 1: unités --}}
                @if(is_null($question->input))
                    @foreach($question->question_assertions as $assertion)
														<div class="{{ $question->multiple_answers_required ? 'checkbox' : 'radio' }}">
															<label>
																<input type="{{ $question->multiple_answers_required ? 'checkbox' : 'radio' }}"
																		class="assertion-input"
																		name="answers[{{ $question->id }}]{{ $question->multiple_answers_required ? '[]' : '' }}"
																		value="{{ $assertion->assertion_content }}"
																		data-question="{{ $question->id }}"
																		data-assertion-id="{{ $assertion->id }}">

																{{ $assertion->assertion_content }}
															</label>
														</div>
                    @endforeach

										                {{-- Cas 3: input spécifique --}}
                @elseif($question->input === 'textarea')
														<textarea class="form-control textarea-limit" name="answers[{{ $question->id }}]"
															@if($question->word_limit) data-word-limit="{{ $question->word_limit }}" @endif
															@if($question->character_limit) data-character-limit="{{ $question->character_limit }}" @endif rows="3" placeholder="{{ $question->question_description }}"></textarea>

					@elseif($question->input === 'input_file')
														<input type="file" name="answers[{{ $question->id }}][]" class="form-control" multiple>
					@else
						@if ($question->measurment_units_required)
														<div style="display: flex; flex-direction: row; align-items: flex-start;">
															{{-- Champ de valeur --}}
															<input type="{{ str_replace('input_', '', $question->input) }}" name="answers[{{ $question->id }}][value]" class="form-control" placeholder="{{ $question->question_description }}" style="width: 70%;">

															{{-- Champ de l’unité --}}
															<select name="answers[{{ $question->id }}][unit]" class="form-control" style="width: 29%; margin-left: 5px;">
																<option class="small" selected disabled>{{ __('miscellaneous.units_of_measurement.title') }}</option>
				            @foreach(['hectare', 'square_meter', 'kilogram', 'tonne', '100_kg_bag'] as $unit)
																<option value="{{ __('miscellaneous.units_of_measurement.'.$unit.'.symbol') }}">
																	{!! __('miscellaneous.units_of_measurement.'.$unit.'.name.plural') !!}
																</option>
				            @endforeach
															</select>
														</div>
						@else
														<input type="{{ str_replace('input_', '', $question->input) }}" name="answers[{{ $question->id }}]" class="form-control" placeholder="{{ $question->question_description }}">
					@endif

	                @endif
					            					</div>
        	@endforeach

													<button type="submit" class="btn {{ $currentPart->is_last_step ? 'strt-bg-green' : 'strt-bg-chocolate-3' }}" style="color: white!important; width: 250px; margin-top: 1rem;">
														{!! $currentPart->is_last_step ? __('miscellaneous.register') : __('pagination.next') !!}
													</button>
											</div>
										</div>
									</form>
								</div>

								<div class="col-lg-5 col-sm-4 col-xs-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">@lang('miscellaneous.admin.project_writing.my_other_projects')</h4>
										</div>
										<div class="panel-body">
			@forelse ($user_projects as $project)
											<div class="panel panel-default">
				@if (count($project->photos) > 0)
												<div class="panel-body" style="padding-bottom: 0;">
													<img src="{{ $project->photos[0]->file_url }}" class="d-block w-100" alt="Image 1" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
												</div>
				@endif
												<div class="panel-body" style="padding-bottom: 8px;">
													<p style="margin: 0 0 5px 0;">
														{!! Str::limit($project->project_description, 200) !!}<br class="d-lg-none">
													</p>
												</div>

				@if (count($project->sheets) > 0)
												<div class="panel-body" style="padding-bottom: 8px;">
													<a href="{{ $project->sheets[0]->file_url }}" target="_blank">
														<p style="margin-bottom: 0;"><i class="bi bi-file-earmark-text" style="font-size: 2rem; color: green; margin-right: 8px; vertical-align: -3px;"></i>@lang('miscellaneous.admin.project_writing.data.sheet_url')</p>
													</a>
												</div>
				@endif

				@if (request()->has('project'))
					@if (request()->get('project') != $project->id)
												<div class="panel-footer clearfix" style="margin: 0;">
													<a href="{{ route('crowdfunding.datas', ['id' => $project->id]) }}" style="float: left; color: #6e9e1a;">@lang('miscellaneous.details') &raquo;</a>
													<a class="float-right" style="float: right; color: red; cursor: pointer;" onclick="event.preventDefault(); performAction('delete', 'project', 'item-{{ $project->id }}')">
														<i class="bi bi-trash2"></i> @lang('miscellaneous.delete')
													</a>
												</div>
					@endif
				@else
												<div class="panel-footer clearfix" style="margin: 0;">
													<a href="{{ route('crowdfunding.datas', ['id' => $project->id]) }}" style="float: left; color: #6e9e1a;">@lang('miscellaneous.details') &raquo;</a>
													<a class="float-right" style="float: right; color: red; cursor: pointer;" onclick="event.preventDefault(); performAction('delete', 'project', 'item-{{ $project->id }}')">
														<i class="bi bi-trash2"></i> @lang('miscellaneous.delete')
													</a>
												</div>
				@endif
											</div>
			@empty
											<div style="display: flex; justify-content: center; align-items: center; flex-direction: column; height: 140px;">
												<i class="bi bi-file-text" style="font-size: 5rem"></i>
												<p class="text-center">@lang('miscellaneous.empty_list')</p>
											</div>
			@endforelse
										</div>
									</div>
								</div>
							</div>
		@else
							<div style="display: flex; justify-content: center; align-items: flex-end; height: 160px;">
								<i class="bi bi-file-text" style="font-size: 9rem"></i>
							</div>
							<h3 class="text-center">@lang('miscellaneous.menu.admin.questionnaire.empty_public_info')</h3>
		@endif
	@else
							<div class="row">
								<div class="col-lg-12 text-center">
									<h3 class="h3-responsive" style="font-weight: bold;; margin-bottom: 5px;">@lang('miscellaneous.admin.project_writing.my_projects.title')</h3>
									<p style="margin-bottom: 20px;">@lang('miscellaneous.admin.project_writing.my_projects.info')</p>
								</div>
		@foreach ($user_projects as $project)
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin: 0 auto;">
									<div class="panel panel-default">
			@if (count($project->photos) > 0)
										<div class="panel-body" style="padding-bottom: 0;">
											<img src="{{ $project->photos[0]->file_url }}" class="d-block w-100" alt="Image 1" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
										</div>
			@endif
										<div class="panel-body" style="padding-bottom: 8px;">
											<p style="margin: 0 0 5px 0;">
												{!! Str::limit($project->project_description, 200) !!}<br class="d-lg-none">
											</p>
										</div>

										<div class="panel-body" style="padding-bottom: 8px;">
			@if (count($project->sheets) > 0)
											<a href="{{ $project->sheets[0]->file_url }}" target="_blank">
												<p class="lead"><i class="bi bi-file-earmark-text" style="font-size: 2rem; color: green; margin-right: 8px; vertical-align: -3px;"></i>@lang('miscellaneous.admin.project_writing.data.sheet_url')</p>
											</a>
			@else
											<a href="{{ route('generate_sheet', ['language' => $current_locale, 'user_id' => $current_user->id, 'project_id' => $project->id]) }}">
												<p style="margin-bottom: 0;"><i class="bi bi-file-earmark-text" style="font-size: 2rem; color: green; margin-right: 8px; vertical-align: -3px;"></i>@lang('miscellaneous.admin.project_writing.data.sheet_url_empty')</p>
											</a>
			@endif
										</div>

										<div class="panel-footer clearfix">
											<a href="{{ route('crowdfunding.datas', ['id' => $project->id]) }}" style="float: left; color: #6e9e1a;">@lang('miscellaneous.details') &raquo;</a>
											<a class="float-right" style="float: right; color: red; cursor: pointer;" onclick="event.preventDefault(); performAction('delete', 'project', 'item-{{ $project->id }}')">
												<i class="bi bi-trash2"></i> @lang('miscellaneous.delete')
											</a>
										</div>
									</div>
								</div>
		@endforeach
							</div>
	@endif
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
