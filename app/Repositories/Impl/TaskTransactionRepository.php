<?php

declare(strict_types=1);

namespace App\Repositories\Impl;

use App\Models\TaskTransaction;
use App\Repositories\TaskTransactionRepository as TaskApprovalTransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

final class TaskTransactionRepository implements TaskApprovalTransactionRepositoryInterface
{
    /**
     * @var TaskTransaction
     */
    private $taskTransaction;

    /**
     * TaskTransactionRepository constructor.
     *
     * @param TaskTransaction $taskTransaction
     */
    public function __construct(TaskTransaction $taskTransaction)
    {
        $this->taskTransaction = $taskTransaction;
    }

    /**
     * @inheritDoc
     */
    public function findAll(): Collection
    {
        return $this->taskTransaction->all();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): TaskTransaction
    {
        return $this->taskTransaction->create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): int
    {
        return $this->taskTransaction->whereId($id)->update($data);
    }

    /**
     * @inheritDoc
     */
    public function findByTaskId(int $id): ?TaskTransaction
    {
        return $this->taskTransaction->whereTaskId($id)->first();
    }
}
