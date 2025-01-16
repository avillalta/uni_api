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
            'course_id' => ['required', 'exists:courses,id'],
            'student_id' => ['required', 'exists:users,id', new RoleValidation('student')],
            'enrollment_date' => ['required', 'date', 'before_or_equal:today']
        ];
    }

     /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'course_id.required' => 'The course field is required.',
            'course_id.exists' => 'The selected course does not exist.',
            'student_id.required' => 'The student field is required.',
            'student_id.exists' => 'The selected student does not exist.',
            'enrollment_date.required' => 'The enrollment date is required.',
            'enrollment_date.date' => 'The enrollment date must be a valid date.',
            'enrollment_date.before_or_equal' => 'The enrollment date cannot be in the future.',
        ];
    }
}
