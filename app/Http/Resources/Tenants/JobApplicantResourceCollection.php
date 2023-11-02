<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobApplicantResourceCollection extends ResourceCollection
{
    protected $extraData;

    public function __construct($resource, $extraData = [])
    {
        parent::__construct($resource);
        $this->extraData = $extraData;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'current_page' => $this->currentPage(),
            'data' => $this->collection,
            'totalApplicant' => $this->extraData['totalApplicant'],
            'totalQualification' => $this->extraData['totalQualification'],
            'totalTesting' => $this->extraData['totalTesting'],
            'totalInterview' => $this->extraData['totalInterview'],
            'totalOffer' => $this->extraData['totalOffer'],
            'totalRejected' => $this->extraData['totalRejected'],
            'totalWithdraw' => $this->extraData['totalWithdraw'],
            'from' => $this->firstItem(),
            'last_page' => $this->lastPage(),
            'per_page' => $this->perPage(),
            'to' => $this->lastItem(),
            'total' => $this->total(),
        ];
//        return [
//            'current_page' => $this->applicants->currentPage(),
//            'data' => $this->collection,
//            'from' => $this->applicants->firstItem(),
//            'last_page' => $this->applicants->lastPage(),
//            'per_page' => $this->applicants->perPage(),
//            'to' => $this->applicants->lastItem(),
//            'total' => $this->applicants->total(),
//        ];
    }
}
