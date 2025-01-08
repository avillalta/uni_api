<?php

namespace App\Http\Resources\Signature;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SignatureResource extends JsonResource
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
            'name' => $this->name,
            'units' => $this->units,
            'schedule' => $this->schedule,
            'semester_id' => $this->semester?->name,
            'professor_id' => $this->professor?->name
        ];
    }
}
