<?php

namespace App\Contracts\Tenants\Users;

/**
* @var Tenants/Users/UserAuthContract
*/
interface UserAuthContract
{
    public function register($input);
    public function login($input);
}
