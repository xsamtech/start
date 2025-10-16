<?php

namespace App\Http\Resources;

use App\Models\Product as ModelsProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class CustomerFeedback extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array
    {
        $product = !empty($this->for_product_id) ? ModelsProduct::find($this->for_product_id) : null;

        return [
            'id' => $this->id,
            'for_user_id' => $this->for_user_id,
            'for_product_id' => $this->for_product_id,
            'for_product' => $product,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'user' => User::make($this->user),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'created_at_explicit' => explicitDate($this->created_at->format('Y-m-d H:i:s')),
            'updated_at_explicit' => explicitDate($this->updated_at->format('Y-m-d H:i:s')),
            'user_id' => $this->user_id
        ];
    }
}
