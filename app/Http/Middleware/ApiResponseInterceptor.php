<?php


namespace App\Http\Middleware;

use App\Factories\Response\ApiResponseFactory;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
readonly class ApiResponseInterceptor
{
    public function __construct(
        private ApiResponseFactory $factory
    ) {}

    public function handle(Request $request, Closure $next): JsonResponse
    {
        $response = $next($request);
        return $this->factory->makeFrom($response);
    }
}
