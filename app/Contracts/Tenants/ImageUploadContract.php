<?php

namespace App\Contracts\Tenants;

/**
* @var ImageUploadContract
*/
interface ImageUploadContract
{
    public function store($data);
}
