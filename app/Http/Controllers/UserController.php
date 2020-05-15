<?php

namespace App\Http\Controllers;

use App\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * UserController constructor.
     * @param UserServiceInterface $userService
     */
    public function __construct(
        UserServiceInterface $userService
    )
    {
        $this->userService = $userService;
    }

    public function login(Request $request): JsonResponse
    {
        $rules = [
            'user' => 'bail|required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            //TODO: Crear inputException.
        }

        return $this->success($this->userService->login());
    }
}
