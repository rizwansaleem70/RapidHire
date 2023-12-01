<?php

namespace App\Http\Resources\Tenants;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantSlotsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user_id = $this->userSlot ? $this->userSlot->user_id : null;
        return [
            'id' => $this->id,
            'start_time' => Helper::timeFormat($this->start_time),
            'end_time' => Helper::timeFormat($this->end_time),
            'status' => $this->status,
            'booked_user_id' => $user_id
        ];
    }
}
