<?php

declare(strict_types=1);

namespace App\Services\Impl;

use App\Exceptions\ApplicationException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Services\TaskService as TaskServiceInterface;
use Illuminate\Database\Eloquent\Collection;

final class TaskService implements TaskServiceInterface
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * TaskService constructor.
     *
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @inheritDoc
     */
    public function create(int $userId, int $priorityId, int $statusId, string $description): Task
    {
        try {
            return $this->taskRepository->create([
               'user_id' => $userId,
               'priority_id' => $priorityId,
               'status_id' => $statusId,
               'description' => $description
            ]);
        } catch (\Exception $e) {
            throw new ApplicationException('There was an error creating the task.');
        }
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
        if (! $task = $this->taskRepository->getTask($id)) {
            throw new ResourceNotFoundException('Task does not exists.');
        }

        return $task;
    }
}
