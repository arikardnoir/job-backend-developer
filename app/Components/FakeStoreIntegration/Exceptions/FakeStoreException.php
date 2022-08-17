<?php

namespace App\Components\FakeStoreIntegration\Exceptions;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Log;

class FakeStoreException extends Exception
{
    /**
     * FakeStoreException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = '',
        $code = 500,
        Throwable $previous = null
    ) {
        Log::error('Product Error: ' . $message);
        parent::__construct($message, $code, $previous);
    }
}