
            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">{{ $entity_title }}</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.questionnaire.home') }}">@lang('miscellaneous.menu.admin.questionnaire.title')</a></li>
                            <li class="breadcrumb-item">{{ $entity_title }}</li>
                        </ul>
                    </div>
                </div>
                <!-- [ page-header ] end -->
                <!-- [ Main Content ] start -->
                <div class="main-content">
                    <div class="row">
@if ($entity == 'question')
                        <div class="col-lg-6">
                            <div class="card overflow-hidden">
                                <div class="card-header strt-bg-green-transparent">
                                    <h5 class="mb-0 text-white">@lang('miscellaneous.menu.admin.questionnaire.questions.edit')</h5>
                                </div>

                                <div class="card-body">
                                    <form id="addQuestionForm" action="{{ route('dashboard.questionnaire.entity.datas', ['entity' => 'question', 'id' => $selected_entity['id']]) }}" method="POST">
    @csrf
                                        <!-- Part ID -->
                                        <div class="mb-2 position-relative">
                                            <label for="question_part_id" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.question_part_id')</label>
                                            <select name="question_part_id" id="question_part_id" class="form-select">
                                                <option class="small" selected disabled>@lang('miscellaneous.menu.admin.questionnaire.questions.data.question_part_id')</option>
    @foreach ($question_parts as $part)
                                                <option value="{{ $part['id'] }}" {{ $selected_entity['question_part_id'] == $part['id'] ? 'selected' : '' }}>{{ $part['part_name'] }}</option>
    @endforeach
                                            </select>
                                            <a role="button" class="btn btn-light p-1 position-absolute" style="bottom: 0.3rem; right: 0.3rem; z-index: 9; width: 40px; height: 40px;" data-bs-toggle="modal" data-bs-target="#questionPartModal">
                                                <i class="bi bi-plus-lg"></i>
                                            </a>
                                        </div>

                                        <!-- Question content -->
                                        <div class="mb-2">
                                            <label for="question_content_fr" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.question_content') (FR)</label>
                                            <input type="text" name="question_content_fr" class="form-control" id="question_content_fr" value="{{ $selected_entity['question_content_fr'] }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="question_content_en" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.question_content') (EN)</label>
                                            <input type="text" name="question_content_en" class="form-control" id="question_content_en" value="{{ $selected_entity['question_content_en'] }}">
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-2">
                                            <label for="question_description_fr" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.question_description') (FR)</label>
                                            <textarea name="question_description_fr" class="form-control" id="question_description_fr">{{ $selected_entity['question_description_fr'] }}</textarea>
                                        </div>
                                        <div class="mb-2">
                                            <label for="question_description_en" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.question_description') (EN)</label>
                                            <textarea name="question_description_en" class="form-control" id="question_description_en">{{ $selected_entity['question_description_en'] }}</textarea>
                                        </div>

                                        <!-- Multiple answers required -->
                                        <div class="my-3 text-center">
                                            <label class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.multiple_answers_required')</label>

                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="multiple_answers_required" id="multiple_answers_required1" value="1" {{ $selected_entity['multiple_answers_required'] == 1 ? 'checked' : '' }}>
                                                    <label role="button" class="form-check-label" for="multiple_answers_required1">@lang('miscellaneous.yes')</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="multiple_answers_required" id="multiple_answers_required0" value="0" {{ $selected_entity['multiple_answers_required'] == 0 ? 'checked' : '' }}>
                                                    <label role="button" class="form-check-label" for="multiple_answers_required0">@lang('miscellaneous.no')</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Input -->
                                        <div class="mb-2">
                                            <label for="input" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.title')</label>
                                            <select name="input" id="input" class="form-select">
                                                <option class="small" disabled {{ $selected_entity['input'] == null ? 'selected' : '' }}>@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.title')</option>
                                                <option value="input_text" {{ $selected_entity['input'] == 'input_text' ? 'selected' : '' }}>@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.input_text')</option>
                                                <option value="input_number" {{ $selected_entity['input'] == 'input_number' ? 'selected' : '' }}>@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.input_number')</option>
                                                <option value="input_email" {{ $selected_entity['input'] == 'input_email' ? 'selected' : '' }}>@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.input_email')</option>
                                                <option value="input_tel" {{ $selected_entity['input'] == 'input_tel' ? 'selected' : '' }}>@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.input_tel')</option>
                                                <option value="input_file" {{ $selected_entity['input'] == 'input_file' ? 'selected' : '' }}>@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.input_file')</option>
                                                <option value="textarea" {{ $selected_entity['input'] == 'textarea' ? 'selected' : '' }}>@lang('miscellaneous.menu.admin.questionnaire.questions.data.input.textarea')</option>
                                            </select>
                                        </div>

                                        <!-- Words limit -->
                                        <div class="mb-2">
                                            <label for="word_limit" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.word_limit')</label>
                                            <input type="number" name="word_limit" class="form-control" id="word_limit" value="{{ $selected_entity['word_limit'] }}">
                                        </div>

                                        <!-- Characters limit -->
                                        <div class="mb-2">
                                            <label for="character_limit" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.character_limit')</label>
                                            <input type="number" name="character_limit" class="form-control" id="character_limit" value="{{ $selected_entity['character_limit'] }}">
                                        </div>

                                        <!-- Belongs to -->
                                        <div class="mb-2">
                                            <label for="belongs_to" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.belongs_to')</label>
                                            <select name="belongs_to" id="belongs_to" class="form-select" data-assertions-url="{{ route('dashboard.questionnaire.entity.datas', ['entity' => 'assertions-question', 'id' => $selected_entity['id']]) }}">
                                                <option class="small" disabled {{ $selected_entity['input'] == null ? 'selected' : '' }}>@lang('miscellaneous.menu.admin.questionnaire.questions.data.belongs_to')</option>
    @foreach ($project_questions as $question)
                                                <option value="{{ $question['id'] }}" {{ $selected_entity['belongs_to'] == $question['id']  ? 'selected' : '' }}>{{ $question['question_content'] }}</option>
    @endforeach
                                            </select>
                                        </div>

                                        <!-- Assertions liées -->
                                        <div id="belongsToAssertions" class="mb-3" style="display:none;">
                                            <label class="form-label fw-bold">
                                                @lang('miscellaneous.menu.admin.questionnaire.questions.data.assertions_linked')
                                            </label>
                                            <div id="assertionsContainer" class="border rounded p-2">
    @php
        $question_assertions = \App\Models\QuestionAssertions::where(['project_question_id', $selected_entity['id']])->get();
    @endphp
    @forelse ($question_assertions as $assertion)
                                                <div class="form-check">
                                                    <input class="form-check-input assertion-checkbox" type="checkbox" value="{{ $assertion['id'] }}" id="assertion_{{ $assertion['id'] }}" {{ $assertion['project_question_id'] == $selected_entity['id'] ? 'checked' : ''}}>
                                                    <label role="button" class="form-check-label" for="assertion_{{ $assertion['id'] }}">{{ $assertion['assertion_content'] }}</label>
                                                </div>
    @empty
    @endforelse
                                            </div>
                                            <input type="hidden" name="linked_assertion" id="linked_assertion">
                                        </div>

                                        <!-- Measurment units required -->
                                        <div class="my-3 text-center">
                                            <label class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.questions.data.measurment_units_required')</label>

                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="measurment_units_required" id="measurment_units_required1" value="1" {{ $selected_entity['measurment_units_required'] == 1 ? 'checked' : '' }}>
                                                    <label role="button" class="form-check-label" for="measurment_units_required1">@lang('miscellaneous.yes')</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="measurment_units_required" id="measurment_units_required0" value="0" {{ $selected_entity['measurment_units_required'] == 0 ? 'checked' : '' }}>
                                                    <label role="button" class="form-check-label" for="measurment_units_required0">@lang('miscellaneous.no')</label>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn strt-btn-chocolate-3 w-100 mt-4 px-4 rounded-pill">{{ __('miscellaneous.update') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-body mb-4">
                                <div class="card card-body shadow-0">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/addons/duralux/img/flags/4x3/fr.svg') }}" alt="" class="img-fluid wd-20 me-2" />
                                        <strong>Français</strong>
                                    </div>

                                    <h3 class="my-2">{{ $selected_entity['question_content_fr'] ?? '' }}</h3>
                                    <p class="m-0">
                                        <u>@lang('miscellaneous.description')</u><br>
                                        {{ $selected_entity['question_description_fr'] ?? '' }}
                                    </p>
                                </div>
                                <div class="card card-body mb-3 shadow-0">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/addons/duralux/img/flags/4x3/us.svg') }}" alt="" class="img-fluid wd-20 me-2" />
                                        <strong>English</strong>
                                    </div>

                                    <h3 class="my-2">{{ $selected_entity['question_content_en'] ?? '' }}</h3>
                                    <p class="m-0">
                                        <u>@lang('miscellaneous.description')</u><br>
                                        {{ $selected_entity['question_description_en'] ?? '' }}
                                    </p>
                                </div>

                                <h5 class="my-2 fw-lighter">
                                    @lang('miscellaneous.menu.admin.questionnaire.questions.data.multiple_answers_required')@lang('miscellaneous.colon_after_word')
                                    <strong>{{ $selected_entity['readable_multiple_answers_required'] ?? '' }}</strong>
                                </h5>

                                <h5 class="my-2 fw-lighter">
                                    @lang('miscellaneous.menu.admin.questionnaire.questions.data.input.title')@lang('miscellaneous.colon_after_word')
                                    <strong>{{ $selected_entity['readable_input'] ?? '' }}</strong>
                                </h5>

                                <h5 class="my-2 fw-lighter">
                                    @lang('miscellaneous.menu.admin.questionnaire.questions.data.word_limit')@lang('miscellaneous.colon_after_word')
                                    <strong>{{ $selected_entity['word_limit'] ?? '' }}</strong>
                                </h5>

                                <h5 class="my-2 fw-lighter">
                                    @lang('miscellaneous.menu.admin.questionnaire.questions.data.character_limit')@lang('miscellaneous.colon_after_word')
                                    <strong>{{ $selected_entity['character_limit'] ?? '' }}</strong>
                                </h5>

                                <h5 class="my-2 fw-lighter">
                                    @lang('miscellaneous.menu.admin.questionnaire.questions.data.belongs_to')@lang('miscellaneous.colon_after_word')
    @if (!empty($selected_entity['belongs_to']))
                                    <strong><a href="{{ route('dashboard.questionnaire.entity.datas', ['entity' => 'question', 'id' => $selected_entity['belongs_to']]) }}">{{ $selected_entity['belongs_to'] }}</a></strong>
    @endif
                                </h5>

                                <h5 class="my-2 fw-lighter">
                                    @lang('miscellaneous.menu.admin.questionnaire.questions.data.measurment_units_required')@lang('miscellaneous.colon_after_word')
                                    <strong>{{ $selected_entity['readable_measurment_units_required'] ?? '' }}</strong>
                                </h5>
                            </div>

                            <div class="card overflow-hidden">
                                <div class="card-header strt-bg-chocolate-3">
                                    <h5 class="mb-0 text-white">Assertions</h5>
                                </div>
    @php
        $assertions_req = \App\Models\QuestionAssertion::where('project_question_id', $selected_entity['id'])->get();
        $assertions = \App\Http\Resources\QuestionAssertion::collection($assertions_req)->resolve();
    @endphp
                                <ul class="list-group list-group-flush border-bottom">
    @foreach ($assertions as $assertion)
                                    <li class="list-group-item clearfix">
                                        <a href="{{ route('dashboard.questionnaire.entity.datas', ['entity' => 'assertion', 'id' => $assertion['id']]) }}" class="strt-btn-green float-end rounded-circle" title="@lang('miscellaneous.change')" data-bs-toggle="tooltip" style="width: 25px; height: 25px; padding: 0.25rem 0.3rem 0.25rem 0.3rem;"><i class="bi bi-pencil"></i></a>
                                        <a role="button" class="btn-danger mx-2 float-end rounded-circle" title="@lang('miscellaneous.delete')" data-bs-toggle="tooltip" style="width: 25px; height: 25px; padding: 0.25rem 0.3rem 0.25rem 0.3rem;" onclick="event.preventDefault(); performAction('delete', 'assertion', 'item-{{ $assertion['id'] }}')"><i class="bi bi-x-lg"></i></a>
                                        <h4>{{ $assertion['assertion_content'] }}</h4>
                                        <p>@lang('miscellaneous.menu.admin.questionnaire.assertions.data.belongs_to_required')@lang('miscellaneous.colon_after_word') <strong>{{ $assertion['readable_belongs_to_required'] }}</strong></p>
                                    </li>
    @endforeach
                                </ul>

                                <div class="card-body" style="background-color: #f9f9f9;">
                                    <h5 class="mb-4">@lang('miscellaneous.menu.admin.questionnaire.assertions.add')</h5>

                                    <form id="addAssertionForm" action="{{ route('dashboard.questionnaire.entity.home', ['entity' => 'assertion']) }}" method="POST">
    @csrf
                                        <input type="hidden" name="project_question_id" value="{{ $selected_entity['id'] }}">

                                        <!-- Assertion content -->
                                        <div class="mb-2">
                                            <label for="assertion_content_fr" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.assertions.data.assertion_content') (FR)</label>
                                            <input type="text" name="assertion_content_fr" class="form-control" id="question_content_fr">
                                        </div>
                                        <div class="mb-2">
                                            <label for="assertion_content_en" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.assertions.data.assertion_content') (EN)</label>
                                            <input type="text" name="assertion_content_en" class="form-control" id="question_content_en">
                                        </div>

                                        <!-- Belongs to required -->
                                        <div class="my-3 text-center">
                                            <label class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.assertions.data.belongs_to_required')</label>

                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="belongs_to_required" id="belongs_to_required1" value="1">
                                                    <label role="button" class="form-check-label" for="belongs_to_required1">@lang('miscellaneous.yes')</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="belongs_to_required" id="belongs_to_required0" value="0">
                                                    <label role="button" class="form-check-label" for="belongs_to_required0">@lang('miscellaneous.no')</label>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn strt-btn-green w-100 mt-4 px-4 rounded-pill">{{ __('miscellaneous.register') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
