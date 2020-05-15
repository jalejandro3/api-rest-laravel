<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    /**
     * Method to store a user
     *
     * @param array $data User data array
     * @return bool
     */
    public function create(array $data): bool;
}
