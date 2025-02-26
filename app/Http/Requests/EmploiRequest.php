<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmploiRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'departement_id' => 'required|exists:departements,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de l\'emploi est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'departement_id.required' => 'Le département est obligatoire.',
            'departement_id.exists' => 'Le département sélectionné est invalide.',
        ];
    }
}
