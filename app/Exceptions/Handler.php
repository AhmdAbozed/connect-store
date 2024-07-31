<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Throwable;
use Illuminate\Support\Facades\Log;
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
    public function report(Throwable $e)
    {
        if (true) {
            //log to terminal, excluding the stack trace
            Log::error('['.$e->getCode().'] "'.$e->getMessage().'" on line '.$e->getTrace()[0]['line'].' of file '.$e->getTrace()[0]['file']);
        } else {
            Log::error($e);
            //log to log file
            //parent::report($e);
        }
    }
}
