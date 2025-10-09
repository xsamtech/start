<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class QuestionAssertion extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array
    {
        $belongs_to_required = null;

        switch ($this->belongs_to_required) {
            case 1:
                $belongs_to_required = __('miscellaneous.yes');
                break;

            case 0:
                $belongs_to_required = __('miscellaneous.no');
                break;

            default:
                $belongs_to_required = null;
                break;
        }

        return [
            'id' => $this->id,
            'assertion_content' => $this->assertion_content,
            'assertion_content_fr' => $this->getTranslation('assertion_content', 'fr'),
            'assertion_content_en' => $this->getTranslation('assertion_content', 'en'),
            'belongs_to_required' => $this->belongs_to_required,
            'readable_belongs_to_required' => $belongs_to_required,
            'project_question' => ProjectQuestion::make($this->project_question),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'project_question_id' => $this->project_question_id
        ];
    }
}
