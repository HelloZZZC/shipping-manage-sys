<?php

namespace App\Common\Exception;

use Exception;
use Throwable;

class NotFoundException extends Exception
{
    public function __construct(string $message = "Resource Not Found", int $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
