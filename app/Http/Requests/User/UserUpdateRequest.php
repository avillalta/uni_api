<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User\User;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $userId = $this->route('id');
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId)],//ignore($this->user()->id)
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique("users")->ignore($userId)], // Permitir el correo electrónico actual
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], // Si el campo de contraseña es nulo, no se valida
            'phone_number' => ['nullable', 'string', 'max:20', 'regex:/^\+?[1-9]\d{1,14}$/'],
            'document' => ['nullable', 'string', 'max:15', Rule::unique('users')->ignore($userId)], // Permitir el documento actual
            'city' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'address' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'country_id' => ['nullable', 'exists:countries,id'],

            'role' => ['nullable', 'string', 'in:admin,professor,student'],
        ];
    }
}
