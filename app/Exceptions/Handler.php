<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        switch ($e) {
            case ($e instanceof AuthorizationException) :
                return response()->view('errors.'.$e->getStatusCode(),[], $e->getStatusCode());
                break;
            case ($e instanceof HttpException) :
                return response()->view('errors.'.$e->getStatusCode(),[], $e->getStatusCode());
                break;
            case ($e instanceof ModelNotFoundException) :
                return response()->view('errors.'.$e->getStatusCode(),[], $e->getStatusCode());
                break;
            case ($e instanceof ValidationException) :
                return response()->view('errors.'.$e->getStatusCode(),[], $e->getStatusCode());
                break;
            case ($e instanceof InvalidArgumentException) :
                return response()->view('errors.'.$e->getStatusCode(),[], $e->getStatusCode());
                break;
            default :
                return response()->view('errors.render');
        }
        //echo $e->getStatusCode();
        return parent::render($request, $e);
    }
}
