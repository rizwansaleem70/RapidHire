<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileHeaderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'application_id' => $this->applicant->id,
            'name' => $this->first_name.$this->last_name,
            'email' => $this->email,
            'address' => $this->address,
            'ATS_source' => 0,
            'BPO_experience' => 0,
            'hiring_chance' => 0,
            'avatar' => $this->avatar,
            'country' => $this->country->name,
            'state' => isset($this->state->name),
            'city' => isset($this->city->name),
        ];
    }
}
