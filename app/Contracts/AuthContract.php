<?php

namespace App\Contracts;

/**
 * @var AuthContract
 */
interface AuthContract
{
    public function register($input);
    public function login($input);
    public function forgot($input);
}
