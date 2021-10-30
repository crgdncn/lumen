<?php

namespace App\Http\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ResponseHelper
{
    /**
     * @param int $httpResponseCode
     * @return JsonResponse
     */
    public function renderSuccess(int $httpResponseCode = ResponseAlias::HTTP_OK): JsonResponse
    {
        return response()->json(['success' => true], $httpResponseCode);
    }

    /**
     * @param string $message
     * @param int $httpResponseCode
     * @return JsonResponse
     */
    public function renderError(string $message, int $httpResponseCode = ResponseAlias::HTTP_I_AM_A_TEAPOT): JsonResponse
    {
        return response()->json(['message' => $message], $httpResponseCode);
    }

    /**
     * @param int $httpResponseCode
     * @return JsonResponse
     */
    public function renderCreated(Model $model): JsonResponse
    {
        return response()->json($model, ResponseAlias::HTTP_CREATED);
    }
}
