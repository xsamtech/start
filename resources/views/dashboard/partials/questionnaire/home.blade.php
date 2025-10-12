{{ dd($project_questions_req) }}
            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">@lang('miscellaneous.menu.admin.questionnaire.title')</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item">@lang('miscellaneous.menu.admin.questionnaire.title')</li>
                        </ul>
                    </div>
                </div>
                <!-- [ page-header ] end -->
                <!-- [ Main Content ] start -->
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card card-body">
                                <h5 class="mb-3">@lang('miscellaneous.menu.admin.questionnaire.questions.title')</h5>

                                <!-- Data list content -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered border-top">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>@lang('miscellaneous.menu.admin.questionnaire.questions.data.question_content')</th>
                                                <th>@lang('miscellaneous.menu.admin.questionnaire.questions.data.belongs_to')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
@forelse ($project_questions as $question)
                                            <tr>
                                                <td>
                                                    <p class="m-0" style="max-width: 280px; white-space: normal;">{{ $loop->index + 1 }}</p>
                                                </td>
                                                <td>
                                                    <p class="m-0" style="max-width: 280px; white-space: normal;">{{ $question['question_content'] }}</p>
                                                </td>
                                                <td class="text-center">
    @if (!empty($question['belongs_to']))
                                                    <p class="m-0" style="max-width: 280px; white-space: normal;"><a href="{{ route('dashboard.questionnaire.entity.datas', ['entity' => 'question', 'id' => $question['belongs_to']]) }}">{{ $question['belongs_to'] }}</a></p>
    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.questionnaire.entity.datas', ['entity' => 'question', 'id' => $question['id'], 'from' => $project_questions_req->currentPage()]) }}">
                                                        @lang('miscellaneous.details')<i class="feather-chevrons-right ms-1"></i>
                                                    </a><br>
                                                    <a role="button" class="d-inline-block mt-1 rounded-pill text-danger" onclick="event.preventDefault(); performAction('delete', 'question', 'item-{{ $question['id'] }}')">
                                                        <i class="feather-trash-2 me-2"></i>@lang('miscellaneous.delete')
                                                    </a>
                                                </td>
                                            </tr>
@empty
                                            <tr>
                                                <td colspan="4" class="lead text-center">@lang('miscellaneous.empty_list')</td>
                                            </tr>
@endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-3">
                                    {{ $project_questions_req->links() }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card overflow-hidden">
                                <div class="card-header strt-bg-green-transparent">
                                    <h5 class="mb-0 text-white">@lang('miscellaneous.menu.admin.questionnaire.questions.add')</h5>
                                </div>

                                <div class="card-body">
                                    <form id="addQuestionForm" action="{{ route('dashboard.questionnaire.entity.home', ['entity' => 'question']) }}" method="POST">
@csrf
                                        <!-- Part ID -->
                                        <div class="mb-2 position-relative">
                                            <label for="question_part_id" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.question_part_id')</label>
                                            <select name="question_part_id" id="question_part_id" class="form-select">
                                                <option class="small" selected disabled>@lang('miscellaneous.menu.admin.questionnaire.questions.data.question_part_id')</option>
@foreach ($question_parts as $part)
                                                <option value="{{ $part['id'] }}">{{ $part['part_name'] }}</option>
@endforeach
                                            </select>
                                            <a role="button" class="btn btn-light p-1 position-absolute" style="bottom: 0.3rem; right: 0.3rem; z-index: 9; width: 40px; height: 40px;" data-bs-toggle="modal" data-bs-target="#questionPartModal">
                                                <i class="bi bi-plus-lg"></i>
                                            </a>
                                        </div>

                                        <!-- Question content -->
                                        <div class="mb-2">
                                            <label for="question_content_fr" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.question_content') (FR)</label>
                                            <input type="text" name="question_content_fr" class="form-control" id="question_content_fr">
                                        </div>
                                        <div class="mb-2">
                                            <label for="question_content_en" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.question_content') (EN)</label>
                                            <input type="text" name="question_content_en" class="form-control" id="question_content_en">
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-2">
                                            <label for="question_description_fr" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.question_description') (FR)</label>
                                            <textarea name="question_description_fr" class="form-control" id="question_description_fr"></textarea>
                                        </div>
                                        <div class="mb-2">
                                            <label for="question_description_en" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.question_description') (EN)</label>
                                            <textarea name="question_description_en" class="form-control" id="question_description_en"></textarea>
                                        </div>

                                        <!-- Multiple answers required -->
                                        <div class="my-3 text-center">
                                            <label class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.multiple_answers_required')</label>

                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="multiple_answers_required" id="multiple_answers_required1" value="1">
                                                    <label role="button" class="form-check-label" for="multiple_answers_required1">@lang('miscellaneous.yes')</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="multiple_answers_required" id="multiple_answers_required0" value="0">
                                                    <label role="button" class="form-check-label" for="multiple_answers_required0">@lang('miscellaneous.no')</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Input -->
                                        <div class="mb-2">
                                            <label for="input" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.title')</label>
                                            <select name="input" id="input" class="form-select">
                                                <option class="small" disabled selected>@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.title')</option>
                                                <option value="input_text">@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.input_text')</option>
                                                <option value="input_number">@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.input_number')</option>
                                                <option value="input_email">@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.input_email')</option>
                                                <option value="input_tel">@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.input_tel')</option>
                                                <option value="input_file">@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.input_file')</option>
                                                <option value="textarea">@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.textarea')</option>
                                            </select>
                                        </div>

                                        <!-- Words limit -->
                                        <div class="mb-2">
                                            <label for="word_limit" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.word_limit')</label>
                                            <input type="number" name="word_limit" class="form-control" id="word_limit">
                                        </div>

                                        <!-- Characters limit -->
                                        <div class="mb-2">
                                            <label for="character_limit" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.character_limit')</label>
                                            <input type="number" name="character_limit" class="form-control" id="character_limit">
                                        </div>

                                        <!-- Belongs to -->
                                        <div class="mb-2">
                                            <label for="belongs_to" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.belongs_to')</label>
                                            <select name="belongs_to" id="belongs_to" class="form-select" data-assertions-url="{{ route('dashboard.questionnaire.entity.datas', ['entity' => 'assertions-question', 'id' => 'QUESTION_ID']) }}">
                                                <option class="small" selected disabled>@lang('miscellaneous.menu.admin.questionnaire.questions.data.belongs_to')</option>
@foreach ($project_questions_all as $question)
                                                <option value="{{ $question['id'] }}">{{ $question['question_content'] }}</option>
@endforeach
                                            </select>
                                        </div>

                                        <!-- Assertions liées -->
                                        <div id="belongsToAssertions" class="mb-3" style="display:none;">
                                            <label class="form-label fw-bold">
                                                @lang('miscellaneous.menu.admin.questionnaire.questions.data.assertions_linked')
                                            </label>
                                            <div id="assertionsContainer" class="border rounded p-2"></div>
                                            <input type="hidden" name="linked_assertion" id="linked_assertion">
                                        </div>

                                        <!-- Measurment units required -->
                                        <div class="my-3 text-center">
                                            <label class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.measurment_units_required')</label>

                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="measurment_units_required" id="measurment_units_required1" value="1">
                                                    <label role="button" class="form-check-label" for="measurment_units_required1">@lang('miscellaneous.yes')</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="measurment_units_required" id="measurment_units_required0" value="0">
                                                    <label role="button" class="form-check-label" for="measurment_units_required0">@lang('miscellaneous.no')</label>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn strt-btn-chocolate-3 w-100 mt-4 px-4 rounded-pill">{{ __('miscellaneous.register') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
