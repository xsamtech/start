<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_name' => $this->category_name,
            'category_name_fr' => $this->getTranslation('category_name', 'fr'),
            'category_name_en' => $this->getTranslation('category_name', 'en'),
            'category_description' => $this->category_description,
            'category_description_fr' => $this->getTranslation('category_description', 'fr'),
            'category_description_en' => $this->getTranslation('category_description', 'en'),
            'for_service' => $this->for_service,
            'alias' => $this->alias,
            'image_url' => $this->image_url != null ? $this->image_url : getWebURL() . '/assets/img/undefined.png',
            'project_sector' => ProjectSector::make($this->project_sector),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'project_sector_id' => $this->project_sector_id
        ];
    }
}
