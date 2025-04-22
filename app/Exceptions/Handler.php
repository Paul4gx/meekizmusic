<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    // Keep any existing properties/methods here...

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception): Response|JsonResponse
    {
        if ($exception instanceof TokenMismatchException) {

            // Handle AJAX or JSON requests
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Session expired. Please refresh the page and try again.',
                ], 419);
            }

            // Handle standard web requests
            return redirect()
                ->route('login') // or use ->back() to go back
                ->with('error', 'Your session has expired. Please login again.');
        }

        return parent::render($request, $exception);
    }
}
