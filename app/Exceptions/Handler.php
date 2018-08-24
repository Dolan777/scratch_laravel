<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler {

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
        Symfony\Component\HttpKernel\Exception\HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e) {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e) {
        if ($e instanceof TokenMismatchException) {

            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized access.', 401);
            } else {
                return redirect()->back()->with('error_msg', "Opps! Seems you couldn't submit form for a longtime. Please try again");
            }
        }

        if ($this->isHttpException($e)) {
            return $this->renderHttpException($e);
        } else {
            return parent::render($request, $e);
        }
    }

    protected function renderHttpException(HttpException $e) {

        return response()->view('errors.404', [], $e->getStatusCode());
    }

//    protected function convertExceptionToResponse(Exception $e) {
//        if (config('app.debug')) {
//            $whoops = new \Whoops\Run;
//            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
//
//            return response()->make(
//                            $whoops->handleException($e), method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500, method_exists($e, 'getHeaders') ? $e->getHeaders() : []
//            );
//        }
//
//        return parent::convertExceptionToResponse($e);
//    }

}
