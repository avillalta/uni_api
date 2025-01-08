<?php

namespace App\Http\Requests\Signature;

use App\Rules\RoleValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignatureStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'units' => ['nullable', 'array'],
            'schedule' => ['nullable', 'array'],
            'semester_id' => ['nullable', 'exists:semesters,id'],
            'professor_id' => ['nullable', 'exists:users,id', new RoleValidation('professor')],
        ];
    }
}
