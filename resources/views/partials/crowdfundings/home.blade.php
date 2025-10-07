
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
									<h3 class="text-center" style="margin-bottom: 5px;">{{ $currentPart->part_name }}</h3>
									<p class="text-center text-muted" style="margin-bottom: 20px;">{{ $currentPart->part_description }}</p>

									<form action="{{ route('crowdfunding.home') }}" method="POST" enctype="multipart/form-data">
	        @csrf
										<input type="hidden" name="current_part_id" value="{{ $currentPart->id }}">
	        @if($project)
										<input type="hidden" name="project_id" value="{{ $project->id }}">
	        @endif

			@foreach($questions as $question)
										<div class="form-group question-block" id="question-{{ $question->id }}" 
											data-belongs-to="{{ $question->belongs_to }}" @if($question->belongs_to) style="display:none;" @endif>

											<label>{{ $question->question_content }}</label>

											{{-- Cas 1: unités --}}
                @if($question->measurment_units_required)
											<select name="answers[{{ $question->id }}]" class="form-control">
												<option value="">{{ __('Choisir...') }}</option>
                    @foreach(['hectare', 'square_meter', 'kilogram', 'tonne', '100_kg_bag'] as $unit)
												<option value="{{ __('units_of_measurement.'.$unit.'.symbol') }}">
													{{ __('units_of_measurement.'.$unit.'.symbol') }}
												</option>
                    @endforeach
											</select>

											{{-- Cas 2: assertions --}}
                @elseif(is_null($question->input))
                    @foreach($question->assertions as $assertion)
											<div class="{{ $question->multiple_answers_required ? 'checkbox' : 'radio' }}">
												<label>
													<input type="{{ $question->multiple_answers_required ? 'checkbox' : 'radio' }}"
															name="answers[{{ $question->id }}]{{ $question->multiple_answers_required ? '[]' : '' }}"
															value="{{ $assertion->assertion_content }}"
															data-belongs-required="{{ $assertion->belongs_to_required }}"
															data-question-id="{{ $question->id }}">
													{{ $assertion->assertion_content }}
												</label>
											</div>
                    @endforeach

							                {{-- Cas 3: input spécifique --}}
                @elseif($question->input === 'textarea')
											<textarea class="form-control textarea-limit" name="answers[{{ $question->id }}]"
												@if($question->word_limit) data-word-limit="{{ $question->word_limit }}" @endif
												@if($question->character_limit) data-character-limit="{{ $question->character_limit }}" @endif rows="3"></textarea>

					@elseif($question->input === 'input_file')
											<input type="file" name="answers[{{ $question->id }}][]" class="form-control" multiple>
					@else
						                    <input type="{{ str_replace('input_', '', $question->input) }}" name="answers[{{ $question->id }}]" class="form-control">
                @endif
		            					</div>
        	@endforeach

										<button type="submit" class="btn {{ $currentPart->is_last_step ? 'strt-bg-green' : 'strt-bg-chocolate-3' }}">
											{{ $currentPart->is_last_step ? __('miscellaneous.register') : __('pagination.next') }}
										</button>
									</form>
								</div>

								<div class="col-lg-5 col-sm-4 col-xs-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h5 class="panel-title">@lang('miscellaneous.admin.project_writing.my_other_projects')</h5>
										</div>
										<div class="panel-body">
			@forelse ($user_projects as $project)
											<div class="panel panel-default">
												<div class="panel-body">
				@forelse ($project->project_answers->take(3) as $answer)
													<p style="margin: 0 0 5px 0;">{{ $answer->project_question }} : <strong>{{ $answer->answer_content }}</strong></p>
				@empty
				@endforelse
												</div>
												<div class="panel-footer">
													<a href="{{ route('crowdfunding.datas', ['id' => $project->id]) }}">@lang('miscellaneous.details') &raquo;</a>
												</div>
											</div>
			@empty
											<div style="display: flex; justify-content: center; align-items: flex-end; height: 120px;">
												<i class="bi bi-file-text" style="font-size: 9rem"></i>
											</div>
											<p class="text-center">@lang('miscellaneous.empty_list')</p>
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
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-4 col-sm-5 col-xs-12">
													<img src="{{ count($project->photos) > 0 ? $project->photos[0]->file_url : asset('assets/img/undefined.png') }}" alt="" style="height: 160px; margin-top: 10px; border-radius: 14px; object-fit: cover;" class="img-responsive">
												</div>
												<div class="col-lg-8 col-sm-7 col-xs-12">
													<p style="line-height: 19px; margin-top: 10px; margin-bottom: 1px;">{!! Str::limit($project->projects_description, 100) !!}</p>
													<a href="{{ route('crowdfunding.datas', ['id' => $project->id]) }}" class="small text-primary" style="text-decoration: underline;">@lang('miscellaneous.details') <i class="bi bi-chevron-double-right"></i></a>
													<div>
			@if (!empty($project->sheet_url))
														<a href="{{ $project->sheet_url }}">
															<div class="panel panel-default">
																<div class="panel-body">
																	<p class="lead"><i class="bi bi-file-excel-fill" style="color: green; margin-right: 8px;"></i>@lang('miscellaneous.admin.project_writing.data.sheet_url')</p>
																</div>
															</div>
														</a>
			@else
														<a href="{{ route('generate_sheet', ['language' => $current_locale, 'user_id' => $current_user->id]) }}" target="_blank">
															<div class="panel panel-default">
																<div class="panel-body">
																	<p style="margin-bottom: 0;"><i class="bi bi-file-excel" style="color: green; margin-right: 8px;"></i>@lang('miscellaneous.admin.project_writing.data.sheet_url_empty')</p>
																</div>
															</div>
														</a>
			@endif
													</div>
												</div>
											</div>
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
