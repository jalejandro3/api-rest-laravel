<?php

namespace App\Services\Impl;

use App\Models\User;
use App\Services\SecurityServiceInterface;
use Firebase\JWT\JWT;

class SecurityService implements SecurityServiceInterface
{
    /**
     * @inheritDoc
     */
    public function generateToken(User $user): string
    {
    }
}
