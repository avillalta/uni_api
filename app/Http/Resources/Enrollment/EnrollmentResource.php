<?php

namespace App\Http\Resources\Enrollment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'enrollment_date' => $this->enrollment_date,
            'course' => [
                'id' => $this->course_id,
                'name' => $this->course->name,
            ],
            'signature' => [
                'id' => $this->course->signature->signature_id,
                'name' => $this->course->signature->name,
            ],
            'semester' => [
                'id' => $this->course->semesters->first()->id,
                'start_date' => $this->course->semesters->first()->start_date,
                'end_date' => $this->course->semesters->first()->end_date,
            ],
            'student' => [
                'id' => $this->student_id,
                'name' => $this->student->name,
            ],
        ];
    }
}
