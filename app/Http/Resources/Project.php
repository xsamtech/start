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
            'creation_year' => $this->creation_year,
            'company_address' => $this->company_address,
            'company_email' => $this->company_email,
            'company_phone' => $this->company_phone,
            'website_url' => $this->website_url,
            'is_tenant' => $this->is_tenant,
            'tenant_monthly_rental' => $this->tenant_monthly_rental,
            'is_owner' => $this->is_owner,
            'owner_title_deed_url' => !empty($this->owner_title_deed_url) ? getWebURL() . $this->owner_title_deed_url : null,
            'field_experience' => $this->field_experience,
            'employees_count' => $this->employees_count,
            'is_funded_by_self' => $this->is_funded_by_self,
            'is_funded_by_credit' => $this->is_funded_by_credit,
            'is_funded_by_grant' => $this->is_funded_by_grant,
            'other_funding_sources' => $this->other_funding_sources,
            'funding_amount' => $this->funding_amount,
            'annual_turnover' => $this->annual_turnover,
            'last_year_net_profit' => $this->last_year_net_profit,
            'last_year_net_loss' => $this->last_year_net_loss,
            'forecast_turnover' => $this->forecast_turnover,
            'business_model' => $this->business_model,
            'swot_analysis' => $this->swot_analysis,
            'sheet_url' => $this->sheet_url,
            'category' => Category::make($this->category),
            'user' => User::make($this->user),
            'project_activities' => ProjectActivity::collection($this->project_activities),
            'market_segments' => MarketSegment::collection($this->market_segments),
            'photos' => File::collection($this->photos),
            'videos' => File::collection($this->videos),
            'audios' => File::collection($this->audios),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'category_id' => $this->category_id,
            'user_id' => $this->user_id
        ];
    }
}
