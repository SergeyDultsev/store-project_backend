<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function jsonResponse($data, $status, $message)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
