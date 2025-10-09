<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class ProjectQuestion extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array
    {
        $input = null;
        $multiple_answers_required = null;
        $measurment_units_required = null;

        switch ($this->input) {
            case 'input_text':
                $input = __('miscellaneous.menu.admin.questionnaire.questions.data.input.input_text');
                break;

            case 'input_number':
                $input = __('miscellaneous.menu.admin.questionnaire.questions.data.input.input_number');
                break;

            case 'input_email':
                $input = __('miscellaneous.menu.admin.questionnaire.questions.data.input.input_email');
                break;

            case 'input_tel':
                $input = __('miscellaneous.menu.admin.questionnaire.questions.data.input.input_tel');
                break;

            case 'input_file':
                $input = __('miscellaneous.menu.admin.questionnaire.questions.data.input.input_file');
                break;

            case 'textarea':
                $input = __('miscellaneous.menu.admin.questionnaire.questions.data.input.textarea');
                break;

            default:
                $input = null;
                break;
        }

        switch ($this->multiple_answers_required) {
            case 1:
                $multiple_answers_required = __('miscellaneous.yes');
                break;

            case 0:
                $multiple_answers_required = __('miscellaneous.no');
                break;

            default:
                $multiple_answers_required = null;
                break;
        }

        switch ($this->measurment_units_required) {
            case 1:
                $measurment_units_required = __('miscellaneous.yes');
                break;

            case 0:
                $measurment_units_required = __('miscellaneous.no');
                break;

            default:
                $measurment_units_required = null;
                break;
        }

        return [
            'id' => $this->id,
            'question_content' => $this->question_content,
            'question_content_fr' => $this->getTranslation('question_content', 'fr'),
            'question_content_en' => $this->getTranslation('question_content', 'en'),
            'question_description' => $this->question_description,
            'question_description_fr' => $this->getTranslation('question_description', 'fr'),
            'question_description_en' => $this->getTranslation('question_description', 'en'),
            'multiple_answers_required' => $this->multiple_answers_required,
            'readable_multiple_answers_required' => $multiple_answers_required,
            'input' => $this->input,
            'readable_input' => $input,
            'word_limit' => $this->word_limit,
            'character_limit' => $this->character_limit,
            'belongs_to' => $this->belongs_to,
            'linked_assertion' => $this->linked_assertion,
            'measurment_units_required' => $this->measurment_units_required,
            'readable_measurment_units_required' => $measurment_units_required,
            'question_part' => QuestionPart::make($this->question_part),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'question_part_id' => $this->question_part_id
        ];
    }
}
