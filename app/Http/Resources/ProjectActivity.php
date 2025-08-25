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
            'is_land_owner_agriculture' => $this->is_land_owner_agriculture,
            'land_area_agriculture' => $this->land_area_agriculture,
            'land_yield_per_hectare' => $this->land_yield_per_hectare,
            'agriculture_type' => $this->agriculture_type,
            'agriculture_type_production_content' => $this->agriculture_type_production_content,
            'agriculture_type_transformation_content' => $this->agriculture_type_transformation_content,
            'agriculture_type_transformation_period' => $this->agriculture_type_transformation_period,
            'agriculture_type_transformation_quantity' => $this->agriculture_type_transformation_quantity,
            'agriculture_type_inputs_content' => $this->agriculture_type_inputs_content,
            'agriculture_type_equipment_content' => $this->agriculture_type_equipment_content,
            'is_land_owner_breeding' => $this->is_land_owner_breeding,
            'land_area_breeding' => $this->land_area_breeding,
            'breeding_type' => $this->breeding_type,
            'breeding_type_fish_content' => $this->breeding_type_fish_content,
            'breeding_type_fish_pond_capacity' => $this->breeding_type_fish_pond_capacity,
            'breeding_type_fish_cage_capacity' => $this->breeding_type_fish_cage_capacity,
            'breeding_type_fish_bin_capacity' => $this->breeding_type_fish_bin_capacity,
            'breeding_type_poultry_content' => $this->breeding_type_poultry_content,
            'breeding_type_poultry_total_number' => $this->breeding_type_poultry_total_number,
            'breeding_type_pig_content' => $this->breeding_type_pig_content,
            'breeding_type_pig_total_number' => $this->breeding_type_pig_total_number,
            'breeding_type_rabbit_content' => $this->breeding_type_rabbit_content,
            'breeding_type_rabbit_total_number' => $this->breeding_type_rabbit_total_number,
            'breeding_type_cattle_content' => $this->breeding_type_cattle_content,
            'breeding_type_cattle_total_number' => $this->breeding_type_cattle_total_number,
            'breeding_type_cattle_kind' => $this->breeding_type_cattle_kind,
            'breeding_type_sheep_content' => $this->breeding_type_sheep_content,
            'breeding_type_sheep_total_number' => $this->breeding_type_sheep_total_number,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'project_id' => $this->project_id
        ];
    }
}
