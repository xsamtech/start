<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class Payment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reference' => $this->reference,
            'provider_reference' => $this->provider_reference,
            'order_number' => $this->order_number,
            'amount' => $this->amount,
            'amount_customer' => $this->amount_customer,
            'phone' => $this->phone,
            'currency' => $this->currency,
            'channel' => $this->channel,
            'type' => $this->type,
            'status' => $this->status,
            'cart' => Cart::make($this->cart),
            'created_at' => timeAgo($this->created_at->format('Y-m-d H:i:s')),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'cart_id' => $this->cart_id
        ];
    }
}
