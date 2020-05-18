<?php

namespace App\Services\Impl;

use App\Exceptions\ApplicationException;
use App\Exceptions\ResourceNotFoundException;
use App\Repositories\UserRepositoryInterface;
use App\Services\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * AuthService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function login(string $email, string $password): string
    {
        $user = $this->userRepository->findByEmail($email);

        if (! $user) {
            throw new ResourceNotFoundException('User does not exists.');
        }

        if (! Auth::attempt(['email' => $email, 'password' => $password])) {
            throw new ApplicationException('Wrong email or password, please verify your data.');
        }

        return jwt_build_token($user->toArray());
    }
}
