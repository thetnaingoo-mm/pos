<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'unit_id' => $this->unit_id,
            'name' => $this->name,
            'code' => $this->code,
            'barcode' => $this->barcode,
            'description' => $this->when($request->routeIs('products.show'), $this->description),
            'purchase_price' => $this->purchase_price,
            'sale_price' => $this->sale_price,
            'is_active' => $this->is_active,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'brand' => BrandResource::make($this->whenLoaded('brand')),
            'unit' => UnitResource::make($this->whenLoaded('unit')),
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
    }
}
