<?php

namespace App\Models\Tenants;

use App\Helpers\Constant;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use QCod\Settings\Setting\Setting as QcodeSetting;

class Setting extends QcodeSetting
{
    use HasFactory;
    public static function getValue($groupName, $key)
    {
        return settings()->group($groupName)->get($key);
    }
}
