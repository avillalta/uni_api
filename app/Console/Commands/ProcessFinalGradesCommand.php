<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Jobs\CalculateFinalGradeJob;
use App\Models\Enrollment\Enrollment;
use App\Models\Semester\Semester;
use Illuminate\Console\Command;

class ProcessFinalGradesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-final-grades-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch jobs to calculate final grades for enrollments in the current semester.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Obtener el semestre actual (donde end_date es hoy)
        $semester = Semester::where('end_date', today())->first();

        if (!$semester) {
            $this->info('No current semester found (end_date is not today).');
            return;
        }

        $this->info("Initiating: The process of calculating final grades for semester {$semester->id}...");

        // Obtener el número total de enrollments en el semestre actual
        $totalEnrollmentRecords = $semester->enrollments()->count();

        if ($totalEnrollmentRecords > 0) {
            $this->info("Dispatching jobs for {$totalEnrollmentRecords} enrollments...");
            Helper::dispatchJobHelper($this, CalculateFinalGradeJob::class, Enrollment::class, $totalEnrollmentRecords, 100); // batchSize = 100
        } else {
            $this->info('No enrollments require final grade calculation.');
        }

        $this->info('Completed: Final Grade Calculation Process.');
    }
}
