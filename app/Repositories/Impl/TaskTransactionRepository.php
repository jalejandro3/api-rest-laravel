<?php

declare(strict_types=1);

namespace App\Repositories\Impl;

use App\Models\TaskTransaction;
use App\Repositories\TaskTransactionRepository as TaskApprovalTransactionRepositoryInterface;

final class TaskTransactionRepository implements TaskApprovalTransactionRepositoryInterface
{
    /**
     * @var TaskTransaction
     */
    private $taskApprovalTransaction;

    /**
     * TaskTransactionRepository constructor.
     *
     * @param TaskTransaction $taskApprovalTransaction
     */
    public function __construct(TaskTransaction $taskApprovalTransaction)
    {
        $this->taskApprovalTransaction = $taskApprovalTransaction;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): TaskTransaction
    {
        return $this->taskApprovalTransaction->create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): int
    {
        return $this->taskApprovalTransaction->whereId($id)->update($data);
    }

    /**
     * @inheritDoc
     */
    public function findByTaskId(int $id): ?TaskTransaction
    {
        return $this->taskApprovalTransaction->whereTaskId($id)->first();
    }
}
