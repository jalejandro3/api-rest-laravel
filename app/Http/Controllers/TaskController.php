<?php

namespace App\Http\Controllers;

use App\Exceptions\InputValidationException;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function all(): JsonResponse
    {
        return $this->success($this->taskService->getAllTasks());
    }

    public function getTaskById(int $id): JsonResponse
    {
        if (is_null($id)) {
            throw new InputValidationException('Id is required.');
        }

        return $this->success($this->taskService->getTask($id));
    }

    public function getTasksByUser(Request $request): JsonResponse
    {
        return $this->success($this->taskService->getTasksByUser($request->bearerToken()));
    }

    public function createTask(Request $request): JsonResponse
    {
        //Validar request
        return $this->success($this->taskService->create(
            $request->get('user_id'),
            $request->get('priority_id'),
            $request->get('status_id'),
            $request->get('description')
        ));
    }
}
