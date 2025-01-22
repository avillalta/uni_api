<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class CourseStoreRequest extends FormRequest
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
            'schedule' => ['nullable', 'array'],
            'weighting' => ['required', 'array', 'size:3'], // Must be an array with 3 elements
            'weighting.homework' => ['required', 'numeric', 'min:0', 'max:1'],
            'weighting.midterms' => ['required', 'numeric', 'min:0', 'max:1'],
            'weighting.final_exam' => ['required', 'numeric', 'min:0', 'max:1'],
            'weighting.*' => function ($attribute, $value, $fail) {
                if (array_sum(request('weighting')) !== 1) {
                    $fail('The weighting values must add up to 1.');
                }
            },
            'signature_id' => ['required', 'uuid', 'exists:signatures,id'],
            'semester_id' => ['required', 'uuid', 'exists:semesters,id'],
        ];
    }

     /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'schedule.array' => 'The :attribute field must be an array.',

            'weighting.required' => 'The :attribute field is required.',
            'weighting.array' => 'The :attribute field must be an array.',
            'weighting.size' => 'The :attribute array must contain exactly 3 elements.',
            'weighting.*.required' => 'The :attribute weighting is required.',
            'weighting.*.numeric' => 'The :attribute weighting must be a numeric value.',
            'weighting.*.min' => 'The :attribute weighting must be at least :min.',
            'weighting.*.max' => 'The :attribute weighting must not exceed :max.',

            'signature_id.required' => 'The :attribute field is required.',
            'signature_id.exists' => 'The :attribute signature does not exist.',

            'semester_id.required' => 'The :attribute field is required.',
            'semester_id.exists' => 'The :attribute semester does not exist.',
        ];
    }
}
