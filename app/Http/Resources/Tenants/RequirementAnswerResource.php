<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequirementAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'question' =>$this->requirement->name,
            'answer' =>$this->answer,
        ];
    }
}
