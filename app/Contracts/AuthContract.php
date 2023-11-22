<?php

namespace App\Contracts;

/**
 * @var AuthContract
 */
interface AuthContract
{
    public function register($input);
    public function login($input);
    public function logout($id);
    public function forgot($input);
    public function changePassword($input,$user_id);
    public function deleteProfile($input,$user_id);
    public function favoriteJob();
    public function dashboardAuthenticate($id);
}
