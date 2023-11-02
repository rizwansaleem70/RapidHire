<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->test_ids) {
            return [
                'id' => $this->id,
                'name' => $this->name,
                "is_selected" => in_array($this->id, $request->test_ids) ? true : false
            ];
        } else {
            return [
                'id' => $this->id,
                'name' => $this->name,
            ];
        }
    }
}
