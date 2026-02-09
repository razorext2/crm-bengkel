<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class ErrorLogger
{
    public static function log(Throwable $e, string $message = '', array $context = [])
    {
        $errorId = (string) Str::uuid();

        Log::error("[$errorId]".$message, array_merge([
            'error_id' => $errorId,
            'exception' => $e,
            'error_msg' => $e->getMessage(),
            'url' => request()->fullUrl() ?? null,
            'ip' => request()->header('x-forwarded-for'),
        ], $context));

        return $errorId;
    }
}
