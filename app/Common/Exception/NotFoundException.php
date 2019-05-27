<?php

namespace App\Common\Exception;

use Exception;
use Illuminate\Http\Request;
use Throwable;

class NotFoundException extends Exception
{
    public function __construct(string $message = "Resource Not Found", int $code = 404, Throwable $previous = null)
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
                'code' => 404,
                'message' => 'Resource Not Found',
            ]);
        }
    }
}
