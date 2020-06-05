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
     * @param int $userId
     * @param int $priorityId
     * @param int $statusId
     * @param string $description
     * @return Task
     * @throws ApplicationException
     */
    public function create(int $userId, int $priorityId, int $statusId, string $description): Task;

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
