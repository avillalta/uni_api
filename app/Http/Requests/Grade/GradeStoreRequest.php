<?php

namespace App\Http\Requests\Grade;

use Illuminate\Foundation\Http\FormRequest;

class GradeStoreRequest extends FormRequest
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
            'grade_type' => ['required', 'string', 'in:ordinary,extraordinary,work,partial,final'],
            'grade_value' => ['nullable', 'numeric', 'min:0', 'max:10'],
            'grade_date' => ['required', 'date'],
            'enrollment_id' => ['required', 'uuid', 'exists:enrollments,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'grade_type.required' => 'The :attribute is required.',
            'grade_type.in' => 'The :attribute must be one of the following: ordinary, extraordinary, work, partial, final.',
            'grade_value.numeric' => 'The :attribute must be a valid number.',
            'grade_value.min' => 'The :attribute cannot be less than 0.',
            'grade_value.max' => 'The :attribute cannot exceed 10.',
            'grade_date.required' => 'The :attribute is required.',
            'grade_date.date' => 'The :attribute must be a valid date.',
            'enrollment_id.required' => 'The enrollment ID is required.',
            'enrollment_id.exists' => 'The provided enrollment ID does not exist.',
        ];
    }
}
