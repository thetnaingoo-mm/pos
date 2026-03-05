<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'category_id' => ['sometimes', 'nullable', 'integer', 'exists:categories,id'],
            'brand_id' => ['sometimes', 'nullable', 'integer', 'exists:brands,id'],
            'unit_id' => ['sometimes', 'nullable', 'integer', 'exists:units,id'],
            'name' => ['sometimes', 'required', 'string', 'max:150'],
            'code' => ['sometimes', 'required', 'string', 'max:50', Rule::unique('products', 'code')->ignore($product)],
            'barcode' => ['sometimes', 'nullable', 'string', 'max:100', Rule::unique('products', 'barcode')->ignore($product)],
            'description' => ['sometimes', 'nullable', 'string'],
            'purchase_price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'sale_price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
