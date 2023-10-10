<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @method latest()
 * @method find($id)
 * @method where(string $string, mixed $name)
 */
class SocialMedia extends Model
{
    use HasFactory;

    public function getIconAttribute($value){
        return url(Storage::url($value));
    }
}
