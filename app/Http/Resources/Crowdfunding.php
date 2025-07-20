<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class Crowdfunding extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array
    {
        $currency = auth()->check() ? auth()->user()->currency : $this->currency;

        return [
            'id' => $this->id,
            'description' => $this->description,
            'expected_amount' => $this->expected_amount,
            'currency' => $currency,
            'financing_rate' => $this->financingRate($currency),
            'convert_expected_amount' => $this->convertExpectedAmount($currency),
            'total_paid' => $this->totalPaid($currency),
            'product' => Product::make($this->product),
            'user' => User::make($this->user),
            'paid_funds' => PaidFund::collection($this->paid_funds),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'product_id' => $this->product_id,
            'user_id' => $this->user_id
        ];
    }
}
