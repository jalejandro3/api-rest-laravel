<?php

namespace App\Services\Impl;

use App\Exceptions\ApplicationException;
use App\Exceptions\ResourceNotFoundException;
use App\Repositories\UserRepository;
use App\Services\AuthService as AuthServiceInterface;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * AuthService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function login(string $email, string $password): array
    {
        $user = $this->userRepository->findByEmail($email);

        if (! $user) {
            throw new ResourceNotFoundException('User does not exists.');
        }

        if (! Auth::attempt(['email' => $email, 'password' => $password])) {
            throw new ApplicationException('Wrong email or password, please verify your data.');
        }

        return ['token' => jwt_build_token($user->toArray()), 'data' => $user->toArray()];
    }
}
