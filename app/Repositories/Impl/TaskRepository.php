<?php

declare(strict_types=1);

namespace App\Repositories\Impl;

use App\Models\Task;
use App\Repositories\TaskRepository as TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

final class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var Task
     */
    private $task;

    /**
     * TaskRepository constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Task
    {
        return $this->task->create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): int
    {
        return $this->task->whereId($id)->update($data);
    }

    /**
     * @inheritDoc
     */
    public function findAll(): Collection
    {
        return $this->task->all();
    }

    /**
     * @inheritDoc
     */
    public function getTasksByUser(int $userId): Collection
    {
        return $this->task->whereUserId($userId)->get();
    }

    /**
     * @inheritDoc
     */
    public function getTask(int $id): ?Task
    {
        return $this->task->whereId($id)->first();
    }
}
