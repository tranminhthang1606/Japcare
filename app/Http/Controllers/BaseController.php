<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    public function responseErrors($returnCode, $message, $statusCode = 400)
    {
        return response()->json([
            'code' => (int)$returnCode,
            'message' => $message,
        ], $statusCode);
    }

    public function responseUserSuccess($data, $statusCode = 200, $token = null)
    {
        return response()->json([
            'code' => 200,
            'data' => $data,
            'access_token' => $token
        ], $statusCode);
    }

    public function responseSuccess($data = null, $statusCode = 200)
    {
        return response()->json([
            'code' => 200,
            'data' => $data,
        ], $statusCode);
    }

    protected function responseDefault($returnCode, $message, $data = [])
    {
        return response()->json([
            'code' => (int)$returnCode,
            'message' => $message,
            'data' => $data
        ]);
    }

}
