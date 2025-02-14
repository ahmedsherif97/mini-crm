<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponseTrait
{
    public function successResponse($data, string $message = 'Success', Int $statusCode = 200, $params = []): JsonResponse
    {
        $responseMessage = [
            'success' => true,
            'message' => $message,
            'data' => $data,
            'params' => $params
        ];

        if($data != [] && isset($data->resource) && $data->resource instanceof LengthAwarePaginator) $responseMessage['pagination'] = $this->paginationData($data);
        
        return response()->json($responseMessage, $statusCode);
    }

    private function paginationData(ResourceCollection $data): array
    {
        return [
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'per_page' => $data->perPage(),
            'total' => $data->total(),
        ];
    }

    public function errorResponse(string $message, Int $statusCode = 400):object {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $statusCode);
    }
}
