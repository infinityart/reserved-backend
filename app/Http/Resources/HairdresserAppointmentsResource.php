<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HairdresserAppointmentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->Name,
            'appointments' => [
                AppointmentResource::collection($this->appointments)
            ]
        ];
    }
}
