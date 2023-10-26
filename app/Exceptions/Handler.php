<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        // if ($request->is('api/*') || $request->wantsJson())
        // {
        //     if ($e instanceof AuthorizationException) {
        //         return response()->json([
        //             'status' => false,
        //             'message' => 'unauthenticated'
        //         ], 401);
        //     }


        //     if ($e instanceof RouteNotFoundException || $e instanceof NotFoundHttpException) {
        //         return response()->json([
        //             'status' => false,
        //             'message' => 'Not Found'
        //         ], 404);
        //     }


        //     return response()->json([
        //         'status' => false,
        //         'message' => $e->getMessage()
        //     ]);

        //     return parent::render($request, $e);
        // }
        return parent::render($request, $e);
    }
}
