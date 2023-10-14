<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    protected $errorMapping = [
        NotFoundHttpException::class => Response::HTTP_NOT_FOUND,
        ResourceNotFoundException::class => Response::HTTP_NOT_FOUND,
        BadRequestHttpException::class => Response::HTTP_BAD_REQUEST,
        AuthorizationException::class => Response::HTTP_FORBIDDEN,
        InternalErrorException::class => Response::HTTP_INTERNAL_SERVER_ERROR,
        ValidationException::class => Response::HTTP_UNPROCESSABLE_ENTITY,
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

        $this->renderable(function (Throwable $e) {

            $errorClass     = get_class($e);
            $errorCode      = $this->errorMapping[$errorClass] ?? Response::HTTP_INTERNAL_SERVER_ERROR;
            $errorMessage   = __("exceptions.{$errorCode}") ?? __("exceptions.500");

            $response = [
                'status'    => 'error',
                'message'   => $errorMessage,
                'code'      => $errorCode,
            ];

            if ($e instanceof ValidationException) {
                $response['error'] = $e->errors();
            }

            if (env('APP_DEBUG') === true) {
                $response['trace']      = $e->getTrace();
                $response['message']    = $e->getMessage();
            }

            return response()->json($response, $errorCode);
        });
    }
}
