<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sku' => $this->product_sku,
            'name' => $this->product_name,
            'description' => $this->product_description,
            'price' => $this->product_price,
            'photo' => $this->product_photo,
            'category' => [
                'id' => $this->category->id ?? null,
                'name' => $this->category->name ?? null,
            ],
            'shop' => [
                'id' => $this->shop->id ?? null,
                'name' => $this->shop->shop_name ?? null,
            ],
            'specs' => ProductSpecsResource::collection($this->whenLoaded('specs')),
        ];
    }
}
