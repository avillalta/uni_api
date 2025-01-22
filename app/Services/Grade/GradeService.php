<?php

namespace App\Services\Grade;

use App\Models\Course\Course;
use App\Models\Grade\Grade;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use PhpParser\Node\Expr\FuncCall;

class GradeService{

    /**
     * get all grades.
     *
     * @param
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Grade[]
     */
    public function getAllGrades() {
        return Grade::all();
    }

     /**
     * Create new grade.
     *
     * @param array $data
     * @return \App\Models\Grade
     */
    public function saveGrade(array $data) {

        return DB::transaction(function() use ($data){
            return Grade::create([
                'schedule' => $data['schedule'],
                'weighting' => $data['weighting'],
                'signature_id' => $data['signature_id'],
                'semester_id' => $data['semester_id'],
            ]);
        });
    }

    /**
     * Get grade by id.
     *
     * @param $data
     * @return \App\Models\Grade
     */
    public function showGrade($data)
    {
        $result = Grade::findOrFail($data["grade_id"]);
        return $result;
    }

     /**
     * Update grade.
     *
     * @param array $data
     * @return \App\Models\Grade
     */
    public function updateGrade(array $data, $id) {

        $grade = Grade::findOrFail($id);

        return DB::transaction(function() use ($grade, $data){
            $updates =  [
                'schedule' => $data['schedule'] ?? $grade->schedule,
                'weighting' => $data['weighting'] ?? $grade->weighting,
                'signature_id' => $data['signature_id'] ?? $grade->signature_id,
                'semester_id' => $data['semester_id'] ?? $grade->semester_id,
            ];
            $grade->update($updates);
            return $grade;
        });
    }

    public function deleteGrade($id)
    {
        DB::transaction(function() use ($id) {
            $grade = Grade::findOrFail($id);
            $grade->delete();
        });
    }

}