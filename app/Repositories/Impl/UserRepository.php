<?php

declare(strict_types=1);

namespace App\Repositories\Impl;

use App\Models\User;
use App\Repositories\UserRepository as UserRepositoryInterface;

final class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(
        User $user
    )
    {
        $this->user = $user;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): bool
    {
        return $this->user->save($data);
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): ?User
    {
        return $this->user->whereEmail($email)->first();
    }
}
