<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormationRequest extends FormRequest
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
            'type' => 'required|in:distance,presentiel', 
            'competence' => 'required|string', 
            'users' => 'required|array', 
            'users.*' => 'exists:users,id', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de la formation est requis.',
            'type.required' => 'Le type de formation est requis.',
            'competence.required' => 'La compétence est requise.',
            'users.required' => 'Vous devez sélectionner au moins un utilisateur.',
            'users.*.exists' => 'Certains utilisateurs sélectionnés n\'existent pas.',
        ];
    }
}
