<?php

namespace App\Common\Exception;

use Exception;
use Throwable;

class InvalidArgumentException extends Exception
{
    public function __construct(string $message = "非法参数", int $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
