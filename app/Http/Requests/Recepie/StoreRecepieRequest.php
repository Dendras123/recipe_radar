<?php

namespace App\Http\Requests\Recepie;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecepieRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:50000',
            'prep_time' => 'nullable|numeric|min:0',
            'ingredient_types' => 'required|min:1|array',
            'ingredient_types.*' => 'required|exists:ingredient_types,id',
        ];
    }
}
