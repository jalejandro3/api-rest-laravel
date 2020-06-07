<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ApplicationException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\TaskTransaction;
use Illuminate\Database\Eloquent\Collection;

interface TaskTransactionService
{
    /**
     * Return all task transactions
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Approve a task transaction
     *
     * @param int $taskId
     * @param string $token
     * @return TaskTransaction
     * @throws ResourceNotFoundException
     * @throws ApplicationException
     */
    public function approve(int $taskId, string $token): TaskTransaction;

    /**
     * Decline a task transaction
     *
     * @param int $taskId
     * @param string $token
     * @return TaskTransaction
     * @throws ResourceNotFoundException
     * @throws ApplicationException
     */
    public function decline(int $taskId, string $token): TaskTransaction;
}
