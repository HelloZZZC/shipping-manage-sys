<?php

namespace App\Common\Exception;

use Exception;
use Throwable;
use Illuminate\Http\Request;

class AccessDeniedException extends Exception
{
    public function __construct(string $message = "Access Denied", int $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        if ('production' == env('APP_ENV')) {
            if ($request->isXmlHttpRequest()) {
                return response()->json([], 500);
            }

            return response()->view('error', [
                'code' => 403,
                'message' => 'Access Denied',
            ]);
        }
    }
}
