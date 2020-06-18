<?php

namespace App\Services;

use App\Exceptions\ApplicationException;
use App\Exceptions\ResourceNotFoundException;

interface AuthService
{
    /**
     * Method to login a user
     *
     * @param string $email User email
     * @param string $password User password
     * @return array
     * @throws ResourceNotFoundException
     * @throws ApplicationException
     */
    public function login(string $email, string $password): array;
}
