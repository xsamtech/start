			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li><a href="{{ route('crowdfunding.home') }}">@lang('miscellaneous.menu.public.crowdfunding')</a></li>
							<li class="active">@lang('miscellaneous.admin.project_writing.details')</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div id="aboutProject" class="row">
					    <div class="col-md-12" style="margin-bottom: 10px;">
							<header class="content-title">
								<h1 class="title">@lang('miscellaneous.admin.project_writing.details')</h1>
								<p class="title-desc"><i class="bi bi-calendar-event" style="margin-right: 7px;"></i> {{ ucfirst(explicitDate($selected_project->created_at)) }}</p>
							</header>
                        </div>

						<!-- User profile -->
						<div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
							<div class="panel panel-default text-center">
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

							<div class="panel panel-default">
								<div class="panel-body" style="padding: 5px 10px 0 10px;">
@if (count($selected_project->sheets) > 0)
	@if ($completedSheet)
									<p style="margin: 0:">
										<a href="{{ $completedSheet->file_url }}" target="_blank">
											<p style="margin-bottom: 0;"><i class="bi bi-file-earmark-text" style="font-size: 2rem; color: green; margin-right: 8px; vertical-align: -3px;"></i>@lang('miscellaneous.admin.project_writing.data.sheet_url_completed')</p>
										</a>
									</p>
	@else
									<p>
										<a href="{{ $selected_project->sheets[0]->file_url }}" target="_blank">
											<p style="margin-bottom: 0;"><i class="bi bi-file-earmark-text" style="font-size: 2rem; color: green; margin-right: 8px; vertical-align: -3px;"></i>@lang('miscellaneous.admin.project_writing.data.sheet_url')</p>
										</a>
									</p>

	@endif
@else
									<p style="margin: 0:">
										<a href="{{ route('generate_sheet', ['language' => $current_locale, 'user_id' => $current_user->id, 'project_id' => $selected_project->id]) }}">
											<p style="margin-bottom: 0;"><i class="bi bi-file-earmark-text" style="font-size: 2rem; color: green; margin-right: 8px; vertical-align: -3px;"></i>@lang('miscellaneous.admin.project_writing.data.sheet_url_empty')</p>
										</a>
									</p>
@endif
								</div>
							</div>
@if (count($selected_project->sheets) > 0 && !$completedSheet)
							<div class="panel panel-default">
								<div class="panel-heading">
									<p style="margin: 0;">@lang('miscellaneous.admin.project_writing.data.sheet_url_resend')</p>
								</div>

								<div class="panel-body">
									<form action="{{ route('send_file') }}" method="POST" enctype="multipart/form-data">
	@csrf
										<input type="hidden" name="project_id" value="{{ $selected_project->id }}">
										<input type="hidden" name="file_name" value="{{ __('miscellaneous.admin.project_writing.data.sheet_url_completed') . __('miscellaneous.colon_after_word') . ' ' . $selected_project->user->firstname . ' ' . $selected_project->user->lastname }}">

										<div class="form-group">
											<label for="sheet_url">@lang('miscellaneous.upload.upload_file')</label>
											<input type="file" name="sheet_url" id="sheet_url" required>
										</div>

										<button type="submit" class="btn btn-sm strt-btn-chocolate-2" style="width: 200px;">@lang('miscellaneous.send')</button>
									</form>
								</div>
							</div>
@endif
						</div>

						<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
							<div class="panel panel-default mt-4">
@if (count($selected_project->photos) > 0)
								<div class="panel-body" style="padding-bottom: 0;">
									<div class="my-carousel" style="border-radius: 10px; overflow: hidden;">
	@foreach ($selected_project->photos as $photo)
										<div>
											<img src="{{ $photo->file_url }}" class="d-block w-100" alt="Image {{ $loop->index + 1 }}" style="width: 100%; height: 300px; object-fit: cover;">
										</div>
	@endforeach
									</div>
								</div>
@endif

								<div class="panel-body" style="padding-bottom: 0;">
									<h5 class="mb-1" style="font-weight: 600;">
										<u>@lang('miscellaneous.admin.project_writing.data.description.label')</u>
									</h5>
									<pre style="background: transparent; padding: 5px 0 0 0; border: none; line-height: 16px;">
{!! $selected_project->project_description !!}
									</pre>
								</div>
							</div>


@php
    // Petite fonction pour convertir un nombre en chiffre romain
    function toRoman($num) {
        $map = [
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
        ];
        $returnValue = '';
        while ($num > 0) {
            foreach ($map as $roman => $int) {
                if ($num >= $int) {
                    $num -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
@endphp
@foreach($groupedByPart as $index => $answers)
    @php
        $partName = $index; // la clé du groupBy = nom de la partie
        $romanIndex = toRoman($loop->iteration); // conversion en chiffre romain
    @endphp
                            <div class="panel">
                                <div class="panel-heading bg-secondary text-white">
                                    <h3 class="mt-4 mb-0">{{ $romanIndex }}. {{ $partName }}</h3>
                                </div>

                                <div class="panel-body" style="padding-top: 0;">
    @foreach($answers as $qIndex => $answer)
                                    <div class="mb-4">
                                        <p class="fw-bold">
                                            <strong>{{ $answer->project_question->question_content }}</strong>
                                        </p>
                                        <!--<p class="mb-1 text-muted">{{ __('Réponse :') }}</p>-->
                                        <pre style="background:#f8f9fa; padding:10px; border-radius:5px; white-space:pre-wrap;">
{{ $answer->answer_content }}
                                        </pre>
                                    </div>
    @endforeach
                                </div>
                            </div>
@endforeach

@if($groupedByPart->isEmpty())
                            <div class="alert alert-info mt-4">
                                {{ __('Aucune réponse enregistrée pour ce projet.') }}
                            </div>
@endif

                            <div class="mt-4 text-center">
                                <a href="{{ route('crowdfunding.home') }}" class="btn btn-secondary">
                                    ← {{ __('miscellaneous.back_form') }}
                                </a>
                            </div>
						</div>
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
