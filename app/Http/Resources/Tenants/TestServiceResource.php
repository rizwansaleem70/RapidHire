<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestServiceResource extends JsonResource
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
            'name' => $this->name,
            'base_url' => $this->base_url,
            'api_key' => $this->api_key,
            'secret_key' => $this->secret_key,
            'is_active' => $this->is_active,
            "tests" => new TestResourceCollection($this->tests)
        ];
    }
}
