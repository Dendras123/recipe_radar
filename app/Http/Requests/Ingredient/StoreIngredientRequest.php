<?php

namespace App\Http\Ingredient\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIngredientRequest extends FormRequest
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
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string|min:1|max:255',
            'ingredients.*.quantity' => 'nullable|integer',
            'ingredients.*.weight' => 'nullable|numeric',
            'ingredients.*.calories' => 'nullable|numeric',
            'ingredients.*.protein' => 'nullable|numeric',
            'ingredients.*.carbs' => 'nullable|numeric',
            'ingredients.*.sugar' => 'nullable|numeric',
            'ingredients.*.fiber' => 'nullable|numeric',
            'ingredients.*.fat' => 'nullable|numeric',
            'ingredients.*.expires_at' => 'nullable|date|after:now',
        ];
    }
}
