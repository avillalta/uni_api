<?php


namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    /**
     * Build a success response
     * @param string|array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK){
        return response()->json(['success' => true, 'data' => $data], $code);        
    }

    /**
     * Build a error response
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code){
        return response()->json(['success' => false, 'error' => $message, 'code' => $code], $code);
    }
}