<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductSpecsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'key' => $this->keywords,
            'value' => $this->keywords_value,
        ];
    }
}
