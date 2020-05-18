<?php

namespace App\Services\Impl;

use App\Services\UserServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * @inheritDoc
     */
    public function getUserData(string $jwt): array
    {
        return (array)jwt_decode_token($jwt);
    }
}
