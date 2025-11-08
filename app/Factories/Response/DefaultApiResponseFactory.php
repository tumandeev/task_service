<?php

namespace App\Factories\Response;


use App\DTO\ApiErrorResponse;
use App\DTO\ApiSuccessResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class DefaultApiResponseFactory implements ApiResponseFactory
{
    public function makeFrom(SymfonyResponse $response): JsonResponse
    {
        if ($response instanceof JsonResponse) {
            $data = $response->getData(true);
            if (is_array($data) && array_key_exists('success', $data)) {
                return $response;
            }

            if ($response->getStatusCode() >= 400) {
                $message = $data['message'] ?? 'Error';
                return (new ApiErrorResponse(
                    message: $message,
                    status: $response->getStatusCode(),
                ))->toResponse();
            }

            return (new ApiSuccessResponse(
                data: $data,
                status: $response->getStatusCode()
            ))->toResponse();
        }

        $status = method_exists($response, 'getStatusCode') ? $response->getStatusCode() : 200;
        $content = method_exists($response, 'getContent') ? $response->getContent() : null;

        if ($status >= 400) {
            return (new ApiErrorResponse(
                message: $content ?: 'Error',
                status: $status,
            ))->toResponse();
        }

        return (new ApiSuccessResponse(
            data: json_decode($content, true) ?? $content,
            status: $status
        ))->toResponse();
    }
}
