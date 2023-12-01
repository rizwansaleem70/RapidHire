<?php

namespace App\Models\Tenants;

use App\Helpers\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;
    public function scopeSkipRole($query)
    {
        return $query->whereNotIn('id', [Constant::SUPER_ADMIN_ID, Constant::ADMIN_ID, Constant::TENANT_ID, Constant::SUB_ADMIN_ID]);
    }
    public function scopeOnlyReadableRole($query)
    {
        return $query->whereIn('id', [Constant::SUPER_ADMIN_ID, Constant::ADMIN_ID, Constant::TENANT_ID, Constant::SUB_ADMIN_ID]);
    }
}
