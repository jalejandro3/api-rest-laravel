<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Success body.
     *
     * @param array|object $data
     * @return JsonResponse
     */
    public function success($data): JsonResponse
    {
        return response()->json(['data' => $data]);
    }

    /**
     * Auth success body
     *
     * @param array $data
     * @return JsonResponse
     */
    public function authSuccess(array $data): JsonResponse
    {
        return response()->json($data);
    }
}
