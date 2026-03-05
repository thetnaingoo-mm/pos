<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUnitRequest extends FormRequest
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
        $unit = $this->route('unit');

        return [
            'name' => ['sometimes', 'required', 'string', 'max:100', Rule::unique('units', 'name')->ignore($unit)],
            'short_name' => ['sometimes', 'required', 'string', 'max:20', Rule::unique('units', 'short_name')->ignore($unit)],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
