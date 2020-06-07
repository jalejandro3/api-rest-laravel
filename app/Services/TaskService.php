<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ApplicationException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskService
{
    /**
     * Create a new task
     *
     * array[]
     *      ['user_id']     Tash User Id
     *      ['priority_id'] Task Priority
     *      ['status_id']   Task status
     *      ['description'] Task description
     * @param array $data see above
     * @return Task
     * @throws ApplicationException
     */
    public function create(array $data): Task;

    /**
     * Return all tasks
     *
     * @return Collection
     */
    public function getAllTasks(): Collection;

    /**
     * Return Task data by id
     *
     * @param int $id Task id
     * @return Task
     * @throws ResourceNotFoundException
     */
    public function getTask(int $id): Task;

    /**
     * Return all User's Tasks
     *
     * @param string $token
     * @return Collection
     */
    public function getTasksByUser(string $token): Collection;
}
