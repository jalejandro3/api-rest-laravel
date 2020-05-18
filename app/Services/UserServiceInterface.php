<?php

namespace App\Services;

interface UserServiceInterface
{
    /**
     * Return User Data by JWT string
     *
     * @param string $jwt
     * @return array
     */
    public function getUserData(string $jwt): array;
}
