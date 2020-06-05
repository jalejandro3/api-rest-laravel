<?php

namespace App\Http\Controllers;

use App\Exceptions\ApplicationException;
use App\Exceptions\InputValidationException;
use App\Exceptions\ResourceNotFoundException;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private $authService;

    /**
     * UserController constructor.
     *
     * @param AuthService $authService
     */
    public function __construct(
        AuthService $authService
    )
    {
        $this->authService = $authService;
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

        return $this->authSuccess(
            $this->authService->login($request->get('email'), $request->get('password'))
        );
    }
}
