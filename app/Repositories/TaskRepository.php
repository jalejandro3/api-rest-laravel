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
     * array[]
     *      ['user_id']     Task User Id
     *      ['priority_id'] Task Priority
     *      ['status_id']   Task status
     *      ['description'] Task description
     *      ['is_approved'] Optional: by default false.
     * @param array $data see above
     * @return Task
     */
    public function create(array $data): Task;

    /**
     * Create a new task
     *
     * @param $id
     * array[]
     *      ['priority_id'] Optional: Task Priority.
     *      ['status_id']   Optional: Task status.
     *      ['description'] Optional: Task description.
     *      ['is_approved'] Optional: by default false.
     * @param array $data see above
     * @return int
     */
    public function update(int $id, array $data): int;

    /**
     * Get all tasks
     *
     * @return Collection
     */
    public function findAll(): Collection;

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
