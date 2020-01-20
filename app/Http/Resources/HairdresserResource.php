<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HairdresserResource extends JsonResource
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
            'id' => $this->ID,
            'name' => $this->Name,
            'avatarURL' => $this->AvatarURL
        ];
    }
}
