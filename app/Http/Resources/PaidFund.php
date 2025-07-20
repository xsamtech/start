<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class PaidFund extends JsonResource
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
            'user' => User::make($this->user),
            'amount' => $this->amount,
            'currency' => $currency,
            'convert_amount' => $this->convertAmount($currency),
            'has_successful_payment' => $this->hasSuccessfulPayment(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'crowdfunding_id' => $this->crowdfunding_id,
            'user_id' => $this->user_id
        ];
    }
}
