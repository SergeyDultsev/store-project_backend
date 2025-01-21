<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function jsonResponse($data, int $status, string $message): object
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
