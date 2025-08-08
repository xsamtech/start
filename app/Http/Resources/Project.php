<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class Project extends JsonResource
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
            'projects_description' => $this->projects_description,
            'company_name' => $this->company_name,
            'rccm' => $this->rccm,
            'id_nat' => $this->id_nat,
            'tax_number' => $this->tax_number,
            'company_id_document_url' => $this->company_id_document_url,
            'company_address' => $this->company_address,
            'company_email' => $this->company_email,
            'company_phone' => $this->company_phone,
            'website_url' => $this->website_url,
            'field_experience' => $this->field_experience,
            'activity_orientation' => $this->activity_orientation,
            'activity_orientation_content' => $this->activity_orientation_content,
            'processing_transformation_quantity' => $this->processing_transformation_quantity,
            'processing_transformation_period' => $this->processing_transformation_period,
            'market_segments_or_target' => $this->market_segments_or_target,
            'physical_and_land_organization' => $this->physical_and_land_organization,
            'physical_and_land_organization_size' => $this->physical_and_land_organization_size,
            'physical_and_land_organization_yield' => $this->physical_and_land_organization_yield,
            'land_status' => $this->land_status,
            'land_status_amount' => $this->land_status_amount,
            'land_status_property_deed_url' => $this->land_status_property_deed_url,
            'accounting_synthesis' => $this->accounting_synthesis,
            'accounting_synthesis_number_of_employees' => $this->accounting_synthesis_number_of_employees,
            'accounting_synthesis_turnover_value' => $this->accounting_synthesis_turnover_value,
            'strategic_synthesis' => $this->strategic_synthesis,
            'sheet_url' => $this->sheet_url,
            'user' => User::make($this->user),
            'category' => Category::make($this->category),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'category_id' => $this->category_id,
            'user_id' => $this->user_id
        ];
    }
}
