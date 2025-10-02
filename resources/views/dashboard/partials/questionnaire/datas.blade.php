
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
                                        <!-- Category name -->
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
                                            <select name="belongs_to" id="belongs_to" class="form-select">
                                                <option class="small" disabled {{ $selected_entity['input'] == null ? 'selected' : '' }}>@lang('miscellaneous.menu.admin.questionnaire.questions.data.belongs_to')</option>
    @foreach ($project_questions as $question)
                                                <option value="{{ $question['id'] }}" {{ $selected_entity['belongs_to'] == $question['id']  ? 'selected' : '' }}>{{ $question['question_content'] }}</option>
    @endforeach
                                            </select>
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

                            <div class="card card-body">
                            </div>
                        </div>
@endif

@if ($entity == 'assertion')

@endif

@if ($entity == 'project')

@endif
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
