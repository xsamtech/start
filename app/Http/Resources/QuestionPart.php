<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class QuestionPart extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array
    {
        $is_first_step = null;
        $is_last_step = null;

        switch ($this->is_first_step) {
            case 1:
                $is_first_step = __('miscellaneous.yes');
                break;

            case 0:
                $is_first_step = __('miscellaneous.no');
                break;

            default:
                $is_first_step = __('miscellaneous.no');
                break;
        }

        switch ($this->is_last_step) {
            case 1:
                $is_last_step = __('miscellaneous.yes');
                break;

            case 0:
                $is_last_step = __('miscellaneous.no');
                break;

            default:
                $is_last_step = __('miscellaneous.no');
                break;
        }

        return [
            'id' => $this->id,
            'part_name' => $this->part_name,
            'part_name_fr' => $this->getTranslation('part_name', 'fr'),
            'part_name_en' => $this->getTranslation('part_name', 'en'),
            'part_description' => $this->part_description,
            'part_description_fr' => $this->getTranslation('part_description', 'fr'),
            'part_description_en' => $this->getTranslation('part_description', 'en'),
            'is_first_step' => $this->is_first_step,
            'readable_is_first_step' => $is_first_step,
            'is_last_step' => $this->is_last_step,
            'readable_is_last_step' => $is_last_step,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
