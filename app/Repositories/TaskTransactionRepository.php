<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\TaskTransaction;

interface TaskTransactionRepository
{
    /**
     * Create a task transaction
     *
     * @param array $data see above
     * @return TaskTransaction
     */
    public function create(array $data): TaskTransaction;

    /**
     * Update a task transaction
     *
     * @param int $id
     * @param array $data
     * @return int
     */
    public function update(int $id, array $data): int;

    /**
     * Find a task transaction by task id
     *
     * @param int $id
     * @return TaskTransaction
     */
    public function findByTaskId(int $id): ?TaskTransaction;
}
