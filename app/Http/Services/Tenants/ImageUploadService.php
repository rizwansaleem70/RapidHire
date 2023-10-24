<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\ImageUploadContract;
use App\Traits\ImageUpload;

/**
* @var ImageUploadService
*/
class ImageUploadService implements ImageUploadContract
{
    use ImageUpload;
    public function store($data)
    {
        if (isset($data['image']) && $data['image']) {
            $image_path = $this->upload($data['image']);
            return $image_path;
        }
    }
}
