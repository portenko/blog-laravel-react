<?php

namespace App\Traits;

/**
 * Trait ApiResponse
 * @package App\Traits
 */
trait ApiResponse
{
    /**
     * @param $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendData($data, $status = 200)
    {
        return response()->json($data, $status);
    }

    /**
     * @param $message
     * @param array $errors
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendError($message, $errors = [], $status = 404)
    {
        $result = [
            'message' => $message
        ];
        if(!empty($errorMessages)){
            $response['errors'] = $errors;
        }
        return response()->json($result, $status);
    }
}
