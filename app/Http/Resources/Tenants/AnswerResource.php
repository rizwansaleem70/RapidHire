<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
        'requirement' => new RequirementAnswerResourceCollection($this['requirementAnswer']),
        'question' => new QuestionAnswerResourceCollection($this['questionAnswer']),
    ];
    }
}
