<?php

namespace App\Services\Signature;

use App\Models\Signature\Signature;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use PhpParser\Node\Expr\FuncCall;

class SignatureService{

    /**
     * get all signatures.
     *
     * @param
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Signature[]
     */
    public function getAllSignatures() {
        return Signature::all();
    }

     /**
     * Create new signature.
     *
     * @param array $data
     * @return \App\Models\Signature
     */
    public function saveSignature(array $data) {

        return DB::transaction(function() use ($data){
            return Signature::create([
                'name' => $data['name'],
                'units' => $data['units'],
                'schedule' => $data['schedule'],
                'semester_id' => $data['semester_id'],
                'professor_id' => $data['professor_id'],
            ]);
        });
    }

    /**
     * Get signature by id.
     *
     * @param $data
     * @return \App\Models\Signature
     */
    public function showSignature($data)
    {
        $result = Signature::findOrFail($data["signature_id"]);
        return $result;
    }

     /**
     * Update signature.
     *
     * @param array $data
     * @return \App\Models\Signature
     */
    public function updateSignature(array $data, $id) {

        $signature = Signature::findOrFail($id);

        return DB::transaction(function() use ($signature, $data){
            $updates =  [
                'name' => $data['name'] ?? $signature->name,
                'units' => $data['units'] ?? $signature->units,
                'schedule' => $data['schedule'] ?? $signature->schedule,
                'semester_id' => $data['semester_id'] ?? $signature->semester_id,
                'professor_id' => $data['professor_id'] ?? $signature->professor_id,
            ];
            $signature->update($updates);
            return $signature;
        });
    }

    public function deleteSignature($id)
    {
        DB::transaction(function() use ($id) {
            $signature = Signature::findOrFail($id);
            $signature->delete();
        });
    }

}