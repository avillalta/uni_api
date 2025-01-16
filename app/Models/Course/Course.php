<?php

namespace App\Models\Course;

use App\Models\Semester\Semester;
use App\Models\Signature\Signature;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'schedule',
        'weighting',
        'signature_id',
        'semester_id'
    ];

    protected $casts = [
        'schedule' => 'array',
        'weighting' => 'array'
    ];

    public function signature()
    {
        return $this->belongsTo(Signature::class, 'signature_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
