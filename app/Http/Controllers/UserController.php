<?php

namespace App\Http\Controllers;

use App\Exceptions\InputValidationException;
use App\Exceptions\ApplicationException;
use App\Exceptions\ResourceNotFoundException;
use App\Services\AuthServiceInterface;
use App\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @var AuthServiceInterface
     */
    private $authService;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * UserController constructor.
     *
     * @param AuthServiceInterface $authService
     * @param UserServiceInterface $userService
     */
    public function __construct(
        AuthServiceInterface $authService,
        UserServiceInterface $userService
    )
    {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    /**
     * User Login
     *
     * @param Request $request
     * @return JsonResponse
     * @throws InputValidationException
     * @throws ApplicationException
     * @throws ResourceNotFoundException
     */
    public function login(Request $request): JsonResponse
    {
        $rules = [
            'email' => 'bail|required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            throw new InputValidationException($validator->getMessageBag());
        }

        return $this->authSuccess($this->authService->login($request->get('email'), $request->get('password')));
    }
}
