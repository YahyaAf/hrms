<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'date_de_recrutement' => 'nullable|date',
            'password' => 'required|string|min:8|confirmed',
            'telephone' => 'nullable|string|max:20',
            'date_naissance' => 'nullable|date',
            'adresse' => 'nullable|string|max:500',
            'salaire' => 'nullable|numeric|min:0',
            'statut' => 'nullable|string|max:50',
            'contract_id' => 'nullable|exists:contracts,id',
            'departement_id' => 'nullable|exists:departements,id',
            'emploi_id' => 'nullable|exists:emplois,id',
            'grade_id' => 'nullable|exists:grades,id',
        ];
    }
}
