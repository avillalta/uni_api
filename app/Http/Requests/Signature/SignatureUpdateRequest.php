<?php

namespace App\Http\Requests\Signature;

use App\Rules\RoleValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignatureUpdateRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:255'],
            'units' => ['sometimes', 'array'],
            'schedule' => ['sometimes', 'array'],
            'semester_id' => ['sometimes', 'exists:semesters,id'],
            'professor_id' => ['sometimes', 'exists:users,id', new RoleValidation('professor')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.sometimes' => 'The :attribute field is optional, but if provided, it must be a string.',
            'name.string' => 'The :attribute must be a string.',
            'name.max' => 'The :attribute may not be greater than 255 characters.',
            
            'units.sometimes' => 'The :attribute field is optional, but if provided, it must be a valid JSON format.',
            'units.json' => 'The :attribute must be a valid JSON.',
            
            'schedule.sometimes' => 'The :attribute field is optional, but if provided, it must be a valid JSON format.',
            'schedule.json' => 'The :attribute must be a valid JSON.',
            
            'semester_id.sometimes' => 'The :attribute field is optional, but if provided, it must be a valid semester ID.',
            'semester_id.exists' => 'The selected :attribute is invalid.',
            
            'professor_id.sometimes' => 'The :attribute field is optional, but if provided, it must be a valid user ID with a professor role.',
            'professor_id.exists' => 'The selected :attribute is invalid.',
            'professor_id.professor' => 'The :attribute must be assigned to a professor role.',
        ];
    }

}
