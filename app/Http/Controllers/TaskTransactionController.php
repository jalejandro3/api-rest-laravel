<?php

namespace App\Http\Controllers;

use App\Exceptions\ApplicationException;
use App\Exceptions\InputValidationException;
use App\Exceptions\ResourceNotFoundException;
use App\Services\TaskTransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskTransactionController extends Controller
{
    /**
     * @var TaskTransactionService
     */
    private $taskTransactionService;

    /**
     * TaskTransactionController constructor.
     *
     * @param TaskTransactionService $taskTransactionService
     */
    public function __construct(TaskTransactionService $taskTransactionService)
    {
        $this->taskTransactionService = $taskTransactionService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws InputValidationException
     * @throws ApplicationException
     * @throws ResourceNotFoundException
     */
    public function approveTask(Request $request): JsonResponse
    {
        $rules = [
            'task_id' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            throw new InputValidationException($validator->messages()->all());
        }

        return $this->success($this->taskTransactionService->approve(
            $request->get('task_id'), $request->bearerToken())
        );
    }
}
