<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class Helper
{
    public static function logMessage($endpoint, $input, $exception)
    {
        Log::info("Endpoint: = " . $endpoint);
        Log::debug($input);
        Log::info("Exception: = " . $exception);
    }
}
