<?php

namespace App\Exceptions;

use App\Exceptions\Service\ServiceException;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseCode;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Throwable;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Errors list.
     *
     * @var array
     */
    private $errors = [
        [
            'class' => ApplicationException::class,
            'error_message' => 'Bad Request.',
            'response_code' => ResponseCode::HTTP_BAD_REQUEST
        ],
        [
            'class' => UnauthorizedException::class,
            'error_message' => 'Access Denied.',
            'response_code' => ResponseCode::HTTP_UNAUTHORIZED
        ],
        [
            'class' => ServiceException::class,
            'error_message' => 'Internal System Error.',
            'response_code' => ResponseCode::HTTP_INTERNAL_SERVER_ERROR
        ],
        [
            'class' => ClientException::class,
            'error_message' => 'Internal System Error.',
            'response_code' => ResponseCode::HTTP_INTERNAL_SERVER_ERROR
        ],
        [
            'class' => ProcessFailedException::class,
            'error_message' => 'Internal System Error.',
            'response_code' => ResponseCode::HTTP_INTERNAL_SERVER_ERROR
        ],
        [
            'class' => ResourceNotFoundException::class,
            'error_message' => 'Resource not found.',
            'response_code' => ResponseCode::HTTP_NOT_FOUND
        ]
    ];

    /**
     * Report or log an exception.
     *
     * @param  Throwable  $exception
     * @return void
     *
     * @throws Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param  Throwable $exception
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($error = $this->exceptionExists($exception)) {
            return $this->getResponse($exception, $error);
        }

        return $this->getResponse($exception);
    }

    /**
     * Check if error exists in error array
     *
     * @param Exception $exception Exception to find into errors array.
     * @return Exception|bool
     */
    private function exceptionExists(Exception $exception)
    {
        foreach ($this->errors as $error) {
            if ($exception instanceof $error['class']) {
                return $error;
            }
        }

        return false;
    }

    /**
     * Configura el mensaje de error a devolver.
     *
     * @param Exception $exception
     * @param null $error
     * @return JsonResponse
     */
    private function getResponse(Exception $exception, $error = null)
    {
        if (! is_null($error)) {
            $errorMessage = $this->getMessageError($exception, $error);
            $responseCode = $this->getResponseCode($exception, $error);
            $response = $this->getErrorResponse($errorMessage, $exception, $responseCode);
        } else {
            $response = $this->getErrorResponse('Ha ocurrido un error!', $exception, 500);
        }

        return $response;
    }

    /**
     * Return error response.
     *
     * @param string $message
     * @param int $code
     * @param Exception $exception
     * @return JsonResponse
     */
    protected function getErrorResponse($message, $exception, $code)
    {
        return response()->json([
            'timestamp' => Carbon::now(),
            'error' => $exception->getMessage(),
            'message' => $message
        ], $code);
    }

    /**
     * Return error message.
     *
     * @param Exception $exception
     * @param $error
     * @return string
     */
    private function getMessageError(Exception $exception, $error): string
    {
        return ($exception->getMessage() === ''
            && isset($error['error_message'])) ? $error['error_message'] : $exception->getMessage();
    }

    /**
     * Return response code.
     *
     * @param Exception $exception
     * @param $error
     * @return int|mixed
     */
    private function getResponseCode(Exception $exception, $error)
    {
        return ($exception->getCode() === 0 &&
            isset($error['response_code'])) ? $error['response_code'] : $exception->getCode();
    }
}
