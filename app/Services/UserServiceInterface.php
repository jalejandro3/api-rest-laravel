<?php

namespace App\Services;

interface UserServiceInterface
{
    /**
     * Method to login a user
     *
     * @param string $user
     * @param string $password
     * @return mixed
     */
    public function login(string $user, string $password);
}
