<?php

declare(strict_types=1);

namespace App\Services\Impl;

use App\Exceptions\ApplicationException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\TaskTransaction;
use App\Repositories\TaskRepository;
use App\Repositories\TaskTransactionRepository;
use App\Services\TaskTransactionService as TaskApprovalTransactionServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Collection;

final class TaskTransactionService implements TaskApprovalTransactionServiceInterface
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @var TaskTransactionRepository
     */
    private $taskTransactionRepository;

    /**
     * TaskTransactionService constructor.
     *
     * @param TaskRepository $taskRepository
     * @param TaskTransactionRepository $taskTransactionRepository
     */
    public function __construct(
        TaskRepository $taskRepository,
        TaskTransactionRepository $taskTransactionRepository
    )
    {
        $this->taskRepository = $taskRepository;
        $this->taskTransactionRepository = $taskTransactionRepository;
    }

    public function getAll(): Collection
    {
        return $this->taskTransactionRepository->findAll();
    }

    /**
     * @inheritDoc
     */
    public function approve(int $taskId, string $token): TaskTransaction
    {
        $this->checkTaskTransactionExists($taskId);

        $this->checkTaskTransactionIsPending($taskId);

        return DB::transaction(function() use($taskId, $token) {
            $user = jwt_decode_token($token)->data;
            $taskTransaction = $this->taskTransactionRepository->findByTaskId($taskId);

            $this->taskRepository->update($taskTransaction->task->id, [
                'is_approved' => true
            ]);

            $this->taskTransactionRepository->update($taskTransaction->id, [
                'status_id' => 2,
                'user_id' => $user->id
            ]);

            return $taskTransaction->refresh();
        });
    }

    /**
     * @inheritDoc
     */
    public function decline(int $taskId, string $token): TaskTransaction
    {
        $this->checkTaskTransactionExists($taskId);

        $this->checkTaskTransactionIsPending($taskId);

        return DB::transaction(function() use($taskId, $token) {
            $user = jwt_decode_token($token)->data;
            $taskTransaction = $this->taskTransactionRepository->findByTaskId($taskId);

            if ($taskTransaction->task->is_approved) {
                $this->taskRepository->update($taskTransaction->task->id, [
                    'is_approved' => false
                ]);
            }

            $this->taskTransactionRepository->update($taskTransaction->id, [
                'status_id' => 3,
                'user_id' => $user->id
            ]);

            return $taskTransaction->refresh();
        });
    }

    /**
     * @param int $taskId
     * @throws ResourceNotFoundException
     */
    private function checkTaskTransactionExists(int $taskId)
    {
        if (! $this->taskTransactionRepository->findByTaskId($taskId)) {
            throw new ResourceNotFoundException("Task transaction does not exists.");
        }
    }

    /**
     * @param int $taskId
     * @throws ApplicationException
     */
    private function checkTaskTransactionIsPending(int $taskId)
    {
        if ($this->taskTransactionRepository->findByTaskId($taskId)->status_id !== 1) {
            throw new ApplicationException("There is not task pending for approbation.");
        }
    }
}
