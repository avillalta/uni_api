<?php

namespace App\Http\Requests\Semester;

use App\Data\Semester\SemesterCalendarData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class SemesterUpdateRequest extends FormRequest
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
        $semester = $this->route('semester');
        if (is_numeric($semester)) {
        $semester = \App\Models\Semester\Semester::find($semester);
        }
        $startDate = $semester ? $semester->start_date : null;
        $endDate = $semester ? $semester->end_date : null;

        return [
            'name' => ['sometimes','string', 'max:255', Rule::unique('semesters')->ignore($this->semester)],
            'start_date' => ['sometimes', 'date', 'before:' . ($endDate ?? 'end_date')],
            'end_date' => ['sometimes', 'date', 'after:' . ($startDate ?? 'start_date')],
            'calendar' => ['nullable', 'array']
        ];
    }

    /**
     * Transform the validated data into a structured format using DTO
     *
     * @return array
     */
    public function validatedData(): array
    {
        $validated = $this->validated();
        $validated['calendar'] = isset($validated['calendar'])
            ? SemesterCalendarData::fromArray($validated['calendar'], true)
            : new SemesterCalendarData();

        return $validated;
    }
}
