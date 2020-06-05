<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

interface UserRepository
{
    /**
     * Method to store a user
     *
     * @param array $data User data array
     * @return bool
     */
    public function create(array $data): bool;

    /**
     * Find a user by email
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;
}