@endif

@if ($entity == 'assertion')
                        <div class="col-lg-6">
                            <div class="card overflow-hidden">
                                <div class="card-header strt-bg-green-transparent">
                                    <h5 class="mb-0 text-white">@lang('miscellaneous.menu.admin.questionnaire.assertions.edit')</h5>
                                </div>

                                <div class="card-body">
                                    <form id="addAssertionForm" action="{{ route('dashboard.questionnaire.entity.datas', ['entity' => 'assertion', 'id' => $selected_entity['id']]) }}" method="POST">
    @csrf
                                        <!-- Question ID -->
                                        <div class="mb-2">
                                            <label for="project_question_id" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.assertions.data.project_question_id')</label>
                                            <select name="project_question_id" id="project_question_id" class="form-select">
                                                <option class="small" selected disabled>@lang('miscellaneous.menu.admin.questionnaire.assertions.data.project_question_id')</option>
    @foreach ($project_questions as $question)
                                                <option value="{{ $question['id'] }}" {{ $selected_entity['project_question_id'] == $question['id'] ? 'selected' : '' }}>{{ $question['question_content'] }}</option>
    @endforeach
                                            </select>
                                        </div>

                                        <!-- Assertion content -->
                                        <div class="mb-2">
                                            <label for="assertion_content_en" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.assertions.data.assertion_content') (FR)</label>
                                            <input type="text" name="assertion_content_fr" class="form-control" id="question_content_fr" value="{{ $selected_entity['assertion_content_fr'] }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="assertion_content_fr" class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.assertions.data.assertion_content') (EN)</label>
                                            <input type="text" name="assertion_content_en" class="form-control" id="question_content_en" value="{{ $selected_entity['assertion_content_en'] }}">
                                        </div>

                                        <!-- Belongs to required -->
                                        <div class="my-3 text-center">
                                            <label class="form-label fw-bold">@lang('miscellaneous.menu.admin.questionnaire.assertions.data.belongs_to_required')</label>

                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="belongs_to_required" id="belongs_to_required1" value="1" {{ $selected_entity['belongs_to_required'] == 1 ? 'checked' : '' }}>
                                                    <label role="button" class="form-check-label" for="belongs_to_required1">@lang('miscellaneous.yes')</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="belongs_to_required" id="belongs_to_required0" value="0" {{ $selected_entity['belongs_to_required'] == 0 ? 'checked' : '' }}>
                                                    <label role="button" class="form-check-label" for="belongs_to_required0">@lang('miscellaneous.no')</label>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn strt-btn-chocolate-3 w-100 mt-4 px-4 rounded-pill">{{ __('miscellaneous.update') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-body mb-4">
                                <div class="card card-body shadow-0">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/addons/duralux/img/flags/4x3/fr.svg') }}" alt="" class="img-fluid wd-20 me-2" />
                                        <strong>Français</strong>
                                    </div>

                                    <h3 class="mt-2">{{ $selected_entity['assertion_content_fr'] ?? '' }}</h3>
                                </div>
                                <div class="card card-body mb-3 shadow-0">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/addons/duralux/img/flags/4x3/us.svg') }}" alt="" class="img-fluid wd-20 me-2" />
                                        <strong>English</strong>
                                    </div>

                                    <h3 class="mt-2">{{ $selected_entity['assertion_content_en'] ?? '' }}</h3>
                                </div>

                                <h5 class="my-2 fw-lighter">
                                    @lang('miscellaneous.menu.admin.questionnaire.assertions.data.belongs_to_required')@lang('miscellaneous.colon_after_word')
                                    <strong>{{ $selected_entity['readable_belongs_to_required'] ?? '' }}</strong>
                                </h5>
                            </div>
                        </div>
@endif

@if ($entity == 'project')

@endif
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
