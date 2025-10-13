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

						<!-- Profile -->
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

							<div>
                                SHEET URL
							</div>
						</div>

						<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
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
                            <div class="panel mt-4 shadow-sm">
                                <div class="panel-heading bg-secondary text-white">
                                    <h2 class="mt-4 mb-0">{{ $romanIndex }}. {{ $partName }}</h2>
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
