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
    public function changePassword($input);
    public function deleteProfile($input);
    public function favoriteJob();
}
