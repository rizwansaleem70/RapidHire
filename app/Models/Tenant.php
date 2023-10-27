<?php

namespace App\Models;

use App\Traits\SoftDeleteColumnValuesUpdate;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, HasRoles, HasPermissions,SoftDeletes;

//    protected $guard_name = 'web';

    public static function getCustomColumns(): array
    {
        return [
            'id','package_id','first_name','last_name','email','phone','password','bank_name','account_number','latitude','longitude','address','logo','about','website','industry','company_size','headquarter','is_verified','is_actively_recruiting','data'
        ];
    }
//    protected $fillable= ['package_id','name','email','phone','bank_name','account_number','latitude','longitude','address','logo','about','website','industry','company_size','headquarter','is_verified','is_actively_recruiting','data'];
}
