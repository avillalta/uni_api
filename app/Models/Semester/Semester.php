<?php

namespace App\Models\Semester;

use App\Data\Semester\SemesterCalendarData;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'calendar'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'calendar' => 'array'
    ];

    public function getCalendarAttribute($value)
    {
        return SemesterCalendarData::fromArray($value ?? []);
    }

    public function setCalendarAttribute($value)
    {
        if ($value instanceof SemesterCalendarData) {
            $this->attributes['calendar'] = $value->toArray();
        } else {
            $this->attributes['calendar'] = $value;
        }
    }
}
