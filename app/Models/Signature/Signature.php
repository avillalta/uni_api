<?php

namespace App\Models\Signature;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Semester\Semester;
use App\Models\User\User;

class Signature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'units',
        'schedule',
        'semester_id',
        'professor_id'
    ];

    protected $casts = [
        'units' => 'array',
        'schedule' => 'array'
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }
}
