<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class ProjectActivity extends JsonResource
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
            'is_land_owner' => $this->is_land_owner,
            'land_area' => $this->land_area,
            'land_yield_per_hectare' => $this->land_yield_per_hectare,
            'agriculture_type' => $this->agriculture_type,
            'agriculture_type_content' => $this->agriculture_type_content,
            'agriculture_type_content_period' => $this->agriculture_type_content_period,
            'agriculture_type_content_quantity' => $this->agriculture_type_content_quantity,
            'breeding_type' => $this->breeding_type,
            'breeding_type_content' => $this->breeding_type_content,
            'breeding_type_fish_pond_capacity' => $this->breeding_type_fish_pond_capacity,
            'breeding_type_fish_cage_capacity' => $this->breeding_type_fish_cage_capacity,
            'breeding_type_fish_bin_capacity' => $this->breeding_type_fish_bin_capacity,
            'breeding_type_animals_total_number' => $this->breeding_type_animals_total_number,
            'breeding_type_cattle_kind' => $this->breeding_type_cattle_kind,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'project_id' => $this->project_id
        ];
    }
}
