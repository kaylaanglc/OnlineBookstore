<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:250',
            'author' => 'required|string|min:3|max:250',
            'ISBN' => 'required|string|min:3|max:250',
            'price' => ['required', 'numeric', Rule::between(0, 9999999.99)],
            'image' => 'nullable|image|max:1024|mimes:jpg,jpeg,png',
        ];
    }
}
