<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{



    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException && $request->wantsJson()) {
            return response()->json([
                'errors' => $exception->errors(),
            ], 422);
        }

        return parent::render($request, $exception);
    }
}
