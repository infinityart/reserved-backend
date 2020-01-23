<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'startTime' => $this->ScheduledAt->format('d-m-Y H:i'),
            'endTime' => $this->endTime->format('H:i')
        ];
    }
}