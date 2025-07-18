<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class ProjectSector extends JsonResource
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
            'sector_name' => $this->sector_name,
            'sector_name_fr' => $this->getTranslation('sector_name', 'fr'),
            'sector_name_en' => $this->getTranslation('sector_name', 'en'),
            'sector_description' => $this->sector_description,
            'sector_description_fr' => $this->getTranslation('sector_description', 'fr'),
            'sector_description_en' => $this->getTranslation('sector_description', 'en'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by
        ];
    }
}
