<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLocationRequest extends FormRequest
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
        $location = $this->route('location');

        return [
            'name' => ['sometimes', 'required', 'string', 'max:100'],
            'code' => ['sometimes', 'nullable', 'string', 'max:50', Rule::unique('locations', 'code')->ignore($location)],
            'address' => ['sometimes', 'nullable', 'string'],
            'phone' => ['sometimes', 'nullable', 'string', 'max:30'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
