<?php

namespace App\Services;

use App\Models\User;

interface SecurityServiceInterface
{
    /**
     * Method to generate a token for logged users
     *
     * @param User $user User object
     * @return string
     */
    public function generateToken(User $user): string;
}
