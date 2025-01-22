<?php

namespace App\Http\Requests\Enrollment;

use App\Rules\RoleValidation;
use Illuminate\Foundation\Http\FormRequest;

class EnrollmentStoreRequest extends FormRequest
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
            'course_id' => ['required', 'uuid', 'exists:courses,id'],
            'student_id' => ['required', 'uuid', 'exists:users,id', new RoleValidation('student')],
            'enrollment_date' => ['required', 'date', 'before_or_equal:today']
        ];
    }

     /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'course_id.required' => 'The :attribute field is required.',
            'course_id.exists' => 'The selected :attribute does not exist.',
            'student_id.required' => 'The :attribute field is required.',
            'student_id.exists' => 'The selected :attribute does not exist.',
            'enrollment_date.required' => 'The :attribute is required.',
            'enrollment_date.date' => 'The :attribute must be a valid date.',
            'enrollment_date.before_or_equal' => 'The :attribute cannot be in the future.',
        ];
    }
}
