<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ApplicationException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\TaskTransaction;

interface TaskTransactionService
{
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
     * @param int $userId
     * @return TaskTransaction
     * @throws ResourceNotFoundException
     * @throws ApplicationException
     */
    public function decline(int $taskId, int $userId): TaskTransaction;
}
