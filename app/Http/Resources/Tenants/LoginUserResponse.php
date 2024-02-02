<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginUserResponse extends JsonResource
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
            'name' => $this->first_name . " " . $this->last_name,
            'email' => $this->email,
            'avatar' => $this->avatar ? asset($this->avatar) : "",
            'role' => isset($this->roles) ? new RoleResource($this->roles()->first()) : "",
        ];
    }
}
