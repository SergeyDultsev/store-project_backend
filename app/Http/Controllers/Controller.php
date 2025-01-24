<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

abstract class Controller
{
    protected function jsonResponse($data, int $status, string $message): object
    {
        Log::info('jsonResponse called', [
            'data' => $data,
            'status' => $status,
            'message' => $message,
        ]);

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
