<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
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
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // Always return JSON for API requests
        if ($request->is('api/*')) {
            return $this->renderApiException($request, $exception);
        }
        
        return parent::render($request, $exception);
    }
    
    /**
     * Render API exceptions as JSON
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function renderApiException($request, Throwable $exception)
    {
        $status = 500;
        $message = 'Internal Server Error';
        
        if ($exception instanceof HttpException) {
            $status = $exception->getStatusCode();
            $message = $exception->getMessage();
        } elseif ($exception instanceof ModelNotFoundException) {
            $status = 404;
            $message = 'Resource not found';
        } elseif ($exception instanceof AuthorizationException) {
            $status = 403;
            $message = 'Forbidden';
        } elseif ($exception instanceof ValidationException) {
            $status = 422;
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $exception->errors()
            ], $status);
        }
        
        $response = [
            'message' => $message,
            'status' => $status
        ];
        
        // Include exception details in development
        if (env('APP_DEBUG', false)) {
            $response['exception'] = get_class($exception);
            $response['trace'] = $exception->getTraceAsString();
        }
        
        return response()->json($response, $status);
    }
}
