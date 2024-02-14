<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Department extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $question = collect($this->questionBanks)->map(function ($question) {
            $question_bank['id'] = $question['id'];
            $question_bank['input_type'] = $question['input_type'];
            $question_bank['question'] = $question['question'];
            $question_bank['is_active'] = $question['is_active'];
            return $question_bank;
        });
        return [
            'id' => $this->id,
            'name' => $this->name,
            'question' => $question,
        ];
    }
}
