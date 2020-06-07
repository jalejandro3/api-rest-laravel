<?php

declare(strict_types=1);

namespace App\Services\Impl;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Task;
use App\Repositories\TaskTransactionRepository;
use App\Repositories\TaskRepository;
use App\Services\TaskService as TaskServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Collection;

final class TaskService implements TaskServiceInterface
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @var TaskTransactionService
     */
    private $taskApprovalTransactionRepository;

    /**
     * TaskService constructor.
     *
     * @param TaskRepository $taskRepository
     * @param TaskTransactionRepository $taskApprovalTransactionRepository
     */
    public function __construct(
        TaskRepository $taskRepository,
        TaskTransactionRepository $taskApprovalTransactionRepository
    )
    {
        $this->taskRepository = $taskRepository;
        $this->taskApprovalTransactionRepository = $taskApprovalTransactionRepository;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Task
    {
        return DB::transaction(function() use($data) {

            $task = $this->taskRepository->create($data);

            $this->taskApprovalTransactionRepository->create([
                'user_id' => 1,
                'task_id' => $task->id
            ]);

            return $task;
        });
    }

    /**
     * @inheritDoc
     */
    public function getTasksByUser(string $token): Collection
    {
        $user = jwt_decode_token($token)->data;

        return $this->taskRepository->getTasksByUser($user->id);
    }

    /**
     * @inheritDoc
     */
    public function getAllTasks(): Collection
    {
        return $this->taskRepository->getAll();
    }

    /**
     * @inheritDoc
     */
    public function getTask(int $id): Task
    {
        $this->checkTaskExists($id);

        return $this->taskRepository->getTask($id);
    }

    /**
     * @param int $id
     * @throws ResourceNotFoundException
     */
    private function checkTaskExists(int $id)
    {
        if (! $this->taskRepository->getTask($id)) {
            throw new ResourceNotFoundException("Task with id {$id} does not exists.");
        }
    }
}
