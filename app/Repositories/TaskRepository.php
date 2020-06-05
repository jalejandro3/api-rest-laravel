<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepository
{
    /**
     * Create a new task
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): Task;

    /**
     * Get all tasks
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Get all user's tasks
     *
     * @param int $userId
     * @return Collection
     */
    public function getTasksByUser(int $userId): Collection;

    /**
     * Get Task by id
     *
     * @param int $id
     * @return Task
     */
    public function getTask(int $id): ?Task;
}
