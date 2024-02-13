<?php

// create success helper function
use Illuminate\Http\JsonResponse;

if (!function_exists('success')) {
    function success($message = 'success', $data = null, $status = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];
        if ($data) $response = array_merge($response, $data);
        return Response::json($response, $status);
    }
}

// create error helper function
if (!function_exists('error')) {
    function error($message = 'error', $data = null, $status = 400): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];
        if ($data) $response = array_merge($response, $data);
        return Response::json($response, $status); // Status code here
    }
}

