<?php

namespace App\Trait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

trait HttpResponses
{
    /**
     * Padroniza a resposta HTTP.
     *
     * @param string $message
     * @param string|int $status
     * @param array|JsonResource|AnonymousResourceCollection $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(string $message, string|int $status, $data = [])
    {
        if(!$data){
            $data = 'Empty load';
        }
        return response()->json([
            'message' => $message,
            'status' => $status,
            'data' => $data
        ], $status);
    }

    /**
     * Padroniza a resposta de erro HTTP.
     *
     * @param string $message
     * @param string|int $status
     * @param string $error
     * @param array|\Illuminate\Database\Eloquent\Model $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function error(string $message, string|int $status, string $error)
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'error' => $error
        ], $status);
    }
}
