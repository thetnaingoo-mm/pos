<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:100'],
            'code' => ['nullable', 'string', 'max:50', Rule::unique('categories', 'code')],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'name.required' => 'The category name is required.',
    //         'name.max' => 'The category name must not exceed 100 characters.',
    //         'code.max' => 'The code must not exceed 50 characters.',
    //         'code.unique' => 'This code is already used for another category.',
    //         'is_active.boolean' => 'The active status must be true or false.',
    //     ];
    // }
}
