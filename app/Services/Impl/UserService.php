<?php

namespace App\Services\Impl;

use App\Services\UserServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * @inheritDoc
     */
    public function getUserData(string $jwt): object
    {
        $user = jwt_decode_token($jwt);

        return $user->data;
    }
}
