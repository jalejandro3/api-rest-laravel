<?php

namespace App\Http\Controllers;

use App\Exceptions\InputValidationException;
use App\Exceptions\ResourceNotFoundException;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * @var TaskService
     */
    private $taskService;

    /**
     * TaskController constructor.
     *
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Get all tasks
     *
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        return $this->success($this->taskService->getAllTasks());
    }

    /**
     * Get a task by id
     *
     * @param int $id
     * @return JsonResponse
     * @throws InputValidationException
     * @throws ResourceNotFoundException
     */
    public function getTaskById(int $id): JsonResponse
    {
        if (is_null($id)) {
            throw new InputValidationException('Id is required.');
        }

        return $this->success($this->taskService->getTask($id));
    }

    /**
     * Get all user's tasks
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getTasksByUser(Request $request): JsonResponse
    {
        return $this->success($this->taskService->getTasksByUser($request->bearerToken()));
    }

    /**
     * Create a new task
     *
     * @param Request $request
     * @return JsonResponse
     * @throws InputValidationException
     * @throws \App\Exceptions\ApplicationException
     */
    public function createTask(Request $request): JsonResponse
    {
        $rules = [
            'user_id' => 'required|integer',
            'priority_id' => 'required|integer',
            'status_id' => 'required|integer',
            'description' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            throw new InputValidationException($validator->messages()->all());
        }

        return $this->success($this->taskService->create($request->all()));
    }
}
