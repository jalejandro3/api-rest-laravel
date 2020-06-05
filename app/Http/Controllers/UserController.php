<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var AuthService
     */
    private $authService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor.
     *
     * @param AuthService $authService
     * @param UserService $userService
     */
    public function __construct(
        AuthService $authService,
        UserService $userService
    )
    {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    /**
     * Return User Data by Bearer Token
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserData(Request $request): JsonResponse
    {
        return $this->success($this->userService->getUserData($request->bearerToken()));
    }
}
