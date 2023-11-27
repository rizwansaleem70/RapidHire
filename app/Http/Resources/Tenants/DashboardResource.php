<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'totalJobs' => $this['totalJobs'],
            'activeTotalJobs' => $this['activeTotalJobs'],
            'totalApplicant' => $this['totalApplicant'],
            'totalHired' => $this['totalHired'],
            'totalRejected' => $this['totalRejected'],
            'totalMember' => $this['totalMember'],
            'notifications' => new NotificationResourceCollection($this['notifications']),
        ];
    }
}
