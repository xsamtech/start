<form action="{{ route('project.updatePart', ['project' => $project->id, 'part' => $part->id]) }}" 
      method="POST" enctype="multipart/form-data" id="partUpdateForm">
    @csrf
    @method('PUT')

    <h3 class="text-center" style="margin: 0;">{{ $part->part_name }}</h3>
    <p class="text-muted text-center" style="margin-bottom: 20px;">{{ $part->part_description }}</p>

    @foreach($part->project_questions as $question)
        @php
            $existingAnswer = $answersByQuestion->get($question->id);
            // Pour les checkboxes : tableau des valeurs cochées
            $checkedValues = $existingAnswer
                ? array_map('trim', explode(',', $existingAnswer->answer_content))
                : [];
        @endphp

        <div class="form-group question-block"
             id="question-{{ $question->id }}"
             @if($question->belongs_to) data-belongs-to="{{ $question->belongs_to }}" @endif
             data-assertions="{{ $question->linked_assertion }}"
             @if($question->belongs_to) style="display:none;" @endif>

            <label>{{ $question->question_content }}</label>

            {{-- Cas 1 : question à assertions (choix multiples ou uniques) --}}
            @if(is_null($question->input))
                @foreach($question->question_assertions as $assertion)
                    <div class="{{ $question->multiple_answers_required ? 'checkbox' : 'radio' }}">
                        <label>
                            <input type="{{ $question->multiple_answers_required ? 'checkbox' : 'radio' }}"
                                   class="assertion-input"
                                   name="answers[{{ $question->id }}]{{ $question->multiple_answers_required ? '[]' : '' }}"
                                   value="{{ $assertion->assertion_content }}"
                                   data-question="{{ $question->id }}"
                                   data-assertion-id="{{ $assertion->id }}"
                                   @if(in_array($assertion->assertion_content, $checkedValues)) checked @endif>
                            {{ $assertion->assertion_content }}
                        </label>
                    </div>
                @endforeach

            {{-- Cas 2 : champ texte long --}}
            @elseif($question->input === 'textarea')
                <textarea class="form-control textarea-limit"
                          name="answers[{{ $question->id }}]"
                          rows="3"
                          placeholder="{{ $question->question_description }}">{{ $existingAnswer->answer_content ?? '' }}</textarea>

            {{-- Cas 3 : input simple (texte, nombre, email, etc.) --}}
            @else
                <input type="{{ str_replace('input_', '', $question->input) }}"
                       name="answers[{{ $question->id }}]"
                       class="form-control"
                       placeholder="{{ $question->question_description }}"
                       value="{{ $existingAnswer->answer_content ?? '' }}">
            @endif
        </div>
    @endforeach

    <button type="submit" class="btn strt-btn-chocolate-3" style="width: 250px">
        <span style="color: #fff;">@lang('miscellaneous.register')</span>
    </button>
    <img id="loading-icon" src="{{ asset('assets/img/ajax-loading.gif') }}" alt="" width="40" height="40" style="margin-left: 6px; display: none;">
</form>
