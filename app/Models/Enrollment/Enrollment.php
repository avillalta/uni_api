<?php

namespace App\Models\Enrollment;

use App\Models\Course\Course;
use App\Models\Evaluation\Evaluation;
use App\Models\Signature\Signature;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'enrollment_date',
        'course_id',
        'student_id'
    ];

    protected $casts = [
        'enrollment_date' => 'date',
    ];

    /**
     * Get the signature associated with the enrollment.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get the student associated with the enrollment.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'enrollment_id');
    }
}
