<?php

namespace App\Jobs;

use App\Models\Enrollment\Enrollment;
use App\Models\Semester\Semester;
use App\Services\Enrollment\FinalGradeService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CalculateFinalGradeJob implements ShouldQueue
{
    use Dispatchable , InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $model, public int $offset, public int $limit)
    {
    }

    public function handle(FinalGradeService $finalGradeService): void
    {
        $records = Enrollment::where('semester_id', $this->model)
            ->offset($this->offset)
            ->limit($this->limit)
            ->get();

        foreach ($records as $enrollment) {
            $finalGradeService->calculateFinalGrade($enrollment);
        }
    }
}
