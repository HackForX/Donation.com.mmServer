<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    /**
     * Respond with success.
     *
     * @param mixed $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data = null,$message="Success", $status = JsonResponse::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message'=>$message,
            'data' => $data
        ], $status);
    }

    /**
     * Respond with error.
     *
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($code=500,$message, $status = JsonResponse::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message
        ], $status);
    }
}
