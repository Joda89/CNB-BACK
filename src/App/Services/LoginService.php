<?php

namespace App\Services;

class LoginService extends BaseService
{

    public function validateCredentials($user, $pass)
    {
        return $user == $pass;
    }
    public function validateToken($token)
    {
        return $token == 'a';
    }
    public function getNewTokenForUser($user)
    {
        return 'a';
    }
    
}
